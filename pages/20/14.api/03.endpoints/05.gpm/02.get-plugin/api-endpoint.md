---
title: Get Plugin
template: api-endpoint
api:
    method: GET
    path: '/gpm/plugins/{slug}'
    description: 'Get details for a single installed plugin.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The plugin slug'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Plugin not found'
---

