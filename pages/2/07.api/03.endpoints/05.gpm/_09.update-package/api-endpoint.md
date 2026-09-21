---
title: Update Package
api:
    method: POST
    path: /gpm/update
    description: 'Update a specific installed plugin or theme to the latest version, installing or updating any dependencies it needs first. Requires `api.gpm.write`. Fires `onApiBeforePackageUpdate` and `onApiPackageUpdated`.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to update'
    request_example: '{"package": "form"}'
    response_example: '{"data": {"message": "Package ''form'' updated successfully.", "package": "form", "type": "plugin", "dependencies": []}}'
    response_codes:
        - code: '200'
          description: 'Package updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.gpm.write` permission'
        - code: '404'
          description: 'Package not installed'
        - code: '422'
          description: 'Package already up to date, or a dependency/requirement check failed'
        - code: '500'
          description: 'Update failed. The message names any dependencies that were installed before the failure.'
---

