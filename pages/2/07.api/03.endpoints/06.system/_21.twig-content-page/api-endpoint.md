---
title: Twig Content Page Status
api:
    method: GET
    path: /reports/twig-content/page
    description: 'Twig in Content status for a single page, used by the page editor banner: whether the page would show raw `{{ }}` / `{% %}` markers to visitors, and the recent block events recorded for its route. Requires `api.reports.read`.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'Page route, with leading slash.'
    request_example: ''
    response_example: '{"data": {"route": "/blog/my-first-post", "gate": false, "sandbox": true, "leak": {"route": "/blog/my-first-post", "requested": true, "gate": false, "reason": "gate_off"}, "events": []}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.reports.read` permission'
        - code: '422'
          description: 'Missing `route` parameter'
---

`gate` is `security.twig_content.process_enabled` and `sandbox` is `security.twig_sandbox.enabled`. `leak` is `null` when the page has no Twig markers, uses modular or theme Twig, will render its Twig normally, or cannot be found (a missing page is not an error). Its `reason` is `gate_off` when the site-wide gate is off, or `page_off` when the gate is on but the page does not ask for Twig processing. `events` lists recent blocks for exactly this route, newest first.
