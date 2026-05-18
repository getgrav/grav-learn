---
title: List Webhooks
api:
    method: GET
    path: '/webhooks'
    description: 'List all configured webhooks. Secrets are redacted (first 6 + last 4 chars, middle masked).'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "wh_abc123", "url": "https://example.com/hook", "events": ["page.created", "page.updated"], "secret": "grav_a****************_xyz", "enabled": true}]}'
    response_codes:
        - code: '200'
          description: 'Webhooks returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.read` permission.'
---
