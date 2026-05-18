---
title: Overview
taxonomy:
    category: docs
---
# Migrating to Grav 2.0

Grav 2.0 is a major version change. The vendor stack (Symfony, Twig, Monolog, and friends) jumps a generation, the minimum PHP version moves to 8.3, and the classic admin is replaced by [Admin 2.0](https://github.com/getgrav/grav-plugin-admin2) running against the new [Grav API plugin](/20/api). Because of all that, **Grav 2.0 is not delivered as an in-place GPM upgrade.** You install Grav 2.0 fresh and import your existing site into it.

This chapter is the reference for that process.

## Two Migration Paths

There are two supported ways to move a site from Grav 1.7 or 1.8 to Grav 2.0:

| Path | When to use | Documentation |
|---|---|---|
| **Assisted** (via the Migrate to Grav 2.0 plugin) | Almost everyone. Standard single-site installs, typical plugin and theme mixes, default folder layout. | [Assisted Migration to Grav 2.0](../02.assisted-migration) |
| **Manual** | Multisite, complex symlink layouts, externally-mounted `user/` folders, sites running custom plugins that haven't been ported yet, or anything else the wizard's assumptions don't fit. | [Manual Migration to Grav 2.0](../03.manual-migration) |

Both paths work the same way: stage a fresh Grav 2.0 install alongside the existing 1.x site, copy content and configuration across, verify, then promote. The plugin automates each step and adds a guided wizard. The manual path performs the same steps by hand so you stay in control of every decision.

> [!IMPORTANT]
> Whichever path you take, **your live 1.x site is not modified until you choose to promote the staged 2.0 install in its place.** You can iterate, abandon, or re-run as many times as you need.

## Migration Path Summary

```text
Grav 1.7.x    →  Grav 1.7.51  →  Grav 2.0 (fresh install + import)
Grav 1.8 beta              →    Grav 2.0 (fresh install + import)
```

`1.7.51` is the final stable release in the 1.7 series. It remains supported and continues to receive critical security fixes for the foreseeable future. There is **no fixed deadline** to migrate.

## What the Migration Covers

The plugin and the manual procedure both handle the same set of inputs:

- **Pages**: `user/pages/*`. Content format is unchanged between 1.7 and 2.0, so pages copy across without conversion.
- **Configuration**: `user/config/*`. Deprecated keys are flagged with suggested replacements.
- **Languages**: `user/languages/*`.
- **Environment overrides**: `user/env/*`.
- **Data**: `user/data/*` (form submissions, login data, anything plugins persist here).
- **Accounts**: `user/accounts/*` including roles and permissions.
- **Plugins and themes**: handled through the [`compatibility:` blueprint property](/20/plugins/plugin-compatibility). 2.0-flagged packages are pulled fresh from GPM; everything else is either skipped or installed disabled, depending on the policy you choose.

## For Plugin and Theme Developers

If you maintain a plugin or theme, the migration only succeeds for your users if your package is 2.0-ready. Three reference pages cover the work involved:

- **[Plugin Compatibility](/20/plugins/plugin-compatibility)**: declaring the `compatibility:` flag in your `blueprints.yaml` so GPM and the migration wizard will install your package on 2.0.
- **[Plugin API Integration](/20/plugins/plugin-api-integration)**: exposing your plugin's functionality through the [Grav API plugin](/20/api) so Admin 2.0 and external clients can use it.
- **[Admin Translations](/20/plugins/admin-translations)**: adapting your `languages/*.yaml` so labels and help text render correctly in Admin 2.0 (including the optional `ICU.` namespace for plurals and placeholders).

For a deeper technical reference of everything that has changed under the hood (PHP 8.3 requirements, Symfony 7, Twig 3, Monolog 3, the classic admin removal), see the [Developer Upgrade Guide](../05.developer-upgrade-guide).

And for the work of actually porting code from 1.x to 2.0, the [AI-Assisted Development](../04.ai-assisted-development) page documents the Claude Code Skills that automate most of the boilerplate.

## Troubleshooting

Common issues, lock conflicts, partial-promote recovery, and the compatibility flag fallback rules are collected on the [Troubleshooting](../06.troubleshooting) page.

## Coming from Another CMS?

If you're not migrating from an existing Grav site but from another platform, the [Migrating to Grav](../07.migrating-to-grav) section covers imports from **Drupal 7** and **WordPress**.
