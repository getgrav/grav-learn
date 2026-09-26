---
title: REST API
taxonomy:
    category: docs
description: Mailroom's admin routes under /api/v1/mailroom, how to authenticate, which permission each needs, and the routes grouped by screen.
---

# REST API

Mailroom adds its admin routes to the Grav API plugin, under `/api/v1/mailroom/`. Every screen in the admin is built on these routes, so anything it does, a script or an AI client can do too (see [MCP](../mcp)). Paths below leave out the `/api/v1` prefix.

These are the admin routes. The public signup endpoint is a different thing, with no key: see [Subscribe API](../subscribe-api).

## Authenticate

Use any credential the API plugin accepts:

- An **API key**, sent as `X-API-Key`. Create one in Admin Next (your account, then **API Keys**) or on the server with `bin/plugin api keys:generate --user=<username>`. A key created with scopes is limited to them: give it `mailroom.view`, and `mailroom.manage` and `mailroom.send` if it should write and send.
- A **JWT** from `POST /auth/token`, sent as `X-API-Token` (Admin Next does this).

```bash
curl -k "https://example.test/api/v1/mailroom/overview" -H "X-API-Key: $KEY"
```

## Who may call what

Every route needs `api.access` and one of Mailroom's permissions. Reads take `mailroom.view`, writes take `mailroom.manage`, and anything that puts mail in inboxes takes `mailroom.send` as well as `mailroom.manage`. `api.super` counts as all three. The tables below say **view**, **manage** or **send**.

## Conventions

- Answers wrap their payload in `data`: `{"data": {...}}`.
- Errors are problem details (`application/problem+json`) with `status`, `title` and `detail`. A refusal you can act on (a list code that cannot change, a suppressed address, a merge tag that is not allowed) says so in `detail`.
- Times are UTC epoch seconds, both ways.
- An email address is never echoed back to a caller that did not already have it.
- Lists take `page` and `per_page` (at most 200 where a route pages).

## Routes

### Overview and settings

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/overview` | view | The Overview tab: counts by status, growth, recent campaigns, alerts |
| `GET /mailroom/settings` | view | What the Settings cards read: the transport, the worker, the From address, the providers |
| `GET /mailroom/labels` | view | The admin's own strings. No MCP tool. |

### Campaigns

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/campaigns` | view | Every campaign, newest first. `status`, `page`, `per_page`. Status counts are for the whole table. |
| `POST /mailroom/campaigns` | manage | Create a draft. See below. |
| `GET /mailroom/campaigns/audience` | view | Count who a campaign would reach before it exists: `lists=1,3`, `segment=5`. |
| `GET /mailroom/campaigns/{id}` | view | One campaign with its counters, rates, subject test and the moves it can make next |
| `PATCH /mailroom/campaigns/{id}` | manage | Edit a draft or scheduled campaign |
| `DELETE /mailroom/campaigns/{id}` | manage | Delete a draft or cancelled campaign |
| `GET /mailroom/campaigns/{id}/sends` | view | Its recipients and what happened to each. `status`, `page`, `per_page`. |
| `GET /mailroom/campaigns/{id}/links` | view | Its links and their clicks |
| `GET /mailroom/campaigns/{id}/timeline` | view | Its first 48 hours, by the hour |
| `GET /mailroom/campaigns/{id}/preview` | view | Render the saved campaign |
| `POST /mailroom/campaigns/{id}/preview` | manage | Render unsaved fields (`subject`, `preheader`, `body_md`, `layout`) |
| `POST /mailroom/campaigns/{id}/test` | send | `{email}`: send one test copy |
| `POST /mailroom/campaigns/{id}/start` | send | Send now, or `{scheduled_at}` (UTC epoch seconds) to schedule |
| `POST /mailroom/campaigns/{id}/pause` | manage | Pause |
| `POST /mailroom/campaigns/{id}/resume` | send | Resume a paused or stopped campaign |
| `POST /mailroom/campaigns/{id}/cancel` | manage | Cancel for good |
| `GET /mailroom/campaigns/{id}/catch-up` | view | Count the people who joined its lists after it went out |
| `POST /mailroom/campaigns/{id}/catch-up` | send | Send it to them |
| `POST /mailroom/campaigns/{id}/retry-failed` | send | Retry every failed send, or `{send_id}` for one |

