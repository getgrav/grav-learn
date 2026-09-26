---
title: Mailroom
template: chapter
taxonomy:
    category: docs
description: A newsletter for any Grav 2 site, with subscribers and a real consent record, lists, double opt-in, campaigns, segments, automations and open and click numbers of your own.
---

**Mailroom** is a newsletter that runs inside your Grav site. People sign up through a box on your pages, confirm by email, and land on the lists they chose. You write campaigns in Admin Next, send them through the Grav Email plugin, and read how they did on screens that count opens and clicks in your own database. Everything is stored in a database you control: SQLite by default, or MySQL or PostgreSQL.

The numbers are yours. An open or a click is a timestamp against a send row, with no IP address, browser or location stored, and the history stays when you change the company that carries your mail.

> [!IMPORTANT]
> Premium products require the free [License Manager](https://getgrav.org/premium/license-manager) plugin. Install it and add your product license before installing Mailroom.

## Requirements

| Requirement | Notes |
|---|---|
| **Grav** `>= 2.1.0` | Mailroom is not compatible with Grav 1.7 |
| **PHP** `>= 8.3` | With PDO and the driver for your database: `pdo_sqlite`, `pdo_mysql` or `pdo_pgsql` |
| **API plugin** `>= 1.0.31` | Powers the admin screens and the REST API |
| **Email plugin** `>= 5.1.0` | All outgoing mail. It must be configured and sending |
| **Admin Next** | Where you work. Admins need `api.access` |
| **A database** | SQLite (created for you, the default), MySQL or MariaDB, or PostgreSQL |

Optional plugins add more:

| Plugin | Adds |
|---|---|
| `form` | The Form plugin's `mailroom` action, for a signup form you define yourself |
| A transport plugin such as `email-smtp2go`, `email-amazon`, `email-sendgrid`, `email-postmark`, `email-mailgun`, `email-mailersend` or `email-resend` | Delivery, bounce and complaint reports through the provider's webhook, and a deliverability check that knows your provider |

Mailroom works without either. Without a provider webhook, campaigns still send; the delivered, bounced and complained figures stay empty.

## What's in the box

- **Subscribers with a consent record**: the sentence each person agreed to, when, and from which address, plus a consent history of every change to their lists.
- **Lists people can leave one at a time**, each with its own double opt-in, a preference centre, and one-click unsubscribe from the mail client.
- **A signup box anywhere**: `{{ mailroom_form() }}` in a theme or page, the Form plugin's `mailroom` action, or a JSON endpoint another server can post to.
- **Campaigns** in Markdown, to one list, several lists or every list with a segment, with subject tests, test sends, scheduling, sending to people who joined late, and a retry for failed sends.
- **Segments** built from conditions, **tags**, **templates**, and **automations** that start on a signup, a confirmation or a tag.
- **CSV import and export**, with column mapping, a dry run, and the rules that keep people who left from coming back.
- **Deliverability checks** for SPF, DKIM, DMARC, your From address, the unsubscribe headers, the sending rate, the bounce webhook and your bounce and complaint rates.
- **Seven reports**, from campaign performance to the hour your readers read.
- **Privacy tools**: one person's data as a JSON file, and erasure by address that keeps only a suppression hash.
- **A REST API and MCP tools** for everything the admin does.

## Where to start

1. [Installation](../mailroom/installation) gets the plugin running and the database ready.
2. [Getting started](../mailroom/getting-started) walks through the site URL, the From address, a signup box, the scheduler and your first campaign.
3. [Lists and signup forms](../mailroom/lists-and-signup-forms) covers every way people join.

Before your first real campaign, read [Sending and providers](../mailroom/sending-and-providers) and [Deliverability](../mailroom/deliverability). If mail is not going out, start with [Troubleshooting](../mailroom/troubleshooting) and [Jobs and cron](../mailroom/jobs-and-cron).
