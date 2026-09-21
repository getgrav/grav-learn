---
title: Delete Environment
api:
    method: DELETE
    path: '/system/environments/{name}'
    description: 'Delete the environment folder `user/env/<name>/` and everything in it. Requires a super admin, since the folder can hold `system` and `security` overrides that only a super admin may write.'
    parameters:
        - name: name
          type: string
          required: true
          description: 'Environment name (path parameter)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Environment deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super admin'
        - code: '404'
          description: 'No `user/env/<name>/` folder exists'
        - code: '422'
          description: 'Invalid name, the environment Grav is using for this request, or a legacy `user/<name>/` layout (remove that one by hand)'
---
