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
          description: 'Number of results per page (default 20, capped at `plugins.api.pagination.max_per_page`, 1000 by default).'
        - name: sort
          type: string
          required: false
          description: 'Sort field: `date`, `title`, `slug`, `modified`, `order`, or `default`. When omitted, pages are sorted by `date` descending. `default` with `children_of` uses the parent''s native page ordering; without `children_of` it sorts by `order` ascending. An unknown field returns 422.'
        - name: order
          type: string
          required: false
          description: 'Sort direction: `asc` (default) or `desc`. Ignored when `sort` is omitted.'
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
          type: boolean
          required: false
          description: '`true` returns only top-level pages (direct children of the pages root, so children of the home page are not counted). `false` returns every page that is not top-level.'
        - name: locate
          type: string
          required: false
          description: 'Route of a page to jump to. When it is in the filtered, sorted results, the server returns the chunk that contains it (overriding `page`) and reports its position in `meta.pagination.located_at_index`.'
        - name: lang
          type: string
          required: false
          description: 'List pages in a specific language. A code that is not a configured language returns 422.'
        - name: translations
          type: boolean
          required: false
          description: 'Include translation metadata on each item: `translated_languages`, `untranslated_languages`, `has_default_file`, `explicit_language_files`.'
    request_example: ''
    response_example: '{"data": [{"route": "/blog", "slug": "blog", "title": "Blog", "template": "blog", "published": true, "visible": true, "routable": true, "has_children": true, "permissions": {"create": true, "read": true, "update": true, "delete": true, "publish": true, "list": true}}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 42, "total_pages": 3}}, "links": {"self": "/api/v1/pages?page=1&per_page=20", "next": "/api/v1/pages?page=2&per_page=20", "last": "/api/v1/pages?page=3&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
        - code: '422'
          description: 'Unknown sort field or invalid language code.'
---
