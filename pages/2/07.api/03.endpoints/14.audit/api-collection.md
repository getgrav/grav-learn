---
title: Audit Trail
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Read the admin audit trail: a log of the actions taken through the API, with who did them, when, from which IP and against what. Because Admin Next does everything through the API, the log covers the whole of Admin Next plus any API-key clients. Actions taken in the classic admin that bypass the API are not recorded.

The trail is off by default. Turn it on with `plugins.api.audit.enabled`; it needs the `pdo_sqlite` PHP extension. `plugins.api.audit.coverage` sets the detail level (`standard`, or `detailed` to also keep field-level before/after values for page edits), `retention_days` and `retention_max_rows` bound how much is kept, and `anonymize_ip` masks the last part of stored IPs.

Permissions: every route needs a super admin with `api.super`. An account that only holds `admin.super` is refused, and a scoped API key needs the `admin.super` scope, the same as every other super-only endpoint. Demo accounts get 403 with "The audit trail is hidden in demo mode.", since on a public demo the log holds other visitors' IPs and user agents.

Except for [Audit Status](/2/api/endpoints/audit/audit-status), the routes return 404 while the trail is disabled and 503 when SQLite is missing.

## Filters

[List Audit Events](/2/api/endpoints/audit/list-audit-events) and [Export Audit Log](/2/api/endpoints/audit/export-audit-log) accept the same filters, all optional and combined with AND:

| Parameter | Matches |
|-----------|---------|
| `event` | Exact event code, e.g. `page.update` |
| `actor` | Exact actor id or actor name |
| `target_type` | Exact target type, e.g. `page`, `media`, `user`, `group`, `config`, `package` |
| `severity` | Exact severity: recorded events use `info`, `notice` or `warning` |
| `from` | Earliest timestamp, inclusive, in Unix epoch milliseconds |
| `to` | Latest timestamp, inclusive, in Unix epoch milliseconds |
| `q` | Case-insensitive substring of the actor name, target id, event code or IP |

## Event fields

Each event has an `id`, a `ts` in Unix epoch milliseconds, the `event` code (`namespace.action`), a `severity`, the actor (`actor_id`, `actor_name`, `actor_roles`), the `auth_method` (`apikey`, `jwt` or `session`), the client `ip` and `user_agent`, the `target_type` and `target_id`, a `status` that is reserved and currently always null, and an event-specific `context` object, or `null` when the event has no extra detail.
