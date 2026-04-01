---
title: List Site Media
template: api-endpoint
api:
    method: GET
    path: /media
    description: 'List site-level media files with pagination.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns media files from the `user/images` directory that are not associated with any specific page.
