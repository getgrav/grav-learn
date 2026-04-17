---
title: Update All Packages
template: api-endpoint
api:
    method: POST
    path: /gpm/update-all
    description: 'Update all installed plugins and themes that have available updates.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"updated": ["admin", "sitemap"], "failed": []}}'
    response_codes:
        - code: '200'
          description: 'Update process completed'
        - code: '401'
          description: 'Unauthorized'
        - code: '500'
          description: 'Update failed'
---

