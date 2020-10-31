---
title: Asset Manager
page-toc:
  active: true
taxonomy:
    category: docs
---

A new feature introduced in Grav 0.9.0 was the **Asset Manager** to unify the interface throughout Grav for adding and managing **CSS** and **JavaScript**.  The primary purpose of the Asset Manager is to simplify the process of adding assets from themes and plugins while providing enhanced capabilities such as ordering, and providing an **Asset Pipeline** that can be used to **minify**, **compress** and **inline** assets to reduce the number of browser requests, and also the overall size of the assets.

The Asset Manager is just a class that is available throughout Grav via the plugin event hooks, but also directly in themes via Twig calls.

## Configuration

The Grav Asset Manager has a simple set of configuration options.  The default values are located in the system `system.yaml` file, but you can override any or all of them in your `user/config/system.yaml` file:

[prism classes="language-yaml line-numbers"]
assets:                                # Configuration for Assets Manager (JS, CSS)
  css_pipeline: false                  # If true, enables the CSS pipeline, combining multiple CSS resources into one
  css_pipeline_include_externals: true # Include external CSS resources from the pipeline
  css_pipeline_before_excludes: true   # Renders pipelined CSS resources before non-pipelined CSS resources
  css_minify: true                     # Minify the CSS during pipelining
  css_minify_windows: true             # If false, blocks minifying on Windows servers
  css_rewrite: true                    # Rewrite any CSS relative URLs during pipelining
  js_pipeline: false                   # If true, enables the JS pipeline, combining multiple JS resources into one
  js_pipeline_include_externals: true  # Include external JS resources from the pipeline
  js_pipeline_before_excludes: true    # Renders pipelined JS resources before non-pipelined JS resources
  js_minify: true                      # Minify the JS during pipelining
  enable_asset_timestamp: false        # If true, adds a URL query parameter to each asset link for cache invalidation
[/prism]

## Assets in Themes

### Overview

In general, you add CSS assets one by one using `assets.add*()` calls, then render those assets via `assets.css()`. Options controlling ordering, pipelining or inlining can be specified per asset when adding it, or at rendering time for a group of assets.

JS assets are handled likewise.

The Asset Manager also supports
* adding assets to named groups in order to render such groups at different places and/or with different sets of options,
* configuring named asset collections, which can be added in one `assets.add*()` call.

### Example

