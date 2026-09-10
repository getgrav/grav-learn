---
title: Test Webhook
api:
    method: POST
    path: '/webhooks/{id}/test'
    description: 'Send a synthetic test payload to the webhook URL and return the delivery result immediately. Use this to verify endpoint reachability + signature verification without waiting for a real event. Returns 502 (with the delivery object in the body) if the remote returns an error status or cannot be reached.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
    request_example: ''
    response_example: '{"data": {"event": "webhook.test", "url": "https://example.com/hook", "status_code": 200, "success": true, "duration_ms": 118, "delivered_at": "2026-04-17T12:00:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'Test delivered successfully.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
        - code: '404'
          description: 'Webhook not found.'
        - code: '502'
          description: 'Test delivery failed; see `data` for details.'
---
