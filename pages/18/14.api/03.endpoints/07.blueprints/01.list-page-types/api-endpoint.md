---
title: List Page Types
template: api-endpoint
api:
    method: GET
    path: /blueprints/pages
    description: 'List all available page templates (blueprints) registered in the system.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"type": "default", "label": "Default"}, {"type": "blog", "label": "Blog"}, {"type": "post", "label": "Post"}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

