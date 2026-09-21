---
title: Demo Status
api:
    method: GET
    path: '/demo/status'
    description: 'The demo-mode reset state that drives the Admin Next demo banner and its countdown. Any authenticated account can call it; no specific permission is needed. See the [collection introduction](/2/api/endpoints/demo) for the fields.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"baseline_exists": true, "writable": ["api.pages.write", "api.media.write"], "roots": ["pages", "media"], "reset_interval": 30, "reset_on_request": true, "reset_on_schedule": true, "last_reset": 1790000000, "seconds_until_reset": 1234}}'
    response_codes:
        - code: '200'
          description: 'Status returned.'
        - code: '401'
          description: 'Unauthorized.'
---
