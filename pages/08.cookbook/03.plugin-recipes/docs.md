---
title: Plugin Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav plugins.

1. [Filter taxonomies using the taxonomylist plugin](#filter-taxonomies-using-the-taxo)
2. [Adding a search button to the SimpleSearch plugin](#adding-a-search-button-to-the-simplesearch-plugin)
 
### Filter taxonomies using the taxonomylist plugin
 
#### Problem:
 
You want to use the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) to list the tags that are used in your blog posts, but intead of listing all of them, you only want to list the most used items in a given taxonomy (such as the top five tags, for example).
 
#### Solution:
 
This is an example where the flexibility of Grav plugins really come in handy. The first step is to make sure that you have the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) installed within yoiur Grav package. After this has been installed, make sure that you copy `/yoursite/user/plugins/taxonomylist/templates/partials/taxonomylist.html.twig` to `/yoursite/user/themes/yourtheme/templates/partials/taxonomylist.html.twig` as we will be making modifications to this file.
 
In order to make this work, we are going to introduce three new variables: `filter`, `filterstart` and `filterend` where

 * **filter** is a Boolean, which will be set to `true` if we want to be able to list only the top several tags (or whatever other taxonomy you want to use).
 *  **filterstart** is an arbitrary integer, but should usually be set to zero. This is the index in the taxonomy array that you want to start at.
 * **filterend** is an arbitrary integer and is the index in the taxonomy array that you want to end at. Note that if you want to list the top five items in your taxonomy, you should set this to 5 as our loop will iterate until `filterend -1`.

The next step will be to make a call to `taxonomylist.html.twig` within the template in which we wish to list the top items in our taxonomy. As usual, we will do this using `{% include %}` as seen in the following snippet example:

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
In order to make this work with our new variables (i.e. `filter`, `filterstart` and `filterend`), we will need to include them within this file like so:

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

### Adding a search button to the SimpleSearch plugin

#### Problem:

You really like the [Grav SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch), but you want to add a search button in addition to the text field. One reason to add this button is that it may not be readily apparent to the user that they need to hit their `Enter` key in order to initiate their search request.

#### Solution:

First, make sure that you have installed the [Grav SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch). Next, make sure that you copy `/yoursite/user/plugins/simplesearch/templates/partials/simplesearch-searchbox.html.twig` to `/yoursite/user/themes/yourtheme/templates/partials/simplesearch-searchbox.html.twig` as we will need to make modifications to this file.

Before we go any further, let's review what this file does:
```
<input type="text" placeholder="Search..." value="{{ query }}" data-search-input="{{ base_url }}{{ config.plugins.simplesearch.route}}/query" />
<script>
jQuery(document).ready(function($){
    var input = $('[data-search-input]');
    input.on('keypress', function(event) {
        if (event.which == 13 && input.val().length > 3) {
            event.preventDefault();
            window.location.href = input.data('search-input') + '{{ config.system.param_sep }}' + input.val();
        }
    });
});
</script>
```
The first line simply embeds a text input field into your Twig template. The `data-search-input` attribute stores the base URL of the resulting query page. The default is `http://yoursite/search/query`.

Let's now move onto the jQuery below that. Here, the tag containing the `data-search-input` attribute is assigned to a variable `input`. Next, the jQuery `.on()` method is applied to `input`. The `.on()` method applies event handlers to selected elements (in this case, the `<input>` text field). So, when the user presses (`keypress`) a key to initiate the search, the `if` statement checks that the following items are `true`:

1. The `Enter` key has been pressed: `event.which == 13` where 13 is the numeric value of the `Enter` key on the keyboard.
2. The number of characters entered into the searchbox in greater than three. You may want to adjust this to taste as your organization may have many acronyms that are three characters or less.

If they are true, then `event.preventDefault();` makes sure that the default browser action for the `Enter` key is ignored as this would prevent our search from occuring. Finally, the full URL of the search query is constructed. The default is `http://yoursite/search/query:yourquery`. From here, `/yoursite/user/plugins/simplesearch/simplesearch.php` performs the actual search and the other Twig files in the plugin list the results.

No back to our solution! If we wish to add a search button, we must:

1. Add the button
2. Make sure to apply the `.on()` method to the button, but this time, using `click` instead of `keypress`

This is acheived with the following code using the [Turret CSS Framework](http://bigfishtv.github.io/turret/docs/index.html). Code snippets for other frameworks will be listed at the end.
```
<div class="input-group input-group-search">
	<input type="search" placeholder="Search" value="{{ query }}" data-search-input="{{ base_url }}{{ config.plugins.simplesearch.route}}/query" >
	<span class="input-group-button">
		<button class="button" type="submit">Search</button>
	</span>
</div>

<script>
jQuery(document).ready(function($){
    var input = $('[data-search-input]');
    var searchButton = $('.button.search');

    input.on('keypress', function(event) {
        if (event.which == 13 && input.val().length > 3) {
            event.preventDefault();
            window.location.href = input.data('search-input') + '{{ config.system.param_sep }}' + input.val();
        }
    });
    
    searchButton.on('click', function(event) {
        if (input.val().length > 3) {
            event.preventDefault();
            window.location.href = input.data('search-input') + '{{ config.system.param_sep }}' + input.val();
        }
    });
});
</script>
```
The HTML and class attributes are specific to Turret, but the end result will be [something like this](http://bigfishtv.github.io/turret/docs/index.html#input-group). We can also see that the `.on()` method has also been assigned to the search button, but it only checks that the number of characters entered into the search box is greater than three before executing the code within the `if` statement.

Here is the default HTML for the text field plus a search button for a few other frameworks:

[**Bootstrap**](http://getbootstrap.com/)
```
<div class="input-group">
    <input type="text" class="form-control" placeholder="Search for...">
    <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
    </span>
</div>
```

[**Materialize**](http://materializecss.com/)
```
<div class="input-field">
    <input id="search" type="search" required>
    <label for="search"><i class="material-icons">search</i></label>
</div>
```

[**Pure CSS**](http://purecss.io)
```
<form class="pure-form">
    <input type="text" class="pure-input-rounded">
    <button type="submit" class="pure-button">Search</button>
</form>
```

[**Semantic UI**](http://semantic-ui.com/)
```
<div class="ui action input">
  <input type="text" placeholder="Search...">
  <button class="ui button">Search</button>
</div>
```


