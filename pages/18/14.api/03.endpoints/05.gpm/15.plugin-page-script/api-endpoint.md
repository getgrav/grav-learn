---
title: Get Plugin Page Script
template: api-endpoint
api:
    method: GET
    path: '/gpm/plugins/{slug}/page-script'
    description: 'Serve the page-level web component JavaScript file for a plugin. The file is loaded from admin-next/pages/{slug}.js within the plugin directory. Returned with Content-Type application/javascript and immutable cache headers.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'The plugin slug'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success (JavaScript content)'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page component not found for plugin'
---

