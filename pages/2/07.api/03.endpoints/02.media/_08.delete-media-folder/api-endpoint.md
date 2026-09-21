---
title: Delete Media Folder
api:
    method: DELETE
    path: '/media/folders/{path}'
    description: 'Delete an empty folder from the site-level media directory.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'Folder path relative to the media root'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Folder deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'Folder not found'
        - code: '422'
          description: 'Folder is not empty, or the path is invalid'
---

Remove an empty folder from the `user/media` directory. The folder must contain no files or subdirectories, and that includes hidden files, `.meta.yaml` sidecars and a `media_order.yaml` order file.
