---
title: Get Webhook
api:
    method: GET
    path: '/webhooks/{id}'
    description: 'Get a single webhook by id. The secret is redacted. The response carries an `ETag` header.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
    request_example: ''
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hooks/grav", "secret": "whsec_************************************************a1b2", "events": ["page.created", "page.updated"], "enabled": true, "headers": {}, "created": 1774008000, "failure_count": 0}}'
    response_codes:
        - code: '200'
          description: 'Webhook returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.read` permission.'
        - code: '404'
          description: 'Webhook not found.'
---
