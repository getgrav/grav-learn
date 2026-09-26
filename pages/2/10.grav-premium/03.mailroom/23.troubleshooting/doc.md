---
title: Troubleshooting
taxonomy:
    category: docs
description: Start from status and the Health screen, then fix the common problems - no site URL, the worker not running, mail not arriving, provider webhooks refused, signups rate limited, and people who cannot be added.
---

# Troubleshooting

Most problems come down to three things: the worker is not running, Mailroom does not know the site's address, or the mail is leaving but not landing. Start with the status report, then find your symptom below.

## Start here

Three places say what is wrong, in the same words:

- `bin/plugin mailroom status` on the server: the database, the schema, the route base, the Email plugin, the From address, the site URL, the queue and the worker, with a warning and a fix for each problem. It exits `1` when there is one.
- The **Health** screen in Mailroom (or `bin/plugin mailroom deliverability:check`): your domain's DNS, the transport, the worker, the site URL and your bounce and complaint rates.
- The banners on the Admin Next dashboard, for anybody who can read Mailroom.

## The site URL is not set

The banner "Mailroom does not know this site's address", the `status` warning, or a failing **Site URL** check means neither Mailroom's **Site URL** nor Grav's **Custom Base URL** is set. Links in email need an absolute address, and a visitor's request is never trusted to name it, so confirmation emails and everything the worker sends wait on the queue. One line in Grav's log says so.

- Open Mailroom's **Settings**, then **Public Pages**, and set **Site URL** to the address people use, such as `https://www.example.com`.
- Or simply open the Admin Next dashboard or Mailroom's page as an admin who can manage Mailroom over HTTPS: Mailroom fills it in from the address you came in on. It does not over plain HTTP on a public host; set it by hand there.

