---
title: Introduction
taxonomy:
    category: docs
twig_first: true
process:
    twig: true
---

The **Grav Administration Panel** plugin for [Grav](http://github.com/getgrav/grav) is a web GUI (graphical user interface) that provides a convenient way to configure Grav and easily create and modify pages.  This will remain a totally optional plugin, and is not in any way required or needed to use Grav effectively.  In fact, the admin interface provides an intentionally limited view to ensure it remains easy to use and not overwhelming.  Power users will still prefer to work with the configuration files directly.

![](admin-dashboard.png)

### Features

* User login with automatic password hashing
* Forgot password functionality
* Logged-in-user management
* One click Grav core updates
* Dashboard with maintenance status, site activity and latest page updates
* Ajax-powered backup capability
* Ajax-powered clear-cache capability
* System configuration management
* Site configuration management
* Normal and Expert modes which allow editing via forms or YAML
* Page listing with filtering and search
* Page creation, editing, moving, copying, and deleting
* Powerful syntax highlighting code editor with instant Grav-powered preview
* Editor features, hot keys, toolbar, and distraction-free fullscreen mode
* Drag-n-drop upload of page media files including drag-n-drop placement in the editor
* One click theme and plugin updates
* Plugin manager that allows listing and configuration of installed plugins
* Theme manager that allows listing and configuration of installed themes
* GPM-powered installation of new plugins and themes
* ACL for admin users access to features

### Support

The Adminstration Panel is quite an ambitious plugin with lots of functionality that will give you a lot of power and flexibility when building out your Grav sites. So if you have any questions, problems, suggestions or find one of those rare bugs in it, please use one of the following ways to get support from us.

For **live chatting**, please use the dedicated [Gitter Chat Room for the admin plugin](https://gitter.im/getgrav/grav-plugin-admin) for discussions directly related to the admin plugin.

For **bugs, features, improvements**, please ensure you [create issues in the admin plugin GitHub repository](https://github.com/getgrav/grav-plugin-admin).

### Installation

First ensure you are running the latest Grav version, **{{ grav_version }} or later**.  This is required for the admin plugin to run properly.  Check for and upgrade to new Grav versions like this (`-f` forces a refresh of the GPM index):

```
$ bin/gpm version -f
$ bin/gpm selfupgrade
```

The admin plugin actually requires the help of 3 other plugins, so to get the **admin** plugin to work you first need to install the **login**, **forms**, and **email** plugins.  These are available via GPM, and because the plugin has dependencies you just need to proceed and install the admin plugin, and agree when prompted to install the others:

```
$ bin/gpm install admin
```

You can also [install the plugin manually](../faq#manual-installation-of-admin) if you are unable to use GPM on your system.

### Creating a User

With the latest version of the Grav admin, you will be prompted to create an admin user account when you point your browser to your site.  You must complete this step to ensure straight away to ensure a valid admin user is under your control.

![](new-user.png)

Simply fill out the form and click the `Create User` button.

The user information is stored in the `user/accounts/` folder of your Grav installation.  You can edit the values manually or via the Admin plugin itself.  You can also create new users manually or via a the `bin/plugin login newuser` CLI command.  More information is contained in the [Grav Admin FAQ](../faq#adding-and-managing-users).

### Usage

By default, you can access the admin by pointing your browser to `http://yoursite.com/admin`. You can simply log in with the `username` and `password` set in the YAML file you configured earlier.

> After logging in, your **plaintext password** will be removed and replaced by an **encrypted** one.

### Standard Free & Paid Pro Versions

If you have been following the [blog](http://getgrav.org/blog), [Twitter](https://twitter.com/getgrav), [gitter.im chat](https://gitter.im/getgrav/grav), etc., you probably already know now that our intention is to provide two versions of this plugin.

The **standard free version**, is very powerful, and has more functionality than most commercial flat-file CMS systems.

We also intend to release in the near future a more feature-rich **pro version** that will include enhanced functionality, as well as some additional nice-to-have capabilities. This pro version will be a **paid** plugin the price of which is not yet 100% finalized.
