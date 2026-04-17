---
title: Get Context Panel Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/panel-script'
    description: 'Serve the web component for a plugin-provided context panel (right-rail panel shown while editing pages or other content). Convention: the file lives at `admin-next/panels/{slug}.js`. Registered via the `onApiContextPanels` event and listed by `GET /context-panels`.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Plugin slug.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'JavaScript file served.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Panel component not found.'
---
