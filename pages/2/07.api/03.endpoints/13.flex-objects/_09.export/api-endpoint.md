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
          description: 'Missing the directory''s `read` permission.'
        - code: '404'
          description: 'Directory type not found or not enabled, or export is not enabled for the directory.'
---

Export only works for directories whose blueprint sets `admin.export.enabled`; the built-in user accounts, groups and pages directories don't, and return `404`. Because it returns every field of every object, it needs the directory's `read` permission, not just `list`.

The response is `application/x-yaml` with a filename like `contacts-YYYY-MM-DD.yaml`, not the standard JSON envelope.
