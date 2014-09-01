---
title: Dropdown Menu
taxonomy:
    category: docs
---

The default theme **antimatter** does not provide a dropdown menu of any sort, but that's not to say that it can't be done.  In fact this is not hard at all, and can be created with some simple Twig code:

```
{% macro loop(page) %}
    {% for p in page.children %}
        {% if p.visible %}
        <li>
            <a href="{{ p.url }}">{{ p.menu }}</a>
            {% if p.children.count > 0 %}
            <ul>
                {{ _self.loop(p) }}
            </ul>
            {% endif %}
        </li>
        {% endif %}
    {% endfor %}
{% endmacro %}
 
<ul class="topics">
    {{ _self.loop(pages) }}
</ul>
```

What this is doing is using the [Twig macro functionality](http://twig.sensiolabs.org/doc/tags/macro.html) to create a simple inline function that we can call from withing the `<ul>` tag.  As you can see we call the `loop()` macro and pass in the default `pages` object.  In Grav, the `pages` object contains a nested-tree structure of all the pages that Grav knows about.

So the macro is able to loop over the top level pages and display an `<li>` list item with the page `url` and the `menu` text. Then it checks if this current page has any **child page**, if so it recursively calls the `loop()` macro again.

This will generate a simple HTML unordered list that you can style easily with CSS.

You will probably want to have some way to indicate whether or not your page is active so the CSS can highlight it appropriately.  This can be added utilizing a couple of methods on the Grav **page** object.

First we can use `page.active` to determine if this is the currently active page.  We can also use `page.activeChild` to determine if the page in question is the parent of a child page that is active.

The updated macro code could look something like this:

```
{% macro loop(page) %}
    {% for p in page.children %}
    	{% set parent_class = page.activeChild ? 'parent' : '' %}
    	{% set active_class = page.active ? 'active' : '' %}
        {% if p.visible %}
        <li class="{{ parent_class }} {{ active_class}}">
            <a href="{{ p.url }}">{{ p.menu }}</a>
            {% if p.children.count > 0 %}
            <ul>
                {{ _self.loop(p) }}
            </ul>
            {% endif %}
        </li>
        {% endif %}
    {% endfor %}
{% endmacro %}
```

Now you can consult a tutorial on how to convert your Grav-generated unordered list into a suitably styled CSS dropdown menu:

* [webdesignacademy.co.za](http://www.resource.webdesignacademy.co.za/how-to-create-a-pure-css-dropdown-menu/)
* [andornagy.com](http://andornagy.com/css-dropdown-menu/)
* [cdoepen.io](http://codepen.io/philhoyt/pen/ujHzd)
* [thedesignpixel.com](http://thedesignpixel.com/useful-html5-css3-dropdown-menu-for-free-download.html)
