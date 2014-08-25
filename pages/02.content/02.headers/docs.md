---
title: Headers
taxonomy:
    category: docs
---

The headers at the top of a page are completely optional, you do not need them at all for a page to display within Grav. There are 3 primary types of pages (**Standard**, **Listing**, and **Modular**) within Grav, and each has relevant headers. 

## Standard Page Headers

A Standard page is a regular single page. There are a number of standard header options available.  These are **valid for all pages**.

### Title

If you have no headers at all, you will not have any control over the title of the page as it shows in the browser and search engines.  For this reason, it is recommended to _at least_ put the the `title` variable in the header of the page:

```ruby
title: Title of my Page
```

If the `title` variable is not set, Grav has a fall back solution, and will try to use the capitalized `slug` variable:

### Slug

```ruby
slug: my-page-slug
```

The `slug` variable allows you to specifically set the page's portion of the URL. For example: `http://yoursite.com/my-page-slug` would be the URL if you set the `slug` above.  If the `slug` is not set in the page, Grav falls back to using the folder name (without any numerical prefixes).

### Menu

```ruby
menu: My Page
```

The `menu` variable lets you set the text to be used in the navigation. There are several layers of fall-backs for the menu, so if no `menu` variable is set, Grav will try to use the `title` variable.

### Visible

```ruby
visible: false
```

By default, a page is **visibile** in the **navigation** if the surrounding folder has a numerical prefix, i.e. `/01.home` is visible, while `/error` is **not visible**. This behavior can be overwritten by setting the `visible` variable in the header. Valid values are `true` or `false`.

### Routable

```ruby
routable: false
```

By default, all pages are **routable**.  This means that they can be reached by pointing your browser to the URL of the page.  However, you may need to create a page that is created to hold specific content, but it is meant to be called directly by a plugin, other content, or even a theme directly.  A good example of this is a `404 Error` page.  

Grav automatically looks for a page with the route `/error` if another page cannot be found.  With this being an actual page within Grav, you would have complete control over what this page looks like.  You probably do not want people accessing this page directly in their browser, however, so this page commonly has its `routable` variable set to false. Valid values are `true` or `false`.

### Template

```ruby
template: custom
```

As explained in [the previous chapter][contentpages], the template from the theme that is used to render a page is based on the filename of the `.md` file. 

So a file called `default.md`, will use the `default` template in the active theme.  You can, of course, override this behavior by simply setting the `template` variable in the header and choosing a different template.  

In the example above, the page will use the `custom` template from the theme.  This variable exists because you may need to change the template of a page programatically from a plugin.

### Taxonomy

```ruby
taxonomy:
    category: blog
    tag: [sample, demo, grav]
```

A very useful header variable, `taxonomy` lets you assign values to **taxonomy** you defined as valid types in the [Site Configuration](../basics/site-configuration) file. 

If the taxonomy is not defined in that file, it will be ignored.  In this example, the page is defined as being in the `blog` category, and has the tags: `sample`, `demo`, and `grav`.  These taxonomies can be used to find these pages from other pages, plugins and even themes. The [Taxonomy](taxonomy) chapter will cover this concept in more detail.

### Date

```ruby
date: 01/01/2014 3:14pm
```

The `date` variable allows you to specifically set a date associated with this page.  This is often used to indicate when a post was created and can be used for display or sort-order purposes.  If not set, this defaults to the last **modified time** of the page.

### Cache Enable

```ruby
cache_enable: false
```

By default, Grav will cache the contents of the page file to ensure things run as fast as possible.  There are advanced scenarios where you do not want the page to be cached. 

An example of this is when your using dynamic Twig variables in your content. The `cache_enable` variable allows this behavior to be overridden.  We will cover Twig Content variables in a later chapter. Valid values are `true` or `false`.

### Process

```ruby
process: 
	markdown: false
	twig: true
```

Processing of the page is another advanced capability. By default Grav will process `markdown` but will **not** process `twig` in a page.  This choice to not process Twig by default is purely for performance reasons as this is not a commonly needed feature.  The `process` variable allows you to override this behavior. 

You may want to disable `markdown` on a particular page if you want to use 100% HTML in your page and not have the markdown process run at all.  Also it allows a plugin to process content in another manner completely. Valid values are `true` or `false`.

There are situations when you want to use Twig templating functionality in your content, and this is accomplished by setting the `twig` variable to true.

### Markdown Extra

```ruby
markdown_extra: true
```

Markdown Extra is a new feature we added in **v0.9.0**.  You can enable this glboally via your `user/config/system.yaml` configuration file, or you can override this global setting _per-page_ with this header option.

### Lightbox

``` ruby
lightbox: true
```

