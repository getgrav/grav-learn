---
title: Update User
template: api-endpoint
api:
    method: PATCH
    path: '/users/{username}'
    description: 'Update a user account.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to update (path parameter)'
        - name: email
          type: string
          required: false
          description: 'Updated email address'
        - name: fullname
          type: string
          required: false
          description: 'Updated full display name'
        - name: state
          type: string
          required: false
          description: 'Updated account state'
        - name: access
          type: object
          required: false
          description: 'Updated permission access object'
        - name: password
          type: string
          required: false
          description: 'New password'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'User updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'User not found'
        - code: '422'
          description: 'Validation error'
---

