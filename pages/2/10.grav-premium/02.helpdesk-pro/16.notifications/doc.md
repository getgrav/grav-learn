---
title: Notifications
taxonomy:
    category: docs
description: The staff bell, who is notified of what, notification levels and email modes, when the email fallback goes out, and the daily digest.
---

# Notifications

Staff hear about tickets in the desk first: every notification lands in the bell. Email is the fallback for what nobody read in time, so someone who lives in the desk gets very little mail, and someone who is away gets one email per burst of activity instead of one per event.

Clients never get bell notifications. They get the few emails described in [Outbound email](../outbound-email#what-clients-receive). To post events to a shared place for the whole team, see [Notification channels](../notification-channels).

## Who is notified

Each event gives each staff member at most one notification, of the most specific kind that applies to them. Authors never hear about their own actions, and a muted ticket sends nothing at all.

| Event | Who | Kind | Urgency |
|---|---|---|---|
| A client replies | The assignee; watchers; when the ticket is unassigned, agents at level `everything` in the project | `client_replied` | Now for the assignee, batch for others |
| A staff member replies or adds a note | Watchers | `staff_replied` or `note_added` | Batch |
| Someone is @mentioned | The mentioned staff member, when they work the project | `mention` | Now |
| A ticket is assigned | The new assignee | `assigned` | Now |
| A ticket is created | Agents at level `everything` in the project; staff who may triage, when it waits in Triage; the assignee, when it is created assigned | `ticket_new`, `triage_needed`, `assigned` | Batch (`assigned`: now) |
| Status, fields or project change | Watchers | `status_changed` or `field_changed` | Batch |
| A ticket is merged or triaged | Watchers | `merged` or `triaged` | Batch |
| A client rates a request "Not good" | The credited staff member, when `csat.notify_not_good` is on | `rated` | Now |
| A rule's **Notify** action | The assignee, everyone who works the project, or one staff member, as the rule says | `rule` | Now |
| An SLA target is due soon or overdue | The assignee; when unassigned, everyone who works the project | `sla_warning` or `sla_breached` | Now for the assignee, batch for the project's staff |

The order of specificity is mention, then assigned, then `sla_breached`, `rated` and `rule`, then `client_replied`, then `sla_warning`, then `staff_replied` and `note_added`, then the field-change kinds.

Every recipient has to work the ticket's project (the same rule that lets them read internal notes), be active, and not have muted the ticket. An internal event can never reach anyone who could not read it in the desk.

## Watching

Staff watch a ticket because they took part in it: creating it on someone's behalf, being assigned, being mentioned, replying, or adding a note. Nobody watches a whole project. **Watch** on a ticket adds or removes you by hand, and **Mute** silences everything about it, bell and email alike.

## Levels

Each staff member picks a level. The site default is `notifications.default_level`.

| Level | In the bell | Emailed |
|---|---|---|
| `everything` | Everything in the table above, including every new ticket in projects they work | Everything in the bell |
| `aimed` (default) | The same, minus new tickets | Mentions, assignments, rule notifications, "Not good" ratings credited to them, SLA warnings and breaches, and client replies on tickets assigned to them. Other activity on watched tickets stays in the bell. |
| `nothing` | Mentions, assignments and rule notifications only | Nothing, except the digest when they turn it on |

## Email modes

| Mode | What happens |
|---|---|
| `fallback` (default) | A notification is emailed only if it was not read in the bell by the time it is due. |
| `digest` | No email per notification; one daily digest instead. |
| `off` | No email at all. The bell keeps working. |

Choosing the digest in the preferences also switches the daily digest on for someone in `fallback` mode. Per-kind switches (`types`, for example `{"field_changed": false}`) stop one kind from ever being emailed.

## When the email goes out

1. A notification of urgency `now` is due `notifications.grace_seconds` (60) after it was created. One of urgency `batch` is due `desk.batch_minutes` (10) minutes after.
2. A later event of the same kind on the same ticket lands on the notification already waiting (its count goes up, its due time stays), so a busy ticket gives one notification and one email. A bulk edit folds the same way across tickets.
3. One `notify.deliver` job per person runs at their earliest due time.
4. A notification read in the bell in the meantime is skipped. If the person was active in the desk in the last two minutes and `notifications.hold_while_active` is on, their notifications are held for five more minutes, but never longer than `notifications.hold_max_minutes` after they were created.
5. Everything still due becomes one email: `staff-notification` for one notification, `staff-batch` (grouped by ticket) for several.

Reading a notification in the bell, or opening its ticket in the desk, cancels its email. Opening a ticket through the API (`GET /helpdesk-pro/tickets/{id}?include=timeline`, or `GET /helpdesk-pro/tickets/{id}/timeline?mark_read=1`) does the same. Before anything is emailed, the person's access is checked again.

> [!IMPORTANT]
> Notification email is never due in the request that created it, so it needs the worker in cron. On a site without cron, the catch-up runs it after the next web request once it is due, so the email is late by however long the site stays quiet. See [Jobs and cron](../jobs-and-cron).

## The daily digest

The hourly `digest.sweep` job sends the `staff-digest` email to each staff member who wants the digest, once their local time (their timezone, else the server's) reaches `notifications.digest_hour`. It has how many requests wait in Triage, how many tickets assigned to them need a reply, and their unread notifications since the last digest. At most one digest a day, and nothing is sent when there is nothing to say.

The same sweep re-books `notify.deliver` for anyone whose due notifications have waited too long, in case a job was lost.

## Settings

On the **Email & Notifications** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `notifications.default_level` | `aimed` | The level of anyone who has not chosen one: `everything`, `aimed` or `nothing`. |
| `notifications.default_email` | `fallback` | The email mode of anyone who has not chosen one: `fallback`, `digest` or `off`. |
| `notifications.grace_seconds` | `60` | How long a `now` notification waits for an in-app read before it is emailed. |
| `desk.batch_minutes` | `10` | How long a `batch` notification waits, so several changes become one email. |
| `notifications.hold_while_active` | `true` | Hold email for people active in the desk. |
| `notifications.hold_max_minutes` | `60` | The longest a notification is held. |
| `notifications.digest_hour` | `7` | The local hour the daily digest goes out. |
| `notifications.keep_read_days` | `90` | Read notifications older than this are deleted by `maintenance.prune`. Unread ones are kept. |

Preferences are stored on the person record, so they follow the person, not the Grav account.

## API and MCP

| Route | Permission | What it does |
|---|---|---|
| `GET /helpdesk-pro/notifications` | desk | The caller's bell, newest activity first. `?unread=1` for unread only, `page`, `per_page` (up to 100). Each row has `type`, `sentence`, `ticket_id`, `message_id`, `link`, `actor`, `item_count`, `read`, `email_state` and times. `meta.unread` is the bell count. |
| `POST /helpdesk-pro/notifications/read` | desk | `{ids: [...]}` marks those rows read; `{ticket_id}` marks every row about that ticket read. `204`. |
| `POST /helpdesk-pro/notifications/read-all` | desk | Marks every row read. `204`. |
| `GET /helpdesk-pro/me/preferences` | desk | `{level, email, digest, types}`. |
| `PATCH /helpdesk-pro/me/preferences` | desk | Any of the four. `types` maps a kind to true or false and is merged into what is stored. |

MCP tools: `list_notifications`, `mark_notifications_read`, `mark_all_notifications_read`, `get_preferences` and `update_preferences`.

## Jobs

| Job | What it does |
|---|---|
| `notify.deliver` | The email fallback for one person. One per person; while notifications are still waiting it defers itself to the next due time. |
| `digest.sweep` | Hourly: daily digests and the safety net. |

## Related

- [Notification channels](../notification-channels)
- [Outbound email](../outbound-email#what-staff-receive)
- [Jobs and cron](../jobs-and-cron)
