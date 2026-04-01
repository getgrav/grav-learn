---
title: Create Page
template: api-endpoint
api:
    method: POST
    path: /pages
    description: 'Create a new page.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The route where the page will be created'
        - name: title
          type: string
          required: true
          description: 'The page title'
        - name: template
          type: string
          required: false
          description: 'Page template to use'
          default: default
        - name: content
          type: string
          required: false
          description: 'Markdown content for the page body'
        - name: header
          type: object
          required: false
          description: 'Page header/frontmatter values'
        - name: order
          type: integer
          required: false
          description: 'Numeric ordering prefix for the page'
        - name: lang
          type: string
          required: false
          description: 'Language code for multi-language sites'
    request_example: '{"route": "/blog/new-post", "title": "New Post", "template": "post", "content": "# New Post\nContent here"}'
    response_example: '{"data": {"route": "/blog/new-post", "title": "New Post"}}'
    response_codes:
        - code: '201'
          description: 'Page created'
        - code: '401'
          description: 'Unauthorized'
        - code: '422'
          description: 'Validation error'
---

