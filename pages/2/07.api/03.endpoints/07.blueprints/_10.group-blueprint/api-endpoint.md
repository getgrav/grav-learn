---
title: Get Group Blueprint
api:
    method: GET
    path: /blueprints/groups
    description: 'Get the user group edit blueprint (`user/group.yaml`, resolved through the `blueprints://` stream so site overrides apply). Requires `api.users.read`. Fires `onApiBlueprintResolved` with `context: group`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"name": "group", "title": "Group", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "readableName", "type": "text", "label": "Display Name"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.users.read` permission'
        - code: '404'
          description: 'Group blueprint not found'
---
