---
title: Revert Config
api:
    method: POST
    path: '/config/{scope}/revert'
    description: 'Drop overrides from a configuration layer so the values fall back to the layer beneath. Requires `api.config.write`.'
    parameters:
        - name: scope
          type: string
          required: true
          description: 'Configuration scope, as for [Get Config](#get-config)'
        - name: keys
          type: array
          required: false
          description: 'Dotted paths of the overrides to drop. Required unless `reset` is true.'
        - name: reset
          type: boolean
          required: false
          description: 'Delete the layer''s file for this scope, dropping every override at once. Takes precedence over `keys`.'
        - name: X-Config-Environment
          type: string
          required: false
          description: 'Request header. Environment layer to revert. Empty, `default` or `base` targets the base `user/config`; when the header is absent, the active environment is used if it has a config folder.'
    request_example: '{"keys": ["pages.theme", "debugger.enabled"]}'
    response_example: '{"data": {"pages": {"theme": "quark"}, "debugger": {"enabled": false}}, "meta": {"overrides": ["pages.markdown.extra"], "fallback": {"pages.markdown.extra": false}, "reverted": true}}'
    response_codes:
        - code: '200'
          description: 'Effective configuration after the revert'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.write`, or a write to `system`, `security`, `plugins/api`, `scheduler` or `backups` without API super user access'
        - code: '404'
          description: 'Scope not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Neither a non-empty `keys` array nor `reset: true` was sent, or the environment is invalid'
---

Reverting a key in the base layer lets the core or plugin default take over; reverting it in an environment layer lets the base value take over. If nothing remains in the layer's file after the revert, the file is removed.

The response is the effective configuration after the revert, with secrets masked, in the same structure as [Get Config](#get-config). `meta.overrides` lists the paths that still override the parent layer, and `meta.reverted` says whether anything on disk changed. Reverting something the layer does not override (for example `reset: true` when the layer has no file) still returns 200, but `meta.reverted` is `false` and `onApiConfigUpdated` does not fire, so no `config.updated` webhook is sent.

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header, using the same `ETag` as Get Config.
