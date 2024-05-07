---
title: Configuration
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/accounts-config'
process:
    twig: true
---

![Compatibility Tab](accounts-configuration.png?width=2030&classes=shadow)

[div class="table table-striped table-keycol"]
| Option                        | Description |
| :-----                        | :----- |
| **Admin event compatibility** | Enables `onAdminSave` and `onAdminSaveAfter` events for plugins. Enabled by default. |
[/div]

![Caching Tab](accounts-configuration.png?width=2030&classes=shadow)

For more information, see Flex Objects.

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
