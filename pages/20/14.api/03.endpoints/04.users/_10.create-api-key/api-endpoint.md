---
title: Create API Key
api:
    method: POST
    path: '/users/{username}/api-keys'
    description: 'Generate a new API key for a user. The raw key is returned only once in the response.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to create the API key for'
        - name: name
          type: string
          required: false
          description: 'A descriptive name for the API key'
        - name: scopes
          type: array
          required: false
          description: 'List of permission scopes for the key'
        - name: expiry_days
          type: integer
          required: false
          description: 'Number of days until the key expires. Omit or set to null for no expiry.'
    request_example: '{"name": "CI Deploy Key", "scopes": [], "expiry_days": 90}'
    response_example: '{"data": {"id": "abc123", "name": "CI Deploy Key", "api_key": "grav_...", "scopes": [], "created": 1710000000}}'
    response_codes:
        - code: '201'
          description: 'API key created'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'User not found'
---

