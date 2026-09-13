---
title: Get Plugin Blueprint
api:
    method: GET
    path: '/blueprints/plugins/{plugin}'
    description: 'Return a plugin''s `blueprints.yaml` with fields resolved (labels translated, data options expanded). Fires the `onApiBlueprintResolved` event so plugins can mutate the serialized fields (e.g., inject dynamic options).'
    parameters:
        - name: plugin
          type: string
          required: true
          description: 'Plugin slug.'
    request_example: ''
    response_example: '{"data": {"id": "simplesearch", "name": "SimpleSearch", "fields": {"enabled": {"type": "toggle", "label": "Enabled"}}}}'
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
