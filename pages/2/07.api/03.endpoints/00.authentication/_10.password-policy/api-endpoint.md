---
title: Password Policy
api:
    method: GET
    path: '/auth/password-policy'
    description: 'Return the site''s password policy so setup, password reset, invitation and user forms can check a password as it is typed. `regex` is `system.pwd_regex` unchanged. `rules` is the checklist: taken from `system.pwd_rules` when set, otherwise parsed from the regex (length, digit, lowercase, uppercase, symbol). When no `pwd_regex` is set, the API still requires at least 8 characters, so the response reports `min_length: 8` and a single length rule. The same policy is enforced by setup, invitation accept, password reset, and user create/update. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"data": {"regex": "(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,}", "min_length": 8, "rules": [{"id": "length", "label": "At least 8 characters", "pattern": ".{8,}"}, {"id": "digit", "label": "At least one number", "pattern": "\\d"}, {"id": "lowercase", "label": "At least one lowercase letter", "pattern": "[a-z]"}, {"id": "uppercase", "label": "At least one uppercase letter", "pattern": "[A-Z]"}]}}'
    response_codes:
        - code: '200'
          description: 'Policy returned.'
---

With no `system.pwd_regex` set, the response is:

```json
{"data": {"regex": "", "min_length": 8, "rules": [{"id": "length", "label": "At least 8 characters", "pattern": ".{8,}"}]}}
```
