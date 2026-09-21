---
title: Disable 2FA
api:
    method: POST
    path: '/users/{username}/2fa/disable'
    description: 'Disable 2FA on an account. Self-disable requires `api.access` and a valid current TOTP code, which stops a stolen session from removing 2FA on its own. Admins with `api.users.write` (or superadmin) can force-disable without a code, for lost-device recovery; only a super admin can do this for a super admin account. Both paths clear the `twofa_secret`. Fires `onApiUser2faDisabled` with `forced_by_admin` flag.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username (path param).'
        - name: code
          type: string
          required: false
          description: 'Current TOTP code. Required for self-disable without `api.users.write`; ignored for admin-forced disable.'
    request_example: '{"code": "123456"}'
    response_example: '{"data": {"twofa_enabled": false}}'
    response_codes:
        - code: '200'
          description: '2FA disabled.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Caller is neither the account owner nor holds `api.users.write`, or a non-super admin targets a super admin. Checked before the account is loaded, so this does not reveal whether a username exists.'
        - code: '404'
          description: 'User not found.'
        - code: '422'
          description: 'Missing/invalid code (self-disable path only).'
        - code: '500'
          description: 'Login plugin with 2FA support not installed.'
---
