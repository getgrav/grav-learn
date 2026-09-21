---
title: Replace Overrides
api:
    method: PUT
    path: '/i18n/overrides/{lang}'
    description: 'Advanced-mode save. Parses `yaml` (a mapping, nested or with dotted keys) and replaces the language''s overrides with it. Sends `X-Invalidates: i18n:update, translations:update`. Requires `api.translations.write`; demo accounts get 403.'
    parameters:
        - name: lang
          type: string
          required: true
          description: 'Language code (path parameter), e.g. `fr`.'
        - name: yaml
          type: string
          required: true
          description: 'YAML mapping of keys to strings. A YAML list is a 422. An empty string deletes every override in scope.'
        - name: namespace
          type: string
          required: false
          description: 'Dotted key prefix to limit the replacement to. Omit it or send an empty string to replace the whole file.'
    request_example: '{"yaml": "THEME_QUARK:\n  SEARCH: Rechercher\n", "namespace": "THEME_QUARK"}'
    response_example: '{"data": {"count": 1, "dropped": [], "unknown": [], "removed": 0}}'
    response_codes:
        - code: '200'
          description: 'Overrides saved.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.write` permission, or a demo account.'
        - code: '422'
          description: 'Invalid language code, missing `yaml`, YAML that does not parse or is not a mapping, or a scoped save that names keys outside the namespace.'
---

With `namespace`, only the overrides under that prefix are replaced and everything else in the file is kept. That is what makes saving a filtered view safe: an unscoped save of one theme's strings would delete every other override. A key outside the namespace fails the whole save with a 422 that names the out-of-scope keys (up to five), rather than a parse error.

Values equal to the shipped value are not stored and are listed in `dropped`. Keys no source ships are saved and listed in `unknown` rather than rejected, so a typo is reported instead of doing nothing. `count` is the number of overrides stored from this YAML, and `removed` how many fewer in-scope overrides exist than before.
