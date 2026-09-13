---
title: Clear Cache
api:
    method: DELETE
    path: '/cache'
    description: 'Clear the system cache. Defaults to `standard` scope (the same as `bin/grav cache clear`), matching the typical "flush cache" button. Use `scope=all` to also drop images/assets caches.'
    parameters:
        - name: scope
          type: string
          required: false
          description: 'One of `all`, `standard`, `images`, `assets`, `tmp`. Defaults to `standard`.'
    request_example: ''
    response_example: '{"data": {"scope": "standard", "message": "Cache cleared successfully (scope: standard).", "details": {"cache": "cleared"}}}'
    response_codes:
        - code: '200'
          description: 'Cache cleared.'
        - code: '400'
          description: 'Invalid cache scope.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.write` permission.'
---
