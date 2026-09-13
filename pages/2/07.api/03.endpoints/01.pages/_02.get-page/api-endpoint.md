---
title: Get Page
api:
    method: GET
    path: '/pages/{route}'
    description: 'Get a single page with full content, metadata, and media. Returns an ETag; use `If-None-Match` for conditional fetches.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (e.g. `/blog/my-post`).'
        - name: summary
          type: boolean
          required: false
          description: 'Include page summary in the response.'
        - name: render
          type: boolean
          required: false
          description: 'Return rendered HTML content instead of raw markdown.'
        - name: children
          type: boolean
          required: false
          description: 'Include child pages in the response.'
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
          description: 'Missing `api.pages.read` permission.'
        - code: '404'
          description: 'Page not found.'
---
