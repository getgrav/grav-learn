---
title: Asset Manager
page-toc:
  active: true
taxonomy:
    category: docs
---

In Grav 1.6, the **Asset Manager** has been completely rewritten to provide a more flexible mechanism for managing **CSS** and **JavaScript** assets in themes. The primary purpose of the Asset Manager is to simplify the process of adding assets from themes and plugins while providing enhanced capabilities such as priority, and providing an **Asset Pipeline** that can be used to **minify**, **compress** and **inline** assets to reduce the number of browser requests, and also the overall size of the assets.

It's much more flexible and more reliable than before. Also it's considerably 'cleaner' and easier to follow if you start poking through the code. The Asset Manager is available throughout Grav and can be accessed in plugin event hooks, but also directly in themes via Twig calls.

! **Technical Details**: The primary Assets class has been greatly simplified and reduced. Much of the logic has been broken out into 3 traits. A _testing trait_ which contains functions primarily used in our test suite, a _utils trait_ which contains methods that are shared between regular asset types (js, inline_js, css, inline_css) and the assets pipeline which can minify and compress, and lastly a _legacy trait_ which contains methods that are shortcuts or workarounds, and should generally not be used going forward.

!!! The Asset manager is fully backwards compatible with syntax used in versions prior to Grav 1.6, however, the documentation below will cover the new **preferred syntax**.

## Configuration

The Grav Asset Manager has a simple set of configuration options.  The default values are located in the system `system.yaml` file, but you can override any or all of them in your `user/config/system.yaml` file:

[prism classes="language-yaml line-numbers"]
assets:                                # Configuration for Assets Manager (JS, CSS)
  css_pipeline: false                  # The CSS pipeline is the unification of multiple CSS resources into one file
  css_pipeline_include_externals: true # Include external URLs in the pipeline by default
  css_pipeline_before_excludes: true   # Render the pipeline before any excluded files
  css_minify: true                     # Minify the CSS during pipelining
  css_minify_windows: false            # Minify Override for Windows platforms. False by default due to ThreadStackSize
  css_rewrite: true                    # Rewrite any CSS relative URLs during pipelining
  js_pipeline: false                   # The JS pipeline is the unification of multiple JS resources into one file
  js_pipeline_include_externals: true  # Include external URLs in the pipeline by default
  js_pipeline_before_excludes: true    # Render the pipeline before any excluded files
  js_minify: true                      # Minify the JS during pipelining
  enable_asset_timestamp: false        # Enable asset timestamps
  collections:
    jquery: system://assets/jquery/jquery-2.x.min.js
[/prism]

## Structure

There are multiple levels of positioning control as outlined in the diagram below.  In order of scope they are:

* **Group** - allows the grouping of assets such as `head`(default) and `bottom`
* **Position** - `before`, `pipeline`(default), and `after`.  Basically this allows you to specify where in the group the asset should be loaded.  
* **Priority** - This controls the **order**, where larger integers (e.g. `100`) will be output before lower integers. `10` is default.

[prism classes="language-text"]
 CSS
┌───────────────────────┐
│ Group (head)          │
│┌─────────────────────┐│        ┌──────────────────┐
││ Position            ││        │   priority 100   │─────┐     ┌──────────────────┐
││┌───────────────────┐││        ├──────────────────┤     ├────▶│       CSS        │
│││                   │││        │   priority 99    │─────┤     └──────────────────┘
│││      before       │├┼──┬────▶├──────────────────┤     │
│││                   │││  │     │    priority 1    │─────┤     ┌──────────────────┐
││├───────────────────┤││  │     ├──────────────────┤     ├────▶│    inline CSS    │
│││                   │││  │     │    priority 0    │─────┘     └──────────────────┘
│││     pipeline      │├┼──┤     └──────────────────┘
│││                   │││  │
││├───────────────────┤││  │
│││                   │││  │
│││       after       │├┼──┘
│││                   │││
││└───────────────────┘││
│└─────────────────────┘│
└───────────────────────┘


  JS
