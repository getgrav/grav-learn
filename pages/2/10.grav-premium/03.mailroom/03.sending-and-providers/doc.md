---
title: Sending and Providers
taxonomy:
    category: docs
description: How Mailroom's mail leaves through the Email plugin, who it comes from, how fast it goes, the headers it carries, and the provider webhooks that report deliveries, bounces and complaints.
---

# Sending and Providers

Mailroom does not talk to a mail server itself. Every campaign, confirmation and automation email is handed to the Grav Email plugin, which sends it through whatever transport you gave it: SMTP, or a transport plugin for a provider such as SMTP2GO, Amazon SES, SendGrid, Postmark, Mailgun, MailerSend or Resend. This page covers the **Sending** and **Providers** tabs of Mailroom's settings.

## Can this site send mail?

The card at the top of the **Sending** tab reads the Email plugin and says:

- whether it is installed and sending ("The Email plugin is configured and sending."), and which **Engine** it uses;
- whether the one-click **Unsubscribe headers** reach that transport. Most do; a transport that drops custom headers stops Gmail showing its Unsubscribe button, and the card says so.

Below the sending rate, **The queue worker** card says when the worker last ran. A campaign is one job on Mailroom's queue, so nothing goes out unless the worker is running (see [Jobs and cron](../jobs-and-cron)).

## Who mail comes from

| Setting | Label | What it does |
|---|---|---|
| `from_name` | From Name | The name campaigns are sent as. Empty uses the Email plugin's. |
| `from_email` | From Address | The address campaigns are sent from. Empty sends as the Email plugin's From address. |

Either way it has to be an address your mail provider lets you send as. The "no From address" banner, the `status` warning and the Health check appear only when neither Mailroom nor the Email plugin has one.

