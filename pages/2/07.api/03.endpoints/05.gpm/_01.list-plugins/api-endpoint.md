---
title: List Plugins
api:
    method: GET
    path: '/gpm/plugins'
    description: 'List all installed plugins with enablement flags, update status, and whether each plugin is installed via a symlink (important for upgrade gating — symlinked packages should not be overwritten). Requires `api.gpm.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"slug": "simplesearch", "name": "SimpleSearch", "version": "3.0.0", "type": "plugin", "description": "A simple search plugin for Grav.", "description_html": "<p>A simple search plugin for Grav.</p>", "author": {"name": "Team Grav", "email": "devs@getgrav.org", "url": "https://getgrav.org"}, "homepage": "https://github.com/getgrav/grav-plugin-simplesearch", "enabled": true, "is_symlink": false, "available_version": "3.0.1", "updatable": true}]}'
    response_codes:
        - code: '200'
          description: 'Plugins returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---

Each entry is a package object. `version` is the installed version; `available_version` appears only when `updatable` is `true`. Optional blueprint fields (`docs`, `bugs`, `dependencies`, `compatibility`, `keywords`, `icon`) appear only when the plugin sets them, and premium plugins add `premium`, `licensed`, and when known `vendor` and `purchase_url`. A plugin whose settings are drawn on an admin page adds `settings_route` (a hash route) and, when that page belongs to another plugin, `settings_page`. A `name` or `description` written as a translation key is translated into the caller's admin language.
