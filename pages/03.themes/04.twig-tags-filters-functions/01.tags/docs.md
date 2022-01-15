---
title: Twig Tags
body_classes: twig__headers
page-toc:
  active: true
  start: 3
  depth: 1
process:
    twig: false
taxonomy:
    category: docs
---

Grav also provides a variety of custom Twig Tags that extend the already very capable Twig templating capabilities with some new tags that we've found useful.

### `markdown`

The Markdown tag provides a powerful new way to embed markdown in Twig template.  You could use a variable and render that variable with the `|markdown` filter, but the `{% markdown %}` syntax makes creating blocks of markdown text even simpler.

[prism classes="language-twig line-numbers"]
{% markdown %}
This is **bold** and this _underlined_

1. This is a bullet list
2. This is another item in that same list
{% endmarkdown %}
[/prism]

[version=17]
### `script`

The Script tag is really a convenience tag that keeps your Twig more readable compared to the usual `{% do assets...%}` approach.  It's purely an alternative way of writing things.

#### Script File

[prism classes="language-twig line-numbers"]
{% script 'theme://js/something.js' at 'bottom' priority: 20 with { defer: true, async: true } %}
[/prism]

Grav 1.7.28 adds also support for modules:

[prism classes="language-twig line-numbers"]
{% script module 'theme://js/module.mjs' %}
[/prism]


#### Inline Script

[prism classes="language-twig line-numbers"]
{% script at 'bottom' priority: 20 %}
    alert('Warning!');
{% endscript %}
[/prism]

### `style`

#### CSS File

[prism classes="language-twig line-numbers"]
{% style 'theme://css/foo.css' priority: 20 %}
[/prism]

#### Inline CSS

[prism classes="language-twig line-numbers"]
{% style priority: 20 with { media: 'screen' } %}
    a { color: red; }
{% endstyle %}
[/prism]
[/version]

### `link`

[prism classes="language-twig line-numbers"]
{% link icon 'theme://images/favicon.png' priority: 20 with { type: 'image/png' } %}
{% link modulepreload 'plugin://grav-plugin/build/js/vendor.js' %}
[/prism]

### `switch`

In most programming language, using a `switch` statement is a common way to make a bunch of `if else` statements cleaner and more readabile.  Also they may prove to be marginally faster.  We just provide a simple way of creating these as they were missing in the base Twig functionality.

[prism classes="language-twig line-numbers"]
{% switch type %}
  {% case 'foo' %}
     {{ my_data.foo }}
  {% case 'bar' %}
     {{ my_data.bar }}
  {% default %}
     {{ my_data.default }}
{% endswitch %}
[/prism]

[version=16,17]
### `deferred`

With traditional blocks, once the block has been rendered, it cannot be manipulated.  Take the example of a `{% block scripts %}` that might hold some entries for JavaScript includes.  If you have a child Twig template, and you extend a base template where this block is defined, you can extend the block, and add your own custom JavaScript entries.  However, partial twig templates that are included from this page, cannot reach or interact with the block.

The deferred attribute on the block which is powered by the [Deferred Extension](https://github.com/rybakit/twig-deferred-extension), means that you can define this block in any Twig template, but it's rendering is deferred, so that it renders after everything else.  This means that you can add JavaScript references via the `{% do assets.addJs() %}` call from anywhere in your page, and because the rendering is deferred, the output will contain all the assets that Grav knows about, no matter when you added them.

[prism classes="language-twig line-numbers"]
{% block myblock deferred %}
    This will be rendered after everything else.
{% endblock %}
[/prism]

It is also possible to merge the content of the parent block with the deferred block using `{{ parent() }}`. This can be especially useful for themes if additional css or javascript files are added.

[prism classes="language-twig line-numbers"]
{% block stylesheets %}
    <!-- Additional css library -->
    {% do assets.addCss('theme://libraries/leaflet/dist/leaflet.css') %}
    {{ parent() }}
{% endblock %}
[/prism]

### `throw`

There are certain situations where you need to manually throw an exception, so we have a tag for that too.

[prism classes="language-twig line-numbers"]
{% throw 404 'Not Found' %}
[/prism]

### `try` & `catch`

Also it's useful to have more powerful PHP-style error handling in your Twig templates so we have a new `try/catch` tag.

[prism classes="language-twig line-numbers"]
{% try %}
   <li>{{ user.get('name') }}</li>
{% catch %}
   User Error: {{ e.message }}
{% endcatch %}
[/prism]

### `render`

Flex Objects are slowly making their way into more and more elements of Grav.  These are self-aware objects that have an associated Twig template structure, so they know how to render themselves.  In order to use these, we have implemented a new `render` tag that takes an optional layout which in turn controls which of the template layouts the object should be rendered with.

[prism classes="language-twig line-numbers"]
{% render collection layout: 'list' %}
{% render object layout: 'default' with { variable: 'value' } %}
[/prism]

### `cache`

Sometimes you may need to cache parts of the page, which take a lot of time to render. You can do this with `cache` tag.

[prism classes="language-twig line-numbers"]
{% cache 600 %}
  {{ some_complex_work() }}
{% endcache %}
[/prism]

In the example `600` is an optional lifetime in seconds. If the parameter isn't passed, default cache lifetime will be used.

[/version]
