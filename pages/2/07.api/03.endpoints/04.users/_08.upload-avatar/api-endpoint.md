---
title: Upload Avatar
api:
    method: POST
    path: '/users/{username}/avatar'
    description: 'Upload a custom avatar image for a user. Send as multipart/form-data. Your own avatar needs no extra permission; anyone else''s needs `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to upload the avatar for'
        - name: avatar
          type: file
          required: true
          description: 'Image file (PNG, JPEG, or WebP, up to 8 MB). The field may also be named `file`. The file contents are checked, not the declared type.'
    request_example: ''
    response_example: '{"data": {"username": "admin", "email": "admin@example.com", "fullname": "Site Admin", "title": "", "state": "enabled", "language": "", "content_editor": "", "access": {"admin": {"super": true}}, "groups": [], "avatar_url": "/api/v1/thumbnails/3f2a9c1b.jpg", "twofa_enabled": false, "twofa_secret": false, "created": "2026-09-01T10:00:00+00:00", "modified": "2026-09-01T10:00:00+00:00"}}'
    response_codes:
        - code: '201'
          description: 'Avatar uploaded; the body is the updated user'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`, or a non-super caller changing a super admin)'
        - code: '404'
          description: 'User not found'
        - code: '422'
          description: 'Validation error (no file, file too large, or not a PNG, JPEG or WebP image)'
---

