---
title: Get Key
api:
    method: GET
    path: '/i18n/keys/{key}'
    description: 'One key across every language that any source ships. An unknown key still returns 200, with `known: false` and `missing` cells. Requires `api.translations.read`.'
    parameters:
        - name: key
          type: string
          required: true
          description: 'Dotted translation key (path parameter), e.g. `THEME_QUARK.SEARCH`. Only letters, digits, `_`, `.` and `-` are routed; anything else is a 404.'
        - name: source_lang
          type: string
          required: false
          description: 'The reference language for `source_value`. An invalid or missing code falls back to the editor''s default language.'
    request_example: ''
    response_example: '{"data": {"key": "THEME_QUARK.SEARCH", "namespace": "THEME_QUARK", "source_value": "Search", "providers": ["theme:quark"], "owner": "theme:quark", "known": true, "values": {"de": {"value": "Suche", "state": "shipped", "shipped": "Suche"}, "en": {"value": "Search", "state": "shipped", "shipped": "Search"}, "fr": {"value": "Rechercher", "state": "overridden", "shipped": "Recherche"}}}}'
    response_codes:
        - code: '200'
          description: 'Key returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
        - code: '404'
          description: 'The key contains characters outside the routed set.'
---
