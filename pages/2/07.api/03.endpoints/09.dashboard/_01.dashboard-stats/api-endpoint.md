---
title: Dashboard Stats
api:
    method: GET
    path: /dashboard/stats
    description: 'Get a summary of site statistics for the dashboard, including available GPM updates. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"pages": {"total": 42, "published": 40}, "users": {"total": 5}, "plugins": {"total": 12, "active": 10, "updatable": 2}, "themes": {"total": 2, "updatable": 0, "active_updatable": false}, "grav": {"updatable": false}, "media": {"total": 120}, "theme": "quark", "grav_version": "2.1.0", "php_version": "8.3.14", "last_backup": "2026-03-26T03:00:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

Returns a snapshot of site statistics including page counts, user counts, plugin and theme counts with available updates, whether a Grav update is available, the media file count, the active theme, Grav/PHP versions, and the last backup date. The update counts fall back to zero when GPM can't be reached. `last_backup` only counts archives made by Grav's backup tool (`<name>--<timestamp>.zip` in `backup://`), and is `null` when there are none.