An example of how you can add CSS files in your theme can be found in the default **antimatter** theme that comes bundled with Grav. If you have a look at the `base.html.twig` partial and specifically the [stylesheets block](https://github.com/getgrav/grav-theme-antimatter/blob/develop/templates/partials/base.html.twig#L12-L28) you will see the following:

[prism classes="language-twig line-numbers"]
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
[/prism]

The `block` twig tag just defines a region that can be replaced or appended to in templates that extend the one. Within the block, you will see a number of `do assets.addCss()` calls.

The `{% do %}` tag is actually [one built in to Twig](http://twig.sensiolabs.org/doc/tags/do.html) itself, and it lets you manipulate variables without generating any output.

The `addCss()` method adds CSS assets to the Asset Manager. If you specify a second numeric parameter, that sets the priority of the stylesheet. In this case we want `grids-min.css` to be first as it has the highest priority value.  You will notice the use of a **PHP stream wrapper** `theme://` to provide an easy way for Grav to determine the current theme's relative path.

The `assets.css()` call renders the CSS assets out as HTML tags.

JavaScript assets are very similar:

[prism classes="language-js line-numbers"]
{% block javascripts %}
    {% do assets.addJs('jquery',101) %}
    {% do assets.addJs('theme://js/modernizr.custom.71422.js',100) %}
    {% do assets.addJs('theme://js/antimatter.js') %}
    {% do assets.addJs('theme://js/slidebars.min.js') %}
    {% do assets.addInlineJs('alert(\'This is inline!\')') %}
{% endblock %}
{{ assets.js() }}
[/prism]

## Adding Assets

#### add(asset, [options])

The add method does its best attempt to match an asset based on file extension.  It is a convenience method, it's better to call one of the direct methods for CSS or JS.  See the direct methods for details.

!! The options array is the preferred approach for passing multiple options. However as in the previous examples, you can use a shortcut and pass in an integer for the **second argument** in the method if all you wish to set is the **priority**.

#### addCss(asset, [options])

This method will add assets to the list of CSS assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The `pipeline` option controls whether or not this asset should be included in the combination/minify pipeline. If not pipelined, the `loading` option controls whether the asset should be rendered as a link to an external stylesheet or whether its contents should be inlined inside an inline style tag.

#### addDirCss(directory)

Add an entire directory of CSS assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### addInlineCss(css, [options])

Lets you add a string of CSS inside an inline style tag. Useful for initialization or anything dynamic.  To inline a regular asset file's content, see the `{'loading': 'inline'}` option of the `addCss()` and `css()` methods.

#### addJs(asset, [options])

This method will add assets to the list of JavaScript assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The `pipeline` option controls whether or not this asset should be included in the combination/minify pipeline. If not pipelined, the `loading` option controls whether the asset should be rendered as a link to an external script file or whether its contents should be inlined inside an inline script tag.

#### addInlineJs(javascript, [options])

Lets you add a string of JavaScript inside an inline script tag. Useful for initialization or anything dynamic.  To inline a regular asset file's content, see the `{'loading': 'inline'}` option of the `addJs()` and `js()` methods.

#### addDirJs(directory)

Add an entire directory of JavaScript assets in one go. The order will be alphabetical. This method does not provide the control of the individual methods and is generally not the preferred approach.

#### registerCollection(name, array)

Allows you to register an array of CSS and JavaScript assets with a name for later use by the `add()` method. Particularly useful if you want to register a collection that may be used by multiple themes or plugins, such as jQuery or Bootstrap.

## Options

Where appropriate, you can pass in an array of asset options. Those options are

#### For CSS

* **priority**: Integer value (default value is `10`)

* **pipeline**: `false` if this asset should **not** be included in pipeline (default is `true`)

* **loading**: `inline` if this asset should be inlined (default: referenced via a stylesheet link)

    effective only if `pipeline` is set to `false`, as pipeline inlining is controlled via the `loading` option of the `css()` rendering method

* **media**: a media query such as `only screen and (min-width: 640px)`

#### For JS

* **priority**: Integer value (default value is `10`)

* **pipeline**: `false` if this asset should **not** be included in pipeline (default is `true`)

* **loading**: supports empty, `async`, `defer`, `async defer` or `inline`

    effective only if `pipeline` is set to `false`, as pipeline inlining is controlled via the `loading` option of the `js()` rendering method

* **group**: string to specify a unique group name for asset (default is `head`)

for example:

[prism classes="language-twig"]
{% do assets.addJs('theme://js/example.js', {'priority':102, 'pipeline':false, 'loading':'async', 'group':'bottom'}) %}
[/prism]

## Rendering Assets

The following allow you to render the current state of the CSS and JavaScript assets.

#### css([group, [options]])

Renders CSS assets that have been added to an Asset Manager's group (default is `head`). Options are

* **loading**: `inline` if **all** assets in this group should be inlined (default: render each asset according to its `loading` option and do not inline the pipeline, if present)

* **_link attributes_**, see below (default: `{'type': 'text/css', 'rel': 'stylesheet'}`)

    effective only if `inline` is **not** used as this group's rendering option

If pipelining is turned **off** in the configuration, the group's assets are rendered individually, ordered by asset priority (high to low), followed by the order in which assets were added.

If pipelining is turned **on** in the configuration, assets not excluded from pipelining are combined in the order in which assets were added, then processed according to the pipeline configuration. The combined pipeline result is then rendered before or after non-pipelined assets depending on the setting of `css_pipeline_before_excludes`.

Each asset is rendered either as a stylesheet link or inline, depending on the asset's `loading` option and whether `{'loading': 'inline'}` is used for this group's rendering. Note that the only way to inline a CSS pipeline is to use inline loading as an option of the `css()` method.

CSS added by addInlineCss() is always rendered last.

#### js([group, [options]])

Renders JavaScript assets that have been added to an Asset Manager's group (default is `head`). Options are

* **loading**: `inline` if **all** assets in this group should be inlined (default: render each asset according to its `loading` option and do not inline the pipeline, if present)

* **_script attributes_**, see below (default: `{'type': 'text/javascript'}`)

    effective only if `inline` is **not** used as this group's rendering option

If pipelining is turned **off** in the configuration, the group's assets are rendered individually, ordered by asset priority (high to low), followed by the order in which assets were added.

If pipelining is turned **on** in the configuration, assets not excluded from pipelining are combined in the order in which assets were added, then processed according to the pipeline configuration. The combined pipeline result is then rendered before or after non-pipelined assets depending on the setting of `js_pipeline_before_excludes`.

Each asset is rendered either as a script link or inline, depending on the asset's `loading` option and whether `{'loading': 'inline'}` is used for this group's rendering. Note that the only way to inline a JS pipeline is to use inline loading as an option of the `js()` method.

JavaScript added by addInlineJs() is always rendered last.

## Named Assets

Grav now has a powerful feature called **named assets** that allows you to register a collection of CSS and JavaScript assets with a name.  Then you can simply **add** those assets to the Asset Manager via the name you registered the collection with.  Grav comes preconfigured with **jQuery** but has the ability to define custom collections in the `system.yaml` to be used by any theme or plugin:

[prism classes="language-yaml line-numbers"]
assets:
  collections:
    jquery: system://assets/jquery/jquery-2.1.3.min.js
    bootstrap:
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css
        - https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js
[/prism]

You can also use the `registerCollection()` method programmatically.

[prism classes="language-yaml line-numbers"]
$assets = $this->grav['assets'];
$bootstrapper_bits = ['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
                      'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css',
                      'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'];
$assets->registerCollection('bootstrap', $bootstrap_bits);
$assets->add('bootstrap', 100);
[/prism]

An example of this action can be found in the [**bootstrapper** plugin](https://github.com/getgrav/grav-plugin-bootstrapper/blob/develop/bootstrapper.php#L51-L71).

## Grouped Assets

A new feature was added in Grav **0.9.43** that lets you pass an optional `group` as part of an options array when adding assets.  This is useful for CSS, but especially for  JavaScript where you may need to have some JS files or Inline JS referenced in the header, and some at the bottom of the page.  Prior to this Grav release, this was not possible using the Asset manager, but it is now.

To take advantage of this capability you must specify the group when adding the asset, and should use the options syntax:

[prism classes="language-twig line-numbers"]
{% do assets.addJs('theme://js/example.js', {'priority':102, 'group':'bottom'}) %}
[/prism]

Then for these assets in the bottom group to render, you must add the following to your theme:

[prism classes="language-twig"]
{{ assets.js('bottom') }}
[/prism]

If no group is defined for an asset, then `head` is the default group.  If no group is set for rendering, the `head` group will be rendered. This ensures the new functionality is 100% backwards compatible with existing themes.

The same goes for CSS files:

[prism classes="language-twig"]
{% do assets.addCss('theme://css/ie8.css', {'group':'ie'}) %}
[/prism]

and to render:


[prism classes="language-twig"]
{{ assets.css('ie') }}
[/prism]

## Change attribute of the rendered CSS/JS assets

CSS is by default added using the `rel="stylesheet"` attribute, and `type="text/css"` , while JS has `type="text/javascript"`.

To change the defaults, or to add new attributes, you need to create a new group of assets, and tell Grav to render it with that attribute.

Example of editing the `rel` attribute on a group of assets:

[prism classes="language-twig"]
{% do assets.addCSS('theme://whatever.css', {'group':'my-alternate-group'}) %}
...
{{ assets.css('my-alternate-group', {'rel': 'alternate'}) }}
[/prism]

## Inlining Assets

The ability to inline CSS and JS assets was added in Grav **1.2.1**. Placing critical CSS (and JS) code directly into the HTML document enables the browser to render a page immediately without waiting for external stylesheet or script downloads. This can improve site performance noticeably for users, particularly over mobile networks. Details can be found in [this article on optimizing CSS delivery](https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery).

However, directly inserting CSS or JavaScript code into a page template is not always feasible, for example, where Sass-complied CSS is used. Keeping CSS and JS assets in separate files also simplifies maintenance. Using the Asset Manager's inline capability enables you to optimize for speed without changing the way your assets are stored. Even entire pipelines can be inlined.

To inline an asset file's content, use the option `{'loading': 'inline'}` with `addCss()` or `addJs()`. You can also inline all assets when rendering a group with `js()` or `css()`, which provide the same option.

Example of using `system.yaml` to define asset collections named according to asset loading requirements, with `app.css` being a [Sass](http://sass-lang.com/)-generated CSS file:

[prism classes="language-yaml line-numbers"]
assets:
  collections:
    css-inline:
      - 'http://fonts.googleapis.com/css?family=Ubuntu:400|Open+Sans:400,400i,700'
      - 'theme://css-compiled/app.css'
    js-inline:
      - 'https://use.fontawesome.com/<embedcode>.js'
    js-async:
      - 'theme://foundation/dist/assets/js/app.js'
      - 'theme://js/header-display.js'
[/prism]

The template inserts each collection into its corresponding group, namely `head` and `head-link` for CSS, `head` and `head-async` for JS. The default group `head` is used for inline loading in each case:

[prism classes="language-twig line-numbers"]
        {% block stylesheets %}
            {% do assets.addCss('css-inline') %}
            {% do assets.addCss('css-link', {'group': 'head-link'}) %}
        {% endblock %}
        {{ assets.css('head-link') }}
        {{ assets.css('head', {'loading': 'inline'}) }}
        {% block javascripts %}
            {% do assets.addJs('js-inline') %}
            {% do assets.addJs('js-async', {'group': 'head-async'}) %}
        {% endblock %}
        {{ assets.js('head-async', {'loading': 'async'}) }}
        {{ assets.js('head', {'loading': 'inline'}) }}
[/prism]

## Static Assets

Sometimes there is a need to reference assets without using the Asset Manager.  There is a `url()` helper method available to achieve this.  An example of this could be if you wanted to reference an image from the theme. The syntax for this is:

[prism classes="language-twig"]
<img src="{{ url("theme://" ~ widget.image) }}" alt="{{ widget.text|e }}" />
[/prism]

The `url()` method takes an optional second parameter of `true` or `false` to enable the URL to include the schema and domain. By default this value is assumed `false` resulting in just the relative URL.  For example:

[prism classes="language-twig"]
url("theme://some/extra.css", true)
[/prism]
