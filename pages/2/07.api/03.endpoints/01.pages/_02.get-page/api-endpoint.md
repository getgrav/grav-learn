---
title: Get Page
api:
    method: GET
    path: '/pages/{route}'
    description: 'Get a single page with full content, metadata, and media, plus a `permissions` object with the caller''s capabilities on this page. Returns an ETag; use `If-None-Match` for conditional fetches. Requires `api.pages.read`, subject to the page''s own `read` rule. A page that has `process.twig: true` also needs the Twig-in-content permission.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (e.g. `/blog/my-post`).'
        - name: summary
          type: boolean
          required: false
          description: 'Leave out the raw `content` and return a plain-text `summary` (rendered, tags stripped, truncated) in its place.'
        - name: summary_size
          type: integer
          required: false
          description: 'Maximum length of `summary` in characters (default 300). Only used with `summary=true`.'
        - name: render
          type: boolean
          required: false
          description: 'Also return the rendered HTML in `content_html`.'
        - name: children
          type: boolean
          required: false
          description: 'Include child pages in the response.'
        - name: children_depth
          type: integer
          required: false
          description: 'How many levels of children to include (default 1). Only used with `children=true`.'
        - name: translations
          type: boolean
          required: false
          description: 'Include translation metadata: `translated_languages`, `untranslated_languages`, `has_default_file` (whether an untyped `{template}.md` exists), `explicit_language_files` (the subset of languages backed by a real `{template}.{lang}.md` on disk).'
        - name: lang
          type: string
          required: false
          description: 'Return the page in a specific language (overrides the request''s active language).'
    request_example: ''
    response_example: '{"data": {"route": "/blog/my-post", "slug": "my-post", "title": "My Post", "template": "post", "content": "# Hello World", "header": {"published": true}, "media": [], "has_default_file": true, "explicit_language_files": ["fr"]}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '304'
          description: 'Not modified (ETag match).'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission, denied by the page''s own rules, or the page uses Twig in content and the caller lacks that permission.'
        - code: '404'
          description: 'Page not found.'
        - code: '422'
          description: 'Invalid language code.'
---
