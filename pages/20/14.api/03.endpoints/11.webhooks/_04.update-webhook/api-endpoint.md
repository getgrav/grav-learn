---
title: Update Webhook
api:
    method: PATCH
    path: '/webhooks/{id}'
    description: 'Partial update — only supplied fields are changed. `url` is re-validated; `events` are re-validated against the allowed event list. Supports [optimistic concurrency control](/20/api/getting-started#concurrency-control) via the `If-Match` header.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
        - name: url
          type: string
          required: false
          description: 'New URL.'
        - name: events
          type: array
          required: false
          description: 'Replacement event filter.'
        - name: secret
          type: string
          required: false
          description: 'New shared secret.'
        - name: enabled
          type: boolean
          required: false
          description: 'Enable/disable the webhook without deleting it.'
    request_example: '{"enabled": false}'
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hook", "events": ["page.updated"], "secret": "grav_a****************_xyz", "enabled": false}}'
    response_codes:
        - code: '200'
          description: 'Webhook updated.'
        - code: '400'
          description: 'Invalid URL or invalid event name.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
        - code: '404'
          description: 'Webhook not found.'
        - code: '412'
          description: 'ETag mismatch.'
---
