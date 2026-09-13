---
title: Notifications and Email
taxonomy:
    category: docs
description: The notification bell, live toasts, watch levels, email preferences and digests, the delivery queue, and private messages.
---

# Notifications and Email

Forum Pro's notification system has one job: tell members what they care about without flooding them.

## The bell

Signed-in members get a **notification bell** in the [member toolbar](../members-and-accounts#the-member-toolbar) with a live unread count. It covers:

- Replies to topics they are watching
- **Quotes** of their posts
- **@mentions**
- Activity in watched forums
- **Moderation decisions** on their content
- **Badges** they have been awarded
- Their answer being **accepted as the solution**

`{forum}/notifications` lists everything with a one-click jump to the post and a **mark all read** action.

## Live toasts

With [live updates](../realtime) enabled, a small card slides in the moment a reply, mention or private message arrives. It names the sender, previews the message for PMs, and links straight to the post or conversation.

## Burst coalescing

Twelve replies in a watched topic produce **one** bell entry, not twelve. This is the difference between a notification system people keep on and one they turn off in week two.

## Watch levels

Members set a watch level **per topic** and **per whole forum** from a picker that explains each level:

| Level | Behaviour |
|---|---|
| **Watching** | Notified about every new reply |
| **Normal** | Notified about replies to your posts, quotes and mentions |
| **Muted** | Never notified, and the topic or forum is suppressed in listings |

Members **auto-watch** topics they start or reply to. That default is adjustable in their settings, so someone who answers a lot of questions is not signed up for every thread they touch.

## Email

Email mirrors the bell, per member preference, and is configured by each member in `{forum}/settings`:

| Preference | Behaviour |
|---|---|
| **Immediate** | Sent as it happens, throttled to one email per topic per window |
| **Daily** | A digest once a day |
| **Weekly** | A digest once a week |
| **Never** | Bell only |

Per-type toggles let a member take mentions immediately and everything else in a digest.

```yaml
email:
  throttle_minutes: 15   # at most one notification email per member per topic per window
```

Every email carries a **signed one-click unsubscribe** link, so a member can stop a specific stream without logging in.

> [!NOTE]
> Outbound mail requires the **Email** plugin and a working transport. Without it the bell still works, but nothing is delivered.

## Delivery

Notification mail is **queued** and drained by the [background worker](../installation#the-background-worker), with retry and backoff on failure. Two properties matter:

- Messages are **individually addressed**. Forum Pro never puts your members on a BCC blast, so one bounce never exposes the list.
- Sent payloads are **purged on a schedule** (`retention.purge_sent_emails_after_days`, 7 days by default), so your database does not accumulate a copy of every notification ever sent.

Check delivery health in **Admin → Forum → Status**, which reports pending, failed and completed job counts.

## Private messages

`{forum}/messages` is a full member-to-member messaging system.

```yaml
messages:
  enabled: true
  max_participants: 5           # people per conversation, including the starter
  max_threads_per_hour: 10      # 0 disables
  max_messages_per_minute: 10   # 0 disables
```

- Conversations are **one-to-one or group**, up to `max_participants`.
- An **envelope** in the toolbar carries a live unread count, and new replies appear in an open conversation without a refresh.
- **Archiving** splits the inbox into active and archived views.
- **Bulk archive and delete** with select-all-on-page and a select-all-N option, which is how you clear thousands of migrated messages while sparing a handful. Select everything, untick the few you want to keep, then delete the rest.
- **Blocking** stops new conversations and direct replies in both directions.
- Messages are **reportable to moderators**, who see only the reported message, and that access is written to the [audit log](../moderation#the-audit-log).

Attachments in private messages use the same upload stack as posts, so the same size and type limits apply.

> [!NOTE]
> Attachment URLs are unauthenticated capability URLs: knowing the content-addressed URL is enough to fetch the file. This is a deliberate tradeoff that makes deduplication and CDN delivery possible. Treat a PM attachment as shareable-if-leaked, not as a secret store.

## Provisional members and messages

With `provisional.block_messages: true` (the default), brand-new accounts cannot start private conversations. This closes the most common spam vector on a forum with public member profiles. See [Spam protection](../spam-protection#provisional-members).
