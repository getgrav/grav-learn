---
title: Modular Pages
taxonomy:
    category: docs
process:
    twig: true
---

The concept of **Modular Pages** is a little tricky to get your head around at first, but when you do you'll see how convenient they are to use. A **Modular Page** is a collection of pages stacked on top of each other to create a unified, single page. This lets you create a complex page-structure by using the **LEGO building-brick**-approach, and who doesn't love LEGO?!

## What are Modular Pages and what are they not?

In Grav, [Pages](/content/content-pages) are a broad concept that captures almost any type of combination of elements that you can imagine going into a website. Importantly, Modular Pages are a subset of this concept but not the same as a regular Page. A regular Page is fairly standalone, in the sense that Grav will render and display it without depending on other content such as other pages or child-pages. A Modular page, however, does not have child-pages. This is illustrated by imagining a simple page-structure:

A regular Page found at _domain.com/books_ has some details about what books are for sale. Several child-pages exist for this Page, such as _domain.com/books/gullivers-travels_ and _domain.com/books/the-hobbit_. Their folders are named the same as the address that Grav renders: `/pages/books`, `/pages/books/gullivers-travels`, and `/pages/books/the-hobbit`. This structure would not work in a Modular Page.

A Modular Page does not have child-pages in the same sense, rather, it has **Modules** that make up the parts of the page. So, rather than various books located beneath the top-level page, the modular page displays its modules on **the same page**. Gulliver's Travels and The Hobbit both appear in _domain.com/books_, with the paths `/pages/books/_gullivers-travels` and `/pages/books/_the-hobbit`. Thus, Modular Pages are not directly compatible with regular Pages and have their own structure.

## Example Folder Structure

Using our **One-Page Skeleton** as an example, we will explain how Modular Pages work in greater detail.

The **Modular Page** itself is assembled from pages that exist in subfolders found under the page's primary folder. In the case of our One-Page Skeleton, this page is located in the `01.home` folder. Within this folder is a single `modular.md` file which tells Grav which subpages to pull in to assemble the Modular Page, and which order to display them in. The name of this file is important because it instructs Grav to use the `modular.html.twig`-template from the current theme to render the page.

These subpages are in folders with names that begin with an underscore (`_`). By using an underscore, you are telling Grav that these are **Modules**, not standalone pages. For example, subpage-folders can be named `_features` or `_showcase`. These pages are **not routable** - they cannot be pointed to directly in a browser, and they are **not visible** - they do not show up in a menu.

In the case of our One-Page Skeleton, we have created the folder structure pictured below.

![Listing Page](modular-explainer-2.jpg?classes=shadow)

Each subfolder contains a Markdown-file which acts as a page.

The data within these Module-folders - including Markdown-files, images, etc. - is then pulled and displayed on the Modular page. This is accomplished by creating a primary page, defining a [Page Collection](/content/collections) in the primary page's YAML FrontMatter, then iterating over this Collection in a Twig-template to generate the combined HTML page. A theme should already have a `modular.html.twig` template that will do this and is used when you create a Modular Page type. Here's a simple example from a `modular.html.twig`:

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% for module in page.collection() %}
    {{ module.content }}
{% endfor %}
[/prism]
{% endverbatim %}

Here is an example of the resulting modular page, highlighting the different modular folders which are used.

![Listing Page](modular-explainer-1.jpg?classes=shadow)

## Setting Up the Primary Page

As you can see, each section pulls content from a different Module-folder. Determining which Module-folders are used, and in what order, happens in the primary Markdown-file in the parent folder of the Module. Here is the content of the `modular.md` file in the `01.home` folder.

[prism classes="language-yaml line-numbers"]
---
title: One Page Demo Site
menu: Home
onpage_menu: true
body_classes: "modular header-image fullwidth"

content:
    items: '@self.modular'
    order:
        by: default
        dir: asc
        custom:
            - _showcase
            - _highlights
            - _callout
            - _features
---
[/prism]

As you can see, there is no actual content in this file. Everything is handled in the YAML FrontMatter in the header. The page's **Title**, **Menu** assignment, and other settings you would find in a typical page are found here. The [Content](/content/headers#ordering-options) instructs Grav to create the content based on a Collection of modular pages, and even provides a custom manual order for them to render.

## Modules

![Listing Page](modular-explainer-3.jpg?classes=shadow)

The Markdown-file for each Module can have its own template, settings, etc. For all intents and purposes, it has most of the features and settings of a regular page, it just isn't rendered as one. We recommend page-wide settings, such as **taxonomy**, be placed in the main Markdown-file that controls the whole page.

The Modular Pages themselves are handled just like regular Pages. Here is an example using the `text.md` file in the `_callout` page which appears in the middle of the Modular page.

[prism classes="language-markdown line-numbers"]
---
title: Homepage Callout
image_align: right
---

## Content Unchained

No longer are you a _slave to your CMS_. Grav **empowers** you to create anything from a [simple one-page site](#), a [beautiful blog](#), a powerful and feature-rich [product site](#), or pretty much anything you can dream up!
[/prism]

As you can see, the header of the page contains basic information you might find on a regular page. It has its own title that can be referenced, and [custom page options](/content/headers#custom-page-headers), such as the alignment of the image can be set here, just as it would on any other page.

The template file for the `text.md` file should be located in the `/templates/modular`-folder of your theme, and should be named `text.html.twig`. This file, like any Twig-template file for any other page, defines the settings, as well as any styling-differences between it and the base page.

{% verbatim %}
[prism classes="language-twig line-numbers"]
<div class="modular-row callout">
    {% set image = page.media.images|first %}
    {% if image %}
        {{ image.cropResize(400,400).html('','','align-'~page.header.image_align) }}
    {% endif %}
{{ content }}
</div>
[/prism]
{% endverbatim %}

Generally, Modular Pages are very simple. You just have to get used to the idea that each section in your page is defined in a Module that has its own folder below the actual page. They are displayed all at once to your visitors, but organized slightly differently than regular pages. Feel free to experiment and discover just how much you can accomplish with a Modular Page in Grav.
