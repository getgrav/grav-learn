---
title: Configuration
taxonomy:
    category: docs
process:
    twig: true
---

**Configuration** has common settings for the **Flex Directory**.

These settings are typically used for changing the behaviour of the directory, setting defaults for the objects or alter rendering of the layouts.

!! The settings are different in every Directory, this document contains only the common settings found in every directory.

#### Controls

Along the top of the page, you will find the administrative controls.

- **Back**: Go back to **[Content Listing](/advanced/flex/administration/views-list)**
- **Save**: Save configuration and return back to **[Content Listing](/advanced/flex/administration/views-list)**

### Caching Tab

[div class="table table-striped table-keycol"]
| Option                        | Description |
| :-----                        | :----- |
| **Enable Index Caching** | Index caching speeds up searches by creating temporary lookup indexes for the queries. |
| **Index Cache Lifetime (seconds)** | Lifetime for index caching in seconds. |
| **Enable Object Caching** | Object caching speeds up loading the object data and images. |
| **Object Cache Lifetime (seconds)** | Lifetime for object caching in seconds. |
| **Enable Render Caching** | Render caching speeds up rendering the content by caching the resulting HTML. |
| **Render Cache Lifetime (seconds)** | Lifetime for render caching in seconds. |
[/div]

If the rendered HTML has dynamic content, render cache can be disabled from the Twig template by {% verbatim %}```{% do block.disableCache() %}```{% endverbatim %}.
