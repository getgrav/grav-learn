---
title: Get Plugin Page Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/page-script'
    description: 'Serve the page-level web component JavaScript file for a plugin. The file is loaded from `admin-next/pages/{slug}.js` within the plugin directory.'
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
          description: 'Plugin not installed or not enabled, or no page component.'
---

Requires only `api.access`, so any admin who can reach the plugin's screens can load them without package manager rights. The script is served as `application/javascript` with `Cache-Control: private, no-cache` and an `ETag` built from the file's modification time and size, so a repeat request with `If-None-Match` gets an empty `304` until the file changes.
