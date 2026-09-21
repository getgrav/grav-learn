---
title: Get Grav Changelog
api:
    method: GET
    path: '/gpm/grav/changelog'
    description: 'Get the Grav core changelog for every release newer than the installed version, joined into one Markdown document with a `# v{version} ({date})` heading per release. `content` is an empty string when Grav is up to date. Requires `api.gpm.read`.'
    parameters:
        - name: flush
          type: boolean
          required: false
          description: 'Refresh the cached GPM repository data first.'
    request_example: ''
    response_example: '{"data": {"content": "# v2.1.1 (09/18/2026)\n\n1. [](#bugfix)\n    * Fixed ..."}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.gpm.read` permission'
---

