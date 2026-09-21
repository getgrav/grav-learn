---
title: Blueprint File Upload
api:
    method: POST
    path: /blueprint-upload
    description: 'Upload a file for a blueprint `type: file` field (a theme logo, a plugin asset, an avatar), saved to the folder the field''s `destination` names.'
    parameters:
        - name: file
          type: file
          required: true
          description: 'File to upload (multipart/form-data). Any field name works, and several files may be sent in one request.'
        - name: destination
          type: string
          required: true
          description: 'The blueprint field''s `destination`: a Grav stream (`theme://images/logo`, `user://media`), a `self@:subpath` token resolved against `scope`, or a plain path relative to `user/`'
        - name: scope
          type: string
          required: false
          description: 'Owner of the blueprint, used to resolve `self@:` destinations: `plugins/<slug>`, `themes/<slug>`, `pages/<route>` or `users/<username>`'
        - name: field
          type: string
          required: false
          description: 'Full name of the blueprint field the upload belongs to (`custom_css`, `header.stylesheet`). With `scope`, the server looks up the field''s `allow_extensions` in the blueprint itself.'
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
    response_example: '{"data": [{"name": "logo.png", "path": "user/themes/quark/images/logo/logo.png", "size": 20480, "type": "image/png", "url": "https://example.com/user/themes/quark/images/logo/logo.png"}]}'
    response_codes:
        - code: '201'
          description: 'Files saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, a target in `user/config/` or `user/env/*/config/`, or a `users/<username>` scope for another account without `api.users.write`'
        - code: '422'
          description: 'Missing `destination`, no file, an unsafe path, or a refused file name, type or size'
---

This mirrors classic admin's `taskFilesUpload` and is what Admin2 uses for blueprint file fields that set a `destination`. Send it as `multipart/form-data`. Absolute paths and `..` segments in `destination` are rejected.

The response lists each saved file. `path` is the logical path under `user/`, built from `destination` and `scope` rather than the resolved disk path, so it still works through symlinked theme or plugin folders. Pass it to [Delete Blueprint File](/2/api/endpoints/media/delete-blueprint-upload) to remove the file.

File rules:

- Each file is capped at 64 MB, and the field's own `filesize` can only lower that.
- No dot-separated part of the name may be on `security.uploads_dangerous_extensions`, so `shell.php.jpg` is refused.
- Config and data files (`yaml`, `yml`, `json`, `twig`, `env`, `neon`, `lock`) are refused wherever they would land. Page content (`md`, `markdown`) and stylesheets (`css`, `scss`, `sass`, `less`) are refused too, unless the field named in `field` allows them with `allow_extensions` in the blueprint that owns `scope` and the upload goes to that field's own `destination`.
- Uploads into `user/accounts/` may only be images (`jpg`, `jpeg`, `png`, `gif`, `webp`, `svg`, `avif`, `bmp`, `ico`), since Grav reads that folder as its account store.
- Uploads that resolve into `user/config/` or `user/env/*/config/` are refused with 403.
- SVG files are sanitized after saving.

A `self@:` destination with a `users/<username>` scope for your own account needs only `api.media.write`. For another account it also needs `api.users.write` (or super user).
