---
title: Upload Branding Logo
api:
    method: POST
    path: '/admin-next/branding/logo'
    description: 'Upload a light logo, dark logo or favicon (multipart, field `file` or `logo`) to `user/media/admin-next/` and record it in the site branding. The file type is read from the file contents, never the client-declared MIME type: PNG, JPEG, WebP and ICO are accepted as images, and anything else must parse as an SVG document, which is sanitized (script and foreignObject elements, `on*` attributes, and `javascript:`/`data:` URLs are removed). Maximum size is 4 MB. The file is stored as `logo-{variant}-{hash}.{ext}` (or `favicon-favicon-{hash}.{ext}`) and the previous file for that variant is deleted. Uploading a light or dark logo switches the branding `mode` to `custom` unless it is `text`. Requires a super user (subject to the API key scope cap). Demo accounts are refused. Returns the full resolved payload; `branding_urls` holds the new file''s URL.'
    parameters:
        - name: variant
          type: string
          required: true
          description: 'Query parameter (or multipart field): `light`, `dark` or `favicon`. The query parameter wins when both are sent.'
        - name: file
          type: file
          required: true
          description: 'The image file (multipart field `file`, or `logo`).'
    request_example: ''
    response_example: '{"data": {"branding": {"mode": "custom", "text": "Grav", "logoLight": "logo-light-3f9c2a7e5b.svg", "logoDark": "", "logoHeight": 0, "title": "", "subtitle": "", "showPoweredBy": true, "favicon": ""}, "branding_urls": {"light": "/user/media/admin-next/logo-light-3f9c2a7e5b.svg", "dark": "", "favicon": ""}, "site": {"colorMode": "", "accentHue": 271}, "site_settings": {"autoSaveEnabled": false}, "media_upload": {"resizeWidth": 0}, "user": [], "effective": {"colorMode": "", "accentHue": 271}, "can_edit_site": true}}'
    response_codes:
        - code: '201'
          description: 'Logo stored; resolved preferences returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super user, or a demo account.'
        - code: '422'
          description: 'Missing or invalid `variant`, no file uploaded, a file over 4 MB, or content that is neither a supported image nor a valid SVG.'
---
