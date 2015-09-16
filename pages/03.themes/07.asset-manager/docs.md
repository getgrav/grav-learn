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
    {% do assets.addCss('theme://css/pure-0.5.0/grids-min.css', 103) %}
    {% do assets.addCss('theme://css-compiled/nucleus.css',102) %}
    {% do assets.addCss('theme://css-compiled/template.css',101) %}
    {% do assets.addCss('theme://css/custom.css',100) %}
    {% do assets.addCss('theme://css/font-awesome.min.css',100) %}
    {% do assets.addCss('theme://css/slidebars.min.css') %}

    {% if browser.getBrowser == 'msie' and browser.getVersion == 10 %}
        {% do assets.addCss('theme://css/nucleus-ie10.css') %}
    {% endif %}
    {% if browser.getBrowser == 'msie' and browser.getVersion >= 8 and browser.getVersion <= 9 %}
        {% do assets.addCss('theme://css/nucleus-ie9.css') %}
        {% do assets.addJs('theme://js/html5shiv-printshiv.min.js') %}
    {% endif %}
{% endblock %}
{{ assets.css() }}
```

The `block` twig tag just defines a region that can be replaced or appended to in templates that extend the one. Within the block, you will see a number of `do assets.addCss()` calls.

The `{% do %}` tag is actually [one built in to Twig](http://twig.sensiolabs.org/doc/tags/do.html) itself, and it lets you manipulate variables without generating any output.

The `addCss()` method adds CSS assets to the Asset Manager. If you specify a second numeric parameter, that sets the priority of the stylesheet. In this case we want `nucleus.css` to be first as it has the highest priority value.  You will notice the use of a **PHP stream wrapper** `theme://` to provide an easy way for Grav to determine the current theme's relative path.

The `assets.css()` call renders the CSS assets out as HTML tags.

JavaScript assets are very similar:

```
{% block javascripts %}
    {% do assets.addJs('jquery',101) %}
    {% do assets.addJs('theme://js/modernizr.custom.71422.js',100) %}
    {% do assets.addJs('theme://js/antimatter.js') %}
    {% do assets.addJs('theme://js/slidebars.min.js') %}
    {% do assets.addInineJs('alert(\'This is inline!\')') %}
{% endblock %}
{{ assets.js() }}
```

## Adding Assets

#### add(asset, [options])

The add method does its best attempt to match an asset based on file extension.  It is a convenience method, it's better to call one of the direct methods for CSS or JS.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets. The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

>>> The options array is the preferred approach for passing multiple options. However as in the previous examples, you can use a shortcut and pass in an integer for the **second attribute** in the method if all you wish to set is the **priority**

#### addCss(asset, [options])

This method will add assets to the list of CSS assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

#### addDirCss(directory)

Add an entire directory of CSS assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### addInlineCss(css, [options])

Let's you add a string of CSS inside an inline style tag. Useful for initialization or anything dynamic.

#### addJs(asset, [options])

This method will add assets to the list of JavaScript assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The pipeline attribute controls whether or not this asset should be included in the combination/minify pipeline.

#### addInlineJs(javascript, [options])

Let's you add a string of JavaScript inside an inline script tag. Useful for initialization or anything dynamic.

#### addDirJs(directory)

Add an entire directory of JavaScript assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### registerCollection(name, array)

Allows you to register an array of CSS and JavaScript assets with a name for later use by the `add()` method. Particularly useful if you want to register a collection that may be used by multiple themes or plugins, such as jQuery or Bootstrap.

## Options

Where appropriate, you can pass in an array of asset options. Those options are

#### For CSS

* **priority** = Integer value (default value is `100`)
* **pipeline** = `false` if this asset should **not** be included in pipeline (default is `true`)

#### For JS

* **priority** = Integer value (default value is `100`)
* **pipeline** = `false` if this asset should **not** be included in pipeline (default is `true`)
* **loading** = supports empty, `async` and `defer`
* **group** = string to specify a unique group name for asset (default is `head`)

for example:

```
{% do assets.addJs('theme://js/example.js', {'priority':102, 'pipeline':false, 'loading':'async', 'group':'bottom'}) %}
```

## Rendering Assets

The following allow you to render the current state of the CSS and JavaScript assets

#### css()

Renders a list of HTML CSS link tags based on all the CSS assets that have been added to the Asset Manager. Depending on whether or not pipelining has been turned on in the configuration, this could be a list of individual assets, or one combined and potentially minified file.

#### js()

Renders a list of HTML JavaScript link tags based on all the JavaScript assets that have been added to the Asset Manager. Depending on whether or not pipelining has been turned on in the configuration, this could be a list of individual assets, or one combined and potentially minified file.

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

## Grouped Assets

A new feature was added in Grav **0.9.43** that lets you pass an optional `group` as part of an options array when adding assets.  This is most useful for JavaScript where you may need to have some JS files or Inline JS referenced in the header, and some at the bottom of the page.  Prior to this Grav release, this was not possible using the Asset manager, but it is now.

To take advantage of this capability you must specify the group when adding the asset, and should use the options syntax:

```
{% do assets.addJs('theme://js/example.js', {'priority':102, 'group':'bottom'}) %}
```

Then for these assets in the bottom group to render, you must add the following to your theme:

```
{{ assets.js('bottom') }}
```

If no group is defined for an asset, then `head` is the default group.  If no group is set for rendering, the `head` group will be rendered. This ensures thew new functionality is 100% backwards compatible with existing themes.

## Static Assets

Sometimes there is a need to reference assets without using the Asset Manager.  There is a `url()` helper method available to achieve this.  An example of this could be if you wanted to reference an image from the theme. The syntax for this is:

```
<img src="{{ url("theme://" ~ widget.image) }}" alt="{{ widget.text|e }}" />
```

The `url()` method takes an optional second parameter of `true` or `false` to enable the URL to include the schema and domain. By default this value is assumed `false` resulting in just the relative URL.  For example:

```
url("theme://some/extra.css", true)
```
