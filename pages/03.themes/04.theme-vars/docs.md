---
title: Theme Variables
taxonomy:
    category: docs
---

When you are designing a theme, Grav gives you access to all sorts of objects and variables from your twig templates.  The Twig templating framework provides powerful ways to read and manipulate these objects and variables.  This is [fully explained in their own documentation](http://twig.sensiolabs.org/doc/templates.html) as well as [summarized succinctly in our own documentation](twig-primer).

>>>> In twig, you can call methods that take no parameters by just calling the method name, and omitting the parentheses `()`.  If you need to pass parameters, you also need to provied those after the method name.  `page.content` is equivalant to `page.content()`

## Core Objects

There are several **core objects** that are available to a twig template, and each object has a set of ****variables** and **functions**.

### base_dir variable

the `{{ base_dir }}` variable returns the base file directory of the Grav installation.

### base_url_absolute variable

the `{{ base_url_absolute }}` returns the base URL to the Grav site, including the host information

### theme_dir variable

the `{{ theme_dir }}` variable returns the file directory folder of the current theme

### theme_url variable

the `{{ theme_url }}` returns the relative URL to the current theme

### config object

You can access any Grav configuration setting via the config object as set in the `configuration.yaml` file.  For example:

```
{{ config.pages.theme }}{# returns the currently configured theme #}
```

### site object

An alias to the `config.site` object. This represents the configuration as set in the `site.yaml` file.

### stylesheets object

An array to store CSS stylesheet assets in.  This can the be looped over and used to add CSS stylesheets to the template.

### scripts object

An array to store JavaScript assets in.  This can the be looped over and used to add JavaScript to the template.

### page object

Because Grav is built using the structure defined in the `pages/` folder, each page is represented by a **page object**.

The **page object** is probably _the_ most important object you will work with as it contains all the information about the current page your currently on. 

##### summary([size])

Returns a truncated or shortened version of our content.  You can provide an optional `size` parameter to specify the number of words.  Alternatively, if no size is provided, the value can obtained via the site-wide variable `summary.size` from your `site.yaml` configuration.

```
{{ page.summary }}
```

or 

```
{{ page.summary(50) }}
```

A third option is to use a manual delimiter of `===` in your content.  Anything before the delimiter will be used for the summary.

##### content()

Returns the entire HTML content of your page.

```
{{ page.content }}
```

##### headers()

Returns the page headers as defined in the YAML front-matter of the page.  For example a page with the following headers:

```
---
title: My Page
author: Joe Bloggs
---
```

could be used:

```
The author of this page is: {{ page.headers.author }}
```

##### media()

Returns an array containing all the media associated with a page. These include **images**, **videos**, and other **files**.  You can access media methods as described in the [media documentation](../content/media) for content. Because it is an array, Twig filters and functions can be used.

```
{% set first_image = page.media|first %}
{% set my_pdf = page.media['myfile.pdf'] %}
{% for image in page.media.images %}
   {{ image.html }}
{% endfor %}
```

##### title()

Returns the title of the page as set in the `title` variable of the YAML headers for the page itself. 

```
---
title: My Page
---
```

##### menu()

Returns the value of the `menu` variable of the YAML headers of the page.  If none is provided, it defaults to the `title`.

```
---
title: My Page
menu: my-page
---
```

##### visible()

Returns whether or not the page is visible.  By default pages with numeric value followed by a period are visible by default (`01.somefolder1`) while those without (`subfolder2`) are not considered visible. This can be overriden in the page headers:

```
---
title: My Page
visible: true
---
```

##### routable()

Returns whether or not a page is routable by Grav.  This means if you can point your browser to the page and receive content back.  Non-routable pages can be used in template, plugins, etc, but cannot be reached directly. This can be set in the page headers:

```
---
title: My Page
routable: true
---
```

##### slug()

Returns the direct name as displayed in the URL for this page, for example `my-blog-post`.

##### url([include_host = false])

Returns the URL to the page. for example:

```
{{ page.url }} {# could return /my-section/my-category/my-blog-post #}
```

or

```
{{ page.url(true) }} {# could return http://mysite.com/my-section/my-category/my-blog-post #}
```

##### route()

Returns the internal routing for a page.  This is primarily used for internal routing and dispatching of pages.

##### home()

Returns `true` or `false` based on whether or not this page is configured as the **home** page.  This setting is set in the `system.yaml` file.

##### root()

Returns `true` or `false` based on whether or not this page is the root page of the tree hierarchy.

##### active()

Returns `true` or `false` based on whether or not this page is currently the page your browser is accessing.  This is particularly useful in navigation to know if the page your on is the active page.

##### modular()

Returns `true` or `false` based on whether or not this page is modular.

##### activeChild()

Returns whether or not this URI's URL contains the URL of the active page. Or in other words, is this page's URL in the current URL. Again this is useful when building navigation and you wish to know if the page your are iterating over is the parent of an active child page.

##### find(url)

Returns a page object as specified by a route URL.

```
{% include 'modular/author-detail.html.twig' with {'page': page.find('/authors/billy-bloggs')} %}
```

##### collection()

Returns the collection of pages for this context as determined by the [collection page headers](../content/headers).

```
{% for child in page.collection %}
    {% include 'partials/blog_item.html.twig' with {'page':child, 'truncate':true} %}
{% endfor %}
```

##### isFirst()

Returns `true` or `false` based on whether this page is the first of its siblings.

##### isLast()

Returns `true` or `false` based on whether this page is the last of its siblings.

##### nextSibling()

Returns the next page from the array of siblings based on the current position.

##### prevSibling()

Returns the next page from the array of siblings based on the current position.

##### children()

Returns an array of child pages for the page as defined in the pages content structure. 

##### orderBy()

Returns the order type for any sorted children of the page. Values typically include: `default`, `title`, `date` and `folder`. This value is typically configured in page headers.

##### orderDir()

Returns the order direction for any sorted children of the page.  Values can be either `asc` for ascending or `desc` for descending. This value is typically configured in page headers.

##### orderManual()

Returns an array of manual page ordering for any children of the page.This value is typically configured in page headers.

##### maxCount()

Returns the maximum number of children pages that are allowed to be returned. This value is typically configured in page headers.

##### children.count()

Returns the number of child pages of the page.

##### children.current()

Returns the current child item.  Can be used while iterating over the children

##### children.next()

Returns the next child in the array of children.

##### children.prev()

Returns the previous child in the array of children.

##### children.nth(position)

Returns the child identified by the `position` which is an integer from `0` to `children.count() - 1` in the array of children.

##### children.sort(orderBy, orderDir)

Reorders the children based on an **orderBy** (`default`, `title`, `date` and `folder`) and **orderDir** (`asc` or `desc`)

##### parent()

Returns the parent page object for this page. This is very useful when you need to navigate back up the nested tree structure of pages.

##### isPage()

Returns `true` or `false` based on whether this page has an actual `.md` file associated with it rather than just a folder for routing.

##### isDir()

Returns `true` or `false` based on whether this page is only a folder for routing

##### id()

Returns a unique identifier for the page.

##### modified()

Returns a timestamp of when the page was last modified.

##### date()

Returns the date timestamp for the page.  Typically this is set in the headers to represent the date of a page or post.  If no value is defined explicityly, the file modified timestamp is used.

##### filePath()

Returns the full file path of the page. For example `/Users/yourname/sites/grav/user/pages/01.home/default.md`

##### filePathClean()

Returns the relative path from the root of the Grav site.  For example `user/pages/01.home/default.md`

##### path()

Returns the full path to the directory containing the page.  For example `/Users/yourname/sites/grav/user/pages/01.home`

##### folder()

Returns the name of the folder for the page.  For example `01.home`

##### taxonomy()

Returns an array of the taxonomy associated with a page.  These can be iterated over. This is particularly useful for displaying items such as tags:

```
{% for tag in page.taxonomy.tag %}
	<a href="search/tag:{{ tag }}">{{ tag }}</a>
{% endfor %}
```


### pages object

The **pages object** represents a nested tree of every **page object** that Grav knows about.  This is particularly useful for creating a **sitemap**, **navigation** of if you wish to find a particular **page**.  

##### children method

Returns the immediate child pages as an array of **page objects**. As the pages object represents the entire tree, you can fully recurse over every page in the Grav pages/ folder.



Get the top-level pages for a simple menu:
```
<ul class="navigation">
    {% for page in pages.children %}
	    {% if page.visible %}
	    	<li><a href="{{ page.url }}">{{ page.menu }}</a></li>
	    {% endif %}
    {% endfor %}
</ul>   
```



### uri Object

The Uri object has several methods to access parts of the current URI. For the full URL `http://mysite.com/grav/section/category/page.json/param:foo?query=bar`:

##### paths()

Returns the path portion of the URL: e.g. `uri.paths` = `/section/category/page`

##### path()

Returns the array of path elements: e.g. `uri.path` = `[section, category, page]`

##### route([absolute = false][, domain = false])

Returns the route as either an absolute or relative URL.  e.g. `uri.route(true)` = `http://mysite.com/grav/section/category/page` or `uri.route()` = `/section/category/page`.

##### query()

Returns the query portion of the URL: e.g. `uri.query` = `query=foo`

##### params()

Returns the params portion of the URL: e.g. `uri.params` = `param:food`

##### param(id)

Returns the value of a particular param.  e.g. `uri.param['param']` = `foo`

##### url([include_host = true])

Returns the full URL with or without the host.  e.g. `uri.url(false)` = `grav/section/category/page/param:foo?query=bar`	

##### extension()

Returns the extension, or will return `html` if not provided: e.g. `uri.extension` = `json`

##### host()

Returns the host portion of the URL. e.g. `uri.host` = `mysite.com`

##### base()

Returns the base portion of the URL. e.g. `uri.base` = `http://mysite.com`

##### rootUrl([include_host = true])

Returns the root url to the grav instance.  e.g. `uri.rootUrl()` = `http://mysite.com/grav`

##### referrer()

Returns the referrer information for this page.

### header object

The header object is an alias for `page.headers()` of the original page.  It's a convenient way to access the original page headers when you are looping through other `page` objects of child pages or collections.

### content object

The content object is an alias for the `page.content()` of the original page.

### taxonomy object

The global Taxonomy object that contains all the taxonomy information for the site.

## Adding Custom Variables

You can easily add custom variables in a variety of ways.  If the variable is a site-wide variable, you can put the variable in your `user/config/site.yaml` file and then access it via:

```
{{ site.my_variable }}
```

Alternatively if the variable is only needed for a particular page, you can add the variable to your page's YAML front-matter, and access it via the `page.headers` object.  For example:

```
---
title: My Page
author: Joe Bloggs
---
```

could be used:

```
The author of this page is: {{ page.headers.author }}
```


## Adding Custom Objects

An advanced way to add custom objects is to use a plugin to add objects to the Twig object.  This is an advanced topic and is covered in more detail in the [plugins chapter](../plugins/event-hooks).
