---
title: Dashboard Notifications
template: api-endpoint
api:
    method: GET
    path: /dashboard/notifications
    description: 'Get system notifications grouped by display location.'
    parameters: []
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns system notifications from the Grav notification feed, grouped by location (feed, dashboard, top). Includes a last_checked timestamp.
