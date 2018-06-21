---
title: Headers / Frontmatter
taxonomy:
    category: docs
---

The headers (alternatively known as frontmatter) at the top of a page are completely optional, you do not need them at all for a page to display within Grav. There are 3 primary types of pages (**Standard**, **Listing**, and **Modular**) within Grav, and each has relevant headers.

! Headers are also known as **Page Frontmatter** and are commonly referred to as such so as not to be confused with HTTP Headers.

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

! Dates in the `m/d/y` or `d-m-y` formats are disambiguated by looking at the separator between the various components: if the separator is a slash (`/`), then the **American** `m/d/y` is assumed; whereas if the separator is a dash (`-`) or a dot (`.`), then the **European** `d-m-y` format is assumed.

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

### Expires

```ruby
Expires: 604800
```

Page expires time in seconds (604800 seconds = 7 days) (`no cache` is also possible).

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

### SSL

```ruby
ssl: true
```

As of Grav **1.0.9** you can now enable a specific page to be forced with SSL **on** or **off**.  This **only works** with the `absolute_urls: true` option set in the `system.yaml` configuration.  This is because to be able to switch back and forth between SSL and non-SSL pages, you must be using full URLs with the protocol and host included.

### Redirect

```ruby
redirect: '/some/custom/route'
```

or

```ruby
redirect: 'http://someexternalsite.com'
```

As of Grav **0.9.41** you can now redirect to another internal or external page right from a page header.  Of course this means this page will not be displayed, but the page can still be in a collection, menu, etc because it will exist as a page within Grav.

As of Grav **1.0.0** you can also append a redirect code to a URL by using square brackets:

```ruby
redirect: '/some/custom/route[303]'
```

### Routes

```
routes:
  default: '/my/example/page'
  canonical: '/canonical/url/alias'
  aliases:
    - '/some/other/route'
    - '/can-be-any-valid-slug'
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

### Login Redirect Here

```ruby
login_redirect_here: false
```

The `login_redirect_here` header enables you to determine whether or not someone is kept on that page after logging in through the [Grav Login Plugin](https://github.com/getgrav/grav-plugin-login). Setting this header to `false` will forward someone to the prior page after a successful login.

A `true` setting here will enable the person to stay on the current page after a successful login. This is also the default setting, which applies if there is no `login_redirect_here` header in the frontmatter.

You can override this default behavior by forcing a standard location by specifying an explicit option in your Login configuration YAML:

```ruby
redirect_after_login: '/profile'
```

This will always take you to the `/profile` route after a successful login.

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

### Template Format

```ruby
template_format: xml
```

Traditionally, if you want a page to output a specific format (ie: xml, json, etc.) you needed to append the format to the url. For example, entering `http://example.com/sitemap.xml` would tell the browser to render the content using the `xml` twig template ending in `.xml.twig`. This is all well and good, because we love doing things simply in Grav.

Using the `template_format` page header, we can tell the browser how to render the page without any need for extensions in the URL. By entering `template_format: xml` in our `sitemap` page, we can make `http://example.com/sitemap` work for us without having to append `.xml` to the end of it.

