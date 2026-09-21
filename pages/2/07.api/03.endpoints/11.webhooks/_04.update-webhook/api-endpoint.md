---
title: Update Webhook
api:
    method: PATCH
    path: '/webhooks/{id}'
    description: 'Partial update: only supplied fields are changed. `url`, `events` and `headers` are validated the same way as on create. The secret can''t be changed. Re-enabling a webhook that was auto-disabled does not reset its `failure_count`; the next successful delivery does.'
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
          description: 'Replacement event filter (a JSON array of event names).'
        - name: headers
          type: object
          required: false
          description: 'Replacement custom headers. The three `X-Grav-*` headers Grav sets are refused with a 422.'
        - name: enabled
          type: boolean
          required: false
          description: 'Enable/disable the webhook without deleting it.'
    request_example: '{"url": "https://example.com/hooks/grav-v2", "events": ["page.created", "page.updated", "page.deleted"]}'
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hooks/grav-v2", "secret": "whsec_************************************************a1b2", "events": ["page.created", "page.updated", "page.deleted"], "enabled": true, "headers": {}, "created": 1774008000, "failure_count": 0}}'
    response_codes:
        - code: '200'
          description: 'Webhook updated.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
        - code: '404'
          description: 'Webhook not found.'
        - code: '422'
          description: 'Invalid `url`, `events` that is not an array of valid event names, or invalid or reserved `headers`.'
---
