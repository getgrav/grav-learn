---
title: Get Plugin Blueprint
api:
    method: GET
    path: '/blueprints/plugins/{plugin}'
    description: 'Return a plugin''s `blueprints.yaml` with fields resolved (labels translated, data options expanded). Requires `api.config.read`. Fires the `onApiBlueprintResolved` event with `context: plugin` so plugins can mutate the serialized fields (e.g., inject dynamic options).'
    parameters:
        - name: plugin
          type: string
          required: true
          description: 'Plugin slug.'
    request_example: ''
    response_example: '{"data": {"name": "simplesearch", "title": "SimpleSearch", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "enabled", "type": "toggle", "label": "Plugin status"}]}}'
    response_codes:
        - code: '200'
          description: 'Blueprint returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.config.read` permission.'
        - code: '404'
          description: 'Plugin or its `blueprints.yaml` not found.'
---
