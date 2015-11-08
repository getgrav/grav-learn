---
title: Blueprints
taxonomy:
    category: docs
---

**Blueprints** are an important aspect of a plugin and theme. They serve two purposes and we are going to cover them both.

The honest truth is that if you are not a developer, and just use Grav, then you could live without knowing that Blueprints even existed and you should not care much about them.

Blueprints are a container of metadata information regarding a resource. The first set of metadata information is the identity of the resource itself, the second set is about the forms. All this information is stored in a `blueprints.yaml` file and can be found at the root of each plugin and theme.

## Resource Identity

Each plugin and theme identity is defined in the `blueprints.yaml` file. Without properly formatted and compiled Blueprints, a resource won't be added in the Grav repository. Consequently, it won't be available through [Grav downloads](http://getgrav.org/downloads) and [GPM](../grav-gpm).

## Blueprints Example

```
name: Assets
version: 1.0.4
description: "This plugin provides a convenient way to add CSS and JS assets directly from your pages."
icon: list-alt
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-assets
demo: http://learn.getgrav.org
keywords: assets, javascript, css, inline
bugs: https://github.com/getgrav/grav-plugin-assets/issues
license: MIT

dependencies:
  - afterburner2
  - github: https://github.com/getgrav/grav-plugin-github.git
  - email: https://rhuk@bitbucket.org/rockettheme/grav-plugin-email.git

form:
  validation: strict
  fields:
    enabled:
      type: toggle
      label: Plugin status
      highlight: 1
      default: 0
      options:
        1: Enabled
        0: Disabled
      validate:
        type: bool
```

There are different properties that you can use to give your resource an identity. Some are **required**, others are _optional_.

|      property     |                                                                                                                                                                                description                                                                                                                                                                                |
| :---------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| __name*__         | This is the name of the resource. Avoid appending Plugin or Theme, there is no need for that.                                                                                                                                                                                                                                                                              |
| __version*__      | The version of the resource. This value should always change on each release, incrementally. You should follow the [semver](http://semver.org/) standard, too.                                                                                                                                                                                                            |
| __description*__  | The description of your resource. Please don't exceed **200** characters. A description should be short and straight to the point. You can use markdown syntax if needed. It's also a good idea to wrap your description in quotation marks.                                                                                                                              |
| __icon*__         | Icon is what will be used on [getgrav.org](http://getgrav.org). At this stage, we are using [FontAwesome](http://fortawesome.github.io/Font-Awesome/icons/) icons library, so if you are developing a new plugin or theme, it should be your job to ensure the icon you picked is not already used. Otherwise we will have to change it for you.                          |
| _screenshot_      | _(optional)_ Screenshot is only ever evaluated for _Themes_ and completely ignored for _Plugins_. For _Themes_, this would be the filename of the screenshot that comes with the theme (default: `screenshot.jpg`). If you have a _screenshot.jpg_ image at the root of your theme, then you can avoid using this property. Our repository will automatically pick it up. |
| __author.name*__  | The developer full name                                                                                                                                                                                                                                                                                                                                                   |
| _author.email_    | _(optional)_ The developer email.                                                                                                                                                                                                                                                                                                                                                      |
| _author.url_      | _(optional)_ The developer homepage.                                                                                                                                                                                                                                                                                                                                      |
| _homepage_        | _(optional)_ If you have a dedicated homepage for your resource, this would be the place for it.                                                                                                                                                                                                                                                                          |
| _docs_            | _(optional)_ If you have written documentation for your resource, you can link them here.                                                                                                                                                                                                                                                                                 |
| _demo_            | _(optional)_ If you have a demo up and running about your resource, link it here.                                                                                                                                                                                                                                                                                         |
| _guide_           | _(optional)_ If you have tutorials or how-to guides for your resource, link it here.                                                                                                                                                                                                                                                                                      |
| _keywords_        | _(optional)_ Although there is no real use of keywords yet, you can list keywords relative to your resource here, comma separated.                                                                                                                                                                                                                                        |
| _bugs_            | _(optional)_ The URL where bugs can be reported, usually this would be the [GitHub issues](https://guides.github.com/features/issues/) link.                                                                                                                                                                                                                              |
| _license_         | _(optional)_ The type of license your resource is (MIT, GPL, etc). It is adviced that you always provide a `LICENSE` file with your resource.                                                                                                                                                                                                                             |
| _dependencies_    | _(optional)_ A list of dependencies that the plugin/theme requires.  The default process is to use GPM to install them, however, if an optional GIT repository URL is provided, installing direct from the repository will be an option also. |

Here is an example of the identity portion of the [github plugin](http://github.com/getgrav/grav-plugin-github) Blueprints:

```yaml
name: GitHub
version: 1.0.1
description: "This plugin wraps the [GitHub v3 API](https://developer.github.com/v3/) and uses the [php-github-api](https://github.com/KnpLabs/php-github-api/) library to add a nice GitHub touch to your Grav pages."
icon: github
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-github
keywords: github, plugin, api
bugs: https://github.com/getgrav/grav-plugin-github/issues
license: MIT
```


## Forms

The **Forms** metadata defines what aspect of the resource is configurable through the **Admin Plugin**.

If you want your plugin, or theme, to have options directly configurable from the admin interface, you need to fill the blueprints.yaml file with forms.

For example, here's the Archives plugin archives.yaml file:

```yaml
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
```

Those are the default settings of the plugin. Without the Admin plugin, to configure those setting the user needs to copy this file in the `/user/config/plugins/archives.yaml` folder and change them there.

By providing a correctly filled blueprints.yaml file, you can allow the user to change the settings from the Admin interface. When the settings are saved, they're automatically written to `/user/config/plugins/archives.yaml` (or under config/themes, if it's a theme). The structure starts as follows:

```
name: Archives
version: 1.3.0
description: The **Archives** plugin creates links for pages grouped by month/year
icon: university
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-archives
demo: http://demo.getgrav.org/blog-skeleton
keywords: archives, plugin, blog, month, year, date, navigation, history
bugs: https://github.com/getgrav/grav-plugin-archives/issues
license: MIT

form:
  validation: strict
  fields:
```

Here comes the part that we need. Every field in the archives.yaml file needs a corresponding form element, for example:

**Toggle**

```yaml
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
```

**Select**

```yaml
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
```

**Text**

```yaml
limit:
  type: text
  size: x-small
  label: Count Limit
  validate:
    type: number
    min: 1
```

The root element (in those examples `enabled`, `date_display_format`, `limit`) is the name of the option. The rest of each field determines how this field is displayed (`type`), its size (`size`), the label shown (`label`) and an optional help to show on hover (`help`). `default` and `placeholder` let you create some defaults and improve how the fields renders to the user.

The rest of the fields can change depending on the field type. For example the `select` field type requires and `options` list.

Nested options are reachable via dot notation (e.g. `order.dir`)

```yaml
order.dir:
  type: toggle
  label: Order Direction
  highlight: asc
  default: desc
  options:
    asc: Ascending
    desc: Descending
```

The Admin plugin defines many other field types that can be used, in `plugins/admin/themes/grav/templates/forms/fields`.

It's important to note that when `form.validation` is set to `strict`, like in the Archives plugin example, you need to add form blueprints for _all_ the options, otherwise an error will pop up on save.
If you instead want to just allow to customize a couple of fields to the Admin interface, not all of them, set `form.validation` as `loose`.

## Available form fields for use in the admin

Plugins and themes can take advantage of the built-in form fields, or build their own.

Here's a list of the available form fields:

### Common form fields

- **Checkbox**: a simple checkbox
- **Checkboxes**: a serie of checkboxes
- **Date**: a date selection field
- **Datetime**: a date and time selection field
- **Email**: an email field, with validation
- **Hidden**: an hidden field
- **Password**: a password field
- **Radio**: a radio input type
- **Select**: a select field
- **Spacer**: used to add a title, text or an horizontal line to the form
- **Text**: a simple text field
- **Textarea**: a textarea

### Special form fields

- **Array**: a special field used for example in the Page Metadata. Allows the user to add multiple key-value rows.
- **Ignore**: used to remove unused fields when extending from another blueprint
- **Columns**: used to break the form in multiple columns
- **Column**: used to show a single column (used with the `Columns` field)
- **Dateformat**: a special select that renders the current datetime in the passed formats
- **Display**: simply shows a text value, with no input field
- **Frontmatter**: show the page frontmatter in a raw format
- **List**: similar to `Array`, shows a list of items, but without a key
- **Markdown**: show a markdown editor
- **Pages**: shows a list of the site pages
- **Section**: used to divide a setting page into sections; each section comes with a title
- **Selectize**: a hybrid of a textbox and a select box. Mostly useful for tagging and other element picking fields.
- **Tabs**: divides the settings in a list of tabs
- **Tab**: used by the `Tabs` field to render a tab
- **Taxonomy**: a special select preconfigured to select one or more taxonomies
- **Toggle**: a on/off kind of input, with configurable labels

>>> Although this is working already, the Admin Plugin is still a work in progress. Further updates to this document will come as soon as the new admin will be available.
