---
title: Import Translation Strings
api:
    method: POST
    path: '/i18n/import/translation-strings'
    description: 'Merge every override configured in the translation-strings plugin into `user/languages/<lang>.yaml`. Overrides for other keys are kept; where both name the same key, the plugin''s value wins, because that is what the site shows today. Sends `X-Invalidates: translations:update`. Requires `api.translations.write`; demo accounts get 403.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"imported": 4, "reverted": 1, "unknown": [], "languages": [{"code": "fr", "written": 4, "reverted": 1, "unknown": 0, "path": "/var/www/grav/user/languages/fr.yaml"}], "plugin_enabled": true}}'
    response_codes:
        - code: '200'
          description: 'Import completed.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.write` permission, or a demo account.'
        - code: '422'
          description: 'The plugin has no overrides configured, or its config has a language code the editor cannot store.'
---

Every language code in the plugin's config is checked before anything is written, so a bad code fails the whole import with a 422 naming it, and no language is left half imported.

The plugin is not disabled for you. Turning it off is a config change with its own permission, so do it afterwards through [Update Config](/2/api/endpoints/configuration/update-config); `plugin_enabled` reports its current state. `imported` counts the overrides written across all languages, `reverted` the values skipped because they matched the shipped value, and `unknown` lists imported keys that no source ships.
