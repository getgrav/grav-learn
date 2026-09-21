---
title: Create Initial User
api:
    method: POST
    path: '/auth/setup'
    description: 'One-time first-run setup — creates the initial super-admin account on a fresh Grav 2.0 install. Active only while `user/accounts/` is empty; 409 thereafter. Grants `api.super` and `site.login` (not `admin.super`) by default so the account has API authority without implying classic-admin authority. Fires `onApiUserCreated` and `onApiSetupComplete`, then issues a login token pair (with the same `user` object `POST /auth/token` returns) so the client can skip straight to the dashboard. Public (no auth required), rate-limited per IP. When the site''s login captcha covers the setup flow, a solved `captcha_token` is required.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username (3–64 chars). It may not start with a period or contain `..`, and may not contain `\ / ? * : ; { }` or a line break.'
        - name: password
          type: string
          required: true
          description: 'Password. Must match `system.pwd_regex`, or be at least 8 characters when no regex is set (see `GET /auth/password-policy`).'
        - name: email
          type: string
          required: true
          description: 'A valid email address.'
        - name: fullname
          type: string
          required: false
          description: 'Display name for the account (defaults to the username).'
        - name: title
          type: string
          required: false
          description: 'User title (defaults to "Administrator").'
        - name: captcha_token
          type: string
          required: false
          description: 'A solved captcha. Required only when the site''s login captcha covers the setup flow (see `GET /auth/captcha`).'
    request_example: '{"username": "admin", "password": "a-good-secret", "email": "admin@example.com", "fullname": "Site Admin"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "admin", "fullname": "Site Admin", "email": "admin@example.com", "avatar_url": null, "super_admin": true, "access": {"api": {"super": true}, "site": {"login": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'Account created; token pair issued.'
        - code: '409'
          description: 'Setup has already been completed.'
        - code: '422'
          description: 'Validation failed (missing fields, username format, invalid email, password does not meet the policy, or the captcha was missing or failed).'
        - code: '429'
          description: 'Too many setup attempts from this IP.'
---
