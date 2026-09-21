---
title: Update User Preferences
api:
    method: PATCH
    path: '/admin-next/preferences/user'
    description: 'Save the caller''s own preference overrides, stored under `admin_next.preferences` in their account file. Keys left out of the body keep their saved value, and a key set to `null` removes that override so the site default applies again. Only user-overridable keys are accepted (`colorMode`, `accentHue`, `accentSaturation`, `fontFamily`, `fontSize`, `editorMode`, `editorKeymap`, `editorStickyToolbar`, `editorFixedHeight`, `adminLanguage`, `pagesPerPage`, `pagesViewMode`, `usersViewMode`, `groupsViewMode`, `pluginsViewMode`, `themesViewMode`, `flexAfterSave`); site-only keys such as `autoSaveEnabled` or `menubarLinks` are ignored. Invalid values (an unknown option, a wrong type) are dropped rather than rejected, and numbers are clamped to their allowed range. Returns the full resolved payload, the same as `GET /admin-next/preferences`. Demo accounts are refused.'
    parameters: []
    request_example: '{"colorMode": "dark", "accentHue": 200, "fontSize": null}'
    response_example: '{"data": {"branding": {"mode": "default", "text": "Grav"}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271}, "site_settings": {"autoSaveEnabled": false}, "media_upload": {"resizeWidth": 0}, "user": {"colorMode": "dark", "accentHue": 200}, "effective": {"colorMode": "dark", "accentHue": 200, "fontSize": "normal"}, "can_edit_site": false}}'
    response_codes:
        - code: '200'
          description: 'Overrides saved; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission, or a demo account.'
---
