---
title: Delete Page
api:
    method: DELETE
    path: '/pages/{route}'
    description: 'Delete a page and optionally its children.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route to delete'
        - name: children
          type: boolean
          required: false
          description: 'Also delete child pages'
          default: 'true'
        - name: lang
          type: string
          required: false
          description: 'Delete only a specific language version'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Page deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
        - code: '422'
          description: 'Validation error'
---

