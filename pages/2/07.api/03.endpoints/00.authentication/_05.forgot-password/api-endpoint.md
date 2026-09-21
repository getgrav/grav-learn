---
title: Forgot Password
api:
    method: POST
    path: '/auth/forgot-password'
    description: 'Request a password reset email. Always returns a neutral success message regardless of whether the email matches an account — prevents account enumeration. Rate-limited per-user via the Login plugin''s `pw_resets` bucket. Requires the Email and Login plugins configured. The reset link points at the admin''s own `/reset` route and is valid for 24 hours. When the site''s login captcha covers the forgotten-password flow, a solved `captcha_token` is required.'
    parameters:
        - name: email
          type: string
          required: true
          description: 'Email address of the account to reset.'
        - name: admin_base_url
          type: string
          required: false
          description: 'Origin + base path of the calling Admin2 client (e.g. `https://my-site.example/admin`). Used to construct the reset link in the email. Must be an `http`/`https` URL whose origin is the site''s own or is listed in the API''s `cors.origins`; otherwise it is ignored. Falls back to the `Referer` / `Origin` headers (same origin check), then Grav''s own root URL.'
        - name: captcha_token
          type: string
          required: false
          description: 'A solved captcha. Required only when the site''s login captcha covers this flow (see `GET /auth/captcha`).'
    request_example: '{"email": "admin@my-site.example", "admin_base_url": "https://my-site.example/admin"}'
    response_example: '{"data": {"message": "If an account exists for that email, a reset link has been sent."}}'
    response_codes:
        - code: '200'
          description: 'Request accepted (neutral response regardless of match).'
        - code: '422'
          description: 'Missing email field, or the captcha was missing or could not be verified.'
        - code: '429'
          description: 'Rate limit exceeded for this user.'
---