┌───────────────────────┐
│ Group (head)          │
│┌─────────────────────┐│        ┌──────────────────┐
││ Position            ││        │   priority 100   │─────┐     ┌──────────────────┐
││┌───────────────────┐││        ├──────────────────┤     ├────▶│        JS        │
│││                   │││        │   priority 99    │─────┤     └──────────────────┘
│││      before       │├┼──┬────▶├──────────────────┤     │
│││                   │││  │     │    priority 1    │─────┤     ┌──────────────────┐
││├───────────────────┤││  │     ├──────────────────┤     ├────▶│    inline JS     │
│││                   │││  │     │    priority 0    │─────┘     └──────────────────┘
│││     pipeline      │├┼──┤     └──────────────────┘
│││                   │││  │
││├───────────────────┤││  │
│││                   │││  │
│││       after       │├┼──┘
│││                   │││
││└───────────────────┘││
│└─────────────────────┘│
└───────────────────────┘
[/prism]

By defaults, `CSS` and `JS` default to display in the `pipeline` position when they are output.  While `InlineCSS` and `InlineJS` default to be in the `after` position.  This is configurable though, and you can set any asset to be in any position.

## Assets in Themes

### Overview

In general, you add CSS assets one by one using `assets.addCss()` or `assets.addInlineCss()` calls, then render those assets via `assets.css()`. Options controlling priority, pipelining or inlining can be specified per asset when adding it, or at rendering time for a group of assets.

JS assets are handled similarly with `assets.addJs()` and `assets.addInlineJs()` calls. There is also a generic `assets.add()` method that tries to guess the type of asset you are adding, but it is recommended to use the more specific method calls.

The Asset Manager also supports:

* adding assets to named groups in order to render such groups at different places and/or with different sets of options,
* configuring named asset collections, which can be added in a single `assets.add*()` call.

### Example

