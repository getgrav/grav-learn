---
title: Grav Development
taxonomy:
    category: docs
---

If you wish to develop with Grav, be that the **Grav Core**, **Grav Plugins**, **Grav Skeletons**, or even **Grav Themes** you will benefit from a more sophisticated setup than that required by a regular Grav user.  First let us breakdown the various types of development:

## Grav Core

When we talk about the **Grav Core** we are effectively talking about things in the `system` folder.  This folder controls everything about Grav and is really the very essence of the [Grav workflow and lifecycle](grav-lifecycle). Grav is intentionally focused on working with pages in an effecient manner.  Manipulation of pages, and extensive functionality is often best served by creating a plugin.  We strongly encourage our community to contribute bug fixes and even propose development of appropriate functionality within the core of Grav.

## Grav Plugins

Most development effort will probably take the form of a **Grav Plugin**.  Because Grav has plenty of [Event Hooks](..plugins/event-hooks), it's very easy to provide enhanced and specific functionality via the creation of a plugin.  We have already developed many plugins that work in a variety of ways using many different events to show off the power of this functionality.  

There are many benefits of providing functionality in plugins but a couple of the key benefits are:

1. The Grav core stays lean, you only need to add the plugins you need for a particular site. For example a blog may need many more plugins than a simple landing page.
2. Allows for 3rd party development of new functionality.  You don't have to wait until Grav gets a bit of functionality you want, you can simply create a plugin to extend Grav to do what you want to do.

## Grav Skeletons

A **Grav Skeleton** is effectively an **all-in-one sample site**.  They include the **Grav Core**, required **plugins**, as well as appropriate **pages** for content, and a **theme** for pulling it all together. Grav was designed to make the process of creating a site as easy as possible, and for that reason, everything you need for a site can be contained in the `user` folder.  Each of the skeletons we currently have available are simply a `user` folder on GitHub that we package up with various dependencies (required plugins, and theme) into a package that can be simply unzipped to provide a working example.

## Grav Themes

Because of the tight coupling with Grav pages and themes, a **Grav Theme** is an integral and very important part of a Grav site.  By this we mean that because each Grav page references a template in the theme, so your theme needs to provide the appropriate **twig templates** that your pages are using.  The Twig templating engine is a very powerful system unto itself, and because there really are no restrictions by Grav itself, you are free to create any kind of design you wish.  This is one of the great things about Grav compared to a traditional CMS that has a loose coupling between content and design.

# GitHub Setup

As is the way of things these days, GitHub is going to be your best friend when it comes to developing for Grav.  We have created some tools to make this as easy as possible, but there are some development patterns that you should follow to make the process simpler.

Clone all the repositories you plan to work with into a single `Projects` or `Development` folder on your computer. This will allow our provided tools to find the repositories they need.

>>> We use the [GitFlow](http://nvie.com/posts/a-successful-git-branching-model/) branching model for all our Grav development.  The core-concept of the GitFlow methodology is that development happens in the `develop` branch, but new features and functionality are created in seperate `feature` branches that are merged into `develop` when complete.  Releases merge `develop` into `master` and you can apply `hotfix` branches as needed during the release process. Most modern git clients support this. However we recommend [Atlassian SourceTree](https://www.atlassian.com/software/sourcetree/overview) as its free, cross-platform, and easy to use.

Grav depends also has some dependencies (dictated by the `.dependencies` file) that include the **Error** and **Problems** plugins, as well as the **Antimatter** theme.  You can follow these instructions to clone these bits on your own computer.  

>>>> If you wish to make make additions or changes to any of the `getgrav` repositories, you will need to **fork** the appropriate repository and then clone **your fork's url** rather than the `getgrav` repository directly. The example below is using the direct `getgrav` repositories for example only.

```
$ cd
$ mkdir Projects
$ cd Projects
$ mkdir Grav
$ cd Grav
$ git clone https://github.com/getgrav/grav.git
$ git clone https://github.com/getgrav/grav-plugin-error.git
$ git clone https://github.com/getgrav/grav-plugin-problems.git
$ git clone https://github.com/getgrav/grav-theme-antimatter.git
```

This will clone **all 4 repositories** into your `~/Projects/Grav` folder.  Usually the normal procedure for setting up a test site for Grav is to use the `bin/grav new-project` command.  And this is true for development except for one important difference.  Because we want to to be able to develop from you web root, but have any changes show up in your cloned code, we need to **symbolically link** the relevant parts.  We do this by passing a `-s` flag to the `bin/grav new-project` command.  

There is one extra step required however, you must tell the command where it can find your repositories. So follow these steps to create a configuration file in a new `.grav/` folder which you will need to create in the **root of your home directory**:

```
$ cd
$ mkdir .grav
$ vi .grav/config
```

In this file provide a simple mapping of where the relevant files are located:

```
github_repos: /Users/your_user/Projects/Grav/
```

Make sure you **save** this file and that its readable. You can now continue on to setting up your **symbolically linked** site where `~/www` is your webroot and `~/www/grav` is the location of where your new grav test site will be created:

```
$ cd ~/Projects/Grav/grav
$ bin/grav new-project -s ~/www/grav
```

You should see quite a bit of output like this:

```
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
    /vendor -> /Users/rhuk/www/grav/vendor

Pages Initializing
    /Users/rhuk/Projects/Grav/grav/user/pages -> Created

File Initializing
    /.dependencies -> Created
    /.htaccess -> Created
    /user/config/site.yaml -> Created
    /user/config/system.yaml -> Created

Permisions Initializing
    bin/grav permissions reset to 755

read local config from /Users/rhuk/.grav/config

Symlinking Bits
===============

SUCCESS symlinked grav-plugin-problems -> user/plugins/problems

SUCCESS symlinked grav-plugin-error -> user/plugins/error

SUCCESS symlinked grav-theme-antimatter -> user/themes/antimatter
```

As you can see a number of default directories were created, and also an initial `pages` folder was created. After the base has been setup, the other dependencies are symbolically linked in.

You should be able to point your browser to `http://localhost/grav` and see the test site you just setup. Now any changes you make in your `~/www/grav` folder will show up ready to commit and push in your cloned repositories.

