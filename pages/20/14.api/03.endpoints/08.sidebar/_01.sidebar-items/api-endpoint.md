---
title: Get Sidebar Items
api:
    method: GET
    path: '/sidebar/items'
    description: 'Collect sidebar navigation items registered by plugins. Fires the onApiSidebarItems event and returns all items contributed by installed plugins. Each item defines an id, label, icon, route, and optional badge.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "license-manager", "plugin": "license-manager", "label": "Licenses", "icon": "fa-key", "route": "/plugin/license-manager", "priority": 10}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

