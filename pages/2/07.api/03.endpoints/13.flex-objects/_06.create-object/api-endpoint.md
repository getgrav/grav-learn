---
title: Create Object
api:
    method: POST
    path: '/flex-objects/{type}'
    description: 'Create a new object in a Flex directory. The request body holds the object''s field values. The new key is assigned by the directory''s storage and returned in the response and the `Location` header.'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
    request_example: '{"name": "Grace Hopper", "email": "grace@example.com"}'
    response_example: '{"data": {"key": "grace-hopper", "name": "Grace Hopper", "email": "grace@example.com"}}'
    response_codes:
        - code: '201'
          description: 'Object created. The `Location` header points to the new object.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `create` permission.'
        - code: '422'
          description: 'Validation error (the object could not be created from the supplied data).'
---

Post to the collection address (no key segment). To attach files to the object afterwards, use the **Upload Object Media** endpoint below with the key returned here.
