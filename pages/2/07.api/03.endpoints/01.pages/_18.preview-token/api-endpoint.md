---
title: Get Preview Token
api:
    method: POST
    path: '/pages/{route}/preview-token'
    description: 'Mint a short-lived signed token that lets the frontend render this page even when it is unpublished, for draft previews. Load the page''s frontend URL with `?admin_preview=1&preview_token=<token>`; the token unlocks only this page. For a modular section, `route` is the parent page to load and `anchor` suggests an element id to scroll to (it is `null` otherwise). The token lives for `plugins.api.preview_token_ttl` seconds (default 300, minimum 30). Requires `api.pages.read` and read access to the page, and to its parent page when previewing a module.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path param).'
        - name: lang
          type: string
          required: false
          description: 'Resolve the page in a specific language (query param).'
    request_example: ''
    response_example: '{"data": {"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...", "expires_in": 300, "route": "/blog/my-post", "anchor": null}}'
    response_codes:
        - code: '200'
          description: 'Preview token returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Draft preview is turned off (`plugins.api.allow_draft_preview: false`), missing `api.pages.read` permission, or denied by the page''s rules.'
        - code: '404'
          description: 'Page not found.'
        - code: '422'
          description: 'Invalid language code.'
---
