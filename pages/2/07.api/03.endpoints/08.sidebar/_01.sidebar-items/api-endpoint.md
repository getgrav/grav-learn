---
title: Get Sidebar Items
api:
    method: GET
    path: '/sidebar/items'
    description: 'Collect sidebar navigation items registered by plugins. Fires the onApiSidebarItems event, drops items whose `authorize` permission the user lacks, strips `authorize`, translates labels that are translation keys into the user''s admin language, and sorts by `priority` (highest first). Each item defines an id, label, icon, route, and optional `badge`, `badgeEndpoint` or `children` (shortcuts each user can show under the item; children the user lacks `authorize` for, or with a bad or repeated id, are dropped, and `default` is kept only when it is `true`). Requires `api.access`.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "license-manager", "plugin": "license-manager", "label": "Licenses", "icon": "fa-key", "route": "/plugin/license-manager", "priority": 10}, {"id": "my-plugin", "plugin": "my-plugin", "label": "My Plugin", "icon": "fa-store", "route": "/plugin/my-plugin", "priority": 5, "children": [{"id": "orders", "label": "Orders", "route": "/plugin/my-plugin/orders", "default": true}, {"id": "coupons", "label": "Coupons", "route": "/plugin/my-plugin/coupons"}]}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.access` permission'
---

