---
title: Accept Invitation
api:
    method: POST
    path: '/auth/invite/{token}'
    description: 'Create the invited account and log it in. The email address, access and groups come from the invitation and cannot be changed by the request. The password must meet the site''s password policy (see `GET /auth/password-policy`). The invitation is consumed once the account is created; an expired one is deleted and answered with 410. The login then runs the same check as `POST /auth/token`: if the invitation''s access grants no API or admin login (`api.access`, `admin.login` or super), the account is still created but no tokens are issued and the response is 403. On success the response is a token pair with the `user` object and an `X-Invalidates: users:list` header. Fires `onApiUserCreated` and `onApiInvitationAccepted`. Public: the token is the only credential.'
    parameters:
        - name: token
          type: string
          required: true
          description: 'The invitation token from the emailed invite link (path parameter).'
        - name: username
          type: string
          required: true
          description: 'Username (3–64 chars). It may not start with a period or contain `..`, and may not contain `\ / ? * : ; { }` or a line break.'
        - name: password
          type: string
          required: true
          description: 'Password. Must match `system.pwd_regex`, or be at least 8 characters when no regex is set.'
        - name: fullname
          type: string
          required: false
          description: 'Display name (defaults to the name on the invitation).'
        - name: title
          type: string
          required: false
          description: 'User title.'
    request_example: '{"username": "jane", "password": "Pa$$w0rd!", "fullname": "Jane Doe"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "jane", "fullname": "Jane Doe", "email": "jane@example.com", "avatar_url": null, "super_admin": false, "access": {"api": {"access": true, "pages": {"read": true}}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'Account created and logged in.'
        - code: '403'
          description: 'Account created, but the invitation grants no API or admin login access, so no tokens were issued.'
        - code: '404'
          description: 'This invitation is invalid.'
        - code: '409'
          description: 'An account with that username already exists.'
        - code: '410'
          description: 'This invitation has expired.'
        - code: '422'
          description: 'Missing fields, invalid username format, or the password does not meet the policy.'
---
