---
title: Serve Raw Site Media
api:
    method: GET
    path: '/media/raw/{path}'
    description: 'Stream the bytes of a site-level media file that the web server will not serve directly.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'File path relative to the media root. May contain `/` (e.g. photos/beach.jpg).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'The file bytes, with the detected MIME type as `Content-Type`'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.read` permission'
        - code: '404'
          description: 'File not found, or not a servable media type'
        - code: '422'
          description: 'Invalid path (a segment starts with a period or is `..`)'
---

Media listings normally give each file a direct static URL. When the site media folder sits somewhere the web server refuses to serve, such as a multi-site `user/env/<host>/media` folder (Grav's shipped `.htaccess` and nginx configs deny `user/env`, `user/config` and `user/accounts`), the listing's `url` points here instead.

Only images, video, audio, fonts and PDFs are served. Any other file type returns 404, so this route can't be used to read source or configuration files. The response is sent `inline` with `Content-Security-Policy: default-src 'none'; style-src 'unsafe-inline'; sandbox` and `X-Content-Type-Options: nosniff`, so an uploaded SVG can't run script when it is opened directly, and with `Cache-Control: private, max-age=600`.

Because a browser `<img>` element can't send an auth header, this route accepts the site's own session cookie, and also a JWT passed as a `?token=` query parameter.
