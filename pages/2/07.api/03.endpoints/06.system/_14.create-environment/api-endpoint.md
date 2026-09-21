---
title: Create Environment
api:
    method: POST
    path: /system/environments
    description: 'Create an empty environment folder at `user/env/<name>/config`, which can then be chosen as a configuration write target. Requires `api.config.write`.'
    parameters:
        - name: name
          type: string
          required: true
          description: 'Environment name, usually a hostname. It must start with a letter or digit and contain only letters, digits, `.`, `_` and `-`. `default` and `base` are reserved.'
    request_example: '{"name": "staging.example.com"}'
    response_example: '{"data": {"name": "staging.example.com", "label": "staging.example.com", "exists": true, "hasOverrides": false}}'
    response_codes:
        - code: '201'
          description: 'Environment created'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.write` permission'
        - code: '422'
          description: 'Invalid or reserved name, or the environment already exists'
---
