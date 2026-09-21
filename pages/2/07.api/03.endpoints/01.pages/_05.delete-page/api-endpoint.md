---
title: Delete Page
api:
    method: DELETE
    path: '/pages/{route}'
    description: 'Delete a page and its folder. Child pages are deleted too unless `children=false`, in which case a page with children is refused with 422. With `?lang=` on a multi-language site only that language''s file is removed; when it is the page''s only translation the whole folder goes, and `children=false` is honored the same way. Requires `api.pages.write`, subject to the page''s own `delete` rule.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route to delete'
        - name: children
          type: boolean
          required: false
          description: 'Also delete child pages. `false` refuses to delete a page that has children.'
          default: 'true'
        - name: lang
          type: string
          required: false
          description: 'Delete only a specific language version (404 if the page has no such translation)'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Page deleted'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.pages.write` permission or denied by the page''s rules'
        - code: '404'
          description: 'Page not found, or no translation for the requested language'
        - code: '422'
          description: 'The page has children and `children=false`, or invalid language code'
---

