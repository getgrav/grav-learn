---
title: Custom Page Templates
taxonomy:
    category: docs
---

Grav Pages can really be anything. A page can be a blog listing, a blog post, a product page, an image gallery..

What determines what a page should do and how it should appear is the Page Template.

Page Templates are added and setup by the theme used.

## A theme responsibility

A Grav theme is much more flexible and powerful than what you might be used to on other platforms.

This allows themes to be specific application. For example, a theme might specialize in one of those goals:

- building a documentation site, like the one you’re reading now
- building an e-commerce
- build a blog
- build a portfolio

or a theme can allow its users to build all of them, but usually a fine-tuned theme thought for a single goal can satisfy that goal better than a generic theme.

## Using Custom Page Template

A page file is used by a page by setting its markdown file name, e.g. `blog.md`, `default.md` or `form.md`.

Each of those files will use a different page file. You can also change the file type by [using the template header property](http://learn.getgrav.org/content/headers#template).

## Page Templates and the Admin Plugin

The template used by a page not only determines the "look and feel" in the frontend, but also determines how the Admin Plugin will render it, allowing you to add options, select boxes, custom inputs, toggles.

How do to it? In your theme, add a `blueprints/` folder and add a YAML file with the name of the page template you added. For example if you add a `gallery` page template. add a `blueprints/gallery.yaml` file.


### Extend from the default page, and add some options

With a page blueprint you can 100% configure the page editing form.
If you want to use the default page form, and just add a couple of select boxes for example, you can extend from the default page.

This will use the default page form, and append a text field to the "Advanced" tab:

```yaml
title: Gallery
'@extends':
    type: default
    context: blueprints://pages

form:
  fields:
    tabs:
      type: tabs
      active: 1

      fields:
        advanced:
          fields:
            overrides:
              fields:
                header.an_example_text_field:
                  type: text
                  label: Add a number
                  default: 5
                  validate:
                    required: true
                    type: int
```

This will instead add a new tab, called 'Gallery', with some fields in it.

```yaml
title: Gallery
'@extends':
    type: default
    context: blueprints://pages

form:
  fields:
    tabs:
      type: tabs
      active: 1

      fields:
        gallery:
          type: tab
          title: Gallery

          fields:
            header.an_example_text_field:
              type: text
              label: Add a number
              default: 5
              validate:
                required: true
                type: int

            header.an_example_select_box:
              type: select
              label: Select one of the following
              default: one
              options:
                one: One
                two: Two
                three: Three
```

The fields types you can add are listed in [Available form fields for use in the admin](http://learn.getgrav.org/advanced/blueprints#available-form-fields-for-use-in-the-admin)

### Create a completely custom page form

You can avoid extending from the default form, and add just the fields you want.

For example:

```yaml
title: Gallery

form:
  fields:
    tabs:
      type: tabs
      active: 1

      fields:
        gallery:
          type: tab
          title: Gallery

          fields:
            header.an_example_text_field:
              type: text
              label: Add a number
              default: 5
              validate:
                required: true
                type: int

            header.an_example_select_box:
              type: select
              label: Select one of the following
              default: one
              options:
                one: One
                two: Two
                three: Three

            route:
              type: select
              label: PLUGIN_ADMIN.PARENT
              classes: fancy
              '@data-options': '\Grav\Common\Page\Pages::parents'
              '@data-default': '\Grav\Plugin\admin::route'
              options:
                '/': PLUGIN_ADMIN.DEFAULT_OPTION_ROOT

```

## Expert mode

When editing pages in Expert mode, the Blueprint is not read, and the page form is the same across all pages. This is because in Expert mode you edit the page fields directly in the "Frontmatter" field, and there's no need to have a customized presentation.
