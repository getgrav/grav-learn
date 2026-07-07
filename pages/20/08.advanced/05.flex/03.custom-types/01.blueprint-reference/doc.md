---
title: Blueprint Reference
process:
    twig: false
taxonomy:
    category: docs
---

# Blueprint Reference

A **Flex Type** is defined by a single blueprint YAML file. The file describes the type at the top (`title`, `description`, `type`) and then splits into three sections: `form` (the fields the administrator edits), `config` (how data is stored, how the [Admin Next](/20/admin) UI and REST API behave, and how the frontend renders), and `blueprints` (directory-wide configuration options).

Blueprints live at `user/blueprints/flex-objects/<type>.yaml`, or they can be shipped by a plugin or theme. To activate one, enable it in **Admin Next** under **Plugins > Flex Objects** (the `directories` field), which appends the blueprint path to the plugin config. See [Custom Types](/20/advanced/flex/custom-types) for the full activation walk-through.

The minimal skeleton of a blueprint (here `contacts.yaml`) looks like this:

[codesh=yaml]
title: Contacts
description: Simple contact directory with tags.
type: flex-objects  # do not change

# Flex Configuration
config: {}

# Flex Directory Forms
blueprints: {}

# Flex Object Form
form: {}
[/codesh]

To create your own custom directory you start by naming your `type` (the filename), filling in `title` and `description`, and keeping `type: flex-objects` exactly as shown.

> [!NOTE]
> We assume you already know how to build a form. If not, read **[Forms](/20/forms)** first, then come back here.

## Form

The `form` section is the main blueprint for every object in your directory. It should contain all of the fields defined on the object. Think of it as the form displayed to the administrator when they create or edit an item.

In the contacts example the form looks like this:

[codesh=yaml]
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
[/codesh]

The `validation` mode (`loose` or `strict`) controls how strictly submitted data is checked against the field definitions. The form is written the same way whether it comes from a page, a configuration file, a plugin, or a theme blueprint.

