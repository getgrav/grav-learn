---
title: Admin Translations
taxonomy:
    category: docs
---
# Admin Translations

Grav 2.0's new admin (Admin2, powered by `admin-next`) extends Grav's existing
language pipeline with an opt-in **modern message format** that supports
placeholders, plural rules, and select cases — without breaking compatibility
with Grav 1.x or the classic admin.

This page documents the conventions plugin authors should follow when shipping
translatable strings that are consumed by the new admin UI.

## How Admin2 Reads Translations

The new admin loads translations via the `GET /api/v1/translations/{lang}`
endpoint provided by the API plugin. That endpoint returns the result of
Grav's standard `Languages::flattenByLang()`, which already merges every
plugin's `languages/<lang>.yaml` and `languages.yaml` into a single flat,
dot-notation map. **Plugins do not need to register translations — dropping
a YAML file in `languages/` is enough.**

Admin2 looks up every key in two places, in order:

1. `ICU.<key>` — passed through [ICU MessageFormat][icu] for placeholders,
   plurals, select cases, number/date formatting.
2. `<key>` — returned raw, exactly as it appears in the YAML.

If neither is found, the admin produces a humanised fallback derived from the
key itself (`ADMIN_NEXT.SOME_FIELD` → `"Some Field"`) so missing translations
remain readable.

> [!IMPORTANT]
> The format is opt-in **by namespace**, not by content. A value goes through
> the formatter only if its key starts with `ICU.`. Values without that prefix
> are never reformatted — even if they happen to contain `{...}`. This keeps
> behaviour predictable and keeps Grav 1 / classic admin completely unaffected.

## The Compatibility Story

The `ICU.` namespace was designed so a single plugin release can target both
Grav 1.7 and Grav 2.0:

| Plugin profile                     | Grav 1.7 / classic admin                     | Grav 2.0 / Admin2                                              |
|------------------------------------|----------------------------------------------|----------------------------------------------------------------|
| Untouched legacy plugin            | Works as today                               | Falls back to flat string (no plurals, but readable)           |
| Dual-target plugin (flat + `ICU.`) | Reads only the flat keys — `ICU.` invisible  | Reads `ICU.` first, gets full plural / placeholder support     |
| Grav 2.0-only plugin               | N/A — won't load on Grav 1                   | Uses `ICU.` exclusively                                        |

Grav 1's `Language::translate()` looks up exact keys with no awareness of
namespacing, so a top-level `ICU:` block in your YAML is **completely ignored
by Grav 1**. No PHP changes required, no compatibility shim, no patching of
classic admin.

## Plugin YAML Examples

### Grav 2.0-only plugin

If your plugin only targets Grav 2.0, put everything under `ICU:`:

[codesh=yaml]
ICU:
  PLUGIN_MYPLUGIN:
    TITLE: "My Plugin"
    GREETING: "Hello, {name}!"
    ITEMS_FOUND: "{n, plural, =0{No items} one{# item} other{# items}}"
    EDIT_LABEL: "{type, select, page{Edit page} post{Edit post} other{Edit item}}"
[/codesh]

In your `blueprints.yaml`, declare 2.0-only compatibility (see
[Plugin Compatibility](../plugin-compatibility)):

[codesh=yaml]
compatibility:
  grav:
    - '2.0'
dependencies:
  - { name: grav, version: '>=2.0.0' }
[/codesh]

### Dual-target plugin (Grav 1.7 + 2.0)

Ship two parallel blocks. Grav 1 reads the top-level keys; Admin2 prefers the
`ICU.` versions:

[codesh=yaml]
# Grav 1 / classic admin reads only this section.
PLUGIN_MYPLUGIN:
  TITLE: "My Plugin"
  GREETING: "Hello"
  ITEM_FOUND: "1 item found"
  ITEMS_FOUND: "items found"

# Admin2 prefers this section when present; Grav 1 ignores it entirely.
ICU:
  PLUGIN_MYPLUGIN:
    TITLE: "My Plugin"
    GREETING: "Hello, {name}!"
    ITEMS_FOUND: "{n, plural, =0{No items} one{# item} other{# items}}"
[/codesh]

Your PHP and Twig code paths can keep referencing `PLUGIN_MYPLUGIN.GREETING`
on both Grav versions and continue to work. Admin2-side code calls
`t('PLUGIN_MYPLUGIN.GREETING', { name })` and gets the formatted version on
Grav 2.0, with automatic fallback to the flat string when a translator
hasn't filled in the `ICU.` block yet.

