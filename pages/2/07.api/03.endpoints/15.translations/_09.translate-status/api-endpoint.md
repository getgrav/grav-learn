---
title: Translate Status
api:
    method: GET
    path: '/i18n/translate'
    description: 'Whether machine translation is available through the AI Translate plugin, and if not, why. The editor hides its translate actions when it is unavailable. Requires `api.translations.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"available": false, "installed": true, "enabled": true, "reason": "not_configured", "max_keys": 200}}'
    response_codes:
        - code: '200'
          description: 'Status returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
---

`reason` is `null` when `available` is true, otherwise `not_installed`, `not_enabled` or `not_configured` (the plugin has no configured provider), so a client can tell the site owner what to do. `max_keys` is the most keys one [Translate Keys](/2/api/endpoints/translations/translate-keys) request accepts.
