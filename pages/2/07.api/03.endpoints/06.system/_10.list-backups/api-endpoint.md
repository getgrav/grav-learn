---
title: List Backups
api:
    method: GET
    path: '/system/backups'
    description: 'List existing backup files (filename, title, date, size), plus the configured purge policy and the number of configured backup profiles. Requires `api.system.backup`; demo accounts get 403.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"backups": [{"filename": "default_site_backup--20260917120000.zip", "title": "Default Site Backup", "date": "2026-09-17T12:00:00+00:00", "size": 1048576}], "purge": {"trigger": "space", "max_backups_count": 25, "max_backups_space": 5, "max_backups_time": 365}, "profiles_count": 1}}'
    response_codes:
        - code: '200'
          description: 'Backup list returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.backup` permission, or a demo account.'
---

`date` is an ISO 8601 timestamp, the same format [Create Backup](/2/api/endpoints/system/create-backup) returns. `purge` is the site's `backups.purge` configuration.
