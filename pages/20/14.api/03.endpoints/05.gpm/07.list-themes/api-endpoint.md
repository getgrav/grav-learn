---
title: List Themes
template: api-endpoint
api:
    method: GET
    path: /gpm/themes
    description: 'List all installed themes with thumbnail URLs and update status.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "version": "2.0.0", "updatable": false, "thumbnail": "/api/v1/thumbnails/quark-thumb.jpg"}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

