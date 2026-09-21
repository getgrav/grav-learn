---
title: Get Object
api:
    method: GET
    path: '/flex-objects/{type}/{key}'
    description: 'Fetch a single object by key, returning its full serialized data. The response carries an `ETag` you can use for optimistic concurrency on update.'
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
    response_example: '{"data": {"key": "ada", "__meta": {"type": "contacts", "key": "ada", "storageKey": "ada", "storagePath": "user-data://flex-objects/contacts/ada"}, "name": "Ada Lovelace", "email": "ada@example.com"}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `read` permission.'
        - code: '404'
          description: 'Directory or object not found.'
---

Keep the returned `ETag` and send it back as an `If-Match` header when updating, so a concurrent change is detected instead of silently overwritten.

The reserved `__meta` object is read-only information for the admin (the object's type, key, storage key and, when known, its storage folder). It is never saved: create and update strip it from the request body.
