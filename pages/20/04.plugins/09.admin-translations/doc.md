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
