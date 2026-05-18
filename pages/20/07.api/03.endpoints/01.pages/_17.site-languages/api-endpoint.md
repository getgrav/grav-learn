---
title: List Site Languages
api:
    method: GET
    path: '/languages'
    description: 'Return the site''s configured languages with display names, RTL flags, and the default/active codes. Returns `enabled: false` with empty `languages` when multilang is off. Drives language switchers and translation UIs.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"enabled": true, "languages": [{"code": "en", "name": "English", "native_name": "English", "rtl": false, "is_default": true}, {"code": "fr", "name": "French", "native_name": "Français", "rtl": false, "is_default": false}], "default": "en", "active": "en"}}'
    response_codes:
        - code: '200'
          description: 'Languages returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
---
