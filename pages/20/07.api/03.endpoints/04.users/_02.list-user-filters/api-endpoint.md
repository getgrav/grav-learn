---
title: List User Tabs
api:
    method: GET
    path: /users/filters
    description: 'List the filter tabs available for the Users list. Returns the built-in "All Users" tab plus any tabs contributed by plugins through the `onApiUserListFilters` event, gated by the caller''s permissions. Selecting a tab adds `?filter=<id>` to `GET /users`, which fires `onApiUserListFilter` so the owning plugin can narrow the listing before pagination.'
    parameters: []
    request_example: ''
    response_example: |
        {
            "data": [
                { "id": "all", "plugin": "api", "label": "All Users" },
                { "id": "active", "plugin": "my-plugin", "label": "Active", "icon": "fa-bolt", "priority": 10 }
            ]
        }
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden — requires `api.users.read`'
---

Each tab carries an `id` (sent back as `?filter=<id>`; `all` is reserved for the built-in tab), a `plugin` slug, and a plain-text `label`. Tabs may also include `icon`, `priority` (higher sorts earlier), and `badge` / `badgeEndpoint` for a live count. The built-in "All Users" tab always leads the row and sends no `filter` parameter.

A plugin filter can only *narrow* the listing: search, the caller's permission scope, and pagination are all applied by the core endpoint after the plugin's filter runs, so a tab can never widen visibility or change the response envelope. See the [API Events](/20/api/events) page for the `onApiUserListFilters` and `onApiUserListFilter` contracts.
