---
title: Configuration
taxonomy:
    category: docs
description: Every Helpdesk Pro setting, tab by tab, with its default and what it does.
---

# Configuration

This page lists every Helpdesk Pro setting, grouped by the tab it lives on. Settings live in `user/config/plugins/helpdesk-pro.yaml`, and almost all of them are editable on the plugin's settings page in Admin Next (the **Settings** button above the desk opens it). The defaults ship in the plugin's own `helpdesk-pro.yaml`.

Secrets (webhook secrets, the IMAP password, the S3 secret, the embeddings API key) are never sent to the browser by any Helpdesk Pro endpoint. Where a setting takes a secret, you can write `env:NAME` to read it from an environment variable instead.

Some things are not settings at all: projects, statuses, labels, custom fields, rules, SLA policies and notification channels are set up in the desk and stored in the database.

## Tab map

| Tab | Controls |
|---|---|
| Desk | The desk's first screen, the dashboard widget, boards |
| Portal & Access | The help center route, guest requests, spam guards, sign-in links |
| Email & Notifications | Outbound email, the look of every email, staff notifications, inbound email, IMAP, reply addresses |
| Attachments | Upload limits, allowed types, cleanup, the private bucket |
| Search | Synonyms, typo correction, suggestions, semantic search |
| Live Updates | Live updates and presence |
| Advanced | The database and background jobs |
| Help Center | The portal's nav row, topic descriptions and icons |
| Rules | Rules on or off, and the built-in auto-close |
| SLA | SLA clocks and the warning time |
| Ratings | Customer ratings |
| Client Organizations | Extra blocked email domains |
| Channels | Notification channel delivery |

A few keys are YAML-only: `enabled`, `privacy.ip_hashing` and `jobs.catch_up_exclude`.

## General

| Key | Default | What it does |
|---|---|---|
| `enabled` | `true` | Turns the plugin on. |
| `privacy.ip_hashing` | `true` | Helpdesk Pro remembers the IP address a person was last seen from, to help staff spot abuse. On, it stores only a SHA-256 hash; off, it stores the address itself. |

## Desk

See [The staff desk](../the-desk).

| Key | Default | What it does |
|---|---|---|
| `desk.default_view` | `my-work` | The screen the desk opens on: `my-work` or `tickets`. |
| `admin2.dashboard` | `true` | The Helpdesk widget on the Admin Next dashboard. |
| `desk.board` | `true` | Boards for the projects whose board setting is on. `false` hides every board and makes the board route answer 404. |

Keyboard shortcuts have no site setting: each person turns them off or on for their own browser in the shortcut sheet (press `?` in the desk).

## Portal & Access

See [Help center and portal](../help-center-and-portal), [Request form and guests](../request-form) and [Sign-in links](../sign-in-links).

| Key | Default | What it does |
|---|---|---|
| `portal.route` | `/help` | Where the help center lives when no page uses the `helpdesk` template. |
| `portal.guest_submissions` | `true` | Whether guests may send the request form. Only `public` projects accept guest requests. |
| `portal.client_groups` | `[]` | Grav groups given to the accounts Helpdesk Pro creates for clients when they first sign in through an email link. |
| `portal.captcha` | `cap` | `none`, `cap`, `turnstile` or `recaptcha`: the Form plugin's captcha providers. |
| `portal.captcha_signed_in` | `false` | Ask signed-in clients for the captcha too. |
| `portal.min_submit_seconds` | `3` | A guest request sent sooner than this after the form opened scores as spam. |
| `portal.limits.ip_per_hour` | `5` | Guest requests per IP address per hour. `0` turns a limit off. |
| `portal.limits.email_per_hour` | `5` | Guest requests per email address per hour. |
| `portal.limits.guest_per_hour` | `60` | Guest requests from everyone together per hour. |
| `portal.magic_links` | `true` | Clients sign in with an emailed link, and client emails open the request signed in. |
| `portal.magic_link_minutes` | `30` | How long a sign-in link someone asked for works. |
| `portal.email_link_days` | `7` | How long the link inside a client email works. |

## Email & Notifications

### Email

See [Outbound email](../outbound-email).

