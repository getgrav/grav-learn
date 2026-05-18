---
title: Create User
api:
    method: POST
    path: /users
    description: 'Create a new user account.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Unique username'
        - name: password
          type: string
          required: true
          description: 'User password'
        - name: email
          type: string
          required: true
          description: 'User email address'
        - name: fullname
          type: string
          required: false
          description: 'Full display name'
        - name: state
          type: string
          required: false
          description: 'Account state (e.g. enabled, disabled)'
        - name: access
          type: object
          required: false
          description: 'Permission access object'
    request_example: '{"username": "editor", "password": "SecurePass123!", "email": "editor@example.com", "fullname": "Jane Editor"}'
    response_example: ''
    response_codes:
        - code: '201'
          description: 'User created'
        - code: '401'
          description: 'Unauthorized'
        - code: '409'
          description: 'Username already exists'
        - code: '422'
          description: 'Validation error'
---

