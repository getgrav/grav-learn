---
title: GPM Submission
page-toc:
  active: true
taxonomy:
    category: docs
---
# GPM Submission

When you have created a new plugin and would like to see it added to the [Grav Repository](https://getgrav.org/downloads) so it can be installed via **GPM** and the **Admin** interface, there are a few standard things you need to ensure. This page is in two parts: first, **publishing the plugin** to GPM, and second, **maintaining it** once it's listed — releasing updates and the protocol for taking over abandoned plugins. If you are publishing a theme, see the [themes version of this page](../../themes/gpm-submission) instead, which also covers packaging a full demo site as a skeleton.

## Part 1: Publishing Your Plugin

### Plugin Requirements

A proper Grav plugin requires certain files in order to function properly, be listed in the Grav repository, and be visible in the Grav admin. Please ensure your plugin contains all these files:

* **yourplugin.php** - plugin PHP file that should be named the same as the folder
* **yourplugin.yaml** - plugin configuration file that contains any options and stream inheritance information
* **blueprints.yaml** - plugin definition file and form definition file
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the plugin
* **LICENSE** - license file, probably MIT if in line with Grav core
* **languages.yaml** (optional) - a language definition file

Unlike themes, plugins do **not** need `screenshot.jpg` or `thumbnail.jpg` images — a plugin is represented visually by the Font Awesome `icon:` declared in its `blueprints.yaml`, both on getgrav.org and in the Admin plugin listing.

### The blueprints.yaml File

The `blueprints.yaml` in the root of your plugin is what GPM and the Admin interface read to present your plugin. A real-world example, from the **Breadcrumbs** plugin:

[codesh=yaml]
name: Breadcrumbs
type: plugin
slug: breadcrumbs
version: 1.6.3
description: The **Breadcrumbs** plugin provides a simple method to display the depth of your content/navigation structure.
icon: caret-square-o-right
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-breadcrumbs
demo: https://demo.getgrav.org/blog-skeleton
keywords: breadcrumbs, plugin, navigation, depth
bugs: https://github.com/getgrav/grav-plugin-breadcrumbs/issues
license: MIT
compatibility:
  grav: ['1.7', '2.0']

dependencies:
  - { name: grav, version: '>=1.7.0' }
[/codesh]

The `name`, `slug`, `type`, `version`, `description`, `author`, and `license` fields are required for GPM listing. See [Blueprints](../../forms/blueprints) for the full field reference, including the `form:` section that defines your plugin's configuration options in the Admin interface.

> [!NOTE]
> Plugins targeting Grav 2.0 should declare a `compatibility:` section so GPM and the migration wizard know which major Grav versions the plugin supports. See [Plugin Compatibility](../plugin-compatibility) for details.

### Release Process

When your plugin is ready to be added to the repository, work through this checklist:

1. It is open source with a `LICENSE` file that provides an [MIT](http://en.wikipedia.org/wiki/MIT_License) compatible license. [Example Here](https://github.com/getgrav/grav-plugin-breadcrumbs/blob/develop/LICENSE)
2. Contains a `README.md` file with a summary of functionality and instructions on how to install and configure it. [Example Here](https://github.com/getgrav/grav-plugin-breadcrumbs/blob/develop/README.md)
3. Contains a `blueprints.yaml` file with [all required fields](../../forms/blueprints). [Example Here](https://github.com/getgrav/grav-plugin-breadcrumbs/blob/develop/blueprints.yaml)
4. Provides a `CHANGELOG.md` in the [correct format](#changelog-format). [Example Here](https://github.com/getgrav/grav-plugin-breadcrumbs/blob/develop/CHANGELOG.md)
5. Provides appropriate attribution if you use any other libraries, scripts, code.
6. [Create a release](https://docs.github.com/en/repositories/releasing-projects-on-github) for your finished plugin. The Grav repository system requires a release and will not find your plugin unless there is a release that contains all of the above.
7. [Add an issue to the Grav issues tracker](https://github.com/getgrav/grav/issues/new?title=[add-resource]%20New%20Plugin/Theme&body=I%20would%20like%20to%20add%20my%20new%20plugin/theme%20to%20the%20Grav%20Repository.%0AHere%20are%20the%20project%20details:%20**user/repository**) with details about your plugin, and we will give it a quick test to ensure it functions, and then add it.

### ChangeLog Format

The GetGrav.org site uses a custom ChangeLog format that is written in standard markdown but can be manipulated with some simple CSS and [displayed in an attractive format](https://getgrav.org/downloads#changelog). In order to ensure your ChangeLogs can be parsed and formatted properly, please use this syntax:

[codesh=markdown line-numbers="true"]
# X.Y.Z
## 2015-01-01

1. [](#new)
    * New features added
    * Another new feature
2. [](#improved)
    * Improvement made
    * Another improvement
3. [](#bugfix)
     * Bugfix implemented
     * Another bugfix

...repeat...
[/codesh]

Each section `#new, #improved, #bugfix` are optional, just include the sections you need.

> [!TIP]
> Versions can be either `vX.Y.Z` or `X.Y.Z`, just ensure they are consistent between releases. Make sure you have the version with `#` and the date with `##`, each on its own line, and an empty line between those headers and the lists below them. Also make sure you indent your bullet items the same amount.

> [!NOTE]
> **Use the ISO `YYYY-MM-DD` date format.** It is the only format that cannot be misread. The **American** `MM/DD/YYYY` and **European** `DD-MM-YYYY` formats are also accepted, and most existing changelogs use them, but be aware that the **separator alone** decides how a date is read, no matter which order you intended: a slash (`/`) means American month-first, and a dash (`-`) or dot (`.`) means European day-first. See [date formats](../../content/headers#date) for the same rule as it applies to page headers.

> [!WARNING]
> Because the separator decides, a day-first date written with slashes is read month-first. Most of the time that is caught, since a value above 12 cannot be a month, so `13/08/2026` is still understood as 13 August. But when both numbers are 12 or lower nothing looks wrong: `11/08/2026` is read as 8 November rather than 11 August, and no warning is raised. Writing dates as `YYYY-MM-DD` avoids the whole problem.

### Demo Content

You are able to provide demo content as part of a plugin package. This means that anything found in a folder called `_demo/` will be copied over to the `user/` folder as part of the installation procedure. This means you can provide **pages**, or **configuration** or anything else that sits in the `user/` folder. The user is prompted to do this, and it's purely optional.

_Please note that demo content is not copied when your plugin is installed via the `Admin` interface._

## Part 2: Updates and Maintenance

### Releasing Updates

Once your plugin is in the repository, you do **not** need to open an issue for new versions. Bump the `version:` in `blueprints.yaml`, add a matching `CHANGELOG.md` entry, and publish a new GitHub release — GPM picks it up automatically and users see the update in Admin and via `bin/gpm update`.

> [!WARNING]
> Ensure your **naming for each tag is consistent**. GPM uses this information to determine if your plugin is newer than the last. We recommend using [Semantic Version Numbers](http://semver.org/) for tags. E.g. `1.2.4`. Consistency for all tags is paramount — mixing `v1.2.4` and `1.2.5` styles will break update detection!

### Abandoned Resource Protocol

People move on, and user-generated content like plugins may become abandoned. If you wish to take over the maintenance of an existing plugin, you must follow this protocol:

1. Submit a well-formed, tested pull request to the original repository.

2. If the maintainer does not respond *at all* after 30 days, or if the maintainer states that they are abandoning the resource and are not willing to grant someone else write access, then proceed to the next step.

3. [Submit a new issue to Grav's GitHub repository](https://github.com/getgrav/grav/issues/new?title=%5Bchange-resource%5D%20Take%20over%20Plugin%2FTheme&body=I%20would%20like%20to%20take%20over%20an%20existing%20plugin%2Ftheme.%0AHere%20are%20the%20project%20details%3A%20%2A%2Auser%2Frepository%2A%2A) with the following details:

  * Title: `[change-resource] Take over plugin/theme`

  * Provide the name of the plugin and link to the original repository.

  * Link to your pull request that went unanswered or a link to the conversation in which the maintainer has abandoned the resource.

4. The Grav maintainers will review the case and let you know if the takeover is approved. If approval is granted, proceed to the next step.

5. Prepare your forked repository with a new release.

6. Add a note to the README that this repository is the new master and link back to the old repository.

7. Reply to the issue, giving the maintainers the new URL for the plugin.

8. The maintainers will update GPM and new and updated installs will now come from your forked repository.
