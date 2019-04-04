---
title: Editor (Options)
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/page-options'
process:
    twig: true
---

![Admin Page Editor](page-options.png?width=2532&classes=shadow)

The **Page Editor** in the admin is a powerful text editor and page manager that enables you to create your page's content (including media files), its publishing and taxonomy options, settings, overrides, and theme-specific options.

It's essentially a one-stop-shop for managing a specific page.

In this page, we will go over the features and functionality found in the **Options** tab of the **Page Editor**.

!! Accessing the Pages functionality requires an `access.admin.super` or `access.admin.pages` access level.

! You might notice the check boxes to the left of some of the options in this area of the admin. These boxes indicate that you would like to override the default values for this page. Leaving them unchecked reverts to blank or default states.

### Publishing

![Admin Page Editor](page-options-publishing.png?width=1946&classes=shadow)

This section is all about controlling the way your content is published. You can publish (or unpublish) content, set published dates as well as dates and times to unpublish, and to create metadata values specific to the page.

[div class="table table-striped table-keycol"]
| Option           | Description                                                                                                                                              |
| :-----           | :-----                                                                                                                                                   |
| Published        | By default, a page is published unless you explicitly set published: false or via a `publish_date` being in the future, or `unpublish_date` in the past. |
| Date             | The date variable allows you to specifically set a date associated with this page.                                                                       |
| Published Date   | This serves as the official publishing date for the page. It can provide a date to automatically trigger publication.                                    |
| Unpublished Date | This is the date/time you would like to mark for the page to automatically trigger un-publication.                                                       |
| Metadata         | Default metadata values that will be displayed on every page unless overridden by the page.                                                              |
[/div]

### Taxonomies

![Admin Page Editor](page-options-taxonomies.png?width=1944&classes=shadow)

The Taxonomies area is where you can configure your page's organizational properties. What categorie(s) the page will appear in, its tags, and more can be configured here.

[div class="table table-striped table-keycol"]
| Option   | Description                                                                                                                                                             |
| :-----   | :-----                                                                                                                                                                  |
| Category | This field enables you to set one or more categories for the page. It is useful in content sorting and filtering.                                                       |
| Tag      | Tags are a great way to provide some back-end insight into what your page is about. It's useful for content-driven sites as a mechanism for organization and filtering. |
| Month    |                                                                                                                                                                         |
[/div]

### Sitemap

![Admin Page Editor](page-options-sitemap.png?width=1944&classes=shadow)

Having a good, clean sitemap is important for several reasons. Among them being user navigation and search engine optimization (SEO). Having a sitemap in place makes your site inherently more friendly to search engines, which can have a direct impact on ranking.

This area of the options page is only available if you install the [Sitemap plugin](https://github.com/getgrav/grav-plugin-sitemap).

[div class="table table-striped table-keycol"]
| Options                  | Description                                                                                                                                                                                                                     |
| :-----                   | :-----                                                                                                                                                                                                                          |
| Sitemap Change Frequency | This drop-down enables you to set a frequency by which the page's sitemap is updated. This can be any time a change is made, hourly, daily, weekly, monthly, yearly, or never. By default, the global sitemap options are used. |
| Sitemap Priority         | Sets the priority of this page in your sitemap.                                                                                                                                                                                 |
[/div]