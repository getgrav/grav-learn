---
title: Save Dashboard Layout
api:
    method: PATCH
    path: /dashboard/layout
    description: 'Save the current user''s dashboard layout to `admin_next.dashboard` in their account YAML, and return the resolved widget list (the same as `GET /dashboard/widgets`). Requires `api.access`. Demo accounts are refused.'
    parameters:
        - name: preset
          type: string
          required: false
          description: 'One of `default`, `minimal`, `compact`, `custom`. Anything else is stored as `custom`.'
        - name: widgets
          type: array
          required: false
          description: 'Widget entries: `id` (string, required), `visible` (boolean, default true), `size` (`xs` to `xl`) and `order` (number).'
    request_example: '{"preset": "custom", "widgets": [{"id": "core.stats", "visible": true, "size": "lg", "order": 10}, {"id": "core.news-feed", "visible": false, "order": 20}]}'
    response_example: '{"data": {"widgets": [{"id": "core.stats", "source": "core", "label": "ADMIN_NEXT.DASHBOARD.WIDGETS.STATS", "icon": "BarChart3", "sizes": ["md", "lg", "xl"], "defaultSize": "xl", "priority": 100, "visible": true, "size": "lg", "order": 10}], "user_layout": {"preset": "custom", "widgets": [{"id": "core.stats", "visible": true, "size": "lg", "order": 10}, {"id": "core.news-feed", "visible": false, "size": null, "order": 20}]}, "site_layout": {}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Layout saved; resolved widget list returned.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.access` permission, or a demo account'
        - code: '422'
          description: 'The body is not a JSON object.'
---

Despite the `PATCH` verb, the stored layout is replaced as a whole, so send every widget entry you want to keep. Entries without a string `id` are dropped, and a `size` outside `xs` to `xl` is stored as `null`. An entry sent without a numeric `order` is stored without one, so that widget keeps its priority-based position instead of jumping to the top.
