---
title: Plugin Basics
taxonomy:
    category: docs
---

Grav was designed to be **simple** and **focused**, dealing with pages only.  The idea is that Grav itself is **super-lean**, providing just enough functionality to do the basics: routing, Markdown to HTML compiling, Twig templating, and caching.

However, we knew that we wanted to ensure Grav could grow and provide powerful functionality when required, so we built **event hooks** throughout the system so that everything could be extended with **plugins**.

## Powerful!

All the key objects in Grav are accessible through a powerful [Dependency Injection Container](http://en.wikipedia.org/wiki/Dependency_injection).  With Grav's event hooks throughout the entire life cycle, you can access anything that Grav knows about, and manipulate it as you need.  With this system you have complete control to add as much functionality as you need.

The plugins have proved so easy to write, and so flexible and powerful, that we can not stop creating them! We already have [over 200 freely downloadable plugins](https://getgrav.org/downloads/plugins#extras) that do everything from displaying a **sitemap**, providing **breadcrumbs**, displaying blog **archives**, a simple **search engine**, to providing a fully-functional JavaScript-powered **shopping cart**!

The best way to learn what can be done with plugins is to download some of these and look at what they are doing, and how they are doing it. In the next chapter we will [create a simple plugin from scratch](../plugin-tutorial)!

## Essentials

All plugins are located in your `user/plugins` folder.  With the base Grav install, there are only two plugins provided: `error` and `problems`.

The `error` plugin is used to handle HTTP errors, like **404 Page Not Found**.

The `problems` plugin is useful for new Grav installations because it detects any issues with your **hosting setup**, **missing folders**, or **permissions** that could cause problems with Grav.  Only the `error` plugin is really essential for proper operation.

Every plugin in the `user/plugins` folder should have a unique name, and that name should closely define the function of the plugin.  Please do not use spaces, underscores, or capital letters in the plugin name.

## Accessing Plugin Configuration Values via Twig

To access plugin configuration settings via Twig (i.e. within a Theme), the general format is:

[prism classes="language-twig"]
config.plugins.pluginname.pluginproperty
[/prism]

If plugin name contains dashes you should refer to its properties using :

[prism classes="language-twig"]
config.plugins['plugin-name'].pluginproperty
[/prism]
