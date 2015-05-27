---
title: Theme Tutorial
taxonomy:
    category: docs
---

Often, the best way to learn a new thing is to use an example, and then try to build your own creation from it. We are going to use this same methodology for creating a new Grav theme.

## Antimatter

Grav comes with a clean and modern theme called **Antimatter** which uses a simple base set of CSS styling that we call **Nucleus**.

Nucleus is a lightweight CSS framework that contains the essential CSS resets and styling for layout and HTML markup without any over-bearing design.  Antimatter has some custom styling on top of the Nucleus framework to give it a unique look and feel.

## Bootstrap

For the sake of this tutorial, we will create a theme that utilizes the popular [Bootstrap framework](http://getbootstrap.com/).

Bootstrap is a full-featured HTML, CSS, and JS framework that contains a wide variety of components and styling to help create sites quickly. Over the past several years, Bootstrap has become a very popular framework. It is often used as a base for other designs because it already has essential styling for pretty much anything you can think of.

## Step 1 - Base Theme Setup

As outlined in the [Theme Basics](../theme-basics) chapter, there are some key elements to a Grav theme, so we must create them for our new theme:

1. Follow the [Installation instruction](../../basics/installation) and ensure you have Grav properly installed.

2. Create a folder called `bootstrap` within the `user/themes` folder of your Grav site to provide the basis of our new theme.

3. In your new `user/themes/bootstrap` folder you just created, create these folders:

	```
	css/
	fonts/
	images/
	js/
	templates/
	```

4. Next, create a Theme file called `bootstrap.php` in your `user/themes/bootstrap` folder with the following content:

	```
	<?php
	namespace Grav\Theme;

	use Grav\Common\Theme;

	class Bootstrap extends Theme
	{

	}
	```

5. Then, create a Theme configuration file called `bootstrap.yaml` in your `/user/themes/bootstrap` folder with the following content:

   ```
   enabled: true
   ```

6. We will add a thumbnail later, and for now we will skip the `blueprints` folder and definition as we have no configuration options.  The `scss.sh` file is used for compiling SASS, and we'll just use regular CSS for this tutorial, so we do not need that either.

## Step 2 - Add Bootstrap

Of course, to create a Bootstrap theme, we must actually include Bootstrap in our theme.

In this tutorial, we will use the latest version available (at the time of writing latest version is **v3.2.0**) so you will need to [download the Bootstrap distribution package](http://getbootstrap.com/getting-started/#download). This package includes the essential bits needed to use the framework.

>>>> Be sure to download the regular version labeled "Compiled and minified CSS, JavaScript, and fonts. No docs or original source files are included."

Next **unzip** the package you downloaded into a temporary location. You should see **3 folders**: `css`, `fonts`, and `js`.  Copy the contents of each of these folders into the similarly-named folders you just created in your theme.

```
bootstrap
├── css
│   ├── bootstrap-theme.css
│   ├── bootstrap-theme.css.map
│   ├── bootstrap-theme.min.css
│   ├── bootstrap.css
│   ├── bootstrap.css.map
│   └── bootstrap.min.css
├── fonts
│   ├── glyphicons-halflings-regular.eot
│   ├── glyphicons-halflings-regular.svg
│   ├── glyphicons-halflings-regular.ttf
│   └── glyphicons-halflings-regular.woff
├── images
├── js
│   ├── bootstrap.js
│   └── bootstrap.min.js
├── templates
├── boostrap.yaml
└── bootstrap.php
```

## Step 3 - Base Template

As you know from the [previous chapter](../theme-basics), each item of content in Grav has a particular filename, e.g. `default.md`, which instructs the Grav to look for a rendering template called `default.html.twig`.  It is possible to put everything you need to display a page in this one file, and it would work fine. However, there is a better solution.

Utilizing the Twig [Extends](http://twig.sensiolabs.org/doc/tags/extends.html) tag you can define a base layout with [blocks](http://twig.sensiolabs.org/doc/tags/block.html) that you define. This enables any twig template to **extend** the base template, and provides definitions for any **block** defined in the base.

>>> As a general rule, we use the `templates/partials` folder to contain Twig templates that represent either little chunks of HTML, or are shared.

So we will now create a simple Bootstrap friendly base template:

1. Create a folder in your `user/themes/bootstrap/templates` folder called `partials`. We will use this folder to store our base template.

2. In this new `user/themes/bootstrap/templates/partials` folder, create a file called `base.html.twig` with the following content:

```
<!DOCTYPE html>
<html lang="en">
    <head>
        {% block head %}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {% if header.description %}
        <meta name="description" content="{{ header.description }}">
        {% else %}
        <meta name="description" content="{{ site.description }}">
        {% endif %}
        {% if header.robots %}
        <meta name="robots" content="{{ header.robots }}">
        {% endif %}
        <link rel="icon" type="image/png" href="{{ theme_url }}/images/favicon.png">

        <title>{% if header.title %}{{ header.title }} | {% endif %}{{ site.title }}</title>

        {% block stylesheets %}
        	{# Bootstrap core CSS #}
        	{% do assets.add('theme://css/bootstrap.min.css',101) %}

		{# Custom styles for this theme #}
        	{% do assets.add('theme://css/bootstrap-custom.css',100) %}

        	{{ assets.css() }}
        {% endblock %}

        {% block javascripts %}
            {% do assets.add('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', 101) %}
            {% do assets.add('theme://js/bootstrap.min.js') %}

            {% if browser.getBrowser == 'msie' and browser.getVersion >= 8 and browser.getVersion <= 9 %}
            	{% do assets.add('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') %}
                {% do assets.add('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') %}
            {% endif %}

            {{ assets.js() }}
        {% endblock %}

        {% endblock head %}
    </head>

      <body>

        {# include the header + navigation #}
        {% include 'partials/header.html.twig' %}

        <div class="container">
            {% block content %}{% endblock %}
        </div>

        <div class="footer">
            <div class="container">
                <p class="text-muted">Bootstrap Theme for <a href="http://getgrav.org">Grav</a></p>
            </div>
        </div>
    </body>
    {% block bottom %}{% endblock %}
</html>
```

## Step 4 - Breaking it Down

Please read over the code in the `base.html.twig` file to try to understand what is going on.  There are several key things to note:

1. The `{% block head %}{% endblock head %}` syntax defines an area in the base Twig template. Note that the use of `head` in the `{% endblock head %}` tag is not required, but is used here for readability.

2. An `if` statement is used to test if there is a meta **description** set in the page headers, if not, the template should render using the default `site.description` as defined in the `user/config/site.yaml` file.

3. The `theme_url` variable can be used to output the path to the current theme.

4. To make use of the **Asset Manager** we use the syntax: `{% do assets.add('theme://css/bootstrap.min.css',101) %}` where `theme://` is automatically converted to the current theme path, and the `101` represents an order where higher comes first, and no provided value defaults to `10`. If we need to add an asset that does not have a regular extension (i.e. `.../script.js?v=1.0.12` refering a CDN link for example), we need to address the asset type explicitly using `{% do assets.addCss('http://fonts.googleapis.com/css?family=Open+Sans') %}` or `assets.addJs` respectively.

5. The `{{ assets.css() }}` call is what triggers the template to render all the CSS link tags. Likewise, the `{{ assets.js() }}` will render all the JavaScript tags.

6. The use of `{# ... #}` is a Twig way of writing a comment without any output in the HTML as opposed to an HTML comment: `<!-- ... ->` that **does** output to HTML but is ignored by the browser.

7. The `{% include 'partials/header.html.twig' %}` tag causes another Twig template to be included.  This way we are able to break out the header into its own template file.

8. The use of `{% block content %}{% endblock %}` provides a placeholder that allows us to provide content from a template that extends this one.

9. Similar to the content block, the `{% block bottom %}{% endblock %}` is intended as a placeholder for templates to add custom JavaScript initialization or analytic codes.

## Step 5 - Header Template

If you read the code, you will remember seeing a reference just after the `<body>` tag that looked like: `{% include 'partials/header.html.twig' %}`.  This tells the Twig rendering engine to include another template file at this point.  We need to now create this file to provide our **header** and **navigation**.

In your `user/themes/bootstrap/templates/partials` folder, create a file called `header.html.twig` with the following content:

```html
<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Grav</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                {% for page in pages.children %}
                {% if page.visible %}
                {% set current_page = (page.active or page.activeChild) ? 'active' : '' %}
                <li class="{{ current_page }}"><a href="{{ page.url }}">{{ page.menu }}</a></li>
                {% endif %}
                {% endfor %}
            </ul>
        </div>
    </div>
</nav>
```

Most of this is standard **Bootstrap** output for creating a navbar, but the interesting part is the **for loop** that loops through the **top-level pages** and displays a menu item for each of them. This means that as you add more pages to your top-level `user/pages` folder, they will automatically be added to the menu.

### Step 6 - Default Template

As we explained in **Step 3**, we need to create a `default.html.twig` file that actually makes use of the newly created `partials/base.html.twig` and in turn, `partials/header.html.twig`.

In your `user/themes/bootstrap/templates/` folder, create a file called `default.html.twig` with the following content:

```
{% extends 'partials/base.html.twig' %}

{% block content %}
	{{ page.content }}
{% endblock %}
```

This is a very simple file because all of the hard-work has already been done by the `partials/base.html.twig` file.  All this file does is:

1. Extends the `partials/base.html.twig`

2. Tells the base template to use `{{ page.content }}` for the **content** block.

### Step 7 - Theme CSS

You might have noticed that in the `partials/base.html.twig` file we made reference to a custom theme css via Asset Manager: `do assets.add('theme://css/bootstrap-custom.css',100)`.  This file will house any custom CSS we need to fill in the gaps not provided by the Bootstrap CSS.

1. In your `user/themes/bootstrap/css` folder, create a file called `bootstrap-custom.css` with the following content:

		/* Constrain the width */
		.container {
		  width: auto;
		  max-width: 960px;
		  padding: 0 15px;
		}

		/* Center the footer text */
		.container .text-muted {
		  margin: 20px 0;
		  text-align: center;
		}

		/* Sticky footer styles
		-------------------------------------------------- */
		html {
		  position: relative;
		  min-height: 100%;
		}

		body {
		  /* Margin bottom by footer height */
		  margin-bottom: 60px;
		}

		.footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		  /* Set the fixed height of the footer here */
		  height: 60px;
		  background-color: #f5f5f5;
		}

		/* Typography */

		/* Tables */
		table {
			width: 100%;
			border: 1px solid #f0f0f0;
			margin: 30px 0;
		}

		th {
			font-weight: bold;
			background: #f9f9f9;
			padding: 5px;
		}

		td {
			padding: 5px;
			border: 1px solid #f0f0f0;
		}

		/* Notice Styles */
		blockquote {
			padding: 0 0 0 20px !important;
			font-size: 16px;
			color: #666;
		}
		blockquote > blockquote > blockquote {
			margin: 0;
		}

		blockquote > blockquote > blockquote p {
			padding: 15px;
			display: block;
			margin-top: 0rem;
			margin-bottom: 0rem;
			border: 1px solid #f0f0f0;
		}

		blockquote > blockquote > blockquote > p {
			/* Yellow */
			margin-left: -75px;
			color: #8a6d3b;
			background-color: #fcf8e3;
			border-color: #faebcc;
		}

		blockquote > blockquote > blockquote > blockquote > p {
			/* Red */
			margin-left: -100px;
			color: #a94442;
			background-color: #f2dede;
			border-color: #ebccd1;
		}

		blockquote > blockquote > blockquote > blockquote > blockquote > p {
			/* Blue */
			margin-left: -125px;
			color: #31708f;
			background-color: #d9edf7;
			border-color: #bce8f1;
		}

		blockquote > blockquote > blockquote > blockquote > blockquote > blockquote > p {
			/* Green */
			margin-left: -150px;
			color: #3c763d;
			background-color: #dff0d8;
			border-color: #d6e9c6;
		}

2. Most of this file contains Markdown-friendly **table** and **notice** style CSS that require CSS classes in normal bootstrap to utilize.

### Step 8 - Testing

Your finished **bootstrap theme** folder should now look something like this:

```bash
bootstrap
├── css
│   ├── bootstrap-custom.css
│   ├── bootstrap-theme.css
│   ├── bootstrap-theme.css.map
│   ├── bootstrap-theme.min.css
│   ├── bootstrap.css
│   ├── bootstrap.css.map
│   └── bootstrap.min.css
├── fonts
│   ├── glyphicons-halflings-regular.eot
│   ├── glyphicons-halflings-regular.svg
│   ├── glyphicons-halflings-regular.ttf
│   └── glyphicons-halflings-regular.woff
├── images
├── js
│   ├── bootstrap.js
│   └── bootstrap.min.js
├── templates
│   ├── partials
│   │   ├── base.html.twig
│   │   └── header.html.twig
│   └── default.html.twig
├── boostrap.yaml
└── bootstrap.php
```

The next step is to change your default theme to your new `bootstrap` theme and test it!

Open your `user/config/system.yaml` file and edit the line that currently says:

```
pages:
  theme: antimatter
```

and change it to:

```
pages:
  theme: bootstrap
```

Then, open your browser, and point it to your Grav site.  You should see something like this:

![](bootstrap-theme.png?lightbox&resize=600,400)

At this point you have created your first theme!  There are a couple of minor things missing:

1. Create a **favicon** in `images/favicon.png`.
2. Create a thumbnail of the new theme in `/images/thumbnail.jpg`.
3. Add missing **templates** for other pages other than `default.html.twig`, e.g. `blog.html.twig` that you might need.
