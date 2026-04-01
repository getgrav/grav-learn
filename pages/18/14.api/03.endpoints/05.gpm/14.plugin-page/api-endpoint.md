---
title: Get Plugin Page
template: api-endpoint
api:
    method: GET
    path: '/gpm/plugins/{slug}/page'
    description: 'Get the admin page definition for a plugin. Returns the page type, blueprint reference, data/save endpoints, and action buttons. Resolution order: 1) onApiPluginPageInfo event, 2) admin-next/pages/{slug}.yaml, 3) admin-next/pages/{slug}.js (inferred component mode).'
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
        - code: '404'
          description: 'No admin page found for plugin'
---

