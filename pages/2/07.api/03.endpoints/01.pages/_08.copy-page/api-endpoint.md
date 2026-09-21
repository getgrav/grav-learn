---
title: Copy Page
api:
    method: POST
    path: '/pages/{route}/copy'
    description: 'Duplicate a page (including all content and media) to a new route. The destination parent must exist and the destination path must be free. If the source sets a `slug:` in its frontmatter, the copy''s is rewritten to the new folder name. Returns 201 with the new page (only `route` and `slug` if the copy cannot be resolved afterwards). Emits `pages:create:<dest>` and `pages:list` cache invalidation tags. Requires `api.pages.write`, subject to the source page''s `read` rule and the destination parent''s `create` rule.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'Source page route (path param).'
        - name: route
          type: string
          required: true
          description: 'Destination route for the copy (body field).'
    request_example: '{"route": "/blog/my-post-copy"}'
    response_example: '{"data": {"route": "/blog/my-post-copy", "slug": "my-post-copy", "title": "My Post", "template": "post"}}'
    response_codes:
        - code: '201'
          description: 'Page copied; `Location` header points to the new page.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission, or denied by the source or destination page rules.'
        - code: '404'
          description: 'Source page not found.'
        - code: '422'
          description: 'Missing destination `route`, destination parent not found, or destination already exists.'
---
