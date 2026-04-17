---
title: List Blueprints
template: api-endpoint
api:
    method: GET
    path: '/blueprints/pages/{template}'
    description: 'Get the blueprint schema for a page template.'
    parameters:
        - name: template
          type: string
          required: true
          description: 'The page template name (e.g. default, blog, post)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Template blueprint not found'
---

