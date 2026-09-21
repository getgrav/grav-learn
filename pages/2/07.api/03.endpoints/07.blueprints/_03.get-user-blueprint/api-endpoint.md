---
title: Get User Blueprint
api:
    method: GET
    path: /blueprints/users
    description: 'Get the user account blueprint schema for rendering the user edit form. Needs only `api.access`, since every signed-in user renders their own profile form with it. Fires `onApiBlueprintResolved` with `context: account`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"name": "account", "title": "Account", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "username", "type": "text", "label": "Username"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'User blueprint not found'
---

