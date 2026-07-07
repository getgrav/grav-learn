---
title: How Flex Works
taxonomy:
    category: docs
process:
    twig: false
---

# How Flex Works

Before you build your first Flex Type, it helps to have a clear mental model of the pieces involved and how they fit together. Flex is made of a handful of small concepts that each do one job. Once you can name them, the blueprints, the Admin Next screens, and the REST API all start to make sense.

This page walks through each part, explains how a request turns into loaded objects, and shows the three ways a Flex Type gets registered with Grav.

## The parts

Flex is two things working together: a **core framework** (`Grav\Framework\Flex`) that lives in Grav itself, and the **Flex Objects plugin** that builds features on top of it (directory registration, the Admin Next UI, the REST API, the `[flex-objects]` shortcode, and frontend page routing and templates). The framework gives you the objects and storage; the plugin gives you the tools to manage them.

Here are the concepts you will meet, from the container on down to a single record.

#### Flex

**Flex** is the container and registry for every **Directory** in your site.

It is a single access point for all your data. Once a Directory is registered, every page, plugin, and theme can reach its objects through Flex. Grav ships with its own built-in Directories (such as **User Accounts** and **Pages**), and plugins and themes can register their own.

!!! Even if the Flex versions of *User Accounts* or *Pages* are not enabled for editing, you can still read Flex versions of them from both the frontend and Admin Next.

#### Flex Type

A **Flex Type** is the blueprint for a Directory.

It defines everything needed to store, display, and edit your data: the data structure, the form fields, the permissions, the storage layer, and the template files. A Type is described by a single blueprint YAML file. You will meet its sections (`title`, `description`, `type`, `config`, `blueprints`, `form`) in the next pages.

#### Flex Directory

A **Directory** holds all the **Objects** of one **Type**.

If a Type is the mold, the Directory is the drawer that keeps every object made from that mold. Each Directory owns a **Collection** of **Objects**, backed by an **Index** for fast queries and a **Storage** layer for reading and writing files.

#### Flex Object

A **Flex Object** is a single record, one instance of a Type.

The object gives you access to its properties and any associated data, including **[Media](/20/content/media)** when the storage supports it. An object knows how to render itself, which **Form** to use when editing, and how to save or delete itself. If you do not define your own class, objects use the default `Grav\Common\Flex\Types\Generic\GenericObject`.

#### Flex Collection

A **Collection** is a queryable set of Objects.

A Collection usually holds only the objects needed for the current page or action, not the entire Directory. It gives you tools to filter, sort, search, paginate, and manipulate the set, plus methods to render the whole group at once. The default class is `GenericCollection`.

#### Flex Index

An **Index** is a lightweight, fast lookup for a Directory.

It holds metadata about the objects (keys, timestamps, checksums) but **not** the full object data. Grav uses the Index to answer list and query operations quickly, then loads full objects from Storage only when they are actually needed. The default class is `GenericIndex`.

!!! Because the Index is central to how Flex stays fast, Flex is not the right tool for datasets that are constantly written to or updated. Every write updates the index. For high-write workloads, a real database is a better fit.

#### Flex Storage

**Storage** is the layer that reads and writes object data to disk.

Flex ships with three strategies, chosen with `config.data.storage`:

[div class="table-keycol"]

| Strategy | What it does | Media |
| :--- | :--- | :--- |
| `SimpleStorage` | Keeps **every** object in one single file. | No per-object media |
| `FileStorage` | One file per object, all inside one folder. | No per-object media |
| `FolderStorage` | One folder per object. | Supports media |

[/div]

Storage can also be written as a short single-string form (a `user-data://` stream path to a `.json` file) when you just want a simple location. Data is read and written through a **formatter** (`Json`, `Yaml`, `Markdown`, `Serialize`, `Ini`, or `Csv`). You will configure storage in detail on the [Blueprint](/20/advanced/flex/custom-types/blueprint-reference) page.

#### Flex Form

A **Form** creates and edits an Object.

Flex integrates with the Form plugin, so the same field types you use elsewhere in Grav work here. A Type can define multiple views, letting different forms edit different parts of an object. Admin Next uses these forms for its create and edit screens.

## How the parts relate

