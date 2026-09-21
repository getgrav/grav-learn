---
title: Get Theme Blueprint
api:
    method: GET
    path: '/blueprints/themes/{theme}'
    description: 'Return a theme''s `blueprints.yaml` with resolved fields. Requires `api.config.read`. Fires `onApiBlueprintResolved` with `context: theme`.'
    parameters:
        - name: theme
          type: string
          required: true
          description: 'Theme slug.'
    request_example: ''
    response_example: '{"data": {"name": "quark", "title": "Quark", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "dropdown.enabled", "type": "toggle", "label": "Dropdown in navbar"}]}}'
    response_codes:
        - code: '200'
          description: 'Blueprint returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.config.read` permission.'
        - code: '404'
          description: 'Theme or its `blueprints.yaml` not found.'
---
