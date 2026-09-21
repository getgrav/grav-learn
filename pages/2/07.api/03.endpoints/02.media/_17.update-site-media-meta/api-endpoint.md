---
title: Update Site Media Metadata
api:
    method: PATCH
    path: /media/meta
    description: 'Save the editable metadata of a site-level media file.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'Query parameter: file path relative to the media root (e.g. blog/hero.jpg)'
    request_example: |
        {
          "fields": {
            "alt": "Sunset over the bay",
            "tags": ["beach", "summer"]
          }
        }
    response_example: '{"data": {"filename": "hero.jpg", "has_meta": true, "fields": [{"key": "alt", "label": "Alt Text", "type": "text", "value": "Sunset over the bay"}, {"key": "title", "label": "Title", "type": "text", "value": ""}, {"key": "caption", "label": "Caption", "type": "textarea", "value": ""}, {"key": "description", "label": "Description", "type": "textarea", "value": ""}, {"key": "tags", "label": "Tags", "type": "tags", "value": ["beach", "summer"]}], "extra": {"width": 1920, "height": 1080}}}'
    response_codes:
        - code: '200'
          description: 'Metadata saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'File not found'
        - code: '422'
          description: 'Missing or invalid `path`, or a value that is not plain text'
---

Works the same way as [Update Page Media Metadata](/2/api/endpoints/media/update-page-media-meta): only configured fields present in the request change, an empty value removes a field, other sidecar keys are kept, and values are cleaned on save. The response is the updated metadata. To apply the same values to many files in one request, use [Batch Update Site Media Metadata](/2/api/endpoints/media/batch-site-media-meta).
