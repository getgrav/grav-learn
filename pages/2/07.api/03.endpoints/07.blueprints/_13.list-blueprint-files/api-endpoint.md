---
title: List Blueprint Folder Files
api:
    method: GET
    path: /blueprint-files
    description: 'List the files in the folder a blueprint field points at with its `folder:` option (filepicker, mediapicker), like classic admin''s `taskGetFilesInFolder`. Requires `api.media.read`.'
    parameters:
        - name: folder
          type: string
          required: true
          description: 'Query parameter: folder to list. A Grav stream (`user://media`, `theme://images`, `account://`), a `self@:subpath` token resolved against `scope`, or a path relative to `user/`'
        - name: scope
          type: string
          required: false
          description: 'Query parameter: blueprint owner used to resolve `self@:`. One of `plugins/<slug>`, `themes/<slug>`, `pages/<route>`, `users/<username>`'
        - name: accept
          type: string
          required: false
          description: 'Query parameter: comma-separated filter of extensions (`.pdf`, `*.jpg`) or MIME patterns (`image/*`). `*` matches everything'
    request_example: ''
    response_example: '{"data": [{"filename": "logo.png", "url": "/user/themes/quark/images/logo.png", "type": "image/png", "size": 18432, "dimensions": {"width": 400, "height": 120}, "thumbnail_url": "/api/v1/thumbnails/3f2a9c1e4b5d6a7f8e9d0c1b2a394857.png", "modified": "2026-09-01T10:15:00+00:00"}], "meta": {"pagination": {"page": 1, "per_page": 1, "total": 1, "total_pages": 1}, "folder": "themes/quark/images", "scope": null, "exists": true}, "links": {"self": "/api/v1/blueprint-files?page=1&per_page=1"}}'
    response_codes:
        - code: '200'
          description: 'Success. A folder that does not exist yet returns an empty list with `meta.exists: false`'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.read` permission, or a `users/<username>` scope for another account without `api.users.write`'
        - code: '422'
          description: 'Missing `folder`, traversal or an unresolvable stream or scope, or a `@self` / `self@` page-media folder'
---

The result uses the paginated envelope but is never actually paginated: every matching file comes back on page 1.

The page-media literals `@self` and `self@` (with no subpath) are not handled here, since the client already has a page's media from `GET /pages/{route}/media`. They return a standard 422 validation error whose `errors` entry for `folder` carries the message `PAGE_MEDIA_ONLY`:

```json
{"status": 422, "title": "Unprocessable Entity", "detail": "Use /pages/{route}/media for @self / self@ folders.", "errors": [{"field": "folder", "message": "PAGE_MEDIA_ONLY"}]}
```
