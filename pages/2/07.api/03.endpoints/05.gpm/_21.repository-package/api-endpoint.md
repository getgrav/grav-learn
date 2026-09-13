---
title: Get Repository Package
api:
    method: GET
    path: '/gpm/repository/{slug}'
    description: 'Get full repository details for a plugin or theme (whichever matches the slug), plus an `installed` flag.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Package slug.'
    request_example: ''
    response_example: '{"data": {"slug": "simplesearch", "name": "SimpleSearch", "version": "2.4.0", "description": "...", "author": {"name": "Trilby Media"}, "installed": false}}'
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
