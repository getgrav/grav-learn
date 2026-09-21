---
title: Update Branding
api:
    method: PATCH
    path: '/admin-next/branding'
    description: 'Update the Admin2 branding stored under `ui.branding` in `user/config/admin-next.yaml`. The body is merged over the current branding, so send only the fields you want to change. Fields: `mode` (`default` shows the Grav logo, `text` shows `text`, `custom` shows the uploaded logos; unknown values fall back to `default`), `text` (up to 64 characters), `logoHeight` (height of a custom logo in the sidebar in CSS pixels, clamped to 16 to 44; `0` uses the built-in 28px), `title` (sign-in screen and browser tab title, up to 64 characters), `subtitle` (sign-in subtitle, up to 128 characters), `showPoweredBy` (show the "Powered by Grav CMS" line on the login and setup screens), and `logoLight`, `logoDark` and `favicon`, which accept only a basename inside `user/media/admin-next/`. Upload and remove those files with `POST` and `DELETE /admin-next/branding/logo`. Requires a super user (subject to the API key scope cap). Demo accounts are refused. Returns the full resolved payload, the same as `GET /admin-next/preferences`.'
    parameters: []
    request_example: '{"mode": "text", "text": "Acme CMS", "title": "Acme Content Admin", "logoHeight": 32, "showPoweredBy": false}'
    response_example: '{"data": {"branding": {"mode": "text", "text": "Acme CMS", "logoLight": "", "logoDark": "", "logoHeight": 32, "title": "Acme Content Admin", "subtitle": "", "showPoweredBy": false, "favicon": ""}, "branding_urls": {"light": "", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271}, "site_settings": {"autoSaveEnabled": false}, "media_upload": {"resizeWidth": 0}, "user": [], "effective": {"colorMode": "", "accentHue": 271}, "can_edit_site": true}}'
    response_codes:
        - code: '200'
          description: 'Branding saved; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super user, or a demo account.'
---
