---
title: Upload Page Media
api:
    method: POST
    path: '/pages/{route}/media'
    description: 'Upload file(s) to a page via multipart form data.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: file
          type: file
          required: true
          description: 'File to upload (multipart/form-data)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '201'
          description: 'File uploaded'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
        - code: '422'
          description: 'Validation error (invalid file type or size)'
---

Send the file as a `multipart/form-data` request rather than JSON. The `Content-Type` header should be set to `multipart/form-data`.
