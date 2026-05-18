---
title: Update Config
api:
    method: PATCH
    path: '/config/{scope}'
    description: 'Update configuration values with deep merge.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'Configuration scope: system, site, media, security, plugins/{name}, or themes/{name}'
    request_example: '{"title": "Updated Site Title"}'
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Configuration updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Scope not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Validation error'
---

The request body is deep-merged into the existing configuration. Supports [optimistic concurrency control](/20/api/getting-started#concurrency-control) via the `If-Match` header.