> [!WARNING]
> Do **not** use the simple list format to describe fields (the one covered in [Create a simple single form](/20/forms/forms#create-a-simple-single-form)). Flex needs the full `fields:` map with named keys. Also do **not** add a `process:` section to a Flex form; Flex ignores it, so any processing you expect there will silently never run.

> [!WARNING]
> Be careful when you change a blueprint for a Flex Type that already has saved objects. Make sure the objects you have already stored stay compatible with the new version of the blueprint, meaning you should be able to both save and display the older objects.

There are two more things to do before the directory works: configure the storage layer and define which fields appear in the Admin Next list view. Both live inside the `config` section.

## Config

`config` is the largest part of a Flex blueprint, though most of it exists for customization and can be left at its defaults. It contains three sub-sections: `data`, `admin`, and `site`.

[codesh=yaml]
# Flex Configuration
config:

  # Data settings (storage, classes, ordering, search)
  data: {}

  # Admin Next settings (list, edit, menu, permissions, export)
  admin: {}

  # Frontend settings (template lookup paths)
  site: {}
[/codesh]

The smallest working configuration is just a storage path plus a set of list fields:

[codesh=yaml]
# Flex Configuration
config:

  # Data settings
  data:
    storage: user-data://flex-objects/contacts.json

  # Admin Next settings
  admin:
    list:
      fields:
        last_name:
          link: edit  # link the cell to the edit view
        first_name:
          link: edit
        email:
        website:
[/codesh]

Two things are effectively mandatory: `config.data.storage` (where and how objects are stored) and `config.admin.list.fields` (the columns shown in the Admin Next list). Everything else is optional.

## Config: Data
The `data` section is highly customizable. You can supply your own `object`, `collection`, and `index` PHP classes to add behavior, configure the `storage` layer to fit your needs, and set the default `ordering` and `search` behavior.

[codesh=yaml]
config:
  data:
    # Flex Object class
    object: CLASSNAME
    # Flex Collection class
    collection: CLASSNAME
    # Flex Index class
    index: CLASSNAME
    # Storage options
    storage: {}
    # Ordering options
    ordering: {}
    # Search options
    search: {}
[/codesh]

### Object, collection, and index classes

`object`, `collection`, and `index` take fully-qualified PHP class names. If you omit them, Grav uses the Generic defaults:

[codesh=yaml]
config:
  data:
    object: 'Grav\Common\Flex\Types\Generic\GenericObject'
    collection: 'Grav\Common\Flex\Types\Generic\GenericCollection'
    index: 'Grav\Common\Flex\Types\Generic\GenericIndex'
[/codesh]

Together these three classes define the behavior of your type. To customize behavior beyond what blueprints allow, extend these classes and point the config at your own subclasses. See [PHP Classes](/20/advanced/flex/php-and-events) for how to register and use them.

### Storage
The most important data decision is where and how objects are stored. The long form spells out the storage class, the file formatter, and the target folder or file:

[codesh=yaml]
config:
  data:
    storage:
      class: 'Grav\Framework\Flex\Storage\SimpleStorage'
      options:
        formatter:
          class: 'Grav\Framework\File\Formatter\JsonFormatter'
        folder: user-data://flex-objects/contacts.json
[/codesh]

The example above is the common case, so it can also be written in a short form. A single string is interpreted as a `SimpleStorage` JSON file at that stream path:

[codesh=yaml]
config:
  data:
    storage: user-data://flex-objects/contacts.json
[/codesh]

Grav ships three storage strategies (and you can write your own by extending the base storage class):

[div class="table-keycol"]
| Name | Class | Description |
|------|-------|-------------|
| Simple Storage | `Grav\Framework\Flex\Storage\SimpleStorage` | All objects are stored in a **single file**. Does **not** support per-object media. |
| File Storage | `Grav\Framework\Flex\Storage\FileStorage` | Each object is stored in its **own file** inside a single folder. |
| Folder Storage | `Grav\Framework\Flex\Storage\FolderStorage` | Each object is stored in its **own folder**, which supports per-object media. |
[/div]

> [!IMPORTANT]
> If your objects need images or file uploads, use `FolderStorage`. `SimpleStorage` keeps everything in one file and has no place to put per-object media, so the media endpoints return an error for those directories.

You choose the on-disk format with `options.formatter.class`:

[div class="table-keycol"]
| Name | Class | Description |
|------|-------|-------------|
| JSON | `Grav\Framework\File\Formatter\JsonFormatter` | Use JSON file format. |
| YAML | `Grav\Framework\File\Formatter\YamlFormatter` | Use YAML file format. |
| Markdown | `Grav\Framework\File\Formatter\MarkdownFormatter` | Use Grav's Markdown file format with YAML frontmatter. |
| Serialize | `Grav\Framework\File\Formatter\SerializeFormatter` | Use the PHP serializer. Fast but not human readable. |
| INI | `Grav\Framework\File\Formatter\IniFormatter` | Use INI file format. Not recommended. |
| CSV | `Grav\Framework\File\Formatter\CsvFormatter` | Use CSV file format. Not recommended. |
[/div]

The configuration options (with their defaults) for each formatter are shown in the tabs below:

[codesh-group]
[codesh=yaml title="JSON"]
# JSON
formatter:
  class: 'Grav\Framework\File\Formatter\JsonFormatter'
  options:
    file_extension: '.json'
    encode_options: '' # See https://www.php.net/manual/en/function.json-encode.php (separate options with space)
    decode_assoc: true # Decode objects as arrays
    decode_depth: 512  # Decode up to 512 levels
    decode_options: '' # See https://www.php.net/manual/en/function.json-decode.php (separate options with space)
[/codesh]
[codesh=yaml title="YAML"]
# YAML
formatter:
  class: 'Grav\Framework\File\Formatter\YamlFormatter'
  options:
    file_extension: '.yaml'
    inline: 5           # Save with up to 4 expanded levels
    indent: 2           # Indent with 2 spaces
    native: true        # Use native YAML decoder if available
    compat: true        # If YAML cannot be decoded, use compatibility mode (SLOW)
[/codesh]
[codesh=yaml title="Markdown"]
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
[/codesh]
[codesh=yaml title="Serialize"]
# PHP Serialize
formatter:
  class: 'Grav\Framework\File\Formatter\SerializeFormatter'
  options:
    file_extension: '.ser'
    decode_options:
      allowed_classes: ['stdClass'] # List of allowed / safe classes during unserialize
[/codesh]
[codesh=yaml title="INI"]
# INI
formatter:
  class: 'Grav\Framework\File\Formatter\IniFormatter'
  options:
    file_extension: '.ini'
[/codesh]
[codesh=yaml title="CSV"]
# CSV
formatter:
  class: 'Grav\Framework\File\Formatter\CsvFormatter'
  options:
    file_extension: ['.csv', '.tsv']
    delimiter: ','      # Delimiter to separate the values
    mime: 'text/x-csv'  # MIME type for downloading file
[/codesh]
[/codesh-group]

### Ordering

You can set a default ordering with `key: ASC|DESC` pairs. This ordering is applied when a collection is loaded without an explicit sort:

[codesh=yaml]
config:
  data:
    # Ordering options
    ordering:
      key: ASC
      timestamp: ASC
[/codesh]

### Search
The `search` section defines which fields are looked at when you call `collection.search()`, and it also backs the search parameter of the REST list endpoint.

[codesh=yaml]
config:
  data:
    search:
      # Fields to be searched
      fields:
        - last_name
        - first_name
        - email
      # Search options (weights)
      options:
        contains: 1   # If a field contains the search string, assign weight 1 to the object
[/codesh]

`fields` is the list of fields searched against. `options` maps a matching strategy to a weight. The available strategies are:

[div class="table-keycol"]
| Name | Value | Description |
|------|-------|-------------|
| case_sensitive | `true` or `false` | If true, all checks are case sensitive. Defaults to false. |
| same_as | 0 ... 1 | Value of the field must be identical to the search string. |
| starts_with | 0 ... 1 | Value of the field must start with the search string. |
| ends_with | 0 ... 1 | Value of the field must end with the search string. |
| contains | 0 ... 1 | Value of the field must contain the search string. |
[/div]

Search returns 0 when a field does not match, and a weight between 0 and 1 when it does. The weight is used to order the results, so an object with a higher score is a better match than one with a lower score.

> [!NOTE]
> Search does not currently support different weights or strategies per field; the weights apply to every field in the `fields` list.

## Config: Admin
The `admin` section drives the **Admin Next** UI (the SvelteKit single page application) and the REST API that backs it. The classic Vue admin was removed in flex-objects v1.4.2, so the keys documented here are consumed by the API plugin (chiefly `GET /flex-objects/{type}`) and rendered by Admin Next, not by any server-rendered Twig view.

The main keys are `list`, `edit`, `menu`, `permissions`, `export`, and `template`.

[codesh=yaml]
config:
  admin:
    # List view (columns, paging, nested detail rows)
    list: {}
    # Edit view (title template)
    edit: {}
    # Sidebar menu entry
    menu: {}
    # Permissions (see the dedicated section below)
    permissions: {}
    # Data export
    export: {}
    # Admin template type / folder
    template: default
[/codesh]

### List: fields

`list.fields` defines the columns shown in the Admin Next list. Each entry has a key (the field name) and an optional map of options. When a value is omitted, the raw field value is shown as-is.

In the old classic admin these options existed to work around VueTable's limitations. That rationale is gone. Admin Next reads this same config through `GET /flex-objects/{type}`, which returns the column definitions alongside the paginated rows, and renders its own table.

[codesh=yaml]
config:
  admin:
    list:
      title: name       # Optional label for the list page
      fields:
        published:
          field:
            type: toggle
            label: Publ
          width: 8
        last_name:
          link: edit
        first_name:
          link: edit
        email:
        website:
        tags:
[/codesh]

The per-field options are:

[div class="table-keycol"]
| Name | Value | Example | Description |
|------|-------|---------|-------------|
| width | `integer` | `8` | Column width hint. |
| alias | `string` | `header.published` | Name of the form field to read the value from. Useful for nested values, for example `header.published`. |
| field | `array` | | Inline form-field override, written just like a form field but without a key. Controls how the cell renders (and edits). |
| link | `string` | `edit` | Turns the cell into a link to the edit view. |
| search | `boolean` | `true` | Include this field in the Admin Next list search box. |
| sort | `array` | `field: first_name` | Map to a different backend field name when sorting, in case the query uses a different name than the display field. |
| title_class | `string` | `center` | CSS classes for the column header. **Classic only, ignored in Admin Next.** |
| data_class | `string` | `left` | CSS classes for the data cells. **Classic only, ignored in Admin Next.** |
[/div]

### List: options

`list.options` controls paging and the default sort order for the list:

[codesh=yaml]
config:
  admin:
    list:
      options:
        per_page: 20      # Default number of items per page
        order:
          by: last_name   # Default field used for ordering
          dir: asc        # Default ordering direction (asc | desc)
[/codesh]

### List: detail (nested related rows)

`list.detail` lets a list row expand to show related objects from another Flex directory, for example the orders that belong to a customer. Admin Next resolves the relation, checks the related directory's `list` permission for the current user, and renders the child rows inline.

[codesh=yaml]
config:
  admin:
    list:
      detail:
        enabled: true
        label: Orders
        icon: fa-list
        limit: 10          # Max child rows to show (defaults to the child per_page)
        actions: true      # Allow edit / delete on child rows (needs update / delete permission)
        relation:
          type: orders           # Related Flex type
          local_key: id          # Field on THIS object
          foreign_key: customer  # Field on the related object that points back
          sort:
            created: desc
        fields:
          # Omit for the child type's own list fields, or override per key:
          #   true  -> include the child list field as-is
          #   false -> hide it
          #   map   -> merge overrides on top of the child list field
          number: true
          total: true
[/codesh]

If `relation.type`, `local_key`, or `foreign_key` is missing, or the related directory is not enabled, or the user lacks `list` permission on it, the detail block is quietly skipped and the row simply does not expand. The `actions` toggle only enables edit / delete when the user also holds the corresponding `update` / `delete` permission on the related directory.

### Edit: title template

The `edit` view accepts an `icon` and a `title`. The title can be a Twig template evaluated against the current `object`, so the edit tab shows a meaningful label:

[codesh=yaml]
config:
  admin:
    edit:
      icon: fa-address-card
      title:
        template: '{{ object.last_name ?? ''Last'' }}, {{ object.first_name ?? ''First Name'' }}'
[/codesh]

A list `title` and a menu `title` can use the same `template:` form (for example `{{ 'PLUGIN_CONTACTS.CONTACTS_TITLE'|tu }}`) when you want a translated or computed label instead of a static string.

### Menu

By default an enabled directory is auto-registered in the Admin Next sidebar using its own `title` and `icon`. Add a `menu.list` block to customize the entry, or to reposition it:

[codesh=yaml]
config:
  admin:
    menu:
      list:
        route: '/contacts'   # Route for the sidebar entry
        title: Contacts
        icon: fa-address-card
        # Authorization needed to see the entry
        authorize: ['admin.contacts.list', 'admin.super']
        # Priority -10 .. 10 (higher goes up)
        priority: 2
        # Opt this directory OUT of the generic Flex auto-registration,
        # e.g. when your plugin ships its own sidebar entry.
        hidden_in_admin_next: false
[/codesh]

> [!NOTE]
> Set `hidden_in_admin_next: true` when a plugin registers its own Admin Next sidebar item for the directory and you don't want the generic Flex Objects entry to appear as well. Directories are also skipped from the auto sidebar when the user fails the directory's `list` permission check.

### Export

Every object in a directory can be exported into a single file. Configure the method, formatter, and filename:

[codesh=yaml]
config:
  admin:
    export:
      enabled: true
      method: 'jsonSerialize'
      formatter:
        class: 'Grav\Framework\File\Formatter\YamlFormatter'
      filename: 'contacts'
[/codesh]

This backs the `GET /flex-objects/{type}/export` endpoint (see the [REST API reference](/20/api/endpoints/flex-objects)).

### Classic-only, ignored in Admin Next

Some keys from the Grav 1.7 blueprint format targeted the old server-rendered Vue admin. They are still parsed without error for backwards compatibility, but Admin Next does not read them. Do not rely on them:

[div class="table-keycol"]
| Key | What it did in classic | Status in Admin Next |
|-----|------------------------|----------------------|
| `admin.router` (`path`, `actions`, `redirects`) | Custom admin URLs and redirects for the directory. | Ignored. Admin Next routes are fixed at `/flex-objects/{type}`. |
| `admin.views.preview` | Rendered a frontend page as an in-admin preview. | Ignored. Use the frontend page type or the `[flex-objects]` shortcode instead. |
| `list.fields.*.title_class` / `data_class` | VueTable CSS styling hints for header and data cells. | Ignored. Admin Next renders its own table styling. |
[/div]

## Permissions
> [!IMPORTANT]
> Permissions are the single most common cause of "my directory returns 403" support tickets. Read this whole section before shipping a directory.

A directory declares its permissions under `config.admin.permissions`, keyed by a **prefix**. Each prefix expands into per-action grants (`<prefix>.list`, `<prefix>.create`, `<prefix>.read`, `<prefix>.update`, `<prefix>.delete`) that appear in the user and group editors and are checked by Admin Next and the REST API.

Declare **both** an `admin.<type>` prefix (the legacy Grav 1.7 prefix, for migrated accounts and the classic admin) **and** an `api.<type>` prefix (the Grav 2.0 prefix that Admin Next and the REST API actually grant against). The API layer checks every declared prefix with OR logic, so holding a grant under either prefix authorizes the action.

[codesh=yaml]
config:
  admin:
    permissions:
      # Legacy prefix (Grav 1.7 / classic accounts). Maps 1:1 to api.*
      admin.contacts:
        type: crudpl   # create, read, update, delete, publish, list
        label: Contacts
      # Grav 2.0 prefix (Admin Next + REST API grants)
      api.contacts:
        type: crudpl
        label: Contacts API
[/codesh]

The `type` shorthand expands to a set of actions: `crudl` gives create, read, update, delete, and list; `crudpl` adds publish. The actions Flex checks are `list`, `create`, `read`, `update`, and `delete`.

### Default-deny since flex-objects 1.4.3

> [!WARNING]
> Since flex-objects **1.4.3** (security fix [GHSA-23vq-365v-qcmh](https://github.com/trilbymedia/grav-plugin-flex-objects/security/advisories)), a directory whose blueprint defines **no** `permissions` block is **denied to every non-super-admin over the REST API** (default-deny). If your directory returns 403 for editors but works for you, a missing `permissions` block is almost always the reason. Add the `admin.<type>` + `api.<type>` prefixes shown above and the grants will start working.

### Super admins

Super admins bypass the per-directory checks entirely. There are two super scopes, and either one grants full access:

* **Admin Next** sessions carry `api.super`.
* **Classic** accounts carry `admin.super`.

A migrated classic super admin may hold `admin.super` but not `api.super`, and vice versa, which is why the API accepts either.

### Granting an editor access

To give a non-super editor access to a directory, assign them the specific actions they need under the `api.<type>` prefix. For read-only access:

[codesh=yaml]
access:
  api:
    contacts:
      list: true
      read: true
[/codesh]

Add `create`, `update`, and `delete` as the role requires. The user must also hold `api.access` (the general "this account may use the REST API" grant); without it, every Flex request is rejected before the per-directory check even runs.

> [!NOTE]
> You can also declare secondary permissions (for example an `admin.configuration.contacts` prefix for a directory-wide settings tab). These are not checked automatically; you must reference them yourself from an `authorize` rule on the relevant view.

## Config: Site

The `site` section controls how the frontend looks up Twig templates for this type. The defaults resolve collection and object layouts from `flex/{TYPE}/collection/{LAYOUT}` and `flex/{TYPE}/object/{LAYOUT}`:

[codesh=yaml]
config:
  site:
    templates:
      collection:
        # Lookup for collection (list) layout files
        paths:
          - 'flex/{TYPE}/collection/{LAYOUT}{EXT}'
      object:
        # Lookup for single-object layout files
        paths:
          - 'flex/{TYPE}/object/{LAYOUT}{EXT}'
      defaults:
        # Default {TYPE}; overridden by the blueprint filename if a matching template folder exists
        type: contacts
        # Default {LAYOUT}; can be overridden in render calls (usually from Twig)
        layout: default
[/codesh]

`{TYPE}` defaults to the directory type and `{LAYOUT}` defaults to `default`. Both can be overridden at render time, for example by the `render` tag or the `[flex-objects]` shortcode. See [Frontend](/20/advanced/flex/frontend) for how these templates are used.

## Blueprints

The `blueprints` section defines directory-wide configuration options, editable from the directory's configure tab without hand-editing files. Fields are prefixed with the config path they write to (`object`, `collection`, and so on):

[codesh=yaml]
blueprints:
  # Blueprint for the configure view
  configure:
    # We are inside a TABS field
    fields:
      compatibility:
        type: tab
        title: Compatibility
        fields:
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
[/codesh]

The `object.compat.events` toggle above is a real setting: it controls whether `onAdminSave` / `onAdminAfterSave` fire when objects are written, which older plugins depend on. See [Events](/20/advanced/flex/php-and-events) for the full list of events a plugin author can hook.

The finished file is at `/Users/rhuk/Projects/grav/grav-learn/pages/20/08.advanced/05.flex/03.custom-types/01.blueprint-reference/doc.md`.
