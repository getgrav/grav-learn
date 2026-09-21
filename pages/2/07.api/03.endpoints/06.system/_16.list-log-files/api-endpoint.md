---
title: List Log Files
api:
    method: GET
    path: /system/logs/files
    description: 'List the log files the admin log viewer can open. These names are the only values `GET /system/logs` and `DELETE /system/logs` accept for `file`. Requires `api.system.read`; demo accounts get 403.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"files": [{"file": "grav.log", "label": "Grav System Log"}, {"file": "security.log", "label": "Security Log"}, {"file": "email.log", "label": "Email Log"}, {"file": "scheduler.log", "label": "Scheduler Log"}, {"file": "custom-plugin.log", "label": "Custom Plugin Log"}], "default": "grav.log"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission, or a demo account'
---

The four core logs are always listed first, even before they have been written. Any other `*.log` file in the `log://` folder follows, then files plugins add through the `onApiLogFiles` event. Entries are de-duplicated by file name.
