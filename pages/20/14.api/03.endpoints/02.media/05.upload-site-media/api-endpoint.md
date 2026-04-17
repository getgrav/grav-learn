---
title: Upload Site Media
template: api-endpoint
api:
    method: POST
    path: /media
    description: 'Upload files to the site-level media directory.'
    parameters:
        - name: path
          type: string
          required: false
          description: 'Subfolder path to upload into (created automatically if it does not exist)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '201'
          description: 'Files uploaded successfully'
        - code: '401'
          description: 'Unauthorized'
        - code: '422'
          description: 'Validation error'
---

Upload one or more files to the `user/media` directory. Use the `path` query parameter to upload into a subfolder. The request body should use `multipart/form-data` with a `file` field. Maximum upload size per file is 64 MB.
