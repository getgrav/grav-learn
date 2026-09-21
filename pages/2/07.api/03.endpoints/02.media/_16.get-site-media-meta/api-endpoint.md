---
title: Get Site Media Metadata
api:
    method: GET
    path: /media/meta
    description: 'Read the editable metadata of a site-level media file, stored in its `.meta.yaml` sidecar.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'Query parameter: file path relative to the media root (e.g. blog/hero.jpg)'
    request_example: ''
    response_example: '{"data": {"filename": "hero.jpg", "has_meta": true, "fields": [{"key": "alt", "label": "Alt Text", "type": "text", "value": "Sunset over the bay"}, {"key": "title", "label": "Title", "type": "text", "value": ""}, {"key": "caption", "label": "Caption", "type": "textarea", "value": ""}, {"key": "description", "label": "Description", "type": "textarea", "value": ""}, {"key": "tags", "label": "Tags", "type": "tags", "value": ["beach", "summer"]}], "extra": {"width": 1920, "height": 1080}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.read` permission'
        - code: '404'
          description: 'File not found'
        - code: '422'
          description: 'Missing or invalid `path`'
---

The file is addressed by the `path` query parameter rather than in the URL, because site media paths contain slashes. The response is the same as for [Get Page Media Metadata](/2/api/endpoints/media/get-page-media-meta): one entry per configured field in `fields`, other sidecar keys in `extra`, and `has_meta` saying whether a sidecar exists. `filename` is the file's base name.
