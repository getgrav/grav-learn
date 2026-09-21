---
title: Update Accounts Config
api:
    method: PATCH
    path: /config/accounts
    description: 'Deep-merge the body into the Flex accounts configuration and write it to `user/config/flex/accounts.yaml`. Requires `admin.super`.'
    parameters: []
    request_example: '{"object": {"compat": {"events": false}}}'
    response_example: '{"data": {"object": {"compat": {"events": false}}}}'
    response_codes:
        - code: '200'
          description: 'Configuration updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super user'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Empty body'
---

Nested maps merge and lists are replaced whole. The file is always written to the base `user/config`, never an environment layer, and values supplied through `GRAV_CONFIG__*` environment variables are not written to disk. The response carries an `X-Invalidates: config:update:flex/accounts` header, and the save fires `onApiConfigUpdated` with scope `flex/accounts`.

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header.
