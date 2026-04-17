---
title: Get Config
template: api-endpoint
api:
    method: GET
    path: '/config/{scope}'
    description: 'Get configuration values for a scope.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'Configuration scope: system, site, media, security, plugins/{name}, or themes/{name}'
    request_example: ''
    response_example: '{"data": {"title": "My Site", "author": {"name": "Admin"}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Scope not found'
---

