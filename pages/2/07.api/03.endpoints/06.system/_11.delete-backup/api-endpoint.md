---
title: Delete Backup
api:
    method: DELETE
    path: '/system/backups/{filename}'
    description: 'Delete a backup zip. The filename is validated to prevent path traversal — must be a bare basename ending in `.zip`. Requires `api.system.backup`; demo accounts get 403.'
    parameters:
        - name: filename
          type: string
          required: true
          description: 'The backup filename (bare basename, e.g. `default_site_backup--20260917120000.zip`).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Backup deleted.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.backup` permission, or a demo account.'
        - code: '404'
          description: 'Backup not found.'
        - code: '422'
          description: 'Invalid filename.'
---
