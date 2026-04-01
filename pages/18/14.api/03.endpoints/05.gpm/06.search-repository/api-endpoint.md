---
title: Search Repository
template: api-endpoint
api:
    method: GET
    path: /gpm/search
    description: 'Search the GPM repository for plugins and themes.'
    parameters:
        - name: q
          type: string
          required: true
          description: 'Search query string'
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

