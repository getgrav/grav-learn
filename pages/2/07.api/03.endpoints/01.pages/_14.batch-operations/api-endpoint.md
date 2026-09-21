---
title: Batch Page Operations
api:
    method: POST
    path: '/pages/batch'
    description: 'Run the same operation (`publish`, `unpublish`, `delete`, or `copy`) across multiple pages in one request. Per-page results are returned individually, so one failure does not abort the batch; a page whose own rules deny the action is reported as an `error` result. Every route must resolve to a page before anything runs. Limited to `plugins.api.batch.max_items` (default 50). Emits per-page cache invalidation tags matching the operation. Requires `api.pages.write`.'
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
          description: 'Used by `copy` only: `destination` (parent route to copy into, `/` for the top level, defaults to each page''s own parent) and `suffix` (appended to each slug, default `-copy`, must be a single path segment).'
    request_example: '{"operation": "publish", "routes": ["/blog/post-1", "/blog/post-2"]}'
    response_example: '{"data": {"operation": "publish", "results": [{"route": "/blog/post-1", "status": "success"}, {"route": "/blog/post-2", "status": "error", "message": "Page permissions deny ''publish'' on this page."}], "total": 2, "successful": 1, "failed": 1}}'
    response_codes:
        - code: '200'
          description: 'Batch processed; individual results in `results[]`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
        - code: '422'
          description: 'Invalid operation, empty routes array, batch limit exceeded, or a route does not exist.'
---
