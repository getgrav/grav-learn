---
title: Get README
api:
    method: GET
    path: '/gpm/plugins/{slug}/readme'
    description: 'Get the raw README.md content for an installed plugin or theme. Also available at `/gpm/themes/{slug}/readme`. Requires `api.gpm.read`.'
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
        - code: '403'
          description: 'Missing `api.gpm.read` permission'
        - code: '404'
          description: 'Package or README not found'
        - code: '422'
          description: 'Invalid package slug'
---

