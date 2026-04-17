---
title: Remove Package
template: api-endpoint
api:
    method: POST
    path: /gpm/remove
    description: 'Remove an installed package.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to remove'
    request_example: '{"package": "sitemap"}'
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Package removed'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Package not found'
---

