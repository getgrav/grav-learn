---
title: Remove Package
api:
    method: POST
    path: /gpm/remove
    description: 'Remove an installed plugin or theme. Requires `api.gpm.write`. Fires `onApiBeforePackageRemove` and `onApiPackageRemoved`.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to remove'
    request_example: '{"package": "sitemap"}'
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Package removed'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.gpm.write` permission'
        - code: '404'
          description: 'Package not installed'
        - code: '422'
          description: 'Missing `package` field'
        - code: '500'
          description: 'Removal failed. The error message is plain text, with GPM''s console colour codes removed.'
---

