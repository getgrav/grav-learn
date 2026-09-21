---
title: Browse Repository Themes
api:
    method: GET
    path: '/gpm/repository/themes'
    description: 'List all themes available in the GPM repository with `installed` flag on each. Supports pagination and `q` text search. 502 if the repository is unreachable. Requires `api.gpm.read`.'
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
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "version": "2.0.4", "type": "theme", "description": "Quark is the default theme for Grav.", "description_html": "<p>Quark is the default theme for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-theme-quark", "screenshot": "https://getgrav.org/images/quark-screenshot.jpg", "installed": true}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 120, "total_pages": 6}}, "links": {"self": "/api/v1/gpm/repository/themes?page=1&per_page=20", "next": "/api/v1/gpm/repository/themes?page=2&per_page=20", "last": "/api/v1/gpm/repository/themes?page=6&per_page=20"}}'
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

In repository results `version` is the latest version in the repository and `screenshot` is the full URL of the repository screenshot. Premium themes add `premium`, `licensed`, and when known `vendor` and `purchase_url`.
