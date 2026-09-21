---
title: Delete Page Media
api:
    method: DELETE
    path: '/pages/{route}/media/{filename}'
    description: 'Delete a media file from a page.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filename
          type: string
          required: true
          description: 'The media filename to delete'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'File deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, or the page''s own rules deny update access'
        - code: '404'
          description: 'Page or file not found'
        - code: '422'
          description: 'Invalid filename (leading period or `..`)'
---

Removes the file and its `.meta.yaml` sidecar, if present. Retina variants of the file (`name@2x.jpg`, `name@3x.jpg`, and so on) and their sidecars are removed too, so an image stored only as a retina variant can still be deleted by its base name.
