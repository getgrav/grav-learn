---
title: Create Webhook
api:
    method: POST
    path: '/webhooks'
    description: 'Register a new webhook. The URL must be an absolute `http` or `https` URL that does not resolve to a private or reserved address. Events (if supplied) must come from the allowed list (see the chapter intro). The server generates the webhook id and its signing secret; the response is the only time the full secret is returned.'
    parameters:
        - name: url
          type: string
          required: true
          description: 'Absolute HTTP(S) URL to POST payloads to.'
        - name: events
          type: array
          required: false
          description: 'Event filter, as a JSON array of event names. Use `["*"]` to receive every event, or list specific events. Defaults to `["*"]`. Anything other than an array of valid names is a 422.'
        - name: headers
          type: object
          required: false
          description: 'Custom headers to send with every delivery, as an object of header names to values. `X-Grav-Signature`, `X-Grav-Event` and `X-Grav-Delivery` (in any letter case) are refused with a 422, as are names or values containing line breaks.'
        - name: enabled
          type: boolean
          required: false
          description: 'Defaults to true.'
    request_example: '{"url": "https://example.com/hooks/grav", "events": ["page.created", "page.updated"], "enabled": true}'
    response_example: '{"data": {"id": "wh_abc123", "url": "https://example.com/hooks/grav", "secret": "whsec_0123456789abcdef0123456789abcdef0123456789abcdef", "events": ["page.created", "page.updated"], "enabled": true, "headers": {}, "created": 1774526400, "failure_count": 0}}'
    response_codes:
        - code: '201'
          description: 'Webhook created; Location header points to the new webhook.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
        - code: '422'
          description: 'Missing or invalid `url` (bad syntax, not http/https, or a private or reserved address), `events` that is not an array of valid event names, or invalid or reserved `headers`.'
---
