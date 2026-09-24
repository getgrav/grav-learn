---
title: Troubleshooting
taxonomy:
    category: docs
description: Start from the status report, then fix the common problems - jobs not running, email not arriving, live updates, rules and erasure.
---

# Troubleshooting

Most problems come down to background jobs not running, or a setting that stops mail arriving. Start with the status report, then find your symptom below.

## The status report

Open **Operations → System** in the desk (`#/setup/system`), run `bin/plugin helpdesk-pro status` on the server, call `GET /helpdesk-pro/status` (needs `helpdesk-pro.settings`), or use the `get_status` MCP tool. All four report the same things:

| Block | What it tells you |
|---|---|
| `database` | The file path, whether it exists, its size, and the error when it cannot be opened |
| `schema` | The migration policy, applied and pending steps, and the migration directories in use |
| `worker` | When a worker last ran and how (`cron`, `inline`, `catch-up`), pending and failed job counts, how long the oldest job has waited, and `stale` |
| `jobs` | The queue by state, `due` (jobs that could run now), `scheduled` (jobs booked for later) with `next_run_at`, the registered job types, and whether the inline drain is on |
| `realtime` | Whether live updates are on, the transport, and why not |
| `search` | The index state, as on Operations → Search |

Scheduled jobs are normal: the recurring sweeps are always booked for later. Only due jobs that sit there, or failed ones, need attention, and only those turn the System screen's Jobs line into a warning.

## Jobs are waiting and nothing sends

`stale: true` means jobs have waited more than ten minutes and no worker has run for as long. Either cron is not running Grav's scheduler, or it is and `bin/plugin` cannot find PHP.

1. Check the crontab has the scheduler line and a `PATH` line (see [Jobs and cron](../jobs-and-cron#set-up-cron)).
2. Run `bin/grav scheduler -d` to see each job's errors. `env: php: No such file or directory` means the `PATH` line is missing or wrong.
3. Run `bin/plugin helpdesk-pro work` by hand to drain the queue once.

## A job keeps failing

```bash
bin/plugin helpdesk-pro jobs --state=failed   # failed jobs with their last error
bin/plugin helpdesk-pro jobs --run=<id>       # run one again after fixing the cause
```

## The database is downloadable on nginx or Caddy

The deny-all `.htaccess` only protects the database on Apache. On other servers, deny `user/data/` in the server config. For nginx:

```nginx
location ^~ /user/data/ { deny all; }
```

## Emails to support do not arrive

Start with **Operations → Email** (or `GET /helpdesk-pro/inbound/status`). Its problems list names what stops mail arriving: an Email plugin older than 5.3.0, inbound switched off, a secret shorter than 32 characters, no support address, or a receiver the site does not have. Then check what your provider saw when it posted:

| Status | Meaning |
|---|---|
| `404` | The webhook address is wrong. Copy it again from Operations → Email; the secret or receiver in it no longer matches the settings. |
| `401` | The provider's signature was refused. Check the verification key in the provider's Email plugin settings, or `inbound.signing_secret` for `generic` and `cloudflare`. |
| `503` | The Email plugin is older than 5.3.0, or the site could not store the email. The provider retries. |

An email that did arrive is in **Operations → Inbound log** with the reason for what happened to it; **Retry** or **Process again** runs it again after a fix. A staff reply stuck as `held` failed the sender check and waits for **Release**. For IMAP, the Mailbox section of Operations → Email shows the last error. See [Inbound email](../inbound-email).

## Replies by email open new tickets

Your mail system is probably not delivering `support+anything@` to the same place as `support@`, so the reply token is lost. Turn on plus addressing at your provider (see [Which address](../inbound-email#which-address)), or set `inbound.plus_addressing` to `false` and rely on the threading headers.

## Client email links point at the wrong address

Links in email are built from the address the site was last visited at. Set `email.site_url` to the address clients use, such as `https://example.com`. The test email says when links are relative because no address is known yet.

## Notification email is late

Notification email is never due in the request that created it, so it needs the worker. Without cron, the catch-up sends it after the next visit to the site. Set up cron (see [Jobs and cron](../jobs-and-cron)).

## Live updates do not arrive

The status report's `realtime` block says whether live updates are on, which transport carries them, and why not when they are off: the Sync plugin is missing or disabled, `realtime.enabled` is off, or the installed Sync Mercure is older than 1.2.2 (then browsers poll instead). `live_listeners` counts the people with a live tab open. Everything else keeps working without live updates. See [Live updates](../live-updates#check-it).

## A rule did not fire

1. Open **Automation → Rules**. A rule that failed shows its last error on its row (an assignee who no longer works the project, a deleted saved reply); saving the rule clears it.
2. Open the rule and use **Test against ticket** with the ticket's number. It says which conditions the ticket meets now.

A change a rule makes never triggers rules, so a rule waiting for "the status changes" does not fire when another rule changed the status. A rule fires once per event, and a time rule once per stay in the state. Time rules and the auto-close run on the `rules.sweep` job every ten minutes, so they need the worker or the catch-up.

## An erasure did not happen

Erasing runs as the `people.erase` job, so it needs the worker or the inline drain. "Erasure queued" that never changes means no job is running: check `bin/plugin helpdesk-pro jobs --type=people.erase`. A report of `held` means a legal hold was placed after the erasure was asked for; release it and erase again. `bin/plugin helpdesk-pro erase <id>` runs one straight away.

## A requester shows "account not verified"

Someone registered on the site with that address but never proved it, so their account and the requests sent from the address are kept apart (see [People and privacy](../people-and-privacy#one-address-one-requester)). Tickets you open for the address still reach the right person. The client joins them by using any sign-in link, or "Verify your email" in the portal. You can also merge the two records on the person's page when you know they are the same human.

## Search does not find something

Run `bin/plugin helpdesk-pro reindex --status` to see the index state, then `bin/plugin helpdesk-pro reindex` to rebuild it. Articles edited outside Grav (git sync, FTP, a deploy) are picked up by the hourly `kb.sync` job. Check the article is published, routable, and readable by the person searching (see [Knowledge base](../knowledge-base#who-can-read-an-article)).

## Related

- [Jobs and cron](../jobs-and-cron)
- [CLI](../cli)
- [Inbound email](../inbound-email)
- [Configuration](../configuration)
