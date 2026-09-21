---
title: Download Backup
api:
    method: GET
    path: '/system/backups/{filename}/download'
    description: 'Stream a backup zip file to the caller. Returns `application/zip` with a `Content-Disposition: attachment` header. Requires `api.system.backup`; demo accounts get 403.'
    parameters:
        - name: filename
          type: string
          required: true
          description: 'The backup filename (bare basename ending in `.zip`).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Backup streamed.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.backup` permission, or a demo account.'
        - code: '404'
          description: 'Backup not found.'
        - code: '422'
          description: 'Invalid filename.'
---
