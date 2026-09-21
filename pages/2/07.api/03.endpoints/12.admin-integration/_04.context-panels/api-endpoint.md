---
title: Context Panels
api:
    method: GET
    path: '/context-panels'
    description: 'Collect slide-in panel registrations. Context panels are triggered by toolbar buttons inside Admin2 editors — plugins hook `onApiContextPanels` to register them, specify which editor contexts they appear in (e.g. `pages`), and ship a web component at `admin-next/panels/{slug}.js` served via `/gpm/plugins/{slug}/panel-script`. Optional `badgeEndpoint` returns `{count: N}` to drive a badge on the toolbar button. A panel may declare `authorize` (a permission string, or an array for an any-of test): panels the caller fails are left out and `authorize` is stripped from the response. The rest are sorted by `priority`, highest first, with ties kept in registration order.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "revisions-pro", "plugin": "revisions-pro", "label": "Revision History", "icon": "history", "contexts": ["pages"], "priority": 10, "width": 900, "badgeEndpoint": "/revisions-pro/badge"}]}'
    response_codes:
        - code: '200'
          description: 'Panels returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
