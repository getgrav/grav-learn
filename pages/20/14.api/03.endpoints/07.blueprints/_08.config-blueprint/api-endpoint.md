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
          description: 'One of: `system`, `site`, `media`, `security`, `scheduler`, `backups`.'
    request_example: ''
    response_example: '{"data": {"id": "system", "name": "System Configuration", "fields": {"cache.enabled": {"type": "toggle", "label": "Enabled"}}}}'
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
