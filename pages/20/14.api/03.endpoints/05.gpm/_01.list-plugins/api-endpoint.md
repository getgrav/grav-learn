---
title: List Plugins
api:
    method: GET
    path: '/gpm/plugins'
    description: 'List all installed plugins with enablement flags, update status, and whether each plugin is installed via a symlink (important for upgrade gating — symlinked packages should not be overwritten).'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "admin2", "name": "Admin2", "version": "3.0.0-beta.1", "enabled": true, "is_symlink": false, "updatable": false}]}'
    response_codes:
        - code: '200'
          description: 'Plugins returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---
