---
title: Create Invitation
api:
    method: POST
    path: /invitations
    description: 'Create an invitation with preset access and send it by email when the Email plugin is configured. The recipient picks their own username and password when accepting, and gets exactly the access set here. Requires `api.users.write`.'
    parameters:
        - name: email
          type: string
          required: true
          description: 'Address to invite. Any pending invitation for the same address is replaced.'
        - name: fullname
          type: string
          required: false
          description: 'Name to prefill on the accept form'
        - name: access
          type: object
          required: false
          description: 'Permission access object the new account gets. `admin.super` and `api.super` are stripped unless the caller is a super admin.'
        - name: groups
          type: array
          required: false
          description: 'Groups the new account joins. Applied only when the caller is a super admin; ignored otherwise.'
        - name: expiration
          type: integer
          required: false
          description: 'Seconds until the invitation expires. Defaults to `plugins.api.invitations.expiration` (7 days). Values under 300 fall back to the default, and the maximum is 30 days (2592000).'
        - name: message
          type: string
          required: false
          description: 'Personal note included in the email'
        - name: admin_base_url
          type: string
          required: false
          description: 'Admin base URL to build the invite link from, when the admin is served somewhere other than the default'
    request_example: '{"email": "new.editor@example.com", "fullname": "New Editor", "access": {"api": {"access": true, "pages": {"read": true}}}, "expiration": 604800}'
    response_example: '{"data": {"token": "b7c1e0f4a9d2...", "email": "new.editor@example.com", "fullname": "New Editor", "groups": [], "created": 1758448800, "created_by": "admin", "created_by_name": "Site Admin", "expires": 1759053600, "expired": false, "link": "https://example.com/admin/invite?token=b7c1e0f4a9d2...", "email_sent": false, "warning": "Email is not configured, so no invitation email was sent. Share the link manually."}}'
    response_codes:
        - code: '201'
          description: 'Invitation created. The `Location` header points to `/auth/invite/{token}`, the public endpoint that validates and accepts it.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`)'
        - code: '409'
          description: 'A user with that email already exists'
        - code: '422'
          description: 'Validation error (missing or invalid email)'
---

The invitation is created even when the email can't be sent. In that case `email_sent` is `false` and `warning` explains why, so the link can be shared by hand. The recipient opens the link, and the accept form uses `GET /auth/invite/{token}` and `POST /auth/invite/{token}` to create the account.
