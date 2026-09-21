---
title: Get Current User
api:
    method: GET
    path: '/me'
    description: 'Return the authenticated user''s profile and resolved permissions. Admin2 calls this on every load to bootstrap the UI with the current identity, access map, demo-mode state, running Grav core version, and active admin plugin version. The profile fields are the same `user` object the login endpoints return.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"username": "admin", "fullname": "Site Admin", "email": "admin@example.com", "avatar_url": "/user/accounts/avatars/admin.png", "super_admin": true, "access": {"api": {"access": true, "super": true}, "site": {"login": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}, "grav_version": "2.0.0-beta.1", "admin_version": "3.0.0-beta.1"}}'
    response_codes:
        - code: '200'
          description: 'Profile returned.'
        - code: '401'
          description: 'Not authenticated.'
        - code: '403'
          description: 'User lacks `api.access`.'
---

The response includes:

- `access` — the fully resolved permission map (inherited + direct), not the raw YAML. Use this instead of re-deriving permissions client-side.
- `demo_mode`: whether the account is a demo account (`access.api.demo`). For a demo account, `writable` lists the paths it may still write and `seconds_until_reset` counts down to the next demo reset; a normal account gets `writable: []` and `seconds_until_reset: null`. `reset_interval` (minutes) is always present.
- `grav_version` — value of `GRAV_VERSION` on the server.
- `admin_version` — version of the enabled admin plugin (checks `admin2` first, then `admin`), read from its `blueprints.yaml`. `null` if neither is enabled.
- `content_editor` — the user's preferred content editor (empty string if unset).
