---
title: Get Translations
template: api-endpoint
api:
    method: GET
    path: '/translations/{lang}'
    description: 'Get translation strings for a language.'
    parameters:
        - name: lang
          type: string
          required: true
          description: 'Language code (e.g. en, fr, de)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

