---
title: Working with Modular Pages
taxonomy:
    category: docs
process:
    twig: true
---

Introduction
-----

Working with modular pages for the first time is tricky. Because a **modular page** is really a collection of pages assembled to create a single-page experience for visitors, there are some special circumstances that apply to these pages that don't on others.

Using our **One-Page Skeleton** as an example, we will explain how modular pages work in greater detail.

Folder Structure
-----

The **modular page** itself is assembled from pages that exist in sub-folders found under the page's primary folder. In the case of our **One-Page Skeleton**, this page is located in the `01.home` folder. Within this folder is a single `modular.md` file which tells Grav which subpages to pull to assemble the modular page, and which order to display them in.

These subpages are in folders with names that begin with an underline. By using an underline, you are letting Grav know that these are modular pages, and not stand-alone pages. For example, subpage folders can be named `_features` or `_showcase`.

In the case of our **One-page Skeleton**, we have created the folder structure pictured below.

{{ media['modular-explainer-2.jpg'].html('Listing Page','border') }}

Each subfolder contains a markdown file which acts as a unique page. 

The data within these modular folders (including markdown files, images, etc.) is then pulled and displayed on the modular page. Here is an example of a modular page, highlighting the different modular folder which are used.

{{ media['modular-explainer-1.jpg'].html('Listing Page','border') }}

Setting Up the Primary Page
-----

As you can see, each section pulls content from a different modular folder. Determining which modular folders are used, and in what order, happens in the primary markdown file in the parent folder of the modular page. Here is the content of the `modular.md` file in the `01.home` folder.

```yaml
---
title: One Page Demo Site
menu: Home
onpage_menu: true
body_classes: "modular header-image fullwidth"

content:
    items: @self.modular
    order:
        by: default
        dir: asc
        custom:
            - _showcase
            - _highlights
            - _callout
            - _features
---
```

As you can see, there is no direct content in this file. Everything is handled in the **YAML Front Matter** in the header. The page's **Title**, **Menu** assignment, and other settings you would find in a typical page are found here. The [Content](../../content/headers#ordering-options) area of the header sets up the modular folders and tells Grav which order to render them in.

Modular Pages
-----

{{ media['modular-explainer-3.jpg'].html('Listing Page','border') }}

This markdown file can have its own template, settings, menu assignment, etc. For all intents and purposes, it has the features and personality of a complete page. It just isn't rendered as one on the frontend. We recommend page-wide settings, such as **taxonomy**, be placed on the main markdown file that controls the whole page.

The modular pages themselves are just like regular pages. Here is an example using the `text.md` file in the `_callout` page which appears in the middle of the modular page.

```markdown
---
title: Homepage Callout
menu: Easy Content
image_align: right
---

## Content Unchained

No longer are you a _slave to your CMS_. Grav **empowers** you to create anything from a [simple one-page site](#), a [beautiful blog](#), a powerful and feature-rich [product site](#), or pretty much anything you can dream up!
```

As you can see, the header of the page contains basic information you might find on a regular page. It has its own title and menu assignment, each can be referenced on the frontend. Additionally, template-specific settings, such as the alignment of the image can be set here, just as it would on any other page.

The template file for the `text.md` file is located in `/themes/antimatter/templates/modular` and it is called `text.html.twig`. This file, like any Twig template file for any other page, sets the unique settings as well as any styling differences between it and the base page.

```twig
{% verbatim %}
<div class="modular-row callout">
    {% set image = page.media.images|first %}
    {% if image %}
        {{ image.cropResize(400,400).html('','align-'~page.header.image_align) }}
    {% endif %}
{{ content }}
</div>
{% endverbatim %}
```

Generally, modular pages are very simple. You just have to get used to the idea that each section in your page is sourced from a different page, and displayed all at once to the user. Feel free to experiment and discover just how much you can accomplish with a modular page in Grav.
