---
title: Refresh Token
template: api-endpoint
api:
    method: POST
    path: /auth/refresh
    description: 'Refresh an expired access token using a valid refresh token. This is a public endpoint that does not require prior authentication.'
    parameters:
        - name: refresh_token
          type: string
          required: true
          description: 'A valid refresh token obtained from the token endpoint'
    request_example: '{"refresh_token": "eyJ..."}'
    response_example: ''
    response_codes:
        - code: '200'
          description: 'New tokens generated'
        - code: '401'
          description: 'Invalid or expired refresh token'
---

