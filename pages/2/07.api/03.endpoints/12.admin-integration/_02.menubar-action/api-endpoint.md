---
title: Execute Menubar Action
api:
    method: POST
    path: '/menubar/actions/{plugin}/{action}'
    description: 'Execute a plugin-registered menubar action. Fires `onApiMenubarAction` with the plugin/action routing keys, the posted body, and the current user. Plugins that own the `{plugin}` slug set `$event[''result'']`, for example `{"status": "success", "message": "..."}` or `{"status": "error", "message": "..."}`. The result is returned as-is with HTTP 200 either way, and Admin2 shows a success or error toast based on `status`. If a registered menubar item matches this plugin and action, the caller must satisfy its `authorize`. An action with no matching item only needs `api.access`, so its handler should check permissions itself.'
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
          description: 'The handler ran. Its result is returned as-is, including `status: error` results.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission, or the caller fails the `authorize` declared on the matching menubar item.'
        - code: '404'
          description: 'No plugin handled this plugin/action pair.'
---
