---
title: Scan Twig Content
api:
    method: GET
    path: /reports/twig-content/scan
    description: 'Scan every page (skipping modular and theme Twig) for Twig tags, filters and functions in content that the current sandbox allowlists do not permit, that is, what content would need before the gate is switched on. Requires `api.reports.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"tags": {"include": ["/blog/my-first-post"]}, "filters": {"raw": ["/about"]}, "functions": {"source": ["/about", "/contact"]}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.reports.read` permission'
---

Each list maps a token to the routes that use it. A list with no findings arrives as an empty array (`[]`) rather than `{}`. This is a text scan and an approximation; the block events in the report, recorded at render time, are the reliable signal. The cost grows with the number of pages.
