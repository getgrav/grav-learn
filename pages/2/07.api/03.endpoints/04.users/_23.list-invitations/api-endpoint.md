---
title: List Invitations
api:
    method: GET
    path: /invitations
    description: 'List pending invitations, newest first. Expired invitations are purged first. Requires `api.users.write`, because each record carries the token that accepts it.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"invitations": [{"token": "b7c1e0f4a9d2...", "email": "new.editor@example.com", "fullname": "New Editor", "groups": [], "created": 1758448800, "created_by": "admin", "created_by_name": "Site Admin", "expires": 1759053600, "expired": false}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`)'
---

`created` and `expires` are Unix timestamps. The access an invitation grants is not included in the listing.