The campaign fields, for create and edit: `name` (required on create), `subject`, `preheader`, `body_md`, `layout` (`store` for the branded layout, or `plain`), `list_id` or `list_ids` (every list, in order), `segment_id`, `template_id` (create only: copy a template's fields once), `from_name`, `from_email`, `reply_to`, `track_opens`, `track_clicks`, `subject_b`, `ab_sample_percent` (10 to 50), `ab_window_minutes` and `utm` (`{source, medium, campaign, content}`). Leave `list_ids` empty and give a `segment_id` to send to everybody on any list who matches it.

```bash
curl -k -X POST https://example.test/api/v1/mailroom/campaigns \
  -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"name": "October news", "subject": "What changed in October", "body_md": "Hello {{ subscriber.first_name }},", "list_ids": [1, 3]}'
```

### Subscribers

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/subscribers` | view | The table. `q`, `status`, `source`, `list`, `list_status` (with `list`), `tag`, `campaign_id` with `campaign_received` (`yes` or `no`), `page`, `per_page`. Status counts for the whole table, and `list_counts` with a list. |
| `POST /mailroom/subscribers` | manage | Add one person: `{email, name, list_id, tags, language, mode, note}`. `mode` is `invite` or `subscribed` (then `note` is required); without it the list decides. The answer's `outcome` says `added`, `invited`, `already_on` or `already_invited`. |
| `POST /mailroom/subscribers/bulk` | manage | One action over many people. See [Bulk actions](../bulk-actions#from-the-api). |
| `GET /mailroom/subscribers/{id}` | view | One person: consent, lists, tags, the import they came in with, whether the address is suppressed, what they were sent, and `consent_log` |
| `PATCH /mailroom/subscribers/{id}` | manage | `{name, language, lists, tags}`. The address cannot change. Only lists they already hold move, and a list they left themselves stays left. |
| `DELETE /mailroom/subscribers/{id}` | manage | Delete them. A suppression stays. |
| `POST /mailroom/subscribers/{id}/unsubscribe` | manage | Take them off every list, as done by the site |
| `POST /mailroom/subscribers/{id}/resubscribe` | manage | `{note, list_id}`: put them back, with how they asked. `list_id` omitted means every list they were on. |
| `POST /mailroom/subscribers/{id}/confirm` | manage | Confirm somebody waiting, by hand |
| `GET /mailroom/subscribers/{id}/export` | manage | Everything held about them, as one JSON document. See [Privacy](../privacy#data-export-for-one-person). |
| `GET /mailroom/subscribers/export` | manage | The table as a CSV, with the same filters. No MCP tool. |

### Imports

| Route | Permission | What it does |
|---|---|---|
| `POST /mailroom/imports/preview` | manage | Multipart: `file`, and optionally `mapping` (JSON) and `list_id`. Answers the columns, a detected preset, the first rows as they would be read, and a `dry_run` with the counts. No MCP tool. |
| `POST /mailroom/imports` | manage | Multipart: `file`, `mapping` (JSON, with an `email` column), `list_id`, `as_confirmed`, `tag`, `basis`. Queues the import. No MCP tool. |
| `GET /mailroom/imports` | view | Recent runs with their counts |
| `GET /mailroom/imports/{id}` | view | One run, with its progress |

### Lists and tags

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/lists` | view | Every list with how many are subscribed |
| `POST /mailroom/lists` | manage | `{code, name, description, double_opt_in, public, is_default, position, from_name, from_email}` |
| `PATCH /mailroom/lists/{id}` | manage | The same, except `code`, which cannot change. Lists cannot be deleted. |
| `GET /mailroom/tags` | view | Every tag with how many carry it |
| `POST /mailroom/tags` | manage | `{code, label}`. The code is normalised; an existing tag is answered rather than refused. |
| `DELETE /mailroom/tags/{id}` | manage | Delete a tag and take it off everybody |

### Templates

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/templates` | view | Every template |
| `POST /mailroom/templates` | manage | `{name, subject, preheader, body_md, layout, is_active}` |
| `GET /mailroom/templates/{id}` | view | One template |
| `PATCH /mailroom/templates/{id}` | manage | Edit it |
| `DELETE /mailroom/templates/{id}` | manage | Delete it. Campaigns written from it keep their copy. |
| `GET /mailroom/templates/{id}/preview` | view | Render it |
| `POST /mailroom/templates/{id}/preview` | manage | Render unsaved fields |

### Suppressions

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/suppressions` | view | The list. `reason` (`hard_bounce`, `complaint`, `manual`, `invalid`), `page`, `per_page`. |
| `POST /mailroom/suppressions` | manage | `{email, reason, note}`. `reason` is `manual` (the default) or `invalid`. |
| `DELETE /mailroom/suppressions/{hash}` | manage | Remove one, by the SHA-256 of the lower-cased address |

### Segments

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/segments/vocabulary` | view | Every field a condition may name, with its type, operators and options |
| `POST /mailroom/segments/preview` | view | `{definition, list_id}`: count and sample a condition document without saving it |
| `GET /mailroom/segments` | view | Every segment with its cached count and when it was taken |
| `POST /mailroom/segments` | manage | `{name, description, list_id, definition}` |
| `GET /mailroom/segments/{id}` | view | One segment with its document |
| `PATCH /mailroom/segments/{id}` | manage | Edit it. Changing the conditions or list clears the count. |
| `DELETE /mailroom/segments/{id}` | manage | Delete it, unless a draft or scheduled campaign points at it |
| `POST /mailroom/segments/{id}/count` | manage | Recount it now |

The document format is in [Tags and segments](../tags-and-segments#in-the-api).

### Deliverability and providers

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/deliverability` | view | The Health screen's checks, cached for ten minutes |
| `POST /mailroom/deliverability/recheck` | manage | Look everything up again |
| `POST /mailroom/providers/{name}/secret` | manage | Mint a new webhook secret for a provider, write it to the settings, and answer the card with the URL |
| `POST /mailroom/providers/{name}/setup` | manage | Create the webhook through the provider's API, where it allows |

### Automations

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/flows/recipes` | view | The ready-made automations |
| `POST /mailroom/flows/recipes/{key}` | manage | Write a draft from one |
| `GET /mailroom/flows` | view | Every automation with where its people are |
| `POST /mailroom/flows` | manage | `{name, trigger, trigger_json, list_id, segment_id, allow_reentry, steps}`. Created as a draft. |
| `GET /mailroom/flows/{id}` | view | One automation with its steps and a page of its people. `status` (`active`, `waiting`, `done`, `exited`), `page`. |
| `PATCH /mailroom/flows/{id}` | manage | Edit it. Steps are saved whole; a step sent back with its `id` keeps its people. |
| `DELETE /mailroom/flows/{id}` | manage | Delete it. With people in it, `force=1` takes them out first. |
| `POST /mailroom/flows/{id}/activate` | manage | Turn it on |
| `POST /mailroom/flows/{id}/pause` | manage | Pause it |
| `POST /mailroom/flows/{id}/resume` | manage | Resume it |
| `POST /mailroom/flows/{id}/enrol` | manage | `{subscriber_id}`: put one person in |
| `POST /mailroom/flows/{id}/enrolments/{eid}/exit` | manage | Take one person out |

On Mailroom, `trigger` is `subscribed`, `confirmed` or `tag_added` (with `trigger_json: {"tag": "code"}`). The step format is in [Automations](../automations#from-the-api).

### Reports

| Route | Permission | What it does |
|---|---|---|
| `GET /mailroom/reports/{type}` | view | One of the seven reports as JSON |
| `GET /mailroom/reports/{type}.csv` | view | The same as a CSV. No MCP tool. |

See [Reports and tracking](../reports-and-tracking#from-the-api) for the types and parameters.

### Erasure

| Route | Permission | What it does |
|---|---|---|
| `POST /mailroom/erase` | manage | `{email}`: forget one address. Answers `{erased, counts}` and never repeats the address. See [Privacy](../privacy#erase-an-address). |

## A quick check with curl

```bash
KEY=...   # an API key of an account with mailroom.view and mailroom.manage
BASE=https://example.test/api/v1/mailroom

curl -k "$BASE/lists" -H "X-API-Key: $KEY"

curl -k -X POST "$BASE/subscribers" -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"email": "ada@example.com", "name": "Ada", "list_id": 1, "mode": "invite"}'

curl -k "$BASE/subscribers?status=pending&per_page=50" -H "X-API-Key: $KEY"
```

## Related

- [MCP](../mcp)
- [Subscribe API](../subscribe-api)
- [Installation](../installation#give-your-team-access)
