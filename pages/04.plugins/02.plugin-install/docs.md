---
title: Plugin Installation
taxonomy:
    category: docs
---

## Installation

Installing a plugin can be done in one of three ways:

- The **GPM** (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command.
- The **manual** method lets you do so via a zip file.
- The **admin** method lets you do so via the Admin Plugin.

The plugin should let you know the **_NAME_ to be used** in the following steps.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system’s terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

[prism classes="language-sh"]
bin/gpm install NAME
[/prism]

This will install the plugin into your `/user/plugins` directory within Grav. Its files can be found under `user/plugins/NAME`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `user/plugins/`. Then rename the folder to `NAME`.

You should now have all the plugin files under `user/plugins/NAME`.

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see the file `user/plugins/NAME/blueprints.yaml` for more.

### Admin Plugin

If you use the [Admin Plugin](https://github.com/getgrav/grav-plugin-admin) and the plugin is registered in Grav repository, you can install the plugin directly by browsing the `Plugins` menu and clicking on the `Add` button.
