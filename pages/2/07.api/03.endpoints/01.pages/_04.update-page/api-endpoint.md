---
title: Update Page
api:
    method: PATCH
    path: '/pages/{route}'
    description: 'Partial update of a page. Only provided fields are changed, and the result is validated against the page blueprint. Returns the updated page with a new ETag. Requires `api.pages.write`, subject to the page''s own `update` rule; enabling `process.twig`, or editing a page that already has it on, also needs the Twig-in-content permission.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route (path parameter)'
        - name: title
          type: string
          required: false
          description: 'Updated page title'
        - name: content
          type: string
          required: false
          description: 'Updated markdown content'
        - name: header
          type: object
          required: false
          description: 'Header values to merge into existing frontmatter. A `null` value removes that key.'
        - name: header_mode
          type: string
          required: false
          description: 'Set to `replace` to replace the whole frontmatter with `header` instead of merging (used by raw frontmatter editors).'
        - name: template
          type: string
          required: false
          description: 'Change the page template'
        - name: published
          type: boolean
          required: false
          description: 'Set the published state'
        - name: visible
          type: boolean
          required: false
          description: 'Set the visible state'
        - name: lang
          type: string
          required: false
          description: 'Query parameter. Update a specific language version; that translation must already exist (create it with `POST /pages/{route}/translate`).'
    request_example: '{"title": "Updated Title", "header": {"subtitle": "New subtitle"}}'
    response_example: '{"data": {"route": "/blog/my-post", "slug": "my-post", "title": "Updated Title", "template": "post", "header": {"title": "Updated Title", "subtitle": "New subtitle"}, "content": "# Hello World", "media": [], "permissions": {"create": true, "read": true, "update": true, "delete": true, "publish": true, "list": true}}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.write` permission, denied by the page''s rules, or Twig-in-content not allowed'
        - code: '404'
          description: 'Page not found'
        - code: '409'
          description: 'Conflict (`If-Match` does not match the current ETag)'
        - code: '422'
          description: 'Blueprint validation failed, invalid language code, or the requested translation does not exist'
---

Supports [optimistic concurrency control](/2/api/getting-started#concurrency-control) via the `If-Match` header. Include the ETag from your last GET request to prevent overwriting concurrent changes.
