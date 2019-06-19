---
title: 'Example: Page Blueprints'
taxonomy:
    category: docs
---

**Page Blueprints** extend from the default page, and give you the ability to add options. Basically, custom pages can come to life by using page blueprints. With a page blueprint, you can 100% configure the editing form for a page as it appears in the Admin.

### A first example

If you want to use the default page form, and just add a couple of select boxes for example, you can extend from the default page.

This will use the default page form, and append a text field to the **Advanced** tab, under the **Overrides** section:

[prism classes="language-yaml line-numbers"]
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
[/prism]

This will instead add a new tab, called **Gallery**, with some fields in it.

[prism classes="language-yaml line-numbers"]
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
[/prism]

The fields types you can add are listed in [Available form fields for use in the admin](../fields-available)

### How to name fields

It's important that fields use the `header.*` structure, so field content is saved to the **Page Header** when saved.

### Create a completely custom page form

You can avoid extending from the default form, and create a page form that is completely unique.

For example:

[prism classes="language-yaml line-numbers"]
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

[/prism]

### A note for Expert mode

When editing pages in **Expert** mode, the **Blueprint** is not read, and the page form is the same across all pages. This is because in Expert mode you edit the page fields directly in the **Frontmatter** field, and there is no need to have a customized presentation.

### Where to put the Page Blueprints

In order for the Admin Plugin to pick up the blueprints, and thus show the new Page types, you need to put the blueprints in the correct place.

#### In the User Blueprints folder

Put them in `user/blueprints/pages/`. This is a good place to put them when you simply want your blueprints to be present in your site.

#### In the Theme

Put them in `user/themes/YOURTHEME/blueprints/`. This is best when you also intend to distribute your theme: the theme will provide the page blueprints and it will be easier to use.

#### In the Data folder

If you are using a Gantry5 based theme, the best location is `user/data/gantry5/themes/YOURTHEME/blueprints/`, otherwise your files may be lost during a theme update.

#### In a Plugin

Put them in `user/plugins/YOURPLUGIN/blueprints/`. This is the place where to put them if you define and add custom pages in the plugin.

Then subscribe to the `onGetPageBlueprints` event and add them to Grav. The following example adds the blueprints from the `blueprints/` folder.

[prism classes="language-php line-numbers"]
public static function getSubscribedEvents()
{
  return [
    'onGetPageBlueprints' => ['onGetPageBlueprints', 0]

  ];
}

public function onGetPageBlueprints($event)
{
  $types = $event->types;
  $types->scanBlueprints('plugins://' . $this->name . '/blueprints');
}
[/prism]
