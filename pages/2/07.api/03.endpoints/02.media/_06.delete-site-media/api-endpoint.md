---
title: Delete Site Media
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
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'File not found'
        - code: '422'
          description: 'Invalid filename (a path segment is empty, starts with a period, or is `..`)'
---

Remove a file and its `.meta.yaml` sidecar (if present) from the `user/media` directory, and drop it from the folder's manual order. The filename parameter supports subfolder paths.
