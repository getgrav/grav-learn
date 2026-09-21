---
title: Update User
api:
    method: PATCH
    path: '/users/{username}'
    description: 'Update a user account. Only the fields you send are changed. You can update your own account with `api.access`; updating anyone else needs `api.users.write`.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to update (path parameter)'
        - name: email
          type: string
          required: false
          description: 'Updated email address'
        - name: fullname
          type: string
          required: false
          description: 'Updated full display name'
        - name: title
          type: string
          required: false
          description: 'Updated title'
        - name: language
          type: string
          required: false
          description: 'Preferred admin language'
        - name: content_editor
          type: string
          required: false
          description: 'Preferred content editor'
        - name: state
          type: string
          required: false
          description: 'Updated account state (`enabled` or `disabled`). Requires `api.users.write`.'
        - name: access
          type: object
          required: false
          description: 'Updated permission access object. Requires `api.users.write`; only a super admin can grant super access.'
        - name: groups
          type: array
          required: false
          description: 'Updated group names. Super admins only.'
        - name: password
          type: string
          required: false
          description: 'New password. It must match `system.pwd_regex` when set, and be at least 8 characters when not.'
    request_example: '{"fullname": "Jane Q. Editor", "password": "N3wSecurePass!"}'
    response_example: '{"data": {"username": "editor", "email": "editor@example.com", "fullname": "Jane Q. Editor", "title": "", "state": "enabled", "language": "", "content_editor": "", "access": {}, "groups": [], "avatar_url": null, "twofa_enabled": false, "twofa_secret": false, "created": "2026-09-01T10:00:00+00:00", "modified": "2026-09-21T10:00:00+00:00", "twofa_global_enabled": true}}'
    response_codes:
        - code: '200'
          description: 'User updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`, sending `state`/`access`/`groups` without the right permission, or a non-super caller editing a super admin)'
        - code: '404'
          description: 'User not found'
        - code: '409'
          description: 'Conflict (ETag mismatch)'
        - code: '422'
          description: 'Validation error (empty body, password fails the policy, or a field fails the account blueprint)'
---

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header. Include the ETag from your last GET request to prevent overwriting concurrent changes.

`twofa_enabled` and `twofa_secret` are ignored here, so a client can send back the whole user object without error. Two-factor authentication only changes through the [Enable 2FA](/2/api/endpoints/users/enable-2fa) and [Disable 2FA](/2/api/endpoints/users/disable-2fa) endpoints, which check a code when you change your own account.

Changing the password or setting `state` to `disabled` invalidates every API token already issued for the account. Custom fields the site added to the account blueprint can be sent as well.
