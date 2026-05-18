---
title: List Pages
api:
    method: GET
    path: '/pages'
    description: 'List pages with filtering, sorting, and pagination. Backed by the Flex page directory when available (indexed, cached), falling back to the standard Pages service otherwise. When `translations=true`, each item includes `has_default_file` and `explicit_language_files` so clients can disambiguate real translation files from default-language fallbacks.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default 20, max 100).'
        - name: sort
          type: string
          required: false
          description: 'Sort field: `date`, `title`, `slug`, `modified`, `order`, or `default`. `default` with `children_of` uses native page ordering.'
        - name: order
          type: string
          required: false
          description: 'Sort direction: `asc` or `desc`.'
        - name: search
          type: string
          required: false
          description: 'Full-text search across indexed page fields (Flex backend only).'
        - name: published
          type: boolean
          required: false
          description: 'Filter by published state.'
        - name: visible
          type: boolean
          required: false
          description: 'Filter by visible state.'
        - name: routable
          type: boolean
          required: false
          description: 'Filter by routable state.'
        - name: template
          type: string
          required: false
          description: 'Filter by page template name.'
        - name: parent
          type: string
          required: false
          description: 'Filter to descendants whose route starts with this parent path (e.g. `/blog` returns `/blog/post-1`, `/blog/sub/post-2`).'
        - name: children_of
          type: string
          required: false
          description: 'Filter to direct children of a given route.'
        - name: root
          type: string
          required: false
          description: 'Restrict the listing to a subtree root.'
        - name: translations
          type: boolean
          required: false
          description: 'Include translation metadata on each item: `translated_languages`, `untranslated_languages`, `has_default_file`, `explicit_language_files`.'
    request_example: ''
    response_example: '{"data": [{"route": "/blog", "slug": "blog", "title": "Blog", "template": "blog", "published": true}], "meta": {"total": 42, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
---
