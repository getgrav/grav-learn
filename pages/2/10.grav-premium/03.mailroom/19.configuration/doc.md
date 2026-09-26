---
title: Configuration
taxonomy:
    category: docs
description: Every Mailroom setting, tab by tab, with its label, default and what it does.
---

# Configuration

This page lists every Mailroom setting, grouped by the tab it lives on. Settings live in `user/config/plugins/mailroom.yaml` and are edited on the **Settings** tab of Mailroom's page in Admin Next (the **Settings** button above the page and the plugin's **Configure** button both open it). The defaults ship in the plugin's own `mailroom.yaml`.

Some things are not settings at all: lists, tags, segments, templates, campaigns, automations and suppressions are made on Mailroom's own screens and stored in its database.

## Tab map

| Tab | Controls |
|---|---|
| Sending | Whether mail can leave, how fast, who it comes from, and the three kinds of message |
| Email Design | The email layout's logo, colors, footer text and postal address |
| Tracking | Opens, clicks, how long detail is kept, and link tagging |
| Signup | Double opt-in default, the consent sentence, import files |
| Public Pages | The site URL, the route base, the page template, the confirmation page, rate limits and trusted proxies |
| Segments | How often segments are recounted |
| Automations | Running automations and how many people move per run |
| Health | The deliverability checks' overrides and the bounce-rate alert |
| Providers | The provider webhook cards |
| Advanced | The database and the worker |

`enabled` is the plugin status switch above the tabs.

## Sending

See [Sending and providers](../sending-and-providers). The tab opens with the **Can this site send mail?** card and has **The queue worker** card under the sending rate.

| Key | Label | Default | What it does |
|---|---|---|---|
| `sending.per_minute` | Messages Per Minute | `60` | The most this site sends in a minute, across every campaign. |
| `sending.batch` | Recipients Per Run | `50` | How many people one run of the send job takes on before it hands the worker back. |
| `sending.abort_after_failures` | Stop After Consecutive Failures | `25` | Refused sends in a row before a campaign stops itself. One success resets the count. |
| `from_name` | From Name | empty | The name campaigns are sent as. Empty uses the Email plugin's. A campaign can use a different one, set in its editor, and so can a list, through the API. |
| `from_email` | From Address | empty | The address campaigns are sent from. Empty uses the Email plugin's From. |
| `messages.confirmation` | Confirmation Emails | On | Send double opt-in emails. Off, nobody new can confirm. |
| `messages.campaign` | Campaigns | On | Send campaigns. |
| `messages.flow_email` | Automation Emails | On | Send the emails automations send. |

## Email Design

See [Templates and branding](../templates-and-branding).

| Key | Label | Default | What it does |
|---|---|---|---|
| `branding.logo` | Logo | empty | An image URL or a path on this site. Empty prints the site's name. |
| `branding.logo_width` | Logo Width (pixels) | `160` | How wide the logo is drawn (16 to 600). |
| `branding.accent` | Accent Color | empty | Links, the confirmation button and the rule under the header, and the buttons and links on the public pages and signup box. Empty is teal in email, and your theme's accent on the pages where the theme has one. |
| `branding.background` | Background Color | `#f4f5f7` | What the card sits on. |
| `branding.text` | Text Color | `#222222` | The color of the message. |
| `branding.footer_text` | Footer Text | empty | A line or two under every message, branded or plain. Plain text. |
| `branding.postal_address` | Postal Address | empty | Printed at the foot of every message, branded or plain, and in its plain-text part. |

## Tracking

See [Reports and tracking](../reports-and-tracking).

| Key | Label | Default | What it does |
|---|---|---|---|
| `tracking.opens` | Track Opens | On | Add the open pixel to campaigns. A new campaign starts from this, and can say otherwise. |
| `tracking.clicks` | Track Clicks | On | Send campaign links through the click redirect. A new campaign starts from this, and can say otherwise. |
| `tracking.retain_days` | Keep Detail For (days) | `365` | How long individual clicks and provider events are kept. Totals survive. |
| `utm.enabled` | Tag Campaign Links | On | Add UTM parameters to links back to your own site. |
| `utm.source` | Source | `newsletter` | `utm_source`. |
| `utm.medium` | Medium | `email` | `utm_medium`. |
| `utm.campaign` | Campaign | empty | `utm_campaign`. Empty uses each campaign's name. |
| `utm.content` | Content | empty | `utm_content`. |

## Signup

See [Double opt-in and consent](../double-opt-in-and-consent) and [Import and export](../import-and-export).

| Key | Label | Default | What it does |
|---|---|---|---|
| `double_opt_in` | Ask People to Confirm | On | The default for a new list. Each list has its own. |
| `consent_text` | Consent Sentence | "I agree to receive email from this site. I can leave with one click at any time." | The wording beside the box to tick. A hash of it is stored with each person who agrees, or of a signup box's own sentence when it shows one. Empty asks for no consent. |
| `import.keep_days` | Keep Uploaded Files For (days) | `30` | How long an uploaded contact list stays on disk if its import never ran. `0` keeps them. |

## Public Pages