The emails that were waiting go out on the next worker run. See [Getting started](../getting-started#check-the-site-url).

## Nothing is sending

Campaigns, automations, scheduled sends, retries and imports need the worker. If `status` says "The worker has never run" or "has not run for N minutes", Grav's scheduler is not being called.

1. Add the scheduler to the crontab of the user the site runs as, with a `PATH` line (see [Jobs and cron](../jobs-and-cron#set-up-cron)). `status` prints the exact line.
2. Run `bin/grav scheduler -d` to see each job's errors. `env: php: No such file or directory` means the `PATH` line is missing or wrong.
3. Check **Run From Grav's Scheduler** (`worker.scheduler`) is on, unless you run the worker another way.
4. Run `bin/plugin mailroom work` by hand to send what is waiting now.

A confirmation email that goes out while campaigns do not is this problem: confirmations are sent right after the signup's own request, and everything else needs the worker.

## Confirmation emails do not arrive

1. Check the person is in **Subscribers** as **Waiting to confirm**. If they are not, the signup never reached Mailroom (see [Signups are refused](#signups-are-refused)).
2. Check Mailroom knows the site's address (above); without it, confirmations wait.
3. Check **Confirmation Emails** (`messages.confirmation`) is on, on the **Sending** tab.
4. Check the Email plugin sends: `bin/plugin email test-email --to=you@example.com`.
5. Look in the spam folder, and at the **Health** screen's domain checks.

A confirmation link older than seven days has expired; the person signs up again for a fresh one.

## Campaigns go out but do not land

- **The campaign says Stopped.** Too many sends in a row were refused, so it stopped itself. The dashboard banner links to it. Fix the Email plugin's transport, then **Resume**; nobody who received it gets it twice.
- **No From address.** "No From address is set, in Mailroom or the Email plugin": set one on the **Sending** tab or on the Email plugin. Most transports refuse mail with no sender.
- **The domain checks fail.** Open **Health** and fix SPF, DKIM and DMARC as each check says, then **Check again**. See [Deliverability](../deliverability).
- **A high bounce rate.** Usually an imported list from somewhere stale. Every hard bounce is already suppressed once a provider webhook reports it; without a webhook, bounces are not recorded at all.

## Links in email point at the wrong address

Links start with **Site URL**, then Grav's **Custom Base URL**. If Mailroom filled **Site URL** in from an admin visit at another address (a staging name, say), change it on the **Public Pages** tab. Links already mailed keep the address and route base they were sent with.

## Provider events do not arrive

Start with the provider's card on the **Providers** tab, and what the provider says it got back when it posted:

| Status | Meaning |
|---|---|
| `404` | The address is wrong: the secret was regenerated (the card says "The secret changed on ..."), the provider's transport plugin is missing or out of date, or it cannot report deliveries. Copy the URL again from the card, or press **Set up again in**. |
| `401` | The signature was refused. The card reads **Needs a key**, or the key in the transport plugin's settings is not the one the provider signs with. Copy the signing key again into that plugin's settings. |
| `405` | Something sent a `GET`. Providers post; a browser gets this. |
| `429` | More than **Webhook Requests Per Hour** from one of the provider's addresses. Raise it, or set `0`. |

The dashboard also speaks up:

- "... has said nothing in N days": a webhook is configured and campaigns went out, but no event arrived. The webhook is not really pointed here, or its events are not checked in the provider's dashboard.
- "Something is posting to the ... webhook": a provider is posting to a card that has no secret yet, so its events are thrown away. Press **Generate a secret** and paste the new URL into the provider. If it was not you, it goes away on its own.

To see what a saved payload does, replay it with `bin/plugin mailroom webhook:replay <provider> <file>` (see [CLI](../cli#webhook-replay)): it names the send row it matched and what it would change.

## Signups are refused

| Answer | Why | Fix |
|---|---|---|
| `429`, "That is a few too many tries." | More than **Signups Per Hour** from one visitor address. | Behind a proxy, load balancer or relay, every visitor looks like one address: list it in **Trusted Proxies** (see [Subscribe API](../subscribe-api#behind-a-proxy-or-a-relay)). If something in front of the site already limits signups, set the limit to `0`. |
| `415` | A form post without the site's nonce. | Post JSON, or keep the `nonce` field the signup partial draws. |
| `422`, `consent_required` | The site has a **Consent Sentence** and the box was not checked (or `consent` was not sent). | Send `"consent": true` from a relay that showed the sentence and had it checked. |
| `422`, `list_required` | A form that offers lists to check was sent with none checked. | Check at least one. |

## Somebody cannot be added to a list

The admin says why:

- "This address is on the suppression list, so it is never mailed." Remove it on the **Suppressions** tab first, and only when you know why it landed there.
- "They left it themselves." They unsubscribed by a link, their mail client's button, the preference center or a spam complaint. If they have asked to come back, use **Put them back on** with a note saying how they asked. See [Double opt-in and consent](../double-opt-in-and-consent#leaving-by-their-own-hand).

## The unsubscribe button does not show in Gmail

"The unsubscribe button is not reaching inboxes" means your transport drops the `List-Unsubscribe` headers. The card on the **Sending** tab says which transport; an SMTP2GO transport older than 1.0.1, for example, drops them. Update the transport plugin, or switch it to its SMTP transport where it has one.

## A segment could not be counted

"The segment ... could not be counted" usually means a condition names a field from something no longer installed. Open the segment, fix or remove the condition marked "(no longer available)", and save. `bin/plugin mailroom segments:count --id=<id>` recounts it and says whether it worked.

## An import will not start

"This site has no job queue running, so an import cannot be started." Imports run on the worker; see [Nothing is sending](#nothing-is-sending). For a large file, `bin/plugin mailroom import:csv` runs in the foreground instead.

## Migrations are waiting

On MySQL or PostgreSQL, a new version's table changes wait for `bin/plugin mailroom migrate` unless **Update the Tables** is **By itself, on every database**. Until then, the worker and most commands refuse to run. Run `bin/plugin mailroom migrate --status` to see what is waiting, then `bin/plugin mailroom migrate`.

## The database is downloadable on nginx or Caddy

The deny-all `.htaccess` in `user/data/mailroom/` only protects the SQLite file on Apache. On other servers, deny `user/data/` in the server config. For nginx:

```nginx
location ^~ /user/data/ { deny all; }
```

## Related

- [Jobs and cron](../jobs-and-cron)
- [Deliverability](../deliverability)
- [Sending and providers](../sending-and-providers)
- [CLI](../cli)
