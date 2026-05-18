---
title: Adopt Language
api:
    method: POST
    path: '/pages/{route}/adopt-language'
    description: 'Claim an untyped base page file (e.g. `default.md`) as a specific language by renaming it in-place to `{template}.{lang}.md`. Pure filesystem rename + cache bust — content is untouched. Designed for sites that started single-language and later enabled multilang: lets the operator declare "this existing content is the English version" without editing YAML. Fires `onApiBeforePageAdoptLanguage` and `onApiPageLanguageAdopted`.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
        - name: lang
          type: string
          required: true
          description: 'Language code to adopt the base file as.'
    request_example: '{"lang": "en"}'
    response_example: '{"data": {"route": "/blog/my-post", "lang": "en"}}'
    response_codes:
        - code: '200'
          description: 'Base file renamed to the language-specific filename.'
        - code: '400'
          description: 'Multi-language not enabled, no untyped base file exists (page already uses language-suffixed files — use `/translate` instead), a translation file for that language already exists, or target filename collides with the base filename.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
        - code: '404'
          description: 'Page not found.'
        - code: '500'
          description: 'Filesystem rename failed.'
---
