---
title: Refresh Token
api:
    method: POST
    path: /auth/refresh
    description: 'Refresh an expired access token using a valid refresh token. The refresh token you send is revoked (token rotation), and the response is a new token pair with the same `user` object `POST /auth/token` returns. This is a public endpoint that does not require prior authentication.'
    parameters:
        - name: refresh_token
          type: string
          required: true
          description: 'A valid refresh token obtained from the token endpoint'
    request_example: '{"refresh_token": "eyJ..."}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "admin", "fullname": "Site Admin", "email": "admin@example.com", "avatar_url": null, "super_admin": true, "access": {"api": {"super": true}, "site": {"login": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'New tokens generated'
        - code: '401'
          description: 'Invalid or expired refresh token'
        - code: '403'
          description: 'The account is disabled.'
        - code: '422'
          description: 'Missing refresh_token field.'
---

