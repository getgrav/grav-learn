---
title: Flex Objects
taxonomy:
    category: docs
algolia-pro:
    process_children: true
---

**Flex Objects** is a new concept in Grav 1.7, which adds support for custom data types which can be easily integrated to your site. Support for custom types and administration capabilities are provided by [**Flex Objects** Plugin](https://github.com/trilbymedia/grav-plugin-flex-objects), which is required by [Admin Panel](/admin-panel). This plugin also handles object creation in the frontend in case if you need users to be able to submit new objects or make changes to them.

Grav core features such as [User Accounts](/admin-panel/accounts/users), [User Groups](/admin-panel/accounts/groups) and [Pages](/admin-panel/page) have already been converted to Flex Objects, though they are only being used in **Admin Panel**.

!! **Flex Directories** in this documentation has nothing to do with the older **Flex Directories Plugin**. In fact the old plugin has been superseded with this feature together with **Flex Objects Plugin**.

## Introduction

**Flex** is a set of **Directories** of a single **Type**. Grav has its own built-in types, such as *User Accounts* and *Pages*. Plugins and themes can also define their own types and register those to Grav. With **Flex Objects Plugin** you are also able to create your own custom types and directories.


#### Flex

**[Flex](/advanced/flex/using/flex)** is a container for **Flex Directories**.

This gives a single access point for all the data in the site, given that the data is inside a Flex Directory. This makes all the objects available to every page and plugin in your site.

! **TIP:** Even if Flex *User Accounts* or *Pages* are not enabled, you can still access Flex versions of them in both frontend and Admin Panel.

#### Flex Type

**Flex Type** is the blueprint for your **Flex Directory**.

It defines everything that is needed to display and modify the content: data structure, form fields, permissions, template files, even storage layer.

#### Flex Directory

**[Flex Directory](/advanced/flex/using/directory)** keeps a collection of **Flex Objects** of a single **Flex Type**.

Each Directory contains **Collection** of **Objects** with optional support for **Indexes** to speed up the queries to the **Storage**.

#### Flex Collection

**[Flex Collection](/advanced/flex/using/collection)** is a structure that contains **Flex Objects**.

The collection usually contains only the objects which are needed to display the page or to perform the given action. It provides useful tools to further filter or manipulate the data as well as methods to render the whole collection.

#### Flex Object

**[Flex Object](/advanced/flex/using/object)** is a single instance of some **Flex Type**.

The object represents a single entity. The object gives access to its properties, including any associated data, such as **[Media](/content/media)**. Object also knows how to **Render** itself or which **Form** to use to edit its contents. Actions like creating, updating and deleting objects are supported by the object itself.

#### Flex Index

**Flex Index** is used to make fast queries to **Flex Directory**.

It contains meta-data for the **Flex Objects**, but not the objects themselves.

#### Flex Storage

**Flex Storage** is a storage layer for the **Flex Objects**.

It can be a single file, set of files in a single folder or set of folders. Flex also supports custom storages, such as database storages.

#### Flex Form

**Flex Form** integrates to **Form Plugin** and allows **Flex Object** to be created or edited.

Flex supports multiple views, which allow different parts of the object to be modified.

#### Flex Administration ####

**[Flex Administration](/advanced/flex/administration)** is implemented by **Flex Objects Plugin**.

It adds a new section to **Admin Plugin** allowing site administrators to manage **Flex Objects**. Each **Flex Directory** comes with CRUD-type ACL, which can be used to restrict parts of Admin and actions within them to certain users.

## Current Limitations

There is still a lot of work to do. Here are the current limitations when considering use of Flex Objects:

* Multi-language support has only been implemented for **Pages**, also admin cannot be fully translated yet
* Frontend only has a basic routing; for your custom tasks, such as saving, you need your own implementation
* Bulk update features have not yet been implemented in Admin (in code, they are easy)
* Due to indexing limitations, it is not recommended to use Flex for objects that are constantly being updated
* Customizing your **Flex Type** requires a good coding knowledge and creating your own classes
