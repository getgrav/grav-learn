---
title: Forum Pro
template: chapter
taxonomy:
    category: docs
description: A native, database-backed community forum for Grav 2.0. Members, topics, reactions, private messages, notifications, live updates, moderation, spam defense, search and a Discourse importer, all running inside your own Grav site.
---

**Forum Pro** is a complete, self-hosted discussion platform that runs inside your Grav site. It is not an iframe, not a hosted widget and not a subscription. Forum pages are ordinary Grav pages: they inherit your theme, live at any route you choose, are indexed by search engines, and every post is stored in a database you own.

> [!IMPORTANT]
> Premium products require the free [License Manager](https://getgrav.org/premium/license-manager) plugin. Install it and add your product license before installing Forum Pro.

## Requirements

| Requirement | Notes |
|---|---|
| **Grav** `>= 2.0.0-rc.8` | Forum Pro is not compatible with Grav 1.7 |
| **PHP** `>= 8.3` | Tested against 8.3 and 8.4 |
| **API plugin** `>= 1.0.0-rc.8` | Powers the Admin Next integration |
| **A database** | SQLite (zero-config default), MySQL 8+ / MariaDB 10.6+, or PostgreSQL 14+ |

Several optional plugins each unlock more:

| Plugin | Unlocks |
|---|---|
| `email` | Outbound notification and digest mail |
| `sync` + `sync-mercure` | Live updates, presence and typing indicators |
| `ai-pro` | The hourly AI spam review |
| `yetisearch-pro` | Fuzzy search with tuned relevance |
| `codesh` | Server-side syntax highlighting in fenced code blocks |
| `form` | The invisible proof-of-work captcha on register and login |

None of these are required. Forum Pro degrades cleanly when they are absent: without `sync` you get a plain server-rendered forum, without `codesh` code blocks render unhighlighted, and so on.

## What's in the box

- **Discussions** with sections, categories, topics, threaded replies, Markdown with @mentions and quotes, attachments, reactions, polls, tags, accepted answers, bookmarks and full revision history.
- **A member system** of its own, with registration, email verification, password reset, profiles, avatars, ranks, badges, groups, titles and a member directory. Grav accounts link in automatically.
- **Moderation** through scoped moderator roles, a review queue on the forum itself, a bulk queue in the admin, per-category premoderation, member reports, bans with appeals and content disposition, an audit log and a daily digest.
- **Spam defense** in three independent stages (heuristics, an optional self-hosted ML classifier, an optional hourly AI review) plus provisional-account restrictions and an invisible captcha.
- **Notifications** through an in-app bell with live toasts, watch levels per topic and per forum, and email that mirrors the bell with immediate, daily or weekly delivery.
- **Private messages** between members, one-to-one or in groups, with archiving, blocking, bulk cleanup and reporting.
- **Search** over published posts, permission-filtered, using either a built-in engine or YetiSearch Pro.
- **Live updates** through the `sync` plugin, with Mercure push or automatic polling fallback.
- **Article comments** that turn any Grav page into a commentable article backed by a real forum topic.
- **A Discourse importer** that brings members (with working passwords), content, history and files across in one command.

## Where to start

1. [Installation](../forum-pro/installation) gets the forum running, picks a database, and mounts it at the route you want.
2. [Configuration](../forum-pro/configuration) is the complete reference for every config block.
3. [Administration](../forum-pro/administration) walks through the Forum area in Admin Next.

If you are moving an existing community across, read [Migrating from Discourse](../forum-pro/discourse-import) before you do anything else. The importer is idempotent, but planning the cutover is easier before you start than after.
