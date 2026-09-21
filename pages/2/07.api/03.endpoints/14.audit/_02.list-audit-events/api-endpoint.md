---
title: List Audit Events
api:
    method: GET
    path: '/audit/events'
    description: 'Paginated audit events, newest first, narrowed by the optional filters. The pagination `links` keep the active filters, so following `next` on a filtered view stays filtered. Requires a super admin with `api.super` (a scoped API key needs the `admin.super` scope); demo accounts get 403.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Events per page. Defaults to 50, capped at `plugins.api.pagination.max_per_page` (default 1000).'
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
    response_example: '{"data": [{"id": 42, "ts": 1758441600000, "event": "page.update", "severity": "info", "actor_id": "admin", "actor_name": "Admin User", "actor_roles": ["admin"], "auth_method": "jwt", "ip": "127.0.0.1", "user_agent": "Mozilla/5.0", "target_type": "page", "target_id": "/blog/my-first-post", "status": null, "context": {"changes": {"title": {"old": "Hello", "new": "My First Post"}}}}], "meta": {"pagination": {"page": 1, "per_page": 50, "total": 1, "total_pages": 1}}, "links": {"self": "/api/v1/audit/events?page=1&per_page=50&event=page.update"}}'
    response_codes:
        - code: '200'
          description: 'Events returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Not a super admin with `api.super`, a scoped key without `admin.super`, or a demo account.'
        - code: '404'
          description: 'The audit trail is not enabled.'
        - code: '503'
          description: 'The SQLite PHP extension is not installed.'
---

See the [Audit Trail](/2/api/endpoints/audit) introduction for the event fields. `context` carries a few scalar hints from the event when present (`method`, `reason`, `old_route`, `new_route`, `lang`, `version`, `bytes`), and with `coverage: detailed` a page update also carries `changes`, the before and after value of each changed field, as in the example.
