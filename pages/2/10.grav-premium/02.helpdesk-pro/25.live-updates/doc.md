---
title: Live Updates
taxonomy:
    category: docs
description: Replies, notes and the bell without a reload through the Sync plugin, presence on a ticket, and what a client's live channel may carry.
---

# Live Updates

With live updates on, an open desk or portal tab shows what changed without a reload: a new reply or note appears in the ticket you have open (your unsent draft stays where it is), ticket lists refresh, the notification count and sidebar badge follow the bell, and a client looking at their request sees your reply arrive. The desk also shows who else has a ticket open and whether they are writing on it.

Live updates are optional. Without them, the desk refetches what is on screen when you come back to its tab, the composer's [collision guard](../the-desk#when-someone-replied-while-you-were-writing) still stops a reply that crossed someone else's, and presence still works.

## Turn on live updates

Install and enable the [Sync plugin](https://github.com/getgrav/grav-plugin-sync). There is nothing to set up in Helpdesk Pro. Sync offers three ways to deliver updates, and Helpdesk Pro uses whichever Sync ranks first:

| Transport | What it takes | How fast |
|---|---|---|
| Polling | Nothing beyond the Sync plugin. Always there. | Every 4 seconds while someone is using the tab (`realtime.poll_idle_ms`). |
| Mercure | The Sync Mercure plugin, **1.2.2 or later**, and a Mercure hub. | At once. |
| Ably | The Sync Ably plugin and an Ably account. Desk only; the portal polls. | At once. |

> [!IMPORTANT]
> Sync Mercure 1.2.2 publishes every update as private and keeps anonymous subscribers off the hub. An older Sync Mercure would publish Helpdesk Pro's updates publicly, so with one installed Helpdesk Pro never hands it anything: browsers poll instead, and the status report says so under `realtime.reason`.

Set `realtime.enabled` to `false` to turn live updates off without uninstalling Sync.

## In the desk

- An open ticket refetches its conversation and details when an update about it arrives. The composer keeps its draft, and a subject being renamed stays as typed.
- Other screens (My work, All tickets, Notifications) refresh once a burst of updates is over, never while they hold unsaved changes and never in a background tab.
- Every update refreshes the counts: the side menu numbers, the notification count and the Admin Next sidebar badge.
- The presence line above the composer names who else has the ticket open: "Ben is viewing", "Ben is replying…" (unsent text on the Reply tab), "Ben is writing a note…" (the Note tab), and "The client is viewing this request".

## In the portal

On "Your requests" and on one request, signed-in clients get updates too. An update about the open request swaps in its header and conversation; the reply box and anything typed in it are left alone, and screen readers hear "A new reply arrived." On the list page, the list is swapped in fresh, unless the person is typing in the search box.

The request page also sends a presence heartbeat, so staff see "The client is viewing this request". Clients never see staff presence.

## Presence

An open ticket sends a heartbeat every `realtime.presence_heartbeat_seconds` (15), and straight away when its composer starts or stops holding unsent text. A tab that stops sending is gone 45 seconds after its last heartbeat. Presence needs no Sync plugin: each heartbeat answers with the ticket's other viewers. A push transport only makes it quicker.

- Presence is for staff who work the ticket's project. A client is only ever "viewing", never sees anyone else, and never gets a presence update.
- Staff see a client only as "The client is viewing this request".
- One person with several tabs open shows once, with the strongest state (replying, then writing a note, then viewing).
- Presence is a warning, not a lock. The collision guard is what stops crossed replies.

## How it works

Every person has one private channel, their inbox. Only its own person may subscribe to it, and nobody may publish to it from a browser. Channel names carry an HMAC tag under a secret the site keeps, so they cannot be guessed.

When something happens on a ticket, Helpdesk Pro works out who may hear about it with the same access rules the rest of the plugin uses, keeps only the people who have a live tab open, and sends each a small frame on their inbox. A tab listens to one channel however many tickets and lists it shows, so polling costs one request every few seconds per open tab.

Frames carry ids, never content:

```json
{"e": "message.created", "t": 1042, "m": 9981, "at": 1790000000}
```

| Field | Meaning |
|---|---|
| `e` | The event, such as `ticket.updated`, `ticket.status_changed`, `message.created` or `attachment.added`, or `notification` and `presence` |
| `t` | The ticket id |
| `m` | The message id, for message and attachment events |
| `at` | When it happened (epoch seconds) |
| `a`, `v` | Staff frames only: who did it, and whether it was `public` or `internal` |

The browser then reads what changed through the normal, permission-checked routes, so a frame that went astray carries nothing worth reading.

### What a client's channel may carry

A client's inbox carries frames for **public** events only: a reply, a public status milestone (solved, reopened, closed), a public attachment, a new request they are on. An internal event produces no frame for a client at all: not a note, not an edit or deletion of a note, not a file on a note, not an assignee or priority change. A client frame has exactly `e`, `t`, `at` and, for a reply, `m`.

### Who gets frames

Only people with a live tab: a desk or portal tab that fetched its live config or pulled its inbox in the last ten minutes. Idle accounts cost nothing, so a public project with thousands of clients does not mean thousands of writes per reply. The browser refetches its config every five minutes, which also renews its hub token.

With polling, a tab asks every 4 seconds while someone is using it, every 1.5 seconds for half a minute after they send something, gradually less often (down to every 15 seconds) once nobody has touched the page for two minutes, and every 30 seconds in the background. A push connection that drops falls back to polling until it can reconnect.

## Check it

The status report (`bin/plugin helpdesk-pro status`, **Operations → System**, or `GET /helpdesk-pro/status`) has a `realtime` block: `enabled`, the `transport` in use, the `reason` when there is none (Sync missing or disabled, `realtime.enabled` off, a Sync Mercure too old to use), how many people have a live tab open (`live_listeners`) and how many tabs have a ticket open right now (`presence_rows`).

With polling, you can watch your own inbox with curl and a desk token:

```bash
TOKEN=...   # from POST /api/v1/auth/token
curl -s https://example.test/api/v1/helpdesk-pro/live-config -H "X-API-Token: $TOKEN"
curl -s "https://example.test/api/v1/sync/channels/pull?id=<channel>&since=<serverTimeMs>" -H "X-API-Token: $TOKEN"
```

## Settings

On the **Live Updates** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `realtime.enabled` | `true` | Send live updates over the Sync plugin when it is installed and enabled. Presence works either way. |
| `realtime.poll_idle_ms` | `4000` | With polling, how often an open tab asks for news while someone is using it (at least 1000). |
| `realtime.presence_heartbeat_seconds` | `15` | How often an open ticket sends its presence heartbeat (5 to 40). |

## Routes

Neither desk route has an MCP tool: both only make sense to an open browser tab.

| Route | Permission | What it does |
|---|---|---|
| `GET /helpdesk-pro/live-config` | desk | The live config for your inbox: `enabled`, `channel`, `transport` (`polling`, `mercure` or `ably`), `pullUrl`, `pullPath`, `mercure`, `ably`, `serverTimeMs`, `pollIdleMs`, `heartbeatSeconds`, `refreshSeconds`, and `presencePath`. When live updates are off: `{enabled: false, reason, …}`. |
| `POST /helpdesk-pro/tickets/{id}/presence` | desk | `{client_id, state}`: the tab's own random id and `viewing`, `replying`, `noting` or `leave`. Answers `{peers: [{person, kind, state, age}]}`. |
| `GET {mount}/_live/config` | Signed-in client | The same live config for the visitor's inbox, never with Ably, plus `presenceUrl` and the form `nonce`. |
| `POST {mount}/_live/presence` | Signed-in client | The request page's heartbeat: `ticket_id`, `client_id`, `state` and the `helpdesk-portal` nonce. A client is always recorded as viewing, and the answer is always `{peers: []}`. |

The portal polls Sync's pull endpoint (`GET /api/v1/sync/channels/pull`) directly with the site's session cookie; the channel's access check lets a signed-in client pull only their own inbox.

## Related

- [The staff desk](../the-desk)
- [Troubleshooting](../troubleshooting#live-updates-do-not-arrive)
- [Extending](../extending#live-updates-in-your-own-screens)
