---
title: Captcha Redeem
api:
    method: POST
    path: '/auth/captcha/redeem'
    description: 'Trade the solved sub-challenges for a single-use token to send as `captcha_token` with the login, forgotten-password or setup request. Only available while captcha is enabled and `cap` is the active provider; 404 otherwise. The response is the cap.js wire format at the top level, not this API''s `data` envelope; `success` is false when the solutions do not verify. Public (no auth required).'
    parameters:
        - name: token
          type: string
          required: true
          description: 'The challenge token from `POST /auth/captcha/challenge`.'
        - name: solutions
          type: array
          required: true
          description: 'One integer nonce per sub-challenge, in order.'
    request_example: '{"token": "72d323130ee3541275ca2dc1aa9607b4ca61095a08", "solutions": [1043, 88, 5121]}'
    response_example: '{"success": true, "token": "e734e7c49c34bb0d:d43a6be90ca08cf9f91171a5320e0a", "expires": 1787333298530}'
    response_codes:
        - code: '200'
          description: 'Redemption result (check `success`).'
        - code: '404'
          description: 'Captcha challenges are not available (captcha off, or a provider other than cap).'
        - code: '422'
          description: 'Missing token, or solutions is not an array.'
---
