---
title: Delete Object Media
api:
    method: DELETE
    path: '/flex-objects/{type}/{key}/media/{filename}'
    description: 'Delete a single media file from an object''s folder (along with any `.meta.yaml` sidecar).'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
        - name: key
          type: string
          required: true
          description: 'The object key.'
        - name: filename
          type: string
          required: true
          description: 'The media filename to delete.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'File deleted.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `update` permission.'
        - code: '404'
          description: 'Directory, object, or file not found.'
        - code: '422'
          description: 'The directory has no per-object media folder (single-file storage).'
---

Returns no content on success.
