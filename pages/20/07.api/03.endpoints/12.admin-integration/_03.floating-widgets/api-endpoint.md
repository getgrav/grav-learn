---
title: Floating Widgets
api:
    method: GET
    path: '/floating-widgets'
    description: 'Collect persistent UI widgets (chat assistants, notification panels) registered by plugins via `onApiFloatingWidgets`. Each widget ships a web component at `admin-next/widgets/{slug}.js` that Admin2 loads on-demand via `/gpm/plugins/{slug}/widget-script`.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "ai-pro-chat", "plugin": "ai-pro", "label": "AI Assistant", "icon": "bot", "priority": 10}]}'
    response_codes:
        - code: '200'
          description: 'Widgets returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
