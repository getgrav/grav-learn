---
title: Grav Development
page-toc:
  active: true
taxonomy:
    category: docs
---

If you want to develop with Grav, you will benefit from a more sophisticated setup than the one required for a regular Grav user. This includes just about any type of development, such as: **Grav Core**, **Grav Plugins**, **Grav Skeletons**, or even **Grav Themes**.

First, let us break down the various types of development:

## Grav Core

When we talk about the **Grav Core**, we are effectively talking about things in the `system` folder.  This folder controls everything about Grav and is really the very essence of the [Grav workflow and lifecycle](../grav-lifecycle).

Grav is intentionally focused on working with pages in an efficient manner.  Manipulation of pages and extensive functionality are often best served by creating a plugin.  We strongly encourage our community to contribute bug fixes, and even propose development of appropriate functionality within the core of Grav.

## Running Tests

First, install the development dependencies by running composer install from the Grav root.

[prism classes="language-bash command-line"]
composer install
[/prism]

Then you can run the tests:

[prism classes="language-bash command-line"]
composer test
[/prism]

This will run the full suite of existing tests which should always be executed successfully on any site.

You can also run a single unit test file, e.g.

[prism classes="language-bash command-line"]
composer test tests/unit/Grav/Common/Markdown/ParsedownTest::testAttributeLinks
[/prism]

An alternative method to calling these tests is:

[prism classes="language-bash command-line"]
./vendor/bin/codecept run
./vendor/bin/codecept run tests/unit/Grav/Common/Markdown/ParsedownTest::testAttributeLinks
[/prism]


## Grav Plugins

Most development effort will probably take the form of a **Grav Plugin**.  Because Grav has plenty of [Event Hooks](../../plugins/event-hooks), it's very easy to provide enhanced and specific functionality via the creation of a plugin.  We have already developed many plugins that work in a variety of ways using many different events to show off the power of this functionality.

There are many benefits of providing functionality in plugins, but a couple of the key benefits are:

1. The Grav Core Remains Lean - You only need to add the plugins you need for a particular site. For example, a blog may need many more plugins than a simple landing page.
2. Third-Party Development of New Functionality - You don't have to wait until Grav gets a bit of functionality you want. You can simply create a plugin to extend Grav to do what you want it to do.

#### Plugin Requirements

A proper Grav plugin requires certain files in order to function properly, be listed in the Grav repository, and be visible in the Grav admin plugin.  Please ensure your plugin contains all these files:

* **yourplugin.php** - plugin PHP file that should be named the same as the folder
* **yourplugin.yaml** - plugin configuration file that contains any options and stream inheritance information
* **blueprints.yaml** - plugin definition file and form definition file
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the plugin
* **LICENSE** - license file, probably MIT if in line with Grav core
* **languages.yaml** (optional) - a language definition file

## Grav Skeletons

A **Grav Skeleton** is effectively an **all-in-one sample site**.  They include the **Grav Core**, required **plugins**, as well as appropriate **pages** for content and a **theme** for pulling it all together.

Grav was designed to make the process of creating a site as easy as possible. For that reason, everything you need for a site can be contained in the `user` folder.  Each of the skeletons we currently have available are simply a `user` folder on GitHub that we package up with various dependencies (required plugins, and theme) into a package that can be simply unzipped to provide a working example.

These skeletons are a base on which you can grow your site, quickly and efficiently. You aren't locked into a specific set of features. It is every bit as flexible as any other Grav install.

#### Skeleton Requirements

A proper Grav skeleton requires certain files in order to function properly, be listed in the Grav repository, and be visible in the Grav admin plugin.  Please ensure your skeleton contains all these files:

* **.dependencies** - A file to define theme and plugin dependencies for this skeleton
* **blueprints.yaml** - skeleton definition file and form definition file
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the plugin
* **LICENSE** - license file, probably MIT if in line with Grav core
* **screenshot.jpg** - a 1:1 aspect ratio preview of the theme.  Should be at least 800px x 800px

## Grav Themes

Because of the tight coupling with Grav pages and themes, a **Grav Theme** is an integral and very important part of a Grav site.  By this we mean that each Grav page references a template in the theme, so your theme needs to provide the appropriate **Twig templates** that your pages are using.

