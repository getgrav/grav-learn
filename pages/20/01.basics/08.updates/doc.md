---
title: Updating Grav & Plugins
taxonomy:
    category: docs
---
# Updating Grav & Plugins

The preferred method for keeping Grav, Plugins and Themes up to date is to use the **Grav Package Manager (GPM)**. Full information can be found in the [Grav GPM Documentation](/20/advanced/grav-gpm).

We also have **GPM** integrated into our [Administration Panel](/20/admin-panel) plugin which will check, prompt, and automatically install any updates.

### Which version do I have?

There are multiple ways to find out which version of Grav and plugins the site is using:

* **Admin Panel**: Version of Grav is listed in a footer of any page. Plugin and theme versions can be found from their own sections.
* **CLI**: Run command `bin/gpm version grav`. To get list of theme and plugin versions, you can list them by their names.
* **Filesystem**: Easiest way to see the version is to look for `CHANGELOG.md` file in the root of the Grav installation. Same is true for plugins and themes, they can usually be found in `user/plugins` and `user/themes` folders.

### Migrating from Grav 1.x to 2.0

Grav 2.0 is not an in-place upgrade from 1.x. The minimum PHP version, vendor stack, admin, and API all change, so the supported path is a fresh install plus content import.

See the [Migration](/20/migration) chapter for the full process, including:

- The [Assisted Migration](/20/migration/assisted-migration) workflow via the Migrate to Grav 2.0 plugin
- The [Manual Migration](/20/migration/manual-migration) procedure for complex setups
- The [Developer Upgrade Guide](/20/migration/developer-upgrade-guide) for plugin and theme authors

If you are running Grav 1.5 or older, upgrade through GPM to the final 1.7 release (`1.7.51`) first, then migrate to 2.0 from there.

### Plugin Compatibility Checks

Grav 2.0 introduces a `compatibility:` property in plugin and theme `blueprints.yaml`, declaring which major Grav versions a package has been tested against. The flag is read in two places:

- The **Migrate to Grav 2.0** wizard, when bringing a 1.x site across into a staged 2.0 install. Incompatible packages are routed through the user's skip-or-disable policy, with **strict** and **permissive** mode options for handling unflagged packages.
- **GPM**, when installing or updating plugins on an already-migrated 2.0 site. Packages without a 2.0-compatible flag won't install cleanly.

Plugin authors declare compatibility in their `blueprints.yaml` using the `compatibility:` property. See [Plugin Compatibility](/20/plugins/plugin-compatibility) for full details.

### Grav CMS Updates

The preferred method for updating Grav is to use the **Grav Package Manager (GPM)**. All you need to do  is to navigate to the root of your Grav site and type:

[codesh=bash]
bin/gpm selfupgrade -f
[/codesh]

> [!NOTE]
> **TIP:** More information about the command can be found from [GPM Command > Self-upgrade](/20/cli-console/grav-cli-gpm#self-upgrade).

### Plugin and Theme Updates

Plugins and Themes can be kept up to date by running following command from the root of your Grav site:

[codesh=bash]
bin/gpm update
[/codesh]

> [!NOTE]
> **TIP:** More information about the command can be found from [GPM Command > Update](/20/cli-console/grav-cli-gpm#update).
