---
title: Reset Password
api:
    method: POST
    path: '/auth/reset-password'
    description: 'Complete a password reset using the token from the reset email. All failures return the same vague error message to prevent token probing from distinguishing bad user / wrong token / expired token. Rate-limited per-username. Fires `onApiPasswordReset` on success.'
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
          description: 'The new password.'
    request_example: '{"username": "admin", "token": "abc123...", "password": "new-secret"}'
    response_example: '{"data": {"message": "Password reset successfully."}}'
    response_codes:
        - code: '200'
          description: 'Password updated.'
        - code: '400'
          description: 'Missing required fields, or invalid/expired reset link.'
        - code: '429'
          description: 'Too many attempts; rate limited.'
---
