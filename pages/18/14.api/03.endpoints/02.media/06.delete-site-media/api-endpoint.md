---
title: Delete Site Media
template: api-endpoint
api:
    method: DELETE
    path: '/media/{filename}'
    description: 'Delete a site-level media file.'
    parameters:
        - name: filename
          type: string
          required: true
          description: 'The media filename to delete. May include a subfolder path (e.g. blog/hero.jpg).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'File deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'File not found'
---

Remove a file and its `.meta.yaml` sidecar (if present) from the `user/media` directory. The filename parameter supports subfolder paths.
