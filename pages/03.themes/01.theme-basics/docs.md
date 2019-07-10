---
title: Theme Basics
taxonomy:
    category: docs
---

Themes in Grav are quite simple, and very flexible because they are built with the powerful [Twig Templating engine](https://twig.sensiolabs.org/). Every theme is created with a combination of twig files (a mixture of twig-like PHP code and HTML), called templates, and CSS. We typically use [Sass CSS Extension](http://sass-lang.com) to generate our CSS files, but there is nothing stopping you from using [Less](http://lesscss.org/), or even regular CSS. It simply comes down to your own personal preferences.

## Content Pages & Twig Templates

The first thing to understand is the direct relationship between **pages** in Grav and the **Twig template files** that are provided in a theme.

Each page you create references a specific template file, either by the name of the page file, or by setting the template header variable for the page.  For simpler maintenance, we advise using the page name rather than overriding it with the header variable, whenever possible.

Let us work through a simple example.  If you have [installed the **Grav Base** package](../../basics/installation) you will notice that in the `user/pages/01.home` folder, you have a file called `default.md` which contains the markdown-based content for the page.  The name of this file, i.e. `default` tells Grav that this page should be rendered with the Twig template called `default.html.twig` which is located in the theme's `templates/` folder.

!! Page templates must be lowercase, like "default", "blog", etc.

If you were to have a page file called `blog.md`, Grav would try to render it with the Twig template: `<your_theme>/templates/blog.html.twig`.

!! The names of files in Grav do not appear on the frontend of Grav. Only the folder names do. Don't worry if all of your blog posts have the same file name. This is normal.

## Theme Organization

### Definition & Configuration

Each theme should have a definition file called `blueprints.yaml` which has some information about the theme.  It can optionally provide **form** definitions to be used in the [**Administration Panel**](../../admin-panel/introduction) to allow for editing of theme options.  The **Antimatter** theme has the following `blueprints.yaml` file:

[prism classes="language-yaml line-numbers"]
name: Antimatter
version: 1.6.7
description: "Antimatter is the default theme included with **Grav**"
icon: empire
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-theme-antimatter
demo: https://demo.getgrav.org/blog-skeleton
keywords: antimatter, theme, core, modern, fast, responsive, html5, css3
bugs: https://github.com/getgrav/grav-theme-antimatter/issues
license: MIT

form:
  validation: loose
  fields:
    dropdown.enabled:
        type: toggle
        label: Dropdown in navbar
        highlight: 1
        default: 1
        options:
          1: Enabled
          0: Disabled
        validate:
          type: bool
[/prism]

If you want to use theme configuration options you should provide default settings in a file called `<your_theme>.yaml`.  For example:

[prism classes="language-yaml line-numbers"]
enabled: true
color: blue
[/prism]

!! The `color: blue` configuration option does not actually do anything. It is merely used as an example of how to override a setting.

To know more about the available forms that you can create, refer to [chapter 6. Forms](../../forms). You should also provide a `300px` x `300px` image of your theme and call it `thumbnail.jpg` at the root of the theme. It will show up in the theme section of your admin panel.

### Templates

There are **no set rules** regarding the structure of a Grav theme except that there must be appropriate Twig templates provided in the `templates/` folder for each of the page types you use in your content.

!! Because of this tight coupling between page content and Twig templates in a theme, it often makes sense to develop themes in conjunction with the content they are intended to be used with.  A good way to create _general_ themes is to support the template types used by the Skeleton packages that are available on our [downloads page](https://getgrav.org/downloads). For example, support: **default**, **blog**, **error**, **item**, and **modular**.

Generally speaking, the root of the `templates/` folder should be used to house the primary templates that are supported, then create a sub-folder called `partials/` to contain parts, or smaller template _chunks_.

If you want to support **modular** templates in your theme, you should also create a sub-folder of templates called `modular/` and store your modular Twig template files in there.

The story for supporting **forms** is the same. Create another sub-folder called `forms/` and store any custom form templates in it.

### SCSS / LESS / CSS

Again, there is nothing set in stone here, but a solid practice is to have a sub-folder called `scss/` if you want to develop with Sass, or `less/` if you prefer Less along with a `css/` folder to put static CSS files, and a `css-compiled/` folder for any automatically generated files from your Sass or Less compilations.

How you organize your files here is completely up to you.  Feel free to follow our example in the default **antimatter** theme provided with the Grav Base package for some ideas.  We are using the **scss** variant of Sass which is more CSS-like, and frankly more natural to write.

To install Sass on your computer, simply [follow the instructions on the sass-lang.com](http://sass-lang.com/install) website.

1. Execute the simple provided scss shell script by typing `$ ./scss.sh` from the root of the theme.
2. Running the command directly `$ scss --sourcemap --watch scss:css-compiled` which is the same thing.

By default, this will compile your scss files into the `css-compiled/` folder.  You can then reference the resulting css file in your theme.

### Blueprints

The `blueprints/` folder is used to define forms for options and configuration for each of the template files. These are used by the **Administration Panel** and are optional. The theme is 100% functional without these, but they will not be editable via the administration panel, unless provided.

### Theme and Plugin Events

Another powerful feature that is purely optional is the ability for a theme to interact with Grav via the **plugins** architecture. In short, during the initialization sequence of Grav, there are several points in the sequence where you can "hook" your own piece of code. This can be useful, for example, to define extra path shortcuts in your theme when Twig is initializing, so that you can use them in your Twig templates. These hooks are available to you through a set of "empty" functions with names predefined by the Grav system, which you can fill at your convenience. [Chapter 4. Plugins](../../plugins) has more information about the plugin system and the available event hooks. To make use of these hooks in your theme, simply create a file called `mytheme.php` and use the following format:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Theme;

use Grav\Common\Theme;

class MyTheme extends Theme
{

    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0]
        ];
    }

    public function onThemeInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $this->enable([
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    public function onTwigSiteVariables()
    {
        $this->grav['assets']
            ->addCss('plugin://css/mytheme-core.css')
            ->addCss('plugin://css/mytheme-custom.css');

        $this->grav['assets']
            ->add('jquery', 101)
            ->addJs('theme://js/jquery.myscript.min.js');
    }
}
[/prism]

As you can observe, in order to use the event hooks you first need to register them in a list with the `getSubscribedEvents` function and then define them with your own code. If you subscribe an event for use, define it aswell. Otherwise you will get an error.

### Other Folders

We recommend creating individual folders at the root of your theme for `images/`, `fonts/` and `js/` to contain your custom theme images, any custom web fonts, and javascript files required.

## Theme Example

Let us use the default **antimatter** theme as an example, below you can see the overall structure of this theme:

![Theme Folders](theme-folders.png)

In this example, the actual `css`, `css-compiled`, `fonts`, `images`, `js`, `scss`, and `templates` files have been ignored to make it more readable.  The important thing to note is the overall structure of the theme.

