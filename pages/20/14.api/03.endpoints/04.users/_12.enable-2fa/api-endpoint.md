---
title: Enable 2FA
api:
    method: POST
    path: '/users/{username}/2fa/enable'
    description: 'Verify a TOTP code against the previously generated secret and mark 2FA as enabled on the account. Only the account owner can enable 2FA on their own account (not admins). Fires `onApiUser2faEnabled`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username (path param).'
        - name: code
          type: string
          required: true
          description: 'Current 6-digit TOTP code from the authenticator app.'
    request_example: '{"code": "123456"}'
    response_example: '{"data": {"twofa_enabled": true}}'
    response_codes:
        - code: '200'
          description: '2FA enabled.'
        - code: '400'
          description: 'Missing code, invalid code, or no 2FA secret generated yet (call `POST /users/{username}/2fa` first).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Only the account owner can enable 2FA.'
        - code: '404'
          description: 'User not found.'
        - code: '500'
          description: 'Login plugin with 2FA support not installed.'
---
