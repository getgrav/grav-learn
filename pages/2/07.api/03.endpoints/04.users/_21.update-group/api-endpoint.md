---
title: Update Group
api:
    method: PATCH
    path: '/groups/{name}'
    description: 'Update a user group. Only the fields you send are changed; `access` is replaced as a whole. Requires a super admin. Fires `onApiGroupUpdated`.'
    parameters:
        - name: name
          type: string
          required: true
          description: 'The group name (path parameter). Groups cannot be renamed.'
        - name: readableName
          type: string
          required: false
          description: 'Display name'
        - name: description
          type: string
          required: false
          description: 'Description'
        - name: icon
          type: string
          required: false
          description: 'Icon name'
        - name: enabled
          type: boolean
          required: false
          description: 'Whether the group is active'
        - name: access
          type: object
          required: false
          description: 'Permission access object. Replaces the existing one.'
    request_example: '{"description": "Can edit and publish site content", "enabled": true}'
    response_example: '{"data": {"groupname": "editors", "readableName": "Editors", "description": "Can edit and publish site content", "icon": "users", "enabled": true, "access": {"api": {"access": true, "pages": {"read": true, "write": true}}}}}'
    response_codes:
        - code: '200'
          description: 'Group updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (not a super admin)'
        - code: '404'
          description: 'Group not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Validation error (empty body)'
---

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header. Include the ETag from your last GET request to prevent overwriting concurrent changes.
