---
title: List Config Sections
api:
    method: GET
    path: /config
    description: 'List available configuration scopes.'
    parameters: []
    request_example: ''
    response_example: '{"data": ["system", "site", "media", "security"]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

