---
title: List Page Languages
api:
    method: GET
    path: '/pages/{route}/languages'
    description: 'List translated and untranslated languages for a page. Use this to drive the language switcher in page editors — `translated` are languages with content, `untranslated` are languages configured for the site but missing this page.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
    request_example: ''
    response_example: '{"data": {"route": "/blog/my-post", "default_language": "en", "translated": {"en": "default.en.md", "fr": "default.fr.md"}, "untranslated": ["de", "es"]}}'
    response_codes:
        - code: '200'
          description: 'Language status returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
        - code: '404'
          description: 'Page not found.'
---

> [!NOTE]
> When the site has only a bare `default.md` (no language suffix) and multilang is enabled, Grav will report the default language in `translated` as a fallback. Use `GET /pages/{route}?translations=true` to get the `has_default_file` / `explicit_language_files` fields that disambiguate which languages are backed by a real on-disk file.
