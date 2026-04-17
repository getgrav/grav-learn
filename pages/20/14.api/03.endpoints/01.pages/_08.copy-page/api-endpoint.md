---
title: Copy Page
api:
    method: POST
    path: '/pages/{route}/copy'
    description: 'Duplicate a page (including all content and media) to a new route. The destination parent must exist and the destination path must be free. Returns 201 with the new page. Emits `pages:create:<dest>` and `pages:list` cache invalidation tags.'
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
        - code: '400'
          description: 'Missing destination `route`, destination parent not found, or destination already exists.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
        - code: '404'
          description: 'Source page not found.'
---
