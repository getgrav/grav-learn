---
title: List Repository Plugins
api:
    method: GET
    path: '/gpm/repository/plugins'
    description: 'List all plugins available in the GPM repository, with `installed` flag on each. Supports pagination (`page`, `per_page` — capped at 2000 so the install modal can fetch the full list) and `q` text search. 502 if the repository is unreachable. Requires `api.gpm.read`.'
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
    response_example: '{"data": [{"slug": "simplesearch", "name": "SimpleSearch", "version": "3.0.1", "type": "plugin", "description": "A simple search plugin for Grav.", "description_html": "<p>A simple search plugin for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-simplesearch", "keywords": ["search", "plugin"], "installed": true}], "meta": {"pagination": {"page": 1, "per_page": 50, "total": 250, "total_pages": 5}}, "links": {"self": "/api/v1/gpm/repository/plugins?page=1&per_page=50", "next": "/api/v1/gpm/repository/plugins?page=2&per_page=50", "last": "/api/v1/gpm/repository/plugins?page=5&per_page=50"}}'
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

In repository results `version` is the latest version in the repository. To compare with what is installed, use [List Plugins](/2/api/endpoints/gpm/list-plugins) or [Check Updates](/2/api/endpoints/gpm/check-updates). Premium plugins add `premium`, `licensed`, and when known `vendor` and `purchase_url`.
