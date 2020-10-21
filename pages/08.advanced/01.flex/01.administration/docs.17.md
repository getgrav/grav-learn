---
title: Administration
taxonomy:
    category: docs
---

If you have been using **Admin Panel** in Grav 1.7, you have already used **Flex Objects**. The best examples are **Accounts** and **Pages**, which are great examples what can be done with **Flex**.

By default, **Flex Administration** is invisible to the user. In order to see a **Directory**, it has to be enabled. Enabled directories can show up either on **Navigation Menu**, inside **Flex Objects** menu item or even inside other plugins.

!! **Flex Objects** Plugin has to be enabled in order to use any custom directories.

## Enabling a Directory

To enable a custom **Flex Directory**, you need to go to **Plugins** > **Flex Objects**.

We are interested in **Directories** option inside the plugin, which lists all the detected **Flex Directories**. Just select the directories you're interested in and make sure toggle has `Enabled` option checked.

Hit **Save** and the directory should show up after a page load.

## Navigation Menu

By default, Flex Directories appear under **Flex Objects** menu item. The menu item will appear when you enable a Flex Directory, which has not configured to show up elsewhere.

When you select a Flex Directory, you will end up to a **List View**.

In **List View** you can browse through the objects, use **Search** and change **Ordering**. Additionally each object has **Actions**, usually at least **Edit** and **Delete**. You can also **Add** new objects by using a button at top of the page. Next to it is also **Configuration** button to change directory-wide settings.

In **Edit View** you can edit the object and **Save** it.

In **Configuration** you can change configuration, which changes the behavior of the whole directory. Usually caching is among of these options.
