---
title: Ping
api:
    method: GET
    path: /ping
    description: 'Lightweight health check. This is a public route: no credentials are needed and no permission is checked, so it only confirms the API is reachable.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"pong": true}}'
    response_codes:
        - code: '200'
          description: 'Success'
---

