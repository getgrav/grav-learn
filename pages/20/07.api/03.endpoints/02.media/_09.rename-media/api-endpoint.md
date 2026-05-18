---
title: Rename Site Media
api:
    method: POST
    path: /media/rename
    description: 'Rename or move a media file within the site-level media directory.'
    parameters: []
    request_example: |
        {
          "from": "blog/hero.jpg",
          "to": "blog/banner.jpg"
        }
    response_example: ''
    response_codes:
        - code: '200'
          description: 'File renamed'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Source file not found'
        - code: '422'
          description: 'Validation error or destination already exists'
---

Rename a file or move it to a different folder within `user/media`. Both `from` and `to` are relative paths. The destination directory is created automatically if needed. Any `.meta.yaml` sidecar file is also moved.
