---
title: Get Accounts Config
api:
    method: GET
    path: /config/accounts
    description: 'Get the Flex accounts configuration (`flex.accounts`, stored in `user/config/flex/accounts.yaml`), the Configuration tab under Users. Requires `admin.super`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"object": {"compat": {"events": true}}}}'
    response_codes:
        - code: '200'
          description: 'Success. The `ETag` header holds the value to send as `If-Match` on the next update.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super user'
---

This route takes precedence over `GET /config/{scope}`, so `accounts` is never read as a generic scope.
