---
title: List Site Media
api:
    method: GET
    path: /media
    description: 'List site-level media files and folders with pagination, subfolder browsing, search, type filtering, and metadata filtering and sorting.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 1000, both configurable)'
        - name: path
          type: string
          required: false
          description: 'Subfolder path relative to the media root directory'
        - name: search
          type: string
          required: false
          description: 'Case-insensitive recursive filename search across all subfolders. Cannot be combined with `filter` or `sort`.'
        - name: type
          type: string
          required: false
          description: 'Filter by media type: image, video, audio, or document (anything that is not image, video or audio)'
        - name: filter
          type: string
          required: false
          description: 'Metadata filter as `field:operator:value` (or `field:value`). Repeatable via `filter[]=`, up to 10 clauses. Same rules as page media.'
        - name: sort
          type: string
          required: false
          description: 'Metadata (or intrinsic filename/size/modified) field to sort by. Overrides the folder''s manual order.'
        - name: order
          type: string
          required: false
          description: 'Sort direction: asc (default) or desc'
    request_example: ''
    response_example: '{"data": [{"filename": "hero.jpg", "path": "blog", "url": "/user/media/blog/hero.jpg", "type": "image/jpeg", "size": 184320, "dimensions": {"width": 1600, "height": 900}, "thumbnail_url": "/api/v1/thumbnails/3f2a9c1e4b5d6a7f8e9d0c1b2a394857.jpg", "modified": "2026-09-01T10:15:00+00:00"}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 1, "total_pages": 1}, "path": "blog", "folders": [{"name": "2026", "path": "blog/2026", "children_count": 0, "file_count": 4}], "ordered": false}, "links": {"self": "/api/v1/media?page=1&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.read` permission'
        - code: '422'
          description: 'Invalid path, `search` combined with `filter` or `sort`, or an invalid filter/sort parameter'
---

Returns media files and folders from the `user/media` directory. Supports browsing subfolders via the `path` parameter, recursive search via `search`, filtering by file type via `type`, and filtering and sorting by `.meta.yaml` metadata via `filter`, `sort` and `order` (see [List Page Media](/2/api/endpoints/media/list-page-media) for the filter syntax). The response includes a `folders` array in the `meta` object listing immediate subdirectories at the current path, and `meta.ordered` says whether the folder has a saved manual order.

Files follow the folder's saved manual order (see [Set Media Order](/2/api/endpoints/media/set-media-order)) when one exists, otherwise natural filename order. `.meta.yaml` sidecars and the `media_order.yaml` order file are never listed, in a folder listing or in search results.

A folder that does not exist returns an empty list, with `meta.pagination` echoing the requested `page` and `per_page` and no `meta.ordered`. In search mode, `meta.path` is empty, `meta.folders` is empty, `meta.search` holds the search term, and `meta.ordered` is absent.
