---
title: Asset Manager
taxonomy:
    category: docs
---

A new feature introduced in Grav 0.9.0 was the **Asset Manager** to unify the interface throughout Grav for adding and managing **CSS** and **JavaScript**.  The primary purpose of the Asset Manager is to simplify the process of adding assets from themes and plugins while providing enhanced capabilities such as ordering, and providing an **Asset Pipeline** that can be used to **minify** and **compress** assets to reduce the number of browser requests, and also the overall size of the assets.

The Asset Manager is just a class that is available throughout Grav via the plugin event hooks, but also directly in themes via Twig calls.

## Configuration

The Grav Asset Manager has a simple set of configuration options.  The default values are located in the system `system.yaml` file, but you can override any or all of them in your `user/config/system.yaml` file:

```
assets:                                # Configuration for Assets Manager (JS, CSS)
  css_pipeline: false                  # The CSS pipeline is the unification of multiple CSS resources into one file
  css_minify: true                     # Minify the CSS during pipelining
  css_rewrite: true                    # Rewrite any CSS relative URLs during pipelining
  js_pipeline: false                   # The JS pipeline is the unification of multiple JS resources into one file
  js_minify: true                      # Minify the JS during pipelining
```

## Assets in Themes

An example of how you can add CSS files in your theme can be found in the default **antimatter** theme that comes bundled with Grav. If you have a look at the `base.html.twig` partial and specifically the [stylesheets block](https://github.com/getgrav/grav-theme-antimatter/blob/develop/templates/partials/base.html.twig#L12-L28) you will see the following:

```
    {% block stylesheets %}
        {% do assets.addCss('theme://css-compiled/nucleus.css',102) %}
        {% do assets.addCss('theme://css-compiled/template.css',101) %}
        {% do assets.addCss('theme://css/font-awesome.min.css',100) %}
        {% do assets.addCss('theme://css/slidebars.min.css') %}

        {% if page.header.lightbox %}
            {% do assets.addCss('theme://css/featherlight.min.css') %}
        {% endif %}

        {% if browser.getBrowser == 'msie' and browser.getVersion == 10 %}
            {% do assets.addCss('theme://css/nucleus-ie10.css') %}
        {% endif %}

        {% if browser.getBrowser == 'msie' and browser.getVersion >= 8 and browser.getVersion <= 9 %}
            {% do assets.addCss('theme://css/nucleus-ie9.css') %}
            {% do assets.addCss('theme://css/pure-0.5.0/grids-min.css') %}
            {% do assets.addJs('theme://js/html5shiv-printshiv.min.js') %}
        {% endif %}

        {{ assets.css() }}
    {% endblock %}
```

The `block` twig tag just defines a region that can be replaced or appended to in templates that extend the one. Within the block, you will see a number of `do assets.addCss()` calls.

The `{% do %}` tag is actually [one built in to Twig](http://twig.sensiolabs.org/doc/tags/do.html) itself, and it lets you manipulate variables without generating any output.

The `addCss()` method adds CSS assets to the Asset Manager. If you specify a second numeric parameter, that sets the priority of the stylesheet. In this case we want `nucleus.css` to be first as it has the highest priority value.  You will notice the use of a **PHP stream wrapper** `theme://` to provide an easy way for Grav to determine the current theme's relative path.

The `assets.css()` call renders the CSS assets out as HTML tags.


## Available Methods

#### add(asset [, priority=10] [, pipeline=true])

The add method does its best attempt to match an asset based on file extension.  It is a convenience method, it's better to call one of the direct methods for CSS or JS.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets. The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

#### addCss(asset [, priority=10] [, pipeline=true])

This method will add assets to the list of CSS assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

#### addDirCss(directory)

Add an entire directory of CSS assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### addInlineCss(css)

Let's you add a string of CSS inside an inline style tag. Useful for initialization or anything dynamic.

#### addJs(asset [, priority=10] [, pipeline=true])

This method will add assets to the list of JavaScript assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

#### addDirJs(directory)

Add an entire directory of JavaScript assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### addInlineJs(javascript)

Let's you add a string of JavaScript inside an inline script tag. Useful for initialization or anything dynamic.

#### css()

Retrieves a list of HTML CSS link tags based on all the CSS assets that have been added to the Asset Manager. Depending on whether or not pipelining has been turned on in the configuration, this could be a list of individual assets, or one combined and potentially minified file.

#### js()

Retrieves a list of HTML JavaScript link tags based on all the JavaScript assets that have been added to the Asset Manager. Depending on whether or not pipelining has been turned on in the configuration, this could be a list of individual assets, or one combined and potentially minified file.

#### registerCollection(name, array)

Allows you to register an array of JS and JavaScript assets with a name for later use by the `add()` method. Particularly useful if you want to register a collection that may be used by multiple themes or plugins, such as jQuery or Bootstrap.

## Named Assets

Grav now has a powerful feature called **named assets** that allows you to register a collection of CSS and JavaScript assets with a name.  Then you can simply **add** those assets to the Asset Manager via the name you registered the collection with.  Grav comes preconfigured with **jQuery** but has the ability to define custom collections in the `system.yaml` to be used by any theme or plugin:

```
assets:
  collections:
    jquery: system://assets/jquery/jquery-2.1.3.min.js
    bootstrap:
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js
```

You can also use the `registerCollection()` method programatically.

```
$assets = $this->grav['assets'];
$bootstrapper_bits = [https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css,
                      https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css,
                      https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js];
$assets->registerCollection('bootstrap', $bootstrap_bits);
$assets->add('bootstrap', 100);
```

An example of this action can be found in the [**bootstrapper** plugin](https://github.com/getgrav/grav-plugin-bootstrapper/blob/develop/bootstrapper.php#L51-L71).

## Static Assets

Sometimes there is a need to reference assets without using the Asset Manager.  There is a `url()` helper method available to achieve this.  An example of this could be if you wanted to reference an image from the theme. The syntax for this is:

```
<img src="{{ url("theme://" ~ widget.image) }}" alt="{{ widget.text|e }}" />
```

The `url()` method takes an optional second parameter of `true` or `false` to enable the URL to include the schema and domain. By default this value is assumed `false` resulting in just the relative URL.  For example:

```
url("theme://some/extra.css", true)
```