The Twig templating engine is a very powerful system, and because there really are no restrictions by Grav itself, you are free to create any kind of design you wish.  This is one of the great things that sets Grav apart from a traditional CMS that has a loose coupling between content and design.

#### Theme Requirements

A proper Grav theme requires certain files in order to function properly, be listed in the Grav repository, and be visible in the Grav admin plugin.  Please ensure your theme contains all these files:

* **yourtheme.php** - theme PHP file that should be named the same as the folder
* **yourtheme.yaml** - theme configuration file that contains any options and stream inheritance information
* **blueprints.yaml** - theme definition file and form definition file
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the theme
* **LICENSE** - license file, probably MIT if in line with Grav core
* **screenshot.jpg** - a 1:1 aspect ratio preview of the theme.  Should be at least 800px x 800px
* **thumbnail.jpg** - a smaller thumbnail image used by the admin plug. 1:1 aspect ratio and should be at 300px x 300px
* **languages.yaml** (optional) - a language definition file

## Demo Content

With the release of Grav 0.9.18, you are now able to provide demo content as part of a plugin or theme package. This means that anything found in a folder called `_demo/` will be copied over to the `user/` folder as part of the installation procedure.  This means you can provide **pages**, or **configuration** or anything else that sits in the `user/` folder.  The user is prompted to do this, and it's purely optional.

_Please note that demo content is not copied when your plugin or theme is installed via the `Admin` plugin._

## Theme/Plugin Release Process

