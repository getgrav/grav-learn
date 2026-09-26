---
title: CLI Reference
taxonomy:
    category: docs
description: Every bin/plugin mailroom command, its arguments and options, and when to run it.
---

# CLI Reference

All commands run through Grav's plugin CLI from your site root:

```bash
bin/plugin mailroom <command> [options]
```

Every command except `migrate` and `status` refuses to run while database migrations are waiting, and says to run `bin/plugin mailroom migrate` first. `status` reports them as a problem.

## Quick reference

| Command | Does | Safe on a live site? |
|---|---|---|
| `status` | Checks the database, the mail transport, the site URL, the queue and the worker | Yes, read-only |
| `work` | Runs one worker pass | Yes |
| `migrate` | Creates or updates the database tables | Yes |
| `erase` | Forgets one email address | Yes, but it cannot be undone |
| `import:csv` | Imports a contact list from a CSV | Yes; `--dry-run` writes nothing |
| `export:csv` | Writes the subscriber list as a CSV | Yes, read-only |
| `segments:count` | Recounts segments now | Yes |
| `segments:preview` | Shows who a segment is about | Yes, read-only |
| `deliverability:check` | Runs the Health screen's checks | Yes, read-only |
| `webhook:replay` | Runs a saved provider payload through its provider | Yes; writes only with `--apply` |
| `seed` | Fills an empty Mailroom with a demo | Not on a real site |

## `status`

```bash
bin/plugin mailroom status
```

Prints the database (and the SQLite file), the schema, the route base, whether the Email plugin is sending, the From address (Mailroom's own or the Email plugin's), the site URL, jobs waiting and failed, when the worker last ran, how many lists there are and how many subscribers in each status. Each problem is a warning saying what to do; when the worker has not run for more than 15 minutes (or never has), the warning ends with the crontab line to add, on a line of its own so it copies cleanly.

It ends "Healthy: the database is current, mail can leave and the queue is moving." and exits `0`, or exits `1` when there is a problem, so a deploy script or a monitor can ask it. This is the first command to run when something is not happening.

## `work`

```bash
bin/plugin mailroom work
bin/plugin mailroom work --max-time=50 --max-jobs=100
```

One worker pass: queues the automation tick and segment recount when due, lets go of emails held for a site URL, runs due jobs, runs the daily housekeeping when due, and records the run. Grav's scheduler runs this every minute as `mailroom-worker`. `--max-time` is the time budget in seconds (default 50) and `--max-jobs` the most jobs to run (default `0`, no cap). Prints "Processed N job(s), N failed, N deferred." and, on the run it happens, what the housekeeping removed. See [Jobs and cron](../jobs-and-cron).

## `migrate`

```bash
bin/plugin mailroom migrate --status   # list the steps that are waiting, and change nothing
bin/plugin mailroom migrate            # apply them
```

Creates or updates Mailroom's tables. SQLite migrates itself on first use, so on most sites this has nothing to do. Run it after each update on MySQL or PostgreSQL, unless `database.auto_migrate` is `auto`, and whenever `database.auto_migrate` is `manual`. Migrations only ever add; there is no down step, so keep a backup. See [Installation](../installation#the-database).

## `erase`

```bash
bin/plugin mailroom erase ada@example.com
bin/plugin mailroom erase ada@example.com --yes
```

Forgets one address: the subscriber, their lists, tags, sends, clicks, automation places, consent history, provider reports and message log rows, keeping only a suppression's hash. It asks first unless you pass `--yes` (`-y`), then lists how many of each went. The same as `POST /mailroom/erase`. See [Privacy](../privacy#erase-an-address).

## `import:csv`

```bash
bin/plugin mailroom import:csv contacts.csv --dry-run
bin/plugin mailroom import:csv contacts.csv --list=newsletter --tag=october-import
```

Imports a contact list in the foreground, deduplicating by address and honoring suppressions, and prints what it did.

| Option | What it does |
|---|---|
| `--list` | The code of the list everybody joins. Default: the default list. |
| `--preset` | Read the file as another tool's export: `emailoctopus`. |
| `--map field=column` | A column mapping, repeatable: `--map email="Email address"`. |
| `--tag` | A tag put on everybody in the file. |
| `--basis` | Where these people agreed, kept in each consent history. Default: the file name. |
| `--as-confirmed` | Treat everybody as already confirmed. The default. |
| `--ask-to-confirm` | Import everybody as waiting to confirm and email each a confirmation. |
| `--dry-run` | Read the file and report, writing nothing at all. |

See [Import and export](../import-and-export#import-on-the-command-line).

## `export:csv`

```bash
bin/plugin mailroom export:csv --file=subscribers.csv
bin/plugin mailroom export:csv --status=subscribed --list=newsletter | wc -l
```

Writes the subscriber list as a CSV, to `--file` or standard output. Filters: `--status`, `--source` (`form`, `import`, `api`, `admin`, `automation`), `--list` and `--tag` (by code), and `--search`. See [Import and export](../import-and-export#export).

## `segments:count`

```bash
bin/plugin mailroom segments:count
bin/plugin mailroom segments:count --id=4
```

Recounts segments now, rather than waiting for the worker: every segment, or one with `--id`. Useful just after an import, or while building a segment. Exits `1` when a segment could not be counted (the reason is in the Grav log).

## `segments:preview`

```bash
bin/plugin mailroom segments:preview 4
```

Shows how many people a segment is about, how many are left out (suppressed, unsubscribed, never confirmed), and ten of them. The addresses are masked (`a***@example.com`), so the output is safe to paste into a support ticket; use `export:csv` when you need the addresses.

## `deliverability:check`

```bash
bin/plugin mailroom deliverability:check
bin/plugin mailroom deliverability:check --cached --strict
```

Runs the Health screen's checks and prints them in the same three groups, with what to do about each. It looks everything up again unless you pass `--cached` (the ten-minute cache the screen reads). Exits `1` when any check fails, or with `--strict` when any is worth a look. See [Deliverability](../deliverability).

## `webhook:replay`

```bash
bin/plugin mailroom webhook:replay mailgun payload.json
bin/plugin mailroom webhook:replay mailgun payload.json --apply
```

Runs a saved payload through the real provider and says, for each event in it, the address, message id, provider id, send header, time and reason it read, which send row it matched, and what it would do (or did, with `--apply`). The provider is a slug a transport plugin on the site registers, such as `smtp2go`, `ses`, `sendgrid`, `postmark`, `mailgun`, `mailersend` or `resend`. The signature is not checked, because a payload saved from a provider's dashboard has lost its headers; `--apply` therefore writes whatever the file says. An event already recorded changes nothing. See [Sending and providers](../sending-and-providers#provider-webhooks).

## `seed`

```bash
bin/plugin mailroom seed
bin/plugin mailroom seed --days=180
bin/plugin mailroom seed --purge
```

Fills an empty Mailroom with three months of a small project's newsletter, for looking around or a demo: the lists Newsletter, Product updates and Events, a few tags, four hundred people who joined through the signup form, an import, the admin or the API, seven campaigns with real numbers (one a draft, one scheduled), four segments, two automations and a suppression list. Every seeded person has a consent history (how they joined, their confirmation, and how they left), each automation email has the sends, opens and clicks of the people who walked past it, and nothing is dated after the moment the seed ran. Nothing is sent. `--days` sets how much history to write (7 to 730, default 90). Running it twice skips what is already there, and `--purge` removes exactly what it added. With no site URL set, the seeded links have no host and no clicks are written, and it says so.

## Related

- [Jobs and cron](../jobs-and-cron)
- [Troubleshooting](../troubleshooting)
