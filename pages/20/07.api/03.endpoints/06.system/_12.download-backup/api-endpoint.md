---
title: Download Backup
api:
    method: GET
    path: '/system/backups/{filename}/download'
    description: 'Stream a backup zip file to the caller. Returns `application/zip` with a `Content-Disposition: attachment` header.'
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
        - code: '400'
          description: 'Invalid filename.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
        - code: '404'
          description: 'Backup not found.'
---
