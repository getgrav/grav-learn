---
title: List Site Media
template: api-endpoint
api:
    method: GET
    path: /media
    description: 'List site-level media files and folders with pagination, subfolder browsing, search, and type filtering.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
        - name: path
          type: string
          required: false
          description: 'Subfolder path relative to the media root directory'
        - name: search
          type: string
          required: false
          description: 'Recursive filename search across all subfolders'
        - name: type
          type: string
          required: false
          description: 'Filter by media type: image, video, audio, or document'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns media files and folders from the `user/media` directory. Supports browsing subfolders via the `path` parameter, recursive search via `search`, and filtering by file type via `type`. The response includes a `folders` array in the `meta` object listing immediate subdirectories at the current path.
