---
title: List Environments
template: api-endpoint
api:
    method: GET
    path: /system/environments
    description: 'List available Grav environments. Scans user/env/ for environment-specific configuration directories.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"current": "localhost", "environments": [{"name": "default", "active": false}, {"name": "localhost", "active": true}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

