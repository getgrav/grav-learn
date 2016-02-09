---
title: Example: Page Blueprint
taxonomy:
    category: docs
---

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
