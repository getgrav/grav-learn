---
title: List Taxonomy
api:
    method: GET
    path: '/taxonomy'
    description: 'Return every taxonomy type (e.g. `category`, `tag`) with the full list of values used across all pages. Every type declared in `site.taxonomies` is included, with an empty list when no page uses it yet. Internal file paths are stripped, so only the term values are returned.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"category": ["blog", "docs"], "tag": ["php", "grav", "api"], "author": []}}'
    response_codes:
        - code: '200'
          description: 'Taxonomy map returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
---
