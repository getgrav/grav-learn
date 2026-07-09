---
title: Floating Widgets
api:
    method: GET
    path: '/floating-widgets'
    description: 'Collect persistent UI widgets (chat assistants, notification panels) registered by plugins via `onApiFloatingWidgets`. Each widget ships a web component at `admin-next/widgets/{slug}.js` that Admin2 loads on-demand via `/gpm/plugins/{slug}/widget-script`. A widget may set `autoLoad` to load its script eagerly and `routes` to scope that autoload to specific admin views.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "ai-pro-chat", "plugin": "ai-pro", "label": "AI Assistant", "icon": "bot", "priority": 10}, {"id": "users-enhancer", "plugin": "my-plugin", "label": "Users enhancer", "showFab": false, "autoLoad": true, "routes": ["/users"]}]}'
    response_codes:
        - code: '200'
          description: 'Widgets returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

Each widget carries an `id`, `plugin`, `label`, `icon` and optional `priority`. Two optional flags control loading:

- `autoLoad` — load the widget's script eagerly instead of on first launcher click. Used by field/table enhancers that register behavior without showing a floating action button (usually paired with `showFab: false`).
- `routes` — a list of admin-internal SPA routes (`/users`, `/pages`, `/plugin/my-plugin`) an autoloading widget applies to. Admin2 loads the script only on an exact route match; omit it to load on every route. The API normalizes each entry to a leading-slash, trailing-slash-free path and drops invalid ones. `routes` scopes script loading only — it is not a permission boundary; `authorize` remains the security check.

See the [API Events](/20/api/events) page for the `onApiFloatingWidgets` contract and the [Developer Guide](/20/api/developer-guide#floating-widgets) for the full widget recipe.
