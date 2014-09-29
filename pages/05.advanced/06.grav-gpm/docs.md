---
title: Grav GPM
taxonomy:
    category: docs
---

Since version **0.9.2** Grav comes with _GPM_ (Grav Package Manager) which allows to install, update and list all the themes and plugins available on the Grav repository, as well as upgrade Grav itself to the latest version.

Like the [Grav CLI][grav-cli], the _GPM_ is a command line tool which requires to run commands via terminal.

To get started with _GPM_, you can run the following command to get a list of all the available commands:

```bash
$ bin/gpm list
```

To get help for a specific command, you can prepend help to the command:

```bash
$ bin/gpm help install
```

## How does it work

_GPM_ downloads the repository metadata from **getgrav.org**. The repository contains all the details about the packages available and _GPM_ is also capable of determining whether any of these packages are already installed and if they need updating.

The repository itself gets cached locally, on the Grav instance machine running the command, for 24 hours. Any further request after the cache has been generated will not contact the **getgrav.org** server anymore but rather serve from the locally stored repository. This approach guarantees a much quicker response.

Most of the commands (listed below) comes with the option `--force (-f)` which allows to force a re-fetch of the repository. This could come extremely useful in case an update is known to be out there and one wouldn't want to wait a full 24 hour cycle before the cache gets cleared.

## I'm a developer, anything else I should know?

#### Blueprints
With the introduction of _GPM_ we now have strict rules about valid `blueprints`. Whether it's a _theme_ or a _plugin_ you are developing, you should always ensure the `blueprints` are formatted properly.

A blueprint serves different purposes, including defining your resource identity. Please refer to the [Blueprints][blueprints] for an in-depth documentation about what blueprints are and how they should be compiled.

#### Releases
Grav repository refreshes every 2 hours and automatically detects when there are new releases, this implies that as a developer you followed our [Contributing][contributing] requirements.

On your end all you have to do is ensuring you updated the blueprints with the new version and that you tagged and released the new version. Grav repository will do the rest for you and as soon as your release is picked up, it will be available to everyone via Grav website or through _GPM_.

#### Add your resource to the repository
To add your new plugin/theme to the Grav repository, please open a Grav Issue on GitHub. You can also [use this precompiled link][new-resource], make sure you update the body to the proper `user/repository`.

More details in the Issue about what the plugin/theme does are welcome.

Also please be aware that before adding a repository, the Grav team will inspect your plugin/theme ensuring that it fits with the Grav standards.

## Commands

Below are explained all the commands available for _GPM_. To run a command, launch your favorite terminal app and from within the root of your Grav instance you can type `bin/gpm <command>`.

## Index

The `index` command shows a list of all the available resources in the Grav repository, organized by _themes_ and _plugins_.

![](index.jpg)

Each row displays the **name**, **slug**, **version** and whether it's installed already or not.

In this view you can also quickly determine if there is a new version of any of the resource you have already installed.
For instance, if we had a very old version of Antimatter (v1.1.1) but the latest version was v1.1.3, this is how it would show in the index.

![](index-outdated.jpg)

## Info

The `info` command dispays the details of the desired package, such as description, author, homepage, etc.

![](info.jpg)

## Install

The `install` command does exactly what you are thinking. Installs a resource from the repository into your current Grav instance with just a simple command.

The command will also detect if a resource is already installed or if it is symbolically linked and prompts you on what to do.

---install.mov---

You can also install multiple resources at once by just separating the slugs by space

---install-multi.mov---

>>> You can use the option `--all-yes (-y)` to skip any prompts. Existing resources will be overridden and if they are symbolic links will automatically be skipped.

## Update

The `update` command shows a list of updatable resources and works similarly to `install`.

![](update.jpg)

Alternatively you can limit the updates to specific resources only

![](update-limit.jpg)

## Self-upgrade

The `self-upgrade` (or selfupgrade) allows to update Grav to the latest available version. If no upgrade is needed, a message will tell you so, noticing also which version you are currently running and when the release was published.

It is strongly adviced to always do a backup before performing a self-upgrade (see _Creating a Backup_ in the [CLI section][grav-cli]).

>>> The self-upgrade only upgrades portions of your Grav instance, like `system/` folder, `vendor/` folder, `index.php` and others. Your **`user`** and **`images`** folders will never get touched.

![](upgrade.jpg)

[grav-cli]: ../grav-cli
[blueprints]: ../blueprints
[contributing]: https://github.com/getgrav/grav#contributing
[new-resource]: https://github.com/getgrav/grav/issues/new?title=[add-resource]%20New%20Plugin/Theme&body=I%20would%20like%20to%20add%20my%20new%20plugin/theme%20to%20the%20Grav%20Repository.%0AHere%20are%20the%20project%20details:%20**user/repository**
