---
title: Plugin Compatibility
taxonomy:
    category: docs
---
# Plugin Compatibility

Starting with Grav 2.0, plugins and themes can declare which major Grav versions they are compatible with using the `compatibility:` property in their `blueprints.yaml`. This allows the upgrade system to verify that all installed extensions are ready before performing a major version upgrade.

## The Problem

A major Grav upgrade (e.g., 1.7 → 2.0) may introduce PHP version requirements, API changes, or internal refactoring that breaks plugins. The existing `dependencies:` property only declares minimum requirements — it cannot express "this plugin has been tested and confirmed working on Grav 2.0."

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

The `grav:` key contains a list of major.minor Grav versions the extension has been tested on. Only major.minor versions are used (e.g., `1.7`, `2.0`) — patch versions are not relevant here.

The property is nested under a top-level `compatibility:` key to allow future expansion (e.g., `php:` for PHP version compatibility).

## How It Works During Upgrades

When a user initiates a major Grav upgrade through the Admin panel, the **Safe Upgrade** preflight checks will:

1. Scan all installed plugins and themes
2. Read the `compatibility:` property from each package's `blueprints.yaml`
3. Compare against the target Grav version
4. **Block the upgrade** if any **enabled** plugin or theme is not compatible
5. **Warn** (but not block) about **disabled** packages that are not compatible

The user is presented with a list of incompatible extensions and can choose to **disable** them directly from the upgrade screen before proceeding.

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

Then release a new version of your plugin. Users who update the plugin will have the compatibility declaration, and the upgrade gate will allow them to proceed.

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

### During a Major Upgrade

When upgrading Grav to a new major version, the Admin panel's Safe Upgrade screen will show:

- **Blocking** — Enabled plugins/themes not compatible with the target version. You must disable these before the upgrade can proceed. A "Disable" button is provided for each.
- **Warnings** — Disabled plugins/themes not compatible with the target version. These won't block the upgrade, but you should verify compatibility before re-enabling them.

### After Upgrading

Once on the new Grav version:

1. Check for updated versions of your disabled plugins — authors may have released compatible versions
2. Update plugins via GPM: `bin/gpm update`
3. Re-enable plugins one at a time, verifying each works correctly
4. If a plugin causes issues, disable it and contact the plugin author

> [!WARNING]
> Do not re-enable a plugin that hasn't been updated with `compatibility:` for your Grav version unless you have tested it yourself.
