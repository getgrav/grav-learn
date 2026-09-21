---
title: Settings Panels
api:
    method: GET
    path: '/settings/panels'
    description: 'Collect admin-settings panel registrations from plugins via `onApiAdminSettingsPanels`. Unlike full plugin pages (registered with `onApiSidebarItems`), settings panels render as cards inside Admin2''s Settings page. Each panel follows the blueprint-mode plugin-page format: a blueprint file plus data/save endpoints. Sorted by `priority` descending (higher priority first), preserving insertion order for ties. The API does not filter panels by permission, so a plugin should check `$event[''user'']` before adding a panel.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "login-settings", "plugin": "api", "label": "Login & Security", "description": "Authentication settings", "icon": "fa-shield-alt", "blueprint": "login-settings", "data_endpoint": "/login-settings/data", "save_endpoint": "/login-settings/save", "priority": 0}]}'
    response_codes:
        - code: '200'
          description: 'Panels returned (sorted).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
