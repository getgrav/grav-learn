---
title: Setup Status
api:
    method: GET
    path: '/auth/setup'
    description: 'Check whether the instance requires first-run setup. Returns `setup_required: true` only when `user/accounts/` is empty. Also returns `password_policy` (the same object as `GET /auth/password-policy`) so the setup screen can validate the password without a second call. Admin2 polls this on load to decide between showing the setup wizard or the login screen. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"data": {"setup_required": true, "password_policy": {"regex": "", "min_length": 8, "rules": [{"id": "length", "label": "At least 8 characters", "pattern": ".{8,}"}]}}}'
    response_codes:
        - code: '200'
          description: 'Status returned successfully.'
---
