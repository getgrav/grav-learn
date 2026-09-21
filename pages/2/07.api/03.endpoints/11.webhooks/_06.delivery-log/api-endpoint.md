---
title: Delivery Log
api:
    method: GET
    path: '/webhooks/{id}/deliveries'
    description: 'Paginated delivery log for a single webhook, newest first. Each record holds the delivery id, event, URL, the request headers and body that were sent, the response status and the first 1000 characters of the response body, the duration, a success flag, an `error` for transport failures, and the `created` Unix timestamp. Only the last 50 deliveries are kept.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Items per page (default `plugins.api.pagination.default_per_page`, 20).'
    request_example: ''
    response_example: '{"data": [{"id": "dlv_9f2c4e1a7b3d5f60", "event": "page.updated", "url": "https://example.com/hooks/grav", "request_headers": {"Content-Type": "application/json", "User-Agent": "Grav-Webhook/1.0", "X-Grav-Signature": "5d41402abc4b2a76b9719d911017c592...", "X-Grav-Event": "page.updated", "X-Grav-Delivery": "dlv_9f2c4e1a7b3d5f60"}, "request_body": {"event": "page.updated", "timestamp": "2026-09-21T12:00:00+00:00", "data": {"page": {"route": "/blog/hello", "title": "Hello", "slug": "hello"}}, "webhook_id": "wh_abc123"}, "created": 1790000000, "status_code": 200, "response_body": "ok", "duration_ms": 142, "success": true}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 1, "total_pages": 1}}, "links": {"self": "/api/v1/webhooks/wh_abc123/deliveries?page=1&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Deliveries returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.read` permission.'
        - code: '404'
          description: 'Webhook not found.'
---
