---
title: Get User
api:
    method: GET
    path: '/users/{username}'
    description: 'Get user details.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to retrieve'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'User not found'
---

