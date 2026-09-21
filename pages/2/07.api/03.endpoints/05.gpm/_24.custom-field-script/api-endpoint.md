---
title: Get Custom Field Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/field/{type}'
    description: 'Serve the JavaScript web component for a plugin''s custom blueprint field type. Also available under `/gpm/themes/{slug}/field/{type}` for theme-provided fields. Admin2 loads these on demand when rendering a blueprint that uses an unknown field type. Convention: the file lives at `admin-next/fields/{type}.js` inside the package. Unlike the other script endpoints, this one also serves a disabled plugin''s fields, so its settings form can be edited before it is enabled.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Plugin (or theme) slug.'
        - name: type
          type: string
          required: true
          description: 'Field type identifier (matches the `type:` value in the blueprint).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'JavaScript file served.'
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
        - code: '404'
          description: 'Package or field component not found.'
---

Requires only `api.access`, so any admin who can reach the plugin's screens can load them without package manager rights. The script is served as `application/javascript` with `Cache-Control: private, no-cache` and an `ETag` built from the file's modification time and size, so a repeat request with `If-None-Match` gets an empty `304` until the file changes.
