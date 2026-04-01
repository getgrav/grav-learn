---
title: Get Permissions
template: api-endpoint
api:
    method: GET
    path: /blueprints/users/permissions
    description: 'Get all registered permission actions in the system, organized hierarchically with translated labels.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"name": "admin", "label": "Admin", "children": [{"name": "admin.login", "label": "Login"}]}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

