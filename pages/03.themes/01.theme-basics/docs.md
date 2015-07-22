---
title: Theme Basics
taxonomy:
    category: docs
---

Themes in Grav are quite simple, and very flexible because they are built with the powerful [Twig Templating engine](http://twig.sensiolabs.org/). We typically use [Sass CSS Extension](http://sass-lang.com) to generate our CSS files, but there is nothing stopping you from using [Less](http://lesscss.org/), or even regular CSS. It simply comes down to your own personal preferences.

## Content Pages & Twig Templates

The first thing to understand is the direct relationship between **pages** in Grav and the **twig template files** that are provided in a theme.

Each page you create references a specific template file, either by the name of the page file, or by setting the template header variable for the page.  For simpler maintenance, we advise using the page name rather than overriding it with the header variable, whenever possible.

Let us work through a simple example.  If you have [installed the **Grav Base** package](../../basics/installation) you will notice that in the `user/pages/01.home` folder, you have a file called `default.md` which contains the markdown-based content for the page.  The name of this file, i.e. `default` tells Grav that this page should be rendered with the twig template called `default.html.twig` which is located in the theme's `templates/` folder.

If you were to have a page file called `blog.md`, Grav would try to render it with the twig template: `<your_theme>/templates/blog.html.twig`.

>>> The names of files in Grav do not appear on the frontend of Grav. Only the folder names do. Don't worry if all of your blog posts have the same file name. This is normal.

## Theme Organization

### Definition & Configuration

Each theme should have a definition file called `blueprints.yaml` which has some information about the theme.  It can optionally provide **form** definitions to be used in the **Administrator Panel** to allow for editing of theme options.  The **Antimatter** theme has the following `blueprints.yaml` file:

```ruby
name: Antimatter
version: 1.6.0
description: "Antimatter is the default theme included with **Grav**"
icon: empire
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-theme-antimatter
demo: http://demo.getgrav.org/blog-skeleton
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
```

>>>> The form fields can be safely ignored at this point. These are provided for our testing of a new administration plugin to provide configuration of the theme. As this is not currently available, they are unused.

If you want to use theme configuration options you should provide default settings in a file called `<your_theme>.yaml`.  For example:

```ruby
enabled: true
color: blue
```

>>> The `color: blue` configuration option does not actually do anything. It is merely used as an example of how to override a setting.

Also you should provide a `300px` x `300px` image of your theme and call it `thumbnail.jpg` at the root of the theme.

### Theme and Plugin Events

Another powerful feature that is purely optional is the ability for a theme to interact with Grav via the **plugins** architecture.  To accomplish this, simply create a file called `mytheme.php` and use the following format:

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

You can then use provide **plugins methods** which are covered in the [next section](../../plugins) in greater detail.

### Templates

There are **no set rules** regarding the structure of a Grav theme except that there must be appropriate twig templates provided in the `templates/` folder for each of the page types you use in your content.

>>> Because of this tight coupling between page content and twig templates in a theme, it often makes sense to develop themes in conjunction with the content they are intended to be used with.  A good way to create _general_ themes is to support the template types used by the Skeleton packages that are available on our [downloads page](http://getgrav.org/downloads). For example, support: **default**, **blog**, **error**, **item**, and **modular**.

Generally speaking, the root of the `templates/` folder should be used to house the primary templates that are supported, then create a sub-folder called `partials/` to contain parts, or smaller template _chunks_.

If you want to support **modular** templates in your theme, you should also create a sub-folder of templates called `modular/` and store your modular twig template files in there.

The story for support **forms** is the same. Create another sub-folder called `forms/` and store any custom form templates in it.

### Blueprints

The `blueprints/` folder is used to define forms for options and configuration for each of the template files. These are used by the **Administrator Panel** and are optional. The theme is 100% functional without these, but they will not be editable via the administrator panel, unless provided.

### SCSS / LESS / CSS

Again, there is nothing set in stone here, but a solid practice is to have a sub-folder called `scss/` if you want to develop with Sass, or `less/` if you prefer Less along with a `css/` folder to put static CSS files, and a `css-compiled/` folder for any automatically generated files from your Sass or Less compilations.

How you organize your files here is completely up to you.  Feel free to follow our example in the default **antimatter** theme provided with the Grav Base package for some ideas.  We are using the **scss** variant of Sass which is more CSS-like, and frankly more natural to write.

To install Sass on your computer, simply [follow the instructions on the sass-lang.com](http://sass-lang.com/install) website.

1. Execute the simple provided scss shell script by typing `$ ./scss.sh` from the root of the theme.
2. Running the command directly `$ scss --sourcemap --watch scss:css-compiled` which is the same thing.

By default, this will compile your scss files into the `css-compiled/` folder.  You can then reference the resulting css file in your theme.

### Other Folders

We recommend creating individual folders at the root of your theme for `images/`, `fonts/` and `js/` to contain your custom theme images, any custom web fonts, and javascript files required.

## Theme Example

Let us use the default **antimatter** theme as an example, below you can see the overall structure of this theme:

![Theme Folders](theme-folders.png)

In this example, the actual `css`, `css-compiled`, `fonts`, `images`, `js`, `scss`, and `templates` files have been ignored to make it more readable.  The important thing to note is the overall structure of the theme.

>>>The `index.html` file is just a blank file.