> [!TIP]
> The fallback is per-key, not per-locale. Translators can migrate strings
> from the legacy block into the `ICU.` block on their own schedule — any key
> not yet present in `ICU.` simply falls through to the flat version.

## Calling Translations from Admin2 Code

### From Svelte components shipped in admin-next

```ts
import { i18n } from '$lib/stores/i18n.svelte';

const label = i18n.t('PLUGIN_MYPLUGIN.GREETING', { name: user.name });
const exists = i18n.has('PLUGIN_MYPLUGIN.GREETING');
```

### From a plugin web-component bundle

Plugin field bundles loaded into Admin2 (e.g. custom blueprint field types
shipped as web components) are not built against admin-next's runtime. They
use a stable, read-only global instead:

```js
const { t, has, locale, subscribe } = window.__GRAV_I18N;

const label = t('PLUGIN_EDITOR_PRO.TOOLBAR_BOLD');
const items = t('PLUGIN_MYPLUGIN.ITEMS_FOUND', { n: count });

// React to locale changes (e.g. user switches admin language)
const unsubscribe = subscribe((newLocale) => {
  rerender();
});
```

The global is installed during Admin2 bootstrap and is frozen — plugins can
depend on its presence and shape across all Grav 2.x releases.

## ICU MessageFormat Quick Reference

