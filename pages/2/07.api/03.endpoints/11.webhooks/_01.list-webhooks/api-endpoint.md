---
title: List Webhooks
api:
    method: GET
    path: '/webhooks'
    description: 'List all configured webhooks. Secrets are redacted (first 6 and last 4 characters kept, the middle masked).'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "wh_abc123", "url": "https://example.com/hooks/grav", "secret": "whsec_************************************************a1b2", "events": ["page.created", "page.updated"], "enabled": true, "headers": {}, "created": 1774008000, "failure_count": 0}]}'
    response_codes:
        - code: '200'
          description: 'Webhooks returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.read` permission.'
---
