---
title: Blueprints
taxonomy:
    category: docs
---

1. [What is a Blueprint?](#what-is-a-blueprint)
1. [Types of Blueprints](#types-of-blueprints)
1. [Components of a Blueprint](#components-of-a-blueprint)

## What is a Blueprint?

Blueprints are an important aspect of Grav. They serve various purposes and we are going to cover all of them in this section.

Blueprints are a container of metadata information regarding a resource.

A Blueprint is defined in a YAML file and can generally host properties as well as form definitions.

## Types of Blueprints

Grav uses Blueprints to:

- define themes and plugins information
- define theme/plugin configuration options to be shown in the Admin
- define the Pages forms in the Admin
- define the options shown in the Configuration Admin section

Let's see in details how this works, for each type of content.

#### Themes and Plugins

When used in themes/plugins, the convention is to put a blueprints.yaml in the package.

The first set of metadata information is the identity of the resource itself, the second set is about the forms. All this information is stored in a blueprints.yaml file and can be found at the root of each plugin and theme.

A blueprints.yaml file is important for a theme and plugin, as it's essential to the GPM (Grav Package Manager) system. GPM uses the information stored in the blueprint to make the plugin available to users.

> TODO: explain more, link to example

#### Pages

Grav Pages can really be anything. A page can be a blog listing, a blog post, a product page, an image gallery..

What determines what a page should do and how it should appear is the Page Blueprint.

Grav provides some basic Page Blueprints: Default and Modular. Those are the two main building blocks of Grav.

Additional page Blueprints are added and setup by the theme, which might decide to add as many page Blueprints as possible, or focus on some particular Page blueprints focused on what it needs to do.

A Grav theme is much more flexible and powerful than what you might be used to on other platforms.

This allows themes to be specific application. For example, a theme might specialize in one of those goals:

- building a documentation site, like the one you’re reading now
- building an e-commerce
- build a blog
- build a portfolio

or a theme can allow its users to build all of them, but usually a fine-tuned theme thought for a single goal can satisfy that goal better than a generic theme.

A page file is used by a page by setting its markdown file name, e.g. `blog.md`, `default.md` or `form.md`.

Each of those files will use a different page file. You can also change the file type by [using the template header property](http://learn.getgrav.org/content/headers#template).

The template used by a page not only determines the "look and feel" in the frontend, but also determines how the Admin Plugin will render it, allowing you to add options, select boxes, custom inputs, toggles.

How do to it? In your theme, add a `blueprints/` folder and add a YAML file with the name of the page template you added. For example if you add a `gallery` page template. add a `blueprints/gallery.yaml` file.

> TODO Link to example

#### Config

> TODO

## Components of a Blueprint

> TODO short intro, then link to reference of available form fields
