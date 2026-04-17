---
title: Get Page Blueprint
template: api-endpoint
api:
    method: GET
    path: '/blueprints/pages/{template}'
    description: 'Get the fully resolved blueprint schema for a page template, including inherited fields and imports.'
    parameters:
        - name: template
          type: string
          required: true
          description: 'The page template name (e.g. default, blog, post)'
    request_example: ''
    response_example: '{"data": {"name": "default", "title": "Default", "validation": "loose", "fields": [{"name": "header.title", "type": "text", "label": "Title"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Template blueprint not found'
---

