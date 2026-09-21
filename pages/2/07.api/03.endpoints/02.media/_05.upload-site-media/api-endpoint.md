---
title: Upload Site Media
api:
    method: POST
    path: /media
    description: 'Upload files to the site-level media directory.'
    parameters:
        - name: path
          type: string
          required: false
          description: 'Query parameter: subfolder path to upload into (created automatically if it does not exist)'
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
    response_example: '{"data": [{"filename": "hero.jpg", "path": "blog", "url": "/user/media/blog/hero.jpg", "type": "image/jpeg", "size": 184320, "dimensions": {"width": 1600, "height": 900}, "thumbnail_url": "/api/v1/thumbnails/3f2a9c1e4b5d6a7f8e9d0c1b2a394857.jpg", "modified": "2026-09-01T10:15:00+00:00"}]}'
    response_codes:
        - code: '201'
          description: 'Files uploaded successfully'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '422'
          description: 'Validation error (no file, invalid path, file name or type, or file too large)'
---

Upload one or more files to the `user/media` directory. Use the `path` query parameter to upload into a subfolder. The request body should use `multipart/form-data` with a `file` field. Maximum upload size per file is 64 MB.

The response lists only the files saved by this request. A file must have an extension, and no dot-separated part of its name may be on `security.uploads_dangerous_extensions`. SVG content is sanitized when it arrives. Without `avoid_overwriting`, a file with the same name is replaced. A 422 stops the request at that file, and files saved before it are kept.
