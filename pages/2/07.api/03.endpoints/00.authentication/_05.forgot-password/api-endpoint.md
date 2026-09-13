---
title: Forgot Password
api:
    method: POST
    path: '/auth/forgot-password'
    description: 'Request a password reset email. Always returns a neutral success message regardless of whether the email matches an account — prevents account enumeration. Rate-limited per-user via the Login plugin''s `pw_resets` bucket. Requires the Email and Login plugins configured.'
    parameters:
        - name: email
          type: string
          required: true
          description: 'Email address of the account to reset.'
        - name: admin_base_url
          type: string
          required: false
          description: 'Origin + base path of the calling Admin2 client (e.g. `https://example.com/admin`). Used to construct the reset link in the email. Must be an `http`/`https` URL. Falls back to the `Referer` / `Origin` headers, then Grav''s own root URL.'
    request_example: '{"email": "admin@example.com", "admin_base_url": "https://example.com/admin"}'
    response_example: '{"data": {"message": "If an account exists for that email, a reset link has been sent."}}'
    response_codes:
        - code: '200'
          description: 'Request accepted (neutral response regardless of match).'
        - code: '400'
          description: 'Missing email field.'
        - code: '429'
          description: 'Rate limit exceeded for this user.'
---
