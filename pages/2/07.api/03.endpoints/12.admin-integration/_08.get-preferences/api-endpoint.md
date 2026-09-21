---
title: Get Admin2 Preferences
api:
    method: GET
    path: '/admin-next/preferences'
    description: 'Return the full preferences payload Admin2 reads once on boot: site branding and ready-to-use logo URLs (`branding_urls`), site defaults (`site`), site-only settings (`site_settings`), media upload limits (`media_upload`), the caller''s own saved overrides (`user`), the merged `effective` values, and `can_edit_site` (whether the caller is a super user who may write site preferences and branding). The response carries an `ETag` header.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"branding": {"mode": "default", "text": "Grav", "logoLight": "", "logoDark": "", "logoHeight": 0, "title": "", "subtitle": "", "showPoweredBy": true, "favicon": ""}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271, "accentSaturation": 91, "fontFamily": "google-sans", "fontSize": "normal", "editorMode": "normal", "editorKeymap": "default", "editorStickyToolbar": true, "editorFixedHeight": 0, "adminLanguage": "en", "pagesPerPage": 20, "pagesViewMode": "miller", "usersViewMode": "cards", "groupsViewMode": "cards", "pluginsViewMode": "cards", "themesViewMode": "cards", "flexAfterSave": ""}, "site_settings": {"autoSaveEnabled": false, "autoSaveToolbarUndo": true, "autoSaveBatchWindowMs": 0, "collabEnabled": true, "menubarLinks": []}, "media_upload": {"resizeWidth": 0, "resizeHeight": 0, "resizeQuality": 0.8, "minWidth": 0, "minHeight": 0, "maxWidth": 0, "maxHeight": 0}, "user": {"colorMode": "dark"}, "effective": {"colorMode": "dark", "accentHue": 271, "accentSaturation": 91, "fontFamily": "google-sans", "fontSize": "normal", "editorMode": "normal", "editorKeymap": "default", "editorStickyToolbar": true, "editorFixedHeight": 0, "adminLanguage": "en", "pagesPerPage": 20, "pagesViewMode": "miller", "usersViewMode": "cards", "groupsViewMode": "cards", "pluginsViewMode": "cards", "themesViewMode": "cards", "flexAfterSave": "", "autoSaveEnabled": false, "autoSaveToolbarUndo": true, "autoSaveBatchWindowMs": 0, "collabEnabled": true, "menubarLinks": []}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

Values that a user can override resolve in this order: built-in defaults, then the site defaults (`ui.defaults` in `user/config/admin-next.yaml`), then the user's own overrides (`admin_next.preferences` in their account file). If the user has never picked an admin language in Admin2, a classic admin `language:` value on the account is used instead. Site-only settings (`ui.settings`: auto-save, collaboration and menubar links) are applied last and can't be overridden per user.
