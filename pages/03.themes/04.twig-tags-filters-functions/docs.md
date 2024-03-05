---
title: Twig Tags, Filters & Functions
process:
    twig: true
taxonomy:
    category: docs
routes:
  aliases:
    - '/themes/twig-filters-functions'
---

Although Twig already provides an extensive list of [filters, functions, and tags](https://twig.symfony.com/doc/1.x/#reference), Grav also provides a selection of useful additions to make the process of theming easier.

!! For information about developing your own custom Twig Filters, check out the [Custom Twig Filter/Function](/cookbook/twig-recipes/#custom-twig-filter-function) example in the **Twig Recipes** section of the **Cookbook** chapter.

## Tags

A tag provides high-level Twig functionality.  Examples of built-in tags include constructs such as `include`, `block`, `for`, `if` and many more. Tags are identified in Twig by the use of the {% verbatim %}`{% tagname %}`{% endverbatim %} syntax.  Also, most tags are closed with an {% verbatim %}`{% endtagname %}`{% endverbatim %}.

Grav includes several useful custom tags that provide functionality such as `cache`, `markdown`, `script`, `style`, `switch`, and more.

[Grav Twig Tags <i class="fa fa-arrow-right"></i>](tags?classes=button,button-primary)

## Filters

Twig filters allow to you to apply functionality to the variable that appears on the left side of the pipe (`|`) symbol.  They are particularly useful when dealing with manipulating text or variables.  The first argument to the filter is always the item on the left, but subsequent arguments can be passed in parentheses. Filters have some special capabilities including the ability to be context and environment aware.

Examples of built in Twig filters include `date`, `escape`, `join`, `lower`, `slice`, and many more. An example would be:

{% verbatim %}
```twig
{% set foo = "one,two,three,four,five"|split(',', 3) %}
```
{% endverbatim %}

Grav includes several useful custom filters that provide functionality such as `hyphenize`, `nicetime`, `starts_with`, `contains`, `base64_decode`, and many more.

[Grav Twig Filters <i class="fa fa-arrow-right"></i>](filters?classes=button,button-primary)

## Functions

Twig functions are another way to implement functionality in Twig. They are similar to filters, however rather than acting on a variable via a `|` you would call these functions directly and pass in any attributes they support between the parentheses after the function name.  Frequently, Grav provides both a filter and a function for the same logic and leaves it up to the user to choose the method they prefer.  

Examples of built in Twig filters include `block`, `dump`, `parent`, `random`, `range`, and more. An example would be:

{% verbatim %}
```twig
{{ random(['apple', 'orange', 'citrus']) }}
```
{% endverbatim %}

Grav includes several useful custom functions that provide functionality such as `authorize`, `debug`, `evaluate`, `regex_filter`, `media`, and many more.

[Grav Twig Functions <i class="fa fa-arrow-right"></i>](functions?classes=button,button-primary)




