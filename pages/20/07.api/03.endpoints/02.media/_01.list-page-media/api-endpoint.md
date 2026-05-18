---
title: List Page Media
api:
    method: GET
    path: '/pages/{route}/media'
    description: 'List all media files for a page.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
    request_example: ''
    response_example: '{"data": [{"filename": "photo.jpg", "url": "/user/pages/blog/photo.jpg", "type": "image/jpeg", "size": 245000}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
---

