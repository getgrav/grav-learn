---
title: Update Overrides
api:
    method: PATCH
    path: '/i18n/overrides/{lang}'
    description: 'Inline edits to one language''s overrides. `set` writes values and `unset` removes overrides so the shipped value shows again. Sends `X-Invalidates: i18n:update, translations:update`. Requires `api.translations.write`; demo accounts get 403.'
    parameters:
        - name: lang
          type: string
          required: true
          description: 'Language code (path parameter), e.g. `fr`.'
        - name: source_lang
          type: string
          required: false
          description: 'Query parameter: the reference language for `source_value` in the returned rows. An invalid or missing code falls back to the editor''s default language.'
        - name: set
          type: object
          required: false
          description: 'Object of dotted key to new value. It must be an object: a JSON array is a 422. Numeric keys inside an object are ignored.'
        - name: unset
          type: array
          required: false
          description: 'Keys whose override should be removed. Non-string entries are ignored.'
    request_example: '{"set": {"THEME_QUARK.SEARCH": "Rechercher"}, "unset": ["PLUGIN_ADMIN.TITLE"]}'
    response_example: '{"data": {"written": {"THEME_QUARK.SEARCH": "Rechercher"}, "removed": ["PLUGIN_ADMIN.TITLE"], "reverted": [], "unknown": [], "rows": [{"key": "THEME_QUARK.SEARCH", "namespace": "THEME_QUARK", "source_value": "Search", "providers": ["theme:quark"], "owner": "theme:quark", "known": true, "values": {"fr": {"value": "Rechercher", "state": "overridden", "shipped": "Recherche"}}}, {"key": "PLUGIN_ADMIN.TITLE", "namespace": "PLUGIN_ADMIN", "source_value": "Title", "providers": ["plugin:admin"], "owner": "plugin:admin", "known": true, "values": {"fr": {"value": "Titre", "state": "shipped", "shipped": "Titre"}}}]}}'
    response_codes:
        - code: '200'
          description: 'Overrides saved.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.write` permission, or a demo account.'
        - code: '422'
          description: 'Invalid language code, `set` that is not an object or `unset` that is not an array, or both empty.'
---

A `set` whose value equals what the source ships is stored as a removal rather than an override, so the file only holds real differences and keeps following the source's future wording. Those keys are listed in `reverted`. Keys no source ships are still written, and listed in `unknown`.

`written` holds the keys stored as overrides with their values, and `removed` the keys whose existing override was deleted. `rows` has a fresh matrix row for every key the request touched, with a cell for this language only, so the editor can update in place.
