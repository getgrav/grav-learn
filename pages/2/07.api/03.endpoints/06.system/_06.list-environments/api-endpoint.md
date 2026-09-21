---
title: List Environments
api:
    method: GET
    path: /system/environments
    description: 'List the environments that can be chosen as configuration write targets, plus the environment Grav detected for this request. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"detected": "localhost", "environments": [{"name": "", "label": "Default", "exists": true, "hasOverrides": false}, {"name": "staging.example.com", "label": "staging.example.com", "exists": true, "hasOverrides": true}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

The first entry is always the base configuration (`user/config`), with `name: ""` and `label: "Default"`; its `hasOverrides` is always `false`. Every other entry is an existing `user/env/<name>/` folder, and legacy `user/<host>/config/` layouts are included too. `hasOverrides` says whether the environment holds any configuration files.
