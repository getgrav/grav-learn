---
title: Revoke API Key
template: api-endpoint
api:
    method: DELETE
    path: '/users/{username}/api-keys/{keyId}'
    description: 'Revoke and delete an API key.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username who owns the API key'
        - name: keyId
          type: string
          required: true
          description: 'The ID of the API key to revoke'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'API key revoked'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'API key not found'
---

