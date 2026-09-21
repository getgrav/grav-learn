---
title: Get Config Blueprint
api:
    method: GET
    path: '/blueprints/config/{scope}'
    description: 'Return the blueprint that describes a system/site config scope. Admin2 pairs this with `GET /config/{scope}` to render configuration forms. Looks up the blueprint via the `blueprints://` stream so plugin overrides (e.g. the admin plugin''s `media.yaml`) are honored, then falls back to `system://blueprints/config/{scope}.yaml`.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'One of the core scopes `system`, `site`, `media`, `security`, `scheduler`, `backups`, or a custom top-level config scope the site defines (for example `user/blueprints/config/<scope>.yaml`). Other system blueprints such as `streams` are refused.'
    request_example: ''
    response_example: '{"data": {"name": "system", "title": "System Configuration", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "cache.enabled", "type": "toggle", "label": "Caching"}]}}'
    response_codes:
        - code: '200'
          description: 'Blueprint returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.config.read` permission.'
        - code: '404'
          description: 'Unknown scope, or blueprint file not found.'
---
