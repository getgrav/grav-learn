---
title: Get Page
template: api-endpoint
api:
    method: GET
    path: '/pages/{route}'
    description: 'Get a single page with full content, metadata, and media.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (e.g. /blog/my-post)'
        - name: summary
          type: boolean
          required: false
          description: 'Include page summary in the response'
        - name: render
          type: boolean
          required: false
          description: 'Return rendered HTML content instead of raw markdown'
        - name: children
          type: boolean
          required: false
          description: 'Include child pages in the response'
        - name: translations
          type: boolean
          required: false
          description: 'Include available translations'
    request_example: ''
    response_example: '{"data": {"route": "/blog/my-post", "slug": "my-post", "title": "My Post", "template": "post", "content": "# Hello World", "header": {"published": true}, "media": []}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
---

