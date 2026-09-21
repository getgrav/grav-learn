---
title: Save Site Dashboard Layout
api:
    method: PATCH
    path: /dashboard/site-layout
    description: 'Save the default dashboard layout for every user to `dashboard.site_layout` in `user/config/admin-next.yaml`, and return the resolved widget list for the caller. Requires a super user (subject to the API key scope cap). Demo accounts are refused.'
    parameters:
        - name: preset
          type: string
          required: false
          description: 'One of `default`, `minimal`, `compact`, `custom`. Anything else is stored as `custom`.'
        - name: widgets
          type: array
          required: false
          description: 'Widget entries: `id` (string, required), `visible` (boolean, default true), `size` (`xs` to `xl`) and `order` (number).'
    request_example: '{"preset": "custom", "widgets": [{"id": "core.news-feed", "visible": false}, {"id": "core.stats", "size": "xl", "order": 10}]}'
    response_example: '{"data": {"widgets": [{"id": "core.stats", "source": "core", "label": "ADMIN_NEXT.DASHBOARD.WIDGETS.STATS", "icon": "BarChart3", "sizes": ["md", "lg", "xl"], "defaultSize": "xl", "priority": 100, "visible": true, "size": "xl", "order": 10}], "user_layout": {}, "site_layout": {"preset": "custom", "widgets": [{"id": "core.news-feed", "visible": false, "size": null}, {"id": "core.stats", "visible": true, "size": "xl", "order": 10}]}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Site layout saved; resolved widget list returned.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super user, or a demo account'
        - code: '422'
          description: 'The body is not a JSON object.'
---

The stored layout is replaced as a whole, with the same normalization as `PATCH /dashboard/layout`. A widget marked `visible: false` here is hidden for every user and can't be turned back on in a user's own layout. Sizes and orders act as defaults that each user's layout can override.
