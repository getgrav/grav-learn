---
title: Allow a Blocked Twig Token
api:
    method: POST
    path: /reports/twig-content/allowlist
    description: 'Add one token that the page-content Twig sandbox blocked to the matching `security.twig_sandbox.allowed_*` list, saved in `user/config/security.yaml`. Recent block events for that token are removed from the Twig in Content report. Requires a super admin (an API key needs `admin.super` in its scopes).'
    parameters:
        - name: rule
          type: string
          required: true
          description: 'The sandbox rule that blocked the token: `tag`, `filter`, `function`, `method` or `property`.'
        - name: token
          type: string
          required: true
          description: 'The tag, filter, function, method or property name to allow.'
        - name: class
          type: string
          required: false
          description: 'Owning class. Required for `method` and `property`, ignored otherwise.'
    request_example: '{"rule": "filter", "token": "markdown"}'
    response_example: '{"data": {"rule": "filter", "key": "allowed_filters", "value": ["markdown"], "resolved": 2}}'
    response_codes:
        - code: '200'
          description: 'Token added (or already present) and saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super admin'
        - code: '422'
          description: 'Unknown rule, empty token, or a missing class for `method`/`property`'
---

`key` is the `security.twig_sandbox` key that was written and `value` its full new value: a list of names for `tag`, `filter` and `function`, or a list of `{class, methods}` rows for `method` and `property`. `resolved` is the number of recorded block events this removed. The shipped defaults live in code, so the file only holds the site's own additions. Fires `onApiConfigUpdated` with scope `security`.
