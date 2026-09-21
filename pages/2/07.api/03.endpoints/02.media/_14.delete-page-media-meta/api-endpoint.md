---
title: Delete Page Media Metadata
api:
    method: DELETE
    path: '/pages/{route}/media/{filename}/meta'
    description: 'Clear the editable metadata of a page media file.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filename
          type: string
          required: true
          description: 'The media filename'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Metadata cleared'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, or the page''s own rules deny update access'
        - code: '404'
          description: 'Page or file not found'
        - code: '422'
          description: 'Invalid filename (leading period or `..`)'
---

Removes every configured metadata field from the file's `.meta.yaml` sidecar. Other keys, such as EXIF data or dimensions, are kept, and the sidecar file is deleted only when nothing else is left in it. The media file itself is not touched.
