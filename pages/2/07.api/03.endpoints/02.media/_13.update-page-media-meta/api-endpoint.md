---
title: Update Page Media Metadata
api:
    method: PATCH
    path: '/pages/{route}/media/{filename}/meta'
    description: 'Save the editable metadata of a page media file.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filename
          type: string
          required: true
          description: 'The media filename'
    request_example: |
        {
          "fields": {
            "alt": "Sunset over the bay",
            "tags": ["beach", "summer"]
          }
        }
    response_example: '{"data": {"filename": "photo.jpg", "has_meta": true, "fields": [{"key": "alt", "label": "Alt Text", "type": "text", "value": "Sunset over the bay"}, {"key": "title", "label": "Title", "type": "text", "value": ""}, {"key": "caption", "label": "Caption", "type": "textarea", "value": ""}, {"key": "description", "label": "Description", "type": "textarea", "value": ""}, {"key": "tags", "label": "Tags", "type": "tags", "value": ["beach", "summer"]}], "extra": {"width": 1920, "height": 1080}}}'
    response_codes:
        - code: '200'
          description: 'Metadata saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, or the page''s own rules deny update access'
        - code: '404'
          description: 'Page or file not found'
        - code: '422'
          description: 'Invalid filename, or a value that is not plain text'
---

Send the values in a `fields` object, or as a bare map of field keys to values. Only configured fields present in the request are changed, and an empty value (an empty string, or an empty list for a `tags` field) removes that field. Keys that aren't configured are ignored, and every other key already in the sidecar is kept. The response is the updated metadata, in the same format as [Get Page Media Metadata](/2/api/endpoints/media/get-page-media-meta).

Values render into `<img>` attributes on the site, so they are cleaned on save: HTML tags and control characters are stripped, single-line fields have their whitespace collapsed, and each value is cut to `plugins.api.media_metadata.max_length` characters (2000 by default). A `tags` value may be a list of strings or one comma-separated string; duplicates and blanks are dropped and at most 50 tags are kept. Reserved keys that Grav manages itself (`width`, `height`, `mime`, `size`, `filesize`, `modified`, `upload`, `type`) can never be written here.

If every key is removed, the sidecar file is deleted.
