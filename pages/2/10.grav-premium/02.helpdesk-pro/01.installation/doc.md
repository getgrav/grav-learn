---
title: Installation
taxonomy:
    category: docs
description: Install Helpdesk Pro, protect its database, set up cron and give staff the permissions they need.
---

# Installation

This page gets Helpdesk Pro installed and running: the plugin, its database, the background worker and the staff permissions.

## Before you begin

- Grav 2.0 with Admin Next and the API, Login, Email and Form plugins.
- PHP 8.3 or newer with `pdo_sqlite`, `sqlite3`, `mbstring` and `dom`.
- Your Helpdesk Pro license added to the [License Manager](https://getgrav.org/premium/license-manager).

## Install the plugin

Install through GPM like any other plugin:

```bash
bin/gpm install helpdesk-pro
```

You can also install it from **Plugins** in Admin Next. Once enabled, Helpdesk Pro adds a **Helpdesk** item to the Admin Next sidebar for staff, and its own commands under `bin/plugin helpdesk-pro`.

To enable it by hand, set `enabled: true` in `user/config/plugins/helpdesk-pro.yaml`.

## The database

Helpdesk Pro stores everything in one SQLite file. There is nothing to set up on a database server.

The first time Helpdesk Pro needs its database, it creates it at `user/data/helpdesk-pro/db/helpdesk.sqlite` and applies its migrations. That happens when someone opens the desk, a portal page, a worker run, or `bin/plugin helpdesk-pro migrate`. Ordinary page views never touch it.

The directory gets a deny-all `.htaccess` and an empty `index.html`. Search, attachments and the database all live under `user/data/helpdesk-pro/`.

> [!WARNING]
> The `.htaccess` file protects the database on Apache only. Stock Grav server rules do not stop a `.sqlite` file under `user/` from being downloaded, and nginx and Caddy ignore `.htaccess`. On those servers, deny the directory yourself. For nginx:
>
> ```nginx
> location ^~ /user/data/ { deny all; }
> ```

To keep the file somewhere else, set `database.sqlite.path` to a stream path (`user-data://…`) or an absolute path.

### Migration policy

`database.auto_migrate` decides when schema changes are applied after an update:

| Value | What happens |
|---|---|
| `sqlite` (default) or `auto` | Pending migrations apply on the first request after an update. The two values behave the same, since Helpdesk Pro is SQLite only. |
| `manual` | Nothing applies until you run `bin/plugin helpdesk-pro migrate`. |

```bash
bin/plugin helpdesk-pro migrate --status   # list what is pending
bin/plugin helpdesk-pro migrate            # apply it
```

The worker refuses to run while migrations are pending.

## Set up cron

Background work (email, notification delivery, digests, inbound mail, search indexing, SLA scans, time-based rules) runs as jobs in a queue. Most jobs run right after the request that queued them, but only the Grav scheduler guarantees the queue drains. Add it to your crontab with a `PATH` line:

```
PATH=/usr/local/bin:/usr/bin:/bin
* * * * * cd /path/to/site && php bin/grav scheduler >> /dev/null 2>&1
```

Put the directory that holds your PHP binary on the `PATH` line.

> [!IMPORTANT]
> The `PATH` line is not optional. `bin/plugin` starts with `#!/usr/bin/env php`, and the scheduler runs it as a child process with cron's minimal `PATH`. An absolute PHP binary in the crontab line fixes the parent but not the child, so the scheduler looks healthy while every Helpdesk Pro job fails with `env: php: No such file or directory`. Run `bin/grav scheduler -d` to see each job's errors.

[Jobs and cron](../jobs-and-cron) explains the queue, the inline drain and the catch-up that covers a site without cron.

## Give staff access

Staff need `api.access` to reach Admin Next, plus Helpdesk Pro's own permissions. Clients need none of these: they use the portal with an ordinary site login.

Helpdesk Pro never creates groups. Create two in Admin Next, under **Accounts**:

| Group | Permissions |
|---|---|
| `helpdesk-agents` | `api.access`, `helpdesk-pro.desk`, `helpdesk-pro.triage` |
| `helpdesk-admins` | `api.access` and every `helpdesk-pro.*` permission |

Then add your staff to the right group. [Projects and permissions](../projects-and-permissions) lists every permission and explains which projects each agent works.

## First checks

1. Open Admin Next as a staff member. The **Helpdesk** item appears in the sidebar for anyone with `helpdesk-pro.desk`.
2. Run `bin/plugin helpdesk-pro status`. It shows the database path, the schema and the job queue.
3. Run `bin/plugin helpdesk-pro work`. It runs one worker pass and says what it did.

The desk's **Operations → System** screen shows the same status report.

## Related

- [Getting started](../getting-started)
- [Jobs and cron](../jobs-and-cron)
- [Configuration](../configuration)
- [Troubleshooting](../troubleshooting)
