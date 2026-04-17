---
title: Get Theme
template: api-endpoint
api:
    method: GET
    path: '/gpm/themes/{slug}'
    description: 'Get details for a specific installed theme including screenshot URL and update status.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The theme slug'
    request_example: ''
    response_example: '{"data": {"slug": "quark", "name": "Quark", "version": "2.0.0", "updatable": false, "screenshot": "/api/v1/thumbnails/quark-screen.jpg"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Theme not installed'
---

