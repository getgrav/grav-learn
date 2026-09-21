---
title: Rename Site Media
api:
    method: POST
    path: /media/rename
    description: 'Rename or move a media file within the site-level media directory.'
    parameters: []
    request_example: |
        {
          "from": "blog/hero.jpg",
          "to": "blog/banner.jpg"
        }
    response_example: '{"data": {"filename": "banner.jpg", "path": "blog", "url": "/user/media/blog/banner.jpg", "type": "image/jpeg", "size": 184320, "dimensions": {"width": 1600, "height": 900}, "thumbnail_url": "/api/v1/thumbnails/3f2a9c1e4b5d6a7f8e9d0c1b2a394857.jpg", "modified": "2026-09-01T10:15:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'File renamed'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'Source file not found'
        - code: '422'
          description: 'Validation error or destination already exists'
---

Rename a file or move it to a different folder within `user/media`. Both `from` and `to` are relative paths. The destination directory is created automatically if needed. Any `.meta.yaml` sidecar file is also moved, and the folders' manual orders are kept in step. The response is the file at its new location.

The new name is cleaned before it is used: whitespace becomes a dash, characters other than letters, digits, `.`, `_` and `-` are dropped, and the source file's extension is always kept (any extension given in `to` is replaced). So `{"from": "hero.jpg", "to": "My Banner.png"}` produces `My-Banner.jpg`. If the cleaned name is the same as the source, nothing changes and the file is returned as it is. A cleaned name with no letters or digits left returns 422.
