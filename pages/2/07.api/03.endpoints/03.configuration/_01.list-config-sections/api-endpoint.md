---
title: List Config Sections
api:
    method: GET
    path: /config
    description: 'List the configuration scopes the admin shows as tabs. Requires `api.config.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": ["system", "site", "media", "security", "info"]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.read` permission'
---

The list always starts with `system` and `site` and ends with `info`, which is a client-side system information tab rather than a readable scope. In between, sorted by name, come the core scopes `media` and `security` plus any site-, plugin- or theme-authored custom scopes (a `user/config/<name>.yaml` with a matching config blueprint). `backups` is included for super users only, and `scheduler` is never listed. Plugin and theme settings are not listed here; read them as `plugins/{name}` and `themes/{name}` scopes.
