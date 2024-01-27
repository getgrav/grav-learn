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

Grav 1.7 or later is required. For the purpose of this documentation, we will be using the grav+admin installation, make sure you have it up and running to follow the steps below. See the [installation documentation](/basics/installation) to get it ready.

## Create your plugins

As it is possible to create a plugin, with or without flex from scratch, to ensure all latest changes are in place, we highly recommend to use the devtools to generate the skeleton and basic features for you:

To do so, we will use the devtools CLI:

[prism classes="language-shell command-line"]
bin/gpm install devtools
[/prism]

To [create a new plugin using the devtools](/plugins/plugin-tutorial), the following command is used, the plugin name is myflexplugin:

[prism classes="language-shell command-line"]
 grav-admin bin/plugin devtools new-plugin
[/prism]

and fill up the questions using the following answers, the important part is to choose a plugin prepared for flex:

[prism classes="language-shell command-line"]
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

On success, we need now to install the dependencies, if any, for our new plugin:


[prism classes="language-shell command-line"]
cd /home/pierre/project/grav/grav-admin/user/plugins/myflexplugin
[/prism]
[prism classes="language-shell command-line"]
composer update
[/prism]

On success, the following output should be displayed:

[prism classes="language-shell command-line"]
Loading composer repositories with package information
Updating dependencies
Nothing to modify in lock file
Writing lock file
Installing dependencies from lock file (including require-dev)
Nothing to install, update or remove
Generating autoload files
No installed packages - skipping audit.
[/prism]

and go back to the root folder of the grav-admin install:


[prism classes="language-shell command-line"]
cd -
[/prism]

The devtools generated a very basic flex object, made of a name and a description, and its collection. The admin UI already allows one to list these books objects, create, edit or delete them, without having written a single line of code.

A new entry in the left side menu has been added:

![Admin book flex menu entry](admin_menu_book.png)

The default edit form looks like:

![Simple form edit](book_edit.png)


You should also see the various folders and files related to your plugin and its flex object 'book'.

## What is done where


The plugin folder should look like this:
[prism classes="language-bash line-numbers"]
../grav-admin/user/plugins/myflexplugin
├── CHANGELOG.md
├── LICENSE
├── README.md
├── blueprints
│   └── flex-objects
│       └── book.yaml
├── blueprints.yaml
├── classes
│   └── Flex
│       └── Types
│           └── Book
│               ├── BookCollection.php
│               └── BookObject.php
├── composer.json
├── composer.lock
├── languages.yaml
├── myflexplugin.php
├── myflexplugin.yaml
└── vendor
    ├── autoload.php
    └── composer
        ├── ClassLoader.php
        ├── InstalledVersions.php
        ├── LICENSE
        ├── autoload_classmap.php
        ├── autoload_namespaces.php
        ├── autoload_psr4.php
        ├── autoload_real.php
        ├── autoload_static.php
        ├── installed.json
        ├── installed.php
        └── platform_check.php
[/prism]

### Flex Object definition
The key file is the [blueprints](advanced/flex/custom-types/blueprint) definition. It is where the schema of this flex object will be defined, along with the numerous options to customize pretty much anything about it.

In our plugin, the book blueprints can be found at user/plugins/myflexplugin/blueprints/flex-objects/book.yaml.

> **IMPORTANT** The blueprint for each flex object in your plugin (or main install /blueprints) must be in  blueprints/flex-objects/ folder or they won't be found.

The schema is defined using the Form section of this blueprints. Whether or not the admin UI forms will be used, this section defines the properties of this flex object.

We won't cover all options here, but focus on getting our book object implement. The [extensive Flex blueprints documentation](/advanced/flex/custom-types/blueprint) will guide you to go deeper and customize it.

