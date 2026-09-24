---
title: Notification Channels
taxonomy:
    category: docs
description: Post ticket events to Slack, Discord, a signed webhook or a team inbox, with what each message carries, retries, pausing and secrets.
---

# Notification Channels

A channel posts chosen ticket events to a place the team already watches: a Slack channel, a Discord channel, an endpoint of your own, or a team inbox. It is the team's feed. Each staff member's own bell and email ([Notifications](../notifications)) keep working, and a channel never replaces them.

Channels are set up in the desk under **Automation → Channels**, which needs `helpdesk-pro.settings`. A channel holds a credential and decides where ticket facts go, so nobody else can see or change one.

## Channel types

| Type | Sends | You need |
|---|---|---|
| Slack | A Block Kit message to one Slack channel through an incoming webhook | The webhook URL (`https://hooks.slack.com/services/…`) |
| Discord | One embed to one Discord channel through a channel webhook | The webhook URL (`https://discord.com/api/webhooks/…`) |
| Webhook | Signed JSON to an address of your own | The URL, and optionally a signing secret |
| Email | An email to fixed addresses: a team inbox or a distribution list | One address per line, up to 20 |

Add-ons can register more types, such as Microsoft Teams or Mattermost. They appear in the type picker beside these four (see [Extending](../extending#notification-channel-types)).

### Set up Slack

1. Go to [api.slack.com/apps](https://api.slack.com/apps) and choose **Create New App → From scratch**. Name it (for example "Helpdesk") and pick your workspace.
2. In the app's settings, open **Incoming Webhooks** and switch **Activate Incoming Webhooks** on.
3. Choose **Add New Webhook to Workspace**, pick the channel, and choose **Allow**.
4. Copy the new webhook URL.
5. In the desk, open **Automation → Channels → New channel**, pick **Slack**, paste the URL, tick the events and save.
6. Press **Send a test message**. It should answer `200 ok`.

One webhook posts to one Slack channel. To post to two, add a second webhook in the same app and a second channel here.

### Set up Discord

1. In Discord, open the channel's settings (the gear, **Edit Channel**), then **Integrations → Webhooks**. You need the Manage Webhooks permission.
2. Choose **New Webhook**, give it a name, then **Copy Webhook URL**.
3. In the desk, open **Automation → Channels → New channel**, pick **Discord**, paste the URL, tick the events and save.
4. Press **Send a test message**. It should answer `204`.

### Set up a webhook

Point the channel at any HTTPS address that accepts a JSON `POST`, and answer with any `2xx` status. Add a signing secret (16 characters or more, for example the output of `openssl rand -hex 32`) so your endpoint can check each request came from your site. See [Webhook payload](#webhook-payload).

### Set up an email channel

Pick **Email** and list the addresses, one per line. Each address gets its own copy, queued and sent like every Helpdesk Pro email, from the same From address. The template is `staff-channel`, which a theme can override.

Each email carries `List-Id: "Channel name" <helpdesk-channel-{id}.{your domain}>`, so an inbox rule can file or label them, plus `Auto-Submitted: auto-generated`. It has no Reply-To, no threading headers and no hidden ticket reference, so replying to it never posts anything to the ticket.

A new site starts with one email channel, **Team inbox**, switched off and with no address. It ticks New ticket, Client replied and SLA breached. To use it:

1. Open it and add your team's address: a shared inbox or a distribution list.
2. Tick **Enabled** and save.

> [!WARNING]
> Do not use `email.support_address` for a channel. Channel email sent there would come back in as new tickets, and would put staff-facing facts in a client-facing inbox.

The desk will not switch any channel on while a field it needs is empty, so **Enable** answers "Add at least one address" until there is one. Delete the Team inbox channel if you do not want it; it is created only once, on a site with no channels.

## What a channel can send

A channel ticks the events it sends. A new channel starts with New ticket, Client replied and SLA breached.

| Event | Sent when | The headline |
|---|---|---|
| New ticket (`ticket.new`) | A ticket is created, from any source | "New ticket from Ada Lovelace" |
| Waiting in triage (`ticket.triage`) | A new request lands in Triage | "New request from Ada Lovelace is waiting in triage" |
| Client replied (`client.replied`) | A client adds a public reply | "Ada Lovelace replied" |
| Ticket assigned (`ticket.assigned`) | A ticket is assigned to someone | "Assigned to Anna", with who assigned it |
| Resolved or closed (`ticket.resolved`) | A ticket moves into a resolved or closed status from an open one | "Resolved" or "Closed" |
| SLA due soon (`sla.warning`) | An SLA target comes within the warning time | "First response due soon", with the due time |
| SLA breached (`sla.breached`) | An SLA target is missed (not when found after the ticket was answered or solved) | "Resolution target breached", with the due time |
| Rated Not good (`rating.not_good`) | A client answers "How did we do?" with Not good | "Ada Lovelace rated their request Not good" |
| Rule posts (`rule.post`) | A rule's **Post to channels** action runs | "Rule: VIP customers", with the rule's message |

A new request that waits in triage is both a new ticket and a triage request; a channel that ticks both is told once, as the triage one. A channel also covers **every project**, or a list of them. The same event is never sent to a channel twice.

## What a message contains

Channel messages carry only these facts about the ticket, whatever the event:

- the headline and the ticket's number and subject, linked to the ticket in the desk;
- the requester's name (or address when they have no name), the project, the status, the priority and the assignee (or "Unassigned");
- a few event details: who assigned it, the SLA due time, the rule's message;
- the site's name and the event's name.

A channel never sends internal notes, staff replies, custom fields, the activity log, attachments, rating comments, triage decline reasons, or the rest of the conversation.

**The client's own words are off by default.** Each channel has an option, **Include the first lines of a client's message**. With it on, New ticket, Waiting in triage and Client replied also carry the first three lines (at most 280 characters) of what the client wrote, skipping quoted email history. Only a public message written by a client is ever used.

> [!WARNING]
> With that option on, the start of a client's message is copied into Slack, Discord or a mailbox, and kept there under that service's retention, where your erasure and retention settings cannot reach. Clients write passwords, health details and account numbers into support requests. Leave it off unless the channel is private to the people who work those tickets, and mention it in your privacy notice if you turn it on.

The message is built when it is sent, so it shows the ticket as it is then. A ticket deleted before its message goes is not sent.

## Message formats

- **Slack**: an incoming webhook post with a top-level `text` and Block Kit blocks (a section with the headline and linked ticket, a section of up to ten fields, the excerpt as a quote, and a context line). Texts are kept under Slack's limits, and `&`, `<` and `>` are escaped, so no subject can spell `<!channel>`.
- **Discord**: an Execute Webhook post with the headline as `content` and one embed with the linked ticket, the facts as fields, the excerpt and a colour per event. Strings are cut to Discord's limits. `allowed_mentions` is empty, so a subject that reads "@everyone" pings nobody.
- **Webhook**: JSON with a schema version, below.

## Webhook payload

Every request is a `POST` with `Content-Type: application/json`, `User-Agent: HelpdeskPro/1.0 (Grav)`, and these headers:

| Header | Value |
|---|---|
| `X-Helpdesk-Event` | The channel event, such as `client.replied` (`channel.test` for a test) |
| `X-Helpdesk-Delivery` | The delivery's id, such as `d42`, the same on every retry. Use it to ignore a repeat. |
| `X-Grav-Signature` | `t={unix time},v1={hex}`, when the channel has a signing secret |

The body (schema `helpdesk-pro.channel/1`):

```json
{
    "schema": "helpdesk-pro.channel/1",
    "id": "d42",
    "event": "client.replied",
    "event_label": "Client replied",
    "test": false,
    "occurred_at": "2026-09-24T09:15:00Z",
    "site": { "name": "Acme", "desk_url": "https://acme.test/admin/plugin/helpdesk-pro" },
    "title": "Ada Lovelace replied",
    "ticket": {
        "id": 1042,
        "subject": "Can't reset my password",
        "url": "https://acme.test/admin/plugin/helpdesk-pro#/t/1042",
        "project": { "id": 1, "slug": "support", "name": "Support" },
        "status": { "id": 4, "name": "Waiting on us", "category": "waiting_us" },
        "priority": { "value": 2, "label": "High" },
        "kind": "support",
        "requester": { "id": 10, "name": "Ada Lovelace" },
        "assignee": { "id": 1, "name": "Anna Agent" }
    },
    "details": {},
    "excerpt": null
}
```

- `ticket.assignee` is `null` when nobody is assigned; `ticket` is `null` for a test message.
- `details` holds the event's extra lines as label → text (`{"Due": "24 Sep 2026, 10:00 UTC"}`).
- `excerpt` is `null` unless the channel includes the first lines of a client's message.
- Within schema version 1, fields are only ever added.

### Check the signature

The hex is HMAC-SHA256 over the time, a full stop and the raw body, keyed with the secret. Compute it over `t + "." + body` exactly as received, compare in constant time, and refuse a time more than five minutes from your clock:

```php
$body = file_get_contents('php://input');
$header = $_SERVER['HTTP_X_GRAV_SIGNATURE'] ?? '';
if (preg_match('/^t=(\d+),v1=([0-9a-f]{64})$/', $header, $m) !== 1
    || abs(time() - (int)$m[1]) > 300
    || !hash_equals(hash_hmac('sha256', $m[1] . '.' . $body, getenv('HELPDESK_HOOK_SECRET')), $m[2])) {
    http_response_code(401);
    exit;
}
$event = json_decode($body, true);
```

## Delivery

Nothing is sent inside the request that caused the event. After the change is saved, one delivery per channel is queued as a `channel.deliver` job, which sends it right after the response or from the worker.

- **Timeout.** One request may take `channels.timeout_seconds` (5). Redirects are not followed.
- **Retries.** No answer, a timeout, a `408`, a `429` or a `5xx` is tried again after 1, 2 and 4 minutes, up to `channels.max_attempts` (4) tries. Any other `4xx` means the channel's settings are wrong (a revoked webhook answers `404` or `403`), so it is not retried.
- **Failing.** The first failed try marks the channel **Failing** with the answer it got, and it counts beside **Channels** in the side menu until a delivery goes through.
- **Paused.** After `channels.pause_after_failures` (5) deliveries in a row fail for good, the channel is **Paused** and nothing more is queued for it. **Resume**, or saving new settings, starts it again.
- **Switched off.** A disabled channel sends nothing. Set `channels.enabled` to `false` to switch every channel off at once; events that happen meanwhile are not sent later.
- **The delivery log.** Each channel's page lists its latest deliveries (event, ticket, state, tries, status, error), kept for `channels.log_days` (14). Rows hold ids, never message text.

**Send a test message** on a channel's page sends a message now and shows exactly what the endpoint answered (`200 ok`, `404 no_service`, `400 invalid_payload`). An email channel says what the mail transport answered for each address. The test carries no ticket, and it does not change the channel's status or log. In the editor it sends what is on screen, so you can try a pasted URL before saving.

## Secrets

A Slack or Discord webhook URL is a credential: anyone who has it can post to that channel. So is a signing secret. Both are:

- never returned by the API or the MCP tools: they come back as `••••••••` with only the URL's host beside them, and a save that sends the mask back keeps the stored value;
- never written to the log: every error is stripped of the channel's secrets before it is logged, stored or shown;
- stored in the Helpdesk Pro database, under `user/data/`.

To keep a secret out of the database altogether, type `env:NAME` instead of the value (for example `env:HELPDESK_SLACK_URL`) and set that environment variable for PHP. It is read each time a message is sent.

## Settings

On the **Channels** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `channels.enabled` | `true` | Send to channels at all. |
| `channels.timeout_seconds` | `5` | How long one request may take (1 to 30). |
| `channels.max_attempts` | `4` | Tries per message for a timeout, rate limit or server error. |
| `channels.pause_after_failures` | `5` | Deliveries in a row that fail for good before a channel is paused; `0` never pauses. |
| `channels.log_days` | `14` | How long the delivery log is kept. |

## API and MCP

Every route needs `helpdesk-pro.settings`, and secrets are masked in every response.

| Route | MCP tool | What it does |
|---|---|---|
| `GET /helpdesk-pro/channels` | `list_channels` | Every channel with its state, and in `meta` the types, events and defaults. |
| `POST /helpdesk-pro/channels` | `create_channel` | `{type, name, enabled, settings, project_ids, events, include_excerpt}`. `project_ids: null` covers every project. |
| `GET /helpdesk-pro/channels/{id}` | `get_channel` | One channel with its ten latest deliveries. |
| `PATCH /helpdesk-pro/channels/{id}` | `update_channel` | Any create field but `type`, plus `paused: false` to resume. |
| `DELETE /helpdesk-pro/channels/{id}` | `delete_channel` | The channel and its delivery log. |
| `POST /helpdesk-pro/channels/{id}/test` | `test_channel` | Sends a test message; answers `{ok, status, response, error, sent_to}`. The body may carry unsaved `settings` to try. |

A channel's `state` is `ok`, `failing`, `paused`, `off` (disabled), `idle` (nothing sent yet) or `broken` (its add-on type is no longer installed).

## Related

- [Notifications](../notifications)
- [Rules and automations](../rules-and-automations)
- [People and privacy](../people-and-privacy)
