---
title: Create Webhook
api:
    method: POST
    path: '/webhooks'
    description: 'Register a new webhook. URL is validated as a syntactically correct absolute URL. Events (if supplied) must come from the allowed list (see chapter intro). The response includes the generated webhook id and the full, un-redacted secret — this is the only time the secret is returned in full.'
    parameters:
        - name: url
          type: string
          required: true
          description: 'Absolute HTTP(S) URL to POST payloads to.'
        - name: events
          type: array
          required: false
          description: 'Event filter. Use `["*"]` to receive every event, or list specific events. Defaults to all.'
        - name: secret
          type: string
          required: false
          description: 'Shared secret used to sign request bodies (HMAC-SHA256 sent as `X-Hub-Signature-256`). A random one is generated if omitted.'
        - name: enabled
          type: boolean
          required: false
          description: 'Defaults to true.'
    request_example: '{"url": "https://example.com/hook", "events": ["page.updated", "page.deleted"]}'
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hook", "events": ["page.updated", "page.deleted"], "secret": "grav_abcdef1234567890", "enabled": true}}'
    response_codes:
        - code: '201'
          description: 'Webhook created; Location header points to the new webhook.'
        - code: '400'
          description: 'Missing `url`, invalid URL, or invalid event name.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
---