The schema below defines the two properties:
[prism classes="language-yaml line-numbers"]
form:
    validation: loose
    fields:
        published:
            type: toggle
            label: Published
            highlight: 1
            default: 1
            options:
                1: PLUGIN_ADMIN.YES
                0: PLUGIN_ADMIN.NO
            validate:
                type: bool
                required: true
        name:
            type: text
            label: Name
            validate:
                required: true
        description:
            type: text
            label: Description
            validate:
                required: true
[/prism]

### plugin hooks

the myflexplugin.php is the usual core definition for the implementations of the pluging, hooks etc.

These parts are required to enable flex:

[prism classes="language-php line-numbers"]
    public $features = [
        'blueprints' => 0,
    ];

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                // Uncomment following line when plugin requires Grav < 1.7
                // ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ],
            FlexRegisterEvent::class       => [['onRegisterFlex', 0]],
        ];
    }
[/prism]

The other files are standard and well documented in earlier sections of the plugins documentations. We won't cover them here.

The _classes_ folder contains the classes used for the book flex object and the book flex collection. These are the classes where you can add custom methods that would be available on every object or collection instances. See [add custom methods to a flex object](#add-custom-method-to-the-flex-object).

## Modify the flex object schema

Let add a field to our object, say a datetime field representing the publication's date of this book, it can be achieved by simply adding the pub_date fields to the blueprints:

[prism classes="language-yaml line-numbers"]
form:
    validation: loose
    fields:
        published:
            type: toggle
            label: Published
            highlight: 1
            default: 1
            options:
                1: PLUGIN_ADMIN.YES
                0: PLUGIN_ADMIN.NO
            validate:
                type: bool
                required: true
        name:
            type: text
            label: Name
            validate:
                required: true
        pub_date:
            type: datetime
            label: Description
            validate:
                required: true
[/prism]

The default edit form now shows the date input fields for the publication date:

![Simple form edit](pub_date_added.png)

The list of all fields types available can be found [here](/forms/blueprints/fields-available)

## Add custom method to the flex object<a href="#addcustommethod"></a>

The current flex book object, user/plugins/myflexplugin/classes/Flex/Types/Book/BookObject.php, only implements the GenericObject (using traits):

[prism classes="language-php line-numbers"]
<?php

declare(strict_types=1);

/**
 * @package    Grav\Common\Flex
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Myflexplugin\Flex\Types\Book;

use Grav\Common\Flex\Types\Generic\GenericObject;

/**
 * Class BookObject
 * @package Grav\Common\Flex\Generic
 *
 * @extends FlexObject<string,GenericObject>
*/
class BookObject extends GenericObject
{

}
[/prism]

Let add a method to get the summary of the book, using the site's delimiter for the summary:


[prism classes="language-php line-numbers"]
<?php

declare(strict_types=1);

/**
 * @package    Grav\Common\Flex
 *
 * @copyright  Copyright (c) 2015 - 2021 Trilby Media, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Myflexplugin\Flex\Types\Book;

use Grav\Common\Flex\Types\Generic\GenericObject;

/**
 * Class BookObject
 * @package Grav\Common\Flex\Generic
 *
 * @extends FlexObject<string,GenericObject>
*/
class BookObject extends GenericObject
{
    public function getSummary() {
        $delimiter = \Grav\Common\Grav::instance()['config']['site']['summary']['delimiter'] ?? '===';
        $summary = explode($delimiter, $this->content);
        return $summary[0] ?? '';
    }
}
[/prism]

Now we can call this method anywhere where a book flex object is used, for example, in a template:


[prism classes="language-twig line-numbers"]
{% set books = grav.get('flex').collection('book') %}
{% for book in books  %}
    <h1>{{ book.header.title}}</h1>
    <p>{{ book.getSummary()}}</p>
{% endfor %}
[/prism]

The ::getSummary method can be used in any PHP code as well.

The same can be done in the collection class, user/plugins/myflexplugin/classes/Flex/Types/Book/BookCollection.php. For example to add friendly method to search using non trivial queries. Indeed the collection already provides all common collections methods. It can be handy to add some helpers if an object has many different fields were the standard collection methods could be error prone.