---
title: Setup Status
api:
    method: GET
    path: '/auth/setup'
    description: 'Check whether the instance requires first-run setup. Returns `setup_required: true` only when `user/accounts/` is empty. Admin2 polls this on load to decide between showing the setup wizard or the login screen. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"data": {"setup_required": true}}'
    response_codes:
        - code: '200'
          description: 'Status returned successfully.'
---
