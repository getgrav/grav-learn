---
title: Resend Invitation
api:
    method: POST
    path: '/invitations/{token}/resend'
    description: 'Send the email for a pending invitation again. The token and expiry stay the same. Requires `api.users.write`.'
    parameters:
        - name: token
          type: string
          required: true
          description: 'The invitation token (path parameter)'
        - name: message
          type: string
          required: false
          description: 'Personal note included in the email'
        - name: admin_base_url
          type: string
          required: false
          description: 'Admin base URL to build the invite link from'
    request_example: '{"message": "Reminder: your invitation is waiting."}'
    response_example: '{"data": {"token": "b7c1e0f4a9d2...", "email": "new.editor@example.com", "fullname": "New Editor", "groups": [], "created": 1758448800, "created_by": "admin", "created_by_name": "Site Admin", "expires": 1759053600, "expired": false, "link": "https://example.com/admin/invite?token=b7c1e0f4a9d2...", "email_sent": true}}'
    response_codes:
        - code: '200'
          description: 'Email sent'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.write`)'
        - code: '404'
          description: 'Invitation not found or expired'
        - code: '422'
          description: 'Email is not configured'
---

