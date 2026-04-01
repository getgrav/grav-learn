---
title: List API Keys
template: api-endpoint
api:
    method: GET
    path: '/users/{username}/api-keys'
    description: 'List all API keys for a user. Key secrets are not returned.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to list API keys for'
    request_example: ''
    response_example: '{"data": [{"id": "abc123", "name": "CI Deploy Key", "scopes": [], "created": 1710000000}]}'
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

