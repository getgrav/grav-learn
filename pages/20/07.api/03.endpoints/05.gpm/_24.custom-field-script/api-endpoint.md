---
title: Get Custom Field Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/field/{type}'
    description: 'Serve the JavaScript web component for a plugin''s custom blueprint field type. Also available under `/gpm/themes/{slug}/field/{type}` for theme-provided fields. Admin2 loads these on demand when rendering a blueprint that uses an unknown field type. Convention: the file lives at `admin-next/fields/{type}.js` inside the package. Response is served with `Content-Type: application/javascript`.'
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
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Field component not found.'
---
