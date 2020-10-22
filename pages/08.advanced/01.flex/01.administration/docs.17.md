---
title: Administration
taxonomy:
    category: docs
---

If you have been using **Admin Panel** in Grav 1.7, you have already used **Flex Objects**. The best examples are **Accounts** and **Pages**, which are great examples what can be done with **Flex**.

By default, **Flex Administration** is invisible to the user. In order to see a **Directory**, it has to be enabled. Enabled directories can show up either on **Navigation Menu**, inside **Flex Objects** menu item or even inside other plugins.

!! **Flex Objects** Plugin has to be enabled in order to use any custom directories.

## Enabling a Directory

![Plugin Configuration](views-directories.png?width=2030&classes=shadow)

To enable a custom **Flex Directory**, you need to go to **Plugins** > **Flex Objects**.

We are interested in **Directories** option inside the plugin, which lists all the detected **Flex Directories**. Just select the directories you're interested in and make sure toggle has `Enabled` option checked.

Hit **Save** and the directory should show up after a page load.

## Directory Listing

![Directories View](views-directories.png?width=2030&classes=shadow)

By default, **Flex Objects** navigation menu item contains all the **Flex Directories** that have been enabled in your site.

!! Some Flex Directories choose to hide from this list and show up elsewhere. **Accounts** and **Pages** are good examples of this.

#### Controls

Along the top of the page, you will find the administrative controls.

- **Back**: Go back to **[Dashboard](/admin-panel/dashboard)**
- **Configure**: Redirects to **Plugins** > **Flex Objects**, see [Enabling a Directory](#enabling-a-directory)

#### Directories

When you select a Directory, you will end up to **Content Listing** view.

In **[Content Listing](/advanced/flex/administration/views-list)** you can browse through the objects, use **Search** and change **Ordering**. Additionally each object has **Actions**, usually at least **Edit** and **Delete**. You can also **Add** new objects by using a button at top of the page. Next to it is also **Configuration** button to change directory-wide settings.

In **[Content Editor](/advanced/flex/administration/views-edit)** you can edit the object and **Save** it.

In **[Configuration](/advanced/flex/administration/configuration)** you can change configuration, which changes the behavior of the whole directory. Usually caching is among these options.
