---
title: Updating Grav & Plugins
taxonomy:
    category: docs
---

The preferred method for keeping Grav, Plugins and Themes up to date is to use the **Grav Package Manager (GPM)**. Full information can be found in the [Grav GPM Documentation](../../advanced/grav-gpm).

We also have **GPM** integrated into our [Administration Panel](../../admin-panel) plugin which will check, prompt, and automatically install any updates.

### Which version do I have?

There are multiple ways to find out which version of Grav and plugins the site is using:

* **Admin Panel**: Version of Grav is listed in a footer of any page. Plugin and theme versions can be found from their own sections.
* **CLI**: Run command `bin/gpm version grav`. To get list of theme and plugin versions, you can list them by their names.
* **Filesystem**: Easiest way to see the version is to look for `CHANGELOG.md` file in the root of the Grav installation. Same is true for plugins and themes, they can usually be found in `user/plugins` and `user/themes` folders.

### Upgrading from Grav 1.5 or older version

Updating an older version of Grav may need some extra preparations and work because of the increased minimum requirements and potential incompatibilities.

The basic workflow is following:

- Copy the site to a server with **PHP 7.3** and **CLI** support
- Upgrade manually **to Grav 1.6.31**
- Upgrade to the latest version

A detailed guide **[Upgrading from Grav <1.6](/advanced/grav-development/grav-15-upgrade-guide)** should help you in the process.

### Upgrading to the Next Version

For upgrading to the next version, there are special guides to help you to make sure everything still works after upgrade.

- **[Upgrading to Grav 1.7](/advanced/grav-development/grav-17-upgrade-guide)**
- **[Upgrading to Grav 1.6](/advanced/grav-development/grav-16-upgrade-guide)**

! **NOTE:** It is recommended to read the upgrade guides before you install the next version of Grav.

### Grav CMS Updates

The preferred method for updating Grav is to use the **Grav Package Manager (GPM)**. All you need to do  is to navigate to the root of your Grav site and type:

[prism classes="language-bash command-line"]
bin/gpm selfupgrade -f
[/prism]

!!! **TIP:** More information about the command can be found from [GPM Command > Self-upgrade](/cli-console/grav-cli-gpm#self-upgrade).

### Plugin and Theme Updates

Plugins and Themes can be kept up to date by running following command from the root of your Grav site:

[prism classes="language-bash command-line"]
bin/gpm update
[/prism]

!!! **TIP:** More information about the command can be found from [GPM Command > Update](/cli-console/grav-cli-gpm#update).
