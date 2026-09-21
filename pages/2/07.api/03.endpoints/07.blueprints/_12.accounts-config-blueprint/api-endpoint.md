---
title: Get Accounts Config Blueprint
api:
    method: GET
    path: /blueprints/config/accounts
    description: 'Get the Flex accounts configuration blueprint, the form behind the Configuration tab of the Users page. Requires `api.config.read`. Built with the same Flex directory blueprint classic admin uses, so it includes the shared Caching tab alongside the user-accounts settings. Pair it with `GET /config/accounts`. Fires `onApiBlueprintResolved` with `context: config` and `template: accounts`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"name": "accounts", "title": "Accounts Configuration", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "object.cache.index.enabled", "type": "toggle", "label": "Enable Index Caching"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.config.read` permission'
        - code: '404'
          description: 'Flex Objects is not available, or the `user-accounts` Flex directory is not registered'
---
