---
title: Delivery Log
api:
    method: GET
    path: '/webhooks/{id}/deliveries'
    description: 'Paginated delivery log for a single webhook. Each record contains the event, outgoing URL, HTTP response status, duration, success flag, and timestamps. Useful for debugging webhook failures.'
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
          description: 'Items per page.'
    request_example: ''
    response_example: '{"data": [{"event": "page.updated", "url": "https://example.com/hook", "status_code": 200, "success": true, "duration_ms": 142, "delivered_at": "2026-04-17T12:00:00+00:00"}], "meta": {"total": 57, "page": 1, "per_page": 50}}'
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
