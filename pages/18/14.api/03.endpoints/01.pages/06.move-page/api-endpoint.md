---
title: Move Page
template: api-endpoint
api:
    method: POST
    path: '/pages/{route}/move'
    description: 'Move a page to a new parent location.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The current page route (path parameter)'
        - name: parent
          type: string
          required: true
          description: 'The target parent route'
        - name: slug
          type: string
          required: false
          description: 'Optionally rename the slug during the move'
        - name: order
          type: integer
          required: false
          description: 'Numeric ordering prefix at the new location'
    request_example: '{"parent": "/blog", "slug": "moved-post"}'
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Page moved'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
        - code: '422'
          description: 'Validation error'
---

