---
title: List Repository Plugins
api:
    method: GET
    path: '/gpm/repository/plugins'
    description: 'List all plugins available in the GPM repository, with `installed` flag on each. Supports pagination (`page`, `per_page` — capped at 2000 so the install modal can fetch the full list) and `q` text search. 502 if the repository is unreachable.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Items per page (default from config; max 2000).'
        - name: q
          type: string
          required: false
          description: 'Search filter matched against name / slug / description.'
    request_example: ''
    response_example: '{"data": [{"slug": "simplesearch", "name": "SimpleSearch", "version": "2.4.0", "installed": true, "installed_version": "2.3.0"}], "meta": {"total": 250, "page": 1, "per_page": 50}}'
    response_codes:
        - code: '200'
          description: 'Repository plugins returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '502'
          description: 'GPM repository unreachable.'
---
