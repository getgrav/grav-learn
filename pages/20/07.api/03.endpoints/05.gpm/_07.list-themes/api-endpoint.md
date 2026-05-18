---
title: List Themes
api:
    method: GET
    path: '/gpm/themes'
    description: 'List all installed themes with thumbnail URLs, update status, and the `is_symlink` flag.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "version": "2.0.0", "updatable": false, "is_symlink": false, "thumbnail": "/api/v1/thumbnails/quark-thumb.jpg"}]}'
    response_codes:
        - code: '200'
          description: 'Themes returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---
