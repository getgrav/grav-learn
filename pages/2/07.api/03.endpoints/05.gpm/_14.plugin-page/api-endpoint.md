---
title: Get Plugin Page
api:
    method: GET
    path: '/gpm/plugins/{slug}/page'
    description: 'Get the admin page definition for a plugin. Returns the page type, blueprint reference, data/save endpoints, and action buttons. Resolution order: 1) onApiPluginPageInfo event, 2) admin-next/pages/{slug}.yaml, 3) admin-next/pages/{slug}.js (inferred component mode). Requires only `api.access`; the data behind the page answers to the plugin''s own permissions.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The plugin slug'
    request_example: ''
    response_example: '{"data": {"id": "license-manager", "plugin": "license-manager", "title": "License Manager", "icon": "fa-key", "page_type": "blueprint", "blueprint": "licenses", "data_endpoint": "/licenses/form-data", "save_endpoint": "/licenses", "actions": [{"id": "save", "label": "Save", "icon": "fa-check", "primary": true}], "has_custom_component": false}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.access` permission'
        - code: '404'
          description: 'No admin page found for plugin'
---

A definition may also carry `settings_route`, a hash route inside the page where the plugin's settings are drawn, and `settings_page`, the slug of another installed plugin whose admin page draws them. `settings_page` is kept only together with a valid `settings_route`.
