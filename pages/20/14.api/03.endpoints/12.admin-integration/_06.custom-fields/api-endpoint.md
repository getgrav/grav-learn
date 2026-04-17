---
title: List Custom Fields
api:
    method: GET
    path: '/custom-fields'
    description: 'Map every custom blueprint field type to the plugin or theme that ships it, by scanning `admin-next/fields/*.js` in every enabled plugin and installed theme. Admin2 calls this once on load to pre-populate its custom-field registry so unknown field types in blueprints render correctly on first sight.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"codeshtheme": "codesh", "codeshgrammarlist": "codesh", "products-status": "license-manager"}}'
    response_codes:
        - code: '200'
          description: 'Registry returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---
