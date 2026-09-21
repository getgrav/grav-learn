---
title: Delete Group
api:
    method: DELETE
    path: '/groups/{name}'
    description: 'Delete a user group from `user/config/groups.yaml`. Requires a super admin. Fires `onApiGroupDeleted`.'
    parameters:
        - name: name
          type: string
          required: true
          description: 'The group name (path parameter)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Group deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (not a super admin)'
        - code: '404'
          description: 'Group not found'
---

Accounts that list the deleted group in their `groups` keep the entry; it simply no longer grants anything.
