---
title: List Languages
api:
    method: GET
    path: '/i18n/languages'
    description: 'Every language code that any source ships, each flagged with whether this site has an override file for it, plus the editor''s default language. Requires `api.translations.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"default": "en", "languages": [{"code": "de", "has_overrides": false}, {"code": "en", "has_overrides": true}, {"code": "fr", "has_overrides": false}]}}'
    response_codes:
        - code: '200'
          description: 'Languages returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.read` permission.'
---
