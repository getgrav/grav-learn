---
title: List Blueprints
api:
    method: GET
    path: '/flex-objects/blueprints'
    description: 'List every available Flex directory blueprint, including hidden and currently-disabled ones. Powers the directory picker on the plugin settings page.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"url": "blueprints://flex-objects/contacts.yaml", "legacy_url": null, "type": "contacts", "title": "Contacts", "description": "Address book"}]}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

`legacy_url` carries the pre-existing blueprint alias (when one exists) so saved settings that still reference the old form can be matched.
