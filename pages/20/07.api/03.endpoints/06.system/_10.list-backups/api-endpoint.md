---
title: List Backups
api:
    method: GET
    path: '/system/backups'
    description: 'List existing backup files (filename, title, date, size), plus the configured purge policy and the number of configured backup profiles.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"backups": [{"filename": "default-20260417120000.zip", "title": "Default", "date": "2026-04-17T12:00:00+00:00", "size": 1048576}], "purge": {"max_backups_count": 25}, "profiles_count": 1}}'
    response_codes:
        - code: '200'
          description: 'Backup list returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
---
