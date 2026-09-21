---
title: Delete User
api:
    method: DELETE
    path: '/users/{username}'
    description: 'Delete a user account. Requires `api.users.write`.'
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
          description: 'Forbidden (missing `api.users.write`, deleting your own account, or a non-super caller deleting a super admin)'
        - code: '404'
          description: 'User not found'
---

