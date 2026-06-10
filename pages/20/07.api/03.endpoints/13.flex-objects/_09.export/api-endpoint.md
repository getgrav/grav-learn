---
title: Export Directory
api:
    method: GET
    path: '/flex-objects/{type}/export'
    description: 'Export every object in a directory as a single YAML document, returned as a file download (keyed by object key).'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'YAML file download (`Content-Disposition: attachment`).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `list` permission.'
        - code: '404'
          description: 'Directory type not found or not enabled.'
---

The response is `application/x-yaml` with a filename like `contacts-YYYY-MM-DD.yaml`, not the standard JSON envelope.
