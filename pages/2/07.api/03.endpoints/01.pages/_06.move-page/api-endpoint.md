---
title: Move Page
api:
    method: POST
    path: '/pages/{route}/move'
    description: 'Move a page to a new parent, optionally renaming its slug or changing its ordering prefix. Returns the moved page with an ETag; if the page cannot be resolved at its new route, only `route` and `slug` are returned. Requires `api.pages.write`, subject to the page''s own `update` rule and the destination parent''s `create` rule.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The current page route (path parameter)'
        - name: parent
          type: string
          required: true
          description: 'The target parent route (`/` for the top level)'
        - name: slug
          type: string
          required: false
          description: 'Optionally rename the slug during the move. Must be a single path segment.'
        - name: order
          type: integer
          required: false
          description: 'Numeric ordering prefix at the new location. Defaults to the current prefix; `null` removes it.'
    request_example: '{"parent": "/blog", "slug": "moved-post"}'
    response_example: '{"data": {"route": "/blog/moved-post", "slug": "moved-post", "title": "My Post", "template": "post", "content": "# Hello World", "media": []}}'
    response_codes:
        - code: '200'
          description: 'Page moved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.write` permission or denied by page rules'
        - code: '404'
          description: 'Page not found'
        - code: '422'
          description: 'Missing `parent`, invalid slug, destination parent not found, destination already exists, or the page is already at that location'
---

