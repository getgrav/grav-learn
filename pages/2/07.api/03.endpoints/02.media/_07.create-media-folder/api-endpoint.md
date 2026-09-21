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
    response_example: '{"data": {"name": "2026", "path": "blog/2026", "children_count": 0, "file_count": 0}}'
    response_codes:
        - code: '201'
          description: 'Folder created'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '422'
          description: 'Validation error or folder already exists'
---

Create a new folder in the `user/media` directory. Parent directories are created automatically. The request body must include a `path` property with the relative folder path to create. No path segment may start with a period or be `..`. The `Location` header points at the new folder's listing (`/media?path=...`).
