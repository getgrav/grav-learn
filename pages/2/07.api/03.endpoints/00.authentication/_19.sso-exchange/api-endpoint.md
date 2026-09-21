---
title: SSO Exchange
api:
    method: POST
    path: '/auth/sso/exchange'
    description: 'Exchange the one-time code from the SSO callback redirect for the stored login result. The body is the same as `POST /auth/token` returns: either a token pair with the `user` object, or a `requires_2fa` challenge to finish with `POST /auth/2fa/verify`. The code is deleted on first use and expires 120 seconds after the callback. Public (no auth required).'
    parameters:
        - name: code
          type: string
          required: true
          description: 'Hex code from the `oauth-callback` redirect.'
    request_example: '{"code": "9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "jane", "fullname": "Jane Doe", "email": "jane@example.com", "avatar_url": null, "super_admin": false, "access": {"api": {"access": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'Login result: a token pair, or a 2FA challenge.'
        - code: '401'
          description: 'Invalid or expired exchange code (unknown, malformed, already used, or expired).'
        - code: '422'
          description: 'Missing code field.'
---
