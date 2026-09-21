---
title: Upload Page Media
api:
    method: POST
    path: '/pages/{route}/media'
    description: 'Upload file(s) to a page via multipart form data.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: file
          type: file
          required: true
          description: 'File to upload (multipart/form-data). Any field name works, including nested array names such as `files[]`, and several files may be sent in one request.'
        - name: random_name
          type: boolean
          required: false
          description: 'Replace the file name with a random one, keeping the extension (default: false)'
        - name: avoid_overwriting
          type: boolean
          required: false
          description: 'Add a timestamp prefix instead of replacing an existing file with the same name (default: false)'
        - name: accept
          type: string
          required: false
          description: 'Comma-separated allowlist of extensions (`.pdf`, `*.jpg`) or MIME patterns (`image/*`)'
        - name: filesize
          type: number
          required: false
          description: 'Per-field maximum size in MB. Can only tighten the 64 MB cap.'
    request_example: ''
    response_example: '{"data": [{"filename": "photo.jpg", "url": "/user/pages/01.blog/photo.jpg", "type": "image/jpeg", "size": 245000, "dimensions": {"width": 1920, "height": 1080}, "thumbnail_url": "/api/v1/thumbnails/3f2a9c1e4b5d6a7f8e9d0c1b2a394857.jpg", "modified": "2026-09-01T10:15:00+00:00"}]}'
    response_codes:
        - code: '201'
          description: 'File uploaded'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, or the page''s own rules deny update access'
        - code: '404'
          description: 'Page not found'
        - code: '422'
          description: 'Validation error (no file, invalid file name or type, or file too large)'
---

Send the file as a `multipart/form-data` request rather than JSON. The `Content-Type` header should be set to `multipart/form-data`.

The response lists all of the page's media after the upload, not only the new files, and the `Location` header points at the page's media collection. Each file is capped at 64 MB. A file must have an extension, and no dot-separated part of its name may be on `security.uploads_dangerous_extensions` (so `shell.php.jpg` is refused). SVG content is sanitized when it arrives.

The optional `random_name`, `avoid_overwriting`, `accept` and `filesize` form fields apply a blueprint file field's upload settings on top of those checks.
