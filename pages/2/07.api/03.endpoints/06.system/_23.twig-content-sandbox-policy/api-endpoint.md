---
title: Twig Sandbox Policy
api:
    method: GET
    path: /reports/twig-content/sandbox-policy
    description: 'Read-only breakdown of the page-content Twig sandbox: for each list, the built-in defaults, the site''s own `allowed_*` additions, its `denied_*` removals, and the effective result. Requires `api.reports.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"enabled": true, "config_access": false, "lists": {"tags": {"defaults": ["if", "for", "set"], "added": [], "denied": [], "effective": ["if", "for", "set"]}, "filters": {"defaults": ["escape", "upper"], "added": ["markdown"], "denied": [], "effective": ["escape", "upper", "markdown"]}, "functions": {"defaults": ["range"], "added": [], "denied": [], "effective": ["range"]}, "methods": {"defaults": {"Grav\\Common\\Page\\Page": ["title", "url"]}, "added": [], "denied": [], "effective": {"Grav\\Common\\Page\\Page": ["title", "url"]}}, "properties": {"defaults": [], "added": [], "denied": [], "effective": []}}, "config_denied_paths": {"defaults": ["plugins", "streams", "security", "backups", "scheduler", "system.cache.redis.password", "system.debugger.token"], "added": [], "effective": ["plugins", "streams", "security", "backups", "scheduler", "system.cache.redis.password", "system.debugger.token"]}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.reports.read` permission'
---

The lists in the example are shortened. `enabled` is `security.twig_sandbox.enabled` and `config_access` is `security.twig_content.config_access`. In `methods` and `properties` each entry maps a class to its allowed member names, and an empty map arrives as `[]`. `config_denied_paths` lists the configuration paths hidden from content Twig. The policy is built from configuration only; additions plugins make through `onBuildTwigSandboxPolicy` are not included.
