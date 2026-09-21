---
title: Get Theme
api:
    method: GET
    path: '/gpm/themes/{slug}'
    description: 'Get details for a specific installed theme: the same package object as List Themes, plus `custom_fields` when the theme ships Admin Next field components. Requires `api.gpm.read`.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The theme slug.'
    request_example: ''
    response_example: '{"data": {"slug": "quark", "name": "Quark", "version": "2.0.4", "type": "theme", "description": "Quark is the default theme for Grav.", "description_html": "<p>Quark is the default theme for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-theme-quark", "enabled": true, "is_symlink": false, "updatable": false, "thumbnail": "/api/v1/thumbnails/8c1f2a9e4b.jpg", "screenshot": "/api/v1/thumbnails/0d3e7b61fa.jpg"}}'
    response_codes:
        - code: '200'
          description: 'Theme returned.'
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Theme not installed.'
---

The response carries an `ETag` header. Send it back as `If-None-Match` and the API answers `304 Not Modified` with an empty body when nothing changed.
