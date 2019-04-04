---
title: Plugin Recipes
page-toc:
  active: true
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav plugins.

## Output some PHP code result in a Twig template

#### Goal:

You want to process some custom PHP code, and make the result available in a page.

#### Solution:

You create a new plugin that creates a Twig extension, and makes some PHP content available in your Twig templates.

Create a new plugin folder in `user/plugins/example`, and add those files:

`user/plugins/example/example.php`
`user/plugins/example/example.yaml`
`user/plugins/example/twig/ExampleTwigExtension.php`

In `twig/ExampleTwigExtension.php` you'll do your custom processing, and return it as a string in `exampleFunction()`.

Then in your Twig template file (or in a page Markdown file if you enabled Twig processing in Pages), render the output using: `{{ example() }}`.

The overview is over, let's see the actual code:

`example.php`:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Plugin;
use \Grav\Common\Plugin;
class ExamplePlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ];
    }
    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/ExampleTwigExtension.php');
        $this->grav['twig']->twig->addExtension(new ExampleTwigExtension());
    }
}
[/prism]

`ExampleTwigExtension.php`:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Plugin;
class ExampleTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'ExampleTwigExtension';
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('example', [$this, 'exampleFunction'])
        ];
    }
    public function exampleFunction()
    {
        return 'something';
    }
}
[/prism]

`example.yaml`:

[prism classes="language-yaml"]
enabled: true
[/prism]

The plugin is now installed and enabled, and it should all just work.

## Filter taxonomies using the taxonomylist plugin

#### Goal:

You want to use the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) to list the tags that are used in your blog posts, but instead of listing all of them, you only want to list the most used items in a given taxonomy (such as the top five tags, for example).

#### Solution:

