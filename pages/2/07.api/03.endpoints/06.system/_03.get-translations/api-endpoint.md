---
title: Get Translations
api:
    method: GET
    path: '/translations/{lang}'
    description: 'Get all translation strings for a language as a flat key/value map. This is a public route: no authentication is needed. Keys the language does not translate are filled in from English (`en-US`), so the map is complete for any language.'
    parameters:
        - name: lang
          type: string
          required: true
          description: 'Language code (e.g. `en`, `fr`, `pt-BR`). Short codes are normalized to a full locale (`en` becomes `en-US`, `fr` becomes `fr-FR`); a value that is not a language code falls back to the site''s default language. The resolved code is returned in `lang`.'
        - name: prefix
          type: string
          required: false
          description: 'Only return keys starting with this prefix followed by a dot (case-insensitive), e.g. `PLUGIN_ADMIN`.'
    request_example: ''
    response_example: '{"data": {"lang": "fr-FR", "dir": "ltr", "count": 1868, "checksum": "5d41402abc4b2a76b9719d911017c592", "strings": {"PLUGIN_ADMIN.SAVE": "Enregistrer"}}}'
    response_codes:
        - code: '200'
          description: 'Success'
---

`dir` is the text direction (`ltr` or `rtl`), and `checksum` is an MD5 of the returned strings, so a client can cache the map and only refetch it when the checksum changes. Strings contributed only by disabled plugins are left out.
