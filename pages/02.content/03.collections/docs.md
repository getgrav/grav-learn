---
title: Page Collections
page-toc:
  active: true
taxonomy:
    category: docs
---

Collections have grown considerably since the early betas of Grav. We started off with a very limited set of page-based collections, but with the help of our community, we have increased these capabilities to make them even more powerful!  So much so that they now have their own section in the documentation.

## Basics of Grav Collections

In Grav, the most common type of collection is a list of pages that can be defined either in the page's frontmatter or in the twig itself. The most common is to define a collection in the frontmatter. With a collection defined, it is available in the Twig of the page to do with as you wish. By using page collection methods or looping through each [page object](https://learn.getgrav.org/themes/theme-vars#page-object) and using the page methods or properties you can do powerful things. Common examples of this include displaying a list of blog posts or displaying modular sub-pages to render a complex page design.

## Collection Object

When you define a collection in the page header, you are dynamically creating a [Grav Collection](https://github.com/getgrav/grav/blob/develop/system/src/Grav/Common/Page/Collection.php) that is available in the page's Twig.  This Collection object is **iterable** and can be treated like an **array** which allows you to do things such as:

[prism classes="language-twig line-numbers"]
{{ dump(page.collection[page.path]) }}
[/prism]

## Example Collection Definition

An example collection defined in the page's frontmatter:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
[/prism]

The `content.items` value in the page's frontmatter tells Grav to gather up a collection of items and information passed to this defines how the collection is to be built.

This definition creates a collection for the page that consists of all **child pages** sorted by **date** in **descending** order with **pagination** showing **10 items** per-page.

## Accessing Collections in Twig

When this collection is defined in the header, Grav creates a collection **page.collection** that you can access in a twig template with:

[prism classes="language-twig line-numbers"]
{% for p in page.collection %}
<h2>{{ p.title }}</h2>
{{ p.summary }}
{% endfor %}
[/prism]

This simply loops over the [pages](https://learn.getgrav.org/themes/theme-vars#page-object) in the collection displaying the title and summary.

You can also include an order parameter to change the default ordering of pages:

[prism classes="language-twig line-numbers"]
{% for p in page.collection.order('folder','asc') %}
<h2>{{ p.title }}</h2>
{{ p.summary }}
{% endfor %}
[/prism]

## Collection Headers

To tell Grav that a specific page should be a listing page and contain child-pages, there are a number of variables that can be used:

### Summary of collection options

[div class="table-keycol"]
|                   String                  |                           Result                          |
|-------------------------------------------|-----------------------------------------------------------|
| `'@root'`                                   | Get the root children                                     |
| `'@root.children'`                          | Get the root children (alternative)                       |
| `'@root.descendants'`                       | Get the root and recurse through ALL children             |
|                                           |                                                           |
| `'@self.parent'`                            | Get the parent of the current page                        |
| `'@self.siblings'`                          | A collection of all other pages on this level             |
| `'@self.modular'`                           | Get only the modular children                             |
| `'@self.children'`                          | Get the non-modular children                              |
| `'@self.descendants'`                       | Recurse through all the non-modular children              |
|                                           |                                                           |
| `'@page': '/fruit'`                         | Get all the children of page `/fruit`                     |
| `'@page.children': '/fruit'`                | Alternative to above                                      |
| `'@page.self': '/fruit'`                    | Get a collection with only the page `/fruit`              |
| `'@page.page': '/fruit'`                    | Alternative to above                                      |
| `'@page.descendants': '/fruit'`             | Get and recurse through all the children of page `/fruit` |
| `'@page.modular': '/fruit'`                | Get a collection of all modular subpages of `/fruit`      |
|                                           |                                                           |
| `'@taxonomy.tag': photography`              | taxonomy with tag=`photography`                           |
| `'@taxonomy': {tag: birds, category: blog}` | taxonomy with tag=`birds` && category=`blog`              |
[/div]

! This document outlines the use of `@page`, `@taxonomy.category` etc, but a more YAML-safe alternative format is `page@`, `taxonomy@.category`.  All the `@` commands can be written in either prefix or postfix format.

We will cover these more in detail. 

## Root Collections

##### @root - Top level children

This can be used to retrieve the top/root level **published non-modular children** of a site. Particular useful for getting the items that make up the primary navigation for example:

[prism classes="language-yaml line-numbers"]
content:
    items: '@root'
[/prism]

an alias is also valid:

[prism classes="language-yaml line-numbers"]
content:
    items: '@root.children'
[/prism]

##### @root - Top level children + all descendants

This will effectively get every page in your site as it recursively navigates through all the children from the root page down, and builds a collection of **all** the **published non-modular children** of a site:

[prism classes="language-yaml line-numbers"]
content:
    items: '@root.descendants'
[/prism]

## Self Collections

##### @self.children - Children of the current page

This is used to list the **published non-modular children** of the current page:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.children'
[/prism]

##### @self.descendants - Non-modular children + all descendants of the current page

Similar to `.children`, the `.descendants` collection will retrieve all the **published non-modular children** but continue to recurse through all their children:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.descendants'
[/prism]

##### @self.modular - Modular children of the current page

The inverse of `.children`, this method retrieves only **published modular children** of the current page (`_features`, `_showcase`, etc.):

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.modular'
[/prism]

##### @self.parent - The parent page of the current page

This is a special case collection because it will always return just the one **parent** of the current page:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.parent'
[/prism]

##### @self.siblings - All the sibling pages

This collection will collect all the **published** Pages at the same level of the current page, excluding the current page:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.siblings'
[/prism]

## Page Collections

##### @page or @page.children - Collection of children of a specific page

This collection takes a slug route of a page as an argument and will return all the **published non-modular** children of that page:

[prism classes="language-yaml line-numbers"]
content:
    items:
      '@page': '/blog'
[/prism]

alternatively:

[prism classes="language-yaml line-numbers"]
content:
    items:
      '@page.children': '/blog'
[/prism]

##### @page.self or @page.page - Collection of just the specific page

This collection takes a slug route of a page as an argument and will return collection containing that page (if it is **published and non-modular**):

[prism classes="language-yaml line-numbers"]
content:
    items:
      '@page.self': '/blog'
[/prism]

##### @page.descendants - Collection of children + all descendants of a specific page

This collection takes a slug route of a page as an argument and will return all the **published non-modular** children and all their descendants of that page:

[prism classes="language-yaml line-numbers"]
content:
    items:
      '@page.descendants': '/blog'
[/prism]

##### @page.modular - Collection of modular children of a specific page

This collection takes a slug route of a page as an argument and will return all the **published modular** children of that page:

[prism classes="language-yaml line-numbers"]
content:
    items:
      '@page.modular': '/blog'
[/prism]


## Taxonomy Collections

[prism classes="language-yaml line-numbers"]
content:
   items:
      '@taxonomy.tag': foo
[/prism]

Using the `@taxonomy` option, you can utilize Grav's powerful taxonomy functionality.  This is where the `taxonomy` variable in the [Site Configuration](../../basics/grav-configuration#site-configuration) file comes into play. There **must** be a definition for the taxonomy defined in that configuration file for Grav to interpret a page reference to it as valid.

By setting `@taxonomy.tag: foo`, Grav will find all the **published pages** in the `/user/pages` folder that have themselves set `tag: foo` in their taxonomy variable:

[prism classes="language-yaml line-numbers"]
content:
    items:
       '@taxonomy.tag': [foo, bar]
[/prism]

The `content.items` variable can take an array of taxonomies and it will gather up all pages that satisfy these rules. Published pages that have **both** `foo` **and** `bar` tags will be collected.  The [Taxonomy](../taxonomy) chapter will cover this concept in more detail.

!! If you wish to place multiple variables inline, you will need to separate sub-variables from their parents with `{}` brackets. You can then separate individual variables on that level with a comma. For example: `'@taxonomy': {category: [blog, featured], tag: [foo, bar]}`. In this example, the `category` and `tag` sub-variables are placed under `@taxonomy` in the hierarchy, each with listed values placed within `[]` brackets. Pages must meet **all** these requirements to be found.

If you have multiple variables in a single parent to set, you can do this using the inline method, but for simplicity, we recommend using the standard method. Here is an example:

[prism classes="language-yaml line-numbers"]
content:
  items:
    '@taxonomy':
      category: [blog, featured]
      tag: [foo, bar]
[/prism]

Each level in the hierarchy adds two whitespaces before the variable. YAML will allow you to use as many spaces as you want here, but two is standard practice. In the above example, both the `category` and `tag` variables are set under `@taxonomy`.

### Complex Collections

You can also provide multiple complex collection definitions and the resulting collection will be the sum of all the pages found from each of the collection definitions. For example:

[prism classes="language-yaml line-numbers"]
content:
  items:
    - '@self.children'
    - '@taxonomy':
         category: [blog, featured]
[/prism]

Additionally, you can filter the collection by using `filter: type: value`. The type can be any of the following: `published`, `non-published`, `visible`, `non-visible`, `modular`, `non-modular`, `routable`, `non-routable`, `type`, `types`, `access`. These correspond to the [Collection-specific methods](#collection-object-methods), and you can use several to filter your collection. They are all either `true` or `false`, except for `type` which takes a single template-name, `types` which takes an array of template-names, and `access` which takes an array of access-levels. For example:

[prism classes="language-yaml line-numbers"]
 content:
  items: '@self.siblings'
  filter: 
    published: true
    type: 'blog'
[/prism]

### Ordering Options

[prism classes="language-yaml line-numbers"]
content:
    order:
        by: date
        dir: desc
    limit: 5
    pagination: true
[/prism]

Ordering of sub-pages follows the same rules as ordering of folders, the available options are:

[div class="table-keycol"]
| Ordering     | Details                                                                                                                                            |
| :----------  | :----------                                                                                                                                        |
| `default`    | The order is based on the file system, i.e. `01.home` before `02.advark`                                                                              |
| `title`      | The order is based on the title as defined in each page                                                                                            |
| `basename`   | The order is based on the alphabetic folder name after it has been processed by the `basename()` PHP function                                      |
| `date`       | The order is based on the date as defined in each page                                                                                                |
| `modified`   | The order is based on the modified timestamp of the page                                                                                              |
| `folder`     | The order is based on the folder name with any numerical prefix, i.e. `01.`, removed                                                                  |
| `header.x`   | The order is based on any page header field. i.e. `header.taxonomy.year`. Also a default can be added via a pipe. i.e. `header.taxonomy.year|2015`    |
| `manual`     | The order is based on the `order_manual` variable                                                                                                     |
| `random`     | The order is randomized                                                                                                                            |
| `custom`     | The order is based on the `content.order.custom` variable                                                                                                                             |
| `sort_flags` | Allow to override sorting flags for page header-based or default ordering. If the `intl` PHP extension is loaded, only [these flags](https://secure.php.net/manual/en/collator.asort.php) are available. Otherwise, you can use the PHP [standard sorting flags](https://secure.php.net/manual/en/array.constants.php). |
[/div]

The `content.order.dir` variable controls which direction the ordering should be in. Valid values are either `desc` or `asc`.

[prism classes="language-yaml line-numbers"]
content:
    order:
        by: default
        custom:
            - _showcase
            - _highlights
            - _callout
            - _features
    limit: 5
    pagination: true
[/prism]

In the above configuration, you can see that `content.order.custom` is defining a **custom manual ordering** to ensure the page is constructed with the **showcase** first, **highlights** section second etc. Please note that if a page is not specified in the custom ordering list, then Grav falls back on the `content.order.by` for the unspecified pages.

If a page has a custom slug, you must use that slug in the `content.order.custom` list.

The `content.pagination` is a simple boolean flag to be used by plugins etc to know if **pagination** should be initialized for this collection. `content.limit` is the number of items displayed per-page when pagination is enabled.

### Date Range

New as of **Grav 0.9.13** is the ability to filter by a date range:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.children'
    dateRange:
        start: 1/1/2014
        end: 1/1/2015
[/prism]

You can use any string date format supported by [strtotime()](https://php.net/manual/en/function.strtotime.php) such as `-6 weeks` or `last Monday` as well as more traditional dates such as `01/23/2014` or `23 January 2014`. The dateRange will filter out any pages that have a date outside the provided dateRange.  Both **start** and **end** dates are optional, but at least one should be provided.

### Multiple Collections

When you create a collection with `content: items:` in your YAML, you are defining a single collection based on several conditions.  However, Grav does let you create an arbitrary set of collections per page, you just need to create another one:

[prism classes="language-yaml line-numbers"]
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true

fruit:
    items:
       '@taxonomy.tag': [fruit]
[/prism]

This sets up **2 collections** for this page, the first uses the default `content` collection, but the second one defines a taxonomy-based collection called `fruit`.  To access these two collections via Twig you can use the following syntax:

[prism classes="language-yaml line-numbers"]
{% set default_collection = page.collection %}
{% set fruit_collection = page.collection('fruit') %}
[/prism]

## Collection Object Methods

Iterable methods include:

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| `Collection::append($items)` | Add another collection or array |
| `Collection::first()` | Get the first item in the collection |
| `Collection::last()` | Get the last item in the collection |
| `Collection::random($num)` | Pick `$num` random items from the collection |
| `Collection::reverse()` | Reverse the order of the collection |
| `Collection::shuffle()` | Randomize the entire collection |
| `Collection::slice($offset, $length)` | Slice the list |
[/div]

Also has several useful Collection-specific methods:

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| `Collection::addPage($page)` | You can append another page to this collection |
| `Collection::copy()` | Creates a copy of the current collection |
| `Collection::current()` | Gets the current item in the collection |
| `Collection::key()` | Returns the slug of the current item |
| `Collection::remove($path)` | Removes a specific page in the collection, or current if `$path = null` |
| `Collection::order($by, $dir, $manual)` | Orders the current collection |
| `Collection::intersect($collection2)` | Merge two collections, keeping items that occur in both collections (like an "AND" condition) |
| `Collection::merge($collection2)` | Merge two collections, keeping items that occur in either collection (like an "OR" condition) |
| `Collection::isFirst($path)` | Determines if the page identified by path is first |
| `Collection::isLast($path)` | Determines if the page identified by path is last |
| `Collection::prevSibling($path)` | Returns the previous sibling page if possible |
| `Collection::nextSibling($path)` | Returns the next sibling page if possible |
| `Collection::currentPosition($path)` | Returns the current index |
| `Collection::dateRange($startDate, $endDate, $field)` | Filters the current collection with dates |
| `Collection::visible()` | Filters the current collection to include only visible pages |
| `Collection::nonVisible()` | Filters the current collection to include only non-visible pages |
| `Collection::modular()` | Filters the current collection to include only modular pages |
| `Collection::nonModular()` | Filters the current collection to include only non-modular pages |
| `Collection::published()` | Filters the current collection to include only published pages |
| `Collection::nonPublished()` | Filters the current collection to include only non-published pages |
| `Collection::routable()` | Filters the current collection to include only routable pages |
| `Collection::nonRoutable()` | Filters the current collection to include only non-routable pages |
| `Collection::ofType($type)` | Filters the current collection to include only pages where template = `$type` |
| `Collection::ofOneOfTheseTypes($types)` | Filters the current collection to include only pages where template is in the array `$types` |
| `Collection::ofOneOfTheseAccessLevels($levels)` | Filters the current collection to include only pages where page access is in the array of `$levels` |
[/div]

Here is an example taken from the **Learn2** theme's **docs.html.twig** that defines a collection based on taxonomy (and optionally tags if they exist) and uses the `Collection::isFirst` and `Collection::isLast` methods to conditionally add page navigation:

[prism classes="language-twig line-numbers"]
{% set tags = page.taxonomy.tag %}
{% if tags %}
    {% set progress = page.collection({'items':{'@taxonomy':{'category': 'docs', 'tag': tags}},'order': {'by': 'default', 'dir': 'asc'}}) %}
{% else %}
    {% set progress = page.collection({'items':{'@taxonomy':{'category': 'docs'}},'order': {'by': 'default', 'dir': 'asc'}}) %}
{% endif %}

{% block navigation %}
        <div id="navigation">
        {% if not progress.isFirst(page.path) %}
            <a class="nav nav-prev" href="{{ progress.nextSibling(page.path).url }}"> <i class="fa fa-chevron-left"></i></a>
        {% endif %}

        {% if not progress.isLast(page.path) %}
            <a class="nav nav-next" href="{{ progress.prevSibling(page.path).url }}"><i class="fa fa-chevron-right"></i></a>
        {% endif %}
        </div>
{% endblock %}
[/prism]

`nextSibling()` is up the list and `prevSibling()` is down the list, this is how it works:

Assuming you have the pages:

[prism classes="language-txt line-numbers"]
Project A
Project B
Project C
[/prism]

You are on Project A, the previous page is Project B.
If you are on Project B, the previous page is Project C and next is Project A


## Programmatic Collections

You can take full control of collections directly from PHP in Grav plugins, themes, or even from Twig.  This is a more hard-coded approach compared to defining them in your page frontmatter, but it also allows for more complex and flexible collections logic.

### PHP Collections

You can perform advanced collection logic with PHP, for example:

[prism classes="language-php line-numbers"]
$collection = new Collection($pages);
$collection->setParams(['taxonomies' => ['tag' => ['dog', 'cat']]])->dateRange('01/01/2016', '12/31/2016')->published()->ofType('blog-item')->order('date', 'desc');

$titles = [];

foreach ($collection as $page) {
    $titles[] = $page->title();
}
[/prism]

The `order()`-function can also, in addition to the `by`- and `dir`-parameters, take a `manual`- and `sort_flags`-parameter. These are [documented above](#ordering-options). You can also use the same `evaluate()` method that the frontmatter-based page collections make use of:

[prism classes="language-php line-numbers"]
$page = Grav::instance()['page'];
$collection = $page->evaluate(['@page.children' => '/blog', '@taxonomy.tag' => 'photography']);
$ordered_collection = $collection->order('date', 'desc');
[/prism]

And another example of custom ordering would be:

[prism classes="language-php line-numbers"]
$ordered_collection = $collection->order('header.price','asc',null,SORT_NUMERIC);
[/prism]

You can also do similar directly in **Twig Templates**:

[prism classes="language-twig line-numbers"]
{% set collection = page.evaluate([{'@page.children':'/blog', '@taxonomy.tag':'photography'}]) %}
{% set ordered_collection = collection.order('date','desc') %}
[/prism]

#### Advanced Collections

By default when you call `page.collection()` in the Twig of a page that has a collection defined in the header, Grav looks for a collection called `content`.  This allows the ability to define [multiple collections](#multiple-collections), but you can even take this a step further.

If you need to programmatically generate a collection, you can do so by calling `page.collection()` and passing in an array in the same format as the page header collection definition.  For example:

[prism classes="language-twig line-numbers"]
{% set options = { items: {'@page.children': '/my/pages'}, 'limit': 5, 'order': {'by': 'date', 'dir': 'desc'}, 'pagination': true } %}
{% set my_collection = page.collection(options) %}

<ul>
{% for p in my_collection %}
<li>{{ p.title }}</li>
{% endfor %}
</ul>
[/prism]

Generating menu for the whole site (you need to set *menu* property in the page's frontmatter):


[prism classes="language-yaml line-numbers"]
---
title: Home
menu: Home
---
[/prism]

[prism classes="language-twig line-numbers"]
{% set options = { items: {'@root.descendants':''}, 'order': {'by': 'folder', 'dir': 'asc'}} %}
{% set my_collection = page.collection(options) %}

{% for p in my_collection %}
{% if p.header.menu %}
	<ul>
	{% if page.slug == p.slug %}
		<li class="{{ p.slug }} active"><span>{{ p.menu }}</span></li>
	{% else %}
		<li class="{{ p.slug }}"><a href="{{ p.url }}">{{ p.menu }}</a></li>
	{% endif %}
	</ul>
{% endif %}
{% endfor %}
[/prism]
