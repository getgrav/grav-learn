---
title: Reset User Preferences
api:
    method: DELETE
    path: '/admin-next/preferences/user'
    description: 'Remove every preference override the caller has saved (the whole `admin_next.preferences` block in their account file), so the site defaults apply again. This backs the "Reset to site defaults" action in Admin2. The dashboard layout (`admin_next.dashboard`) is not touched. Returns the full resolved payload, the same as `GET /admin-next/preferences`. Demo accounts are refused.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"branding": {"mode": "default", "text": "Grav"}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271}, "site_settings": {"autoSaveEnabled": false}, "media_upload": {"resizeWidth": 0}, "user": [], "effective": {"colorMode": "", "accentHue": 271}, "can_edit_site": false}}'
    response_codes:
        - code: '200'
          description: 'Overrides cleared; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission, or a demo account.'
---
