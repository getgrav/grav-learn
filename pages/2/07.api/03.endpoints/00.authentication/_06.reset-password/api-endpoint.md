---
title: Reset Password
api:
    method: POST
    path: '/auth/reset-password'
    description: 'Complete a password reset using the token from the reset email. All link failures return the same vague error message to prevent token probing from distinguishing bad user / wrong token / expired token. Once the link checks out, the new password must meet the site''s password policy (`system.pwd_regex`, or at least 8 characters when none is set; see `GET /auth/password-policy`); a policy failure names the `password` field and leaves the link usable for another try. On success, every access and refresh token issued to the account before the reset stops working. Rate-limited per-username. Fires `onApiPasswordReset` on success.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'Username of the account being reset.'
        - name: token
          type: string
          required: true
          description: 'The reset token from the email link.'
        - name: password
          type: string
          required: true
          description: 'The new password. Must meet the site''s password policy.'
    request_example: '{"username": "admin", "token": "abc123...", "password": "N3w-Pa$$w0rd"}'
    response_example: '{"data": {"message": "Password reset successfully."}}'
    response_codes:
        - code: '200'
          description: 'Password updated.'
        - code: '422'
          description: 'Missing required fields, invalid/expired reset link, or the new password does not meet the password policy.'
        - code: '429'
          description: 'Too many attempts; rate limited.'
---
