---
title: Jobs and Cron
taxonomy:
    category: docs
description: The job queue, the worker and the scheduler line with its PATH, the drain after a request, what a worker run does, retries, emails held for a site URL, the daily housekeeping, and how to tell the worker is running.
---

# Jobs and Cron

Everything Mailroom sends is a job on its queue: a campaign is one job, a confirmation email is one job, and so is every automation step, import and segment recount. Two things run jobs: the drain after a request, and the worker that Grav's scheduler runs every minute.

## Set up cron

The worker is `bin/plugin mailroom work`. Mailroom adds it to Grav's scheduler as `mailroom-worker`, every minute, so the one thing to do is put Grav's scheduler in the crontab of the user the site runs as:

```
PATH=/usr/local/bin:/usr/bin:/bin
* * * * * cd /path/to/site && php bin/grav scheduler >> /dev/null 2>&1
```

Put the directory your PHP binary lives in on the `PATH` line. On macOS with Homebrew, for example, that is something like `/opt/homebrew/opt/php@8.4/bin`. `bin/plugin mailroom status` prints the exact scheduler line for your site when the worker is not running, built by Grav the way `bin/grav scheduler --install` builds it.

> [!IMPORTANT]
> The `PATH` line is not optional. `bin/plugin` starts with `#!/usr/bin/env php`, and the scheduler runs it as a child process that inherits cron's minimal `PATH`. An absolute PHP binary in the crontab line fixes the parent and not the child, so the scheduler looks healthy while the worker fails with `env: php: No such file or directory`. Run `bin/grav scheduler -d` to print each job's errors.

To run the worker some other way (a supervisor, a cron line of its own), turn off **Run From Grav's Scheduler** (`worker.scheduler`) on the **Advanced** tab, and run `bin/plugin mailroom work` every minute yourself.

## What a worker run does

1. Queues the periodic work that is due: the automation tick (moving people along their automations) and the segment recount.
2. Lets go of emails that were waiting for a site URL, once one is set (below).
3. Runs due jobs for up to 50 seconds (`--max-time`), with no cap on how many (`--max-jobs`, `0`).
4. Once a day, runs the housekeeping.
5. Writes down when it ran, which `status`, the Health screen and the **Sending** tab read.

The worker refuses to run while database migrations are waiting.

## The drain after a request

When a web request queues jobs, such as the confirmation email after a signup, Mailroom runs those jobs, and only those, right after the response has gone, within **Seconds After a Request** (`worker.inline_budget_seconds`, 3, at most 30). So a signup is confirmed at once even before cron is set up, and nobody's click pays for somebody else's backlog.

On PHP-FPM the response is already with the browser when the drain starts. On a server without FastCGI the PHP process stays busy for the drain, which is why the budget is small. Turn off **Send Right After the Request** (`worker.inline_drain`) if work after the response causes trouble on your host; the worker then takes every job.

> [!NOTE]
> The drain only runs what a request queued. Campaigns, scheduled campaigns, automations, retries, imports and segment recounts need the worker. A drain is never counted as the worker running.

## Retries and failures

A job that fails is tried again with a growing wait (a minute after the first failure, two after the second, never more than an hour), up to its attempts. After that it stays failed, with its last error. A job running longer than **Longest One Job May Run** (`worker.job_timeout_seconds`, 120) is stopped and tried again later; `0` turns the limit off.

`bin/plugin mailroom status` counts failed jobs, and the campaign and import screens say why theirs failed. For a campaign, **Retry failed** sends the failed messages again (see [Campaigns](../campaigns#after-it-went-out)).

## Emails held for a site URL

An email the worker builds needs the site's address for its links. With neither Mailroom's **Site URL** nor Grav's **Custom Base URL** set, such a job is handed back to the queue for five minutes, without spending an attempt, as often as it takes, and one line in Grav's log says why. Once the address is set, the next worker run sends everything that was waiting. See [Troubleshooting](../troubleshooting#the-site-url-is-not-set).

## Housekeeping

Once a day the worker deletes:

| What | After | Setting |
|---|---|---|
| Finished and failed jobs | 30 days | `worker.retain_days` |
| Individual clicks and provider events | 365 days | `tracking.retain_days` |
| Uploaded import files whose import never ran | 30 days | `import.keep_days` |
| Message log rows | 180 days | `mail_log.retain_days` |

`bin/plugin mailroom work` prints what the housekeeping removed on the run it happens.

## Is the worker running?

- `bin/plugin mailroom status` shows **Jobs waiting**, **Jobs failed** and **Worker last ran**. It stops calling the site healthy when the worker has not run for more than 15 minutes, or never has, even with nothing waiting, and prints the crontab line to add.
- The Health screen's **The queue worker** check warns when the worker has not run for 15 minutes while jobs are waiting.
- **The queue worker** card on the **Sending** tab says when it last ran.

## Job types

| Job | What it does |
|---|---|
| `newsletter.send_campaign` | Sends one slice of a campaign (`sending.batch` people), then hands the worker back |
| `newsletter.confirmation` | Sends a confirmation email |
| `newsletter.send_flow_email` | Sends one automation email to one person |
| `newsletter.flow_tick` | Moves people along their automations |
| `newsletter.segment_counts` | Recounts stale segments |
| `newsletter.import` | Runs a CSV import from the admin or the API |

## Settings

On the **Advanced** tab:

| Key | Label | Default | What it does |
|---|---|---|---|
| `worker.scheduler` | Run From Grav's Scheduler | On | Off, the scheduler leaves Mailroom alone, for a site that runs the worker another way. |
| `worker.inline_drain` | Send Right After the Request | On | Run the jobs a request queued after its response. |
| `worker.inline_budget_seconds` | Seconds After a Request | `3` | How long that drain may run (1 to 30). |
| `worker.job_timeout_seconds` | Longest One Job May Run (seconds) | `120` | A job past this is stopped and tried again later. `0` turns the limit off. |
| `worker.retain_days` | Keep Finished Jobs For (days) | `30` | Finished and failed jobs are swept once a day after this many days. |
| `mail_log.retain_days` | Keep the Message Log For (days) | `180` | Message log rows older than this are swept once a day. `0` keeps them. |

## Related

- [Installation](../installation#set-up-cron)
- [CLI](../cli)
- [Troubleshooting](../troubleshooting)