This is an example where the flexibility of Grav plugins really come in handy. The first step is to make sure that you have the [taxonomy list Grav plugin](https://github.com/getgrav/grav-plugin-taxonomylist) installed within your Grav package. After this has been installed, make sure that you copy `/yoursite/user/plugins/taxonomylist/templates/partials/taxonomylist.html.twig` to `/yoursite/user/themes/yourtheme/templates/partials/taxonomylist.html.twig` as we will be making modifications to this file.

In order to make this work, we are going to introduce three new variables: `filter`, `filterstart` and `filterend` where

 * **filter** is a Boolean, which will be set to `true` if we want to be able to list only the top several tags (or whatever other taxonomy you want to use).
 *  **filterstart** is an arbitrary integer, but should usually be set to zero. This is the index in the taxonomy array that you want to start at.
 * **filterend** is an arbitrary integer and is the index in the taxonomy array that you want to end at. Note that if you want to list the top five items in your taxonomy, you should set this to 5 as our loop will iterate until `filterend -1`.

The next step will be to make a call to `taxonomylist.html.twig` within the template in which we wish to list the top items in our taxonomy. As usual, we will do this using `{% include %}` as seen in the following snippet example:

[prism classes="language-twig line-numbers"]
{% if config.plugins.taxonomylist.enabled %}
<div class="sidebar-content">
    <h4>Popular Tags</h4>
    {% include 'partials/taxonomylist.html.twig' with {'taxonomy':'tag', filter: true, filterstart: 0, filterend: 5} %}
</div>
{% endif %}
[/prism]
In this example, we are going to list the top five tags.

Now, let's turn our attention to `taxonomylist.html.twig`. For reference, here is the default code for this file when you initially install it:

[prism classes="language-twig line-numbers"]
{% set taxlist = taxonomylist.get() %}

{% if taxlist %}

<span class="tags">
    {% for tax,value in taxlist[taxonomy] %}

        <a href="{{ base_url }}/{{ taxonomy }}{{ config.system.param_sep }}{{ tax|e('url') }}">{{ tax }}</a>

    {% endfor %}
</span>
{% endif %}
[/prism]
In order to make this work with our new variables (i.e. `filter`, `filterstart` and `filterend`), we will need to include them within this file like so:

[prism classes="language-twig line-numbers"]
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
[/prism]
Here, the file is first checking if `filter` has been set to `true`. If so, the for loop is run just as it was in the original `taxonomylist.html.twig`, but this time it is making use of the `slice` Twig filter. This filter will, in our case, extract a subset of an array from the beginning index (in our case, `filterstart`) to the ending index (in our case `filterend-1`).

If, on the other hand, the `filter` variable is set to `false` or is not found, all of the items in your taxonomy will be listed.

## Adding a search button to the SimpleSearch plugin

#### Goal:

You really like the [Grav SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch), but you want to add a search button in addition to the text field. One reason to add this button is that it may not be readily apparent to the user that they need to hit their `Enter` key in order to initiate their search request.

#### Solution:

First, make sure that you have installed the [Grav SimpleSearch plugin](https://github.com/getgrav/grav-plugin-simplesearch). Next, make sure that you copy `/yoursite/user/plugins/simplesearch/templates/partials/simplesearch-searchbox.html.twig` to `/yoursite/user/themes/yourtheme/templates/partials/simplesearch-searchbox.html.twig` as we will need to make modifications to this file.

Before we go any further, let's review what this file does:
[prism classes="language-twig line-numbers"]
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
[/prism]
The first line simply embeds a text input field into your Twig template. The `data-search-input` attribute stores the base URL of the resulting query page. The default is `http://yoursite/search/query`.

Let's now move onto the jQuery below that. Here, the tag containing the `data-search-input` attribute is assigned to a variable `input`. Next, the jQuery `.on()` method is applied to `input`. The `.on()` method applies event handlers to selected elements (in this case, the `<input>` text field). So, when the user presses (`keypress`) a key to initiate the search, the `if` statement checks that the following items are `true`:

1. The `Enter` key has been pressed: `event.which == 13` where 13 is the numeric value of the `Enter` key on the keyboard.
2. The number of characters entered into the searchbox in greater than three. You may want to adjust this to taste as your organization may have many acronyms that are three characters or less.

If they are true, then `event.preventDefault();` makes sure that the default browser action for the `Enter` key is ignored as this would prevent our search from occurring. Finally, the full URL of the search query is constructed. The default is `http://yoursite/search/query:yourquery`. From here, `/yoursite/user/plugins/simplesearch/simplesearch.php` performs the actual search and the other Twig files in the plugin list the results.

No back to our solution! If we wish to add a search button, we must:

1. Add the button
2. Make sure to apply the `.on()` method to the button, but this time, using `click` instead of `keypress`

This is achieved with the following code using the [Turret CSS Framework](http://bigfishtv.github.io/turret/docs/index.html). Code snippets for other frameworks will be listed at the end.
[prism classes="language-html line-numbers"]
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
[/prism]
The HTML and class attributes are specific to Turret, but the end result will be [something like this](http://bigfishtv.github.io/turret/docs/index.html#input-group). We can also see that the `.on()` method has also been assigned to the search button, but it only checks that the number of characters entered into the search box is greater than three before executing the code within the `if` statement.

Here is the default HTML for the text field plus a search button for a few other frameworks:

[**Bootstrap**](http://getbootstrap.com/)
[prism classes="language-html line-numbers"]
<div class="input-group">
    <input type="text" class="form-control" placeholder="Search for...">
    <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
    </span>
</div>
[/prism]

[**Materialize**](http://materializecss.com/)
[prism classes="language-html line-numbers"]
<div class="input-field">
    <input id="search" type="search" required>
    <label for="search"><i class="material-icons">search</i></label>
</div>
[/prism]

[**Pure CSS**](http://purecss.io)
[prism classes="language-html line-numbers"]
<form class="pure-form">
    <input type="text" class="pure-input-rounded">
    <button type="submit" class="pure-button">Search</button>
</form>
[/prism]

[**Semantic UI**](http://semantic-ui.com/)
[prism classes="language-html line-numbers"]
<div class="ui action input">
  <input type="text" placeholder="Search...">
  <button class="ui button">Search</button>
</div>
[/prism]

## Iterating through pages and media

#### Goal:

You want to access all pages and each page's associated media through PHP and/or Twig, so that they can be looped over or otherwise manipulated by the plugin.

#### Solution:

Use Grav's collection-capabilities to construct a recursive index of all pages, and when indexing also gather up media-files for each page. The [DirectoryListing](https://github.com/OleVik/grav-plugin-directorylisting/blob/v2.0.0-rc.2/Utilities.php#L64-L105)-plugin does exactly this, and builds a HTML-list using the produced tree-structure. To do this, we'll create a recursive function - or method as may be the case within a plugin's class - that goes through each page and stores it in an array. The method is recursive, because it calls itself again for each page it finds that has children.

First things first, though, the method takes three parameters: The first is the `$route` to the page, which tells Grav where to find it; the second is the `$mode`, which tells the method whether to iterate over the page itself or its children; the third is the `$depth`, which keeps track of what level the page is on. The method initially instantiates the Page-object, then deals with depth and mode, and constructs the collection. By default, we order the pages by Date, Descending, but you could make this configurable. Then we construct an array, `$paths`, to hold each page. Since routes are unique in Grav, they are used as keys in this array to identify each page.

Now we iterate over the pages, adding depth, title, and route (also kept as a value for ease-of-access). Within the foreach-loop, we also try to retrieve child-pages, and add them if found. Also, we find all media associated with the page, and add them. Because the method is recursive, it will continue looking for pages and child-pages until no more can be found.

The returned data is a tree-structure, or multidimensional-array in PHP's parlance, containing all pages and their media. This can be passed into Twig, or used within the plugin itself. Note that with very large folder-structures PHP might time out or fail because of recursion-limits, eg. folders 100 or more levels deep.

[prism classes="language-php line-numbers"]
/**
 * Creates page-structure recursively
 * @param string $route Route to page
 * @param integer $depth Reserved placeholder for recursion depth
 * @return array Page-structure with children and media
 */
public function buildTree($route, $mode = false, $depth = 0)
{
    $page = Grav::instance()['page'];
    $depth++;
    $mode = '@page.self';
    if ($depth > 1) {
        $mode = '@page.children';
    }
    $pages = $page->evaluate([$mode => $route]);
    $pages = $pages->published()->order('date', 'desc');
    $paths = array();
    foreach ($pages as $page) {
        $route = $page->rawRoute();
        $path = $page->path();
        $title = $page->title();
        $paths[$route]['depth'] = $depth;
        $paths[$route]['title'] = $title;
        $paths[$route]['route'] = $route;
        if (!empty($paths[$route])) {
            $children = $this->buildTree($route, $mode, $depth);
            if (!empty($children)) {
                $paths[$route]['children'] = $children;
            }
        }
        $media = new Media($path);
        foreach ($media->all() as $filename => $file) {
            $paths[$route]['media'][$filename] = $file->items()['type'];
        }
    }
    if (!empty($paths)) {
        return $paths;
    } else {
        return null;
    }
}
[/prism]

## Custom Twig templates plugin

#### Goal:

Rather than using theme inheritance, it's possible to create a very simple plugin that allows you to use a custom location to provide customized Twig templates. 

#### Solution:

The only thing you need in this plugin is an event to provide a location for your templates.  The simplest way to create the plugin is to use the `devtools` plugin.  So install that with:

[prism classes="language-bash command-line"]
$ bin/gpm install devtools
[/prism]

After that's installed, create a new plugin with the command:

[prism classes="language-bash command-line"]
$ bin/plugin devtools newplugin
[/prism]

Fill in the details for the name, author, etc.  Say we call it `Custom Templates`, and the plugin will be created in `/user/plugins/custom-templates`.  All you need to do now is edit the `custom-templates.php` file and put this code:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;

class CustomTemplatesPlugin extends Plugin
{
    /**
     * Subscribe to required events
     * 
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0]
        ];
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }
}
[/prism]

This plugin simple subscribes to the `onTwigTemplatePaths()` event, and then in that event method, it adds the `user/plugins/custom-templates/templates` folder to this of paths that Twig will check.

This allows you to drop in a Twig template called `foo.html.twig` and then any page called `foo.md` will be able to use this template.

! NOTE: This will add the plugin's custom template path to the **end** of the Twig template path array. This means the theme (which is always first), will have precedence over the plugin's templates of the same name.  To resolve this, simply put the plugin's template path in the front of the array by modifying the event method:

[prism classes="language-twig line-numbers"]
    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        array_unshift($this->grav['twig']->twig_paths, __DIR__ . '/templates');
    }
[/prism]

## Using Cache in your own plugins

#### Goal:

When developing your own plugins, it's often useful to use Grav's cache to cache data to improve performance.  Luckily it's a very simple process to use cache in your own code.

#### Solution:

This is some basic code that shows you how caching works:

[prism classes="language-php line-numbers"]
    $cache = Grav::instance()['cache'];
    $id = 'myplugin-data'
    $list = [];

    if ($data = $cache->fetch($id)) {
        return $data;
    } else {
        $data = $this->gatherData();
        $cache->save($hash, $data);
        return $data;
    }
[/prism]

First, we get Grav's cache object, and we then try to see if our data already exists in the cache (`$data = $cache->fetch($id)`).  If `$data` exists, simply return it with no extra work needed.

However, if the cache fetch returns null, meaning it's not cached, do some _work_ and get the data (`$data = $this->gatherData()`), and then simply save the data for next time (`$cache->save($hash, $data)`).



## Learning by Example

With the abundance of plugins currently available, chances are that you will find your answers somewhere in their source code. The problem is knowing which ones to look at. This page attempts to list common plugin issues and then lists specific plugins that demonstrate how to tackle them.

Before you proceed, be sure you've familiarized yourself with [the core documentation](https://learn.getgrav.org/plugins), especially the [Grav Lifecycle](https://learn.getgrav.org/plugins/grav-lifecycle)!

### How do I read from and write data to the file system?

Grav might be flat file, but flat file &#8800; static! There are numerous ways read and write data to the file system.

  * If you just need read access to YAML data, check out the [Import plugin](https://github.com/Deester4x4jr/grav-plugin-import).

  * The preferred interface is via the built-in [RocketTheme\Toolbox\File](https://learn.getgrav.org/api#class-RocketThemeToolboxFile) interface.

  * There's nothing stopping you from using [SQLite](https://sqlite.org/) either.

  * The simplest example is probably the [Comments](https://github.com/getgrav/grav-plugin-comments) plugin.

  * Others include

    * [Table Importer](https://github.com/Perlkonig/grav-plugin-table-importer)

    * [Thumb Ratings](https://github.com/iusvar/grav-plugin-thumb-ratings)

    * [Webmention](https://github.com/Perlkonig/grav-plugin-webmention)

### How do I make data from a plugin available to Twig?

One way is via the `config.plugins.X` namespace. Simply do a `$this->config->set()` as seen in the following examples:

  * [ipLocate](https://github.com/Perlkonig/grav-plugin-iplocate/blob/master/iplocate.php#L82)
  * [Count Views](https://github.com/Perlkonig/grav-plugin-count-views/blob/master/count-views.php#L88)

You can then access that in a Twig template via `{{ config.plugins.X.whatever.variable }}`.

Alternatively, you can pass variables via `grav['twig']`:

  * [Blogroll](https://github.com/Perlkonig/grav-plugin-blogroll/blob/master/blogroll.php#L43), which you can then access directly [in your template](https://github.com/Perlkonig/grav-plugin-blogroll/blob/master/templates/partials/blogroll.html.twig#L32).

Finally, you can inject data directly into the page header, as seen in [the Import plugin](https://github.com/Deester4x4jr/grav-plugin-import).

### How do I inject Markdown into a page?

According to the [Grav Lifecycle](https://learn.getgrav.org/plugins/grav-lifecycle), the latest event hook where you can inject raw Markdown is `onPageContentRaw`. The earliest is probably `onPageInitialized`. You can just grab `$this->grav['page']->rawMarkdown()`, munge it, and then write it back out with `$this->grav['page']->setRawContent()`. The following plugins demonstrate this:

  * [Page Inject](https://github.com/getgrav/grav-plugin-page-inject)

  * [Table Importer](https://github.com/Perlkonig/grav-plugin-table-importer)

### How do I inject HTML into the final output?

The latest you can inject HTML, and still have your output cached, is during the `onOutputGenerated` event. You can just grab and modify `$this->grav->output`.

  * Many common tasks can be accomplished using the [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) infrastructure.

  * The [Pubmed](https://github.com/Perlkonig/grav-plugin-pubmed) and [Tablesorter](https://github.com/Perlkonig/grav-plugin-tablesorter) plugins take a more brute force approach.

### How do I inject assets like JavaScript and CSS files?

This is done through the [Grav\Common\Assets](https://learn.getgrav.org/api#class-gravcommonassets) interface.

  * [Google Analytics](https://github.com/escopecz/grav-ganalytics)

  * [Bootstrapper](https://github.com/getgrav/grav-plugin-bootstrapper)

  * [Gravstrap](https://github.com/giansi/gravstrap)

  * [Tablesorter](https://github.com/Perlkonig/grav-plugin-tablesorter)

### How do I affect the response headers and response codes?

You can use PHP's `header()` command to set response headers. The latest you can do this is during the `onOutputGenerated` event, after which output is actually sent to the client. The response code itself can only be set in the YAML header of the page in question (`http_response_code`).

  * The [Graveyard](https://github.com/Perlkonig/grav-plugin-graveyard) plugin replaces `404 NOT FOUND` with `410 GONE` responses via the YAML header.

  * The [Webmention](https://github.com/Perlkonig/grav-plugin-webmention) sets the `Location` header on a `201 CREATED` response.

### How do I incorporate third-party libraries into my plugin?

Usually, you'd incorporate other complete libraries into a `vendor` subfolder and `require` its `autoload.php` where appropriate in your plugin. (If you're using Git, consider using [subtrees](https://help.github.com/articles/about-git-subtree-merges/).)

  * [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core)

  * [Table Importer](https://github.com/Perlkonig/grav-plugin-table-importer)

### How do I extend Twig?

The simplest way is to follow the [Custom Twig Filter/Function](/cookbook/twig-recipes/#custom-twig-filter-function) example in the **Twig Recipes** section.

Also, [read the Twig docs](http://twig.sensiolabs.org/doc/advanced.html) and develop your extension. Then look at the [TwigPCRE](https://github.com/kesslernetworks/grav-plugin-twigpcre) plugin to learn how to incorporate it into Grav.

### How do I interact with external APIs?

Grav provides the [Grav\Common\GPM\Response](https://learn.getgrav.org/api#class-grav-common-gpm-response) object, but there's nothing stopping you from doing it directly if you so wish.

  * [ipLocate](https://github.com/Perlkonig/grav-plugin-iplocate)

  * [Pubmed](https://github.com/Perlkonig/grav-plugin-pubmed)



