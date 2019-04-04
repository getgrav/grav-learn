---
title: 'Example: Plugin Configuration'
taxonomy:
    category: docs
---

We saw in [the previous example](../example-plugin-blueprint) how to define a blueprint for a plugin and/or theme.

Now, let's see how to offer configuration options for a plugin or theme, that will be shown by the Admin Plugin.

If you want your plugin (or theme) to have options directly configurable from the admin interface, you need to fill the blueprints.yaml file with forms.

For example, here is the **Archives** plugin's **archives.yaml** file:

[prism classes="language-yaml line-numbers"]
enabled: true
built_in_css: true
date_display_format: 'F Y'
show_count: true
limit: 12
order:
    by: date
    dir: desc
filter_combinator: and
filters:
    category: blog
[/prism]

Those are the default settings of the plugin. Without the Admin plugin to configure those settings, the user needs to copy this file in the `/user/config/plugins/` folder and them there.

By providing a correctly-formatted **blueprints.yaml** file, you can allow the user to change the settings from the Admin interface. When the settings are saved, they're automatically written to `/user/config/plugins/archives.yaml` (or under config/themes, if it's a theme). The structure starts as follows:

[prism classes="language-yaml line-numbers"]
name: Archives
version: 1.3.0
description: The **Archives** plugin creates links for pages grouped by month/year
icon: university
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-archives
demo: http://demo.getgrav.org/blog-skeleton
keywords: archives, plugin, blog, month, year, date, navigation, history
bugs: https://github.com/getgrav/grav-plugin-archives/issues
license: MIT

form:
  validation: strict
  fields:
[/prism]

Here comes the part that we need. Every field in the **archives.yaml** file needs a corresponding form element, for example:

**Toggle**

[prism classes="language-yaml line-numbers"]
enabled:
  type: toggle
  label: Plugin status
  highlight: 1
  default: 1
  options:
      1: Enabled
      0: Disabled
  validate:
       type: bool
[/prism]

**Select**

[prism classes="language-yaml line-numbers"]
date_display_format:
  type: select
  size: medium
  classes: fancy
  label: Date Format
  default: 'jS M Y'
  options:
    'F jS Y': "January 1st 2014"
    'l jS of F': "Monday 1st of January"
    'D, m M Y': "Mon, 01 Jan 2014"
    'd-m-y': "01-01-14"
    'jS M Y': "10th Feb 2014"
[/prism]

**Text**

[prism classes="language-yaml line-numbers"]
limit:
  type: text
  size: x-small
  label: Count Limit
  validate:
    type: number
    min: 1
[/prism]

The root element (in those examples `enabled`, `date_display_format`, `limit`) is the name of the option. The additional components of each field determines how this field is displayed. For example, its type (`type`), its size (`size`), the label shown (`label`) and an optional helpful tooltip that appears on hover (`help`). `default` and `placeholder` let you create some defaults and improve how the fields renders to the user.

The rest of the fields can change depending on the field type. For example the `select` field type requires and `options` list.

Nested options are reachable via dot notation (e.g. `order.dir`)

[prism classes="language-yaml line-numbers"]
order.dir:
  type: toggle
  label: Order Direction
  highlight: asc
  default: desc
  options:
    asc: Ascending
    desc: Descending
[/prism]

The Admin plugin defines many other field types that can be used, in `plugins/admin/themes/grav/templates/forms/fields`.

It's important to note that when `form.validation` is set to `strict`, like in the **Archives** plugin example, you need to add form blueprints for _all_ the options, otherwise an error will pop up on save.
If you instead want to just allow to customize a couple of fields to the Admin interface, not all of them, set `form.validation` as `loose`.
