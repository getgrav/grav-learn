---
title: Theme Variables
page-toc:
  active: true
taxonomy:
    category: docs
---

When you are designing a theme, Grav gives you access to all sorts of objects and variables from within your Twig templates.  The Twig templating framework provides powerful ways to read and manipulate these objects and variables.  This is [fully explained in their own documentation](http://twig.sensiolabs.org/doc/templates.html) as well as [summarized succinctly in our own documentation](../twig-primer).

!!!! In Twig, you can call methods that take no parameters by just calling the method name, and omitting the parentheses `()`.  If you need to pass parameters, you also need to provide those after the method name.  `page.content` is equivalent to `page.content()`

## Core Objects

There are several **core objects** that are available to a Twig template, and each object has a set of **variables** and **functions**.

### base_dir variable

The `{{ base_dir }}` variable returns the base file directory of the Grav installation.

### base_url variable

The `{{ base_url }}` returns the base URL to the Grav site, whether or not this shows the full URL is dependent on the `absolute_urls` [option in the system configuration](../../basics/grav-configuration#system-configuration).

### base_url_relative variable

The `{{ base_url_relative }}` returns the base URL to the Grav site, without the host information.

### base_url_absolute variable

The `{{ base_url_absolute }}` returns the base URL to the Grav site, including the host information.

### base_url_simple variable

The `{{ base_url_simple }}` returns the base URL to the Grav site, without the language code.

### home_url variable

The `{{ home_url }}` is particularly useful to use to link back to the homepage of your site. It is similar to `base_url` but takes into account the situation when the this is empty.

### html_lang variable

This will return the current active language if provided, else use the `site.default_lang` configured option, else fall back to `en`.

### theme_dir variable

The `{{ theme_dir }}` variable returns the file directory folder of the current theme.

### theme_url variable

The `{{ theme_url }}` returns the relative URL to the current theme.

### html_lang variable

The `{{ html_lang }}` returns the active language.

### language_codes variable

The `{{ language_codes }}` returns list of available languages of the site.


!! When linking to assets like images or JavaScript and CSS files, it's recommended to use the `url()` function in combination with the `theme://` stream as described on the [Twig Filters & Functions](/themes/twig-filters-functions#url) page. For JavaScript and CSS, the [Asset Manager](/themes/asset-manager) is even easier to use but in some cases like dynamic or conditional loading of assets, it will not work.

### config object

You can access any Grav configuration setting set in the YAML-files in `/user/config` via the `config`-object. For example:

[prism classes="language-twig"]
{{ config.system.pages.theme }}{# returns the currently configured theme #}
[/prism]

### site object

An alias to the `config.site` object. This represents the configuration as set in the `site.yaml` file.

### system object

An alias to the `config.system` object. This represents the configuration in the main `system.yaml` file.

### theme object

An alias to the `config.theme` object. This represents the configuration for the current active theme. Plugin settings are available through `config.plugins`.

### page object

Because Grav is built using the structure defined in the `pages/` folder, each page is represented by a **page object**.

The **page object** is probably _the_ most important object you will work with as it contains all the information about the current page you are currently on.

!! The whole list of the Page object methods is available on the [API site](https://learn.getgrav.org/api#class-gravcommonpagepage). Here's a list of the methods you'll find most useful.

##### summary([size])

This returns a truncated or shortened version of your content.  You can provide an optional `size` parameter to specify the maximum length of the summary, in characters.  Alternatively, if no size is provided, the value can be obtained via the site-wide variable `summary.size` from your `site.yaml` configuration.

[prism classes="language-twig"]
{{ page.summary }}
[/prism]

or

[prism classes="language-twig"]
{{ page.summary(50) }}
[/prism]

A third option is to use a manual delimiter of `===` in your content.  Anything before the delimiter will be used for the summary.

##### content()

This returns the entire HTML content of your page.

[prism classes="language-twig"]
{{ page.content }}
[/prism]

##### header()

This returns the page headers as defined in the YAML front-matter of the page.  For example a page with the following headers:

[prism classes="language-yaml line-numbers"]
title: My Page
author: Joe Bloggs
[/prism]

could be used:

[prism classes="language-twig"]
The author of this page is: {{ page.header.author }}
[/prism]

##### media()

This returns an array containing all the media associated with a page. These include **images**, **videos**, and other **files**.  You can access media methods as described in the [media documentation](../../content/media) for content. Because it is an array, Twig filters and functions can be used. Note: .svg are treated as files, not images, because they can not be manipulated using twig image filters.

Get a specific file or image:

[prism classes="language-twig"]
{% set my_pdf = page.media['myfile.pdf'] %}
[/prism]

Get the first image:

[prism classes="language-twig"]
{% set first_image = page.media.images|first %}
[/prism]

Loop over all images and output the HTML tag to display it:

[prism classes="language-twig"]
{% for image in page.media.images %}
   {{ image.html }}
{% endfor %}
[/prism]

##### title()

This returns the title of the page as set in the `title` variable of the YAML headers for the page itself.

[prism classes="language-yaml"]
title: My Page
[/prism]

##### menu()

This returns the value of the `menu` variable of the YAML headers of the page.  If none is provided, it defaults to the `title`.

[prism classes="language-yaml line-numbers"]
title: My Page
menu: my-page
[/prism]

##### visible()

This returns whether or not the page is visible.  By default pages with numeric value followed by a period are visible by default (`01.somefolder1`) while those without (`subfolder2`) are not considered visible. This can be overridden in the page headers:

[prism classes="language-yaml line-numbers"]
title: My Page
visible: true
[/prism]

##### routable()

This returns whether or not a page is routable by Grav.  This means if you can point your browser to the page and receive content back.  Non-routable pages can be used in templates, plugins, etc, but cannot be reached directly. This can be set in the page headers:

[prism classes="language-yaml line-numbers"]
title: My Page
routable: true
[/prism]

##### slug()

This returns the direct name as displayed in the URL for this page, for example `my-blog-post`.

##### url([include_host = false])

This returns the URL to the page, for example:

[prism classes="language-twig"]
{{ page.url }} {# could return /my-section/my-category/my-blog-post #}
[/prism]

or

[prism classes="language-twig"]
{{ page.url(true) }} {# could return http://mysite.com/my-section/my-category/my-blog-post #}
[/prism]

##### permalink()

This returns the URL with host information. Particularly useful when needing a quick link that can be accessed from anywhere.

##### canonical()

This returns the URL that is the 'preferred' version or link to a particular page.  This value will default to the regular URL unless the page has overridden the `canonical:` page header option.

##### route()

This returns the internal routing for a page.  This is primarily used for internal routing and dispatching of pages.

##### home()

This returns `true` or `false` based on whether or not this page is configured as the **home** page.  This setting is found in the `system.yaml` file.

##### root()

This returns `true` or `false` based on whether or not this page is the root page of the tree hierarchy.
Using: {{ page.parent.root() }}

##### active()

This returns `true` or `false` based on whether or not this page is currently the page your browser is accessing.  This is particularly useful in navigation to know if the page you are on is the active page.

##### modular()

This returns `true` or `false` based on whether or not this page is modular.

##### activeChild()

This returns whether or not this URI's URL contains the URL of the active page. Or in other words, is this page's URL in the current URL. Again this is useful when building your navigation and you wish to know if the page you are iterating over is the parent of an active child page.

##### find(url)

This returns a page object as specified by a route URL.

[prism classes="language-twig"]
{% include 'modular/author-detail.html.twig' with {'page': page.find('/authors/billy-bloggs')} %}
[/prism]

##### collection()

This returns the collection of pages for this context as determined by the [collection page headers](../../content/collections).

[prism classes="language-twig line-numbers"]
{% for child in page.collection %}
    {% include 'partials/blog_item.html.twig' with {'page':child, 'truncate':true} %}
{% endfor %}
[/prism]

##### currentPosition()

This returns the index of the current page in relation to its siblings.

##### isFirst()

This returns `true` or `false` based on whether this page is the first of its siblings.

##### isLast()

This returns `true` or `false` based on whether this page is the last of its siblings.

##### nextSibling()

This returns the next page from the array of siblings based on the current position.

##### prevSibling()

This returns the previous page from the array of siblings based on the current position.

!! nextSibling() and prevSibling() order pages in a stack-like structure. It works best in a blog situation, where the first blog post has nextSibling null and prevSibling is the previous blog post. If this ordering direction confuses you, we suggest using page.adjacentSibling(-1) to point to the next page instead of page.nextSibling() to reduce the confusion that the terminology might make. You can also define a constant in the theme and use that for better readability, like page.adjacentSibling(NEXT_PAGE)

##### children()

This returns an array of child pages for the page as defined in the pages content structure.

##### orderBy()

This returns the order type for any sorted children of the page. Values typically include: `default`, `title`, `date` and `folder`. This value is typically configured in page headers.

##### orderDir()

This returns the order direction for any sorted children of the page.  Values can be either `asc` for ascending or `desc` for descending. This value is typically configured in page headers.

##### orderManual()

This returns an array of manual page ordering for any children of the page. This value is typically configured in page headers.

##### maxCount()

This returns the maximum number of children pages that are allowed to be returned. This value is typically configured in page headers.

##### children.count()

This returns the number of child pages of the page.

##### children.current()

This returns the current child item.  Can be used while iterating over the children.

##### children.next()

This returns the next child in the array of children.

##### children.prev()

This returns the previous child in the array of children.

##### children.nth(position)

This returns the child identified by the `position` which is an integer from `0` to `children.count() - 1` in the array of children.

##### children.sort(orderBy, orderDir)

Reorders the children based on an **orderBy** (`default`, `title`, `date` and `folder`) and **orderDir** (`asc` or `desc`)

##### parent()

This returns the parent page object for this page. This is very useful when you need to navigate back up the nested tree structure of pages.



##### isPage()

This returns `true` or `false` based on whether this page has an actual `.md` file associated with it rather than just a folder for routing.

##### isDir()

This returns `true` or `false` based on whether this page is only a folder for routing.

##### id()

This returns a unique identifier for the page.

##### modified()

This returns a timestamp of when the page was last modified.

##### date()

This returns the date timestamp for the page.  Typically this is set in the headers to represent the date of a page or post.  If no value is defined explicitly, the file modified timestamp is used.

##### template()

This returns the name of the page template without the `.md` extension. For example `default`

##### filePath()

This returns the full file path of the page. For example `/Users/yourname/sites/grav/user/pages/01.home/default.md`

##### filePathClean()

This returns the relative path from the root of the Grav site.  For example `user/pages/01.home/default.md`

##### path()

This returns the full path to the directory containing the page.  For example `/Users/yourname/sites/grav/user/pages/01.home`

##### folder()

This returns the name of the folder for the page.  For example `01.home`

##### taxonomy()

This returns an array of the taxonomy associated with a page.  These can be iterated over. This is particularly useful for displaying items such as tags:

[prism classes="language-twig line-numbers"]
{% for tag in page.taxonomy.tag %}
    <a href="search/tag:{{ tag }}">{{ tag }}</a>
{% endfor %}
[/prism]

### pages object

!! The whole list of the Pages object methods is available on the [API site](https://learn.getgrav.org/api#class-gravcommonpagepages). Here's a list of the methods you'll find most useful.

The **pages object** represents a nested tree of every **page object** that Grav knows about.  This is particularly useful for creating a **sitemap**, **navigation** or if you wish to find a particular **page**.

##### children method

This returns the immediate child pages as an array of **page objects**. As the pages object represents the entire tree, you can fully recurse over every page in the Grav pages/ folder.

Get the top-level pages for a simple menu:

[prism classes="language-twig line-numbers"]
<ul class="navigation">
    {% for page in pages.children %}
        {% if page.visible %}
            <li><a href="{{ page.url }}">{{ page.menu }}</a></li>
        {% endif %}
    {% endfor %}
</ul>
[/prism]

### media object

There is a new object that allows you to access [media](../../content/media) that is outside of Page objects via PHP streams from Twig. This works in a similar manner to [image linking in content](../../content/image-linking#php-streams) by using streams to access images, and media processing to manipulate theme.

`media['user://media/bird.png'].resize(50, 50).rotate(90).html()`

### uri object

!! The whole list of the Uri object methods is available on the [API site](https://learn.getgrav.org/api#class-gravcommonuri). Here's a list of the methods you'll find most useful.

The Uri object has several methods to access parts of the current URI. For the full URL `http://mysite.com/grav/section/category/page.json/param1:foo/param2:bar/?query1=baz&query2=qux`:

##### path()

This returns the path portion of the URL: (e.g. `uri.path` = `/section/category/page`)

##### paths()

This returns the array of path elements: (e.g. `uri.paths` = `[section, category, page]`)

##### route([absolute = false][, domain = false])

This returns the route as either an absolute or relative URL.  (e.g. `uri.route(true)` = `http://mysite.com/grav/section/category/page` or `uri.route()` = `/section/category/page`)

##### params()

This returns the params portion of the URL: (e.g. `uri.params` = `/param1:foo/param2:bar`)

##### param(id)

This returns the value of a particular param.  (e.g. `uri.param('param1')` = `foo`)

##### query()

This returns the query portion of the URL: (e.g. `uri.query` = `query1=bar&query2=qux`)

##### query(id)

You can also retrieve specific query items: (e.g. `uri.query('query1')` = `bar`)

##### url([include_host = true])

This returns the full URL with or without the host.  (e.g. `uri.url(false)` = `grav/section/category/page/param:foo?query=bar`)

##### extension()

This returns the extension, or will return `html` if not provided: (e.g. `uri.extension` = `json`)

##### host()

This returns the host portion of the URL. (e.g. `uri.host` = `mysite.com`)

##### base()

This returns the base portion of the URL. (e.g. `uri.base` = `http://mysite.com`)

##### rootUrl([include_host = false])

This returns the root url to the grav instance.  (e.g. `uri.rootUrl()` = `http://mysite.com/grav`)

##### referrer()

This returns the referrer information for this page.

### header object

The header object is an alias for `page.header()` of the original page.  It's a convenient way to access the original page headers when you are looping through other `page` objects of child pages or collections.

### content object

The content object is an alias for the `page.content()` of the original page.

### taxonomy object

The global Taxonomy object that contains all the taxonomy information for the site.

### browser object

!! The whole list of the Browser object methods is available on the [API site](https://learn.getgrav.org/api#class-grav-common-browser). Here's a list of the methods you'll find most useful.

Grav has built-in support for programmatically determining the platform, browser, and version of the user.

[prism classes="language-twig"]
{{ browser.platform}}   # macintosh
{{ browser.browser}}    # chrome
{{ browser.version}}    # 41
[/prism]

### user object

You can access the current logged in user object indirectly via the Grav object.  This allows you to access such data as `username`, `fullname`, `title`, and `email`:

[prism classes="language-twig"]
{{ grav.user.username }}  # admin
{{ grav.user.fullname }}  # Billy Bloggs
{{ grav.user.title }}     # Administrator
{{ grav.user.email }}     # billy@bloggs.com
[/prism]

## Adding Custom Variables

You can easily add custom variables in a variety of ways.  If the variable is a site-wide variable, you can put the variable in your `user/config/site.yaml` file and then access it via:

[prism classes="language-twig"]
{{ site.my_variable }}
[/prism]

Alternatively, if the variable is only needed for a particular page, you can add the variable to your page's YAML front-matter, and access it via the `page.header` object.  For example:

[prism classes="language-twig"]
title: My Page
author: Joe Bloggs
[/prism]

could be used as:

[prism classes="language-twig"]
The author of this page is: {{ page.header.author }}
[/prism]

## Adding Custom Objects

An advanced way to add custom objects is to use a plugin to add objects to the Twig object.  This is an advanced topic and is covered in more detail in the [plugins chapter](../../plugins/event-hooks).
