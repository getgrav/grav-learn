---
title: Delete User
template: api-endpoint
api:
    method: DELETE
    path: '/users/{username}'
    description: 'Delete a user account.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to delete'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'User deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'User not found'
---

