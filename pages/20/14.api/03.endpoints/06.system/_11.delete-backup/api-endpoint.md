---
title: Delete Backup
api:
    method: DELETE
    path: '/system/backups/{filename}'
    description: 'Delete a backup zip. The filename is validated to prevent path traversal — must be a bare basename ending in `.zip`.'
    parameters:
        - name: filename
          type: string
          required: true
          description: 'The backup filename (bare basename, e.g. `default-20260417120000.zip`).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Backup deleted.'
        - code: '400'
          description: 'Invalid filename.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.write` permission.'
        - code: '404'
          description: 'Backup not found.'
---
