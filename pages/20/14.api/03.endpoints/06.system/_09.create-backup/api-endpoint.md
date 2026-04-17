---
title: Create Backup
api:
    method: POST
    path: '/system/backup'
    description: 'Trigger a backup of the site. Uses Grav''s built-in `Backups` class, writes a dated zip to the configured backup location, and returns the filename, path, size, and creation timestamp. Admin2 uses this for the "Backup now" action on the dashboard.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"filename": "default-20260417120000.zip", "path": "/path/to/backup/default-20260417120000.zip", "size": 1048576, "date": "2026-04-17T12:00:00+00:00"}}'
    response_codes:
        - code: '201'
          description: 'Backup created; Location header points to `/system/backups`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.write` permission.'
---
