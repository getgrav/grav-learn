---
title: Get Changelog
template: api-endpoint
api:
    method: GET
    path: '/gpm/plugins/{slug}/changelog'
    description: 'Get the CHANGELOG.md content for an installed plugin or theme. Also available at /gpm/themes/{slug}/changelog.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The package slug'
    request_example: ''
    response_example: '{"data": {"content": "# v1.2.0\n## 01/15/2025\n\n* Added feature X..."}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Package or changelog not found'
---