See [Lists and signup forms](../lists-and-signup-forms#the-public-pages) and [Subscribe API](../subscribe-api).

| Key | Label | Default | What it does |
|---|---|---|---|
| `site_url` | Site URL | empty | The address every link in email starts with, such as `https://www.example.com`. Empty uses Grav's Custom Base URL, and is filled in by the first admin visit when neither is set. |
| `route` | Route Base | `/newsletter` | Where the public pages answer. Set it before the first campaign goes out. |
| `pages.base_template` | Page Template | empty | The theme template the public pages extend. Empty uses `partials/base.html.twig`. |
| `pages.builtin_css` | Mailroom Stylesheet | On | Mailroom's small stylesheet on every front-end page, for the public pages and the signup box wherever it is. Every rule in it is scoped to Mailroom's own classes. |
| `confirm.on_get` | Confirm on Opening the Link | Off | Confirm on opening the link. Leave it off. |
| `confirm.auto_submit` | Press the Button for Them | On | The confirmation page presses its own button from a script. |
| `rate_limits.subscribe` | Signups Per Hour | `10` | Signups from one visitor address in an hour. `0` turns the limit off. |
| `rate_limits.token` | Link Pages Per Hour | `60` | Confirm, unsubscribe, preference and web view pages per visitor address. |
| `rate_limits.tracking` | Opens and Clicks Per Hour | `600` | The pixel and the click redirect per visitor address. Keep it high. |
| `rate_limits.webhook` | Webhook Requests Per Hour | `6000` | Provider webhook requests per address. Keep it high. |
| `security.trusted_proxies` | Trusted Proxies | `[]` | Addresses or CIDR ranges whose `X-Forwarded-For` is believed. |

## Segments

See [Tags and segments](../tags-and-segments#counts).

| Key | Label | Default | What it does |
|---|---|---|---|
| `segments.count_every_minutes` | Recount Segments Every | `15` | Minutes between recounts. `0` recounts on every worker run. |

## Automations

See [Automations](../automations).

| Key | Label | Default | What it does |
|---|---|---|---|
| `automations.enabled` | Run Automations | On | Off holds every automation at once. Nobody is taken out. |
| `automations.per_tick` | People Moved Per Run | `200` | How many people one run of the automation tick moves on by a step (1 to 1000). |

## Health

See [Deliverability](../deliverability).

| Key | Label | Default | What it does |
|---|---|---|---|
| `deliverability.sending_domain` | Sending Domain | empty | The domain your DNS records live on, when it is not the one in your From address. |
| `deliverability.dkim_selector` | DKIM Selector | empty | The DKIM selector, when the transport cannot name it. Two, comma separated, during a rotation. |
| `deliverability.return_path` | Custom Return Path | empty | Your custom return-path host, when the SPF check keeps failing on a domain you know is set up. |
| `alerts.bounce_rate_percent` | Bounce Rate That Raises an Alert | `5` | A dashboard banner when more than this percentage of the last thirty days' mail bounced. |

## Providers

The tab has only the provider cards (see [Sending and providers](../sending-and-providers#provider-webhooks)). Their buttons write under `providers.<name>` in `mailroom.yaml`:

| Key | What it is |
|---|---|
| `providers.<name>.secret` | The random path secret in that provider's webhook URL, written by **Generate a secret**. Never typed by hand. |
| `providers.<name>.webhook_id`, `webhook_events`, `set_up_at`, `secret_at`, `webhook_dead_at` | What **Set up in** registered and when, so the card can say so. |
| `providers.smtp2go.auth_header` | YAML only. The full `Authorization` header value, when you add one to the webhook in SMTP2GO's dashboard. |

Provider signing keys live in each transport plugin's own settings, not here.

## Advanced

See [Installation](../installation#the-database) and [Jobs and cron](../jobs-and-cron).

| Key | Label | Default | What it does |
|---|---|---|---|
| `database.type` | Database | `sqlite` | `sqlite`, `mysql` (MySQL or MariaDB) or `pgsql` (PostgreSQL). Changing it points at a different, empty database. |
| `database.auto_migrate` | Update the Tables | `sqlite` | `sqlite` (by itself on SQLite, from the command line otherwise), `auto` (by itself on every database) or `manual` (only from the command line). |
| `database.sqlite.path` | SQLite File | empty | Empty keeps it at `user-data://mailroom/mailroom.sqlite`. A stream path or an absolute path. |
| `database.mysql.host`, `.port`, `.unix_socket`, `.dbname`, `.username`, `.password` | Host, Port, Socket, Database Name, Username, Password | `localhost`, `3306` | MySQL or MariaDB. A socket, when set, is used instead of the host and port. |
| `database.pgsql.host`, `.port`, `.dbname`, `.username`, `.password`, `.sslmode` | Host, Port, Database Name, Username, Password, SSL Mode | `localhost`, `5432` | PostgreSQL. SSL Mode is the server's default, `disable`, `allow`, `prefer`, `require`, `verify-ca` or `verify-full`. |
| `worker.scheduler` | Run From Grav's Scheduler | On | Run the worker from Grav's scheduler every minute. |
| `worker.inline_drain` | Send Right After the Request | On | Run the jobs a request queued after its response. |
| `worker.inline_budget_seconds` | Seconds After a Request | `3` | How long that drain may run (1 to 30). |
| `worker.job_timeout_seconds` | Longest One Job May Run (seconds) | `120` | A job past this is stopped and tried again. `0` turns the limit off. |
| `worker.retain_days` | Keep Finished Jobs For (days) | `30` | Finished and failed jobs are swept after this many days. |
| `mail_log.retain_days` | Keep the Message Log For (days) | `180` | Message log rows are swept after this many days. `0` keeps them. |

## Related

- [Installation](../installation)
- [CLI](../cli)
- [Troubleshooting](../troubleshooting)
