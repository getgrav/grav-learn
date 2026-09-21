---
title: Clear Cache
api:
    method: DELETE
    path: '/cache'
    description: 'Clear the system cache. Defaults to `standard` scope (the same as `bin/grav cache clear`), matching the typical "flush cache" button. Use `scope=all` to also drop images/assets caches. Requires `api.system.write`.'
    parameters:
        - name: scope
          type: string
          required: false
          description: 'One of `all`, `standard`, `images`, `assets`, `tmp`. Defaults to `standard`. `images`, `assets` and `tmp` clear only that folder.'
    request_example: ''
    response_example: '{"data": {"scope": "standard", "message": "Cache cleared successfully (scope: standard).", "details": ["Cleared:  /var/www/grav/cache/*"]}}'
    response_codes:
        - code: '200'
          description: 'Cache cleared.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.write` permission.'
        - code: '422'
          description: 'Invalid cache scope.'
---

`details` is the list of per-folder result lines from Grav's cache clear.
