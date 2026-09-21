---
title: Editor Toolbar Buttons
api:
    method: GET
    path: '/editor/toolbar-buttons'
    description: 'Collect buttons that plugins add to the Admin2 default (CodeMirror) markdown editor toolbar through the `onApiMarkdownEditorButtons` event. A button either opens one of the plugin''s modal web components (`modal`, served by `/gpm/plugins/{plugin}/modal-script/{component}`) or carries an `insert` payload (`{content, mode}`, where `mode` is `insert-at-cursor`, `append` or `replace`) that the editor applies directly. A button may declare `authorize` (a permission string, or an array for an any-of test): buttons the caller fails are left out and `authorize` is stripped from the response. Buttons are returned in event order.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "youtube", "plugin": "youtube", "label": "YouTube Video", "icon": "<svg viewBox=\"0 0 24 24\">...</svg>", "modal": {"component": "youtube-insert", "title": "Insert YouTube Video", "size": "md"}}, {"id": "hr", "plugin": "my-plugin", "label": "Horizontal Rule", "icon": "fa-minus", "insert": {"content": "---", "mode": "insert-at-cursor"}}]}'
    response_codes:
        - code: '200'
          description: 'Buttons returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
