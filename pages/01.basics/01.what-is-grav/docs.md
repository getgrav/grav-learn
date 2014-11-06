---
title: What is Grav?
taxonomy:
    category: docs
---

Grav is a **Fast**, **Simple**, and **Flexible** file-based Web-platform.  There is **Zero** installation required.  Just extract the ZIP archive, and you are already up and running.  It follows similar principles to other flat-file CMS platforms, but has a different design philosophy than most.

The name is just a shortened version of the word **Gravity**, which although is the name of a movie starring Sandra Bullock, is also a very important physical principle that describes forces of attraction between objects. Frankly, the name was chosen as a temporary 'codename' for the project and it just stuck.

The underlying architecture of Grav has been designed to use well established and _best-in-class_ technologies, where applicable, to ensure that Grav is simple to use and easy to extend. Some of these key technologies include:

* [Twig Templating](http://twig.sensiolabs.org/): for powerful control of the user interface
* [Markdown](http://en.wikipedia.org/wiki/Markdown): for easy content creation
* [YAML](http://yaml.org): for simple configuration
* [Parsedown](http://parsedown.org/): for fast Markdown and Markdown Extra support
* [Doctrine Cache](http://docs.doctrine-project.org/en/2.0.x/reference/caching.html): layer for performance
* [Pimple Dependency Injection Container](http://pimple.sensiolabs.org/): for extensibility and maintainability
* [Symfony Event Dispacher](http://symfony.com/doc/current/components/event_dispatcher/introduction.html): for plugin event handling
* [Symfony Console](http://symfony.com/doc/current/components/console/introduction.html): for CLI interface
* [Gregwar Image Library](https://github.com/Gregwar/Image): for dynamic image manipulation

## Grav's Place in the Universe

There are many powerful existing open source CMS solutions for building complex sites.  Some of the more commonly used ones are [Joomla][joomla], [WordPress][wordpress], and [Drupal][drupal]. The downside of these platforms is that they require serious commitment to learn how to use them before you can even begin to think about creating a website with them.

These platforms provide a wealth of features and functionality that you can extend with a wide-variety of community and professionally developed extensions and themes.  These extensions and themes are themselves often feature-packed, requiring yet more knowledge and time on the part of the implementor.

In the end, you often find yourself in the position where you end with a site comprised of many different products from many different vendors that comes closest to approximating your original vision.

Grav tackles the problem differently.  It focuses primarily on your content, and turns your content structure into a navigable site.  The underpinnings of Grav are simple, yet via extensive ** events**, you have complete control over every step in the Grav workflow.

This allows simple plugins to quickly and easily add powerful functionality. It also offers an incredibly quick development turnaround with an installation process that takes seconds, including a straightforward content creation method with a minimal learning curve. This puts Grav in a position of being friendly to both the developer and the end user.

To get a basic site up-and-running requires very little Web development experience, yet if you dig a little deeper, you will discover that there is very little Grav cannot accomplish.

##### Grav Logos and Press Information

You can find a summary about Grav including **Grav logos** and **press information** on our [media page](http://getgrav.org/media)

>>>>>> The simplest way to navigate the documentation is to use the **Next** arrow (<i class="icon-right-open"></i>) on each page. You can see your progress represented by the green progress bar at the top of the page as well as checks (<i class="icon-check"></i>) in the sidebar.  You can also star (<i class="icon-star"></i>) pages for easy reference.

[joomla]: http://joomla.org
[wordpress]: http://wordpress.org
[drupal]: http://drupal.org
