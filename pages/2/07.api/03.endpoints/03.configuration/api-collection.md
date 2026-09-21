---
title: Configuration
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints for reading, updating and reverting Grav configuration scopes including system, site, media, security, plugins, themes and site-authored custom scopes, plus the Flex accounts configuration. Reads need `api.config.read` and writes need `api.config.write`; writes to `system`, `security` and `plugins/api`, and any access to the tool-managed `scheduler` and `backups` scopes, also need an API super user. The accounts configuration is super-user only.
