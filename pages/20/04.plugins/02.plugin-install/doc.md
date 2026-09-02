---
title: Plugin Installation
taxonomy:
    category: docs
---
# Plugin Installation

A plugin can be installed in one of three ways:

- The **GPM** (Grav Package Manager) method installs the plugin with a single terminal command, and resolves its dependencies for you. This is the one to use unless you have a reason not to.
- The **admin** method installs it from the Plugins screen in [Admin Next](/20/admin-panel).
- The **manual** method installs it from a zip file, for plugins that are not in the Grav repository.

The plugin should tell you the **_NAME_** to use in the steps below. That name is the plugin's slug, e.g. `admin2`, `form`, `login`.

## GPM Installation (preferred)

From the root of your Grav install, run:

[codesh=bash]
bin/gpm install NAME
[/codesh]

The plugin lands in `user/plugins/NAME`. If it declares dependencies, GPM lists them and asks once before installing those too, so you rarely need to install a chain by hand. For example `bin/gpm install admin2` also brings in `api`, `login`, `form`, `email` and `shortcode-core`.

Useful companions:

[codesh=bash]
bin/gpm index                # every package available, with the version you have installed
bin/gpm index -i             # only the ones you already have
bin/gpm info NAME            # what a package is, what it needs, and which version is current
bin/gpm update               # update everything that has a newer release
bin/gpm update NAME          # update just one
bin/gpm uninstall NAME       # remove it, warning about anything that depends on it
[/codesh]

> [!NOTE]
> `bin/gpm` needs the PHP `zip` extension and outbound network access. On a host that blocks either, use the manual method below.

## Admin Installation

In [Admin Next](/20/admin-panel), go to **Plugins** in the sidebar and click **Add**. Search for the plugin, then click its **Install** button. Dependencies are handled the same way as on the command line, and you will be asked to confirm them.

The Plugins screen is also where you enable, disable, configure and update a plugin after it is installed.

## Manual Installation

Download the plugin's zip file and unpack it into `user/plugins/`, then rename the folder to the plugin's name so you end up with `user/plugins/NAME`.

Check `user/plugins/NAME/blueprints.yaml` afterwards. Its `dependencies` block lists anything else the plugin needs, and installing manually does not fetch those for you. Its `compatibility` block tells you which Grav versions the plugin supports.

> [!WARNING]
> A plugin written for Grav 1.x will not necessarily work on Grav 2.0, and one that hooks into the classic admin panel definitely will not. See [Plugin Compatibility](/20/plugins/plugin-compatibility) for what changed and how to tell.

## Clearing the cache

After any install method, clear the cache so Grav picks the plugin up:

[codesh=bash]
bin/grav clear
[/codesh]
