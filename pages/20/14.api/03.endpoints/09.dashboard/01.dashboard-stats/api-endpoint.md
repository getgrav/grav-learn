---
title: Dashboard Stats
template: api-endpoint
api:
    method: GET
    path: /dashboard/stats
    description: 'Get a summary of site statistics for the dashboard.'
    parameters: []
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns a snapshot of site statistics including page counts, user counts, plugin counts, active theme, Grav/PHP versions, and last backup date.
