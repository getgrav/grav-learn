---
title: List MCP Tools
api:
    method: GET
    path: '/mcp/tools'
    description: 'Every MCP tool the enabled plugins describe, filtered to what the caller may call: a tool naming a permission the caller doesn''t hold is left out, tools naming no permission are always included, and a super admin sees everything. Supports `If-None-Match`: a matching ETag returns an empty 304. Requires `api.access`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"tools": [{"name": "kahunacart_list_products", "plugin": "kahunacart", "title": "List products", "description": "List catalog products with paging, search and status filters.", "method": "GET", "path": "/kahunacart/products", "permission": "kahunacart.products.manage", "annotations": {"readOnly": true, "destructive": false, "idempotent": true}, "input_schema": {"type": "object", "properties": {"q": {"type": "string"}}}, "path_params": [], "query": [], "body": null}], "plugins": [{"slug": "kahunacart", "name": "KahunaCart", "version": "0.1.0", "tools": 1}], "warnings": [], "fingerprint": "5f1d9c2a7b3e4d08"}}'
    response_codes:
        - code: '200'
          description: 'Tools returned, with an `ETag` header.'
        - code: '304'
          description: 'The `If-None-Match` ETag still matches; empty body.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

Each tool has:

| Field | Meaning |
|-------|---------|
| `name` | The tool name an MCP client registers, `{prefix}_{name}` from the manifest, 64 characters or fewer |
| `plugin` | Slug of the plugin that contributed it |
| `title` | Human title an MCP client may show, or `null` |
| `description` | What the tool does and returns, and when to use it |
| `method` | `GET`, `POST`, `PATCH`, `PUT` or `DELETE` |
| `path` | Route path relative to the API base; `{name}` placeholders are filled from the arguments |
| `permission` | The permission the route enforces, or `null` |
| `annotations` | `readOnly`, `destructive` and `idempotent`, always filled in with the per-method defaults |
| `input_schema` | JSON Schema object for the arguments; a tool with no arguments has `{"type": "object", "properties": {}}` |
| `path_params` | The `{name}` placeholders in `path`, in order |
| `query` | For write methods, the properties sent as query parameters instead of in the body (a `GET` sends every non-path property as a query parameter) |
| `body` | The one property whose value is the whole request body, or `null` when the body is built from the remaining properties |

`plugins[].tools` counts the tools this caller can see, not how many the manifest declares. `warnings` has one line for each manifest entry that was skipped and why, for example an unsupported JSON Schema keyword. `fingerprint` changes when the set of enabled plugins or any manifest file changes, and it is also the response's `ETag`.
