---
title: Helpdesk Pro
template: chapter
taxonomy:
    category: docs
description: A helpdesk and request tracker for Grav 2.0, with a staff desk in Admin Next, a client portal, and a knowledge base built from Grav pages.
---

**Helpdesk Pro** is a helpdesk and request tracker that runs inside your Grav site. Staff work tickets in a desk inside Admin Next, clients follow their requests in a portal on your site (usually at `/help`), and your help articles are ordinary Grav pages that the portal searches before anyone writes in. Everything is stored in one SQLite file that you control.

> [!IMPORTANT]
> Premium products require the free [License Manager](https://getgrav.org/premium/license-manager) plugin. Install it and add your product license before installing Helpdesk Pro.

## Requirements

| Requirement | Notes |
|---|---|
| **Grav** `>= 2.0.0` | Helpdesk Pro is not compatible with Grav 1.7 |
| **PHP** `>= 8.3` | With the `pdo_sqlite`, `sqlite3`, `mbstring` and `dom` extensions |
| **API plugin** `>= 1.0.0` | Powers the desk in Admin Next and the REST API |
| **Login plugin** `>= 3.9.0` | Client and staff accounts |
| **Email plugin** `>= 5.2.0` | All outgoing mail. Receiving email needs 5.3.0 or later |
| **Form plugin** `>= 9.0.0` | The request form's captcha |
| **Admin Next** | Where staff work. Staff need `api.access` |

The database is SQLite only, and it is bundled: there is no database server to set up and no MySQL or PostgreSQL option.

Optional plugins add more:

| Plugin | Adds |
|---|---|
| `sync` | Live updates in the desk and the portal, without a reload |
| `sync-mercure` (1.2.2 or later) or `sync-ably` | Instant push delivery for live updates instead of polling |
| `yetisearch-pro` | Shared semantic search settings, when you use semantic search in both |

Helpdesk Pro works without any of them. Without `sync`, screens refresh when you come back to them instead of updating live.

## What's in the box

- **A staff desk** in Admin Next: My work, All tickets with filter chips, boards, triage, replies and internal notes, saved replies and macros, saved views, bulk edit and keyboard shortcuts.
- **A client portal** where clients sign in with an emailed link (no password needed), follow their requests, reply, mark a request solved and reopen it. Guests can send requests too, behind a captcha, rate limits and a spam score.
- **A knowledge base** made of Grav pages, with search, topic cards, "Was this helpful?", and suggestions while people type their request.
- **Email in and out**: branded client email that threads properly, replies by email from clients and staff, new tickets by email through a provider webhook or an IMAP mailbox.
- **Notifications** in a bell, with email as the fallback for what nobody read, a daily digest, and team channels for Slack, Discord, a signed webhook or a team inbox.
- **Automation**: when/if/then rules, a built-in auto-close, and SLA targets with business hours, warnings and breaches.
- **Customer ratings**, **custom fields**, **organizations** that share requests between colleagues, and **reports** with CSV export.
- **Privacy tools**: a subject access summary per person, merging, legal holds and two erasure modes.
- **A REST API and MCP tools**, so scripts and AI clients can do what the desk does, and **events** for add-ons.

## Where to start

1. [Installation](../helpdesk-pro/installation) gets the plugin running, protects the database and sets up cron.
2. [Getting started](../helpdesk-pro/getting-started) walks through the help center page, your first project and your first ticket, and explains the words Helpdesk Pro uses.
3. [The staff desk](../helpdesk-pro/the-desk) is the tour of where staff spend their day.

When you are ready to take email, read [Outbound email](../helpdesk-pro/outbound-email) and then [Inbound email](../helpdesk-pro/inbound-email). If something is not happening (no email, no digests, rules not firing), start with [Troubleshooting](../helpdesk-pro/troubleshooting) and [Jobs and cron](../helpdesk-pro/jobs-and-cron).
