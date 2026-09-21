---
title: Search Repository
api:
    method: GET
    path: /gpm/search
    description: 'Search the GPM repository for plugins and themes. Plugins are listed before themes, and each result carries an `installed` flag. Requires `api.gpm.read`.'
    parameters:
        - name: q
          type: string
          required: true
          description: 'Search query string, matched against name, slug and description'
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 1000)'
    request_example: ''
    response_example: '{"data": [{"slug": "simplesearch", "name": "SimpleSearch", "version": "3.0.1", "type": "plugin", "description": "A simple search plugin for Grav.", "description_html": "<p>A simple search plugin for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-simplesearch", "installed": true}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 1, "total_pages": 1}}, "links": {"self": "/api/v1/gpm/search?page=1&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.gpm.read` permission'
        - code: '422'
          description: 'Missing `q` parameter'
---

