---
title: Get Page Blueprint
api:
    method: GET
    path: '/blueprints/pages/{template}'
    description: 'Get the fully resolved blueprint schema for a page template, including inherited fields and imports. Requires `api.pages.read`. Fires `onApiBlueprintResolved` with `context: page` so plugins can adjust the serialized fields.'
    parameters:
        - name: template
          type: string
          required: true
          description: 'The page template name (e.g. default, blog, post, or modular/hero for a modular template)'
    request_example: ''
    response_example: '{"data": {"name": "default", "title": "Default", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "header.title", "type": "text", "label": "Title"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.read` permission'
        - code: '404'
          description: 'Template blueprint not found'
---

