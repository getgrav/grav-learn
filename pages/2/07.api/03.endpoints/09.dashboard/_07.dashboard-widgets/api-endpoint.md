---
title: Dashboard Widgets
api:
    method: GET
    path: /dashboard/widgets
    description: 'Get the resolved dashboard widget list and layouts for the current user. Requires `api.access`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"widgets": [{"id": "core.stats", "source": "core", "label": "ADMIN_NEXT.DASHBOARD.WIDGETS.STATS", "icon": "BarChart3", "sizes": ["md", "lg", "xl"], "defaultSize": "xl", "priority": 100, "visible": true, "size": "xl", "order": 9000}], "user_layout": {}, "site_layout": {}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Widget list and layouts returned.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.access` permission'
---

The list merges the built-in core widgets, widgets plugins add through the [`onApiDashboardWidgets`](/2/api/events) event, the site default layout, and the current user's layout. Widgets whose `authorize` permission the user lacks are left out (a super user, within their API key's scope, sees every widget), and `authorize` is stripped from the response. A widget the site layout hides is removed entirely, so a user can't turn it back on.

Each widget is annotated with its effective `visible`, `size` and `order`, and the list is sorted by `order`. A widget with no saved `order` is placed by its `priority`. A plugin widget that doesn't declare its `sizes` gets `sm`, `md` and `lg`, and one without a valid `defaultSize` gets `md` (or its first size), so a widget that leaves them out still renders. Plugin widgets carry `source: plugin`; `can_edit_site` tells the client whether the caller may save the site layout.
