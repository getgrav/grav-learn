---
title: Create User
api:
    method: POST
    path: /users
    description: 'Create a new user account. Requires `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Unique username, 3 to 64 characters. It cannot start with a period or contain `..`, and cannot contain \ / ? * : ; { } or a line break.'
        - name: password
          type: string
          required: true
          description: 'User password. It must match the site''s `system.pwd_regex` when one is set, and be at least 8 characters when none is.'
        - name: email
          type: string
          required: true
          description: 'User email address'
        - name: fullname
          type: string
          required: false
          description: 'Full display name'
        - name: title
          type: string
          required: false
          description: 'Title shown with the account'
        - name: state
          type: string
          required: false
          description: 'Account state, `enabled` (default) or `disabled`'
        - name: access
          type: object
          required: false
          description: 'Permission access object. Only a super admin can grant `admin.super` or `api.super`.'
        - name: groups
          type: array
          required: false
          description: 'Group names. Applied only when the caller is a super admin; ignored otherwise.'
    request_example: '{"username": "editor", "password": "SecurePass123!", "email": "editor@example.com", "fullname": "Jane Editor"}'
    response_example: '{"data": {"username": "editor", "email": "editor@example.com", "fullname": "Jane Editor", "title": "", "state": "enabled", "language": "", "content_editor": "", "access": {}, "groups": [], "avatar_url": null, "twofa_enabled": false, "twofa_secret": false, "created": "2026-09-21T10:00:00+00:00", "modified": "2026-09-21T10:00:00+00:00"}}'
    response_codes:
        - code: '201'
          description: 'User created. The `Location` header points to the new user.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`, or a non-super caller granting super access)'
        - code: '409'
          description: 'Username already exists'
        - code: '422'
          description: 'Validation error (missing field, invalid username, password fails the policy, or a field fails the account blueprint)'
---

Any custom fields the site added to the account blueprint (`user/blueprints/user/account.yaml`) can be sent in the body too, and are validated against that blueprint.
