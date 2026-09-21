---
title: Get Permissions
api:
    method: GET
    path: /blueprints/users/permissions
    description: 'Get all registered permission actions in the system, organized hierarchically with translated labels. Requires `api.users.read`. A `children` key appears only on actions that have child actions.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"name": "admin", "label": "Admin", "children": [{"name": "admin.login", "label": "Login"}]}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.users.read` permission'
---

