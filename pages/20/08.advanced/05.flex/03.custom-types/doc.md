---
title: Creating a Custom Type
taxonomy:
    category: docs
process:
    twig: false
---

# Creating a Custom Type

For many sites, the main reason to reach for Flex Objects is to define your own data type: records that are neither small enough to live in configuration nor page-like enough to be individual pages. A directory of contacts, a list of events, product entries, testimonials, and job listings are all good candidates.

A custom type is defined by a single **blueprint** YAML file. The blueprint describes the edit form, tells Grav where the data is stored, and controls how the type appears in Admin Next. Everything else (the list view, the REST API, the frontend shortcode) is provided for you once the blueprint exists.

This page starts with the smallest blueprint that actually works, gets it running, and then walks through building a slightly more complete type. For the full catalog of every option a blueprint accepts, see the **[Blueprint Reference](/20/advanced/flex/custom-types/blueprint-reference)**.

## The smallest working blueprint

Here is a complete, functioning contacts directory. Save it as `user/blueprints/flex-objects/contacts.yaml`. The filename (`contacts`) becomes the **type name** you will use everywhere else.

[codesh=yaml]
title: Contacts
description: A simple contact directory.
type: flex-objects   # do not change this value

config:
  data:
    # Short storage form: one JSON file holding every object
    storage: user-data://flex-objects/contacts.json
  admin:
    list:
      fields:
        name:
          link: edit
        email:

form:
  validation: loose
  fields:
    name:
      type: text
      label: Name
      validate:
        required: true
    email:
      type: email
      label: Email Address
[/codesh]

That is the whole thing. Two form fields, one storage line, and two columns for the admin list. It is enough for Admin Next to render a working list-and-edit UI and for the REST API to serve the data.

!!! The `type: flex-objects` line is required and must never be changed. It is what tells Grav that this YAML file is a Flex type definition rather than an ordinary form or page blueprint.

### Activate it in Admin Next

Creating the file is not enough on its own. You must enable the blueprint so the plugin knows about it. In Admin Next, go to **Plugins > Flex Objects** and add your blueprint path to the **directories** field. This appends the path to the plugin config, which is what registers the type. After saving, clear the cache so the new type is picked up:

[codesh=bash]
bin/grav clear
[/codesh]

Reload Admin Next and you will find **Contacts** in the Flex Objects area, ready to add and edit records.

!!! If your type does not appear after saving, it is almost always because the blueprint was not enabled in the directories field, or the cache was not cleared. Both steps are required.

### Where the pieces map

The minimal blueprint already uses the three most important parts of the format:

[div class="table-keycol"]
| Section | Purpose |
|---------|---------|
| `config.data.storage` | Where and how the objects are stored on disk. |
| `config.admin.list.fields` | Which columns show in the Admin Next list view. |
| `form.fields` | The edit form (and therefore the fields each object can hold). |
[/div]

These are the two mandatory config keys (`config.data.storage` and `config.admin.list.fields`) plus the form itself. Get those right and you have a working type.

## Building a small real type

Let us take the contacts example a little further into something you might actually ship: more fields, a sensible default order, and a searchable list. This is still a compact blueprint, just fleshed out.

[codesh=yaml]
title: Contacts
description: Simple contact directory with tags.
type: flex-objects   # do not change this value

config:
  data:
    storage: user-data://flex-objects/contacts.json
    ordering:
      last_name: ASC
    search:
      fields:
        - last_name
        - first_name
        - email
  admin:
    list:
      fields:
        last_name:
          link: edit
        first_name:
          link: edit
        email:
        website:
      options:
        per_page: 20
        order:
          by: last_name
          dir: asc
    menu:
      list:
        title: Contacts
        icon: address-card
        priority: 2

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
      validate:
        type: commalist
[/codesh]

Enable and clear the cache exactly as before. You now have a directory that orders records by last name, lets an administrator search across three fields, and shows a tidy four-column list. The `admin.menu.list` block gives it a dedicated sidebar entry with an icon and priority.

Everything here is optional refinement on top of the minimal version. Add only what you need, when you need it.

!!! The form looks the same whether it came from a page, a configuration file, or a plugin blueprint. Treat `form.fields` as the form an administrator sees, and make sure it contains every field an object can hold. If you already know how to build **[Forms](/20/forms)**, you already know how to write this section.

## Blueprint anatomy

Every Flex blueprint has the same top-level structure. Three keys describe the type, and three sections describe how it behaves:

[codesh=yaml]
title: Contacts               # Human-readable name
description: A directory...    # Short description
type: flex-objects            # Always flex-objects, never change

config: {}       # Storage, admin UI, permissions, frontend templates
blueprints: {}   # Directory-wide configure form (optional)
form: {}         # The per-object edit form and its fields
[/codesh]

[div class="table-keycol"]
| Key | What it does |
|-----|--------------|
| `title` | The name of the type as it appears in Admin Next. |
| `description` | A short summary of the directory. |
| `type` | Always `flex-objects`. This marks the file as a Flex type. |
| `config` | Storage strategy, the Admin Next list/edit/menu/permissions, export, and frontend template lookup. |
| `blueprints` | An optional form for directory-wide configuration (the Configure view). |
| `form` | The edit form for a single object, including all of its fields. |
[/div]

The `config` section is the largest and most flexible part. It covers storage strategies (SimpleStorage, FileStorage, FolderStorage), custom object and collection classes, list columns, ordering, search, the sidebar menu, permissions, and export. Rather than repeat all of it here, see the **[Blueprint Reference](/20/advanced/flex/custom-types/blueprint-reference)** for the exhaustive list of options with examples.

!!! Permissions deserve special attention. Since flex-objects 1.4.3, a directory whose blueprint declares no permissions block is denied to every non-super-admin over the REST API. If editors need access to your type, you must declare a `config.admin.permissions` block. The **[Blueprint Reference](/20/advanced/flex/custom-types/blueprint-reference)** covers exactly how to write one.

## Two classic gotchas

Two mistakes catch nearly everyone writing their first Flex blueprint. Both come from treating a Flex blueprint like an ordinary Grav form.

**Do not use the simple list field format.** Grav forms let you describe fields as a plain list (the format shown in **[Create a simple single form](/20/forms/forms)**). Flex does not support that shorthand. Always write `form.fields` as a keyed map, where each field's key is its name and its value is the field configuration, exactly as in the examples above.

**Do not include a `process` section in the form.** A regular Grav form uses a `process` block to define what happens on submit (send an email, save to a file, and so on). Flex ignores that section entirely, because saving is handled by the storage layer. Adding one does nothing and only causes confusion, so leave it out.

!!! Be careful when you change the blueprint of a type that already has saved records. Make sure existing objects still load and save cleanly under the new blueprint. Renaming or removing a field can leave older records unable to display.

## Where to go next

- **[Blueprint Reference](/20/advanced/flex/custom-types/blueprint-reference)** covers every `config`, `blueprints`, and `form` option in detail, including storage strategies, formatters, permissions, list-field options, and export.
- The **[REST API endpoints](/20/api/endpoints/flex-objects)** document how to read and write your type over HTTP.
- The **[flex-objects shortcode](/20/advanced/flex)** and the frontend page type let you display a directory on your site.