[codesh]
        ┌───────────────────────────────────────────────┐
        │                     Flex                       │
        │            (container / registry)              │
        │                                                │
        │   ┌───────────────┐      ┌───────────────┐     │
        │   │   Directory   │      │   Directory   │  …  │
        │   │  (one Type)   │      │  (one Type)   │     │
        │   └───────┬───────┘      └───────────────┘     │
        └───────────┼───────────────────────────────────┘
                    │
        ┌───────────┴───────────────────────────────┐
        │                                            │
   ┌────┴─────┐   ┌───────────┐   ┌─────────┐   ┌────┴─────┐
   │  Index   │   │Collection │   │  Form   │   │ Storage  │
   │(metadata)│   │(a queried │   │(create/ │   │(files on │
   │          │   │  set)     │   │  edit)  │   │  disk)   │
   └────┬─────┘   └─────┬─────┘   └─────────┘   └────┬─────┘
        │               │                            │
        │          ┌────┴─────┐                      │
        └─────────▶│  Object  │◀─────────────────────┘
                   │ (one     │
                   │  record) │
                   └──────────┘
[/codesh]

Read it top down: **Flex** holds many **Directories**. Each Directory is one **Type** and manages an **Index**, hands out **Collections**, edits through a **Form**, and persists through **Storage**. Both the Index and Storage ultimately resolve to individual **Objects**.

## The object lifecycle

You rarely deal with this machinery directly, but knowing the order of events explains why Flex behaves the way it does.

1. **Request.** A page, plugin, shortcode, or REST call asks a Directory for objects: a full list, a filtered Collection, or one object by key.
2. **Index first.** Flex answers from the Index. Listing, searching, sorting, and pagination all run against this lightweight metadata, so a list of a thousand records never loads a thousand files.
3. **Load from storage on demand.** When you actually read an object's data (or render it), Flex loads that object from Storage through its formatter and hydrates it into an Object instance.
4. **Cache.** Loaded objects and index data are cached, so repeated access within a request (and across requests, subject to your cache settings) does not re-read the disk. Saving or deleting an object updates the Index and invalidates the relevant cache entries.

The takeaway: cheap operations (counting, listing, filtering) stay on the Index, and the expensive operation (reading full object data) happens only when you need it.

## Where things live, and how a Type gets registered

A Flex Type has to be registered with the Flex container before Grav knows it exists. There are three ways that happens.

### 1. A blueprint you enable (the common case)

Drop a blueprint at:

[codesh=bash]
user/blueprints/flex-objects/<type>.yaml
[/codesh]

Then activate it in **Admin Next** under **Plugins > Flex Objects**, in the **directories** field. Adding it there appends the blueprint path to the plugin's config, and the Flex Objects plugin registers the Directory for you on the next request. This is how most site-specific data types (a contact list, a product catalog, an events table) come to life. No PHP required.

!!! The `<type>` in the filename becomes the Directory's key and shows up in the REST API path (`/flex-objects/<type>`) and in Twig template lookups (`flex/<type>/...`). Keep it lowercase and stable.

### 2. A plugin or theme that ships a blueprint

A plugin or theme can bundle its own blueprint and register the Directory from PHP by listening for the **`FlexRegisterEvent`**. When Flex boots, it fires this event so extensions can add their Types to the container programmatically. This is the right approach when you are distributing a Type as part of a plugin or theme, because the user does not have to enable anything manually. The blueprint travels with the extension rather than living under `user/blueprints`.

### 3. Built-in core types

Grav registers some Types itself. **User Accounts** and **Pages** are the built-in Flex Directories, available even when their editable Flex versions are not turned on. You do not register these; they are part of the framework.

!!! Registering a Type is not the same as granting access to it. Since Flex Objects 1.4.3 (security fix GHSA-23vq-365v-qcmh), a Directory whose blueprint declares no permissions block is denied to every non-super-admin over the REST API. See the [Permissions](/20/advanced/flex/custom-types/blueprint-reference#permissions) page before you expose a Type to editors.

## Where to next

- **[Defining a Flex Type](/20/advanced/flex/custom-types/blueprint-reference)** walks through the blueprint file section by section.
- **[Permissions](/20/advanced/flex/custom-types/blueprint-reference#permissions)** explains the `admin.<type>` and `api.<type>` prefixes and the default-deny rule.
- **[The REST API](/20/api/endpoints/flex-objects)** documents every endpoint.
- **[Displaying Flex on the frontend](/20/advanced/flex/frontend)** covers the shortcode, the page type, and Twig templates.
