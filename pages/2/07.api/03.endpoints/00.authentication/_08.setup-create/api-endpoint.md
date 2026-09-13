---
title: Create Initial User
api:
    method: POST
    path: '/auth/setup'
    description: 'One-time first-run setup — creates the initial super-admin account on a fresh Grav 2.0 install. Active only while `user/accounts/` is empty; 409 thereafter. Grants `api.super` (not `admin.super`) by default so the account has API authority without implying classic-admin authority. Fires `onApiUserCreated` and `onApiSetupComplete`, then issues a login token pair so the client can skip straight to the dashboard. Public (no auth required), rate-limited per IP.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username (3–64 chars; letters, numbers, hyphens, underscores).'
        - name: password
          type: string
          required: true
          description: 'Password (minimum 8 characters).'
        - name: email
          type: string
          required: true
          description: 'A valid email address.'
        - name: fullname
          type: string
          required: false
          description: 'Display name for the account.'
        - name: title
          type: string
          required: false
          description: 'User title (defaults to "Administrator").'
    request_example: '{"username": "admin", "password": "a-good-secret", "email": "admin@example.com", "fullname": "Site Admin"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600}}'
    response_codes:
        - code: '200'
          description: 'Account created; token pair issued.'
        - code: '400'
          description: 'Validation failed (username format, invalid email, password too short, missing fields).'
        - code: '409'
          description: 'Setup has already been completed.'
        - code: '429'
          description: 'Too many setup attempts from this IP.'
---
