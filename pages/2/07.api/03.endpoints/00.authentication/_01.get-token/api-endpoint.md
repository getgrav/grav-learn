---
title: Get Token
api:
    method: POST
    path: /auth/token
    description: 'Log in with a username and password and receive a JWT access token and refresh token, plus a `user` object with the account profile, resolved permissions and demo-mode state (the same data `GET /me` returns). When the account has 2FA enabled, the response is a 2FA challenge instead of tokens (see below); finish the login with `POST /auth/2fa/verify`. The account must be a super admin or hold `admin.login` or `api.access`, and must not be disabled. This is a public endpoint that does not require prior authentication. Rate limited per username through the Login plugin.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'User account username'
        - name: password
          type: string
          required: true
          description: 'User account password'
        - name: captcha_token
          type: string
          required: false
          description: 'A solved captcha. Required only when the site''s login captcha covers the login flow (see `GET /auth/captcha`). For the built-in `cap` provider this is the token from `POST /auth/captcha/redeem`; for Turnstile or reCAPTCHA it is the widget''s response token.'
    request_example: '{"username": "admin", "password": "password"}'
    response_example: '{"data": {"access_token": "eyJ...", "refresh_token": "eyJ...", "token_type": "Bearer", "expires_in": 3600, "user": {"username": "admin", "fullname": "Site Admin", "email": "admin@example.com", "avatar_url": null, "super_admin": true, "access": {"api": {"super": true}, "site": {"login": true}}, "content_editor": "", "demo_mode": {"enabled": false, "writable": [], "reset_interval": 30, "seconds_until_reset": null}}}}'
    response_codes:
        - code: '200'
          description: 'Tokens generated, or a 2FA challenge when the account has 2FA enabled.'
        - code: '401'
          description: 'Invalid credentials'
        - code: '403'
          description: 'The account has no API or admin login access, or is disabled.'
        - code: '422'
          description: 'Missing username or password, or the captcha was missing or could not be verified.'
        - code: '429'
          description: 'Too many login attempts for this username.'
---

When the account has 2FA enabled, the password is checked but no tokens are issued. The response is still `200`, with a short-lived challenge token (valid for 5 minutes) to send to `POST /auth/2fa/verify` along with the current code:

```json
{"data": {"requires_2fa": true, "challenge_token": "eyJ...", "expires_in": 300, "token_type": "Challenge"}}
```
