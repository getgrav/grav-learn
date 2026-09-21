---
title: Admin2 Integration
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints that power Admin2's extensibility and preferences: menubar toolbar items, floating widgets, slide-in context panels, settings-page panels, the registry of plugin-provided custom field components, markdown editor toolbar buttons, and Admin2's user and site preferences and branding.

All endpoints require `api.access` and are meant to be called by Admin2, not by end-user applications. Writing site preferences and branding also needs a super user. The UI registries are backed by events (`onApiMenubarItems`, `onApiFloatingWidgets`, `onApiContextPanels`, `onApiAdminSettingsPanels`, `onApiMarkdownEditorButtons`), which plugins hook to register items. See the [Developer Guide](/2/api/developer-guide) for the full integration recipe.
