---
title: Get Floating Widget Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/widget-script'
    description: 'Serve the web component for a plugin-provided floating widget. Convention: the file lives at `admin-next/widgets/{slug}.js`. Registered via the `onApiFloatingWidgets` event and listed by `GET /floating-widgets`.'
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
          description: 'Widget component not found.'
---
