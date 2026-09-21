---
title: Update Config
api:
    method: PATCH
    path: '/config/{scope}'
    description: 'Update configuration values with deep merge. Requires `api.config.write`.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'Configuration scope: system, site, media, security, backups, scheduler, plugins/{name}, themes/{name}, or a custom scope from `user/config/<name>.yaml`'
        - name: X-Config-Environment
          type: string
          required: false
          description: 'Request header. Environment layer to write. Empty, `default` or `base` targets the base `user/config`; when the header is absent, the active environment is used if it has a config folder. A name that is invalid or has no folder returns 422.'
    request_example: '{"title": "Updated Site Title"}'
    response_example: '{"data": {"title": "Updated Site Title", "author": {"name": "Admin", "email": "admin@example.com"}}, "meta": {"overrides": ["title"], "fallback": {"title": "Grav"}}}'
    response_codes:
        - code: '200'
          description: 'Configuration updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.write`, or a write to `system`, `security`, `plugins/api`, `scheduler` or `backups` without API super user access'
        - code: '404'
          description: 'Scope not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Empty body, a changed field that fails blueprint validation, or an invalid or missing environment'
---

The request body is deep-merged into the existing configuration, using the scope's blueprint so fields such as file lists are replaced rather than merged. Only fields whose values changed are validated against the blueprint. Only the values that differ from the parent layer are written to disk, and values supplied through `GRAV_CONFIG__*` environment variables are never persisted. A masked secret sent back unchanged keeps its stored value.

The response has the same structure as [Get Config](#get-config) and carries an `X-Invalidates` header (`config:update:<scope>`, plus `plugins:update:<name>` and `plugins:list` for plugin scopes). A successful save fires `onAdminSave`, `onAdminAfterSave` and `onApiConfigUpdated`.

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header.
