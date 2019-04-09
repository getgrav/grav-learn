---
title: Twig Tags
page-toc:
  active: true
  start: 3

process:
    twig: false
taxonomy:
    category: docs
---

Grav also provides a variety of custom Twig Tags that extend the already very capable Twig templating capabilities with some new tags that we've found useful.

### Markdown

The Markdown tag provides a powerful new way to embedding markdown in Twig template.  You could use a variable and render that variable with the `|markdown` filter, but the `{% markdown %}` syntax makes creating blocks of markdown text even simpler.

[prism classes="language-twig line-numbers"]
{% markdown %}
This is **bold** and this _underlined_

1. This is a bullet list
2. This is another item in that same list
{% endmarkdown %}
[/prism]

### Scripts

The Scripts tag is really a convenience tag that keeps your Twig more readable compared to the usual `{% do assets...%}` approach.  It's purely an alternative way of writing things.

#### File

[prism classes="language-twig line-numbers"]
{% script 'theme://js/something.js' in 'bottom' priority: 20 with { defer: true, async: true } %}
[/prism]

#### Inline

[prism classes="language-twig line-numbers"]
{% script in 'bottom' priority: 20 %}
    alert('Warning!');
{% endscript %}
[/prism]

### CSS Styles

#### File

[prism classes="language-twig line-numbers"]
{% style 'theme://css/foo.css' priority: 20 %}
[/prism]

#### Inline

[prism classes="language-twig line-numbers"]
{% style priority: 20 with { media: 'screen' } %}
    a { color: red; }
{% endstyle %}
[/prism]

### Switch

In most programming language, using a `switch` statement is a common way to make a bunch of `is else` statements cleaner and more readabile.  Also they may prove to be marginally faster.  We just provide a simple way of creating these as they were missing in the base Twig functionality.

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

### Deferred Blocks

A great new feature of Grav 1.6 is the power of deferred blocks.  With traditional blocks, once the block has been rendered, it cannot be manipulated.  Take the example of a `{% block scripts %}` that might hold some entries for JavaScript includes.  If you have a child Twig template, and you extend a base template where this block is defined, you can extend the block, and add your own custom JavaScript entries.  however, partial twig templates that are included from this page, cannot reach or interact with the block.

The deferred attribute on the block which is powered by the [Deferred Extension](https://github.com/rybakit/twig-deferred-extension), means that you can define this block in any Twig template, but it's rendering is deferred, so that it renders after everything else.  This means that you can add JavaScript references via the `{% do assets.addJs() %}` call from anywhere in your page, and because the rendering is deferred, the output will contain all the assets that Grav knows about, no matter when you added them.

[prism classes="language-twig line-numbers"]
{% block myblock deferred %}
    This will be rendered after everything else. 
{% endblock %}
[/prism]

[version=16]
### Throw an Exception

There are certain situations where you need to manually throw an exception, so we have a tag for that too.

[prism classes="language-twig line-numbers"]
{% throw 404 'Not Found' %}
[/prism]

### Try / Catch Exceptions

Also it's useful to have more powerful PHP-style error handling in your Twig templates so we have a new `try/catch` tag.

[prism classes="language-twig line-numbers"]
{% try %}
   <li>{{ user.get('name') }}</li>
{% catch %}
   User Error: {{ e.message }}
{% endcatch %}
[/prism]
 
### Render Object (Flex only)

Flex Objects are slowly making their way into more and more elements of Grav.  These are self-aware objects that have an associated Twig template structure, so they know how to render themselves.  In order to use these, we have implemented a new `render` tag that takes an optional layout which in turn controls which of the template layouts the object should be rendered with.
 
[prism classes="language-twig line-numbers"]
{% render object layout: 'default' with { variable: 'value' } %}
[/prism]
[/version]
