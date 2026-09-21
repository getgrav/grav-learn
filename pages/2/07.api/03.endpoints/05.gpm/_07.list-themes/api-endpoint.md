---
title: List Themes
api:
    method: GET
    path: '/gpm/themes'
    description: 'List all installed themes with thumbnail and screenshot URLs, update status, and the `is_symlink` flag. For themes, `enabled` means it is the active theme. Requires `api.gpm.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "quark", "name": "Quark", "version": "2.0.4", "type": "theme", "description": "Quark is the default theme for Grav.", "description_html": "<p>Quark is the default theme for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-theme-quark", "enabled": true, "is_symlink": false, "updatable": false, "thumbnail": "/api/v1/thumbnails/8c1f2a9e4b.jpg", "screenshot": "/api/v1/thumbnails/0d3e7b61fa.jpg"}]}'
    response_codes:
        - code: '200'
          description: 'Themes returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---

`thumbnail` (capped at 500px) and `screenshot` (capped at 2000px) are `/thumbnails/{file}` URLs made from the theme's own `thumbnail` and `screenshot` images. When a theme has only one of the two, both fields use it; with neither, both are `null`.