| Key | Default | What it does |
|---|---|---|
| `email.support_address` | blank | The address clients write to. Mail is sent from it and replies come back to it. |
| `email.from_address` | blank | Only when mail must go out from a different address. Blank uses the support address, then the Email plugin's From. |
| `email.site_url` | blank | The address links in email start with, such as `https://example.com`. Blank uses the address the site was last visited at. |
| `email.from_name_format` | `{agent} at {site}` | The sender name on client replies. |
| `email.subject_tag` | `false` | Adds a visible `[#123]` to client subjects. |
| `email.acknowledge_web_tickets` | `true` | Send an acknowledgement for help center requests. |
| `email.acknowledge_email_tickets` | `true` | The same for requests that arrive by email. |
| `email.attach_max_mb` | `10` | How much of a staff reply's files a client email carries itself. `0` keeps every file a link. |

### Look and Branding

See [Brand your email](../outbound-email#brand-your-email).

| Key | Default | What it does |
|---|---|---|
| `email.brand.name` | blank | The business name in the header, sign-offs, sender name and staff subject tags. Blank uses the site title. |
| `email.brand.logo` | blank | The header image: a site path or an `https://` address. Blank or `none` shows the name. |
| `email.brand.logo_dark` | blank | A light version of the logo for mail apps in dark mode. |
| `email.brand.logo_width` | `140` | The logo's drawn width, 40–320px. |
| `email.brand.show_name` | `false` | Print the name beside the logo too. |
| `email.brand.accent_color` | blank (`#1f6feb`) | Links, ticket titles and the line along the top of the card. |
| `email.brand.button_color` | blank (`#1f6feb`) | Every button. |
| `email.brand.font` | `system` | `system`, `helvetica`, `verdana`, `trebuchet`, `georgia` or `custom`. |
| `email.brand.font_custom` | blank | The font stack when `font` is `custom`. |
| `email.brand.footer` | blank | An optional Markdown line under every email. |
| `email.brand.appearance` | `auto` | `auto` (follow the reader's mail app), `light` or `dark`. |

### Notifications

See [Notifications](../notifications).

| Key | Default | What it does |
|---|---|---|
| `notifications.default_level` | `aimed` | `everything`, `aimed` or `nothing`: the level of staff who have not chosen one. |
| `notifications.default_email` | `fallback` | `fallback`, `digest` or `off`: the email mode of staff who have not chosen one. |
| `notifications.grace_seconds` | `60` | How long an urgent notification waits for an in-app read before it is emailed. |
| `desk.batch_minutes` | `10` | How long other notifications wait, so several changes become one email. |
| `notifications.hold_while_active` | `true` | Hold email for people active in the desk. |
| `notifications.hold_max_minutes` | `60` | The longest a notification is held. |
| `notifications.digest_hour` | `7` | The local hour the daily digest goes out. |
| `notifications.keep_read_days` | `90` | Read notifications older than this are deleted. |

### Inbound Email, IMAP Mailbox and Reply Addresses

See [Inbound email](../inbound-email).

| Key | Default | What it does |
|---|---|---|
| `inbound.enabled` | `false` | Receive email: replies to your mail and new tickets by email. |
| `inbound.receiver` | `''` | `generic`, `cloudflare`, `imap`, or an Email plugin provider (`postmark`, `mailgun`, `sendgrid`, `ses`, `resend`, `mailersend`). |
| `inbound.route` | `/_helpdesk/inbound` | The start of the webhook address, `{site}{route}/{receiver}/{secret}`. |
| `inbound.secret` | `''` | The URL secret in the webhook address, 32 or more random characters. |
| `inbound.signing_secret` | `''` | The HMAC secret the `generic` and `cloudflare` receivers check. Blank uses `inbound.secret`. |
| `inbound.default_project` | `support` | The project slug for new tickets no email alias matches. |
| `inbound.cc_join` | `true` | People in To and Cc of a client's email become cc's on a new ticket. |
| `inbound.max_bytes` | `26214400` | The largest email accepted (25 MB). |
| `inbound.max_attachments` | `20` | The most files kept from one email. |
| `inbound.per_sender_per_hour` | `20` | More emails than this from one address in an hour are rejected. |
| `inbound.new_tickets_per_sender_per_hour` | `5` | The most new tickets one address may open by email in an hour. |
| `privacy.inbound_raw_days` | `90` | Days the inbound log keeps each email's raw copy. `0` keeps it. |
| `inbound.imap.host` | `''` | The IMAP server. |
| `inbound.imap.port` | `993` | `993` for `ssl`, usually `143` for `starttls`. |
| `inbound.imap.encryption` | `ssl` | `ssl`, `starttls` or `none`. |
| `inbound.imap.username` | `''` | The mailbox login. |
| `inbound.imap.password` | `''` | An app password. |
| `inbound.imap.folder` | `INBOX` | The folder new mail is read from. |
| `inbound.imap.processed_folder` | `''` | Move imported mail here. Blank marks it read and leaves it. |
| `inbound.imap.interval_seconds` | `120` | How often the mailbox is read (at least 60). |
| `inbound.address` | `''` | Where replies to your mail go, with a token added. Blank uses the project's email alias, then `email.support_address`, then the From. |
| `inbound.plus_addressing` | `true` | Put the reply token in the address (`support+t…@`). Off when your mail system rejects or strips `+detail`. |

## Attachments

See [Attachments](../attachments).

| Key | Default | What it does |
|---|---|---|
| `attachments.enabled` | `true` | Lets clients and staff add files. Existing files stay readable when off. |
| `attachments.max_mb` | `10` | The largest file accepted, in megabytes. |
| `attachments.max_per_message` | `10` | How many files one message can carry. |
| `attachments.extensions` | `[png, jpg, jpeg, gif, webp, pdf, txt, log, csv, zip, json, md]` | The extensions people may upload. Program and script types are always refused. |
| `attachments.uploads_per_hour` | `60` | Uploads per person (or per guest address) per hour. `0` turns the limit off. |
| `attachments.draft_hours` | `24` | Uploads never sent with a message are deleted after this many hours. |
| `attachments.grace_days` | `7` | A stored file nothing uses is kept this many days before it is deleted. |
| `attachments.storage.s3.enabled` | `false` | Also keep a copy of every file in a private S3-compatible bucket. |
| `attachments.storage.s3.endpoint` | `''` | The bucket service's HTTPS endpoint, without the bucket name. |
| `attachments.storage.s3.bucket` | `''` | The bucket. |
| `attachments.storage.s3.region` | `auto` | `auto` for Cloudflare R2; the bucket's region elsewhere. |
| `attachments.storage.s3.key` | `''` | Access key id. |
| `attachments.storage.s3.secret` | `''` | Secret access key. |
| `attachments.storage.s3.prefix` | `helpdesk` | The folder inside the bucket. |

## Search

See [Search](../search). An empty semantic key takes YetiSearch Pro's value when that plugin has semantic search on, else the built-in default shown in brackets.

| Key | Default | What it does |
|---|---|---|
| `search.fuzzy` | `true` | Retry a search that found nothing with typo correction. |
| `search.synonyms` | `true` | Expand searches with the synonym list. |
| `portal.suggestions` | `true` | Suggest articles while people type in the search box and the request form. |
| `portal.kb_session_days` | `30` | How long the `hd_kb` cookie keeps a visitor's searches together. |
| `privacy.kb_events_days` | `90` | Help center searches, views and answers are deleted after this many days. |
| `search.semantic.enabled` | `false` | Rank by meaning as well as words. |
| `search.semantic.provider` | `openai_compatible` | Any OpenAI-compatible embeddings API. |
| `search.semantic.base_url` | empty (`https://api.openai.com/v1`) | The API's base URL. |
| `search.semantic.api_key` | empty | The key, or `env:NAME`. |
| `search.semantic.model` | empty (`text-embedding-3-small`) | The embedding model. |
| `search.semantic.dimensions` | empty (`256`) | Vector length; `0` is the model's own. |
| `search.semantic.weight` | empty (`0.5`) | Share of the ranking that comes from meaning. |
| `search.semantic.min_similarity` | empty (`0.25`) | Documents less similar than this never appear on meaning alone. |
| `search.semantic.min_query_chars` | empty (`3`) | Shorter queries are keyword only. |
| `search.semantic.query_prefix` | empty | Text put before queries. |
| `search.semantic.document_prefix` | empty | Text put before documents. |
| `search.semantic.query_timeout` | empty (`5`) | Seconds a search waits for the query's embedding. |
| `search.semantic.timeout` | empty (`20`) | Seconds the worker waits for a batch of document embeddings. |
| `search.semantic.embed_after_indexing` | `true` | Queue embedding whenever documents change. |
| `search.semantic.batch_limit` | `200` | Documents per embedding job. |
| `search.semantic.notes` | `false` | Also embed internal notes (sends note text to the API). |

## Live Updates

See [Live updates](../live-updates).

| Key | Default | What it does |
|---|---|---|
| `realtime.enabled` | `true` | Send live updates over the Sync plugin when it is installed. Presence works either way. |
| `realtime.poll_idle_ms` | `4000` | With polling, how often an open tab asks for news (at least 1000). |
| `realtime.presence_heartbeat_seconds` | `15` | How often an open ticket sends its presence heartbeat (5 to 40). |

## Advanced

See [Installation](../installation#the-database) and [Jobs and cron](../jobs-and-cron).

| Key | Default | What it does |
|---|---|---|
| `database.sqlite.path` | `user-data://helpdesk-pro/db/helpdesk.sqlite` | The SQLite file: a stream path or an absolute path. |
| `database.auto_migrate` | `sqlite` | `sqlite` (or `auto`) applies new migrations on the first request after an update; `manual` waits for `bin/plugin helpdesk-pro migrate`. |
| `jobs.inline_drain` | `true` | Run a request's own jobs right after its response. |
| `jobs.inline_budget_seconds` | `3` | How long one request may spend on its own jobs (at most 30). |
| `jobs.catch_up` | `true` | Without cron, web requests run a few due jobs, at most once a minute. |
| `jobs.catch_up_exclude` | `[search.embed]` | Job types the catch-up never runs. YAML only. |
| `jobs.job_timeout_seconds` | `120` | A job running longer than this fails and is retried. `0` turns the limit off. |
| `jobs.retention_days` | `30` | Completed and cancelled jobs, and sent email rows, are deleted after this many days. |

## Help Center

| Key | Default | What it does |
|---|---|---|
| `portal.nav` | `true` | The nav row on every portal page and help article. Off lets a theme place `helpdesk_nav()` itself. |
| `kb.categories` | `{}` | A one-line description and icon per knowledge base topic, keyed by category name or slug. See [Topic descriptions and icons](../knowledge-base#topic-descriptions-and-icons). |

## Rules

See [Rules and automations](../rules-and-automations).

| Key | Default | What it does |
|---|---|---|
| `rules.enabled` | `true` | Runs the rules made in Automation → Rules. The auto-close has its own switch. |
| `rules.auto_close.enabled` | `false` | Nudge resolved tickets whose client has gone quiet, then close them. |
| `rules.auto_close.nudge_days` | `7` | Days a resolved ticket's client has been quiet before the nudge. |
| `rules.auto_close.close_days` | `3` | Days after the nudge before the ticket is closed, unless the client replies. |
| `rules.auto_close.message` | `''` | The nudge's text. `{days}` becomes `close_days`. Blank uses the built-in text. |

## SLA

See [SLA](../sla).

| Key | Default | What it does |
|---|---|---|
| `sla.enabled` | `true` | Keep SLA clocks on tickets. |
| `sla.warning_minutes` | `60` | How long before a target falls due the warning is sent. `0` sends no warnings. |

## Ratings

See [Customer ratings](../customer-ratings).

| Key | Default | What it does |
|---|---|---|
| `csat.enabled` | `false` | Ask clients "How did we do?" when their request is solved. |
| `csat.projects` | `[]` | Project slugs to ask in. Empty asks in every project. |
| `csat.token_days` | `14` | How long the rating links work and the answer can be changed. |
| `csat.ask_comment_on_not_good` | `true` | After "Not good", ask what could have been done better. |
| `csat.notify_not_good` | `true` | A "Not good" notifies the credited staff member. |

## Client Organizations

See [Organizations](../organizations).

| Key | Default | What it does |
|---|---|---|
| `organizations.blocked_domains` | `[]` | More email domains no organization may list, on top of the public email providers Helpdesk Pro already refuses. |

## Channels

See [Notification channels](../notification-channels).

| Key | Default | What it does |
|---|---|---|
| `channels.enabled` | `true` | Send to the Slack, Discord, webhook and email channels at all. |
| `channels.timeout_seconds` | `5` | How long one request may take (1 to 30). |
| `channels.max_attempts` | `4` | Tries per message for a timeout, rate limit or server error. |
| `channels.pause_after_failures` | `5` | Pause a channel after this many messages in a row fail for good. `0` never pauses. |
| `channels.log_days` | `14` | How long each channel's delivery log is kept. |

## Related

- [Installation](../installation)
- [CLI](../cli)
- [Troubleshooting](../troubleshooting)
