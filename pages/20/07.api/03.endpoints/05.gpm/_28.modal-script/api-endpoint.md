---
title: Get Modal Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/modal-script/{modalId}'
    description: 'Serve the web component for a plugin-provided modal dialog. Convention: the file lives at `admin-next/modals/{modalId}.js` and is mounted as the custom element `grav-{slug}--modal-{modalId}`. Opened from a plugin web component via `window.__GRAV_DIALOGS.open()`, or directly from a menubar item carrying a `modal` intent. A plugin can ship several distinct modals, each with its own `modalId`.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Plugin slug.'
        - name: modalId
          type: string
          required: true
          description: 'Modal component id — the basename of the file under `admin-next/modals/`.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'JavaScript file served.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Modal component not found.'
---
