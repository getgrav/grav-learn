---
title: Administration
taxonomy:
    category: docs
---

If you have been using **Admin Panel** in Grav 1.7, you have already used **Flex Objects**. The best examples are **Accounts** and **Pages**, which are great examples what can be done with **Flex**.

By default, **Flex Administration** is invisible to the user. In order to see a **Directory**, it has to be enabled. Enabled directories can show up either on **Navigation Menu**, inside a **Flex Objects** menu item, or even inside other plugins.

!! **Flex Objects** Plugin has to be enabled in order to use any custom directories.

## Enabling a Directory

To enable a custom **Flex Directory**, you need to go to **Plugins** > **Flex Objects**.

We are interested in the **Directories** option inside the plugin, which lists all the detected **Flex Directories**. Just select the directories you're interested in and make sure the toggle is set to `Enabled`.

Hit **Save** and the directory should show up after a page load.

! **TIP:** Check **[Introduction](/advanced/flex/administration/introduction)** for full walkthrough on how to create a page for your directory.

## Directory Listing

![Directories View](views-directories.png?width=2030&classes=shadow)

By default, the **Flex Objects** navigation menu item contains all the **Flex Directories** that have been enabled in your site.

!! Some Flex Directories choose to hide from this list and show up elsewhere. **Accounts** and **Pages** are good examples of this.

#### Controls

Along the top of the page, you will find the administrative controls.

- **Back**: Go back to **[Dashboard](/admin-panel/dashboard)**
- **Configure**: Redirects to **Plugins** > **Flex Objects**, see [Enabling a Directory](#enabling-a-directory)

#### Directories

When you select a Directory, you will end up at the **Content Listing** view.

In **[Content Listing](/advanced/flex/administration/views-list)** you can browse through the objects, use **Search**, and change **Ordering**. Additionally each object has **Actions**, notably **Edit** and **Delete**. You can also add new objects by using the **Add** button at top of any page. Next to it is also the **Configuration** button to change directory-wide settings.

In **[Content Editor](/advanced/flex/administration/views-edit)** you can edit the object and **Save** it.

In **[Configuration](/advanced/flex/administration/configuration)** you can change configuration, which changes the behavior of the whole directory. Usually caching is among these options.
