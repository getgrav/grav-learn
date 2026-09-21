---
title: Rename Media Folder
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
    response_example: '{"data": {"name": "new-name", "path": "blog/new-name", "children_count": 2, "file_count": 14}}'
    response_codes:
        - code: '200'
          description: 'Folder renamed'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'Source folder not found'
        - code: '422'
          description: 'Validation error or destination already exists'
---

Rename a folder within the `user/media` directory. All contents of the folder are preserved. Both `from` and `to` are relative paths from the media root.

The response carries the renamed folder's real `children_count` (subfolders) and `file_count` (media files, not counting sidecars or the order file), the same counts the folder listing reports, so a client can update the entry without fetching the listing again.
