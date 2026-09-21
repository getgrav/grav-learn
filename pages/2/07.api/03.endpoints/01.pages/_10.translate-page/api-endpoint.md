---
title: Create Translation
api:
    method: POST
    path: '/pages/{route}/translate'
    description: 'Create a new translation of a page in the specified language. Writes a new `{template}.{lang}.md` file alongside the existing page. The result is validated against the page blueprint. Fires `onApiBeforePageTranslate` (mutable), `onAdminSave`/`onAdminAfterSave`, and `onApiPageTranslated`. Returns 201 with the page in the new language; the `Location` header has no `lang` query, so add `?lang=<code>` to fetch the translation. Requires multi-language to be enabled and `api.pages.write`, subject to the page''s own `update` rule. Enabling `process.twig` in `header` also needs the Twig-in-content permission.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
        - name: lang
          type: string
          required: true
          description: 'Target language code (must match a configured site language).'
        - name: title
          type: string
          required: false
          description: 'Title for the translation (defaults to the source page title).'
        - name: content
          type: string
          required: false
          description: 'Raw markdown content (defaults to the source page content).'
        - name: header
          type: object
          required: false
          description: 'Frontmatter object (defaults to a copy of the source page header, with `title` merged in). Template blueprint defaults fill in anything missing.'
    request_example: '{"lang": "fr", "title": "Mon article", "content": "# Bonjour"}'
    response_example: '{"data": {"route": "/blog/my-post", "slug": "my-post", "title": "Mon article", "template": "post", "language": "fr", "header": {"title": "Mon article"}, "content": "# Bonjour", "media": []}}'
    response_codes:
        - code: '201'
          description: 'Translation created.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission, denied by the page''s rules, or Twig-in-content not allowed.'
        - code: '404'
          description: 'Source page not found.'
        - code: '422'
          description: 'Missing `lang`, a language code that is not a string or not configured, multi-language not enabled, a translation already exists for that language (use PATCH to update), or blueprint validation failed.'
---
