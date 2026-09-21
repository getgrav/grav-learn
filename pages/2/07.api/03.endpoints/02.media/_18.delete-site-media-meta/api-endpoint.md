---
title: Delete Site Media Metadata
api:
    method: DELETE
    path: /media/meta
    description: 'Clear the editable metadata of a site-level media file.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'Query parameter: file path relative to the media root (e.g. blog/hero.jpg)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Metadata cleared'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'File not found'
        - code: '422'
          description: 'Missing or invalid `path`'
---

Removes every configured metadata field from the file's `.meta.yaml` sidecar. Other keys are kept, and the sidecar file is deleted only when nothing else is left in it. The media file itself is not touched.
