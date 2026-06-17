---
title: List Custom Fields
api:
    method: GET
    path: '/custom-fields'
    description: 'Map every custom blueprint field type to the plugin or theme that ships it, by scanning `admin-next/fields/*.js` in every enabled plugin and installed theme. Each value is `{ slug, kind }`, where `kind` is `plugins` or `themes`, so Admin2 fetches each field script from the correct `/gpm/{kind}/{slug}/field/{type}` route. Admin2 calls this once on load to pre-populate its custom-field registry so unknown field types in blueprints render correctly on first sight.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"codeshtheme": {"slug": "codesh", "kind": "plugins"}, "products-status": {"slug": "license-manager", "kind": "plugins"}, "tinymce": {"slug": "mytheme", "kind": "themes"}}}'
    response_codes:
        - code: '200'
          description: 'Registry returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
---
