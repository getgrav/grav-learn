---
title: Moderation
taxonomy:
    category: docs
description: Scoped moderator roles, the on-forum review queue, premoderation, member reports, bans with content disposition, undo, the audit log, legal holds and the daily digest.
---

# Moderation

Forum Pro is built so that **moderators do not need admin access**. Almost everything happens on the forum itself, which means you can hand moderation to community members without handing them the keys to your Grav install.

## Moderator roles

Grant a role in **Admin → Forum → Moderators**. A grant is either:

- **Global**, covering the whole forum, or
- **Scoped**, limited to specific sections and categories.

Scoped moderators see moderation actions only where their grant applies. It is the right shape for a large board where different people look after different subforums.

## The review queue on the forum

`{forum}/queue` is the moderator workspace. Four tabs, each with a live count:

| Tab | Holds |
|---|---|
| **Spam** | Content the spam pipeline scored above `spam.spam_threshold` |
| **Awaiting approval** | Content held by premoderation or scored above `spam.pending_threshold` |
| **Reported** | Posts flagged by members |
| **Deleted** | Recently removed posts and topics, within the retention window |

Each card shows the author, their post count, the age of the post, its **spam score**, and the content itself. Actions are one click:

- **Publish** releases the post
- **Delete** removes it (recoverably, see below)
- **Delete & ban author** does both at once, which is the fast path for an obvious spammer
- **View in topic** jumps to the post in context

A **step-through review mode** walks the whole queue in place, so clearing fifty items does not mean fifty page loads.

Staff also see held and spam posts highlighted **inline inside threads**, with an inline **Publish** button, so a false positive can be released without a trip to the queue.

## The bulk queue in the admin

**Admin → Forum → Queue** covers the same ground with pending, spam and flagged views, and adds **bulk actions on up to 100 items at a time** plus one-click bans. Use the admin queue when you are clearing a backlog, and the forum queue for day-to-day work.

## Premoderation

Set per category in **Structure → Edit**. A category can hold posts from:

- **New members only**, where "new" means below `moderation.new_member_post_threshold` published posts, or
- **Everyone**, which is what you want for a category that must never contain an unreviewed post.

## Member reports

Members flag posts they think break the rules. When a post accumulates `moderation.auto_hide_flag_threshold` open reports (3 by default), it **auto-hides pending review**, so the community can suppress something abusive before a moderator wakes up.

```yaml
moderation:
  auto_hide_flag_threshold: 3   # 0 disables auto-hide
```

Report volume is rate-limited per member by `spam.max_flags_per_hour`, which stops flagging being used as a harassment tool.

Reports keep a **content snapshot** so the original text is preserved even if the author edits it afterwards. Snapshots are purged on the schedule in `retention.purge_flag_snapshots_after_days`.

## In-topic moderation

Topic-level actions live in a wrench menu next to the topic title:

- **Pin** / **Unpin**
- **Lock** / **Unlock**
- **Hide** / **Unhide**
- **Move** to another category
- **Delete** / **Restore**

Post-level actions live in a compact icon row with a "more" menu: **hide**, **mark spam**, **restore**, **delete**, and **copy link**.

## Bans

A ban can be:

- **Global** or **scoped** to sections and categories
- **Temporary** (with an expiry) or **permanent**
- Accompanied by a **reason**, and open to an **appeal** from the banned member

### Content disposition

When you ban someone you choose what happens to what they wrote:

| Disposition | Effect |
|---|---|
| **Keep** | Content stays visible |
| **Hide all** | Everything is hidden, reversibly |
| **Anonymize** | Content stays, authorship is stripped |
| **Delete all** | Everything is soft-deleted |

Large dispositions are handed to the background job queue, so banning a spammer with 4,000 posts returns immediately instead of timing out.

Banned members are **recognized if they try to re-register** with the same identifiers.

### Lifting a ban

**Admin → Forum → Bans** lists every active ban with a one-click **Lift** that also brings back any content the ban had hidden. Staff can lift from the member's forum profile too. Toggle the admin view to include lifted and expired bans for a full history.

## Undo

Deletion is recoverable within your retention window.

- The **Deleted** tab in the forum queue lists everything recently removed, individually deleted posts and whole deleted topics alike, including spam threads taken down with **Delete & ban**. Each entry shows who removed it, when and why, with a one-click **Restore**.
- Deleted posts and topics also carry a **Restore** action inline for staff.

After `retention.purge_deleted_after_days` (30 by default), content is hard-deleted for good. This is a recovery window, not an archive.

## The audit log

Every staff action is recorded: publishes, deletions, restores, bans, lifts, role grants, rank and badge changes, and access to reported private messages. The log is what lets you answer "who removed this and why" three months later.

## Legal holds

A **legal hold** exempts a member, topic or post from all automated cleanup. Retention windows do not touch held content, and neither does the purge worker. Use it for anything under investigation or subject to a preservation request.

## The moderator digest

```yaml
moderation:
  mod_digest: true
  mod_digest_time: '00:00'
  mod_digest_timezone: America/Denver
```

A daily email to every moderator with queue counts and activity since the last digest, sent at a specific local time in a timezone you choose. It is **silent on quiet days**, so it never becomes noise your moderators learn to ignore.

## Maintenance and read-only mode

```yaml
maintenance:
  enabled: true
  include_staff: false
  message: "Back at 14:00 UTC after a database migration."
```

Members can browse but not post, react or sign up, and an optional banner explains why. With `include_staff: false` your staff keep full access, so they can keep working during the window. Set it to `true` for a full lock, for example while you run a large import.
