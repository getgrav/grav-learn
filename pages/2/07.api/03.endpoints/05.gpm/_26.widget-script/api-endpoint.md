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
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
        - code: '404'
          description: 'Plugin not installed or not enabled, or widget component not found.'
---

Requires only `api.access`, so any admin who can reach the plugin's screens can load them without package manager rights. The script is served as `application/javascript` with `Cache-Control: private, no-cache` and an `ETag` built from the file's modification time and size, so a repeat request with `If-None-Match` gets an empty `304` until the file changes.
