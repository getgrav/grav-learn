---
title: Sync Translation
api:
    method: POST
    path: '/pages/{route}/sync'
    description: 'Overwrite one language''s content + header with another language''s. Useful for "reset this French page back to the English version" workflows. Both the source and target translation files must already exist. The same Twig-content and blueprint validation checks as a normal page save apply. Fires `onApiBeforePageSync` (mutable header/content) and `onApiPageSynced`. Returns the updated target page. Requires multi-language to be enabled and `api.pages.write`, subject to the page''s own `update` rule.'
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
    response_example: '{"data": {"route": "/blog/my-post", "slug": "my-post", "title": "My Post", "template": "post", "language": "fr", "content": "# Hello", "media": []}}'
    response_codes:
        - code: '200'
          description: 'Target translation overwritten with source content.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission, denied by the page''s rules, or Twig-in-content not allowed.'
        - code: '404'
          description: 'Page not found for one of the supplied languages.'
        - code: '422'
          description: 'Missing fields, same source/target, target translation file does not exist (create it with `/translate` first), a language code that is not a string or not configured, multi-language not enabled, or blueprint validation failed.'
---
