---
title: Captcha Config
api:
    method: GET
    path: '/auth/captcha'
    description: 'Report which captcha, if any, guards the public login, forgotten-password and setup endpoints, so a client can render the right challenge before submitting. `flows` says which of those flows are gated, and `token_field` names the body field the solved token goes in (`captcha_token`). For the built-in `cap` provider, `endpoint` is the base URL of the challenge/redeem pair; for `turnstile` and `recaptcha` (provided by the Form plugin), `site_key` is the public widget key, and reCAPTCHA also reports `version`. Never returns a secret. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"data": {"enabled": true, "provider": "cap", "mode": "invisible", "token_field": "captcha_token", "flows": {"login": true, "forgot_password": true, "setup": false}, "endpoint": "https://example.com/api/v1/auth/captcha/"}}'
    response_codes:
        - code: '200'
          description: 'Captcha configuration returned. When captcha is off, `enabled` is false and `provider` is null.'
---
