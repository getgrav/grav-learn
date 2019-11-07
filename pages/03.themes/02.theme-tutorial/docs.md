---
title: Theme Tutorial
page-toc:
  active: true
taxonomy:
    category: docs
---

Often, the best way to learn a new thing is to use an example, and then try to build your own creation from it. We are going to use this same methodology for creating a new Grav theme.

## Quark

Grav comes with a clean and modern theme called **Quark** which uses the [Spectre.css framework](https://picturepan2.github.io/spectre/).

Spectre.css is a lightweight, responsive and modern CSS framework for faster and extensible development.

Spectre provides basic styles for typography and elements, flexbox based responsive layout system, pure CSS components and utilities with best practice coding and consistent design language.

However, it's often better to start from something even simpler.

## Pure.css

For the sake of this tutorial, we will create a theme that utilizes the popular [Pure.css framework](http://purecss.io/)  developed by Yahoo!

Pure is a small, fast, and responsive CSS framework that contains the basics to get you developing your site without the overhead of larger frameworks such as [Bootstrap](http://getbootstrap.com/css/) or [Foundation](http://foundation.zurb.com/). It contains several modules that can be used independently, but all together the resulting package is only **4.0KB minified and gzipped**!

You can read up on all the features Pure brings to the table on the [Pure.css project site](http://purecss.io/).

Also, you should read the [Important Theme Updates](https://getgrav.org/blog/important-theme-updates) blog article that outlines some key changes in Grav themes to provide the best plugin support going forward.

## Step 1 - Install DevTools Plugin

!! Previous versions of this tutorial required creating a base theme by default.  This whole process can be skipped thanks to our new **DevTools Plugin**

The first step in creating a new theme is to **install the DevTools Plugin**.  This can be done in two ways.

#### Install via CLI GPM

* Navigate in the command line to the root of your Grav installation.

[prism classes="language-bash command-line"]
bin/gpm install devtools
[/prism]

#### Install via Admin Plugin

* After logging in, simply navigate to the **Plugins** section from the sidebar.
* Click the <i class="fa fa-plus"></i> **Add** button in the top right.
* Find **DevTools** in the list and click the <i class="fa fa-plus"></i> **Install** button.

## Step 2 - Create Base Theme

For this next step you really do need to be in the [command line](/cli-console/command-line-intro) as the DevTools provide a couple of CLI commands to make the process of creating a new theme much easier!

From the root of your Grav installation enter the following command:

[prism classes="language-bash command-line"]
bin/plugin devtools new-theme
[/prism]

This process will ask you a few questions that are required to create the new theme:

! We're going to use **pure-blank** to create a new theme, but you can create a simple **inheritance** style template that inherits from another base theme

[prism classes="language-bash command-line" cl-output="2-15"]
bin/plugin devtools new-theme

Enter Theme Name: MyTheme
Enter Theme Description: My New Theme
Enter Developer Name: Acme Corp
Enter Developer Email: contact@acme.co
Please choose a template type
  [pure-blank ] Basic Theme using Pure.css
  [inheritance] Inherit from another theme
  [copy       ] Copy another theme
 > pure-blank

SUCCESS theme mytheme -> Created Successfully

Path: /www/user/themes/my-theme
[/prism]

The DevTools command tells you where this new template was created. This created template is fully functional but also very simple.  You will want to modify this to suit your needs.

In order to see your new theme in action, you will need to change the default theme from `quark` to `my-theme`, so edit your `user/config/system.yaml` and change it:

[prism classes="language-yaml line-numbers"]
...
pages:
    theme: my-theme
...
[/prism]

Reload your site in your browser and you should see the theme has now changed.

## Step 3 - Theme Basics

Now we've created a new basic theme that can be modified and developed, let's break it down and have a look at what makes up a theme.  If you look in the `user/themes/my-theme` folder you will see:

[prism classes="language-text"]
.
├── CHANGELOG.md
├── LICENSE
├── README.md
├── blueprints.yaml
├── css
│   └── custom.css
├── fonts
├── images
│   └── logo.png
├── js
├── my-theme.php
├── my-theme.yaml
├── screenshot.jpg
├── templates
│   ├── default.html.twig
│   ├── error.html.twig
│   └── partials
│       ├── base.html.twig
│       ├── header.html.twig
│       ├── metadata.html.twig
│       └── navigation.html.twig
└── thumbnail.jpg
[/prism]

This is a sample structure but some things are required:

### Required Items to Function

These items are critical and your theme will not function reliably unless you include these in your theme.

* **`blueprints.yaml`** - The configuration file used by Grav to get information on your theme. It can also define a form that the admin can display when viewing the theme details.  This form will let you save settings for the theme. [This file is documented in the Forms chapter](/forms/blueprints).
* **`my-theme.php`** - This file will be named according to your theme, but can be used to house any logic your theme needs.  You can use any [plugin event hook](/plugins/event-hooks) except `onPluginsInitialized()`, however there is a theme specific `onThemeInitialized()` hook specific for themes that you can use instead.
* **`my-theme.yaml`** - This is the configuration used by the plugin to set options the theme might use.
* **`templates/`** - This is a folder that contains the Twig templates to render your pages.

### Required Items for Release

These items are required if you wish to release your theme via GPM.

* **`CHANGELOG.md`** - A file that follows the [Grav Changelog Format](/advanced/grav-development#changelog-format) to show changes in releases.
* **`LICENSE`** - a license file, should probably be MIT unless you have a specific need for something else.
* **`README.md`** - A 'Readme' that should contain any documentation for the theme.  How to install it, configure it, and use it.
* **`screenshot.jpg`** - 1009px x 1009px screenshot of the theme.
* **`thumbnail.jpg`** - 300px x 300px screenshot of the theme.


## Step 4 - Base Template

As you know from the [previous chapter](../theme-basics), each item of content in Grav has a particular filename, e.g. `default.md`, which instructs Grav to look for a rendering Twig template called `default.html.twig`.  It is possible to put everything you need to display a page in this one file, and it would work fine. However, there is a better solution.

Utilizing the Twig [Extends](http://twig.sensiolabs.org/doc/tags/extends.html) tag you can define a base layout with [blocks](http://twig.sensiolabs.org/doc/tags/block.html) that you define. This enables any twig template to **extend** the base template, and provides definitions for any **block** defined in the base.  So look at the `templates/default.html.twig` file and examine its content:

[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% block content %}
    {{ page.content }}
{% endblock %}
[/prism]

There are really two things going on here.

First, the template extends a template located in `partials/base.html.twig`.

! You don't need to include `templates/` within Twig templates as Twig is already looking in `templates/` as the root level for any template.

Second, the block `content` is overridden from the base template, and the page's content is output in its place.

!! For consistency, it's a good idea to use the `templates/partials` folder to contain Twig templates that represent either little chunks of HTML, or are shared. We also use `templates/modular` for modular templates, and `templates/forms` for any forms.  You can create any sub-folders you like if you prefer to organize your templates differently.

If you look at the `templates/partials/base.html.twig` you will see the meat of the HTML layout:

[prism classes="language-twig line-numbers"]
{% set theme_config = attribute(config.themes, config.system.pages.theme) %}
<!DOCTYPE html>
<html lang="{{ grav.language.getActive ?: theme_config.default_lang }}">
<head>
{% block head %}
    <meta charset="utf-8" />
    <title>{% if header.title %}{{ header.title|e('html') }} | {% endif %}{{ site.title|e('html') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {% include 'partials/metadata.html.twig' %}

    <link rel="icon" type="image/png" href="{{ url('theme://images/logo.png') }}" />
    <link rel="canonical" href="{{ page.url(true, true) }}" />
{% endblock head %}

{% block stylesheets %}
    {% do assets.addCss('http://yui.yahooapis.com/pure/0.6.0/pure-min.css', 100) %}
    {% do assets.addCss('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', 99) %}
    {% do assets.addCss('theme://css/custom.css', 98) %}
{% endblock %}

{% block javascripts %}
    {% do assets.addJs('jquery', 100) %}
{% endblock %}

{% block assets deferred %}
    {{ assets.css()|raw }}
    {{ assets.js()|raw }}
{% endblock %}

</head>
<body id="top" class="{{ page.header.body_classes }}">

{% block header %}
    <div class="header">
        <div class="wrapper padding">
            <a class="logo left" href="{{ base_url == '' ? '/' : base_url }}">
                <i class="fa fa-rebel"></i>
                {{ config.site.title }}
            </a>
            {% block header_navigation %}
            <nav class="main-nav">
                {% include 'partials/navigation.html.twig' %}
            </nav>
            {% endblock %}
        </div>
    </div>
{% endblock %}

{% block body %}
    <section id="body">
        <div class="wrapper padding">
        {% block content %}{% endblock %}
        </div>
    </section>
{% endblock %}

{% block footer %}
    <div class="footer text-center">
        <div class="wrapper padding">
            <p><a href="https://getgrav.org">Grav</a> was <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a href="http://www.rockettheme.com">RocketTheme</a>.</p>
        </div>
    </div>
{% endblock %}

{% block bottom %}
    {{ assets.js('bottom')|raw }}
{% endblock %}

</body>
[/prism]

## Step 5 - Breaking it Down

Please read over the code in the `base.html.twig` file to try to understand what is going on.  There are several key things to note:

1. A `theme_config` variable is set with the theme configuration.  Because Twig doesn't work well with dashes, to retrieve variables with dashes (e.g. `config.themes.my-theme`), we use the `attribute()` Twig function to dynamically retrieve the `my-theme` data from `config.themes`.

1. The `<html lang=...` item is set based on Grav's active language if enabled, else it uses the `default_lang` as set in the `theme_config`.

1. The `{% block head %}{% endblock head %}` syntax defines an area in the base Twig template. Note that the use of `head` in the `{% endblock head %}` tag is not required, but is used here for readability. In this block we put things that are typically located in the HTML `<head>` tag.

1. The `<title>` tag is dynamically set based on the page's `title` variable as set in the page header.  The `header.title` is a shortcut method but is equivalent to `page.header.title`.

1. After a couple of standard meta tags are set, there is a reference to include `partials/metadata.html.twig`.  This file contains a loop that loops over the page's metadata.  This is actually a merge of metadata from `site.yaml` and any page-specific overrides.

1. The `<link rel="icon"...` entry is set by pointing to a theme-specific image.  In this case it's located in theme directory under `images/logo.png`.  The syntax for this is `{{ url('theme://images/logo.png') }}`.

1. The `<link rel="canonical"...` entry sets a canonical URL for the page that is always set to the full URL of the page via `{{ page.url(true, true) }}`.

1. Now we define a block called `stylesheets`, and in here we use the [Asset Manager](/themes/asset-manager) to add several assets.  The first one loads the Pure.css framework.  The second one loads [FontAwesome](http://fontawesome.io/) to provide useful icons.  The last entry points to a `custom.css` file in the theme's `css/` folder.  In here are a few useful styles to get you started, but you can add more here.  Also you can add other CSS file entries as needed.

1. The `{{ assets.css()|raw }}` call is what triggers the template to render all the CSS link tags.

1. The `javascripts` block, like the `stylesheets` block is a good place to put your JavaScript files.  In this example, we only add the 'jquery' library which is already bundled with Grav, so you don't need to provide a path to it.

1. The `{{ assets.js()|raw }}` will render all the JavaScript tags.

1. The `<body>` tag has a class attribute that will output anything you set in the `body_classes` variable of the page's frontmatter.

1. The `header` block has a few things that output the HTML header of the page.  One important thing to note is the logo is hyperlinked to the `base_url` with the logic: `{{ base_url == '' ? '/' : base_url }}`.  This is to ensure that if there is no subdirectory, the link is just `/`.

1. The title of the site is output as the logo in this example theme with `{{ config.site.title }}` but you could just replace this with a `<img>` tag to a logo if you wanted.

1. The `<nav>` tag actually contains a link to `partials/navigation.html.twig` that contains the logic to loop over any **visible** pages and display them as a menu.  By default it supports dropdown menus for nested pages, but this can be turned off via the theme's configuration.  Have a look in this navigation file to get an idea of how the menu is generated.

1. The use of `{% block content %}{% endblock %}` provides a placeholder that allows us to provide content from a template that extends this one. Remember we overrode this in `default.html.twig` to output the page's content.

1. The `footer` block contains a simple footer, you can easily modify this for your needs.

1. Similar to the content block, the `{% block bottom %}{% endblock %}` is intended as a placeholder for templates to add custom JavaScript initialization or analytic codes. In this example, we output any JavaScript that was added to the `bottom` Asset Group.  Read more about this in the [Asset Manager](/themes/asset-manager) documentation.


## Step 6 - Theme CSS

You might have noticed that in the `partials/base.html.twig` file we made reference to a custom theme css via Asset Manager: `do assets.add('theme://css/custom.css', 98)`.  This file will house any custom CSS we need to fill in the gaps not provided by the Pure.css framework.  As Pure is a very minimal framework, it provides the essentials but almost no styling.

1. In your `user/themes/my-theme/css` folder, view the `custom.css`:

[prism classes="language-css line-numbers"]
/* Core Stuff */
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

body {
    font-size: 1rem;
    line-height: 1.7;
    color: #606d6e;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    color: #454B4D;
}

a {
    color: #1F8CD6;
    text-decoration: none;
}

a:hover {
    color: #175E91;
}

pre {
    background: #F0F0F0;
    margin: 1rem 0;
    border-radius: 2px;
}

blockquote {
    border-left: 10px solid #eee;
    margin: 0;
    padding: 0 2rem;
}

/* Utility Classes */
.wrapper {
    margin: 0 3rem;
}

.padding {
    padding: 3rem 1rem;
}

.left {
    float: left;
}

.right {
    float: right
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.text-left {
    text-align: left;
}

/* Content Styling */
.header .padding {
    padding: 1rem 0;
}

.header {
    background-color: #1F8DD6;
    color: #eee;
}

.header a {
    color: #fff;
}

.header .logo {
    font-size: 1.7rem;
    text-transform: uppercase;
}

.footer {
    background-color: #eee;
}

/* Menu Settings */
.main-nav ul {
    text-align: center;
    letter-spacing: -1em;
    margin: 0;
    padding: 0;
}

.main-nav ul li {
    display: inline-block;
    letter-spacing: normal;
}

.main-nav ul li a {
    position: relative;
    display: block;
    line-height: 45px;
    color: #fff;
    padding: 0 20px;
    white-space: nowrap;
}

.main-nav > ul > li > a {
    border-radius: 2px;
}

/*Active dropdown nav item */
.main-nav ul li:hover > a {
    background-color: #175E91;
}

/* Selected Dropdown nav item */
.main-nav ul li.selected > a {
    background-color: #fff;
    color: #175E91;
}

/* Dropdown CSS */
.main-nav ul li {position: relative;}

.main-nav ul li ul {
    position: absolute;
    background-color: #1F8DD6;
    min-width: 100%;
    text-align: left;
    z-index: 999;

    display: none;
}
.main-nav ul li ul li {
    display: block;
}

/* Dropdown CSS */
.main-nav ul li ul ul {
    left: 100%;
    top: 0;
}

/* Active on Hover */
.main-nav li:hover > ul {
    display: block;
}

/* Child Indicator */
.main-nav .has-children > a {
    padding-right: 30px;
}
.main-nav .has-children > a:after {
    font-family: FontAwesome;
    content: '\f107';
    position: absolute;
    display: inline-block;
    right: 8px;
    top: 0;
}

.main-nav .has-children .has-children > a:after {
    content: '\f105';
}

[/prism]

This is pretty standard CSS stuff and sets some basic margins, fonts, colors, and utility classes. There is some basic content styling and some more extensive styling required to render the drop-down menu.  Feel free to modify this file as you need, or even add new CSS files (just ensure you add a reference in the `head` block by following the example for `custom.css`).

## Step 7 - Testing

To see your theme in action, open your browser, and point it to your Grav site.  You should see something like this:

![](pure-theme.png?lightbox&resize=800,600)

Congratulations, you have created your first theme!
