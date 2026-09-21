---
title: List Page Types
api:
    method: GET
    path: /blueprints/pages
    description: 'List the page templates (blueprints) available for new pages, after the `onAdminPageTypes` / `onAdminModularPageTypes` hooks and the configured hidden types are applied. Requires `api.pages.read`.'
    parameters:
        - name: modular
          type: boolean
          required: false
          description: 'Query parameter: `true` (or `1` / `yes`) lists modular templates instead of regular page templates'
    request_example: ''
    response_example: '{"data": [{"type": "default", "label": "Default"}, {"type": "blog", "label": "Blog"}, {"type": "post", "label": "Post"}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.read` permission'
---

