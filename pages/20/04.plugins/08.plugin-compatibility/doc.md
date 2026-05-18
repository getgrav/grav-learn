---
title: Plugin Compatibility
taxonomy:
    category: docs
---
# Plugin Compatibility

Starting with Grav 2.0, plugins and themes can declare which major Grav versions they are compatible with using the `compatibility:` property in their `blueprints.yaml`. This declaration is read by the **Migrate to Grav 2.0** wizard when bringing existing 1.x sites across, and by **GPM** when installing or updating packages on a 2.0 site.

## The Problem

A major Grav upgrade (e.g., 1.7 → 2.0) may introduce PHP version requirements, API changes, or internal refactoring that breaks plugins. The existing `dependencies:` property only declares minimum requirements; it cannot express "this plugin has been tested and confirmed working on Grav 2.0."

## The `compatibility:` Property

Add a `compatibility:` section to your plugin or theme's `blueprints.yaml`:

[codesh=yaml]
name: My Plugin
slug: my-plugin
type: plugin
version: 2.1.0
description: A great plugin
dependencies:
  - { name: grav, version: '>=1.7.0' }

compatibility:
  grav:
    - '1.7'
    - '2.0'
[/codesh]

The `grav:` key contains a list of major.minor Grav versions the extension has been tested on. Only major.minor versions are used (e.g., `1.7`, `2.0`); patch versions are not relevant here.

The property is nested under a top-level `compatibility:` key to allow future expansion (e.g., `php:` for PHP version compatibility).

## How It Works

The compatibility flag is read at two distinct points: during a 1.x to 2.0 migration, and during plugin install/update operations on a 2.0 site.

### During the 1.x to 2.0 Migration

The **Migrate to Grav 2.0** plugin runs every installed plugin and theme through a compatibility check during its **Step 2 (Copy & Migrate)** wizard pass. For each package the wizard:

1. Reads the `compatibility:` property from the package's `blueprints.yaml`
2. Falls back to inference (see below) if no property is set
3. Compares against the target Grav 2.0 version
4. For 2.0-compatible packages, runs **GPM** to pull the latest 2.0-ready release
5. For incompatible packages, applies the **plugin policy** the user has selected: **Skip** removes the package from the staged install, **Disable** keeps the files in place but writes a config entry that disables the plugin in 2.0

The user also picks between **strict** and **permissive** compatibility modes:

- **Strict** trusts the flags as declared
- **Permissive** promotes inferred-incompatibles to "compatible" so the user can test them on the staged 2.0 site even if their authors haven't formally flagged them yet

Plugins that have been explicitly marked as incompatible always block, in either mode.

The migration runs in a fresh, side-by-side staged install. The user's live 1.x site is untouched until they choose to promote.

### During GPM Installs on a 2.0 Site

Once a site is running Grav 2.0, **GPM** reads the `compatibility:` flag whenever a plugin or theme is installed or updated. A package that doesn't list `2.0` in its compatibility block (either explicitly or via inference) will not install cleanly on a 2.0 site, and the user is told why.

## Inference Rules

If a plugin does not have a `compatibility:` property, Grav infers compatibility from the `dependencies:` array:

| Scenario | Inferred Compatibility |
|----------|----------------------|
| No `compatibility:` and no grav dependency, or grav dependency `< 2.0` (e.g., `>=1.6.0`, `>=1.7.0`, `~1.7`) | `['1.7']` only |
| No `compatibility:` but grav dependency `>= 2.0` (e.g., `>=2.0.0`) | `['2.0']` only |

This means:

- **Existing plugins** without the property are assumed to be compatible with 1.7 only, which prevents untested plugins from running on 2.0 after an upgrade.
- **New plugins** written specifically for 2.0 with a `>=2.0.0` dependency are automatically treated as 2.0-compatible.

> [!TIP]
> The inference is a safety net. For clarity, always add an explicit `compatibility:` property to your blueprints.

## For Plugin Authors

### Adding Compatibility

After testing your plugin on a new Grav version, add it to the `compatibility.grav` list:

[codesh=yaml]
compatibility:
  grav:
    - '1.7'
    - '2.0'
[/codesh]

Then release a new version of your plugin. Users who update the plugin will have the compatibility declaration, and the migration wizard (or GPM, on an already-migrated 2.0 site) will accept it without falling back to the skip-or-disable policy.

### Testing Checklist

Before declaring 2.0 compatibility, verify:

- The plugin installs and enables without errors on Grav 2.0
- All core functionality works as expected
- No PHP deprecation warnings or errors with the PHP version required by Grav 2.0
- Any Composer dependencies are compatible (especially `psr/log` and `monolog` if used)
- Admin panel integration (blueprints, forms) renders correctly

### Relationship to Dependencies

`compatibility:` and `dependencies:` serve different purposes:

| Property | Purpose | Example |
|----------|---------|---------|
| `dependencies:` | Declares minimum requirements to run | `{ name: grav, version: '>=1.7.0' }` |
| `compatibility:` | Declares tested/confirmed Grav versions | `grav: ['1.7', '2.0']` |

A plugin can depend on `>=1.7.0` (it needs at least 1.7 to run) while declaring compatibility with both `1.7` and `2.0` (it has been tested on both). The dependency check ensures the right APIs are available; the compatibility check ensures the plugin has actually been verified to work.

## For Site Administrators

### During the Migration to 2.0

When migrating from Grav 1.x to 2.0 via the **Migrate to Grav 2.0** plugin, the wizard's Step 2 will show:

- **Compatible** packages: kept and updated to their latest 2.0-ready release via GPM.
- **Incompatible** packages: routed through the **plugin policy** you've chosen (**Skip** or **Disable**).

You also choose between **strict** and **permissive** compatibility modes:

- **Strict** is the default. Trusts the `compatibility:` flag and the inference rules as-is.
- **Permissive** promotes inferred-incompatible packages to "compatible" so you can test them on the staged 2.0 site even if their authors haven't formally flagged them yet. Curated explicit incompatibilities still block in either mode.

Because the migration runs as a side-by-side staged install, you can iterate (Reset, Restart, Re-run a step) and try different policy and mode combinations without touching your live 1.x site.

### After Migrating

Once your staged 2.0 site has been promoted and is live:

1. Check for updated versions of any plugins your policy disabled. Authors may have released 2.0-flagged versions since you migrated.
2. Update plugins via GPM: `bin/gpm update`
3. Re-enable disabled plugins one at a time, verifying each works correctly
4. If a plugin causes issues, disable it and contact the plugin author

> [!WARNING]
> Do not re-enable a plugin that hasn't been updated with `compatibility:` for your Grav version unless you have tested it yourself.
