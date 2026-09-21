---
title: Create Group
api:
    method: POST
    path: /groups
    description: 'Create a user group in `user/config/groups.yaml`. Requires a super admin, since group membership can grant any permission. Fires `onApiGroupCreated`.'
    parameters:
        - name: groupname
          type: string
          required: true
          description: 'Group name, 1 to 200 letters, numbers, hyphens or underscores. It is the storage key and cannot be changed later.'
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
          description: 'Whether the group is active (default: true)'
        - name: access
          type: object
          required: false
          description: 'Permission access object granted to members'
    request_example: '{"groupname": "editors", "readableName": "Editors", "description": "Can edit site content", "access": {"api": {"access": true, "pages": {"read": true, "write": true}}}}'
    response_example: '{"data": {"groupname": "editors", "readableName": "Editors", "description": "Can edit site content", "icon": "", "enabled": true, "access": {"api": {"access": true, "pages": {"read": true, "write": true}}}}}'
    response_codes:
        - code: '201'
          description: 'Group created. The `Location` header points to the new group.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (not a super admin)'
        - code: '409'
          description: 'A group with that name already exists'
        - code: '422'
          description: 'Validation error (missing or invalid `groupname`)'
---

