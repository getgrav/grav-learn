---
title: Delete Avatar
template: api-endpoint
api:
    method: DELETE
    path: '/users/{username}/avatar'
    description: 'Remove the custom avatar for a user.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to remove the avatar for'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Avatar removed'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'User not found'
---

