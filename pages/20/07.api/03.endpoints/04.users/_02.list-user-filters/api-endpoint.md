---
title: List User Tabs
api:
    method: GET
    path: /users/filters
    description: 'List the filter tabs available for the Users list, along with the landing-view policy. Returns the built-in "All Users" tab plus any tabs contributed by plugins through the `onApiUserListFilters` event, gated by the caller''s permissions. Selecting a tab adds `?filter=<id>` to `GET /users`, which fires `onApiUserListFilter` so the owning plugin can narrow the listing before pagination.'
    parameters: []
    request_example: ''
    response_example: |
        {
            "data": {
                "tabs": [
                    { "id": "all", "plugin": "api", "label": "All Users" },
                    { "id": "active", "plugin": "my-plugin", "label": "Active", "icon": "fa-bolt", "priority": 10 }
                ],
                "defaultFilter": "all",
                "showAll": true
            }
        }
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden — requires `api.users.read`'
---

The response `data` is an object with three keys:

- `tabs` — the ordered tab row. Each tab carries an `id` (sent back as `?filter=<id>`; `all` is reserved for the built-in tab), a `plugin` slug, and a plain-text `label`. Tabs may also include `icon`, `priority` (higher sorts earlier), and `badge` / `badgeEndpoint` for a live count.
- `defaultFilter` — the tab the client should open on when no `filter` is present in the URL. Defaults to `all`; a plugin can nominate another tab via `$event['defaultFilter']` (it is honoured only when it maps to a tab the caller can see, otherwise it falls back to the first tab).
- `showAll` — whether the built-in "All Users" tab is present. It is `true` by default; a plugin can set `$event['showAll'] = false` to drop it when showing every account isn't a useful (or safe) landing view. "All Users" is only dropped once the plugin has contributed at least one authorized tab, so the row is never empty.

A plugin filter can only *narrow* the listing: search, the caller's permission scope, and pagination are all applied by the core endpoint after the plugin's filter runs, so a tab can never widen visibility or change the response envelope. See the [API Events](/20/api/events) page for the `onApiUserListFilters` and `onApiUserListFilter` contracts.
