---
title: Get Webhook
api:
    method: GET
    path: '/webhooks/{id}'
    description: 'Get a single webhook by id. Secret is redacted. Returns an ETag; use `If-None-Match` for conditional fetching.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
    request_example: ''
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hook", "events": ["page.updated"], "secret": "grav_a****************_xyz", "enabled": true}}'
    response_codes:
        - code: '200'
          description: 'Webhook returned.'
        - code: '304'
          description: 'Not modified (ETag match).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.read` permission.'
        - code: '404'
          description: 'Webhook not found.'
---
