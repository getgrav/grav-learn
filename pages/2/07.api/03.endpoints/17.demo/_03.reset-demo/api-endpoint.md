---
title: Reset Demo
api:
    method: POST
    path: '/demo/reset'
    description: 'Restore the demo content from the captured baseline now, waiting for any background reset already in progress. Without a baseline nothing happens and `reset` is `false`, still with a 200. Fires `onApiDemoReset` and sends `X-Invalidates: demo:status`. Requires a super admin (a scoped API key needs the `admin.super` scope); demo accounts get 403 even when they are super.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"reset": true, "message": "Demo content reset to baseline.", "status": {"baseline_exists": true, "writable": ["api.pages.write", "api.media.write"], "roots": ["pages", "media"], "reset_interval": 30, "reset_on_request": true, "reset_on_schedule": true, "last_reset": 1790000000, "seconds_until_reset": 1800}}}'
    response_codes:
        - code: '200'
          description: 'Reset attempted; `reset` says whether content was restored.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin, a scoped key without `admin.super`, or a demo account.'
---
