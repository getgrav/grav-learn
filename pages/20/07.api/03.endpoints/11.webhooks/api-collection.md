---
title: Webhooks
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modular'
---

Register outgoing HTTP webhooks that fire when API write events happen (page/media/user mutations, config updates, GPM installs, Grav upgrades). Each webhook has a URL, an event filter list, an optional shared secret for HMAC signing, and a delivery log.

Permissions: `api.webhooks.read` / `api.webhooks.write`. Secrets are always redacted in API responses — the full value is shown once on creation and never again.

## Valid event names

`*` (all), `page.created`, `page.updated`, `page.deleted`, `page.moved`, `page.translated`, `pages.reordered`, `media.uploaded`, `media.deleted`, `user.created`, `user.updated`, `user.deleted`, `config.updated`, `gpm.installed`, `gpm.removed`, `grav.upgraded`.
