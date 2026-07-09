---
title: List User Row Actions
api:
    method: GET
    path: /users/row-actions
    description: 'List the per-user action buttons plugins have added to the Users list through the `onApiUserListRowActions` event, filtered by the caller''s permissions. Each action is a formatter-free descriptor Admin2 renders in a user row''s Actions cell; invoking one calls `POST /users/{username}/row-action`.'
    parameters: []
    request_example: ''
    response_example: |
        {
            "data": {
                "actions": [
                    {
                        "id": "impersonate-user",
                        "plugin": "impersonate",
                        "label": "Impersonate",
                        "icon": "fa-user-secret",
                        "action": "start",
                        "confirm": "Impersonate this user?",
                        "priority": 80
                    }
                ]
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

The response `data.actions` is the ordered list of plugin-declared row actions. Each action carries:

- `id` — unique action id; the key posted to the execution endpoint.
- `plugin` — the owning plugin slug.
- `label` — the plain-text button label (also its accessible name and tooltip).
- `icon` — optional Font Awesome icon class.
- `action` — optional verb passed back to the handler; opaque to the client.
- `confirm` — optional prompt shown in a confirmation dialog before the action runs.
- `priority` — optional; higher sorts earlier.

Actions are plugin-owned but safe by construction: no markup or renderer crosses the wire, the list is capped, and the `authorize` check is re-run server-side and stripped from this response. The `authorize` on a declaration gates only which buttons render — it is not a security boundary; the [execution endpoint](/20/api/endpoints/users/execute-user-row-action) re-authorizes independently. Like the filter tabs and columns, row actions require the Flex-accounts backend.

See the [API Events](/20/api/events) page for the `onApiUserListRowActions` and `onApiUserListRowAction` contracts.
