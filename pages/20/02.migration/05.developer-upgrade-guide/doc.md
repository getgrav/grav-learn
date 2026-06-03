---
title: Developer Upgrade Guide
page-toc:
    active: true
taxonomy:
    category: docs
last_checked: 2.0.0
---
# Grav 2.0 Developer Upgrade Guide

This page is a developer-focused reference for what has changed under the hood between Grav 1.7 and Grav 2.0. If you maintain a plugin, theme, or custom integration, this is the page that tells you what you need to update.

For the end-user migration process itself (moving an existing site from 1.7 or 1.8 to a fresh 2.0 install), see [Assisted Migration](../02.assisted-migration) and [Manual Migration](../03.manual-migration). For agent-assisted porting workflows, see [AI-Assisted Development](../04.ai-assisted-development).

> [!IMPORTANT]
> Grav 2.0 is **not** delivered as an in-place upgrade. The minimum PHP version, the vendor stack, the admin, and the public API all change at the same time. The supported path is a fresh install plus content import. This page documents the technical reasons for that, and what each underlying change means for plugin and theme authors.

## Highlights

- **PHP 8.3 minimum**, with full support for **PHP 8.4 and 8.5**
- **Symfony 7.x** components (was 4.4)
- **Twig 3.x** (forked for Defer compatibility)
- **Monolog 3.x** (was 1.25)
- **Symfony Cache** replaces Doctrine Cache
- **Classic admin removed**, replaced by **Admin 2.0** (a SvelteKit SPA running against the new API plugin)
- **First-party REST API** as a core component
- **`compatibility:` blueprint flag** for plugins and themes
- **Quark 2** is the new default theme
- **Twig content sandbox** for editor-authored Twig in page content, with an `onBuildTwigSandboxPolicy` event for plugins
- **Native `.env` support** built into the core, so the DotEnv plugin is no longer needed (see [Configuration](/20/basics/grav-configuration#environment-variables-and-env-files))

## Critical Breaking Changes

### PHP Version Requirement

- **Minimum PHP: 8.3+** (was 7.3.6+ in Grav 1.7)
- Ensure your hosting environment supports PHP 8.3 or higher
- Update any deprecated PHP code in custom plugins or themes
  - Check for nullable parameter declarations (`?Type` instead of `Type = null`)
  - Update dynamic properties usage (PHP 8.2+ deprecates undeclared dynamic properties)
  - Replace deprecated functions and signatures

### The Classic Admin Is Gone

The classic Twig-rendered admin (the `admin` plugin as it existed in 1.x) has been removed from Grav 2.0 entirely. Its replacement is **[Admin 2.0](https://github.com/getgrav/grav-plugin-admin2)**, a SvelteKit SPA that runs against the new [Grav API plugin](/20/api).

For plugin authors this is the single biggest change:

- **Custom admin pages** rendered through admin-classic's Twig templates no longer have a runtime. You'll need to port them to Admin 2.0's component system. See [Plugin Admin Next Integration](/20/plugins/plugin-api-integration) for the patterns.
- **Admin sidebar items, menubar buttons, floating widgets, custom field types, custom reports** are all registered through `onApi*` events in Admin 2.0. The old `onAdmin*` events are gone.
- **Blueprints carry over.** All your existing form fields and blueprints work as-is in Admin 2.0; only the admin UI shell has changed.

If your plugin has no custom admin UI (just blueprints), nothing changes for you on this front. Your config pages will render correctly in Admin 2.0.

### Removed Cache Drivers

These unsupported drivers have been removed. Supported adapters (APCu, Memcached, Redis, Array, Filesystem, etc.) are handled by Symfony Cache with the same names. Grav falls back to `filesystem` if it cannot resolve a custom adapter:

- `APC` → use `apcu`
- `WinCache` → removed
- `XCache` → removed
- `Memcache` → use `memcached`

### Removed System Settings

- `system.umask_fix` removed for security reasons
- Various deprecated keys flagged by the migration tool with suggested replacements

## Dependency Updates

### Core Dependencies

| Dependency | Grav 1.7 | Grav 2.0 |
|---|---|---|
| PHP | 7.3.6+ | 8.3+ |
| Twig | 1.x | 3.x (forked for Defer) |
| Symfony | 4.4 | 7.x |
| Monolog | 1.25 | 3.x |
| RocketTheme/Toolbox | 1.0 | 2.0 |

### Removed

- Doctrine Cache (replaced with Symfony Cache)
- Legacy cache drivers (APC, WinCache, XCache, Memcache)

## Twig 3 Migration

Twig 1 and Twig 2 syntax that is no longer valid in Twig 3 needs to be updated. Grav 2.0 includes runtime compatibility toggles, but the recommendation is to update templates permanently rather than rely on the transforms.

Enable the compatibility layer while you migrate:

```yaml
system:
  strict_mode:
    twig2_compat: true    # Twig 2 compatibility
    twig3_compat: true    # Twig 3 compatibility
```

Once your templates are updated, disable these toggles and clear the cache to confirm everything renders without the compatibility layer.

### Loop Filters

`for` loops with inline `if` guards must filter the sequence first:

```twig
{# Legacy #}
{% for page in collection if page.published %}
    {{ page.title }}
{% endfor %}

{# Twig 3 #}
{% for page in collection|filter(page => page.published) %}
    {{ page.title }}
{% endfor %}
```

### `spaceless` and `filter` Blocks

Twig 3 removed `{% spaceless %}` and `{% filter %}` blocks. Use `{% apply %}`:

```twig
{# Legacy #}
{% spaceless %}
    <div>{{ content|raw }}</div>
{% endspaceless %}

{# Twig 3 #}
{% apply spaceless %}
    <div>{{ content|raw }}</div>
{% endapply %}
```

### `sameas` Test

Use `is same as` instead of `is sameas`:

```twig
{% if theme is same as('my-theme') %}
```

### `replace` Filter Signature

Twig 3 expects a map instead of two string arguments:

```twig
{{ title|replace({'_': ' '}) }}
```

## Twig Content Sandbox

Grav 2.0 runs editor-authored Twig in **page content** through a security sandbox. This only applies to content (`process.twig` on a page, and string templates rendered via `Twig::processString()`). Theme and plugin **template files** on disk are trusted and are never sandboxed, so nothing changes for normal `.html.twig` development.

Inside the sandbox, only an allow-list of tags, filters, functions, methods, and properties is permitted. The defaults live in `system/config/security.yaml` under `twig_sandbox`. If your plugin registers a Twig function, filter, or tag that authors are meant to call from page content, the sandbox blocks it by default, because it has no way to know the member is safe to run against untrusted input.

### Allowing your plugin's Twig members

Subscribe to the `onBuildTwigSandboxPolicy` event and append to the relevant list. The event hands you the same lists used in `security.yaml`: flat lists for `tags`, `filters`, and `functions`, and a list of `class`/`methods` rows for `methods` and `properties`.

```php
use RocketTheme\Toolbox\Event\Event;

public static function getSubscribedEvents(): array
{
    return [
        'onBuildTwigSandboxPolicy' => ['onBuildTwigSandboxPolicy', 0],
    ];
}

public function onBuildTwigSandboxPolicy(Event $event): void
{
    // Allow this plugin's Twig function inside sandboxed page content.
    $functions = $event['functions'];
    $functions[] = 'unite_gallery';
    $event['functions'] = $functions;

    // Allow specific methods on one of the plugin's own classes (same
    // structure as security.yaml: a list of class/methods rows).
    $methods = $event['methods'];
    $methods[] = ['class' => \Grav\Plugin\MyGallery\Gallery::class, 'methods' => 'render, thumbnail'];
    $event['methods'] = $methods;
}
```

The read-modify-write pattern is required because the event arguments are returned by value. The event fires only when the policy is built (once per request and cached), so registering members here has no per-render cost.

!! Only allow members that are safe to run against content authored by anyone with page-edit access. Registering a member here is the same trust decision as exposing it in the first place. If a function reads files, evaluates strings, or reaches into the container, leave it off the list.

A site administrator can also allow a function without touching plugin code by adding it to `user/config/security.yaml`, which merges on top of the defaults:

```yaml
twig_sandbox:
  allowed_functions:
    - unite_gallery
```

### Calling PHP functions from templates: `undefined_functions` removed

Grav 1.7 let a template call almost any PHP function by name, because `system.twig.undefined_functions` (and `undefined_filters`) defaulted to **on**. Grav 2.0 removes that auto-allow. Calling a PHP function that Grav or a plugin has not registered is now a hard error, in trusted templates as well as in sandboxed page content.

The `safe_functions` / `safe_filters` allow-lists remain as an **explicit opt-in**, empty by default. List the specific functions a trusted template needs:

```yaml
system:
  twig:
    safe_functions:
      - strtoupper
      - basename
    safe_filters:
      - md5
```

Command and code-execution functions (`system`, `exec`, `assert`, and the like) are always refused and can never be added to these lists. The allow-lists apply only to trusted templates; editor-authored page content is governed by the [Twig content sandbox](#twig-content-sandbox) instead.

Most common cases already have a Twig or Grav equivalent, for example the `upper` filter in place of `strtoupper`. You can also register a function in PHP through `onTwigExtensions`:

```php
public function onTwigExtensions(): void
{
    $this->grav['twig']->twig()->addFunction(
        new \Twig\TwigFunction('basename', 'basename')
    );
}
```

## Monolog 3 Migration

The `addInfo()`, `addError()`, etc. methods on the logger have been removed in Monolog 3. Use the PSR-3 method names instead. These also work on Monolog 2.3+ if your code targets both:

```php
// Old (Monolog 1.x)
$this->grav['log']->addInfo($message);
$this->grav['log']->addError($message);

// New (compatible with Monolog 2.3+ and 3.x)
$this->grav['log']->info($message);
$this->grav['log']->error($message);
```

### PSR-3 Logging Conflicts

If your plugin ships its own `vendor/` folder or `composer.json` and pins `psr/log` to an older 1.x release, Composer will install an incompatible version that breaks Grav's Monolog 3 handler expectations. You'll see errors like:

```
Return type must be compatible with Psr\Log\LoggerInterface
```

To resolve:

- Remove the explicit `psr/log` requirement from your extension, or
- Prefer Grav's bundled version by adding a `replace` block to your `composer.json`:

```json
"replace": {
    "psr/log": "*"
}
```

- Delete the plugin's `vendor/` directory after updating `composer.json` and rebuild it with `composer install`.

The `bin/gpm preflight` command flags this issue under **PSR/log compatibility** warnings; resolve them before migration.

## Symfony 7

Symfony components are now on the 7.x line (was 4.4). For most plugin code this is invisible, but watch for:

- Event subscriber signatures (`getSubscribedEvents()` return types)
- Console command argument/option declarations
- Container service definitions in custom plugins
- Removed deprecations from the 4.x → 7.x range

If you use Symfony's DI container, console, or event dispatcher directly, review the [Symfony UPGRADE guides](https://github.com/symfony/symfony/blob/7.x/UPGRADE-7.0.md) for the components you depend on.

## API and Admin 2.0 Integration

Grav 2.0 introduces a first-party REST API as a core component, packaged as the [Grav API plugin](/20/api). Admin 2.0 is the first client of this API, but it is fully general: anything Admin 2.0 can do, an external client can do through the same endpoints.

For plugin authors there are two integration points:

### Adding API Endpoints

If your plugin exposes data or operations that should be accessible to Admin 2.0 or external clients, register endpoints through the `onApiRegisterRoutes` event. Controllers extend `AbstractApiController` and get authentication, permissions, request parsing, and error handling for free.

See [Plugin API Integration](/20/plugins/plugin-api-integration) for the full pattern.

### Admin 2.0 UI

If your plugin previously had admin-classic UI, the replacement story lives in the broader Admin Next integration guide. The relevant `onApi*` event hooks register sidebar items, menubar buttons, floating widgets, plugin pages, custom field types, custom reports, and blueprint modifications.

The `grav-api-admin-next-integration` Claude Code Skill ([AI-Assisted Development](../04.ai-assisted-development)) documents the full set.

## The `compatibility:` Blueprint Flag

Plugins and themes now declare which major Grav versions they have been tested on:

```yaml
compatibility:
  grav:
    - '1.7'
    - '2.0'
```

This is read by:

- The **migration wizard** during a 1.x → 2.0 migration (to decide what to install on the staged 2.0 site)
- **GPM** on a 2.0 site (to refuse to install packages not flagged for the running Grav version)

Without an explicit `compatibility:` block, Grav infers from the `dependencies:` array. A plugin requiring `grav >= 1.7` is assumed to be 1.7-only; one requiring `grav >= 2.0` is assumed to be 2.0-only.

**Action for plugin authors:** after testing your plugin on Grav 2.0, add `'2.0'` to the `compatibility.grav` list and release a new version.

See [Plugin Compatibility](/20/plugins/plugin-compatibility) for the full rules and inference logic.

## Admin Translations and the `ICU.` Namespace

Admin 2.0 extends Grav's existing language pipeline with an opt-in **ICU MessageFormat** layer for placeholders, plurals, and select cases. Keys prefixed with `ICU.` go through the formatter; keys without the prefix are returned raw, exactly as in classic admin.

This means a single language YAML can target both 1.7 and 2.0:

```yaml
PLUGIN_MY_PLUGIN:
    ITEMS_COUNT: "{count} items"           # flat: both versions read this
ICU:
    PLUGIN_MY_PLUGIN:
        ITEMS_COUNT: "{count, plural, one {# item} other {# items}}"
```

Grav 1.7 ignores the top-level `ICU:` block entirely. Admin 2.0 prefers it.

See [Admin Translations](/20/plugins/admin-translations) for full details, including the disabled-plugin filter and the audit tooling.

## Code Quality Improvements

The Grav 2.0 codebase has been raised to:

- **PHPStan level 6** support in Framework classes
- PHP 8.4 compatibility throughout
- Stricter type declarations
- Improved error handling

Plugins that rely on loose typing or undeclared dynamic properties may produce warnings or fatals where they previously did not.

## Migration Path Recap

The end-user migration process is documented in detail elsewhere. The short version:

1. Take a backup of the existing Grav 1.7 or 1.8 site
2. Install the [Migrate to Grav 2.0 plugin](https://github.com/getgrav/grav-plugin-migrate-to-2)
3. Run the wizard (or follow the [Manual Migration](../03.manual-migration) procedure)
4. Verify the staged 2.0 install
5. Promote when ready

The wizard handles the `compatibility:` flag check, GPM installs, content copy, and the swap. The 1.x site is untouched until promote.

If your site previously ran a Grav 1.8 beta, the migration path is the same: 1.8 beta → fresh 2.0 install + import. There is no direct upgrade from a 1.8 beta to 2.0; the same migration tool handles both source versions.

## Testing Checklist for Plugin Authors

Before declaring 2.0 compatibility:

- [ ] Plugin installs and enables without errors on a fresh Grav 2.0 install
- [ ] No PHP 8.3+ deprecation warnings or fatals (`error_reporting=E_ALL`)
- [ ] No Twig 3 compatibility-layer warnings (disable `twig2_compat` and `twig3_compat` and check `logs/grav.log`)
- [ ] No Monolog deprecation warnings (no `addInfo()`/`addError()` callers left)
- [ ] No `psr/log` conflicts (`bin/gpm preflight` is clean)
- [ ] Composer dependencies install cleanly with PHP 8.3+
- [ ] Blueprints render correctly in Admin 2.0
- [ ] If the plugin previously had admin-classic UI: equivalent functionality is registered through `onApi*` events for Admin 2.0
- [ ] Language strings render correctly in Admin 2.0 (no humanised fallbacks for keys that exist)
- [ ] `compatibility:` flag in `blueprints.yaml` lists `'2.0'`
- [ ] Plugin works against the migration wizard's dry-run / strict mode

## Troubleshooting

For runtime issues hit during migration itself (PHP version detection, redirect loops on the stage, partial-promote recovery, deprecated config keys), see the [Troubleshooting](../06.troubleshooting) page.

For tooling that automates much of the porting work, see [AI-Assisted Development](../04.ai-assisted-development).

## Getting Help

- [Grav GitHub Issues](https://github.com/getgrav/grav/issues)
- [Migrate to Grav 2.0 plugin issues](https://github.com/getgrav/grav-plugin-migrate-to-2/issues)
- [Discord `#migration` channel](https://chat.getgrav.org)
- [Discourse forum](https://discourse.getgrav.org)

When reporting an issue, include:

- PHP version
- Grav version (source and target)
- Output of `bin/gpm preflight` (if applicable)
- Contents of `.migrating` (if migration was in progress)
- Relevant entries from `logs/grav.log`
- List of installed plugins
