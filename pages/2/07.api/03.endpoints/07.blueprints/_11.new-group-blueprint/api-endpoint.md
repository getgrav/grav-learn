---
title: Get New Group Blueprint
api:
    method: GET
    path: /blueprints/groups/new
    description: 'Get the user group creation blueprint (`user/group_new.yaml`, resolved through the `blueprints://` stream so site overrides apply). Requires `api.users.read`. Fires `onApiBlueprintResolved` with `context: group_new`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"name": "group_new", "title": "Add Group", "type": null, "child_type": null, "validation": "loose", "fields": [{"name": "groupname", "type": "text", "label": "Group Name"}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.users.read` permission'
        - code: '404'
          description: 'Group creation blueprint not found'
---
