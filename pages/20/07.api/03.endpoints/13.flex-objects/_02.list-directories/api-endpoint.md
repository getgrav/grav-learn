---
title: List Directories
api:
    method: GET
    path: '/flex-objects'
    description: 'List the enabled custom Flex directories the current user is allowed to view, with their admin list/edit config, search settings, and resolved list-column field types. Built-in directories that already have dedicated admin UI (pages, user-accounts, user-groups) are excluded.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"type": "contacts", "title": "Contacts", "icon": "fa-address-book", "list": {"fields": {"name": {}, "email": {}}}, "field_types": {"name": "text", "email": "email"}}]}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

Each entry's `type` is the Flex directory key you pass as `{type}` to the object endpoints below. Directories the user lacks `list` permission on are omitted from the result.