An example of how you can add CSS files in your theme can be found in the default **quark** theme that comes bundled with Grav. If you have a look at the [`templates/partials/base.html.twig`](https://github.com/getgrav/grav-theme-quark/blob/develop/templates/partials/base.html.twig) partial, you will see something similar to the following:

[prism classes="language-twig line-numbers"]
<!DOCTYPE html>
<html>
    <head>
    ...
    
    {% block stylesheets %}
        {% do assets.addCss('theme://css-compiled/spectre.css') %}
        {% do assets.addCss('theme://css-compiled/theme.css') %}
        {% do assets.addCss('theme://css/custom.css') %}
        {% do assets.addCss('theme://css/line-awesome.min.css') %}
    {% endblock %}
    
    {% block javascripts %}
        {% do assets.addJs('jquery', 101) %}
        {% do assets.addJs('theme://js/jquery.treemenu.js', {group:'bottom'}) %}
        {% do assets.addJs('theme://js/site.js', {group:'bottom'}) %}
    {% endblock %}
    
    {% block assets deferred %}
        {{ assets.css()|raw }}
        {{ assets.js()|raw }}
    {% endblock %}
    </head>
    
    <body>    
    ...
    
    {% block bottom %}
        {{ assets.js('bottom')|raw }}
    {% endblock %}
    </body>
</html>
[/prism]

The `block stylesheets` twig tag just defines a region that can be replaced or appended to in templates that extend the one. Within the block, you will see a number of `do assets.addCss()` calls.

The `{% do %}` tag is actually [one built in to Twig](http://twig.sensiolabs.org/doc/tags/do.html) itself, and it lets you manipulate variables without generating any output.

The `addCss()` method adds CSS assets to the Asset Manager. If you specify a second numeric parameter, that sets the priority of the stylesheet. If you do not specify a priority, the priority that the assets are added will dictate the order they are rendered.  You will notice the use of a **PHP stream wrapper** `theme://` to provide an easy way for Grav to determine the current theme's relative path.

!! The `assets.addJs('jquery', 101)` will include the `jquery` collection defined in the global Assets configuration. The optional param here of `101` sets the priority to be quite high to ensure it renderes first.  The default priority when not provided is a value of `10`. A more flexible way of writing this would be `assets.addJs('jquery', {priority: 101})`.  This allows you to add other parameters alongside the priority.

The `assets.css()|raw` call renders the CSS assets as HTML tags. As there is no parameter supplied to this method, the group is by default set to `head`. Note how this is wrapped in an `assets deferred` block.  This is a new feature in Grav 1.6 that allows you to add assets from other Twig templates that are included further down the page (or anywhere really), and still ensure that they can render in this `head` block if required.

The `bottom` block at the very end of your theme output, renders JavaScript that has been assigned to the `bottom` block

## Adding Assets

#### add(asset, [options])

The add method does its best attempt to match an asset based on file extension.  It is a convenience method, it's better to call one of the direct methods for CSS or JS.  See the direct methods for details.

!! The options array is the preferred approach for passing multiple options. However as in the previous example with `jquery`, you can use a shortcut and pass in an integer for the **second argument** in the method if all you wish to set is the **priority**.

#### addCss(asset, [options])

This method will add assets to the list of CSS assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The `pipeline` option controls whether or not this asset should be included in the combination/minify pipeline. If not pipelined, the `loading` option controls whether the asset should be rendered as a link to an external stylesheet or whether its contents should be inlined inside an inline style tag.

#### addInlineCss(css, [options])

Lets you add a string of CSS inside an inline style tag. Useful for initialization or anything dynamic.  To inline a regular asset file's content, see the `{'loading': 'inline'}` option of the `addCss()` and `css()` methods.

#### addJs(asset, [options])

This method will add assets to the list of JavaScript assets.  The priority defaults to 10 if not provided.  A higher number means it will display before lower priority assets.  The `pipeline` option controls whether or not this asset should be included in the combination/minify pipeline. If not pipelined, the `loading` option controls whether the asset should be rendered as a link to an external script file or whether its contents should be inlined inside an inline script tag.

#### addInlineJs(javascript, [options])

Lets you add a string of JavaScript inside an inline script tag. Useful for initialization or anything dynamic.  To inline a regular asset file's content, see the `{'loading': 'inline'}` option of the `addJs()` and `js()` methods.

#### registerCollection(name, array)

Allows you to register an array of CSS and JavaScript assets with a name for later use by the `add()` method. Particularly useful if you want to register a collection that may be used by multiple themes or plugins, such as jQuery or Bootstrap.

## Options

Where appropriate, you can pass in an array of asset options. The core options are:

#### For CSS

* **priority**: Integer value (default value is `10`)

* **position**: `pipeline` is default but can also be `before` or `after` the assets in `pipeline` position.  

* **loading**: `inline` if this asset should be output inline rather (default: referenced via a link to the stylesheet). Should be used in conjunction with `position: before` or `position: after` as it will have no effect with `position: pipeline` (default).

* **group**: string to specify a unique group name for asset (default is `head`)

#### For JS

* **priority**: Integer value (default value is `10`)

* **position**: `pipeline` is default but can also be `before` or `after` the assets in `pipeline` position.

* **loading**: supports any loading type such as, `async`, `defer`, `async defer` or `inline`. Should be used in conjunction with `position: before` or `position: after` as it will have no effect with `position: pipeline` (default).

* **group**: string to specify a unique group name for asset (default is `head`)

#### Other Attributes

You can also pass anything else you like in the options array, and if they are not these standard types, they will simply be rendered as attributes such as `{id: 'custom-id'}` will render as `id="custom-id"` in the HTML tag.

#### Examples

For example:

[prism classes="language-twig"]
{% do assets.addCss('page://01.blog/assets-test/example.css?foo=bar', { priority: 20, loading: 'inline', position: 'before'}) %}
[/prism]

Will render as:

[prism classes="language-html line-numbers"]
<style>
h1.blinking {
    text-decoration: underline;
}
</style>
<link.....
[/prism]

Another example:

[prism classes="language-twig"]
{% do assets.addJs('page://01.blog/assets-test/example.js', {loading: 'async', id: 'custom-css'}) %}
[/prism]

Will render as:

[prism classes="language-html"]
<script src="/grav/user/pages/01.blog/assets-test/example.js" async id="custom-css"></script>
[/prism]

## Rendering Assets

The following allow you to render the current state of the CSS and JavaScript assets.

#### css([group, [options]])

Renders CSS assets that have been added to an Asset Manager's group (default is `head`). Options are

* **loading**: `inline` if **all** assets in this group should be inlined (default: render each asset according to its `position` option)

* **_link attributes_**, see below (default: `{'type': 'text/css', 'rel': 'stylesheet'}`). Effective only if `inline` is **not** used as this group's rendering option

If pipelining is turned **off** in the configuration, the group's assets are rendered individually, ordered by asset priority (high to low), followed by the order in which assets were added.

If pipelining is turned **on** in the configuration, assets in the pipeline position are combined in the order in which assets were added, then processed according to the pipeline configuration. 

Each asset is rendered either as a stylesheet link or inline, depending on the asset's `loading` option and whether `{'loading': 'inline'}` is used for this group's rendering. CSS added by `addInlineCss()` will be rendered in the `after` position by default, but you can configure it to render before the pipelined output with `position: before`

#### js([group, [options]])

Renders JavaScript assets that have been added to an Asset Manager's group (default is `head`). Options are

* **loading**: `inline` if **all** assets in this group should be inlined (default: render each asset according to its `position` option)

* **_script attributes_**, see below (default: `{'type': 'text/javascript'}`). Effective only if `inline` is **not** used as this group's rendering option

If pipelining is turned **off** in the configuration, the group's assets are rendered individually, ordered by asset priority (high to low), followed by the order in which assets were added.

If pipelining is turned **on** in the configuration, assets in the pipeline position are combined in the order in which assets were added, then processed according to the pipeline configuration. The combined pipeline result is then rendered before or after non-pipelined assets depending on the setting of `js_pipeline_before_excludes`.

Each asset is rendered either as a script link or inline, depending on the asset's `loading` option and whether `{'loading': 'inline'}` is used for this group's rendering. Note that the only way to inline a JS pipeline is to use inline loading as an option of the `js()` method. JS added by `addInlineJs()` will be rendered in the `after` position by default, but you can configure it to render before the pipelined output with `position: before`

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
$bootstrapper_bits = [https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css,
                      https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css,
                      https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js];
$assets->registerCollection('bootstrap', $bootstrap_bits);
$assets->add('bootstrap', 100);
[/prism]

An example of this action can be found in the [**bootstrapper** plugin](https://github.com/getgrav/grav-plugin-bootstrapper/blob/develop/bootstrapper.php#L51-L71).

## Grouped Assets

The Asset manager lets you pass an optional `group` as part of an options array when adding assets.  While this is of marginal use for CSS, it is especially useful for JavaScript where you may need to have some JS files or Inline JS referenced in the header, and some at the bottom of the page. 

To take advantage of this capability you must specify the group when adding the asset, and should use the options syntax:

[prism classes="language-twig"]
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

[prism classes="language-twig line-numbers"]
{% do assets.addCSS('theme://whatever.css', {'group':'my-alternate-group'}) %}
...
{{ assets.css('my-alternate-group', {'rel': 'alternate'}) }}
[/prism]

## Inlining Assets

Inlining allows the placing critical CSS (and JS) code directly into the HTML document enables the browser to render a page immediately without waiting for external stylesheet or script downloads. This can improve site performance noticeably for users, particularly over mobile networks. Details can be found in [this article on optimizing CSS delivery](https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery).

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
