---
title: List Plugins
template: api-endpoint
api:
    method: GET
    path: /gpm/plugins
    description: 'List all installed plugins with update status.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "admin", "name": "Admin Panel", "version": "1.11.0", "enabled": true}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

