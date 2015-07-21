---
title: Plugin Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav plugins.

1. [Filter taxonomies using the taxonomylist plugin](#filter-taxonomies-using-the-taxo)
 
### Filter taxonomies using the taxonomylist plugin
 
#### Problem:
 
You want to use the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) to list the tags that are used in your blog posts, but intead of listing all of them, you only want to list the most used items in a given taxonomy (such as the top five tags, for example).
 
#### Solution:
 
This an example where the flexibility of Grav plugins really come in handy. The first step is to make sure that you have the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) installed within yoiur Grav package. After this has been installed, make sure that you copy `/yoursite/user/plugins/taxonomylist/templates/partials/taxonomylist.html.twig` to `/yoursite/user/themes/yourtheme/templates/partials/taxonomylist.html.twig` as we will be making modifications to this file.
 
In order to make this work, we are going to introduce three new variables: `filter`, `filterstart` and `filterend` where

 * **filter** is a Boolean, which will be set to `true` if we want to be able to list only the top several tags (or whatever other taxonomy you want to use).
 *  **filterstart** is an arbitrary integer, but should usually be set to zero. This is the index in the taxonomy array that you want to start at.
 * **filterend** is an arbitrary integer and is the index in the taxonomy array that you want to end at. Note that if you want to list the top five items in your taxonomy, you should set this to 5 as our loop will iterate until `filterend -1`.

The next step will be to make a call to `taxonomylist.html.twig` within the template in which we wish to list the top items in our taxonomy. As usual, we will do this using `include` using the snippet below as an example:

```
{% if config.plugins.taxonomylist.enabled %}
<div class="sidebar-content">
    <h4>Popular Tags</h4>
    {% include 'partials/taxonomylist.html.twig' with {'taxonomy':'tag', filter: true, filterstart: 0, filterend: 5} %}
</div>
{% endif %}
```
In this example, we are going to list the top five tags.

Now, let's turn our attention to `taxonomylist.html.twig`. For reference, here is the default code for this file when you initially install it:

```
{% set taxlist = taxonomylist.get() %}

{% if taxlist %}

<span class="tags">
    {% for tax,value in taxlist[taxonomy] %}

        <a href="{{ base_url }}/{{ taxonomy }}{{ config.system.param_sep }}{{ tax|e('url') }}">{{ tax }}</a>

    {% endfor %}
</span>
{% endif %}
```
In order to make this work with our new variables, we will need to include them within this file like so:

```
{% set taxlist = taxonomylist.get %}
    {% if taxlist %}
        <span class="tags">
            {% if filter %}
                {% for tax,value in taxlist[taxonomy]|slice(filterstart,filterend) %}
                    <a href="{{ base_url }}/{{ taxonomy }}{{ config.system.param_sep }}{{ tax|e('url') }}">{{ tax }}</a>
                {% endfor %}
            {% else %}
                {% for tax,value in taxlist[taxonomy] %}
                    <a href="{{ base_url }}/{{ taxonomy }}{{ config.system.param_sep }}{{ tax|e('url') }}">{{ tax }}</a>
                {% endfor %}
            {% endif %}
        </span>
```
Here, the file is first checking if `filter` has been set to `true`. If so, the for loop is run just as it was in the original `taxonomylist.html.twig`, but this time it is making use of the `slice` Twig filter. This filter will, in our case, extract a subset of an array from the beginning index (in our case, `filterstart`) to the ending index (in our case `filterend-1`).

If, on the other hand, the `filter` variable is set to `false` or is not found, all of the items in your taxonomy will be listed.
