---
title: Get User
api:
    method: GET
    path: '/users/{username}'
    description: 'Get user details. Reading your own account needs only `api.access`; reading anyone else''s needs `api.users.read`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to retrieve'
    request_example: ''
    response_example: |
        {
            "data": {
                "username": "editor",
                "email": "editor@example.com",
                "fullname": "Jane Editor",
                "title": "",
                "state": "enabled",
                "language": "",
                "content_editor": "",
                "access": { "api": { "access": true, "pages": { "read": true, "write": true } } },
                "groups": [],
                "avatar_url": null,
                "twofa_enabled": false,
                "twofa_secret": false,
                "created": "2026-09-01T10:00:00+00:00",
                "modified": "2026-09-01T10:00:00+00:00",
                "twofa_global_enabled": true
            }
        }
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (reading another account without `api.users.read`)'
        - code: '404'
          description: 'User not found'
---

The response carries an `ETag` header; send it back as `If-Match` on [Update User](/2/api/endpoints/users/update-user) to guard against overwriting a concurrent change. `twofa_secret` only says whether a secret has been generated, and `twofa_global_enabled` says whether the Login plugin's 2FA support is installed, so a client knows whether to offer 2FA setup. Any custom fields the site added to the account blueprint are included too.
