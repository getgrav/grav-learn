---
title: Introduction
taxonomy:
    category: docs
---

This section contains a walkthrough how to quickly enable existing **Directory** and how to display it in your site. In our examples we are using **Contacts** Directory which already exists in your site.

## Enabling a Directory

![Plugin Configuration](flex-objects-options.png?width=2030&classes=shadow)

To enable a custom **Flex Directory**, you need to go to **Plugins** > **Flex Objects**.

We are interested in **Directories** option inside the plugin, which lists all the detected **Flex Directories**. Just select the directories you're interested in and make sure toggle has `Enabled` option checked.

! **TIP:** Enable directory called **Contacts**

Hit **Save** and the directory should show up after a page load.

## Install Sample Data (Optional)

For our example, we assume that you have copied the sample data set for **Contacts** Directory:

```shell
$ cp user/plugins/flex-objects/data/flex-objects/contacts.json user/data/flex-objects/contacts.json
```

## Create a Page

Go to **[Pages](/admin-panel/page)** and [add a new page](/admin-panel/page#adding-new-pages). Enter following values:

- **Page Title**: `Flex-Objects`
- **Page Template**: `Flex-objects`

After this you can click on **Continue** button.

In the **[Content Editor](/advanced/flex/administration/views-edit)** enter directory and add content:

- **Flex Directory**: `Contacts`
- **Content**:
    [prism classes="language-twig"]
    # Directory Example
    [/prism]

When you are happy with the page, hit **Save**.

! **TIP:** If you do not specify `Flex Directory`, the page will list all directories instead of displaying entries from a single directory.

## Display the Page

You can just go to your site and look at the menu. It should contain **Contacts**. Entering to that page should display:

![](flex-objects-site.png?width=2030&classes=shadow)

In case if you did not select any directory, this is what you would see instead:

![](flex-objects-directory.png?width=2030&classes=shadow)
