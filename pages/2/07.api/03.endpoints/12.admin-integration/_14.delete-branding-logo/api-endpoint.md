---
title: Delete Branding Logo
api:
    method: DELETE
    path: '/admin-next/branding/logo'
    description: 'Delete the stored file for one branding variant and clear its path in the site branding. If both logo variants end up empty while the mode is `custom`, the mode reverts to `default` so Admin2 shows the built-in Grav logo. Succeeds even when no file was set for the variant. Requires a super user (subject to the API key scope cap). Demo accounts are refused. Returns the full resolved payload, the same as `GET /admin-next/preferences`.'
    parameters:
        - name: variant
          type: string
          required: true
          description: 'Query parameter: `light`, `dark` or `favicon`.'
    request_example: ''
    response_example: '{"data": {"branding": {"mode": "default", "text": "Grav", "logoLight": "", "logoDark": "", "logoHeight": 0, "title": "", "subtitle": "", "showPoweredBy": true, "favicon": ""}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271}, "site_settings": {"autoSaveEnabled": false}, "media_upload": {"resizeWidth": 0}, "user": [], "effective": {"colorMode": "", "accentHue": 271}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Variant cleared; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super user, or a demo account.'
        - code: '422'
          description: 'Missing or invalid `variant`.'
---
