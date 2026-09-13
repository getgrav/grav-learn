---
title: Compare Translations
api:
    method: GET
    path: '/pages/{route}/compare'
    description: 'Return side-by-side title/content/header/modified for two language versions of a page. Drives translation diff UIs in Admin2. Missing translations return `exists: false` rather than 404 so clients can still show "target missing" states.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
        - name: source
          type: string
          required: true
          description: 'Source language code (query param).'
        - name: target
          type: string
          required: true
          description: 'Target language code (query param).'
    request_example: ''
    response_example: '{"data": {"route": "/blog/my-post", "source": {"lang": "en", "exists": true, "title": "My Post", "content": "# Hello", "header": {"title": "My Post"}, "modified": "2026-04-17T10:00:00+00:00"}, "target": {"lang": "fr", "exists": false, "title": "My Post", "content": "# Hello", "header": {"title": "My Post"}, "modified": null}}}'
    response_codes:
        - code: '200'
          description: 'Comparison returned (source/target may be null or `exists: false`).'
        - code: '400'
          description: 'Missing `source` / `target` query param, or invalid language code.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
---
