---
title: Upload Object Media
api:
    method: POST
    path: '/flex-objects/{type}/{key}/media'
    description: 'Upload one or more files to an object. Files are stored in the object''s own folder, next to its data file, for folder-based directories.'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
        - name: key
          type: string
          required: true
          description: 'The object key.'
        - name: file
          type: file
          required: true
          description: 'File(s) to upload (multipart/form-data). Nested fields like `file[]` are supported.'
    request_example: ''
    response_example: '{"data": [{"filename": "avatar.png", "type": "image/png", "size": 20480}]}'
    response_codes:
        - code: '201'
          description: 'File(s) uploaded; the response lists the object''s current media.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `update` permission.'
        - code: '404'
          description: 'Directory or object not found.'
        - code: '422'
          description: 'No file supplied, a disallowed file type or size, or a directory without per-object media folders (single-file storage).'
---

Send the file as a `multipart/form-data` request (set `Content-Type: multipart/form-data`), not JSON. Uploads are validated against Grav''s dangerous-extensions list and a 64 MB size cap. Requires folder-based storage for the directory (one folder per object); directories that use single-file storage return `422`.
