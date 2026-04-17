---
title: Get Token
template: api-endpoint
api:
    method: POST
    path: /auth/token
    description: 'Generate JWT access and refresh tokens. This is a public endpoint that does not require prior authentication.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'User account username'
        - name: password
          type: string
          required: true
          description: 'User account password'
    request_example: '{"username": "admin", "password": "password"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600}}'
    response_codes:
        - code: '200'
          description: 'Tokens generated'
        - code: '401'
          description: 'Invalid credentials'
---

