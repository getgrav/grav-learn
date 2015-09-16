---
title: Pages
taxonomy:
    category: docs
process:
	twig: true
---

In Grav-speak, **pages** are the fundamental building blocks of your site.  They are how you write content and provide navigation in the Grav system.

Combining content and navigation ensures that the system is intuitive to use for even the most inexperienced of content authors. However, this system, in conjunction with powerful taxonomy capabilities, is still powerful enough to handle complex content requirements.

Grav natively supports **3 types of pages** that allow you to create a rich selection of web content. Those types are:

{{ media['page-types.png'].html('Grav Page Types') }}

#### Standard Page

{{ media['content-standard.jpg'].html('Standard Page','border') }}

A standard page is generally a single page such as a **blog post**, **contact form**, **error page** etc. This is the most common type of page that you will create. By default a page is considered a standard page unless you tell Grav otherwise.

When you download and install the **Base Grav** package, you are greeted by a standard page.  We covered creating a simple standard page in the [Basic Tutorial](../../basics/basic-tutorial).

#### Listing Page

{{ media['content-listing.jpg'].html('Listing Page','border') }}

This is really an extension of a standard page. This is a standard page that has a reference to a collection of pages.

The simplest approach to setting this up is to create **child pages** below the listing page. A good example of this would be a **blog listing page**, where you would have a page that displays a summary list of blog posts that exist as child pages.

There is also some configuration settings to **control the order** of the listing as well as a **limit on the number of items**, and whether or not **pagination** should be enabled.

