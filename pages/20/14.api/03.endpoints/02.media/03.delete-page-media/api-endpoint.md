---
title: Delete Page Media
template: api-endpoint
api:
    method: DELETE
    path: '/pages/{route}/media/{filename}'
    description: 'Delete a media file from a page.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filename
          type: string
          required: true
          description: 'The media filename to delete'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'File deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page or file not found'
---

