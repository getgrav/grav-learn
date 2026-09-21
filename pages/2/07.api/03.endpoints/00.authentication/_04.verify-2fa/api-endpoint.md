---
title: Verify 2FA
api:
    method: POST
    path: '/auth/2fa/verify'
    description: 'Exchange a 2FA challenge token plus a TOTP code for a full token pair. The challenge token comes from `/auth/token` (or an SSO exchange) when it responds with `requires_2fa: true`. The challenge token is single-use and expires in 5 minutes. The response carries the same `user` object as `/auth/token`. On success, fires `onApiUserLogin` with `method: 2fa`. Shares the login rate limiter with `/auth/token`.'
    parameters:
        - name: challenge_token
          type: string
          required: true
          description: 'The short-lived challenge token returned from `/auth/token`.'
        - name: code
          type: string
          required: true
          description: 'The 6-digit TOTP code from the user''s authenticator app.'
    request_example: '{"challenge_token": "eyJ...", "code": "123456"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "admin", "fullname": "Site Admin", "email": "admin@example.com", "avatar_url": null, "super_admin": true, "access": {"api": {"super": true}, "site": {"login": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'Verification succeeded; token pair issued.'
        - code: '401'
          description: 'Invalid/expired challenge token, or invalid 2FA code.'
        - code: '403'
          description: 'Account disabled, or 2FA support unavailable on the server.'
        - code: '422'
          description: 'Missing challenge_token or code.'
        - code: '429'
          description: 'Too many failed attempts; rate limited.'
---
