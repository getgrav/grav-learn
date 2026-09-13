---
title: Upgrade Grav Core
api:
    method: POST
    path: '/gpm/upgrade'
    description: 'Self-upgrade the Grav core. Refuses to run when Grav is installed via symlink (typical dev/monorepo setups). Fires `onApiBeforeGravUpgrade` and `onApiGravUpgraded` around the upgrade.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"message": "Grav upgraded successfully.", "previous_version": "2.0.0-beta.1", "new_version": "2.0.0-beta.2"}}'
    response_codes:
        - code: '200'
          description: 'Core upgraded.'
        - code: '400'
          description: 'Grav is already at the latest version, or installed via symlink.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
        - code: '500'
          description: 'Upgrade failed mid-flight.'
---
