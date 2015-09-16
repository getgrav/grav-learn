---
title: Headers
taxonomy:
    category: docs
---

The headers at the top of a page are completely optional, you do not need them at all for a page to display within Grav. There are 3 primary types of pages (**Standard**, **Listing**, and **Modular**) within Grav, and each has relevant headers.

## Standard Page Headers

A Standard page is a regular single page. There are a number of standard header options available.  These are **valid for all pages**.

### Title

If you have no headers at all, you will not have any control over the title of the page as it shows in the browser and search engines.  For this reason, it is recommended to _at least_ put the `title` variable in the header of the page:

```ruby
title: Title of my Page
```

If the `title` variable is not set, Grav has a fall back solution, and will try to use the capitalized `slug` variable:

### Slug

```ruby
slug: my-page-slug
```

The `slug` variable allows you to specifically set the page's portion of the URL. For example: `http://yoursite.com/my-page-slug` would be the URL if you set the `slug` above.  If the `slug` is not set in the page, Grav falls back to using the folder name (without any numerical prefixes).

[Slugs](http://en.wikipedia.org/wiki/Semantic_URL#Slug) are generally entirely lowercase, with accented characters replaced by letters from the English alphabet and whitespace characters replaced by a dash or an underscore. While future versions of Grav will support spaces in slugs, having blank spaces or capital lettering is not recommended.

For example: If a blog post's title is `Blog Post Example`, the recommended slug would be `blog-post-example`.

### Menu

```ruby
menu: My Page
```

The `menu` variable lets you set the text to be used in the navigation. There are several layers of fall-backs for the menu, so if no `menu` variable is set, Grav will try to use the `title` variable.

### Date

```ruby
date: 01/01/2014 3:14pm
```

The `date` variable allows you to specifically set a date associated with this page.  This is often used to indicate when a post was created and can be used for display or sort-order purposes.  If not set, this defaults to the last **modified time** of the page.

>>>>> Dates in the `m/d/y` or `d-m-y` formats are disambiguated by looking at the separator between the various components: if the separator is a slash (`/`), then the **American** `m/d/y` is assumed; whereas if the separator is a dash (`-`) or a dot (`.`), then the **European** `d-m-y` format is assumed.

### Published

```ruby
published: true
```

By default, a page is **published** unless you explicitly set `published: false` or via a `publish_date` being in the future, or `unpublish_date` in the past. Valid values are `true` or `false`.

### Publish Date

```ruby
publish_date: 01/23/2015 13:00
```

Optional field, but can provide a date to automatically trigger publication. Valid values are any string date values that [strtotime()](http://php.net/manual/en/function.strtotime.php) supports.

### Unpublish Date

```ruby
unpublish_date: 05/17/2015 00:32
```

Optional field, but can provide a date to automatically trigger un-publication. Valid values are any string date values that [strtotime()](http://php.net/manual/en/function.strtotime.php) supports.

### Visible

```ruby
visible: false
```

By default, a page is **visible** in the **navigation** if the surrounding folder has a numerical prefix, i.e. `/01.home` is visible, while `/error` is **not visible**. This behavior can be overwritten by setting the `visible` variable in the header. Valid values are `true` or `false`.

### Redirect

```ruby
redirect: /some/custom/route
```

or

```ruby
redirect: http://someexternalsite.com
```

As of Grav **0.9.41** can now redirect to another internal or external page right from a page header.  Of course this means this page will not be displayed, but the page can still be in a collection, menu, etc because it will exist as a page within Grav.

### Routes

```
routes:
  default: /my/example/page
  canonical: /canonical/url/alias
  aliases:
    - /some/other/route
    - /can-be-any-valid-slug
```

With Grav **0.9.30** you can now provide a **default route** that overrides the standard route structure as defined by the folder structure.

You can also specify a specific **canonical route** that can be used in themes to output a canonical link:

```
<link rel="canonical" href="https://yoursite/dresses/green-dresses-are-awesome" />
```

Lastly, you can specify an array of **route aliases** that can be used as alternative routes for a particular page.

### Routable

```ruby
routable: false
```

By default, all pages are **routable**.  This means that they can be reached by pointing your browser to the URL of the page.  However, you may need to create a page that is created to hold specific content, but it is meant to be called directly by a plugin, other content, or even a theme directly.  A good example of this is a `404 Error` page.

Grav automatically looks for a page with the route `/error` if another page cannot be found.  With this being an actual page within Grav, you would have complete control over what this page looks like.  You probably do not want people accessing this page directly in their browser, however, so this page commonly has its `routable` variable set to false. Valid values are `true` or `false`.

### Summary

```ruby
summary:
  enabled: true
  format: short | long
  size: int
```

The **summary** option configures what the `page.summary()` method returns.  This is most often used in a blog-listing type scenario, but can be used anytime you need a synopsis or summary of the page content.  The scenarios are as follows:

1. `enabled: false` -- Switch off page summary (the summary returns the same as the page content)
2. `enabled: true`:
    1. `size: 0` -- No truncation of content happens except if a summary delimiter is found.
    2. `size: int` -- Content greater than length **int** will be truncated. If a summary delimiter is found, then the content will be truncated up to the summary delimiter.
    3. `format: long` -- Any summary delimiter of the content will be ignored.
        1. `size: 0` -- Summary equals the entire page content.
        2. `size: int` -- The content will be truncated after **int** chars, independent of summary delimiter position.
    4. `format: short` -- Detect and truncate content up to summary delimiter position.
        1. `size: 0` -- If no summary delimiter is found, the summary equals the page content, otherwise the content will be truncated up to summary delimiter position.
        2. `size: int` -- Always truncate the content after **int** chars. If a summary delimiter was found, then truncate content up to summary delimiter position.

### Template

```ruby
template: custom
```

As explained in [the previous chapter](../content-pages), the template from the theme that is used to render a page is based on the filename of the `.md` file.

So a file called `default.md`, will use the `default` template in the active theme.  You can, of course, override this behavior by simply setting the `template` variable in the header and choosing a different template.

In the example above, the page will use the `custom` template from the theme.  This variable exists because you may need to change the template of a page programmatically from a plugin.

### Taxonomy

```ruby
taxonomy:
    category: blog
    tag: [sample, demo, grav]
```

A very useful header variable, `taxonomy` lets you assign values to **taxonomy** you defined as valid types in the [Site Configuration](../../basics/grav-configuration#site-configuration) file.

If the taxonomy is not defined in that file, it will be ignored.  In this example, the page is defined as being in the `blog` category, and has the tags: `sample`, `demo`, and `grav`.  These taxonomies can be used to find these pages from other pages, plugins and even themes. The [Taxonomy](../taxonomy) chapter will cover this concept in more detail.

### Cache Enable

```ruby
cache_enable: false
```

By default, Grav will cache the contents of the page file to ensure things run as fast as possible.  There are advanced scenarios where you do not want the page to be cached.

An example of this is when you are using dynamic Twig variables in your content. The `cache_enable` variable allows this behavior to be overridden.  We will cover Twig Content variables in a later chapter. Valid values are `true` or `false`.

### Process

```ruby
process:
	markdown: false
	twig: true
```

Processing of the page is another advanced capability. By default Grav will process `markdown` but will **not** process `twig` in a page.  This choice to not process Twig by default is purely for performance reasons as this is not a commonly needed feature.  The `process` variable allows you to override this behavior.

You may want to disable `markdown` on a particular page if you want to use 100% HTML in your page and not have the markdown process run at all.  Also it allows a plugin to process content in another manner completely. Valid values are `true` or `false`.

There are situations when you want to use Twig templating functionality in your content, and this is accomplished by setting the `twig` variable to true.

### Process Twig First

```ruby
twig_first: false
```

If set to `true` Twig processing will occur before any Markdown processing. This can be particularly useful if your twig generates markdown that needs to be available in order to be processed by the Markdown compiler.  One thing to note, if have `cache_enable: false` **and** `twig_first: true` page caching is effectively disabled.

### Markdown

```ruby
  markdown:
    extra: false
    auto_line_breaks: false
    auto_url_links: false
    escape_markup: false
    special_chars:
      '>': 'gt'
      '<': 'lt'
```

* `extra`: Enable support for Markdown Extra support (GFM by default)
* `auto_line_breaks`: Enable automatic line breaks
* `auto_url_links`: Enable automatic HTML links
* `escape_markup`: Escape markup tags into entities
* `special_chars`: List of special characters to automatically convert to

These Markdown settings are a new feature we added in **v0.9.14**.  You can enable these globally via your `user/config/system.yaml` configuration file, or you can override this global setting _per-page_ with this `markdown` header option.

### Lightbox

``` ruby
lightbox: true
```

Although strictly speaking this is not a standard page header, it is a common way to enable the loading of a standard lightbox JavaScript and CSS for a page.  By default the core `antimatter` theme does not load the prerequisites to enable lightbox capabilities of images, be sure to install a lightbox plugin such as **Featherlight**, which is available via GPM.

### HTTP Response Code

``` ruby
http_response_code: 404
```

Allows the dynamic setting of an HTTP Response Code.

### ETag

```ruby
etag: true
```

Enable or disable on a page level whether or not to display an ETag header variable with a unique value. False by default unless overridden in your `system.yaml`.

### LastModified

```ruby
last_modified: true
```

Enable or disable on a page level whether or not to display an Last Modified header variable with modified date. False by default unless overridden in your `system.yaml`.


## Meta Page Headers

Meta headers allow you to set the [standard set of HTML **<meta> tags**](http://www.w3schools.com/tags/tag_meta.asp) for each page as well as [OpenGraph](http://ogp.me/), [Facebook](https://developers.facebook.com/docs/sharing/best-practices), and [Twitter](https://dev.twitter.com/cards/overview).

### Standard Metatag examples

```ruby
metadata:
    description: Your page description goes here
    keywords: HTML, CSS, XML, JavaScript
    author: John Smith
    robots: noindex, nofollow
```

All HTML5 metatags are supported.

### OpenGraph Metatag examples

```ruby
metadata:
    og:
        title: The Rock
        type: video.movie
        url: http://www.imdb.com/title/tt0117500/
        image: http://ia.media-imdb.com/images/rock.jpg
```

For a full outline of all OpenGraph metatags that can be used, please consult the [official documentation](http://ogp.me/).

### Facebook Metatag examples

```ruby
metadata:
    fb:
        app_id: your_facebook_app_id
```

Facebook mostly uses OpenGraph metatags, but there are some Facebook-specific tags and these are support automatically by Grav.

### Twitter Metatag examples

```ruby
metadata:
    'twitter:card' : summary
    'twitter:site' : @flickr
    'twitter:title' : Your Page Title
    'twitter:description' : Your page description can contain summary information
    'twitter:image' : https://farm6.staticflickr.com/5510/14338202952_93595258ff_z.jpg
```

For a full outline of all Twitter metatags that can be used, please consult the [official documentation](https://dev.twitter.com/cards/overview).

## Collection Headers

To tell Grav that a specific page should be a listing page and contain child-pages, there are a number of variables that can be used:

### Collection of Children

You configure how the collection of pages is defined.  This mechanism is very flexible but the default configuration for pages that exist below the parent, listing page, would look like this:

```ruby
content:
    items: @self.children
```

The `content.items` value tells Grav to gather up a collection of items and specifically `@self.children` indicates that the collection should consist of the **published child pages** below this page in the folder structure.

### Collection of Modular Children

```ruby
content:
    items: @self.modular
```

The `@self.modular` configuration option tells Grav that the page should consist of all the **published modular pages** that exist as children of this particular page.

### Collection of Page's Children

```ruby
content:
    items:
      @page: /blog
```

the `@page` configuration will find all **non-modular** and **published** pages for a particular page. You must provide a valid page route to this option.

### Collection by Taxonomy

```ruby
content:
   items:
      @taxonomy.tag: foo
```

Using the `@taxonomy` option, you can utilize Grav's powerful taxonomy functionality.  This is where the `taxonomy` variable in the [Site Configuration](../../basics/grav-configuration#site-configuration) file comes into play. There **must** be a definition for the taxonomy defined in that configuration file for Grav to interpret a page reference to it as valid.

By setting `@taxonomy.tag: foo`, Grav will find all the **published pages** in the `/user/pages` folder that have themselves set `tag: foo` in their taxonomy variable.

```ruby
content:
    items:
       @taxonomy.tag: [foo, bar]
```

The `content.items` variable can take an array of taxonomies and it will gather up all pages that satisfy these rules. Publsihed pages that have **both** `foo` **and** `bar` tags will be collected.  The [Taxonomy](../taxonomy) chapter will cover this concept in more detail.

>>> If you wish to place multiple variables inline, you will need to separate sub-variables from their parents with `{}` brackets. You can then separate individual variables on that level with a comma. For example: `@taxonomy: {category: [blog, featured], tag: [foo, bar]}`. In this example, the `category` and `tag` sub-variables are placed under `@taxonomy` in the hierarchy, each with listed values placed within `[]` brackets. Pages must meet **all** these requirements to be found.

If you have multiple variables in a single parent to set, you can do this using the inline method, but for simplicity, we recommend using the standard method. Here is an example.

```ruby
content:
  items:
    @taxonomy:
      category: [blog, featured]
      tag: [foo, bar]
```

Each level in the hierarchy adds two whitespaces before the variable. YAML will allow you to use as many spaces as you want here, but two is standard practice. In the above example, both the `category` and `tag` variables are set under `@taxonomy`.

### Multiple Collections

With Grav **0.9.41** you can not provide multiple collection definition and the resulting collection will be the sum of all the pages found from each of the collection definitions.  for example:

```ruby
content:
  items:
    @self.children
    @taxonomy:
      category: [blog, featured]
```

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

| Ordering     | Details                                                                                                                                            |
| :----------  | :----------                                                                                                                                        |
| **default**  | The order based on the file system, i.e. `01.home` before `02.advark`                                                                              |
| **title**    | The order is based on the title as defined in each page                                                                                            |
| **basename** | The order is based on the alphabetic folder name after it has been processed by the `basename()` PHP function                                      |
| **date**     | The order based on the date as defined in each page                                                                                                |
| **modified** | The order based on the modified timestamp of the page                                                                                              |
| **folder**   | The order based on the folder name with any numerical prefix, i.e. `01.`, removed                                                                  |
| **header.x** | The order based on any page header field. i.e. `header.taxonomy.year`. Also a default can be added via a pipe. i.e. `header.taxonomy.year|2015` |
| **manual**   | The order based on the `order_manual` variable                                                                                                     |
| **random**   | The order is randomized                                                                                                                            |

The `content.items.dir` variable controls which direction the ordering should be in. Valid values are either `desc` or `asc`.

In this configuration, you can see that `content.order.custom` is defining a **custom manual ordering** to ensure the page is constructed with the **showcase** first, **highlights** section second etc. Please note that if a page is not specified in the custom ordering list, then Grav falls back on the `content.order.by` for the unspecified pages.

`content.limit` is pretty self explanatory, and the `content.pagination` is a simple boolean flag to be used by plugins etc to know if **pagination** should be initialized for this collection.

### Date Range

New as of **Grav 0.9.13** is the ability to filter by a date range:

```
content:
    items: @self.children
    dateRange:
        start: 1/1/2014
        end: 1/1/2015
```

You can use any string date format supported by [strtotime()](http://php.net/manual/en/function.strtotime.php) such as `-6 weeks` or `last Monday` as well as more traditional dates such as `01/23/2014` or `23 January 2014`. The dateRange will filter out any pages that have a date outside the provided dateRange.  Both **start** and **end** dates are optional, but at least one should be provided.

## Custom Page Headers

Of course, you can create your own custom page headers using any valid YAML syntax.  These would be page-specific and be available for any plugin, or theme to make use of. A good example of this would be to set some variable specific to a sitemap plugin, such as:

```ruby
sitemap:
    changefreq: monthly
    priority: 1.03
```

The significance of these headers is that Grav does not use them by default, they are only read by the **sitemap plugin** to determine how often this particular page is modified and what its priority should be.

Any page header such as this should be documented, and generally there will be some default value that will be used if the page does not provide it.

Another example would be to store page-specific data that could then be used by Twig in the content of the page.

For example you might have want to associate some author reference for the page. If you added these YAML settings to the page header:

```ruby
author:
    name: Sandy Johnson
    twitter: @sandyjohnson
    bio: Sandy is a freelance journalist and author of several publications on open source CMS platforms.
```

You could then access them from Twig:

```
<section id="author-details">
    <h2>{{ page.header.author.name }}</h2>
    <p>{{ page.header.author.bio }}</p>
    <span>Contact: <a href="https://twitter.com/{{ page.header.author.twitter }}"><i class="fa fa-twitter"></i></a></span>
</section>
```

This really provides a lot of flexibility and power.
