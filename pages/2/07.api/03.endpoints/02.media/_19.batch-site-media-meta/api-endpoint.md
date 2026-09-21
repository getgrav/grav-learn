---
title: Batch Update Site Media Metadata
api:
    method: POST
    path: /media/batch/meta
    description: 'Apply the same metadata fields to several site-level media files at once.'
    parameters: []
    request_example: |
        {
          "files": ["photos/beach.jpg", "photos/dunes.jpg"],
          "fields": {
            "tags": ["beach", "summer"]
          }
        }
    response_example: '{"data": {"results": [{"path": "photos/beach.jpg", "status": "success"}, {"path": "photos/missing.jpg", "status": "error", "message": "Media file not found."}], "total": 2, "successful": 1, "failed": 1}}'
    response_codes:
        - code: '200'
          description: 'Per-file results (check each `status`)'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '422'
          description: 'Missing `files` or `fields`, `files` empty or not a list, `fields` not an object, or too many files'
---

`files` lists paths relative to the media root, and `fields` maps metadata field keys to values. Only the configured fields present in `fields` are written to each file, so a batch that sets just `tags` leaves each file's own `alt` and `title` alone. An empty value (an empty string, or an empty list for a `tags` field) removes that field. Values are cleaned the same way as in [Update Site Media Metadata](/2/api/endpoints/media/update-site-media-meta).

Each file is handled on its own: a bad path or a missing file is reported in `results` with `status: error` and a `message`, and the rest of the batch still runs. The number of files is capped by `plugins.api.batch.max_items` (50 by default).
