---
title: Revoke Token
api:
    method: POST
    path: '/auth/revoke'
    description: 'Revoke a refresh token (explicit logout). Best-effort decodes the token to record the user for the `onApiUserLogout` event, then revokes it unconditionally. Always returns 204, even if the token was already invalid — revoke is idempotent.'
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
        - code: '400'
          description: 'Missing refresh_token field.'
---
