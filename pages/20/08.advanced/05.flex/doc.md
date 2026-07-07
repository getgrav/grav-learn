---
title: Flex Objects
taxonomy:
    category: docs
algolia-pro:
    process_children: true
---

# Flex Objects

**Flex** is Grav's framework for custom structured data. It gives you a consistent way to store, query, edit, and display collections of records (products, events, team members, an address book, support tickets, anything) that do not fit neatly into a page tree or a config file.

Flex has two halves that work together:

* The core **Flex framework** (`Grav\Framework\Flex`), which ships with Grav itself. It defines the objects, collections, indexes, and storage layers that everything else is built on.
* The **Flex Objects** plugin, which turns that framework into a product you can use without writing PHP. The plugin provides custom directory registration, the **Admin Next** UI for CRUD management, a REST API, the `[flex-objects]` shortcode, and frontend page routing and templates.

> [!NOTE]
> **Flex Directories** in this documentation has nothing to do with the old **Flex Directories** plugin. That plugin was superseded by the Flex framework together with the Flex Objects plugin.

## What problem does Flex solve?

Every Grav site eventually needs data that is neither a page nor a setting. A page is great for editorial content with a URL, a body, and media. A config file is great for a handful of options that rarely change. But a list of five hundred products, or a booking system, or a directory of members, is neither of those. Modeling that data as pages gets unwieldy fast (one folder per record, no real querying, no structured fields), and config files were never meant to hold records at all.

Flex fills that gap. You describe your data once in a **blueprint** (its fields, its form, its storage, its permissions), and Flex gives you the rest: an editable admin section, a queryable collection API in PHP and Twig, a REST API, and frontend rendering. The same object definition powers every access point, so the admin form, the API payload, and the Twig template all agree on what a record looks like.

## When to use Flex

Flex is one of several ways to keep data in Grav. Pick the tool that matches the job.

[div class="table-keycol"]

| Use this          | When                                                                                                                        |
| :---------------- | :-------------------------------------------------------------------------------------------------------------------------- |
| **Pages**         | The record is editorial content that wants its own URL, body copy, and media (a blog post, a landing page, a documentation article). |
| **Config / YAML** | You have a small, mostly static set of options that a site builder edits occasionally (site title, API keys, feature flags). |
| **Accounts**      | You are storing login users. The accounts system is itself a built-in Flex type, so you get user records for free without defining anything. |
| **Flex**          | You have many structured records of the same kind that need querying, an editing UI, an API, or all three, and that are not primarily URL-addressable content. |

[/div]

A useful rule of thumb: if you would reach for a database table on another platform, you probably want a Flex type here.

## Built-in types

You are already using Flex even if you have never defined a type. Under the hood, several core systems are Flex directories:

* **Pages** are backed by a Flex type, which is what lets Admin Next list, search, and edit them consistently.
* **User Accounts** are a Flex type. Every account you manage in admin is a Flex object.
* **User Groups** are a Flex type as well.

Because these are real Flex directories, you can query them from Twig and PHP with the same collection API you use for your own custom types. You do not have to enable anything special to read the built-in Flex versions of accounts or pages.

## Concept glossary

Flex introduces a handful of terms. They map cleanly onto each other, so it is worth reading them once before you start.

#### Flex

**Flex** is the container for all your **Flex Directories**. It is a single access point for every registered directory on the site, which makes all of that data reachable from any page, plugin, or template.

#### Flex Type

A **Flex Type** is the blueprint for a directory. It defines everything needed to store, display, and modify the data: the data structure, the form fields, the permissions, the template files, and the storage layer. A type is described in a blueprint YAML file (see [Creating a Custom Type](/20/advanced/flex/custom-types)).

#### Flex Directory

A **Flex Directory** holds a collection of **Flex Objects** that all share a single **Flex Type**. Each directory manages a **Collection** of **Objects**, with an optional **Index** to speed up queries against its **Storage**.

#### Flex Collection

A **Flex Collection** is a structure that contains **Flex Objects**. In practice a collection usually holds only the objects needed for the current page or action. It provides tools to filter and manipulate the data, plus methods to render the whole set at once.

#### Flex Object

A **Flex Object** is a single instance of a **Flex Type**, representing one record. The object gives access to its properties, including any associated data such as [Media](/20/content/media). It also knows how to render itself and which form to use for editing. Creating, updating, and deleting are all handled by the object.

#### Flex Index

A **Flex Index** makes queries against a directory fast. It holds lightweight metadata about the objects (enough to sort, filter, and paginate) without loading the full objects into memory.

#### Flex Storage

**Flex Storage** is the layer that persists objects. It can be a single shared file, one file per object in a folder, or one folder per object. Flex also supports custom storage back-ends, such as a database. The strategy you choose affects whether a type can carry per-object media (see [How Flex Works](/20/advanced/flex/concepts)).

#### Flex Form

A **Flex Form** integrates with the Form plugin so a Flex Object can be created or edited. Flex supports multiple views, letting different parts of an object be edited by different forms.

#### Flex Administration

**Flex Administration** is provided by the Flex Objects plugin. It adds a section to **Admin Next** where site administrators manage Flex Objects. Every directory ships with CRUD-style permissions, so you can restrict listing, reading, creating, updating, and deleting to particular users. See [Managing Flex in Admin Next](/20/advanced/flex/administration).

## Current limitations

Flex is powerful, but it is not the right tool for every job. Keep these constraints in mind when you plan a type:

* Flex is **index-based**, so it is not ideal for very high-write datasets that are constantly being updated. For a record that changes many times per second, a purpose-built database is a better fit.
* Customizing behavior **beyond what a blueprint can express** (custom queries, computed properties, bespoke storage, non-trivial validation) requires writing PHP classes. See [Extending Flex in PHP](/20/advanced/flex/php-and-events).
* **Multi-language** support is strongest for **Pages**. Custom types can store translated fields, but full parity with Grav's page-level multi-language handling is not there yet.

None of these should stop you from building most data-driven features with Flex. They are simply the edges to be aware of before you commit a design.

## Where to go next

* [Quickstart](/20/advanced/flex/quickstart) - build and enable your first custom type in a few minutes.
* [How Flex Works](/20/advanced/flex/concepts) - the framework model: objects, collections, indexes, and storage strategies.
* [Creating a Custom Type](/20/advanced/flex/custom-types) - the full blueprint reference, from `config` to `form`.
* [Displaying Flex Content](/20/advanced/flex/frontend) - the `[flex-objects]` shortcode, the flex-objects page type, and Twig rendering.
* [Managing Flex in Admin Next](/20/advanced/flex/administration) - list columns, edit forms, exports, menu placement, and permissions.
* [Extending Flex in PHP](/20/advanced/flex/php-and-events) - custom object, collection, and index classes, plus the Flex events.
* [Twig & PHP Reference](/20/advanced/flex/reference) - the API surface for querying and rendering Flex in code.
* [Troubleshooting & FAQ](/20/advanced/flex/troubleshooting) - common errors, permission gotchas, and how to fix them.
* [REST API](/20/api/endpoints/flex-objects) - the Flex Objects HTTP endpoints, auth, and response envelope.