We [used this method](https://github.com/getgrav/grav-plugin-sitemap/commit/00c23738bdbfe9683627bf0f99bda12eab9505d5#diff-190081f40350c0272970d9171f3437a2) with the [Grav Sitemap Plugin](https://github.com/getgrav/grav-plugin-sitemap).

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

### Never Cache Twig

```ruby
never_cache_twig: true
```

Enabling this will allow you to add a processing logic that can change dynamically on each page load, rather than caching the results and storing it for each page load. This can be enabled/disabled site-wide in the **system.yaml**, or on a specific page. Can be set `true` or `false`.

This is a subtle change, but one that is especially useful in modular pages as it keeps you from having to constantly disable caching when you're working with it. The page is still cached, but not the Twig. The Twig is processed after the cached content is retrieved. For modular forms, it now works with just this setting rather than having to disable the modular page cache.

!! This is not compatible with `twig_first: true` currently because all processing is happening in the one Twig call.

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

If set to `true` Twig processing will occur before any Markdown processing. This can be particularly useful if your Twig generates markdown that needs to be available in order to be processed by the Markdown compiler.  One thing to note, if have `cache_enable: false` **and** `twig_first: true` page caching is effectively disabled.

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

Enable or disable on a page level whether or not to display a Last Modified header variable with modified date. False by default unless overridden in your `system.yaml`.


## Meta Page Headers

Meta headers allow you to set the [standard set of HTML **<meta> tags**](http://www.w3schools.com/tags/tag_meta.asp) for each page as well as [OpenGraph](http://ogp.me/), [Facebook](https://developers.facebook.com/docs/sharing/best-practices), and [Twitter](https://dev.twitter.com/cards/overview).

### Standard Metatag examples

```ruby
metadata:
    refresh: 30
    generator: 'Grav'
    description: 'Your page description goes here'
    keywords: 'HTML, CSS, XML, JavaScript'
    author: 'John Smith'
    robots: 'noindex, nofollow'
    my_key: 'my_value'
```

This will produce the HTML:

```
<meta name="generator" content="Grav" />
<meta name="description" content="Your page description goes here" />
<meta http-equiv="refresh" content="30" />
<meta name="keywords" content="HTML, CSS, XML, JavaScript" />
<meta name="author" content="John Smith" />
<meta name="robots" content="noindex, nofollow" />
<meta name="my_key" content="my_value" />
```

All HTML5 metatags are supported.

### OpenGraph Metatag examples

```ruby
metadata:
    'og:title': The Rock
    'og:type': video.movie
    'og:url': http://www.imdb.com/title/tt0117500/
    'og:image': http://ia.media-imdb.com/images/rock.jpg
```

This will produce the HTML:

```
<meta name="og:title" property="og:title" content="The Rock" />
<meta name="og:type" property="og:type" content="video.movie" />
<meta name="og:url" property="og:url" content="http://www.imdb.com/title/tt0117500/" />
<meta name="og:image" property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" />
```

For a full outline of all OpenGraph metatags that can be used, please consult the [official documentation](http://ogp.me/).

### Facebook Metatag examples

```ruby
metadata:
    'fb:app_id': your_facebook_app_id
```

This will produce the HTML:

```
<meta name="fb:app_id" property="fb:app_id" content="your_facebook_app_id" />
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

This will produce the HTML:

```
<meta name="twitter:card" property="twitter:card" content="summary" />
<meta name="twitter:site" property="twitter:site" content="@flickr" />
<meta name="twitter:title" property="twitter:title" content="Your Page Title" />
<meta name="twitter:description" property="twitter:description" content="Your page description can contain summary information" />
<meta name="twitter:image" property="twitter:image" content="https://farm6.staticflickr.com/5510/14338202952_93595258ff_z.jpg" />
```

For a full outline of all Twitter metatags that can be used, please consult the [official documentation](https://dev.twitter.com/cards/overview).

## Debugger

When you enable the debugger via the `system.yaml` configuration file, the debugger will display on every page.  There are cases where this may not be desirable or may cause conflicts with the output.  Such an example is when you are requesting a page that is intended to return rendered HTML to an Ajax call.  This should not have the debugger injected into the resulting data.  To disable the debugger on this page you can use the `debugger` page header:

```ruby
debugger: false
```

## Custom Page Headers

Of course, you can create your own custom page headers using any valid YAML syntax.  These would be page-specific and be available for any plugin, or theme to make use of. A good example of this would be to set some variable specific to a sitemap plugin, such as:

```ruby
sitemap:
    changefreq: monthly
    priority: 1.03
```

The significance of these headers is that Grav does not use them by default. They are only read by the **sitemap plugin** to determine how often this particular page is modified and what its priority should be.

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

## Collection Headers

Collections have grown up! All [Collection Header information](../collections) is now broken out into [their own separate section](../collections).

## Frontmatter.yaml

An advanced feature that can come in handy for some power users is the ability to use common frontmatter values via a `frontmatter.yaml` file located in the page folder.  This is particular useful when working with multi-language sites where you may wish to share a portion of the frontmatter between all the language versions of a given page.

To take advantage of this, simply create a `frontmatter.yaml` file alongside your page's `.md` file and add any valid frontmatter values.  For example:

```
metadata:
    generator: 'Super Grav'
    description: Give your page a powerup with Grav!
```

!!!! Utilizing frontmatter.yaml is a file-side feature and is **not supported** by the admin plugin.
