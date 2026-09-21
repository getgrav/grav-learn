---
title: Export Audit Log
api:
    method: GET
    path: '/audit/export'
    description: 'Download every event matching the filters, newest first and capped at 100,000 rows, as an attachment (`audit-log.csv` or `audit-log.json`) sent with `Cache-Control: no-store`. The file is not wrapped in the JSON envelope. Requires a super admin with `api.super` (a scoped API key needs the `admin.super` scope); demo accounts get 403.'
    parameters:
        - name: format
          type: string
          required: false
          description: '`csv` (default) or `json`. Any other value falls back to CSV.'
        - name: event
          type: string
          required: false
          description: 'Exact event code, e.g. `page.update`.'
        - name: actor
          type: string
          required: false
          description: 'Exact actor id or actor name.'
        - name: target_type
          type: string
          required: false
          description: 'Exact target type, e.g. `page`, `user` or `config`.'
        - name: severity
          type: string
          required: false
          description: 'Exact severity (`info`, `notice` or `warning`).'
        - name: from
          type: integer
          required: false
          description: 'Earliest timestamp, inclusive, in Unix epoch milliseconds.'
        - name: to
          type: integer
          required: false
          description: 'Latest timestamp, inclusive, in Unix epoch milliseconds.'
        - name: q
          type: string
          required: false
          description: 'Case-insensitive substring of the actor name, target id, event code or IP.'
    request_example: ''
    response_example: |
        id,ts,event,severity,actor_id,actor_name,actor_roles,auth_method,ip,user_agent,target_type,target_id,status,context
        42,1758441600000,page.update,info,admin,"Admin User","[""admin""]",jwt,127.0.0.1,Mozilla/5.0,page,/blog/my-first-post,,
    response_codes:
        - code: '200'
          description: 'The log file, as `text/csv` or `application/json`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin with `api.super`, a scoped key without `admin.super`, or a demo account.'
        - code: '404'
          description: 'The audit trail is not enabled.'
        - code: '503'
          description: 'The SQLite PHP extension is not installed.'
---

The CSV columns are `id, ts, event, severity, actor_id, actor_name, actor_roles, auth_method, ip, user_agent, target_type, target_id, status, context`. Array values such as `actor_roles` and `context` are JSON-encoded, and a cell starting with `=`, `+`, `-`, `@`, a tab or a carriage return is prefixed with `'` so spreadsheet apps don't run it as a formula.

With `format=json` the file is a bare JSON array of events with the same fields as [List Audit Events](/2/api/endpoints/audit/list-audit-events).
