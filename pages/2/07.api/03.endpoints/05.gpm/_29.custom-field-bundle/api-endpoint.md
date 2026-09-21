---
title: Get Custom Field Bundle
api:
    method: GET
    path: '/gpm/plugins/{slug}/fields'
    description: 'Serve all of a package''s custom field web components in one response, as a JSON object mapping each field type to its JavaScript source. Admin2 fetches this once per package instead of one request per field type. Also available at `/gpm/themes/{slug}/fields`. Served for disabled plugins too, so their settings forms stay editable.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Plugin (or theme) slug.'
    request_example: ''
    response_example: '{"seo-magic-preview": "class SeoMagicPreview extends HTMLElement { ... }", "seo-magic-keywords": "class SeoMagicKeywords extends HTMLElement { ... }"}'
    response_codes:
        - code: '200'
          description: 'Bundle served. An empty object when the package ships no field components.'
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
        - code: '404'
          description: 'Package not found.'
        - code: '422'
          description: 'Invalid package slug.'
---

The body is the bare JSON map, not wrapped in the usual `data` envelope. It is served with `Cache-Control: private, no-cache` and an `ETag` built from each file's name, modification time and size, so revalidating costs only a `304` until a field file changes. Requires only `api.access`.
