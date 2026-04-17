---
title: Update Page
template: api-endpoint
api:
    method: PATCH
    path: '/pages/{route}'
    description: 'Partial update of a page. Only provided fields are changed.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path parameter)'
        - name: title
          type: string
          required: false
          description: 'Updated page title'
        - name: content
          type: string
          required: false
          description: 'Updated markdown content'
        - name: header
          type: object
          required: false
          description: 'Header values to merge into existing frontmatter'
        - name: template
          type: string
          required: false
          description: 'Change the page template'
        - name: published
          type: boolean
          required: false
          description: 'Set the published state'
        - name: visible
          type: boolean
          required: false
          description: 'Set the visible state'
    request_example: '{"title": "Updated Title", "header": {"subtitle": "New subtitle"}}'
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Validation error'
---

Supports [optimistic concurrency control](/20/api/getting-started#concurrency-control) via the `If-Match` header. Include the ETag from your last GET request to prevent overwriting concurrent changes.
