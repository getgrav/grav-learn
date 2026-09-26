---
title: Installation
taxonomy:
    category: docs
description: Install Mailroom, choose and protect its database, set up cron, and give your admins the permissions they need.
---

# Installation

This page gets Mailroom installed and running: the plugin, its database, the worker and the permissions.

## Before you begin

- Grav 2.1.0 or later with Admin Next, the API plugin (1.0.31 or later) and the Email plugin (5.1.0 or later).
- The Email plugin configured and sending. Check it with `bin/plugin email test-email --to=you@example.com`.
- PHP 8.3 or newer with PDO and the driver for your database (`pdo_sqlite` for the default).
- Your Mailroom license added to the [License Manager](https://getgrav.org/premium/license-manager).

## Install the plugin

Install through GPM like any other plugin:

```bash
bin/gpm install mailroom
```

You can also install it from **Plugins** in Admin Next. Once enabled, Mailroom adds a **Mailroom** item to the Admin Next sidebar for anybody with `mailroom.view` (and for super users), and its own commands under `bin/plugin mailroom`.

To enable it by hand, set `enabled: true` in `user/config/plugins/mailroom.yaml`.

## The database

Mailroom keeps its subscribers, campaigns and job queue in a database of its own. Every table it creates starts with `mailroom_`.

### SQLite (the default)

There is nothing to set up. The first time anything reads the database, Mailroom creates it at `user-data://mailroom/mailroom.sqlite` (that is, `user/data/mailroom/mailroom.sqlite`) and applies its migrations. The folder gets a deny-all `.htaccess`.

> [!WARNING]
> The `.htaccess` file protects the database on Apache only. Stock Grav server rules do not stop a `.sqlite` file under `user/` from being downloaded, and nginx and Caddy ignore `.htaccess`. On those servers, deny the directory yourself. For nginx:
>
> ```nginx
> location ^~ /user/data/ { deny all; }
> ```

To keep the file somewhere else, set **SQLite File** (`database.sqlite.path`) on the **Advanced** tab of Mailroom's settings to a stream path (`user-data://...`) or an absolute path.

### MySQL, MariaDB or PostgreSQL

1. Create an empty database and a user that can create tables in it.
2. On the **Advanced** tab of Mailroom's settings, set **Database** (`database.type`) to **MySQL or MariaDB** or **PostgreSQL**, and fill in the host, port, database name, username and password under the section for that server. MySQL can use a Unix socket instead of the host and port; PostgreSQL has an **SSL Mode**.
3. Save, then run:

```bash
bin/plugin mailroom migrate
```

> [!NOTE]
> Changing **Database** points Mailroom at a different, empty database. Nothing is copied across.

### When table changes are applied

**Update the Tables** (`database.auto_migrate`) decides when a new version's schema changes are applied:

| Value | Label | What happens |
|---|---|---|
| `sqlite` (default) | By itself on SQLite, from the command line otherwise | SQLite applies pending migrations on first use after an update. A server database waits for `bin/plugin mailroom migrate`. |
| `auto` | By itself, on every database | Every database applies pending migrations on first use. |
| `manual` | Only from the command line | Nothing applies until you run `bin/plugin mailroom migrate`. |

```bash
bin/plugin mailroom migrate --status   # list what is waiting
bin/plugin mailroom migrate            # apply it
```

The worker, and every command that reads the database, refuses to run while migrations are waiting and says to run `migrate` first. The public pages (signup, confirm, unsubscribe, preferences, the web view and provider webhooks) answer `503` with `Retry-After: 300` in the meantime, a page saying to try again in a few minutes, rather than an error; the open pixel still answers its image. A mail provider retries a webhook that got a `503`, so nothing it reports is lost.

## Set up cron

Everything Mailroom sends is a job on its queue: campaigns, confirmation emails, automation steps, imports and segment recounts. The jobs a web request queued (a confirmation email after a signup) run straight after its response, but campaigns, automations, retries and everything scheduled need the worker, which Grav's scheduler runs every minute. Add the scheduler to your crontab with a `PATH` line:

```
PATH=/usr/local/bin:/usr/bin:/bin
* * * * * cd /path/to/site && php bin/grav scheduler >> /dev/null 2>&1
```

Put the directory that holds your PHP binary on the `PATH` line. `bin/plugin mailroom status` prints the exact scheduler line for your site.

[Jobs and cron](../jobs-and-cron) explains the queue, the drain after a request and the `PATH` line.

## Give your team access

Admins need `api.access` to reach Admin Next, plus Mailroom's own permissions:

| Permission | Label | Covers |
|---|---|---|
| `mailroom.view` | View Mailroom | Reading subscribers, campaigns, reports and settings |
| `mailroom.manage` | Manage Mailroom | Writing: campaigns, lists, templates, imports, suppressions, settings, unsubscribing somebody by hand, erasure |
| `mailroom.send` | Send Mailroom Campaigns | Starting, resuming and test-sending a campaign, and sending to newcomers or retrying failed sends |

Sending is separate because a campaign cannot be taken back once it has gone out. `mailroom.send` is checked as well as `mailroom.manage`, never instead of it, so a sender needs both. Super users (`api.super`) have everything.

A useful split, set up under **Accounts** in Admin Next:

| Group | Permissions |
|---|---|
| `newsletter-writers` | `api.access`, `mailroom.view`, `mailroom.manage` |
| `newsletter-senders` | `api.access`, `mailroom.view`, `mailroom.manage`, `mailroom.send` |

Somebody without `mailroom.manage` sees every screen read-only, with a line saying "Changing anything here needs the Manage Mailroom permission."

## First checks

1. Open Admin Next as an admin. The **Mailroom** item appears in the sidebar and opens Mailroom's page at `/admin/plugin/mailroom`.
2. Run `bin/plugin mailroom status`. It shows the database, the schema, the route base, whether the Email plugin can send, the From address, the site URL, the queue and when the worker last ran, and says what to fix.
3. Run `bin/plugin mailroom work`. It runs one worker pass and says what it did.

To look around with data in it, `bin/plugin mailroom seed` fills an empty Mailroom with three months of a small project's newsletter. Nothing is sent, and `seed --purge` removes exactly what it added. See [CLI](../cli#seed).

## Related

- [Getting started](../getting-started)
- [Jobs and cron](../jobs-and-cron)
- [Configuration](../configuration)
- [Troubleshooting](../troubleshooting)
