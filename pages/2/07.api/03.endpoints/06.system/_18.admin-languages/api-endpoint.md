---
title: List Admin Languages
api:
    method: GET
    path: /admin/languages
    description: 'List the languages the admin interface itself can be shown in, one per `languages/*.yaml` file shipped by the Admin2 plugin. This is different from `GET /languages`, which lists the site''s content languages. Sorted by native name; empty when Admin2 is not installed. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"languages": [{"code": "en-US", "name": "English", "native_name": "English", "rtl": false}, {"code": "fr-FR", "name": "French", "native_name": "Français", "rtl": false}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---
