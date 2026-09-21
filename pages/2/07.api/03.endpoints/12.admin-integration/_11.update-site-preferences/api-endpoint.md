---
title: Update Site Preferences
api:
    method: PATCH
    path: '/admin-next/preferences/site'
    description: 'Save site-wide preferences to `user/config/admin-next.yaml`. The flat body is split in two. User-overridable keys (the same keys `PATCH /admin-next/preferences/user` accepts) are merged into `ui.defaults`: only the keys sent change, a key set to `null` removes the saved default so the built-in value applies, and invalid values are dropped. Site-only keys (`autoSaveEnabled`, `autoSaveToolbarUndo`, `autoSaveBatchWindowMs`, `collabEnabled`, `menubarLinks`) are merged into `ui.settings`, again changing only the keys sent. Any other key is ignored. Requires a super user (subject to the API key scope cap). Demo accounts are refused. Returns the full resolved payload, the same as `GET /admin-next/preferences`.'
    parameters: []
    request_example: '{"accentHue": 271, "fontFamily": "inter", "colorMode": null, "autoSaveEnabled": true, "menubarLinks": [{"label": "Docs", "url": "https://learn.getgrav.org", "icon": "book", "external": true}]}'
    response_example: '{"data": {"branding": {"mode": "default", "text": "Grav"}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271, "fontFamily": "inter"}, "site_settings": {"autoSaveEnabled": true, "autoSaveToolbarUndo": true, "autoSaveBatchWindowMs": 0, "collabEnabled": true, "menubarLinks": [{"label": "Docs", "url": "https://learn.getgrav.org", "icon": "book", "external": true}]}, "media_upload": {"resizeWidth": 0}, "user": [], "effective": {"colorMode": "", "accentHue": 271, "fontFamily": "inter", "autoSaveEnabled": true}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Site preferences saved; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super user, or a demo account.'
---

Each `menubarLinks` entry needs a non-empty `label` and `url`, and may carry `icon` and `external`; entries missing either required field are dropped.