Although strictly speaking this is not a standard page header, it is a common way to enabled the loading of a standard lightbox JavaScript and CSS for a page.  By default the core `antimatter` theme does not load the prerequisites to enable lightbox capabilities of images, by enabling this option in the page headers, they will be loaded for you.

## Meta Page Headers

Although not strictly a Grav supported set of headers, these are fairly standard and should be supported by **Grav Themes**. Meta headers allow you to set the [standard set of HTML **<meta> tags**](http://www.w3schools.com/tags/tag_meta.asp) for each page:

### Description Meta Tag

```ruby
description: Your page description goes here
```

The `description` value is often used by search engines to provide a summary of the page content.

### Keywords Meta Tag

```ruby
keywords: [HTML, CSS, XML, JavaScript]
```

The `keywords` variable is used to provide a list of keywords that will be set in the keywords meta tag for the page.

### Author Meta Tag

```ruby
author: John Smith
```

Another standard meta tag, `author` is often used by search engines and other web services.

### Robots Meta Tag

```ruby
robots: [noindex, nofollow]
```

Especially useful for search engines, you can set any of the [supported index and serving directives](https://developers.google.com/webmasters/control-crawl-index/docs/robots_meta_tag) in this array.

## Collection Headers

To tell Grav that a specific page should be a listing page and contain child-pages, there are a number of variables that can be used:

### Collection of Children

You configure how the collection of pages is defined.  This mechanism is very flexible but the default configuration for pages that exist below the parent, listing page, would look like this:

```ruby
content:
    items: @self.children
```

The `content.items` value tells Grav to gather up a collection of items and specifically `@self.children` indicates that the collection should consist of the child pages below this page in the folder structure.

### Collection of Modular Children

```ruby
content:
    items: @self.modular
```

The `@self.modular` configuration option tells Grav that the page should consist of all the modular pages that exist as children of this particular page.  

### Collection by Taxonomy

```ruby
content:
    items: @taxonomy.tag: foo
```

Using the `@taxonomy` option, you can utilize Grav's powerful taxonomy functionality.  This is where the `taxonomy` variable in the [Site Configuration][config] file comes into play. There **must** be a definition for the taxonomy defined in that configuration file for Grav to interpret a page reference to it as valid.

By setting `@taxonomy.tag: foo`, Grav will find all the pages in the `/user/pages` folder that have themselves set `tag: foo` in their taxonomy variable.

```ruby
content:
    items: @taxonomy.tag: [foo, bar]
```

the `content.items` variable can take an array of taxonomies and it will gather up all pages that satisfy these rules. The [Taxonomy][tax] chapter will cover this concept in more detail.

### Ordering Options

```ruby
content:
	order:
		by: date
		dir: desc
		custom:
			- _showcase
            - _highlights
            - _callout
            - _features
	limit: 5
	pagination: true
```

Ordering of sub-pages follows the same rules as ordering of folders, the available options are:

| Ordering     | Details                                                                                                       |
| :----------  | :----------                                                                                                   |
| **default**  | The order based on the file system, i.e. `01.home` before `02.advark`                                         |
| **title**    | The order is based on the title as defined in each page                                                       |
| **basename** | The order is based on the alphabetic folder name after it has been processed by the `basename()` PHP function |
| **date**     | The order based on the date as defined in each page                                                           |
| **modified** | The order based on the modified timestamp of the page                                                         |
| **folder**   | The order based on the folder name with any numerical prefix, i.e. `01.`, removed                             |
| **manual**   | The order based on the `order_manual` variable                                                                |
| **random**   | The order is randomized                                                                                       |

The `content.items.dir` variable controls which direction the ordering should be in. Valid values are either **desc** or **asc**.

In in this configuration, you can see that `content.order.custom` is defining a **custom manual ordering** to ensure the page is constructed with the **showcase** first, **highlights** section second etc. Please note that if a page is not specified in the custom ordering list, then Grav falls back on the `content.order.by` for the unspecified pages.

`content.limit` is pretty self explanatory, and the `content.pagination` is a simple boolean flag to be used by plugins etc to know if **pagination** should be initialized for this collection.

## Custom Page Headers

Of course, you can create your own custom page headers using any valid YAML syntax.  These would be page-specific and be available for any plugin, or theme to make use of. A good example of this would be to set some variable specific to a sitemap plugin, such as:

```ruby
sitemap:
    changefreq: monthly
    priority: 1.03
```

The significance of these headers is that Grav does not use them by default, they are only read by the **sitemap plugin** to determine how often this particular page is modified and what its priority should be.  

Any page header such as this should be documented, and generally there will be some default value that will be used if the page does not provide it.

Another example would be to store page-specific data that could then be used by Twig in the content of the page.  This really provides a lot of flexibility and power.

[contentpages]: content-pages
[config]: ../basics/site-configuration
[tax]: taxonomy
