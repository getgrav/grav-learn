---
title: Get Plugin
api:
    method: GET
    path: '/gpm/plugins/{slug}'
    description: 'Get details for a single installed plugin, including `enabled`, `updatable`, `installed_version`, `available_version`, and the `is_symlink` flag.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The plugin slug.'
    request_example: ''
    response_example: '{"data": {"slug": "simplesearch", "name": "SimpleSearch", "enabled": true, "is_symlink": false, "installed_version": "2.3.0", "available_version": "2.4.0", "updatable": true}}'
    response_codes:
        - code: '200'
          description: 'Plugin returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Plugin not found.'
---
