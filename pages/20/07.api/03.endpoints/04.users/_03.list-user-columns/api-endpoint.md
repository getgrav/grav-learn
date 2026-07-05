---
title: List User Columns
api:
    method: GET
    path: /users/columns
    description: 'List the extra columns plugins have added to the Users list through the `onApiUserListColumns` event, gated by the caller''s permissions. Each column declares how a plugin-owned value is labelled and formatted; the values themselves ride along inside each user''s `extra` map on `GET /users`, populated by `onApiUserListColumnData` for the current page only.'
    parameters: []
    request_example: ''
    response_example: |
        {
            "data": {
                "columns": [
                    {
                        "id": "my-plugin-valid-till",
                        "plugin": "my-plugin",
                        "label": "Valid until",
                        "field": "subscription.valid_till",
                        "formatter": "datetime",
                        "sortable": false,
                        "priority": 50
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

The response `data.columns` is the ordered list of plugin-declared columns. Each column carries:

- `id` — unique column id.
- `plugin` — the owning plugin slug.
- `label` — the plain-text column header.
- `field` — the key to read from each user's `extra` map on `GET /users`.
- `formatter` — one of `text`, `link`, `date`, `datetime`, `boolean`, `number`, `badge`. The server validates this against the whitelist and falls back to `text` for anything else; the client renders it, so no markup or renderer crosses the wire.
- `sortable` — optional; whether the column offers a client-side sort of the current page.
- `priority` — optional; higher sorts earlier.

Columns are plugin-owned but safe by construction: the values in each user's `extra` map are scalars only, an `authorize` check is re-run server-side (and stripped from this response), and the data event is isolated so a misbehaving plugin degrades to missing values rather than breaking the listing. Column values are resolved only for the accounts on the current page — never for every account. Like the filter tabs, columns require the Flex-accounts backend.

See the [API Events](/20/api/events) page for the `onApiUserListColumns` and `onApiUserListColumnData` contracts.
