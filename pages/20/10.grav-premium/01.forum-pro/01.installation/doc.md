---
title: Installation
taxonomy:
    category: docs
description: Install Forum Pro, choose and secure a database, mount the forum at the route you want, and get the background worker running.
---

# Installation

## Install the plugin

With your license added to the [License Manager](https://getgrav.org/premium/license-manager), install through GPM like any other plugin:

```bash
bin/gpm install forum-pro
```

You can also install it from **Admin → Plugins**. Once enabled, Forum Pro adds a **Forum** entry to the admin sidebar and registers its own CLI commands under `bin/plugin forum-pro`.

## Turn on the frontend

The public forum is off by default so that installing the plugin never exposes routes before you are ready. Enable it in **Admin → Plugins → Forum Pro → General**, or in `user/config/plugins/forum-pro.yaml`:

```yaml
frontend:
  enabled: true
  route: /forum
```

Visit `/forum`. On SQLite the schema migrates itself on first use and the forum is live immediately.

## Database setup

### SQLite (the default)

Nothing to configure. The database is created at `user/data/forum-pro/db/forum.sqlite` and deny-all protection files are written next to it.

> [!WARNING]
> Stock Grav **nginx** configs do not block `.sqlite` downloads, and nginx ignores `.htaccess`. If you serve Grav with nginx, add this to your server block:
>
> ```nginx
> location ~* /user/data/forum-pro/ { deny all; }
> ```
>
> The **Status** tab in the admin reports whether your database file is reachable over the web, so you can verify the block worked.

### MySQL, MariaDB or PostgreSQL

Point the `database` block at your server:

```yaml
database:
  type: mysql          # sqlite | mysql | pgsql
  mysql:
    host: localhost
    port: 3306
    dbname: grav_forum
    username: forum
    password: '...'
```

```yaml
database:
  type: pgsql
  pgsql:
    host: localhost
    port: 5432
    dbname: grav_forum
    username: forum
    password: '...'
    sslmode: prefer
```

If you already use the **Database** plugin, you can reference one of its named connections instead of repeating credentials:

```yaml
database:
  connection: my-named-connection
```

The identical schema and the identical migrations run on all three engines. Forum Pro's CI runs the full test suite against SQLite, MySQL 8 and PostgreSQL 16 on PHP 8.3 and 8.4.

### Migration policy

```yaml
auto_migrate: sqlite-only    # auto | sqlite-only | manual
```

- `sqlite-only` (default) applies pending migrations automatically on SQLite, and requires a manual run everywhere else.
- `auto` applies them automatically on every engine.
- `manual` never applies them automatically.

Migrations take a database run-lock, so two concurrent requests can never apply the same step twice. Apply them by hand with:

```bash
bin/plugin forum-pro migrate --status   # preview what would run
bin/plugin forum-pro migrate            # apply
```

## The background worker

Forum Pro defers real work to the **Grav scheduler**: email delivery, badge awards, retention purges, session cleanup, view-count folding, the moderator digest and the scheduled spam scans all run there. Add the scheduler to your crontab:

```
* * * * * cd /path/to/grav && bin/grav scheduler 1>> /dev/null 2>&1
```

The **Status** tab in the admin prints the exact line for your install, including the right PHP binary, and reports whether the scheduler has been seen recently.

You can also drain the queue once by hand, which is useful when debugging:

```bash
bin/plugin forum-pro work
```

## Mounting the forum

By default the forum lives at `frontend.route` (`/forum`). To mount it somewhere else, including the site root, create a page and give it the **Forum** page type. The forum takes over that page's route.

Three rules make this safe:

1. **Real site pages always win** over forum routes, so an existing page at the same path keeps rendering normally.
2. **`/forum` keeps working** when no mount page exists.
3. **A home-mounted forum coexists** with the rest of your site. Your blog, your docs and your landing pages are unaffected.

## Reserved routes

With `auth.enabled` (the default), Forum Pro serves its own account system under routes reserved beneath the forum root:

| Route | Purpose |
|---|---|
| `{forum}/login` | Sign in |
| `{forum}/register` | Create an account |
| `{forum}/verify` | Email verification |
| `{forum}/reset` | Password reset |
| `{forum}/settings` | Member preferences |
| `{forum}/logout` | Sign out |
| `{forum}/u/<username>` | Public profile |
| `{forum}/members` | Member directory |
| `{forum}/search` | Search |
| `{forum}/messages` | Private messages |
| `{forum}/notifications` | Notification list |
| `{forum}/bookmarks` | Your bookmarks |
| `{forum}/tags` | Tag browser |
| `{forum}/queue` | Moderator review queue |

## Set your trusted site URL

Password-reset and email-verification links are built from an absolute base URL. Pin it explicitly in production so that a spoofed `Host` header cannot redirect a reset link to an attacker:

```yaml
security:
  site_url: 'https://example.com'
```

If it is empty, Forum Pro falls back to `system.custom_base_url`, then to the request host with a logged warning.

## Next steps

Open **Admin → Forum → Structure** and create your first section and category, then work through [Configuration](../configuration).
