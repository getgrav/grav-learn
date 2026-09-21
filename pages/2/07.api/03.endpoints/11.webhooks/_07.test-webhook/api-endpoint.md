---
title: Test Webhook
api:
    method: POST
    path: '/webhooks/{id}/test'
    description: 'Send a test delivery (event `test`, with `data.message` set to `This is a test webhook delivery.`) to the webhook URL and return the delivery record immediately. It is signed and logged like a real delivery, and a failed test counts toward the 5-failure auto-disable like one. Use this to check that the endpoint is reachable and verifies the signature without waiting for a real event. Returns 502, with the same delivery record in the body, if the receiver answers with a non-2xx status or can''t be reached.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
    request_example: ''
    response_example: '{"data": {"id": "dlv_1a2b3c4d5e6f7a8b", "event": "test", "url": "https://example.com/hooks/grav", "request_headers": {"Content-Type": "application/json", "User-Agent": "Grav-Webhook/1.0", "X-Grav-Signature": "5d41402abc4b2a76b9719d911017c592...", "X-Grav-Event": "test", "X-Grav-Delivery": "dlv_1a2b3c4d5e6f7a8b"}, "request_body": {"event": "test", "timestamp": "2026-09-21T12:00:00+00:00", "data": {"message": "This is a test webhook delivery."}, "webhook_id": "wh_abc123"}, "created": 1790000000, "status_code": 200, "response_body": "ok", "duration_ms": 118, "success": true}}'
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
          description: 'Test delivery failed; the body holds the delivery record with `success: false`.'
---
