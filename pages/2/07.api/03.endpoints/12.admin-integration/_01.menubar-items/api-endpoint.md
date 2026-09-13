---
title: Menubar Items
api:
    method: GET
    path: '/menubar/items'
    description: 'Collect toolbar menu items registered by plugins via the `onApiMenubarItems` event. Each item declares an id, owning plugin slug, label, icon, action key, and an optional confirmation prompt. Admin2 renders them as buttons in the top toolbar and POSTs to `/menubar/actions/{plugin}/{action}` when clicked. Optional presentation keys control appearance: `variant` (default|primary|success|warning|danger), `showLabel`, and `size` (sm|md). Optional placement keys control where the button sits: `placement` (`start`, the default, is the open space on the left, away from the Clear Cache action; `end` sits beside the core actions behind a divider) and `priority` (higher renders earlier within a zone). An item may instead declare a client-side intent that runs in Admin2 without a server round-trip: `route` navigates the SPA (e.g. `/pages/new?parent=/blog&template=item` to deep-link the new-page form with a preset parent and locked template), and `modal` opens one of the plugin''s own modal web components (`{component, title?, props?, size?, useStandardHeader?}` — see `GET /gpm/plugins/{slug}/modal-script/{modalId}`). When `route` or `modal` is present it takes precedence over `action`; `confirm` still runs first if set.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "warm-cache", "plugin": "warm-cache", "label": "Warm Cache", "icon": "fa-tachometer", "action": "warm", "confirm": "Warm the cache?"}, {"id": "new-article", "plugin": "my-plugin", "label": "New Article", "icon": "fa-plus", "route": "/pages/new?parent=/blog&template=item"}]}'
    response_codes:
        - code: '200'
          description: 'Items returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
