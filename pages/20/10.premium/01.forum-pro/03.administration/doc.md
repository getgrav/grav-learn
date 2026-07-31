---
title: Administration
taxonomy:
    category: docs
description: A tour of the Forum area in Admin Next, the Forum Activity report, the dashboard widget, and the permissions that gate them.
---

# Administration

Forum Pro adds a **Forum** entry to the Admin Next sidebar. It carries a badge showing how many items are waiting in the moderation queue, so you can see at a glance whether anything needs attention.

The Forum page is split into nine tabs, plus a gear icon that jumps to the plugin settings.

## Dashboard

The default tab. A **metrics ledger** accrues from the day Forum Pro is deployed and drives:

- **Signups**, **Topics**, **Posts**, **Likes** and **New contributors** as sparkline tiles with a period-over-period delta
- **Daily active users**, **Daily engaged users** and the **DAU / MAU** ratio
- An **Activity** table breaking each metric down by today, yesterday, last 7 and last 30 days
- **Users per type** (admins, moderators, members)
- **Most viewed topics** and **Top posters**
- **Queue health**

Switch the window between **7d**, **30d** and **90d** at the top right.

> [!NOTE]
> The ledger accrues forward from deployment. It does not backfill history from imported content, so a freshly imported forum starts with a flat chart even though it has years of posts. Totals such as member and post counts are computed live and are correct immediately.

## Structure

Where you build the forum. Sections group categories, and categories hold topics.

- **Add section** creates a top-level grouping. Sections carry a title, description and icon.
- **+ category** adds a category to a section, **+ sub** adds a child category.
- Arrows reorder items within their parent.
- **Edit** opens title, slug, description, icon, ordering and **permissions**.

Each row shows the category's slug alongside its live topic and post counts, which makes it easy to spot categories nobody is using.

### Category permissions

Per-category permissions control who can **see**, **read** and **post**. A category can be public, members-only, or restricted to staff. Restrictions apply everywhere consistently: listings, search results, live-update channels and the read-only API all respect them, so a private category never leaks through a side door.

Per-category **premoderation** is also set here: hold posts from new members only, or from everyone.

## Queue

The bulk moderation queue, with **pending**, **spam** and **flagged** views. Select up to 100 items at a time and approve, reject, delete or ban in one action.

Moderators who do not have admin access get the same job done from the forum itself at `{forum}/queue`. See [Moderation](../moderation).

## Members

Search across usernames, emails and display names, and filter by group, by badge, or to moderators only. Each row shows account state, rank, post and topic counts, reputation, badge count, join date and last-active date.

**Edit** opens a member for changes to their display name, title, rank (including granting a **custom rank** with its own icon), group memberships, badges, password and suspension state. Account deletion is available here too, with the same content disposition options as a ban.

Native forum accounts and linked Grav accounts appear side by side, tagged `native` or `grav` so you can tell them apart.

## Groups

Create and manage **member groups** such as Core Team or Moderators. Each group gets a name, a color and an icon, and appears as a badge bar under member names in posts, topic lists and profiles. Manage membership from here.

Groups are presentational and organizational. Moderation powers come from the **Moderators** tab, not from group membership.

## Tags

Rename, merge and delete tags. Merging is the tool you want after an import, when the same concept arrived under three spellings. Who is allowed to create new tags is set by `tags.allow_create` in the plugin settings.

## Moderators

Grant and revoke moderator roles. A grant is either **global** or **scoped** to specific sections and categories, which lets you hand a subforum to the people who care about it without giving them the run of the whole board.

## Bans

Every active ban, showing who is banned, from where, why, by whom and until when, with a one-click **Lift** that also restores any content the ban had hidden. Toggle the view to include lifted and expired bans for the full history.

Staff can also lift a ban directly from the member's profile on the forum.

## Status

A health panel covering:

- **Database**: engine, connection state, schema steps applied, and whether migrations are pending
- **Database file protection**: whether your SQLite file is reachable over the web
- **Background jobs**: pending, failed and completed counts
- **Scheduler**: whether Grav's scheduler has been seen recently, with the exact crontab line for your install
- **Real-time**: whether live updates are enabled, whether `sync` is loaded, and which transport is in use

This is the first place to look when email is not arriving or badges are not being awarded. Nine times out of ten the scheduler is not installed.

## The Forum Activity report

**Tools → Reports → Forum Activity** presents the same metrics as the Dashboard tab in report form, which is handy for sharing a snapshot without giving someone access to the forum admin.

## The dashboard widget

With `admin2.dashboard: true` (the default), a **Forum Activity** widget appears on the site-wide admin dashboard, so the numbers are visible without navigating into the Forum area. Turn it off in **System** if you would rather keep the dashboard lean.

## Permissions

Forum Pro registers two permissions under `admin.forum-pro`:

| Permission | Grants |
|---|---|
| `admin.forum-pro.admin` | Full access to the Forum area, including Structure, Members, Groups, Tags, Moderators, Bans, Status and settings |
| `admin.forum-pro.moderate` | The moderation surfaces only: the queue and per-post actions |

Assign them on a Grav account or group the same way as any other Grav permission. A user with only `moderate` sees the Queue but not Structure or Members, which is usually the right shape for a volunteer moderator who also needs admin access for something else.

Most moderators do not need an admin account at all. Grant them a moderator role in the **Moderators** tab and they work entirely from the forum.
