---
title: Live Updates
taxonomy:
    category: docs
description: Live replies, presence and typing indicators, permission-aware channels, Mercure push versus polling, and in-page navigation.
---

# Live Updates

With the **Sync** plugin installed, the forum updates without page reloads. Without it, everything degrades to a plain server-rendered forum with no live markup at all, which is a perfectly good experience and the one search engines see.

```yaml
realtime:
  enabled: true                # inert without the sync plugin
  new_replies_threshold: 5     # above this many unseen replies, show a load button
  presence:
    enabled: true
    heartbeat_seconds: 15
```

## What updates live

- **New replies appear in place** inside a topic
- **Reaction counts** tick as people react
- **Category listings** raise a refresh bar when new topics arrive
- The **notification bell** and **message envelope** counts update
- **Toast notifications** slide in for replies, mentions and private messages

`new_replies_threshold` is a courtesy: below it, replies are inserted directly; above it, a **load button** appears instead, so a thread that is moving fast does not yank the page out from under a reader mid-sentence.

## Presence and typing indicators

```yaml
realtime:
  presence:
    enabled: true
    heartbeat_seconds: 15
```

Topic pages show **who is viewing** and **who is typing**. Clients send a heartbeat every `heartbeat_seconds`; raise it to reduce chatter on a large forum, lower it for a snappier feel on a small one.

## Permission-aware channels

Live channels respect category permissions. A private category **never broadcasts to outsiders**: a user without read access is not subscribed to its channel and does not receive its events. Permissions are enforced server-side at subscribe time, not by filtering on the client.

## Transports

Forum Pro picks the best transport available, in this order:

### 1. Mercure push

With the **Sync Mercure** plugin, updates arrive over **server-sent events** from a Mercure hub. This is the low-latency option and the one to use on a busy forum. Sync Mercure bundles the hub binary:

```bash
bin/plugin sync-mercure install
bin/plugin sync-mercure start
```

### 2. Polling

Without a push hub, clients fall back to **polling** automatically. No configuration is needed, and no functionality is lost. Latency is a few seconds instead of instant.

### 3. No live updates

Without the `sync` plugin, `realtime` is inert. Pages render server-side and stay as rendered until the reader reloads.

**Admin → Forum → Status** reports which transport is actually in use, which is the fastest way to confirm your Mercure hub is reachable.

## In-page navigation

```yaml
frontend:
  htmx: true
```

Moving between forum pages swaps the content region instead of doing a full page load. The implementation handles the parts that usually break in a partial-navigation setup:

- The **back and forward buttons** work
- **Page titles** update to match the new view
- **Focus** moves to the new content, so screen readers announce where you landed
- **Live updates and the bell reconnect** cleanly after every navigation

If your theme already ships htmx, Forum Pro **stands down automatically** rather than loading a second copy and fighting over the same attributes.

Set `htmx: false` for classic full page loads. Everything still works; navigation is just less smooth.

## Troubleshooting

| Symptom | Check |
|---|---|
| Nothing updates live | Is `sync` installed and enabled? Status tab reports it. |
| Transport says `polling` but you installed Mercure | Is the hub running and reachable? `bin/plugin sync-mercure start`. |
| Updates work, presence does not | `realtime.presence.enabled` |
| Live updates stop after navigating | Usually a theme shipping its own htmx in a way Forum Pro cannot detect. Set `frontend.htmx: false` and confirm. |
