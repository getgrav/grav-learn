---
title: Disable 2FA
api:
    method: POST
    path: '/users/{username}/2fa/disable'
    description: 'Disable 2FA on an account. Self-disable requires a valid current TOTP code — this stops a stolen session from unilaterally removing 2FA. Admins with `api.users.write` (or superadmin) can force-disable without a code, for lost-device recovery. Both paths clear the `twofa_secret`. Fires `onApiUser2faDisabled` with `forced_by_admin` flag.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username (path param).'
        - name: code
          type: string
          required: false
          description: 'Current TOTP code. Required for self-disable; ignored for admin-forced disable.'
    request_example: '{"code": "123456"}'
    response_example: '{"data": {"twofa_enabled": false}}'
    response_codes:
        - code: '200'
          description: '2FA disabled.'
        - code: '400'
          description: 'Missing/invalid code (self-disable path only).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Caller is neither the account owner nor holds `api.users.write`.'
        - code: '404'
          description: 'User not found.'
        - code: '500'
          description: 'Login plugin with 2FA support not installed.'
---
