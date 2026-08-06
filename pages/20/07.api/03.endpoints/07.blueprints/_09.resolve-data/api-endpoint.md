---
title: Resolve Data Options
api:
    method: GET
    path: '/data/resolve'
    description: 'Resolve `data-options@: \Some\Class::method` directives used in blueprint field definitions (e.g., the list of page templates, the list of themes). Admin2 calls this when rendering a blueprint whose select/checkboxes field references a callable. Only `Class::method` callables on the approved data provider allowlist (`Blueprint::isSafeDynamicCall()`) are accepted — an exact-match allow-list prevents arbitrary code execution. Core''s providers are pre-approved; plugins and themes register their own via `Blueprint::addAllowedDynamicCallable()` at startup. Results are normalized to `[{value, label}]` for select-compatible consumption.'
    parameters:
        - name: callable
          type: string
          required: true
          description: 'Fully-qualified `\Class\Name::method` to invoke. Must be an approved data provider (on the core allowlist, or registered via `Blueprint::addAllowedDynamicCallable()`).'
        - name: type
          type: string
          required: false
          description: 'Extra arg passed when `callable` is `Grav\Common\Page\Pages::pageTypes` (`standard` / `modular`). Defaults to `standard`.'
    request_example: ''
    response_example: '{"data": [{"value": "default", "label": "Default"}, {"value": "blog", "label": "Blog"}]}'
    response_codes:
        - code: '200'
          description: 'Options returned (empty array if the method does not return an array).'
        - code: '400'
          description: 'Missing/invalid `callable`, or callable is not an approved data provider, or not in `Class::method` format.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.pages.read` permission.'
        - code: '404'
          description: 'Class or method does not exist.'
---
