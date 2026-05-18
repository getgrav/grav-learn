---
title: Create Translation
api:
    method: POST
    path: '/pages/{route}/translate'
    description: 'Create a new translation of a page in the specified language. Writes a new `{template}.{lang}.md` file alongside the existing page. Fires `onApiBeforePageTranslate` (mutable), `onAdminSave`/`onAdminAfterSave`, and `onApiPageTranslated`. Returns 201 with the translated page.'
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
          description: 'Frontmatter object (defaults to a copy of the source page header, with `title` merged in).'
    request_example: '{"lang": "fr", "title": "Mon article", "content": "# Bonjour"}'
    response_example: '{"data": {"route": "/blog/my-post", "lang": "fr", "title": "Mon article", "content": "# Bonjour"}}'
    response_codes:
        - code: '201'
          description: 'Translation created.'
        - code: '400'
          description: 'Missing `lang`, invalid language code, or a translation already exists for that language (use PATCH to update).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.write` permission.'
        - code: '404'
          description: 'Source page not found.'
---
