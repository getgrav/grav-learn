---
title: Delete Avatar
api:
    method: DELETE
    path: '/users/{username}/avatar'
    description: 'Remove the custom avatar for a user. Your own avatar needs no extra permission; anyone else''s needs `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to remove the avatar for'
    request_example: ''
    response_example: '{"data": {"username": "admin", "email": "admin@example.com", "fullname": "Site Admin", "title": "", "state": "enabled", "language": "", "content_editor": "", "access": {"admin": {"super": true}}, "groups": [], "avatar_url": null, "twofa_enabled": false, "twofa_secret": false, "created": "2026-09-01T10:00:00+00:00", "modified": "2026-09-01T10:00:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'Avatar removed; the body is the updated user'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`, or a non-super caller changing a super admin)'
        - code: '404'
          description: 'User not found'
---

