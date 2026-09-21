---
title: Generate 2FA Secret
api:
    method: POST
    path: '/users/{username}/2fa'
    description: 'Generate or regenerate a TOTP two-factor authentication secret and return a QR code data URI. Generating a secret turns 2FA off until a code is confirmed with Enable 2FA. For your own account this needs `api.access`; for anyone else''s it needs `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to generate 2FA for'
    request_example: ''
    response_example: '{"data": {"secret": "JBSW Y3DP EHPK 3PXP", "qr_code": "data:image/png;base64,..."}}'
    response_codes:
        - code: '200'
          description: 'Secret generated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden. Permissions are checked before the account is loaded, so a caller without them gets 403 whether or not the username exists.'
        - code: '404'
          description: 'User not found'
        - code: '500'
          description: 'Login plugin with 2FA support not installed'
---

