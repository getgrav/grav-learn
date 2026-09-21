---
title: Get Config
api:
    method: GET
    path: '/config/{scope}'
    description: 'Get the effective configuration for a scope, with secret values masked. Requires `api.config.read`.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'Configuration scope: system, site, media, security, backups, scheduler, plugins/{name}, themes/{name}, or a custom scope from `user/config/<name>.yaml`'
        - name: X-Config-Environment
          type: string
          required: false
          description: 'Request header. Environment layer to read. Empty, `default` or `base` targets the base `user/config`; when the header is absent, the active environment is used if it has a config folder. An invalid name returns 422.'
    request_example: ''
    response_example: '{"data": {"title": "My Site", "author": {"name": "Admin", "email": "admin@example.com"}}, "meta": {"overrides": ["title"], "fallback": {"title": "Grav"}}}'
    response_codes:
        - code: '200'
          description: 'Success. The `ETag` header holds the value to send as `If-Match` on the next update.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.read`, or the `scheduler` / `backups` scope without API super user access'
        - code: '404'
          description: 'Scope not found'
        - code: '422'
          description: 'Invalid `X-Config-Environment` header'
---

The body is the full configuration for the selected layer, recomputed from the YAML files, so reading with `X-Config-Environment: default` shows the base configuration even while an environment overlay is active. Passwords, API keys and tokens come back masked. `meta.overrides` lists the dotted leaf paths the selected layer overrides, and `meta.fallback` gives the value each of those would revert to (see [Revert Config](#revert-config)).

The `ETag` is computed from the stored overrides, not from the full body, so it stays valid across a save and reload.
