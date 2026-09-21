---
title: Create Page
api:
    method: POST
    path: /pages
    description: 'Create a new page. The parent page must already exist (except for top-level pages), and the target folder must be free. The frontmatter is built from the template blueprint''s defaults, then `title`, then the supplied `header`. Returns 201 with the new page and a `Location` header. Requires `api.pages.write`, subject to the parent page''s own `create` rule; setting `process.twig: true` also needs the Twig-in-content permission.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The route where the page will be created'
        - name: title
          type: string
          required: true
          description: 'The page title'
        - name: template
          type: string
          required: false
          description: 'Page template to use'
          default: default
        - name: content
          type: string
          required: false
          description: 'Markdown content for the page body'
        - name: header
          type: object
          required: false
          description: 'Page header/frontmatter values'
        - name: order
          type: integer
          required: false
          description: 'Numeric ordering prefix for the page folder. Pass `"auto"` to use the next free number among the siblings (or no prefix when no sibling has one).'
        - name: kind
          type: string
          required: false
          description: 'One of `page` (default), `folder` (a folder with no `.md` file) or `module` (a modular section, its slug is prefixed with `_`). For `folder`, the response may carry only `route` and `kind`.'
          default: page
        - name: lang
          type: string
          required: false
          description: 'Language code for multi-language sites (body field, or `?lang=` query parameter). Writes a `{template}.{lang}.md` file.'
    request_example: '{"route": "/blog/new-post", "title": "New Post", "template": "post", "content": "# New Post\nContent here"}'
    response_example: '{"data": {"route": "/blog/new-post", "slug": "new-post", "title": "New Post", "template": "post", "published": true, "content": "# New Post\nContent here", "media": [], "permissions": {"create": true, "read": true, "update": true, "delete": true, "publish": true, "list": true}}}'
    response_codes:
        - code: '201'
          description: 'Page created'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.write` permission, denied by the parent page''s rules, or Twig-in-content not allowed'
        - code: '422'
          description: 'Missing `route` or `title`, invalid `kind`, parent page not found, a page already exists at that route, invalid language code, or blueprint validation failed'
---

