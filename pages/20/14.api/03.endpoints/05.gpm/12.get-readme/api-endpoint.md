---
title: Get README
template: api-endpoint
api:
    method: GET
    path: '/gpm/plugins/{slug}/readme'
    description: 'Get the README.md content for an installed plugin or theme. Also available at /gpm/themes/{slug}/readme.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The package slug'
    request_example: ''
    response_example: '{"data": {"content": "# My Plugin\n\nThis plugin does..."}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Package or README not found'
---

