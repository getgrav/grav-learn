---
title: Delete Object
api:
    method: DELETE
    path: '/flex-objects/{type}/{key}'
    description: 'Delete an object from a Flex directory. For folder-based directories this also removes the object''s folder, including any attached media.'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
        - name: key
          type: string
          required: true
          description: 'The object key.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Object deleted.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `delete` permission.'
        - code: '404'
          description: 'Directory or object not found.'
---

Returns no content on success.
