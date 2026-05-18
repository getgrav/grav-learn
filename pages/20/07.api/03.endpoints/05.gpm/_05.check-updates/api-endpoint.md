---
title: Check Updates
api:
    method: GET
    path: '/gpm/updates'
    description: 'Check for available updates across plugins, themes, and the Grav core. `total` counts Grav itself as well as plugin/theme updates. The `grav` object includes `is_symlink` so admin UIs can disable the core-upgrade action when Grav is symlinked.'
    parameters:
        - name: flush
          type: boolean
          required: false
          description: 'Bypass cache and fetch fresh update data.'
    request_example: ''
    response_example: '{"data": {"total": 4, "grav": {"installed_version": "2.0.0-beta.1", "available_version": "2.0.0-beta.2", "updatable": true, "is_symlink": false}, "plugins": [{"slug": "seo-magic", "installed_version": "1.9.0", "available_version": "1.10.0"}], "themes": []}}'
    response_codes:
        - code: '200'
          description: 'Update summary returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---
