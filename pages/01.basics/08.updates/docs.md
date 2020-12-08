---
title: Updating Grav & Plugins
taxonomy:
    category: docs
---

The preferred method for keeping Grav, Plugins and Themes up to date is to use the **Grav Package Manager (GPM)**. Full information can be found in the [Grav GPM Documentation](../../advanced/grav-gpm).

We also have **GPM** integrated into our [Administration Panel](../../admin-panel) plugin which will check, prompt, and automatically install any updates.

### Upgrading to the Next Version

For upgrading to the next version, there are special guides to help you to make sure everything still works after upgrade.

- **[Grav 1.7 Upgrade Guide](/advanced/grav-development/grav-17-upgrade-guide)**
- **[Grav 1.6 Upgrade Guide](/advanced/grav-development/grav-16-upgrade-guide)**

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
