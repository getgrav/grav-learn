---
title: Reorder Pages
api:
    method: POST
    path: '/pages/{route}/reorder'
    description: 'Reorder child pages under a parent.'
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
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Pages reordered'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Parent page not found'
        - code: '422'
          description: 'Validation error'
---

