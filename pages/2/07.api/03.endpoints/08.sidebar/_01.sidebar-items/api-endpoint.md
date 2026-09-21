---
title: Get Sidebar Items
api:
    method: GET
    path: '/sidebar/items'
    description: 'Collect sidebar navigation items registered by plugins. Fires the onApiSidebarItems event, drops items whose `authorize` permission the user lacks, strips `authorize`, translates labels that are translation keys into the user''s admin language, and sorts by `priority` (highest first). Each item defines an id, label, icon, route, and optional `badge` or `badgeEndpoint`. Requires `api.access`.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "license-manager", "plugin": "license-manager", "label": "Licenses", "icon": "fa-key", "route": "/plugin/license-manager", "priority": 10}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.access` permission'
---

