---
title: Revoke Token
api:
    method: POST
    path: '/auth/revoke'
    description: 'Revoke a refresh token (explicit logout). If the request also carries an access token (`X-API-Token` or `Authorization: Bearer`), that access token is revoked too, so the current session ends immediately. When the refresh token is still valid, its user is recorded for the `onApiUserLogout` event. Always returns 204, even if the token was already invalid, so revoke is idempotent.'
    parameters:
        - name: refresh_token
          type: string
          required: true
          description: 'The refresh token to invalidate (body field).'
    request_example: '{"refresh_token": "eyJ..."}'
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Token revoked (or already invalid).'
        - code: '422'
          description: 'Missing refresh_token field.'
---
