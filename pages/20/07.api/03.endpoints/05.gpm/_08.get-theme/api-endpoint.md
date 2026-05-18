---
title: Get Theme
api:
    method: GET
    path: '/gpm/themes/{slug}'
    description: 'Get details for a specific installed theme, including screenshot URL, `updatable` status, and the `is_symlink` flag.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The theme slug.'
    request_example: ''
    response_example: '{"data": {"slug": "quark", "name": "Quark", "version": "2.0.0", "updatable": false, "is_symlink": false, "screenshot": "/api/v1/thumbnails/quark-screen.jpg"}}'
    response_codes:
        - code: '200'
          description: 'Theme returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Theme not installed.'
---
