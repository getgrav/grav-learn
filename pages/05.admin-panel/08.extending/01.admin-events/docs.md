---
title: Admin Event Hooks
taxonomy:
    category: docs
process:
    twig: true
---

The Admin plugin has multiple event hooks that can be used during the [Grav Lifecycle](/plugins/grav-lifecycle).  See the general plugin documentation for using event hooks in the [Plugins](/plugins) chapter.

## Available Admin Event Hooks
* [onAdminTaskExecute](../admin-events#onAdminTaskExecute)
* [onAdminCreatePageFrontmatter](../admin-events#onAdminCreatePageFrontmatter)
* [onAdminSave](../admin-events#onAdminSave)
* [onAdminAfterSave](../admin-events#onAdminAfterSave)
* [onAdminAfterSaveAs](../admin-events#onAdminAfterSaveAs)
* [onAdminAfterDelete](../admin-events#onAdminAfterDelete)
* [onAdminAfterAddMedia](../admin-events#onAdminAfterAddMedia)
* [onAdminAfterDelMedia](../admin-events#onAdminAfterDelMedia)


## Enabling an Admin Event Hook
Admin event hooks are called the [same way](/plugins/plugin-tutorial#step-6-determine-if-the-plugin-should-run) that the core event hooks are called.


* * *

<a name="onAdminTaskExecute"></a>
### onAdminTaskExecute

The Admin plugin fires various tasks, depending on user interaction.  Tasks might include logout, login, save, 2faverify, etc.  After the task completes, this event hook fires.

<a name="onAdminCreatePageFrontmatter"></a>
### onAdminCreatePageFrontmatter

While creating a new page, this event is fired after the header data is initially set to allow plugins to programmatically manipulate the frontmatter.

<a name="onAdminSave"></a>
### onAdminSave

Use admin event `onAdminSave()` to manipulate the page object data `$object` before it is saved to the filesystem.

<a name="onAdminAfterSave"></a>
### onAdminAfterSave

After saving the page in the administration panel, this event is fired.

<a name="onAdminAfterSaveAs"></a>
### onAdminAfterSaveAs

When creating a folder via the panel, this event fires immediately after creating the new folder and performing a standard cache clear.

<a name="onAdminAfterDelete"></a>
### onAdminAfterDelete

Fires after a page or folder is deleted.  It is immediately followed by a standard cache clear.

<a name="onAdminAfterAddMedia"></a>
### onAdminAfterAddMedia

Fires after an add media task completes, but before the confirmation message is displayed.

<a name="onAdminAfterDelMedia"></a>
### onAdminAfterDelMedia

Fires after a delete media task completes, but before the confirmation message is displayed.
