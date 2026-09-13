---
title: Get Theme Blueprint
api:
    method: GET
    path: '/blueprints/themes/{theme}'
    description: 'Return a theme''s `blueprints.yaml` with resolved fields.'
    parameters:
        - name: theme
          type: string
          required: true
          description: 'Theme slug.'
    request_example: ''
    response_example: '{"data": {"id": "quark", "name": "Quark", "fields": {"dropdown.enabled": {"type": "toggle"}}}}'
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
