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
        - code: '404'
          description: 'Folder not found'
        - code: '422'
          description: 'Folder is not empty'
---

Remove an empty folder from the `user/media` directory. The folder must contain no files or subdirectories.
