---
title: Get Plugin Page Blueprint
api:
    method: GET
    path: '/blueprints/plugins/{plugin}/pages/{pageId}'
    description: 'Get a custom page blueprint for a plugin. Requires `api.config.read`. Loads the YAML file from admin/blueprints/{pageId}.yaml within the plugin directory and returns it as a serialized blueprint with resolved fields. When that file is missing and `pageId` equals the plugin slug, the plugin''s main `blueprints.yaml` is used instead. Fires `onApiBlueprintResolved` with `context: plugin-page`.'
    parameters:
        - name: plugin
          type: string
          required: true
          description: 'The plugin slug'
        - name: pageId
          type: string
          required: true
          description: 'The page blueprint identifier (matches the filename without extension)'
    request_example: ''
    response_example: '{"data": {"name": "licenses", "title": "Licenses", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "licenses", "type": "array", "label": "Licenses"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.read` permission'
        - code: '404'
          description: 'Plugin or page blueprint not found'
---

