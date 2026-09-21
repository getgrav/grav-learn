---
title: Set Media Order
api:
    method: POST
    path: /media/order
    description: 'Save a manual ordering for the files in a site-level media folder.'
    parameters: []
    request_example: |
        {
          "path": "photos",
          "order": ["dunes.jpg", "beach.jpg", "sunset.jpg"]
        }
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Order saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission'
        - code: '404'
          description: 'Folder not found'
        - code: '422'
          description: 'Missing `order` array, or invalid `path`'
---

`path` is the folder relative to the media root; leave it out for the root folder. `order` lists filenames in the order you want. Entries are reduced to base filenames, and blanks are dropped. An empty `order` removes the saved order.

The order is stored in a `media_order.yaml` file inside the folder, and [List Site Media](/2/api/endpoints/media/list-site-media) applies it when listing that folder. Files that aren't in the saved order (new uploads, for example) follow the ordered ones. The order file itself never appears in listings or search results, and it is kept up to date when a file is deleted, renamed or moved.
