---
title: Reorganize Pages
api:
    method: POST
    path: '/pages/reorganize'
    description: 'Atomically move and/or reorder multiple pages in a single request. All operations are validated before any filesystem changes are applied, then executed via a two-phase temp-rename strategy with best-effort rollback on failure. Cannot move a page into its own subtree. Limited to `plugins.api.batch.max_items` (default 50). Fires `onApiBeforePagesReorganize` and `onApiPagesReorganized`.'
    parameters:
        - name: operations
          type: array
          required: true
          description: 'Non-empty array of operation objects. Each must have a `route`; optional fields are `parent` (new parent route) and `position` (integer, controls the numeric prefix on the folder).'
    request_example: '{"operations": [{"route": "/blog/post-1", "parent": "/archive", "position": 1}, {"route": "/blog/post-2", "position": 3}]}'
    response_example: '{"data": [{"route": "/archive/post-1", "slug": "post-1", "title": "Post 1", "order": 1, "parent": "/archive"}, {"route": "/blog/post-2", "slug": "post-2", "title": "Post 2", "order": 3, "parent": "/blog"}]}'
    response_codes:
        - code: '200'
          description: 'All operations succeeded; response lists every child of every affected parent.'
        - code: '400'
          description: 'Validation failed — empty operations, duplicate routes, missing page, position conflict, attempt to move a page into its own subtree, or filesystem error during execution (partial rollback attempted).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
---
