---
title: List API Keys
api:
    method: GET
    path: '/users/{username}/api-keys'
    description: 'List all API keys for a user. Key secrets are not returned. Your own keys need `api.access`; anyone else''s need `api.users.read`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to list API keys for'
    request_example: ''
    response_example: '{"data": [{"id": "9f86d081884c7d65", "name": "CI Deploy Key", "prefix": "grav_1a2b3c4...", "scopes": [], "active": true, "created": 1710000000, "last_used": null, "expires": 1717776000}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'User not found'
---

`created`, `last_used` and `expires` are Unix timestamps; `expires` is `null` for a key that never expires.
