---
title: Check Updates
template: api-endpoint
api:
    method: GET
    path: /gpm/updates
    description: 'Check for available updates across all packages.'
    parameters:
        - name: flush
          type: boolean
          required: false
          description: 'Bypass cache and fetch fresh update data'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

