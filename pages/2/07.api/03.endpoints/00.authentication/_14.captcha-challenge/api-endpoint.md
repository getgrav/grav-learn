---
title: Captcha Challenge
api:
    method: POST
    path: '/auth/captcha/challenge'
    description: 'Issue a cap.js proof-of-work challenge for the client to solve. Only available while captcha is enabled and `cap` is the active provider; 404 otherwise. The response is the cap.js wire format at the top level, not this API''s `data` envelope, and is sent with `Cache-Control: no-store`. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"challenge": {"c": 30, "s": 32, "d": 4}, "token": "72d323130ee3541275ca2dc1aa9607b4ca61095a08", "expires": 1787332679923}'
    response_codes:
        - code: '200'
          description: 'Challenge issued.'
        - code: '404'
          description: 'Captcha challenges are not available (captcha off, or a provider other than cap).'
---
