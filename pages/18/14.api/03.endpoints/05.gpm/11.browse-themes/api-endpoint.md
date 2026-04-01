---
title: Browse Themes
template: api-endpoint
api:
    method: GET
    path: /gpm/repository/themes
    description: 'Browse available themes from the GPM repository with pagination and search.'
    parameters:
        - name: q
          type: string
          required: false
          description: 'Search query to filter themes'
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
    request_example: ''
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "description": "Modern theme", "installed": true}], "meta": {"total": 120, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '502'
          description: 'Unable to reach GPM repository'
---

