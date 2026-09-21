---
title: Get Overrides
api:
    method: GET
    path: '/i18n/overrides/{lang}'
    description: 'The site''s override file for one language (`user/languages/<lang>.yaml`) as YAML, for the advanced editor. Without `namespace` this is the raw file text, or an empty string when there is no file. With `namespace`, only the overrides under that prefix are returned, re-dumped as nested YAML, so "edit as YAML" covers only what is on screen. Requires `api.translations.read`.'
    parameters:
        - name: lang
          type: string
          required: true
          description: 'Language code (path parameter), e.g. `fr`.'
        - name: namespace
          type: string
          required: false
          description: 'Dotted key prefix to limit the output to, e.g. `THEME_QUARK`.'
    request_example: ''
    response_example: '{"data": {"lang": "fr", "scoped": true, "namespace": "THEME_QUARK", "count": 1, "yaml": "THEME_QUARK:\n  SEARCH: Rechercher\n"}}'
    response_codes:
        - code: '200'
          description: 'Overrides returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
        - code: '422'
          description: 'Invalid language code.'
---

`scoped` is `true` when `namespace` was given, and `count` is the number of overrides included. Save the edited text back with [Replace Overrides](/2/api/endpoints/translations/replace-overrides), passing the same `namespace`.
