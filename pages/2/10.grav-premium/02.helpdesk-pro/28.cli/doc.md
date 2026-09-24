---
title: CLI Reference
taxonomy:
    category: docs
description: Every bin/plugin helpdesk-pro command, its options, and when to run it.
---

# CLI Reference

All commands run through Grav's plugin CLI from your site root:

```bash
bin/plugin helpdesk-pro <command> [options]
```

## Quick reference

| Command | Does | Safe on a live site? |
|---|---|---|
| `status` | Reports the database, schema, job queue, worker and live updates | Yes, read-only |
| `migrate` | Applies pending database migrations | Yes |
| `work` | Runs one worker pass | Yes |
| `jobs` | Lists jobs, runs or cancels one | Yes |
| `reindex` | Rebuilds the search index | Yes; searches fall back to a plain match while it runs |
| `blocklist` | Lists, adds and removes guest form blocklist entries | Yes |
| `erase` | Erases a person now | Yes, but it cannot be undone |
| `inbound:feed` | Feeds one raw email through the inbound pipeline | Yes |
| `imap:poll` | Reads the IMAP mailbox now | Yes |

## `status`

```bash
bin/plugin helpdesk-pro status
bin/plugin helpdesk-pro status --json
```

Prints the database path and size, applied and pending migration steps, the job queue by state, the last worker run and whether the queue is stale, the registered job types, and Grav's crontab line. `--json` prints the same report as `GET /helpdesk-pro/status`. This is the first command to run when something is not happening. See [Troubleshooting](../troubleshooting#the-status-report).

## `migrate`

```bash
bin/plugin helpdesk-pro migrate --status   # list what is pending
bin/plugin helpdesk-pro migrate            # apply it
```

Applies pending migrations from the plugin and from every add-on that registered its own. Run it after each update when `database.auto_migrate` is `manual`.

## `work`

```bash
bin/plugin helpdesk-pro work
bin/plugin helpdesk-pro work --max-time=50 --max-jobs=50
```

One worker pass: runs due jobs, books recurring jobs, records the worker run, and fires the worker tick. The scheduler runs this every minute. `--max-time` is the time budget in seconds (default 50) and `--max-jobs` the most jobs to run (default 50, `0` for no cap). It refuses to run while migrations are pending.

## `jobs`

```bash
bin/plugin helpdesk-pro jobs
bin/plugin helpdesk-pro jobs --state=failed --type=mail.send --limit=50
bin/plugin helpdesk-pro jobs --run=123
bin/plugin helpdesk-pro jobs --cancel=123
```

Lists the newest jobs with their state, attempts and last error.

| Option | What it does |
|---|---|
| `--state` | `pending`, `running`, `failed`, `complete` or `cancelled` |
| `--type` | Only jobs of this type, such as `mail.send` |
| `--limit` | How many to list (default 25) |
| `--run=<id>` | Runs one job now through the worker's own code path, giving a failed job one more attempt |
| `--cancel=<id>` | Cancels a job. A running one stops at its next checkpoint. |

## `reindex`

```bash
bin/plugin helpdesk-pro reindex
bin/plugin helpdesk-pro reindex --scope=kb
bin/plugin helpdesk-pro reindex --status
```

Rebuilds the search index in place and prints how many documents it wrote. `--scope=tickets` or `--scope=kb` rebuilds one part (default `all`). `--status` prints the index state (file, size, document counts, last rebuild, semantic search) without rebuilding. See [Search](../search).

## `blocklist`

```bash
bin/plugin helpdesk-pro blocklist                     # list every entry
bin/plugin helpdesk-pro blocklist list ip             # list one type
bin/plugin helpdesk-pro blocklist add email spammer@example.com --note="repeat offender"
bin/plugin helpdesk-pro blocklist remove email spammer@example.com
```

Manages the guest form's blocklist. The types are `email`, `domain` (`example.com` also blocks its subdomains), `ip` (an address or a CIDR range such as `203.0.113.0/24`) and `word`. `--note` records why (add only). Values are stored lowercased. See [Request form and guests](../request-form#the-blocklist).

## `erase`

```bash
bin/plugin helpdesk-pro erase 42
bin/plugin helpdesk-pro erase 42 --mode=delete_content --yes
```

Erases a person now: the same work the desk's **Erase** queues as a `people.erase` job. The default mode anonymizes them; `--mode=delete_content` also replaces everything they wrote with "[removed]" and deletes their files. It asks before it starts unless you pass `--yes` (`-y`), refuses a person under a legal hold, and prints how many tickets were updated and files let go. Safe to run twice. See [People and privacy](../people-and-privacy#erase-a-person).

## `inbound:feed`

```bash
bin/plugin helpdesk-pro inbound:feed reply.eml
cat reply.eml | bin/plugin helpdesk-pro inbound:feed --to=support+t8f2k@example.com
bin/plugin helpdesk-pro inbound:feed --no-process --to support@example.com
```

Feeds one raw email through the inbound pipeline, from a file or from standard input (leave the file out, or pass `-`).

| Option | What it does |
|---|---|
| `--to` | The envelope recipient, a comma-separated list. This is where a `+token` address survives when the `To:` header says only `support@`. |
| `--from` | The envelope sender (`--from=""` for a bounce). |
| `--no-process` | Only store the email; the worker processes it. Without it, the email is processed straight away and the result printed (`Inbound email #12: created, ticket #40`). |

An email already received prints its number and does nothing. It exits `75` when the email could not be stored or the Email plugin has no inbound support, so a mail server keeps the email and retries, and `1` for an empty or oversized email. See [Inbound email](../inbound-email#from-your-own-mail-server).

## `imap:poll`

```bash
bin/plugin helpdesk-pro imap:poll
bin/plugin helpdesk-pro imap:poll --work
```

Reads the IMAP mailbox now, whatever the backoff says, and prints how many emails were stored, already received and too large. `--work` also runs the worker afterwards, so the new emails are processed straight away. It exits `1` when the mailbox is not set up, cannot be read, or the Email plugin is older than 5.3.0. With a receiver other than `imap` it still polls once, and says the recurring poll is not running. See [Inbound email](../inbound-email#read-a-mailbox-over-imap).

## Related

- [Jobs and cron](../jobs-and-cron)
- [Troubleshooting](../troubleshooting)