A campaign can override both, and add a **Reply-to**, in the campaign editor (see [Campaigns](../campaigns#who-it-comes-from)). A list can carry its own From name and address too, set through the API (`from_name` and `from_email` on the list, see [REST API](../rest-api#lists-and-tags)); the list's page shows it as **Sends as**.

## How fast the site sends

| Setting | Label | Default | What it does |
|---|---|---|---|
| `sending.per_minute` | Messages Per Minute | `60` | The most this site sends in a minute, across every campaign at once. Set it to what your mail provider is comfortable with. |
| `sending.batch` | Recipients Per Run | `50` | How many people one run of the send job takes on before it hands the worker back. Smaller means pausing responds sooner. |
| `sending.abort_after_failures` | Stop After Consecutive Failures | `25` | The circuit breaker. After this many refused sends in a row the campaign stops itself; one success resets the count. |

A campaign that stopped itself shows the status **Stopped** and a dashboard banner ("The campaign ... stopped itself"). Fix the mail settings and press **Resume**: nobody who already received it gets it twice.

The Health screen's **Sending rate** check warns when the rate is zero (read as one message a minute) or higher than a single Grav worker and most provider plans manage.

## What Mailroom sends

Three switches in **What Mailroom Sends**, each on by default. Off stops that kind of message without touching anything else.

| Setting | Label | Covers |
|---|---|---|
| `messages.confirmation` | Confirmation Emails | The double opt-in email. Off, nobody new can confirm. |
| `messages.campaign` | Campaigns | Every campaign. A heavier switch than pausing one. |
| `messages.flow_email` | Automation Emails | The emails automations send, separate from campaigns. |

## Headers on campaign and automation mail

Each campaign and automation email carries:

- `List-Unsubscribe`, with a `mailto:` form of your From address and the HTTPS unsubscribe link, and `List-Unsubscribe-Post: List-Unsubscribe=One-Click`. Together they put the mail client's own Unsubscribe button next to your name (see [Unsubscribe and preferences](../unsubscribe-and-preferences)).
- `Precedence: bulk`.
- A `Message-ID` of its own, and `X-Mailroom-Campaign` with the campaign's id.
- `X-Grav-Send-Id`, which the provider webhooks use to match an event to the message it is about.

Every message Mailroom hands the Email plugin is also written to Mailroom's own message log (who, what, when, its first open and bounce), and a job that runs twice never sends the same message twice. The log is kept for **Keep the Message Log For** (`mail_log.retain_days`, 180 days).

## Provider webhooks

A provider can tell your site what happened to each message: delivered, bounced, marked as spam. Without it, Mailroom knows what it handed over and what your readers opened and clicked, but not what landed. The **Providers** tab has a card for each transport plugin on the site that can report deliveries.

> [!NOTE]
> Provider cards need the Email plugin's provider support and an up-to-date transport plugin for the service you send through. With neither, the tab says "No transport plugin on this site can report deliveries" and names what to update. Sending still works either way.

### Set one up

1. Open Mailroom's **Settings**, then the **Providers** tab, and find the card for your provider.
2. Press **Generate a secret**. The card shows the **Webhook URL**, in the form `https://www.example.com/newsletter/webhook/{provider}/{secret}`.
3. If the card has a **Set up in** button for your provider, press it: the webhook is created through the provider's API with the key already in its transport plugin's settings. Otherwise press **Copy the URL**, open **How to set this up**, and create the webhook in the provider's dashboard as it says, with the events it names.
4. If the provider signs its webhooks, the card needs the signing key in that transport plugin's own settings. Until it is there the card reads **Needs a key** and every event would be refused.

Each card has a state: **Ready** (a secret is set and whatever the provider signs with is present), **Needs a key**, or **Not set up**. It also says whether events are **Signed** or "Not signed, so the secret in the URL is what protects it", and when the last event arrived.

> [!WARNING]
> **Generate a new secret** changes the URL. The webhook already registered with the provider then posts to an address that answers 404, and its events are lost until you paste the new URL in (or press **Set up again in**).

### SMTP2GO

SMTP2GO signs nothing, so the secret in the URL is the whole of its protection. If you add an `Authorization` header to the webhook in SMTP2GO's dashboard, put the same full header value in `providers.smtp2go.auth_header` in `user/config/plugins/mailroom.yaml` (YAML only) and Mailroom checks it on every event.

### What the webhook answers

| Status | When |
|---|---|
| `200` | The event was read and recorded, or the payload could not be read at all (logged with its first 500 bytes, and answered 200 so the provider does not retry it for days). A `HEAD` probe gets 200 too. |
| `401` | The signature did not check out against the key in the transport plugin's settings. One log line a minute at most. |
| `404` | No transport plugin answers for that provider, it cannot report deliveries, or the secret is wrong. The three look the same on purpose. |
| `405` | A `GET`, such as the URL pasted into a browser. |
| `429` | More than **Webhook Requests Per Hour** (`rate_limits.webhook`, 6000) from one address. |

### What each event does

| Event | The send | The subscriber |
|---|---|---|
| Delivered | Marked delivered | Nothing |
| Hard bounce | Marked bounced | Status **Bounced**, off every list, address suppressed as a hard bounce |
| Soft bounce | Marked bounced | Counted: three soft bounces in thirty days count as a hard one |
| Refused (the provider would not send the message, such as a quota) | Marked bounced | Nothing, since nothing was said about the address |
| Complaint (the spam button) | Marked complained | Status **Complained**, off every list, address suppressed |
| Open, click | Filled in where Mailroom's own pixel or redirect did not | Nothing |

Every event carries a key of its own, so a webhook the provider sends again is recorded once, and one temporary failure delivered three times is never three soft bounces. What a provider said about a message is kept with the address's hash and without the address itself.

To see what a saved payload would do, replay it:

```bash
bin/plugin mailroom webhook:replay mailgun payload.json          # say what it would do
bin/plugin mailroom webhook:replay mailgun payload.json --apply  # do it
```

See [CLI](../cli#webhook-replay).

### When it goes quiet

The Health screen's **Bounce webhook** check, and a dashboard banner, speak up when a webhook is configured and campaigns have gone out but no event has arrived for days, and when something posts to a provider's webhook that has no secret yet ("Something is posting to the ... webhook"). See [Troubleshooting](../troubleshooting#provider-events-do-not-arrive).

## Related

- [Deliverability](../deliverability)
- [Campaigns](../campaigns)
- [Unsubscribe and preferences](../unsubscribe-and-preferences)
- [Configuration](../configuration#sending)
