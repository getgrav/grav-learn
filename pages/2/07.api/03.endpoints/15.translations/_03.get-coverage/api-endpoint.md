---
title: Get Coverage
api:
    method: GET
    path: '/i18n/coverage'
    description: 'For every language, how many of the source language''s keys it has (shipped or overridden) and how many are missing. Requires `api.translations.read`.'
    parameters:
        - name: source_lang
          type: string
          required: false
          description: 'The reference language. An invalid or missing code falls back to the editor''s default language.'
    request_example: ''
    response_example: '{"data": {"source_lang": "en", "coverage": [{"code": "fr", "total": 1868, "translated": 1702, "missing": 166, "overridden": 3}]}}'
    response_codes:
        - code: '200'
          description: 'Coverage returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
---

`total` is the number of keys in the source language, and `translated` and `missing` are counted against that key set only, so a stale key that only an old translation still carries doesn't count. `overridden` is the number of site overrides in the language, for any key.
