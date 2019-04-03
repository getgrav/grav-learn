---
title: Customization
taxonomy:
    category: docs
---

There are many ways to customize a theme, and Grav really doesn't limit your creativity regarding this. However, there are several features and some functionality that Grav provides to make this process easier.

## Custom CSS

The simplest way to customize a theme is to provide your own `custom.css` file. The **Antimatter** default theme provides a reference to a `css/custom.css` file via the **Asset Manager**. Luckily, the **Asset Manager** handles this for us, and if the file is not found, the reference is not added to the HTML.

However, if you do provide a file called `custom.css` in Antimatter's `css/` folder, this will get picked up and referenced. You just need to ensure that you provide CSS elements with enough [specificity](http://www.smashingmagazine.com/2007/07/27/css-specificity-things-you-should-know/) to override the default CSS. For example:

**custom.css**

[prism classes="language-css line-numbers"]
body a {
    color: #CC0000;
}
[/prism]

This will override the default link color and use a **red** color instead.

## Custom SCSS/LESS

The next step up from providing a custom CSS file is to use the `custom.scss` file (as provided in Antimatter). Antimatter is written using [SCSS](http://sass-lang.com/), which is a CSS compatible preprocessor that enables you to write CSS more efficiently via the use of [variables, nested structures, partials, imports, operators and mix-ins](http://sass-lang.com/guide).

This may sound a little daunting at first, but you can use as much or as little SCSS as you like, and once you start, you will have trouble going back to traditional CSS. Promise!

To make use of SCSS you need to use a SCSS compiler. Lucky these are [easily installed](http://sass-lang.com/install) on any platform and come in a variety of forms including a command-line tool, and many GUI applications. Frankly, the command line is all you need.

The Antimatter theme has an `scss/` folder that contains a variety of `.scss` files. These should be compiled into the `css-compiled/` folder. Once installed, open your terminal application, navigate to the install folder `my-grav-install/my-theme/` and you can simply type:

[prism classes="language-css"]
scss --watch scss:css-compiled
[/prism]

This command tells the SCSS compiler to **watch** the `scss` directory and compile any time there are updates saved into the `css-compiled` folder. Exactly what we want!

There is a file called `scss/template/_custom.scss` that is a great location for your custom SCSS code. There are several great benefits of putting your code in this file:

1. The resulting changes will be compiled into the `css-compiled/template.css` file along with all the other CSS.
2. You have access to all the variables and mix-ins that are available to any of the other SCSS used in the theme.
3. You have access to all the standard SCSS features and functionality to make development easier.

An example of this file would be:

**_custom.scss**

[prism classes="language-css line-numbers"]
body {
    a {
        color: darken($core-accent, 30%);
    }
}
[/prism]

The downside to this approach is that this file is overwritten during any *theme upgrade*, so you should ensure you create a backup of any custom work you do.  This issue is resolved by using theme inheritance as described below.

## Wellington SCSS

[Wellington](https://github.com/wellington/wellington) is a native wrapper for [libsass](http://libsass.org/) available for both Linux and MacOS. It provides a much faster solution for compiling SCSS than the default Ruby-based scss compiler.  By faster we mean about **20X faster!**. It's super easy to install (via brew):

[prism classes="language-bash command-line"]
brew install wellington
[/prism]

To take advantage of it to compile and `scss` folder into a `css-compiled` folder as in the example above you can [use this gist](https://gist.github.com/rhukster/bcfe030e419028422d5e7cdc9b8f75a8).

!! Wellington is what we have been using for all _Team Grav_ themes and it's been working great!


## Theme Inheritance

This is the preferred approach to modifying or customizing a theme, but it does require a little bit more setup.

The basic concept is that you define a theme as the **base-theme** that you are inheriting from, and provide **only the bits you wish to modify** and let the base theme handle the rest. The great benefit to this is that you can more easily keep the base theme updated and current without directly impacting your customized inherited theme.

To achieve this you need to follow these steps:

1. Create a new folder: `user/themes/mytheme` to house your new theme.
2. Copy the theme YAML file from the theme you're inheriting (or from the `user/config/themes` folder if you have customized it) to `/user/themes/mytheme/mytheme.yaml` and add the following content (replacing `user/themes/antimatter` with the name of the theme you are inheriting):
   [prism classes="language-yaml line-numbers"]
   streams:
     schemes:
       theme:
         type: ReadOnlyStream
         prefixes:
           '':
             - user/themes/mytheme
             - user/themes/antimatter
   [/prism]
3. Create a `/user/themes/mytheme/blueprints.yaml` file that contains at least the basic elements required to define a theme:
   [prism classes="language-yaml line-numbers"]
   name: MyTheme
   version: 1.0.0
   description: "Extending Antimatter"
   icon: crosshairs
   author:
     name: Team Grav
     email: devs@getgrav.org
     url: https://getgrav.org
   [/prism]
   You can provide more details including form definitions to control functionality of your form.  For more details on this you should examine the Antimatter theme's blueprint.yaml file

4. Change your default theme to use your new **mytheme** by editing the `pages: theme:` option in your `user/config/system.yaml` configuration file:
   [prism classes="language-yaml line-numbers"]
   pages:
     theme: mytheme
   [/prism]

5. Create a new theme Class file that can be used to add advanced event-driven functionality. Create a `user/themes/mytheme/mytheme.php` file:
   [prism classes="language-php line-numbers"]
   <?php
   namespace Grav\Theme;

   class Mytheme extends Antimatter
   {
       // Some new methods, properties etc.
   }
   ?>
   [/prism]

You have now created a new theme called **mytheme** and set up the streams so that it will first look in the **mytheme** theme first, then try **antimatter**.  So in essence, Antimatter is the base-theme for this new theme.

You can then provide just the files you need, including **JS**, **CSS**, or even modifications to **Twig template files** if you wish.
In order to modify specific **SCSS** files, we need to use a little configuration magic for the SCSS compiler so it knows to look in your new `mytheme` location first, then `antimatter` second. This requires a couple of things.

1. First, you need to copy over the main SCSS file from antimatter that contains all the `@import` calls for various sub files, including the `template/_custom.scss`. So, copy the `template.scss` file from `antimatter/scss/` to `mytheme/scss/` folder.
2. Run the SCSS compiler and provide it with a `load-path` that points to the `antimatter/scss/` folder that will contain the bulk of the SCSS files:
   [prism classes="language-bash command-line"]
   scss --load-path ../antimatter/scss --watch scss:css-compiled
   [/prism]
3. The next step is to create a file located at `mytheme/scss/template/_custom.scss`. This is where your modifications will go.

When you make changes in your custom SCSS file, all the SCSS will be recompiled into `mytheme/css-compiled/template.css` and automatically referenced correctly by Grav.

For more information on this topic, please check out the blog post titled *[Theme Development with Inheritance](https://getgrav.org/blog/theme-development-with-inheritance)*.



