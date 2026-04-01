---
title: List Pages
template: api-endpoint
api:
    method: GET
    path: /pages
    description: 'List pages with filtering, sorting, and pagination.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
        - name: sort
          type: string
          required: false
          description: 'Sort field: date, title, slug, modified, or order'
        - name: order
          type: string
          required: false
          description: 'Sort direction: asc or desc'
        - name: published
          type: boolean
          required: false
          description: 'Filter by published state'
        - name: template
          type: string
          required: false
          description: 'Filter by page template name'
        - name: routable
          type: boolean
          required: false
          description: 'Filter by routable state'
        - name: visible
          type: boolean
          required: false
          description: 'Filter by visible state'
        - name: parent
          type: string
          required: false
          description: 'Filter by direct parent route'
        - name: children_of
          type: string
          required: false
          description: 'Filter to descendants of a given route'
    request_example: ''
    response_example: '{"data": [{"route": "/blog", "slug": "blog", "title": "Blog", "template": "blog", "published": true}], "meta": {"total": 42, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
---

