---
title: Ping
api:
    method: GET
    path: /ping
    description: 'Lightweight health check and keep-alive endpoint. Validates the authentication token and returns a minimal response.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"pong": true}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

