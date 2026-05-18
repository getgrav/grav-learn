---
title: Menubar Items
api:
    method: GET
    path: '/menubar/items'
    description: 'Collect toolbar menu items registered by plugins via the `onApiMenubarItems` event. Each item declares an id, owning plugin slug, label, icon, action key, and an optional confirmation prompt. Admin2 renders them as buttons in the top toolbar and POSTs to `/menubar/actions/{plugin}/{action}` when clicked.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "warm-cache", "plugin": "warm-cache", "label": "Warm Cache", "icon": "fa-tachometer", "action": "warm", "confirm": "Warm the cache?"}]}'
    response_codes:
        - code: '200'
          description: 'Items returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
