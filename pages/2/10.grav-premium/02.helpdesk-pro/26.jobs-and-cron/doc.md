---
title: Jobs and Cron
taxonomy:
    category: docs
description: The job queue, the inline drain, the catch-up for sites without cron, the scheduler line and its PATH, retries, and the recurring jobs.
---

# Jobs and Cron

Everything slow or failure-prone (sending email, delivering notifications, reading a mailbox, indexing for search) runs as a job in a queue rather than inside the request that caused it. Three things run jobs: the inline drain, the catch-up, and the worker in cron.

## Set up cron

The worker is `bin/plugin helpdesk-pro work`. Helpdesk Pro adds it to Grav's scheduler as `helpdesk-pro-jobs`, every minute, so the one thing to do is put Grav's scheduler in your crontab:

```
PATH=/usr/local/bin:/usr/bin:/bin
* * * * * cd /path/to/site && php bin/grav scheduler >> /dev/null 2>&1
```

Put the directory your PHP binary lives in on the `PATH` line. On macOS with Homebrew, for example, that is something like `/opt/homebrew/opt/php@8.4/bin`.

> [!IMPORTANT]
> The `PATH` line is not optional. `bin/plugin` starts with `#!/usr/bin/env php`, and the scheduler runs it as a child process that inherits cron's minimal `PATH`. An absolute PHP binary in the crontab line fixes the parent and not the child, so the scheduler looks healthy while every Helpdesk Pro job fails with `env: php: No such file or directory`. Run `bin/grav scheduler -d` to print each job's errors.

Each worker run:

1. runs due jobs for up to 50 seconds (`--max-time`) and 50 jobs (`--max-jobs`);
2. books any recurring job that has nothing waiting;
3. records when it ran, so the desk can warn when cron has stopped;
4. fires the worker tick for add-ons.

The worker refuses to run while migrations are pending.

## The inline drain

When a request queues jobs, Helpdesk Pro runs those jobs, and only those, right after the response has gone, within `jobs.inline_budget_seconds` (3). A staff reply's email therefore leaves within a couple of seconds. Nobody's click pays for somebody else's backlog: jobs other requests queued wait for the worker.

On PHP-FPM the response is already with the browser when the drain starts, so it costs the visitor nothing. On mod_php the browser has its page but the PHP worker stays busy for the drain, which is why the budget is small.

Set `jobs.inline_drain` to `false` if work after the response causes trouble on your host. Cron then takes every job.

## Catching up without cron

The inline drain only runs what a request queued, and notification email is never due in the request that queued it: a notification waits for its grace period or batch window first. On a site without cron those emails would wait until something ran the worker.

`jobs.catch_up` (on by default) closes that gap. After a web request's response, Helpdesk Pro runs a few due jobs, whoever queued them:

- only when the cron worker has not run in the last two minutes, so a site with working cron never pays for it;
- at most once a minute for the whole site;
- at most five jobs and two seconds per pass;
- never before the database exists, so a site that never used the helpdesk does not get one from a page view.

A pass also books the recurring jobs that only the worker would book otherwise. Frontend pages and API calls both count as web requests; the CLI never catches up.

Job types listed in `jobs.catch_up_exclude` are never run by a pass. It lists `search.embed` by default, because embedding for semantic search is slow network work that belongs on the worker. Set `jobs.catch_up` to `false` to turn the catch-up off; turning `jobs.inline_drain` off turns it off too.

> [!NOTE]
> The catch-up depends on visitors. A quiet site sends its email late, so set up cron. The catch-up is the safety net, not the plan.

## Retries and failures

A job that throws is retried with backoff (30 seconds, then 60, then 120, capped at an hour), up to three attempts or the job's own limit. After that it stays failed, with its last error, until someone runs it again. Failed jobs are never deleted by the retention sweep.

```bash
bin/plugin helpdesk-pro jobs --state=failed    # list failed jobs with their last error
bin/plugin helpdesk-pro jobs --run=<id>        # run one again now
```

A job running longer than `jobs.job_timeout_seconds` (120) fails and is retried.

## Worker health

`bin/plugin helpdesk-pro status`, **Operations → System** and `GET /helpdesk-pro/status` report when a worker last ran and how, how many jobs are pending or failed, and `stale` when jobs have waited more than ten minutes and no worker has run for as long. The desk shows a warning strip in the same situation.

## The recurring jobs

| Job | How often | What it does |
|---|---|---|
| `maintenance.prune` | Daily | Deletes finished jobs past `jobs.retention_days` and runs every retention sweep: old rate-limit windows, expired sign-in links, presence, sent email rows, old help center events, old read notifications, old rule runs, old channel deliveries. |
| `rules.sweep` | Every ten minutes | Runs the time-triggered rules and the built-in auto-close ([Rules and automations](../rules-and-automations)). |
| `sla.scan` | Every minute | Stamps the SLA warnings and breaches that have come due, and notifies ([SLA](../sla)). Not booked while `sla.enabled` is off. |
| `imap.poll` | Every `inbound.imap.interval_seconds` (two minutes) | Reads the IMAP mailbox while the receiver is `imap` ([Inbound email](../inbound-email#read-a-mailbox-over-imap)). |
| `digest.sweep` | Hourly | Sends each person's daily digest once their digest hour has come round ([Notifications](../notifications)). |
| `attachments.gc` | Hourly | Expires unclaimed draft uploads and deletes stored files nothing refers to any more. |
| `kb.sync` | Hourly | Reindexes the knowledge base when an article changed outside Grav (git sync, FTP, a deploy). |

## Other jobs

| Job | What it does |
|---|---|
| `mail.send` | Drains the email queue ([Outbound email](../outbound-email#how-sending-works)). |
| `notify.deliver` | The notification email fallback for one person. |
| `magic_link.send` | Sends a sign-in link. |
| `channel.deliver` | Sends one message to one notification channel, with its own retry rules. |
| `inbound.process`, `inbound.fetch` | Processes a received email, or fetches one a provider only referenced. |
| `search.index`, `search.rebuild`, `search.embed` | Search indexing, rebuilds and semantic embedding (worker only). |
| `sla.recompute` | Recomputes SLA due times after a policy or business hours change. |
| `people.erase` | Erases a person. |

## Settings

On the **Advanced** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `jobs.inline_drain` | `true` | Run the jobs a request queued right after its response has gone. |
| `jobs.inline_budget_seconds` | `3` | How long one request may spend on its own jobs after the response (at most 30). |
| `jobs.catch_up` | `true` | On a site whose cron has not run for two minutes, run a few due jobs after a web request, at most once a minute. |
| `jobs.catch_up_exclude` | `[search.embed]` | Job types the catch-up never runs. |
| `jobs.job_timeout_seconds` | `120` | A job running longer than this fails and is retried. `0` turns the limit off. |
| `jobs.retention_days` | `30` | Completed and cancelled jobs are deleted after this many days. Failed jobs are never swept. |

## Related

- [Installation](../installation#set-up-cron)
- [CLI](../cli)
- [Troubleshooting](../troubleshooting)