When you have created your new theme or plugin and would like to see it added to the [Grav Repository](https://getgrav.org/downloads) there are a few standard things that you need to ensure:

1. It is open source with a `LICENSE` file that provides an [MIT](http://en.wikipedia.org/wiki/MIT_License) compatible license [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/LICENSE)
2. Contains a `README.md` file with a summary of functionality and instructions on how to install and configure it. [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/README.md)
3. Contains a `blueprints.yaml` file with [all required fields](../blueprints). [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/blueprints.yaml)
4. Provide a `CHANGELOG.md` in the [correct format](#changelog-format) an [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/CHANGELOG.md)
5. Provides appropriate attribution if you use any other libraries, scripts, code.
6. [Create a release](https://help.github.com/articles/creating-releases) for your finished plugin/theme. The Grav repository system requires a release and will not find your plugin/theme unless there is a release that contains all of the above.
7. [Add an issue to the Grav issues tracker](https://github.com/getgrav/grav/issues/new?title=[add-resource]%20New%20Plugin/Theme&body=I%20would%20like%20to%20add%20my%20new%20plugin/theme%20to%20the%20Grav%20Repository.%0AHere%20are%20the%20project%20details:%20**user/repository**) with details about your plugin, and we will give it a quick test to ensure it functions, and then add it.

! Ensure your **naming for each tag is consistent**. GPM uses this information to determine if your plugin/theme is newer than the last.  We recommend using [Semantic Version Numbers](http://semver.org/) for tags.  E.g. `1.2.4`. Consistency for all tags is paramount!

## ChangeLog Format

The GetGrav.org site uses a custom ChangeLog format that is written in standard markdown but can be manipulated with some simple CSS and [displayed in an attractive format](https://getgrav.org/downloads#changelog).  In order to ensure your ChangeLogs can be parsed and formatted properly, please use this syntax:

[prism classes="language-markdown line-numbers"]
# vX.Y.Z
## 01/01/2015

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
[/prism]

Each section `#new, #improved, #bugfix` are optional, just include the sections you need.

! Dates can use either the **American** `m/d/y` [date format](/content/headers#date), or the **European** `d-m-y` format. Also make sure there is an empty newline between the headers (version and date) and lists (new, improved, bugfix).

## GitHub Setup

As is the way of things these days, GitHub is going to be your best friend when it comes to developing for Grav.  We have created some tools to make this as easy as possible, but there are some development patterns that you should follow to make the process simpler.

Clone all the repositories you plan to work with into a single `Projects` or `Development` folder on your computer. This will allow our provided tools to find the repositories they need.

!! We use the [GitFlow](http://nvie.com/posts/a-successful-git-branching-model/) branching model for all our Grav development.  The core concept of the GitFlow methodology is that development happens in the `develop` branch, but new features and functionality are created in separate `feature` branches that are merged into `develop` when complete.  Releases merge `develop` into `master`, and you can apply `hotfix` branches as needed during the release process. Most modern git clients support this. However, we recommend [Atlassian SourceTree](https://www.atlassian.com/software/sourcetree/overview) as it's free, cross-platform, and easy to use.

Grav also has some dependencies (dictated by the `.dependencies` file) which include the **Error** and **Problems** plugins, as well as the **Antimatter** theme.  You can follow these instructions to clone these bits on your own computer.

!!!! If you wish to make additions or changes to any of the `getgrav` repositories, you will need to **fork** the appropriate repository and then clone **your fork's url** rather than the `getgrav` repository directly. The example below is using the direct `getgrav` repositories for example only.

[prism classes="language-bash command-line"]
cd
mkdir Projects
cd Projects
mkdir Grav
cd Grav
git clone https://github.com/getgrav/grav.git
git clone https://github.com/getgrav/grav-plugin-error.git
git clone https://github.com/getgrav/grav-plugin-problems.git
git clone https://github.com/getgrav/grav-theme-antimatter.git
[/prism]

This will clone **all 4 repositories** into your `~/Projects/Grav` folder.

Usually, the normal procedure for setting up a test site for Grav is to use the `bin/grav new-project` command.  This is true for development, except for one important difference.  Because we want to to be able to develop from your web root, but have any changes show up in your cloned code, we need to **symbolically link** the relevant parts.  We do this by passing a `-s` flag to the `bin/grav new-project` command.

There is one extra step required. You must tell the command where it can find your repositories. So, follow these steps to create a configuration file in a new `.grav/` folder which you will need to create in the **root of your home directory**:

[prism classes="language-bash command-line"]
cd
mkdir .grav
vi .grav/config
[/prism]

In this file: provide a simple mapping of where the relevant files are located:

```
github_repos: /Users/your_user/Projects/Grav/
```

Make sure you **save** this file and that it's readable. You can now set up your **symbolically linked** site where `~/www` is your webroot and `~/www/grav` is the location where your new grav test site will be created:

[prism classes="language-bash command-line"]
cd ~/Projects/Grav/grav
bin/grav new-project -s ~/www/grav
[/prism]

You should see quite a bit of output like this:

[prism classes="language-text"]
rhukster@gibblets:~/Projects/Grav/grav(develop○) » bin/grav new-project -s ~/www/grav

Creating Directories
    /cache
    /logs
    /images
    /assets
    /user/accounts
    /user/config
    /user/pages
    /user/data
    /user/plugins
    /user/themes

Resetting Symbolic Links
    /index.php -> /Users/rhuk/www/grav/index.php
    /composer.json -> /Users/rhuk/www/grav/composer.json
    /bin -> /Users/rhuk/www/grav/bin
    /system -> /Users/rhuk/www/grav/system

Pages Initializing
    /Users/rhuk/Projects/Grav/grav/user/pages -> Created

File Initializing
    /.dependencies -> Created
    /.htaccess -> Created
    /user/config/site.yaml -> Created
    /user/config/system.yaml -> Created

Permissions Initializing
    bin/grav permissions reset to 755

read local config from /Users/rhuk/.grav/config

Symlinking Bits
===============

SUCCESS symlinked grav-plugin-problems -> user/plugins/problems

SUCCESS symlinked grav-plugin-error -> user/plugins/error

SUCCESS symlinked grav-theme-antimatter -> user/themes/antimatter
[/prism]

As you can see, a number of default directories were created, and an initial `pages` folder was also created. After the base has been set up, the other dependencies are symbolically linked in.

You should be able to point your browser to `http://localhost/grav` and see the test site you just set up. Now, any changes you make in your `~/www/grav` folder will show up ready to commit and push in your cloned repositories.

## Abandoned Resource Protocol

People move on, and user-generated content like plugins and themes may become abandoned. If you wish to take over the maintenance of an existing theme or plugin, you must follow this protocol:

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
