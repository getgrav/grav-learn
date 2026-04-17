---
title: Batch Page Operations
api:
    method: POST
    path: '/pages/batch'
    description: 'Run the same operation (`publish`, `unpublish`, `delete`, or `copy`) across multiple pages in one request. Per-page results are returned individually — one failure does not abort the batch. Limited to `plugins.api.batch.max_items` (default 50). Emits per-page cache invalidation tags matching the operation.'
    parameters:
        - name: operation
          type: string
          required: true
          description: 'One of: `publish`, `unpublish`, `delete`, `copy`.'
        - name: routes
          type: array
          required: true
          description: 'Non-empty array of page routes.'
        - name: options
          type: object
          required: false
          description: 'Operation-specific options (e.g., destination parent for `copy`).'
    request_example: '{"operation": "publish", "routes": ["/blog/post-1", "/blog/post-2"]}'
    response_example: '{"data": {"operation": "publish", "results": [{"route": "/blog/post-1", "status": "success"}, {"route": "/blog/post-2", "status": "error", "message": "Page not found"}], "total": 2, "successful": 1, "failed": 1}}'
    response_codes:
        - code: '200'
          description: 'Batch processed; individual results in `results[]`.'
        - code: '400'
          description: 'Invalid operation, empty routes array, batch limit exceeded, or a route does not exist.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
---
