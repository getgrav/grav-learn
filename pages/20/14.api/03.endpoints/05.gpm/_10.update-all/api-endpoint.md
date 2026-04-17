---
title: Update All Packages
api:
    method: POST
    path: '/gpm/update-all'
    description: 'Update every updatable plugin and theme in one request. Each package is attempted independently — one failure does not abort the batch. Returns two arrays: `updated` (slugs that succeeded) and `failed` (objects with `package` and `error`). Fires `onApiBeforePackageUpdate` / `onApiPackageUpdated` for each package.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"updated": ["simplesearch", "seo-magic"], "failed": [{"package": "broken-plugin", "error": "Dependency unmet"}]}}'
    response_codes:
        - code: '200'
          description: 'Batch completed; per-package outcome in `updated[]` / `failed[]`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
---
