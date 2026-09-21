---
title: Create API Key
api:
    method: POST
    path: '/users/{username}/api-keys'
    description: 'Generate a new API key for a user. The raw key is returned only once in the response. Your own keys need `api.access`; keys for anyone else need `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to create the API key for'
        - name: name
          type: string
          required: false
          description: 'A descriptive name for the API key (default: `API Key`)'
        - name: scopes
          type: array
          required: false
          description: 'List of permission scopes for the key. An empty list means the key carries the account''s full access.'
        - name: expiry_days
          type: integer
          required: false
          description: 'Number of days until the key expires. Omit or set to null for no expiry.'
    request_example: '{"name": "CI Deploy Key", "scopes": ["api.pages.read"], "expiry_days": 90}'
    response_example: '{"data": {"id": "9f86d081884c7d65", "name": "CI Deploy Key", "prefix": "grav_1a2b3c4...", "scopes": ["api.pages.read"], "active": true, "created": 1710000000, "last_used": null, "expires": 1717776000, "api_key": "grav_1a2b3c4d5e6f..."}}'
    response_codes:
        - code: '201'
          description: 'API key created'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing permission, a non-super caller creating a key for a super admin, or a scoped key asking for a scope outside its own)'
        - code: '404'
          description: 'User not found'
---

When the request is authenticated with a scoped API key, the new key must be scoped too, and every scope it asks for must be within the calling key's own scopes.