[codesh=text]
{name}                                         simple placeholder
{n, plural, one{# minute} other{# minutes}}    plural categories per locale
{type, select, page{Page} post{Post} other{Item}}    select cases
{n, number, percent}                           formatted number
{when, date, short}                            formatted date
[/codesh]

Use `=0`, `=1`, etc. for exact matches before plural categories:

[codesh=text]
{n, plural, =0{No results} one{1 result} other{# results}}
[/codesh]

CLDR plural categories (`zero`, `one`, `two`, `few`, `many`, `other`) are
applied per locale automatically. Polish, Czech, Russian, Arabic and other
languages with rich plural systems get the right form **without per-language
code in the plugin**. Always include `other` as the catch-all — it is required
by the format.

[Translation tools that understand ICU MessageFormat][icu-tools] (Crowdin,
Lokalise, Phrase, etc.) will preserve the syntax during translation. For
hand-edited YAML, prefer the simpler forms; reserve plural and select for the
cases where English-grammar composition actually breaks down in another
language.

## Migration Guidance

- For **new** Admin2-only strings, put them under `ICU.` from day one — even
  when the value has no placeholders. The cost is zero (the formatter passes
  plain strings through unchanged), and you avoid migrating later when a
  placeholder is added.
- For **existing** plugin strings that already work on Grav 1, leave them
  where they are. Add an `ICU:` block only when you actually need formatting
  capability or want better plural support in Admin2.
- **Don't auto-detect.** The format is opt-in by namespace, not by inspecting
  the value. Keep the contract obvious so debugging is easy.

## Auditing Blueprints

Plugin blueprint files are the single biggest source of UI text in any Grav
plugin. Every `label`, `title`, `description`, `help`, `placeholder`, and
`hint` field in `blueprints.yaml` (and any file under `blueprints/`) ends up
rendered in the admin UI. To be translatable, those values need to be
translation key references (`PLUGIN_FOO.SOMETHING`) rather than hardcoded
English strings.

The [Grav Devtools plugin][devtools] ships a CLI command that audits any
plugin or theme for hardcoded blueprint values, and can rewrite them to
translation keys for you.

### Installation

[codesh=bash]
bin/gpm install devtools
[/codesh]

### Auditing

Run with no arguments inside a Grav site to audit every installed plugin and
theme:

[codesh=bash]
bin/plugin devtools i18n-blueprints
[/codesh]

Output (truncated):

```
Plugin/Theme                                         Hardcoded   Keys   Ratio
--------------------------------------------------  ----------  -----  ------
admin2                                                       5      0    100%
api                                                         35      0    100%
editor-pro                                                  10      1     91%
flex-objects                                                24      6     80%
ai-pro                                                      40     46     47%
admin                                                        6    192      3%
--------------------------------------------------  ----------  -----  ------
TOTAL                                                      818   1286     39%
```

The **ratio** column is the percentage of `label`/`title`/`description`/`help`
fields that are still hardcoded English (red ≥ 50%, yellow ≥ 20%, green
otherwise). Lower is better.

You can scope the scan in several ways:

[codesh=bash]
# Single plugin or theme
bin/plugin devtools i18n-blueprints user/plugins/my-plugin

# A directory of plugins (e.g. just plugins, no themes)
bin/plugin devtools i18n-blueprints user/plugins

# A specific Grav installation root
bin/plugin devtools i18n-blueprints /path/to/another/grav-site
[/codesh]

Add `--details` to list every individual hardcoded value with its file/line:

[codesh=bash]
bin/plugin devtools i18n-blueprints user/plugins/my-plugin --details
[/codesh]

```
### my-plugin
  blueprints.yaml:38  label: Default for All Users
  blueprints.yaml:49  title: Editor Configuration
  blueprints.yaml:55  label: Toolbar Items
  blueprints.yaml:56  help: Configure which tools appear in the toolbar
  ...
```

Add `--threshold 0.5` to hide plugins below 50% hardcoded — useful when
auditing a whole install and only wanting to see the worst offenders.

### Auto-fixing with `--fix`

The `--fix` flag does two things atomically:

1. **Rewrites the blueprint YAML in place**, replacing each hardcoded value
   with a generated translation key (e.g. `label: Default for All Users` →
   `label: PLUGIN_MYPLUGIN.DEFAULT_FOR_ALL_USERS`).
2. **Updates the plugin's language file**, adding the new
   `KEY: "Original string"` entries under the appropriate prefix block.

The lang-file update respects whichever storage style the plugin already
uses:

| Existing file               | Behaviour                                                              |
|-----------------------------|------------------------------------------------------------------------|
| `languages.yaml`            | Append entries under the existing `en:` → `PLUGIN_FOO:` block          |
| `languages/en.yaml`         | Append entries to the existing top-level `PLUGIN_FOO:` block           |
| Neither                     | Create `languages/en.yaml` from scratch with the new block             |

If the prefix block doesn't yet exist in the file, the missing structure is
created in place — the command never produces duplicate top-level keys.

> [!IMPORTANT]
> `--fix` modifies your blueprint files **and** your lang file. **Always run
> with `--dry-run` first** to preview the changes, and make sure your work
> is committed to git so a revert is one command away if anything looks
> wrong.

[codesh=bash]
# Preview — no files are modified
bin/plugin devtools i18n-blueprints user/plugins/my-plugin --fix --dry-run

# Apply — rewrites blueprints AND updates the plugin's lang file
bin/plugin devtools i18n-blueprints user/plugins/my-plugin --fix
[/codesh]

Example output:

```
=== i18n blueprint fix ===

### my-plugin  (prefix: PLUGIN_MYPLUGIN, lang file: languages/en.yaml [per-locale-file])
Blueprint changes: 1 file(s), 4 line(s)
  blueprints.yaml  (4 lines)
Lang file changes: Append to languages/en.yaml (+4 entries)
# Lang file additions:
PLUGIN_MYPLUGIN:
  DEFAULT_FOR_ALL_USERS: "Default for All Users"
  EDITOR_CONFIGURATION: "Editor Configuration"
  TOOLBAR_ITEMS: "Toolbar Items"
  CONFIGURE_WHICH_TOOLS_APPEAR_IN_THE_TOOLBAR: "Configure which tools appear in the toolbar"
```

After running `--fix`, your `blueprints.yaml` reads:

[codesh=yaml]
default_for_all:
  type: toggle
  label: PLUGIN_MYPLUGIN.DEFAULT_FOR_ALL_USERS

editor_section:
  type: section
  title: PLUGIN_MYPLUGIN.EDITOR_CONFIGURATION
[/codesh]

…and the four new entries are appended under `PLUGIN_MYPLUGIN:` in
`languages/en.yaml`. The admin will resolve them through Grav's normal
translation pipeline immediately. Re-running `--fix` is idempotent — keys
that are already present (with the same value) are skipped.

### Interactive review with `--interactive`

For more cautious workflows, add `--interactive` (or `-i`) to review each
hardcoded value individually before it's converted. The command pauses on
each finding, shows you the file/line/field/value, and waits for a single
keystroke:

[codesh=bash]
bin/plugin devtools i18n-blueprints user/plugins/my-plugin --fix --interactive
[/codesh]

```
### my-plugin  (4 hardcoded values to review)

  [1/4] blueprints.yaml:5  description:
     Provides webhook and health check endpoints for Grav's Modern Scheduler
   Translate? [Y/n/a/s/q/?]: y

  [2/4] blueprints.yaml:35  label:
     Enable CORS
   Translate? [Y/n/a/s/q/?]: n

  [3/4] blueprints.yaml:36  help:
     Allow cross-origin requests to webhook endpoints
   Translate? [Y/n/a/s/q/?]: a

  3 accepted, 1 skipped
```

The available actions:

| Key | Action                                               |
|-----|------------------------------------------------------|
| `y` | Yes — translate this one (default)                   |
| `n` | No — leave hardcoded                                 |
| `a` | Yes to all remaining in this plugin                  |
| `s` | Skip all remaining in this plugin                    |
| `q` | Quit this plugin entirely (apply no changes)         |
| `?` | Show this help                                       |

When auditing across multiple plugins, `q` only quits the current plugin —
the next plugin will still prompt fresh.

### Filtering data-shaped values

The classifier deliberately skips a few patterns that look like data, not
user-facing text — these are still listed under `identifier` in totals but
won't show up as hardcoded:

- URLs (`https://example.com`, `mailto:a@b.com`)
- Email addresses (`user@example.com`)
- Filenames (`logo.svg`, `theme.css`, `app.js`, …)
- Phone-shaped strings (`+1 (555) 123-4567`)
- API key sentinels with runs of `xxxx`
- CSS class lists (multi-token all-lowercase-hyphen, no capitals)
- Pure punctuation/symbols (`===`, `---`)

A value is only skipped if the **entire** string matches a non-translatable
pattern. Sentences that *contain* a URL or filename ("For example: myimage.jpg")
remain translatable.

### How keys and prefixes are chosen

The command picks the plugin prefix in this order:

1. If the plugin has an existing `languages/en.yaml`, it uses whatever
   top-level `PLUGIN_*` (or `THEME_*`) key it finds there. This preserves
   the convention you've already established.
2. Otherwise it derives one from the directory name —
   `editor-pro` → `PLUGIN_EDITOR_PRO`, `quark2` → `THEME_QUARK2`. The
   `PLUGIN_` vs `THEME_` choice depends on whether the path is under
   `user/plugins/` or `user/themes/`.

Each unique hardcoded value gets a key derived from its content
(`"Default for All Users"` → `DEFAULT_FOR_ALL_USERS`). Long values are
truncated at the last underscore boundary, capped at 40 characters by
default. Override with `--key-length=N` (minimum 10) if you want longer or
shorter:

[codesh=bash]
bin/plugin devtools i18n-blueprints user/plugins/foo --fix --key-length=30
[/codesh]

If two different values would produce the same key, the second gets a `_2`
suffix (and so on). Existing keys in your lang file are reused when both
the key *and* its value match — so re-running `--fix` after editing
translations is idempotent.

### Targeting Admin2 with `--icu`

By default, generated keys go under the legacy top-level prefix
(`PLUGIN_FOO:`), so they work on both Grav 1 and Grav 2 admins. For
plugins that only target Grav 2.0 / Admin2, add `--icu` to emit them
under the `ICU.` block instead, unlocking ICU MessageFormat features:

[codesh=bash]
bin/plugin devtools i18n-blueprints user/plugins/my-plugin --fix --icu
[/codesh]

The output then looks like:

[codesh=yaml]
ICU:
  PLUGIN_MYPLUGIN:
    DEFAULT_FOR_ALL_USERS: "Default for All Users"
    EDITOR_CONFIGURATION: "Editor Configuration"
[/codesh]

> [!TIP]
> If your plugin needs to support both Grav 1.7 and Grav 2.0 from one release,
> run without `--icu` first (so the keys live in the legacy block where Grav 1
> can find them), then later add a parallel `ICU:` block by hand for any keys
> you want to enrich with placeholders or plural rules.

### JSON output

For tooling integration, `--json` emits a machine-readable summary instead
of the table:

[codesh=bash]
bin/plugin devtools i18n-blueprints --json
[/codesh]

## Background

This scheme was introduced for Grav 2.0 to address long-running community
requests for proper plural / context support in admin translations
([getgrav/grav#4064][issue4064], building on [#2947][issue2947]). The dictionary
shape of the existing Grav 1 system worked well enough for English but forced
unnatural translations in many other languages. The `ICU.` namespace lets the
ecosystem move forward at its own pace, plugin by plugin, without breaking
anything that already works.

[icu]: https://unicode-org.github.io/icu/userguide/format_parse/messages/
[icu-tools]: https://formatjs.github.io/docs/core-concepts/icu-syntax
[issue4064]: https://github.com/getgrav/grav/issues/4064
[issue2947]: https://github.com/getgrav/grav/issues/2947
[devtools]: https://github.com/getgrav/grav-plugin-devtools
