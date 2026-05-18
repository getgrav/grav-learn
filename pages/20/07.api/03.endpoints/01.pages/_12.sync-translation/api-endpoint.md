---
title: Sync Translation
api:
    method: POST
    path: '/pages/{route}/sync'
    description: 'Overwrite one language''s content + header with another language''s. Useful for "reset this French page back to the English version" workflows. Both the source and target translation files must already exist. Fires `onApiBeforePageSync` (mutable header/content) and `onApiPageSynced`.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
        - name: source_lang
          type: string
          required: true
          description: 'Language code to copy content from.'
        - name: target_lang
          type: string
          required: true
          description: 'Language code to overwrite.'
    request_example: '{"source_lang": "en", "target_lang": "fr"}'
    response_example: '{"data": {"route": "/blog/my-post", "lang": "fr", "title": "My Post", "content": "# Hello"}}'
    response_codes:
        - code: '200'
          description: 'Target translation overwritten with source content.'
        - code: '400'
          description: 'Missing fields, same source/target, target translation file does not exist (create it with `/translate` first), or invalid language code.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
        - code: '404'
          description: 'Page not found for one of the supplied languages.'
---
