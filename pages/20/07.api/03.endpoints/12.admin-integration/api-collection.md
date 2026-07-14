---
title: Admin2 Integration
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints that power Admin2's extensibility: menubar toolbar items, floating widgets, slide-in context panels, settings-page panels, and the registry of plugin-provided custom field components.

All endpoints require `api.access` and are meant to be called by Admin2 during UI composition, not by end-user applications. Each endpoint is backed by an event (`onApiMenubarItems`, `onApiFloatingWidgets`, `onApiContextPanels`, `onApiAdminSettingsPanels`) — plugins hook those events to register items. See the [Developer Guide](/20/api/developer-guide) for the full integration recipe.
