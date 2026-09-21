---
title: Audit Facets
api:
    method: GET
    path: '/audit/facets'
    description: 'The distinct event codes and actors found in the log, sorted, for the filter drop-downs. Requires a super admin with `api.super` (a scoped API key needs the `admin.super` scope); demo accounts get 403.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"events": ["config.update", "page.update", "user.login", "user.login.failed"], "actors": [{"id": "admin", "name": "Admin User"}]}}'
    response_codes:
        - code: '200'
          description: 'Facets returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin with `api.super`, a scoped key without `admin.super`, or a demo account.'
        - code: '404'
          description: 'The audit trail is not enabled.'
        - code: '503'
          description: 'The SQLite PHP extension is not installed.'
---

An actor's `id` and `name` are `null` for events recorded without a known account. On a failed login both hold the username that was tried.
