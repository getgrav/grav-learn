---
title: Get User Blueprint
template: api-endpoint
api:
    method: GET
    path: /blueprints/users
    description: 'Get the user account blueprint schema for rendering the user edit form.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"name": "account", "title": "Account", "validation": "loose", "fields": [{"name": "username", "type": "text", "label": "Username"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'User blueprint not found'
---

