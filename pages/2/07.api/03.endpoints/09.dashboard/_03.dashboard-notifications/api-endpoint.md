---
title: Dashboard Notifications
api:
    method: GET
    path: /dashboard/notifications
    description: 'Get system notifications grouped by display location (`top`, `dashboard`, `feed`), with a `last_checked` timestamp. Requires `api.system.read`.'
    parameters:
        - name: location
          type: string
          required: false
          description: 'Return only one group: `top`, `dashboard`, or `feed`.'
        - name: force
          type: boolean
          required: false
          description: 'Bypass the cached getgrav.org notifications and refetch. The cache otherwise lasts `system.session.timeout` seconds per user, and a failed fetch silently returns the cached copy.'
    request_example: ''
    response_example: '{"data": {"notifications": {"feed": [{"id": 214, "date": "2026-07-31 12:00", "type": "info", "location": ["feed"], "message": "Run a real community on your own site with **Forum Pro** for Grav 2, now available.", "link": "https://getgrav.org/premium/forum-pro"}]}, "last_checked": "2026-09-21T08:00:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

Returns system notifications grouped by location (`feed`, `dashboard`, `top`), plus a `last_checked` timestamp. The response combines the getgrav.org feed with notices contributed by plugins through the [`onApiDashboardNotifications`](/2/api/events) event, then drops any the current user has dismissed — honoring each notice's optional `reappear_after` interval.

Each notification item carries `id`, `message`, and `date`, plus optional `icon` (a Lucide name or emoji), `title`, `action` (`{label, url}`), `link`, `type` (`info`, `notice`, `warning`, or `promo`), and `reappear_after`. The `top` group renders as a rotating banner above the dashboard; `dashboard` and `feed` render in the Notifications widget. Dismiss a notice with `POST /dashboard/notifications/{id}/hide`.

For the plugin-side recipe — raising a persistent, dismissible banner and the difference between notifications and transient toasts — see [Notifications & Toasts](/2/api/developer-guide#notifications-toasts) in the developer guide.
