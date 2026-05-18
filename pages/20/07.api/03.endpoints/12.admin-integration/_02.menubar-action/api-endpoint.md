---
title: Execute Menubar Action
api:
    method: POST
    path: '/menubar/actions/{plugin}/{action}'
    description: 'Execute a plugin-registered menubar action. Fires `onApiMenubarAction` with the plugin/action routing keys, the posted body, and the current user. Plugins that own the `{plugin}` slug set `$event[''result'']` to `{"status": "success", ...}` (200) or `{"status": "error", "message": "..."}` (400).'
    parameters:
        - name: plugin
          type: string
          required: true
          description: 'Owning plugin slug (from the menubar item registration).'
        - name: action
          type: string
          required: true
          description: 'Action key (from the menubar item registration).'
    request_example: '{}'
    response_example: '{"data": {"status": "success", "message": "Cache warmed successfully."}}'
    response_codes:
        - code: '200'
          description: 'Action succeeded.'
        - code: '400'
          description: 'No handler registered for this plugin/action pair, or the handler returned an error.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---
