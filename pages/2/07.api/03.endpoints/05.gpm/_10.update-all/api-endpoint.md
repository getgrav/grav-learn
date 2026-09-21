---
title: Update All Packages
api:
    method: POST
    path: '/gpm/update-all'
    description: 'Update every updatable plugin and theme in one request, using fresh repository data. Each package is attempted independently — one failure does not abort the batch. Requires `api.gpm.write`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"updated": ["simplesearch", "seo-magic"], "failed": [{"package": "broken-plugin", "error": "Dependency unmet"}], "skipped": [{"package": "form", "reason": "already up to date (installed as a dependency)"}], "cascaded_dependencies": ["form"]}}'
    response_codes:
        - code: '200'
          description: 'Batch completed; per-package outcome in `updated[]` / `failed[]` / `skipped[]`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
---

The response has four arrays:

- `updated`: slugs that were updated.
- `failed`: objects with `package` and `error` for packages whose requirements weren't met or whose update failed.
- `skipped`: objects with `package` and `reason` for packages already brought up to date as a dependency of an earlier package in the batch.
- `cascaded_dependencies`: slugs installed or updated as dependencies along the way.
