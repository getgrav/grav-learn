---
title: Import Status
api:
    method: GET
    path: '/i18n/import/translation-strings'
    description: 'What the old translation-strings plugin has configured, and what importing it would do for each language. Read-only. Requires `api.translations.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"present": true, "plugin_enabled": true, "config_path": "/var/www/grav/user/config/plugins/translation-strings.yaml", "pending": 4, "total": 6, "languages": [{"code": "fr", "total": 6, "new": 3, "already": 1, "conflict": 1, "shipped": 1, "unknown": 0, "keys": [{"key": "THEME_QUARK.SEARCH", "status": "new", "unknown": false, "current": null, "value": "Rechercher"}]}]}}'
    response_codes:
        - code: '200'
          description: 'Import preview returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
        - code: '422'
          description: 'The plugin''s config has a language code the editor cannot store.'
---

`present` is true when the plugin has at least one override configured, and `plugin_enabled` matters because while the plugin is enabled its values still win over `user/languages`. `pending` counts the keys an import would write (`new` plus `conflict`). `config_path` is the absolute path of the plugin's config file; demo accounts get `(hidden in demo mode)` instead.

Per language, `new` keys have no override yet, `already` keys are overridden with the same value, `conflict` keys are overridden with a different value that importing replaces with the plugin's, and `shipped` keys equal the shipped value so importing stores nothing. The counts are exact, but `keys` lists at most 50 keys per language. In each listed key, `current` is the site's existing override (or `null`) and `value` is the plugin's value.
