---
title: List Keys
api:
    method: GET
    path: '/i18n/keys'
    description: 'The editor matrix: one row per key, sorted by key, with the source-language value and a cell for each requested language. Keys that only exist as site overrides are included so they can be fixed. Requires `api.translations.read`.'
    parameters:
        - name: source_lang
          type: string
          required: false
          description: 'The reference language. An invalid or missing code falls back to the editor''s default language.'
        - name: langs
          type: string
          required: false
          description: 'Comma-separated language codes to include as cells, e.g. `en,fr,de`. Codes no source ships are ignored; defaults to the source language alone.'
        - name: q
          type: string
          required: false
          description: 'Search text, matched case-insensitively against the key and the source-language value.'
        - name: provider
          type: string
          required: false
          description: 'Only keys shipped by this source id, e.g. `theme:quark` (see [List Sources](/2/api/endpoints/translations/list-sources)).'
        - name: namespace
          type: string
          required: false
          description: 'Only keys equal to or under this dotted prefix, e.g. `PLUGIN_ADMIN`.'
        - name: status
          type: string
          required: false
          description: '`all` (default), `shipped`, `overridden`, `missing` or `unknown`. A row matches when any requested language''s cell has that state; `unknown` matches keys no source ships.'
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Rows per page (default 20, max 500).'
    request_example: ''
    response_example: '{"data": [{"key": "THEME_QUARK.SEARCH", "namespace": "THEME_QUARK", "source_value": "Search", "providers": ["theme:quark"], "owner": "theme:quark", "known": true, "values": {"en": {"value": "Search", "state": "shipped", "shipped": "Search"}, "fr": {"value": "Rechercher", "state": "overridden", "shipped": "Recherche"}}}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 1, "total_pages": 1}}, "links": {"self": "/api/v1/i18n/keys?page=1&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Rows returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
---

`q` matches the value as well as the key because people know the words on screen, not the key behind them. `source_value` is the site's override in the source language when one exists, otherwise the shipped value. `providers` lists every source that ships the key and `owner` is the one whose value wins at runtime. See the [collection introduction](/2/api/endpoints/translations) for the cell states.

The pagination `links` keep every query parameter you sent (search, filters, languages), so following one stays within the same filtered view.
