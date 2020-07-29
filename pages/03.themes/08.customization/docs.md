---
title: Customization
taxonomy:
    category: docs
---

There are many ways to customize a theme, and Grav really doesn't limit your creativity regarding this. However, there are several features and some functionality that Grav provides to make this process easier.

## Custom CSS

The simplest way to customize a theme is to provide your own `custom.css` file. The **Quark** default theme provides a reference to a `css/custom.css` file via the **Asset Manager**. Luckily, the **Asset Manager** handles this for us, and if the file is not found, the reference is not added to the HTML.

However, if you do provide a file called `custom.css` in Quark's `css/` folder, this will get picked up and referenced. You just need to ensure that you provide CSS elements with enough [specificity](http://www.smashingmagazine.com/2007/07/27/css-specificity-things-you-should-know/) to override the default CSS. For example:

**custom.css**

[prism classes="language-css line-numbers"]
body a {
    color: #CC0000;
}
[/prism]

This will override the default link color and use a **red** color instead.

## Custom SCSS/LESS

The next step up from providing a custom CSS file is to use a `_custom.scss` file. Quark is written using [SCSS](http://sass-lang.com/), which is a CSS compatible preprocessor that enables you to write CSS more efficiently via the use of [variables, nested structures, partials, imports, operators and mix-ins](http://sass-lang.com/guide).

This may sound a little daunting at first, but you can use as much or as little SCSS as you like, and once you start, you will have trouble going back to traditional CSS. Promise!

The Quark theme has an `scss/` folder that contains a variety of `.scss` files. These should be compiled into the `css-compiled/` folder.

You can create a file called `scss/theme/_custom.scss` and import it to the `theme.scss` file at the bottom using `@import 'theme/custom';`. There are several great benefits of putting your code in this file:

1. The resulting changes will be compiled into the `css-compiled/theme.min.css` file along with all the other CSS.
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

There are two ways to inherit from an existing theme:

1. Using the Command Line Interface (CLI) with the DevTools plugin.
2. Manually.

### Inheriting using the CLI

As discussed in the [Theme Tutorial](https://learn.getgrav.org/16/themes/theme-tutorial), you can create a new theme using the DevTools plugin. But you can also inherit from an existing theme. The procedure is simple.

1. [Install the DevTools plugin](https://learn.getgrav.org/16/themes/theme-tutorial#step-1-install-devtools-plugin) if it is not already done.
2. Then follow the [Create Base Theme](https://learn.getgrav.org/16/themes/theme-tutorial#step-2-create-base-theme) procedure, but when asked to `Please choose a template type`, type `inheritance`. If Quark is the only theme, it will be displayed as option 0. So type `0` to inherit from Quark. Your new inherited theme will be created.
3. Copy all the options from the theme YAML file you are inheriting from (or from the `user/config/themes` folder if you have customized it) at the top of the newly created YAML configuration file of your theme: `/user/themes/mytheme/mytheme.yaml`.
4. Copy the “form” section from `/user/themes/quark/blueprints.yaml` file into `/user/themes/mytheme/blueprints.yaml` in order to include the customizable elements of the theme in the admin. (Or simply replace the file and edit its content.)
5. Change your default theme to use your new **mytheme** by editing the `pages: theme:` option in your `user/config/system.yaml` configuration file:

   [prism classes="language-yaml line-numbers"]
   pages:
     theme: mytheme
   [/prism]

### Inheriting manually

To achieve this you need to follow these steps:

1. Create a new folder: `user/themes/mytheme` to house your new theme.
2. Copy the theme YAML file from the theme you're inheriting (or from the `user/config/themes` folder if you have customized it) to `/user/themes/mytheme/mytheme.yaml` and add the following content (replacing `user/themes/quark` with the name of the theme you are inheriting):

   [prism classes="language-yaml line-numbers"]
   streams:
     schemes:
       theme:
         type: ReadOnlyStream
         prefixes:
           '':
             - user/themes/mytheme
             - user/themes/quark
   [/prism]
   
3. Copy the `/user/themes/quark/blueprints.yaml` file into `/user/themes/mytheme/blueprints.yaml` in order to include the customizable elements of the theme in the admin.

4. Change your default theme to use your new **mytheme** by editing the `pages: theme:` option in your `user/config/system.yaml` configuration file:

   [prism classes="language-yaml line-numbers"]
   pages:
     theme: mytheme
   [/prism]

5. Create a new theme Class file that can be used to add advanced event-driven functionality. Create a `user/themes/mytheme/mytheme.php` file:

   [prism classes="language-php line-numbers"]
   <?php
   namespace Grav\Theme;

   class Mytheme extends Quark
   {
       // Some new methods, properties etc.
   }
   ?>
   [/prism]

You have now created a new theme called **mytheme** and set up the streams so that it will first look in the **mytheme** theme first, then try **quark**.  So in essence, Quark is the base-theme for this new theme.

You can then provide just the files you need, including **JS**, **CSS**, or even modifications to **Twig template files** if you wish.

### Using SCSS

In order to modify specific **SCSS** files, we need to use a little configuration so it knows to look in your new `mytheme` location first, then `quark` second. This requires a couple of things.

1. First, you need to copy over the main SCSS file from quark that contains all the `@import` calls for various sub files. So, copy the `theme.scss` file from `quark/scss/` to `mytheme/scss/` folder.
2. While inside the `theme.scss` file, change the beginning of all the import lines to `@import '../../quark/scss/theme/';` so it will know to use the files from the quark theme. So, for example the first line will be `@import '../../quark/scss/theme/variables';`.
3. Add `@import 'theme/custom';` at the very bottom of the `theme.scss` file.
4. The next step is to create a file located at `mytheme/scss/theme/_custom.scss`. This is where your modifications will go.
5. Copy the `gulpfile.js` and `package.json` files into the base folder of the new theme.

In order to compile the new scss for the **mytheme** you will need to open up terminal and navigate to the theme folder. Quark uses gulp to compile the sass so you will need those installed and yarn for the dependencies. Run `npm install -g gulp`, `yarn install`, and then `gulp watch`. Now, any changes made to the files will be recompiled.
