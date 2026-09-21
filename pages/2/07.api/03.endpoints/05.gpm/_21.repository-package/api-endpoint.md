---
title: Get Repository Package
api:
    method: GET
    path: '/gpm/repository/{slug}'
    description: 'Get full repository details for a plugin or theme (whichever matches the slug), plus an `installed` flag. Requires `api.gpm.read`.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Package slug.'
    request_example: ''
    response_example: '{"data": {"slug": "simplesearch", "name": "SimpleSearch", "version": "3.0.1", "type": "plugin", "description": "A simple search plugin for Grav.", "description_html": "<p>A simple search plugin for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-simplesearch", "keywords": ["search", "plugin"], "installed": true}}'
    response_codes:
        - code: '200'
          description: 'Package found.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Package not found in the GPM repository.'
---
