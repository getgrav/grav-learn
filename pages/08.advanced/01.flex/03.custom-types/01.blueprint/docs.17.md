---
title: Blueprint
taxonomy:
    category: docs
---

Basic structure of **Flex Blueprint** contains `title`, `description` and `type`, which describe the type and three sections: `config`, `blueprints` and `form`, which describe different aspects from the directory type.

Main structure of `contacts.yaml`:
```yaml
title: Contacts
description: Simple contact directory with tags.
type: flex-objects  # do not change

# Flex Configuration
config: {}

# Flex Directory Forms
blueprints: {}

# Flex Object Form
form: {}
```

To create your own custom Directory, you need to start by naming your `type` (filename) and filling in the `title` and `description`.

After creating the file and filling in the basic information, the next step is to either copy your existing form or to add some fields into the file.

! **TIP:** We assume that you already know how to create your own **[Forms and Blueprints](/forms)**.

!! **WARNING:** It is better not to use the simple list format to describe the fields as described in **[Create a simple single form](/forms/forms#create-a-simple-single-form)**. Also do not pass `process` section of the form to this file, it will not be used by Flex.

## Form

In our contacts example the form section looks like this:

```yaml
# Flex Object Form
form:
  validation: loose

  fields:
    published:
      type: toggle
      label: Published
      highlight: 1
      default: 1
      options:
        1: PLUGIN_ADMIN.YES
        0: PLUGIN_ADMIN.NO
      validate:
        type: bool
        required: true

    last_name:
      type: text
      label: Last Name
      validate:
        required: true

    first_name:
      type: text
      label: First Name
      validate:
        required: true

    email:
      type: email
      label: Email Address
      validate:
        required: true

    website:
      type: url
      label: Website URL

    tags:
      type: selectize
      size: large
      label: Tags
      classes: fancy
      validate:
        type: commalist
```

The form looks the same regardless if it was taken from a page or from a configuration, plugin or theme blueprint file. This is the main blueprint for every object in your directory and it should contain all the fields defined in the object. Think it as a form that is displayed to the administrator.

!! **WARNING:** Be careful when you modify a blueprint for existing Flex Type. Make sure objects you have already saved are compatible with the new version of the blueprint - meaning that you should be able to both save and display the older objects.

We are not quite done yet. There is still two things that needs to be done to make the Directory to work: we need to configure the data storage layer and define the fields to display in the Admin List view. We can do both of those inside `config` section.

## Config

Config section is the most complicated part of Flex Blueprint, though a lot of it is just to allow customization. It contains `data`, `admin` and `site` sections.

```yaml
# Flex Configuration
config:

  # Data Settings
  data: {}

  # Admin Settings
  admin: {}

  # Site Settings
  site: {}
```

The minimum configuration looks something like this:

```yaml
# Flex Configuration
config:

  # Data Settings
  data:
    storage: user-data://flex-objects/contacts.json

  # Admin Settings
  admin:
    # List view
    list:
      # List of fields to display
      fields:
        last_name:
          link: edit # Edit link
        first_name:
          link: edit # Edit link
        email:
        website:
```

There are two mandatory sections in the configuration: `config.data.storage` and `config.admin.list.fields`. The latter defines fields displayed inside admin list view. Data storage on the other hand defines how the data will be stored.

### Config > Data

**Flex Directory** is highly customizable. You can use your own `object`, `collection` and `index` PHP classes to add your own behavior. Additionally, you can configure the `storage` layer to best fit your needs. Directory also has it's default `ordering` and `search` functionality.

```yaml
config:
  data:
    # Flex Object Class
    object: CLASSNAME
    # Flex Collection Class
    collection: CLASSNAME
    # Flex Index Class
    index: CLASSNAME
    # Storage Options
    storage: {}
    # Ordering Options
    ordering: {}
    # Search Options
    search: {}
```

Object, collection and index take class names. If they are not provided, Grav will use the following default configuration:

```yaml
config:
  data:
    object: 'Grav\Common\Flex\Types\Generic\GenericObject'
    collection: 'Grav\Common\Flex\Types\Generic\GenericCollection'
    index: 'Grav\Common\Flex\Types\Generic\GenericIndex'
```

These classes will together define the behavior for your type. If you want to customize your own type, it is possible by extending these classes and passing your own classes here.

One of the most important parts is to define where and how the data is being stored:

```yaml
config:
  data:
    storage:
      class: 'Grav\Framework\Flex\Storage\SimpleStorage'
      options:
        formatter:
          class: 'Grav\Framework\File\Formatter\JsonFormatter'
        folder: user-data://flex-objects/contacts.json
```

Above is a special case which can also be written in a short form:

```yaml
config:
  data:
    storage: user-data://flex-objects/contacts.json
```

Grav 1.7 provides 3 different storage strategies, though you can easily create your own:

[div class="table-keycol"]
| Name | Class | Description |
|------|-------|-------------|
| Simple Storage | Grav\Framework\Flex\Storage\SimpleStorage | All objects are stored into a single file. Does not support media. |
| File Storage | Grav\Framework\Flex\Storage\FileStorage | Objects are stored into separate files in a single folder. |
| Folder Storage | Grav\Framework\Flex\Storage\FolderStorage | Every object is stored into a separate folder. |
[/div]

Additionally you can provide file format with `options.formatter.class`:

[div class="table-keycol"]
| Name | Class | Description |
|------|-------|-------------|
| JSON | Grav\Framework\File\Formatter\JsonFormatter | Use JSON file format. |
| YAML | Grav\Framework\File\Formatter\YamlFormatter | Use YAML file format. |
| Markdown | Grav\Framework\File\Formatter\MarkdownFormatter | Use Grav's Markdown file format with YAML frontmatter. |
| Serialize | Grav\Framework\File\Formatter\SerializeFormatter | Use PHP serializer. Fast but not human readable. |
| INI | Grav\Framework\File\Formatter\IniFormatter | Use INI file format. Not recommended. |
| CSV | Grav\Framework\File\Formatter\CsvFormatter | Use CSV file format. Not recommended. |
[/div]

Configuration options (with defaults) for the default formatters can be found below inside the tabs:

[ui-tabs]
[ui-tab title="JSON"]
```yaml
# JSON
formatter:
  class: 'Grav\Framework\File\Formatter\JsonFormatter'
  options:
    file_extension: '.json'
    encode_options: '' # See https://www.php.net/manual/en/function.json-encode.php (separate options with space)
    decode_assoc: true # Decode objects as arrays
    decode_depth: 512  # Decode up to 512 levels
    decode_options: '' # See https://www.php.net/manual/en/function.json-decode.php (separate options with space)
```
[/ui-tab]
[ui-tab title="YAML"]
```yaml
# YAML
formatter:
  class: 'Grav\Framework\File\Formatter\YamlFormatter'
  options:
    file_extension: '.yaml'
    inline: 5           # Save with up to 4 expanded levels
    indent: 2           # Indent with 2 spaces
    native: true        # Use native YAML decoder if available
    compat: true        # If YAML cannot be decoded, use compatibility mode (SLOW)
```
[/ui-tab]
[ui-tab title="Markdown"]
```yaml
# Markdown
formatter:
  class: 'Grav\Framework\File\Formatter\MarkdownFormatter'
  options:
    file_extension: '.md'
    header: 'header'    # Header variable eg. header.title
    body: 'markdown'    # Body variable
    raw: 'frontmatter'  # RAW YAML variable
    yaml:
      inline: 20        # YAML options, see YAML formatter from above
```
[/ui-tab]
[ui-tab title="Serialize"]
```yaml
# PHP Serialize
formatter:
  class: 'Grav\Framework\File\Formatter\SerializeFormatter'
  options:
    file_extension: '.ser'
    decode_options:
      allowed_classes: ['stdClass'] # List of allowed / safe classes during unserialize
```
[/ui-tab]
[ui-tab title="INI"]
```yaml
# INI
formatter:
  class: 'Grav\Framework\File\Formatter\IniFormatter'
  options:
    file_extension: '.ini'
```
[/ui-tab]
[ui-tab title="CSV"]
```yaml
# CSV
formatter:
  class: 'Grav\Framework\File\Formatter\CsvFormatter'
  options:
    file_extension: ['.csv', '.tsv']
    delimiter: ','      # Delimiter to separate the values
    mime: 'text/x-csv'  # MIME type for downloading file
```
[/ui-tab]
[/ui-tabs]

You can also set default ordering, which is defined by `key: ASC|DESC` pairs:

```yaml
config:
  data:
    # Ordering Options
    ordering:
      key: ASC
      timestamp: ASC
```

Finally, you can add search fields, which are looked at when you call `collection.search()`:

```yaml
config:
  data:
    search:
      # Fields to be searched
      fields:
        - last_name
        - first_name
        - email
      # Search Options
      options:
        - contains: 1   # If field contains the search string, assign weight 1 to the object
```

**Fields** contain a list of fields to be searched against.

Search options can be:

[div class="table-keycol"]
| Name | Value | Description |
|------|-------|-------------|
| case_sensitive | `true` or `false` | If true, all checks are case sensitive, defaults to false |
| same_as | 0 ... 1 | Value of the field must be identical to the search string |
| starts_with | 0 ... 1 | Value of the field must start with the search string |
| ends_with | 0 ... 1 | Value of the field must end with the search string |
| contains | 0 ... 1 | Value of the field must contain the search string |
[/div]

Search function returns 0 if the field does not match and weight between 0 and 1 if there is a match. Weight is used for ordering the search results. Object which gets the highest core has better match than one with a lower score.

!!! Currently, search does not support having different weights or strategies per field.

### Config > Admin

Admin section contains various configuration options to customize directory administration. It contains a few main sections: `router`, `actions`, `permissions`, `menu`, `template` and `views`.

```yaml
config:
  # Admin Settings
  admin:
    # Admin router
    router: {}
    # Allowed admin actions
    actions: {}
    # Permissions
    permissions: {}
    # Admin menu
    menu: {}
    # Admin template type
    template: pages
    # Admin views
    views: {}
```

Optional `router` section can be used to customize the **Flex Directory** admin routes. Routing supports a base path, customizable routes for every action as well as redirects to handle for example backwards compatibility. All the paths are relative to admin base URL.

```yaml
config:
  admin:
    # Admin router
    router:
      path: '/contacts' # Custom path to the directory
      actions:
        configure: # Action name
          path: '/contacts/configure' # New path to the action.
      redirects: # List of redirects (from: to)
        '/flex-objects/contacts': '/contacts'
```

Sometimes you want to restrict the administration to only display the entries or for example to only allow editing the existing ones. For this `actions` is where you can tweak the allowed CRUD operations to fit better your needs.

```yaml
config:
  admin:
    # Allowed admin actions (for all users, including super user)
    actions:
      list: true   # Needs to be true (may change in the future)
      create: true # Set to false to disable creating new objects
      read: true   # Set to false to disable link to edit / details of the objects
      update: false # Set to false to disable saving existing objects
      delete: false # Set to false to disable deleting objects
```

Above example will prevent saving existing objects and deleting them for every user, including Super Admin.

Permissions section allows you to add new permission rules for Grav. These rules will appear in user/group admin. You can create as many permission rules as you wish, but you need to add your own logic or `authorize` rules in this file to use them.

```yaml
config:
  admin:
    # Permissions
    permissions:
      # Primary permissions (used for the objects)
      admin.contacts:
        type: crudl # Create, Read, Update, Delete, List
        label: Contacts Directory
      # Secondary permissions (you need to assign these to a view, otherwise these will not be used)
      admin.configuration.contacts:
        type: default # Simple permission
        label: Contacts Configuration
```

If you do not want to display your directory in `Flex Objects` administration, one option is to display menu item in the main navigation. You can do just that in the `menu` section of the configuration.

```yaml
config:
  admin:
    # Admin Menu
    menu:
      list:
        hidden: false # If true, hide the menu item.
        route: '/contacts' # Alias to `config.admin.router.path` if router path is not set.
        title: Contacts
        icon: fa-address-card-o
        authorize: ['admin.contacts.list', 'admin.super'] # Authorization needed to access the menu item.
        priority: 2 # Priority -10 .. 10 (highest goes up)
```

Above example creates **Contacts** menu item pointing to `/admin/contacts`.

When you're creating your own Flex Directories, you may sometimes want to share the same templates between all of your custom directories. You can do this with `template`:

```yaml
config:
  admin:
    # Admin template type (folder)
    template: contacts
```

**Flex Admin** has multiple views to the objects. By default, following views are supported: `list`, `edit`, `configure` and optionally `preview` & `export`. It is possible to add your own views as well.

```yaml
config:
  admin:
    views:
      # List view
      list: {}
      # Edit view
      edit: {}
      # Configure view
      configure: {}
      # Preview
      preview: {}
      # Data Export
      export: {}
```

#### List View

The first view you will need, is the one which lists all of your objects. By default `list` view uses *VueTable* and *AJAX* to paginate the objects. It needs a list of `fields` to display as well as `options` to define how many items are being shown at once as well as the default field used for ordering.

```yaml
config:
  admin:
    views:
      # List view
      list:
        icon: fa-address-card-o
        title: Site Contacts
        fields: {}        # See below
        options:
          per_page: 20    # Default number of items per page
          order:
            by: last_name # Default field used for ordering
            dir: asc      # Default ordering direction
```

**Icon** and **title** are used to customize the icon and title of the listing page. **Title** supports also using Twig template by using following format:

```yaml
        title:
          template: "{{ 'PLUGIN_CONTACTS.CONTACTS_TITLE'|tu }}"
```

**Fields** contains the fields you want to display in the directory listing. Each field has a key, which is the name of the field. Value can be omitted or it can contain the following configuration options:

[div class="table-keycol"]
| Name | Value | Example | Description |
|------|-------|-------------|
| width | `integer` | 8 | Width of the field in pixels |
| alias | `string` | 'header.published' | Name of the form field to use. VueTable doesn't like dots in the names, so set alias for nested variables. |
| field | `array` |  | Form field override. Written just like any form field, but just without a key. |
| link | `string` | 'edit' | Adds edit link to the text. |
| search | `boolean` | true | Makes the field searchable in admin list. |
| sort | `array` | field: 'first_name' | You can specify different value if you use different field name when querying data on the server side, e.g. first_name. |
| title_class | `string` | 'center' | CSS classes used in titles. |
| data_class | `string` |  'left' | CSS classes used in data columns. |
[/div]

#### Edit View

Edit view has the same basic configuration options as list view:

```yaml
config:
  admin:
    views:
      # Edit view
      edit:
        icon: fa-address-card-o
        title:
          template: '{{ object.last_name ?? ''Last'' }}, {{ object.first_name ?? ''First Name'' }}'
```

#### Configure view

Configure view allows you to add directory wide configuration options, which can then be used in the template files.

```yaml
config:
  admin:
    views:
      # Configure view
      configure:
        hidden: false # Configuration button can be hidden, for example if you have custom tab to replace it, like in Accounts.
        authorize: 'admin.configuration.contacts' # Optional custom authorize rule for this view.
        file: 'config://flex/contacts.yaml' # Optional file where the configuration is saved.

        icon: fa-cog
        title:
          template: "{{ directory.title }} {{ 'PLUGIN_ADMIN.CONFIGURATION'|tu }}"
```

#### Preview view

Flex also supports preview, though right now it works by rendering a page from the frontend, which can be defined in the blueprint file.

```yaml
    # Preview View
    preview:
      enabled: true
      route:
        template: '/contacts' # Twig template to create URL. In this case we use the list view

       icon: fa-address-card-o
        title:
          template: "{{ object.form.getValue('title') ?? object.title ?? key }}"
```

#### Export view

All objects can be exported into a single file, here is an example configuration how to export data into YAML file:

```yaml
    # Data Export
    export:
      enabled: true
      method: 'jsonSerialize'
      formatter:
        class: 'Grav\Framework\File\Formatter\YamlFormatter'
      filename: 'contacts'
```

### Config > Site

```yaml
config:
  # Site Settings
  site:
    templates:
      collection:
        # Lookup for the template layout files for collections of objects
        paths:
          - 'flex/{TYPE}/collection/{LAYOUT}{EXT}'
      object:
        # Lookup for the template layout files for objects
        paths:
          - 'flex/{TYPE}/object/{LAYOUT}{EXT}'
      defaults:
        # Default template variable {TYPE}; overridden by filename of this blueprint if template folder exists
        type: contacts
        # Default template variable {LAYOUT}; can be overridden in render calls (usually Twig in templates)
        layout: default
```

Template settings allow you to customize the template lookup paths and set the default type and layout name in the frontend.

## Blueprints

Blueprints section defines the common configuration options for the whole Directory. The options allow you to customize a common directory to better suit the needs of the site without requiring manual editing of the files.

```yaml
blueprints:
  # Blueprint for configure view.
  configure:
    # We are inside TABS field.
    fields:
      # Add our own tab
      compatibility:
        type: tab
        title: Compatibility
        fields:
          # Fields should be prefixed with object, collection etc..
          object.compat.events:
            type: toggle
            toggleable: true
            label: Admin event compatibility
            help: Enables onAdminSave and onAdminAfterSave events for plugins
            highlight: 1
            default: 1
            options:
              1: PLUGIN_ADMIN.ENABLED
              0: PLUGIN_ADMIN.DISABLED
            validate:
              type: bool
```

! **TIP:** These configuration options can be modified in **[Configuration](/advanced/flex/administration/configuration)** section of the **[Flex Directory Administration](/advanced/flex/administration)**.

!!! **NOTE:** Currently the only used configuration options are inside the cache section. For your custom settings, you need to add logic to use them by yourself.
