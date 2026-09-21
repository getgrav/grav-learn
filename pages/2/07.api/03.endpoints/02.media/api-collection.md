---
title: Media
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints for managing media files attached to pages and site-level media, their `.meta.yaml` metadata, the manual order of site media folders, and files saved by blueprint file fields. Reading needs `api.media.read` and changing anything needs `api.media.write`. Page media also follows the page's own access rules, so a page that denies you read or update access returns 403. Thumbnails are public.
