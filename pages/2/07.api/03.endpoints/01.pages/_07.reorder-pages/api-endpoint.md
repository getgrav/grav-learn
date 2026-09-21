---
title: Reorder Pages
api:
    method: POST
    path: '/pages/{route}/reorder'
    description: 'Reorder child pages under a parent. The listed slugs get numeric folder prefixes 1, 2, 3 in the order given, keeping the widest prefix width already used by the siblings. Children not listed keep their current folder name. Returns every child of the page in its new order. Requires `api.pages.write`, subject to the parent page''s own `update` rule.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The parent page route (path parameter)'
        - name: order
          type: array
          required: true
          description: 'Array of child slugs in the desired order'
    request_example: '{"order": ["first-post", "second-post", "third-post"]}'
    response_example: '{"data": [{"route": "/blog/first-post", "slug": "first-post", "title": "First Post", "order": "01."}, {"route": "/blog/second-post", "slug": "second-post", "title": "Second Post", "order": "02."}, {"route": "/blog/third-post", "slug": "third-post", "title": "Third Post", "order": "03."}]}'
    response_codes:
        - code: '200'
          description: 'Pages reordered'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.write` permission or denied by the parent page''s rules'
        - code: '404'
          description: 'Parent page not found'
        - code: '422'
          description: '`order` missing or not an array, or a slug is not a child of this page'
---

