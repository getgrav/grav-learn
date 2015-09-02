---
title: Configuration (Site)
taxonomy:
    category: docs
process:
    twig: true
---

![Grav Admin Configuration](configuration_site.png)

The **Configuration** page gives you access to your site's **System** and **Site** configuration settings. Additionally, you can view a breakdown of your server's properties in a number of areas including PHP, SQL, server environment, and other various components that determine how your site operates.

The **Site** tab enables you to customize the settings found in the `/user/config/site.yaml` file. This tab gives you access to options and fields that determine site-related variables, such as the name, default author, and metadata used in your site.

Below is a breakdown of the different configuration sections that appear in the **Site** tab.

### Defaults

![Grav Admin Configuration](configuration_system_defaults.png)

This section is where you set the basic properties of content handling for your site. The home page, default theme, and various other content display options are set here.

| Option         | Description                                                           |
| :-----         | :-----                                                                |
| Site Title     | Default title for your site, often used by themes.                    |
| Default Author | A default author name, often used in themes or page content.          |
| Default Email  | A default email to reference in themes or pages.                      |
| Taxonomy Types | Taxonomy types must be defined here if you wish to use them in pages. |


### Page Summary

![Grav Admin Configuration](configuration_system_page.png)

Page summaries are a great way to give a small preview of a page's content. You can use a delimiter in the page to set a "cut off" point between the summary content, and the full body content of the page. These settings give you the ability to 


| Option       | Description                                                                                                                                                  |
| :-----       | :-----                                                                                                                                                       |
| Enabled      | Enable page summary (the summary returns the same as the page content)                                                                                       |
| Summary Size | The amount of characters of a page to use as a content summary                                                                                               |
| Format       | **short** = use the first occurrence of delimiter or size; **long** = summary delimiter will be ignored                                                      |
| Delimiter    | The summary delimiter (default '==='). You would typically place this after an opening paragraph, with everything prior to it appearing in the page summary. |

### Metadata

![Grav Admin Configuration](configuration_system_metadata.png)

Metadata is an important part of a page's behind-the-scenes makeup. It can improve SEO, how your links appear in various search engines and social feeds, and more. You can set various metadata properties here.

| Option   | Description                                                                                 |
| :-----   | :-----                                                                                      |
| Metadata | Default metadata values that will be displayed on every page unless overridden by the page. |

### Redirects and Routes

![Grav Admin Configuration](configuration_system_redirects.png)

Redirects and routing have never been easier. Just set it all up in this section, and you're good to go.

| Option           | Description                                                             |
| :-----           | :-----                                                                  |
| Custom Redirects | Routes to redirect to other pages. Standard Regex replacement is valid. |
| Custom Routes    | Routes to alias to other pages. Standard Regex replacement is valid.    |
