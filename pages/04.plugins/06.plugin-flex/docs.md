---
title: Using Flex in a Plugin
taxonomy:
    category: docs
---

## Introduction

Flex usages, be in twig or in code, will be only covered for the purpose of this introduction. To understand the power and flexibily of Flex, please read our [dedicated Flex documentation](/advanced/flex).

Flex allows custom Objects CRUDS, as single object or collection, and provides an extensive APIs usable from your plugin code or templates.

Admin UI can be added easily, either using standard templates or your own customized listing or forms (or else).

## Requirements

Grav 1.7 or later is required. For the purpose of this documentation, we will be using the grav+admin installation. See the [installation documentation](/basics/installation) to get it ready.

## Create your plugins

As it is possible to create a plugin, with or without flex from scratch, to ensure all latest changes are in place, we highly recommend to use the devtools to generate the skeleton and basic features for you:

To do so, we will use the devtools CLI:

[prism classes="shell"]
bin/gpm install devtools
[/prism]

To [create a new plugin using the devtools](/plugins/plugin-tutorial), the following command is used, the plugin name is myflexplugin:

[prism classes="shell"]
 grav-admin bin/plugin devtools new-plugin

 Enter Plugin Name:
 > myflexplugin

 Enter Plugin Description:
 > A little Flex plugin test

 Enter Developer Name:
 > grav@example.com

 Enter GitHub ID (can be blank):
 > gravcms

 Enter Developer Email:
 > grav@example.com

 Please choose an option:
  [blank] Basic Plugin
  [flex ] Basic Plugin prepared for custom Flex Objects
 > flex

 Enter Flex Object Name:
 > book

 Please choose a storage type:
  [simple] Basic Storage (1 file for all objects) - no media support
  [file  ] File Storage (1 file per object)
  [folder] Folder Storage (1 folder per object)
 > folder


SUCCESS plugin myflexplugin -> Created Successfully

Path: /home/pierre/project/grav/grav-admin/user/plugins/myflexplugin

Please run `cd /home/pierre/project/grav/grav-admin/user/plugins/myflexplugin` and `composer update` to initialize the autoloader
[/prism]

On success, we need now to install the dependecies, if any, for our new plugin:


[prism classes="shell"]
$ cd /home/pierre/project/grav/grav-admin/user/plugins/myflexplugin
$ composer update
Loading composer repositories with package information
Updating dependencies
Nothing to modify in lock file
Writing lock file
Installing dependencies from lock file (including require-dev)
Nothing to install, update or remove
Generating autoload files
No installed packages - skipping audit.
$ cd -
[/prism]

Now you should see the various folders and files related to your plugin and its flex object 'book'.

The Admin interface also nicely shows a new entry in the left side menu:

![Admin book flex menu entry](admin_menu_book.png)

## 
