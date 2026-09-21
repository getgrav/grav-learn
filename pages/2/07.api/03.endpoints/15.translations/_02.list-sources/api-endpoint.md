---
title: List Sources
api:
    method: GET
    path: '/i18n/sources'
    description: 'Every source (Grav core, plugins, themes and this site''s own overrides) that ships at least one string in the requested language, with the key namespaces it contributes. This drives the editor''s browse pane. Requires `api.translations.read`.'
    parameters:
        - name: lang
          type: string
          required: false
          description: 'Language to count keys in. An invalid or missing code falls back to the editor''s default language.'
    request_example: ''
    response_example: '{"data": {"lang": "en", "providers": [{"id": "theme:quark", "kind": "theme", "slug": "quark", "label": "Quark", "enabled": true, "key_count": 42, "namespaces": [{"name": "THEME_QUARK", "key_count": 42}]}]}}'
    response_codes:
        - code: '200'
          description: 'Sources returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
---

A source `id` is `system:core`, `plugin:<slug>`, `theme:<slug>` or `user:overrides`, and `kind` is `system`, `plugin`, `theme` or `user`. `enabled` says whether a plugin is enabled or a theme is the active one; it is always `true` for core and the site's overrides. Pass an `id` as `provider` to [List Keys](/2/api/endpoints/translations/list-keys) to see that source's strings.
