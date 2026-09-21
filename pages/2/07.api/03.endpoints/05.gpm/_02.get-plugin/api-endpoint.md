---
title: Get Plugin
api:
    method: GET
    path: '/gpm/plugins/{slug}'
    description: 'Get details for a single installed plugin: the same package object as List Plugins, plus `custom_fields` when the plugin ships Admin Next field components. Requires `api.gpm.read`.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The plugin slug.'
    request_example: ''
    response_example: '{"data": {"slug": "simplesearch", "name": "SimpleSearch", "version": "3.0.0", "type": "plugin", "description": "A simple search plugin for Grav.", "description_html": "<p>A simple search plugin for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-simplesearch", "enabled": true, "is_symlink": false, "available_version": "3.0.1", "updatable": true, "custom_fields": {"simplesearch-preview": "simplesearch-preview"}}}'
    response_codes:
        - code: '200'
          description: 'Plugin returned.'
        - code: '304'
          description: 'Not modified. The `If-None-Match` header matches the current ETag.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Plugin not installed.'
---

The response carries an `ETag` header. Send it back as `If-None-Match` and the API answers `304 Not Modified` with an empty body when nothing changed. `custom_fields` maps each field type the plugin ships under `admin-next/fields/` to itself.
