---
title: Check Updates
api:
    method: GET
    path: '/gpm/updates'
    description: 'Check for available updates across plugins, themes, and the Grav core. Only packages with an update are listed. `total` counts Grav itself as well as plugin/theme updates. The `grav` object includes `is_symlink` so admin UIs can disable the core-upgrade action when Grav is symlinked. Requires `api.gpm.read`.'
    parameters:
        - name: flush
          type: boolean
          required: false
          description: 'Refresh the cached GPM repository data before checking.'
    request_example: ''
    response_example: '{"data": {"grav": {"current": "2.1.0", "available": "2.1.1", "updatable": true, "date": "2026-09-18", "is_symlink": false}, "plugins": [{"slug": "form", "name": "Form", "version": "8.1.0", "type": "plugin", "description": "Enables forms handling and processing.", "description_html": "<p>Enables forms handling and processing.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-form", "enabled": true, "is_symlink": false, "available_version": "8.1.1", "updatable": true}], "themes": [], "total": 2, "installed": 14}}'
    response_codes:
        - code: '200'
          description: 'Update summary returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---

In `grav`, `current` is the installed version and `available` the latest in the repository (`null` when the repository could not be read). In `plugins` and `themes`, each entry is a package object where `version` is the installed version and `available_version` the new one. `installed` is the number of installed plugins and themes combined.
