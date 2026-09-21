---
title: Compare Translations
api:
    method: GET
    path: '/pages/{route}/compare'
    description: 'Return side-by-side title/content/header/modified for two language versions of a page. Drives translation diff UIs in Admin2. A side is `null` when the page does not resolve in that language, and `exists` is `false` when it resolves only through the default-language fallback rather than its own file, so clients can still show "target missing" states. Requires multi-language to be enabled and `api.pages.read`, and neither the source nor the target version may deny the caller read access.'
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
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission, or the source or target version denies read access.'
        - code: '422'
          description: 'Missing `source` / `target` query param, a language code that is not a string (for example `source[]=`) or not configured, or multi-language not enabled.'
---