>>> A sample **Blog Skeleton** using a **Listing Page** can be found in the [Grav Downloads](http://getgrav.org/downloads).

#### Modular Page

{{ media['content-modular.jpg'].html('Modular Page','border') }}

A modular page is a special type of listing page because it actually builds a **single page** from its **child pages**. This allows for the ability to build very complex **one-page layouts** from smaller modular content pages. This is accomplished by constructing the **modular page** from multiple **modular folders** found in the page's primary folder.

>>> A sample **One-Page Skeleton** using a **Modular Page** can be found in the [Grav Downloads](http://getgrav.org/downloads).

Each of these page types follow the same basic structure, so before we can get into the nitty-gritty of each type, we must explain how pages in Grav are constructed.

>>> A modular page, because it is intended to be part of another page, is inherently not a page you can reach
directly via a URL.  Because of this, all modular pages are by default set as **non-routable**.

## Folders

All content pages are located in the `/user/pages` folder. Each **page** should be placed in its own folder.

>>> Folder names should also be valid **slugs**. Slugs are entirely lowercase, with accented characters replaced by letters from the English alphabet and whitespace characters replaced by a dash or an underscore, in order to avoid being encoded.

Grav understands that any integer value followed by a period will be solely for the purpose of ordering, and is removed internally in the system.  For example, if you have a folder named `01.home`, Grav will treat this folder as `home`, but will ensure that with default ordering, it comes before `02.blog`.

{{ media['page-folders.png'].html('Grav Folder Example') }}

Your site must have an entry-point so that it knows where to go when you point your browser to the root of your site. For example if you were to enter `http://yoursite.com` in your browser,  by default, Grav expects an alias `home/`, but you can override the home location by changing the `home.alias` option in the [Grav configuration file](../../basics/grav-configuration).

**Modular folders** are identified by an underscore (`_`) before the folder name.  This is a special folder type that is intended to be used only with **modular content**.  These are **not routable** and **not visible** in the navigation. An example of a modular folder would be a folder such as `user/pages/01.home/_header`. Home is actually configured as a **modular page** and would be constructed from the `_header`, `_features`, and `_body` modular pages.

The textual name of each folder defaults to the _slug_ that the system uses as part of the URL.  For example if you have a folder such as `/user/pages/02.blog`, the slug for this page would default to `blog`, and the full URL would be `http://yoursite.com/blog`. A blog item page, located in `/user/pages/02.blog/blog-item-5` would be accessible via `http://yoursite.com/blog/blog-item-5`.

If no number is provided as a prefix of the folder name, the page is considered to be **invisible**, and will not show up in the navigation. An example of this would be the `error` page in the above folder structure.

>>> This can actually be overridden in the page itself by setting the [visible parameter](../headers#visible) in the headers.

## Ordering

When dealing with collections, there are several options available to control how folders are ordered. The most important option is set in the `content.order.by` of the page configuration settings. The options are:

| Ordering     | Details                                                                                                                                              |
| :----------  | :----------                                                                                                                                          |
| **default**  | The order based on the file system, i.e. `01.home` before `02.advark`                                                                                |
| **title**    | The order is based on the title as defined in each page                                                                                              |
| **basename** | The order is based on the alphabetic folder without numeric order                                                                                    |
| **date**     | The order based on the date as defined in each page                                                                                                  |
| **modified** | The order based on the modified timestamp of the page                                                                                                |
| **folder**   | The order based on the folder name with any numerical prefix, i.e. `01.`, removed                                                                    |
| **header.x** | The order based on any page header field. i.e. `header.taxonomy.year`. Also a default can be added via a pipe. i.e. `header.taxonomy.year|2015` |
| **manual**   | The order based on the `order_manual` variable                                                                                                       |
| **random**   | The order is randomized                                                                                                                              |

You can specifically define a manual order by providing a list of options to the `content.order.custom` configuration setting. This will work in conjunction with the `content.order.by` because it first tries to manually order the pages, but any pages not specified in the manual order, will be fall-through and be ordered by the ordering setting provided.

>>> You can override the **default behavior** for folder ordering and the direction in which the ordering occurs by setting the `pages.order.dir` and the `pages.order.by` options in the [Grav system configuration file](../../basics/grav-configuration).

## Page File

Within the page folder, we can create the actual page file.  The filename should end with `.md` to indicate that it is a Markdown formatted file.  Technically, it is markdown with YAML front matter, which sounds impressive but really is not a big deal at all. We will cover the details of the file structure soon.

The important thing to understand is the name of the file directly references the name of the theme's template file that will be used to render.  The standard name for the main template file is **default**, so the file would be named `default.md`.

You can of course name your file whatever you like, for example: `document.md`, which would cause Grav to look for a template file in the theme that matches, such as the **document** template.

>>> This behavior can be overridden in the page by setting the [template parameter](../headers#template) in the headers.

An example page file could look like this:

	---
	title: Page Title
	taxonomy:
	    category: blog
	---
	# Page Title

	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque porttitor eu
	felis sed ornare. Sed a mauris venenatis, pulvinar velit vel, dictum enim. Phasellus
	ac rutrum velit. **Nunc lorem** purus, hendrerit sit amet augue aliquet, iaculis
	ultricies nisl. Suspendisse tincidunt euismod risus, _quis feugiat_ arcu tincidunt
	eget. Nulla eros mi, commodo vel ipsum vel, aliquet congue odio. Class aptent taciti
	sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque
	velit orci, laoreet at adipiscing eu, interdum quis nibh. Nunc a accumsan purus.

The settings between the pair of `---` markers is known as the YAML front matter, and it is comprised of basic YAML settings for the page.

In this example, we are explicitly setting the title, as well setting the taxonomy to **blog** so we can filter it later.  The content after the second `---` is the actual content that will be compiled and rendered as HTML on your site.  This is written in [Markdown](../markdown), which will be covered in detail in a future chapter.  Just know that the `#`, `**`, and `_` markers translate to a **heading1**, **bold**, and **italics**, respectively.

>>> Ensure you save your `.md` files as `UTF8` files.  This will ensure they work with language-specific special characters.

### Summary Size and Separator

There is a setting in the `site.yaml` file that lets you define a default size (in characters) of the summary that can be used via `page.summary()` to display a summary or synopsis of the page.  This is particularly useful for blogs where you want to have a listing that contains just summary information, and not the full page content.

By default this value is `300` characters.  You can override this in your own `user/config/site.yaml` file, but an even more useful approach is to use the manual **summary separator** also known as the **summary delimiter**: `===`.

You just need to ensure you put this in your content with blank lines **above** and **below**.  For example:

```
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.

===

Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
```

This will use the text above the separator when referenced by `page.summary()` and the full page content when referenced by `page.content()`.

>>> When using `page.summary()`, the summary size setting will be used if the separator is not found in the page content.

### Finding other Pages

Grav has a useful feature that allows you to find another page and perform actions on that page. This can be accomplished with the `find()` method that simply takes the **route** and returns a new page object.

This allows you to perform a wide variety of functionality from any page on your Grav site.  For example, you may want to provide a list of all current projects on a particular project detail page:

{% verbatim %}
```
# All Projects
<ul>
{% for p in page.find('/projects').children if p != page %}
<li><a href="{{p.url}}">{{ p.title }}</a></li>
{% endfor %}
</ul>
```
{% endverbatim %}

In the next section we will continue and dig into the specifics of a page in detail.
