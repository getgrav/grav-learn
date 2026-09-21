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
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
        - code: '404'
          description: 'Plugin not installed or not enabled, or panel component not found.'
---

Requires only `api.access`, so any admin who can reach the plugin's screens can load them without package manager rights. The script is served as `application/javascript` with `Cache-Control: private, no-cache` and an `ETag` built from the file's modification time and size, so a repeat request with `If-None-Match` gets an empty `304` until the file changes.
