---
title: Get Group
api:
    method: GET
    path: '/groups/{name}'
    description: 'Get a single user group. Requires `api.users.read`.'
    parameters:
        - name: name
          type: string
          required: true
          description: 'The group name (path parameter)'
    request_example: ''
    response_example: '{"data": {"groupname": "editors", "readableName": "Editors", "description": "Can edit site content", "icon": "users", "enabled": true, "access": {"api": {"access": true, "pages": {"read": true, "write": true}}}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.read`)'
        - code: '404'
          description: 'Group not found'
---

The response carries an `ETag` header; send it back as `If-Match` on [Update Group](/2/api/endpoints/users/update-group) to guard against overwriting a concurrent change.
