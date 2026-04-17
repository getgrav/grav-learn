---
title: Rename Media Folder
template: api-endpoint
api:
    method: POST
    path: /media/folders/rename
    description: 'Rename a folder within the site-level media directory.'
    parameters: []
    request_example: |
        {
          "from": "blog/old-name",
          "to": "blog/new-name"
        }
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Folder renamed'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Source folder not found'
        - code: '422'
          description: 'Validation error or destination already exists'
---

Rename a folder within the `user/media` directory. All contents of the folder are preserved. Both `from` and `to` are relative paths from the media root.
