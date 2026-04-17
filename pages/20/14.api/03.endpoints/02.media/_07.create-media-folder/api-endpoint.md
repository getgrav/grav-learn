---
title: Create Media Folder
api:
    method: POST
    path: /media/folders
    description: 'Create a new folder in the site-level media directory.'
    parameters: []
    request_example: |
        {
          "path": "blog/2026"
        }
    response_example: ''
    response_codes:
        - code: '201'
          description: 'Folder created'
        - code: '401'
          description: 'Unauthorized'
        - code: '422'
          description: 'Validation error or folder already exists'
---

Create a new folder in the `user/media` directory. Parent directories are created automatically. The request body must include a `path` property with the relative folder path to create.
