---
title: Audit Status
api:
    method: GET
    path: '/audit/status'
    description: 'Whether the audit trail is available and enabled, with its detail level and retention settings. Admin Next uses it to decide whether to show the Audit tab. Unlike the other audit routes it works while the trail is disabled. Requires a super admin with `api.super` (a scoped API key needs the `admin.super` scope); demo accounts get 403.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"enabled": true, "available": true, "coverage": "standard", "retention": {"days": 90, "max_rows": 100000}, "total": 1284}}'
    response_codes:
        - code: '200'
          description: 'Status returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin with `api.super`, a scoped key without `admin.super`, or a demo account.'
---

`available` says whether the `pdo_sqlite` extension is loaded, and `enabled` is true only when `plugins.api.audit.enabled` is on and SQLite is available. `coverage` is `standard` or `detailed`. In `retention`, `days` prunes older entries and `max_rows` caps the number stored; `0` turns either bound off. `total` is the number of stored events, or `null` when the trail is disabled or the count failed.
