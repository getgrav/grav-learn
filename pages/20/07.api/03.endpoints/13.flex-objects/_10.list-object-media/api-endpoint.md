---
title: List Object Media
api:
    method: GET
    path: '/flex-objects/{type}/{key}/media'
    description: 'List the media files attached to a single object. For folder-based directories these live in the object''s own storage folder, alongside its data file.'
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
    response_example: '{"data": [{"filename": "avatar.png", "type": "image/png", "size": 20480, "url": "/user/data/flex-objects/contacts/ada/avatar.png"}]}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `read` permission.'
        - code: '404'
          description: 'Directory or object not found.'
        - code: '422'
          description: 'The directory has no per-object media folder (it uses single-file storage).'
---

Object media requires folder-based storage (one folder per object, e.g. `user-data://flex-objects/contacts/{id}`). Directories that keep all records in a single shared file have nowhere to store per-object files, and the endpoint returns `422`.
