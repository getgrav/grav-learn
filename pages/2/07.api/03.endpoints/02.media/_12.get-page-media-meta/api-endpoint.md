---
title: Get Page Media Metadata
api:
    method: GET
    path: '/pages/{route}/media/{filename}/meta'
    description: 'Read the editable metadata of a page media file, stored in its `.meta.yaml` sidecar.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filename
          type: string
          required: true
          description: 'The media filename'
    request_example: ''
    response_example: '{"data": {"filename": "photo.jpg", "has_meta": true, "fields": [{"key": "alt", "label": "Alt Text", "type": "text", "value": "Sunset over the bay"}, {"key": "title", "label": "Title", "type": "text", "value": ""}, {"key": "caption", "label": "Caption", "type": "textarea", "value": ""}, {"key": "description", "label": "Description", "type": "textarea", "value": ""}, {"key": "tags", "label": "Tags", "type": "tags", "value": ["beach", "summer"]}], "extra": {"width": 1920, "height": 1080}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.read` permission, or the page''s own rules deny read access'
        - code: '404'
          description: 'Page or file not found'
        - code: '422'
          description: 'Invalid filename (leading period or `..`)'
---

Returns one entry in `fields` for each editable field configured under **Plugins → API → Media Metadata** (`plugins.api.media_metadata.fields`), with its current value. When nothing is configured, the defaults are `alt`, `title`, `caption`, `description` and `tags`. A `text` or `textarea` field's value is a string (empty when unset), and a `tags` field's value is a list of strings.

Any other keys stored in the sidecar (EXIF data, dimensions, upload info) are returned as read-only data in `extra`. `has_meta` says whether a sidecar file exists at all.
