---
title: Revoke Invitation
api:
    method: DELETE
    path: '/invitations/{token}'
    description: 'Revoke a pending invitation so its link no longer works. Requires `api.users.write`.'
    parameters:
        - name: token
          type: string
          required: true
          description: 'The invitation token (path parameter)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Invitation revoked'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`)'
        - code: '404'
          description: 'Invitation not found'
---

