---
title: Browse Repository Themes
api:
    method: GET
    path: '/gpm/repository/themes'
    description: 'List all themes available in the GPM repository with `installed` flag on each. Supports pagination and `q` text search. 502 if the repository is unreachable.'
    parameters:
        - name: q
          type: string
          required: false
          description: 'Search query to filter themes (matches name / slug / description).'
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Items per page (default from config; max 2000 so the install modal can fetch the full list).'
    request_example: ''
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "description": "Modern theme", "installed": true}], "meta": {"total": 120, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Repository themes returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '502'
          description: 'GPM repository unreachable.'
---
