---
title: REST API
taxonomy:
    category: docs
description: Helpdesk Pro's routes under /api/v1/helpdesk-pro, who may call them, the ticket and timeline JSON, and the collision guard.
---

# REST API

Helpdesk Pro adds its routes to the Grav API plugin, under `/api/v1/helpdesk-pro/`. The staff desk is built entirely on these routes, so anything it does, a script or an AI client can do too (see [MCP](../mcp)). Paths below leave out the `/api/v1` prefix.

## Authenticate

Use any credential the API plugin accepts:

- An **API key**, sent as `X-API-Key`. Create one in Admin Next (your account, then **API Keys**) or on the server with `bin/plugin api keys:generate --user=<username>`. A key created with scopes is limited to them: give it `helpdesk-pro.desk` and any other `helpdesk-pro.*` action it needs. A key without the desk scope cannot reach any Helpdesk Pro route, even when its owner is an admin.
- A **JWT** from `POST /auth/token`, sent as `X-API-Token` (Admin Next does this).

Tickets created and replies written with an API key record the channel `api`; the same done from Admin Next record `staff`.

```bash
curl -k "https://example.test/api/v1/helpdesk-pro/tickets?assignee=me" \
  -H "X-API-Key: $KEY"
```

## Who may call what

Every route needs `api.access` plus the permission in its row ([Projects and permissions](../projects-and-permissions#permissions)). `api.super` counts as every Helpdesk Pro permission.

The ticket routes marked **client** also answer an account that has `api.access` but no Helpdesk Pro permission. Such an account is a client, and gets exactly what the portal would show it: the tickets it requested or is cc'd on (and the shared tickets of projects it belongs to), public replies and public activity only, no notes, no labels and no email addresses. It may reply, mute, and mark its own request solved or reopen it. A ticket it cannot read answers `404`, the same as one that does not exist.

Staff see a ticket's notes and internal activity only in projects they work. A ticket outside those projects is `404` for them too.

## Conventions

- Responses wrap their payload in `data`. Lists are paginated with `page` and `per_page` (at most 100) and carry `meta.pagination` and `links`.
- Errors are problem details (`application/problem+json`) with `status`, `title` and `detail`. Validation errors (`422`) add `errors: [{field, message}]`.
- Times are epoch seconds.
- People appear as `{id, name, kind}`, plus `email` when the caller is staff on that ticket.
- Writes send an `X-Invalidates` header (`helpdesk-pro:tickets`, `helpdesk-pro:ticket:<id>`, `helpdesk-pro:projects`, …) so Admin Next refetches what changed.
- `GET /helpdesk-pro/tickets/{id}` sends an `ETag` of the ticket's editable fields. Send it back as `If-Match` on `PATCH` to be refused with `409` when someone changed one of those fields meanwhile. New replies and notes do not change it. People and organizations work the same way.

## The ticket

List rows and the detail share one form:

```json
{
  "id": 1042, "subject": "Can't reset my password", "kind": "support",
  "project": {"id": 1, "slug": "support", "name": "Support"},
  "status": {"id": 2, "name": "Open", "category": "open", "color": "#22c55e"},
  "priority": 1, "visibility_scope": "requester", "channel": "email", "triage_state": "accepted",
  "requester": {"id": 55, "name": "Ada Lovelace", "kind": "client", "email": "ada@example.com"},
  "assignee": {"id": 3, "name": "Anna", "kind": "staff"},
  "labels": [{"id": 4, "name": "billing", "color": "#f59e0b"}],
  "first_message_id": 7001, "last_public_message_id": 7010,
  "counts": {"public": 3, "attachments": 2, "notes": 1},
  "times": {"created_at": 0, "last_public_at": 0, "resolved_at": null, "closed_at": null,
            "updated_at": 0, "last_activity_at": 0, "last_requester_at": 0, "last_staff_reply_at": 0,
            "first_response_at": 0, "status_changed_at": 0, "waiting_since": null},
  "me": {"watching": true, "muted": false, "unread": true},
  "duplicate_of_id": null, "merged_into_id": null, "reopen_count": 0, "deleted": false,
  "extra": {}
}
```

`triage_state`, `labels`, `counts.notes`, the staff times, `duplicate_of_id`, `merged_into_id`, `reopen_count` and `deleted` are only there for staff who work the ticket's project. The detail adds `participants` and `etag`, and `timeline` when asked for.

`extra` carries what features and add-ons attach:

| Key | What it holds |
|---|---|
| `extra.fields` | The ticket's [custom field](../custom-fields) values the caller may see, key to value |
| `extra.organization` | The ticket's [organization](../organizations) as `{id, name}`, for staff only |
| `extra.sla` | The ticket's [SLA](../sla) state, for staff only |
| `extra.csat` | The ticket's [rating](../customer-ratings), in full for staff; the requester's own answer for the requester |

## The timeline

`GET /helpdesk-pro/tickets/{id}/timeline` returns messages and activity interleaved, oldest first:

```json
[
  {"type": "message", "id": 7001, "ticket_id": 1042, "visibility": "public",
   "author": {"id": 55, "name": "Ada Lovelace", "kind": "client"}, "source": "email",
   "body_html": "<p>…</p>", "body_md": "…", "stripped": false, "has_original": true,
   "edited_at": null, "created_at": 0, "attachments": []},
  {"type": "activity", "id": 301, "action": "status", "actor": {"id": 3, "name": "Anna", "kind": "staff"},
   "before": {"status_id": 1, "category": "new", "name": "New"},
   "after": {"status_id": 2, "category": "open", "name": "Open"},
   "visibility": "public", "created_at": 0}
]
```

`visibility` is `public` for replies and `internal` for notes. `body_md` and `has_original` are staff-only. `attachments` lists the message's files; a client gets the public files of public messages only, without `api_path`.

Activity `action` is one of `created`, `status`, `priority`, `kind`, `subject`, `assignee`, `labels`, `project`, `visibility_scope`, `triage`, `merged`, `merged_from`, `participant`, `message_edited`, `message_deleted`, `deleted`, `restored`, `erased` or `fields`. Clients see public activity only: resolving, closing, reopening, declining and merging.

## The collision guard

When the desk sends a reply it passes `based_on_message_id`, the newest public message it has shown. If a newer public message exists (the client wrote in meanwhile), `POST /helpdesk-pro/tickets/{id}/messages` answers `409` and nothing is posted:

```json
{"status": 409, "title": "Conflict", "detail": "The conversation has new messages since you started writing",
 "code": "thread_changed", "messages": [{"type": "message", "id": 7011, "visibility": "public", "…": "…"}]}
```

`messages` holds the new public messages in timeline form. Send again with `force: true` to post anyway.

## Routes

### Desk

| Route | Permission | Response |
|---|---|---|
| `GET /helpdesk-pro/config` | desk | The UI settings: `routes`, `assetBase`, `default_view`, `board`, `batch_minutes`, `semantic`, `realtime`, and your `prefs`. Never a secret. |
| `GET /helpdesk-pro/bootstrap` | desk | `{config, me, projects, statuses, labels, staff, saved_views, counts}` in one call. |
| `GET /helpdesk-pro/counts` | desk | `triage`, `mine_needing_reply`, `unassigned`, `by_category`, `notifications_unread`, `inbound_attention` and `channels_attention` (both 0 without `helpdesk-pro.settings`). |
| `GET /helpdesk-pro/badge` | desk | `{count, triage, mine_needing_reply}` for the Admin Next sidebar badge. No MCP tool. |
| `GET /helpdesk-pro/status` | settings | The status report (see [Troubleshooting](../troubleshooting#the-status-report)). |
| `POST /helpdesk-pro/mail/test` | settings | Sends a test email to `{to}` (see [Outbound email](../outbound-email)). |

The counts: `triage` is tickets waiting in Triage (zero unless you hold `helpdesk-pro.triage`); `mine_needing_reply` is accepted tickets assigned to you in `new`, `open` or `waiting_us` whose last public message came from the client; `unassigned` is accepted tickets in those categories with nobody assigned; `by_category` is live tickets per status category.

### Tickets

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/tickets` | desk, client | Filters below, `sort`, `order`, `page`, `per_page` | Ticket rows. Staff get `meta.facets` too. |
| `POST /helpdesk-pro/tickets` | desk | `{project_id, subject, body, requester: {id} or {email, name}, kind, priority, assignee_id, labels, visibility_scope, notify_requester, attachments_token, fields}` | `201` with the ticket and a `Location`. Staff-created tickets skip triage; without `requester` you are the requester. Required custom fields are not enforced here. |
| `GET /helpdesk-pro/tickets/{id}` | desk, client | `include=timeline` | The ticket with `participants` and `etag`. Asking for the timeline also marks the ticket and your notifications about it read. |
| `PATCH /helpdesk-pro/tickets/{id}` | desk, client | `If-Match`; any of `subject, status_id, priority, kind, project_id, assignee_id, labels, add_labels, remove_labels, visibility_scope` | The ticket. A client may only mark solved or reopen. |
| `DELETE /helpdesk-pro/tickets/{id}` | tickets.delete | `?permanent=1` also needs settings | `204`. Soft delete unless permanent. |
| `POST /helpdesk-pro/tickets/{id}/restore` | tickets.delete | | The ticket. |
| `GET /helpdesk-pro/tickets/{id}/timeline` | desk, client | `after_id`, `after_activity_id`, `mark_read=1` | Timeline items. |
| `POST /helpdesk-pro/tickets/{id}/mute` | desk, client | `{muted: bool}` | `{muted}` for you. |
| `POST /helpdesk-pro/tickets/bulk` | desk | See [Saved replies and views](../saved-replies-and-views#api-and-mcp) | `{updated, failed}` |

List filters, each one value or a comma-separated "any of":

| Filter | Values |
|---|---|
| `q` | Subject text, or a ticket number (`1042` or `#1042`). For staff it also matches the requester's name or address and the conversation and notes through the search index, and each row carries `matched_in_note`. For clients it is a subject match only. |
| `project`, `status`, `label`, `requester` | Ids |
| `category` | `new`, `open`, `waiting_client`, `waiting_us`, `resolved`, `closed` |
| `assignee` | `me`, `none` or person ids |
| `priority` | `0`–`3` or `low`, `normal`, `high`, `urgent` |
| `kind`, `channel` | Kinds and channels |
| `triage` | `pending`, `accepted`, `declined`, `duplicate` |
| `organization` | Organization ids or `none` |
| `sla` | `breached`, `due_soon` (staff only) |
| `unread=1`, `deleted=1` | Unread tickets; deleted tickets (needs `helpdesk-pro.tickets.delete`) |
| `cf_<key>` | A custom field (staff only): option values for a select or multi-select, `1` or `0` for a checkbox, `from..to` for a date, the exact value otherwise. An unknown key is ignored. |

Sort by `updated` (default), `created`, `priority`, `waiting`, `id` or (staff, with SLA) `due`; `order` is `desc` (default) or `asc`. `meta.facets` counts the whole filtered set per `category`, `assignee`, `project`, `priority`, `kind`, `label` and `sla`; each facet ignores its own filter.

```bash
curl -k "https://example.test/api/v1/helpdesk-pro/tickets?category=new,open&assignee=me&per_page=50" -H "X-API-Key: $KEY"
```

### Messages

| Route | Permission | Request | Response |
|---|---|---|---|
| `POST /helpdesk-pro/tickets/{id}/messages` | desk, client | `{body, visibility: public or internal, status_after_id, based_on_message_id, force, attachments_token, saved_reply_id}` | `201` with the message and its `attachments`; `409` `thread_changed` |
| `PATCH /helpdesk-pro/messages/{id}` | desk | `{body}` | The message. Your own messages, or any with `helpdesk-pro.tickets.delete`. |
| `DELETE /helpdesk-pro/messages/{id}` | tickets.delete | | `204` |
| `GET /helpdesk-pro/messages/{id}/original` | desk | | The original email behind a message |

`visibility: public` (the default) is a reply: the requester and cc'd clients read it and are emailed it. `visibility: internal` is a note: staff only. Clients can only reply.

```bash
curl -k -X POST https://example.test/api/v1/helpdesk-pro/tickets/1042/messages \
  -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"body": "Fixed in 2.1.3, please update.", "status_after_id": 5}'

curl -k -X POST https://example.test/api/v1/helpdesk-pro/tickets/1042/messages \
  -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"body": "Customer is on the legacy plan.", "visibility": "internal"}'
```

### Participants

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/tickets/{id}/participants` | desk | | `[{person, role, reason, muted, created_at}]`: requester, cc's and watchers |
| `POST /helpdesk-pro/tickets/{id}/participants` | desk | `{person_id or email, role: cc or watcher}` | Everyone on the ticket. A cc must be a client (an unknown email becomes a new person); a watcher must be staff who work the project. |
| `DELETE /helpdesk-pro/tickets/{id}/participants/{personId}` | desk | | `204`. The requester cannot be removed (`409`). |

### People

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/people` | desk | `q, kind, state, page, per_page`, or `q, for=requester` | People: `{id, name, display_name, email, email_verified, kind, state, account, locale, timezone, last_seen_at, created_at, updated_at}`. With `for=requester`, one entry per address, adding `send_as`, `unverified` and `email_proven`. |
| `POST /helpdesk-pro/people` | people.manage | `{email, name}` | `201` with the person; `409` when the email is known |
| `GET /helpdesk-pro/people/{id}` | desk | | The person with `tickets` (their ten most recent you can read), `ticket_total`, and an `ETag` |
| `PATCH /helpdesk-pro/people/{id}` | people.manage | `If-Match`; `{name, email, locale, timezone, state: active or blocked}` | The person |

Merging, erasure, legal holds and account links are in [People and privacy](../people-and-privacy#api-and-mcp).

### Projects

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/projects` | desk | `archived=1` | The projects you work, in order |
| `POST /helpdesk-pro/projects` | projects.manage | `{name, slug, description, visibility, staff_access, intake, triage_required, default_kind, default_assignee_id, board_enabled, color, icon, email_alias, kb_category}` | `201` with the project |
| `POST /helpdesk-pro/projects/reorder` | projects.manage | `{ids}`, every project once | `204` |
| `GET /helpdesk-pro/projects/{id}` | desk | | The project with `members: {people: [{person, role}], groups: [{group, role}]}` |
| `PATCH /helpdesk-pro/projects/{id}` | projects.manage | Any project field, `archived` | The project |
| `DELETE /helpdesk-pro/projects/{id}` | projects.manage | | `204` when it was empty and is gone; `200` with `result: archived` when it had tickets |
| `PUT /helpdesk-pro/projects/{id}/members` | projects.manage | `{people: [{id, role}], groups: [{group, role}]}`, roles `agent` or `client` | The new members. Replaces them all. |
| `GET /helpdesk-pro/projects/{id}/board` | desk | The list's filters, plus `closed` and `limit` | `{project, columns: [{status, tickets, total}], closed: {shown, total}, facets}`. A project without a board is `404`. |

### Custom fields

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/fields` | desk, client | `project`, `archived=1` (staff) | Definitions in list order: `{id, key, label, help, type, options, required, visibility, projects, position, list_column, filterable, archived, value_count}`. A client sees public and readonly fields, with fewer keys. |
| `POST /helpdesk-pro/fields` | projects.manage | `{key, label, type, help, options, required, visibility, projects, list_column, position}` | `201` with the field |
| `PUT /helpdesk-pro/fields/order` | projects.manage | `{ids: [3, 1, 2]}` | Every field in the new order |
| `GET /helpdesk-pro/fields/{id}` | desk, client | | The field |
| `PATCH /helpdesk-pro/fields/{id}` | projects.manage | Any create field but `key` | The field. The type changes only while no ticket holds a value. |
| `DELETE /helpdesk-pro/fields/{id}` | projects.manage | `permanent=1` | `204` when it had no values; `200` with `result: archived` when it had values. `permanent=1` deletes an archived field and its values. |
| `POST /helpdesk-pro/fields/{id}/restore` | projects.manage | | The field, no longer archived |
| `GET /helpdesk-pro/tickets/{id}/fields` | desk, client | | `[{key, label, type, visibility, value, display}]` |
| `PATCH /helpdesk-pro/tickets/{id}/fields` | desk (edit) | `{fields: {key: value}}`; `null` or `''` clears | The same list afterwards. One bad value saves none. |

### Routes on other pages

| Area | Where |
|---|---|
| Statuses and labels | [Statuses and labels](../statuses-and-labels#api-and-mcp) |
| Triage and merging | [Triage and merging](../triage-and-merging#api-and-mcp) |
| Saved replies, views and bulk edit | [Saved replies and views](../saved-replies-and-views#api-and-mcp) |
| Knowledge base | [Knowledge base](../knowledge-base#api) |
| Search | [Search](../search#api-and-mcp) |
| Attachments | [Attachments](../attachments#the-upload-flow) |
| Notifications and preferences | [Notifications](../notifications#api-and-mcp) |
| Notification channels | [Notification channels](../notification-channels#api-and-mcp) |
| Inbound email | [Inbound email](../inbound-email#routes-and-mcp-tools) |
| Rules | [Rules and automations](../rules-and-automations#api-and-mcp) |
| SLA | [SLA](../sla#api-and-mcp) |
| Ratings | [Customer ratings](../customer-ratings#api-and-mcp) |
| Organizations | [Organizations](../organizations#api-and-mcp) |
| Reports | [Reports](../reports#api-and-mcp) |
| People: merge, erase, legal holds | [People and privacy](../people-and-privacy#api-and-mcp) |
| Live updates and presence | [Live updates](../live-updates#routes) |

## A quick check with curl

```bash
KEY=...   # an API key of a staff account
BASE=https://example.test/api/v1/helpdesk-pro

curl -k "$BASE/bootstrap" -H "X-API-Key: $KEY"

curl -k -X POST "$BASE/tickets" -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"project_id": 1, "subject": "Printer on fire", "body": "It is hot.", "requester": {"email": "ada@example.com"}}'

curl -k -X PATCH "$BASE/tickets/1" -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"status_id": 2, "priority": 3}'
```

## Related

- [MCP](../mcp)
- [Extending](../extending)
- [Projects and permissions](../projects-and-permissions)
