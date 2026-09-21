---
title: Capture Baseline
api:
    method: POST
    path: '/demo/baseline'
    description: 'Snapshot the writable demo content folders as the baseline that resets restore. When `plugins.api.demo.writable` maps to no existing content folder nothing is captured and `captured` is `false`, still with a 200. On success it fires `onApiDemoBaselineCaptured` and sends `X-Invalidates: demo:status`. Requires a super admin (a scoped API key needs the `admin.super` scope); demo accounts get 403 even when they are super.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"captured": true, "message": "Demo baseline captured.", "status": {"baseline_exists": true, "writable": ["api.pages.write", "api.media.write"], "roots": ["pages", "media"], "reset_interval": 30, "reset_on_request": true, "reset_on_schedule": true, "last_reset": 1790000000, "seconds_until_reset": 1800}}}'
    response_codes:
        - code: '200'
          description: 'Capture attempted; `captured` says whether a baseline was saved.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin, a scoped key without `admin.super`, or a demo account.'
---

When nothing was captured, `message` is "No writable demo resources are configured, so there is nothing to capture."

Capturing replaces any previous baseline and restarts the reset timer, so `last_reset` is set to the capture time.
