---
title: Inbound Email
taxonomy:
    category: docs
description: Receive replies and new tickets by email through a provider webhook, your own mail server or an IMAP mailbox, with reply addresses and the inbound log.
---

# Inbound Email

With inbound email on, clients and staff answer Helpdesk Pro's emails by replying to them, and a new email to your support address opens a ticket. This page covers the receivers, reply addresses, how an email finds its ticket, how replies are cleaned up, and the inbound log.

## Before you begin

- Inbound email needs **Email plugin 5.3.0 or later**. With an older Email plugin everything else keeps working: **Operations → Email** says "Inbound email needs Email plugin 5.3.0 or later", and the webhook answers `503` so providers keep the mail and retry.
- [Outbound email](../outbound-email) is working, and `email.support_address` is set.
- Cron runs the Grav scheduler (see [Jobs and cron](../jobs-and-cron)).

## Set up inbound email

1. Set `email.support_address` to the address clients write to, or `inbound.address` when mail reaches you at a different address (see [Which address](#which-address)). Without either, mail sent to your support address is not recognised as the helpdesk's own.
2. On the plugin's settings page, open **Email & Notifications → Inbound Email**. Turn on `inbound.enabled` and pick a receiver (`inbound.receiver`, below).
3. Set `inbound.secret` to at least 32 random characters, for example the output of `openssl rand -hex 24`. The secret is part of the webhook address and is the only thing protecting it, so treat it like a password.
4. In the desk, open **Operations → Email**, copy the webhook address, and paste it into your provider's inbound settings, following the steps shown beside it.
5. Send an email to your support address. It appears in **Operations → Inbound log** within seconds, and opens a ticket.

To have Helpdesk Pro read a mailbox instead of receiving a webhook, set the receiver to `imap` and see [Read a mailbox over IMAP](#read-a-mailbox-over-imap).

### Receivers

| `inbound.receiver` | Where the mail comes from | What checks it |
|---|---|---|
| `generic` | Anything you run yourself: an MTA pipe script, a relay, a test with `curl`. It posts the raw email, signed. | The Email plugin's signed raw format: `X-Grav-Signature: t={unix},v1={hex}` (HMAC-SHA256 over `{t}.{body}` with `inbound.signing_secret`, five minutes' tolerance), and optional `X-Grav-Envelope-To` and `X-Grav-Envelope-From` headers. |
| `cloudflare` | Cloudflare Email Routing with a small Email Worker. Free, and needs no mail server. | The same signed format. The Email plugin's Cloudflare guide has the Worker's source and each step. |
| `postmark`, `mailgun`, `sendgrid`, `ses`, `resend`, `mailersend` | That provider's inbound webhook. Needs the provider's Email plugin (for example Email Postmark) at a version with inbound support. | The provider's own verification, configured in that provider plugin's settings. |
| `imap` | A mailbox Helpdesk Pro reads. | Your mail server's login. |

`generic` and `cloudflare` are always accepted at the webhook address alongside the chosen receiver, so a test with `curl` works whatever provider you use. `inbound.signing_secret` is their HMAC secret; left blank, `inbound.secret` is used. A signing secret shorter than 32 characters is listed as a problem, and the receiver refuses every request until it is longer or cleared.

### The webhook address

The address is `{site}{inbound.route}/{receiver}/{inbound.secret}`, for example `https://example.com/_helpdesk/inbound/postmark/9f6c…`. It answers before Grav builds a page, so it stays fast on a busy site.

| Status | When |
|---|---|
| `200` | The email is stored (processing runs after the answer), was stored before (a provider retry), or is unreadable and logged as `rejected`, so the provider stops retrying. |
| `401` | The provider's signature or credentials were refused. Logged at most once every ten minutes per receiver. |
| `404` | Inbound is off, the receiver is not this site's, or the secret is wrong. No body. |
| `405` | Not a `POST`. |
| `413` | Larger than `inbound.max_bytes`. |
| `429` | More than 300 requests a minute from one IP address. |
| `503` | The Email plugin has no inbound support, or the email could not be stored (disk full). The provider keeps it and retries. |

- **Mailgun**: use the address ending in `/mime` (**Operations → Email** shows it that way). A Mailgun route that forwards to a URL ending in `mime` posts the whole raw email, which keeps attachments and threading headers exactly as sent.
- **Amazon SES** through SNS: the subscription confirmation is fetched automatically (only from an Amazon host), and an email SES marks as carrying a virus is rejected before it is read. A message SES stored in S3 is fetched afterwards by the `inbound.fetch` job.
- **Resend**: its webhook carries only an id, so the message is fetched afterwards by the `inbound.fetch` job.

The query string is never part of the match, so a provider that adds its own parameters still reaches the endpoint.

### Post a test email with curl

Sign a raw email with the Email plugin's `SignedRawReceiver::sign()`:

```php
use Grav\Plugin\Email\Providers\Inbound\Receivers\SignedRawReceiver;

$raw = file_get_contents('reply.eml');
$signature = SignedRawReceiver::sign($raw, $signingSecret); // "t=…,v1=…"
```

```bash
curl -X POST "https://example.com/_helpdesk/inbound/generic/$SECRET" \
  -H "Content-Type: message/rfc822" \
  -H "X-Grav-Signature: $SIGNATURE" \
  -H "X-Grav-Envelope-To: support+t8f2k@example.com" \
  --data-binary @reply.eml
```

The desk's **Try an email** (below) does a dry run without posting anything.

### From your own mail server

A Postfix or Exim alias can hand each email straight to `inbound:feed`, which reads it from standard input:

```
support: "|/var/www/example.com/bin/plugin helpdesk-pro inbound:feed --no-process --to support@example.com"
```

`inbound:feed` exits `75` (temporary failure) when the email could not be stored or the Email plugin is too old, so the mail server keeps the email and tries again. See [CLI](../cli#inbound-feed).

## Read a mailbox over IMAP

When your mail provider has no inbound webhook, Helpdesk Pro can read a mailbox itself: Gmail or Google Workspace with an app password, Fastmail, iCloud, or the mailbox that came with your hosting. New mail goes through the same pipeline as webhook mail, so threading, the loop guard, staff reply tokens and the inbound log all work the same way.

A webhook is the better choice when you have one: it delivers in seconds and needs no password stored on the site. IMAP is the easy path for a small site with an existing mailbox.

1. Use a mailbox that only the helpdesk reads, such as `support@example.com`. Helpdesk Pro marks what it imports as read, so a person reading the same mailbox would miss mail.
2. Create an app password for it. Gmail and Google Workspace need 2-step verification turned on first, then **Google Account → Security → App passwords**. Fastmail and iCloud have the same under their security settings.
3. On **Email & Notifications → Inbound Email**, turn on `inbound.enabled` and set `inbound.receiver` to `imap`.
4. Under **IMAP Mailbox**, fill in `inbound.imap.host` (`imap.gmail.com`), `inbound.imap.username` (the full address) and `inbound.imap.password` (the app password).
5. Run `bin/plugin helpdesk-pro imap:poll --work` once. It reads the mailbox now, processes what it found, and prints the result or the server's error.

The poll is a recurring `imap.poll` job, booked every `inbound.imap.interval_seconds` while inbound is on, the receiver is `imap` and a host is set. Plus addresses (`support+t8f2k@example.com`) are delivered to the same mailbox by Gmail, Fastmail, iCloud and most hosts, and the token survives in the `To:` header.

How the poll works:

- Only mail that arrives after the first poll is fetched. The first poll takes the unread mail, and every poll after that takes each message newer than the last one imported, up to 50 at a time.
- Each email is stored, then marked read, and moved to `inbound.imap.processed_folder` when one is set (the folder is created if missing). A crash repeats at most one email, and that one is recognised as already received.
- If the server renumbers the mailbox (after some migrations), the poll starts again from the unread mail, and emails already received are skipped.
- An email larger than `inbound.max_bytes` is not downloaded. It is logged as `rejected` (`too_large`) and marked read.
- A failure to connect or log in waits 15 minutes before the next try. On the third failure in a row, admins get the `imap_failed` bell alert. The next successful poll resets the count.

The IMAP client is the Email plugin's own (pure PHP, no `ext-imap`). It verifies the server's certificate, and with `starttls` it never falls back to plain text.

## What happens to an email

The webhook, IMAP and `inbound:feed` all end in the same place. Each email is stored first (its raw bytes and a row in the inbound log) and processed by the `inbound.process` job, normally within the same second.

The same email arriving twice (a provider retry, the same email sent to two of your addresses, an IMAP message fetched again) is stored once, recognised by its Message-ID, the provider's id, or its bytes. Processing is also safe to repeat.

Processing runs these steps in order, and the first that decides the email ends it:

1. **The loop guard** drops mail no person wrote.
2. **An unsubscribe address** (`support+u{token}@…`) unsubscribes the sender.
3. **The sender** is found, and staff are told apart from clients.
4. **The ticket** is found, or a new one is opened.
5. **The reply is cleaned up** (see [How replies are cleaned up](#how-replies-are-cleaned-up)).
6. **The message is added** through the same services a reply in the desk or the portal uses, so activity, notifications, live updates and client emails follow as usual.

### The loop guard

Automatic mail is never added to a ticket and never answered, so two autoresponders can never mail each other forever.

| Reason | State | What it catches |
|---|---|---|
| `virus` | rejected | The receiving provider reported a virus. |
| `own_mail` | ignored | Mail from one of your own addresses (the support address, the From address, a project's email alias). |
| `bounce` | ignored | An empty envelope sender, a delivery report, or mail from `mailer-daemon` or `postmaster`. |
| `auto_submitted` | ignored | `Auto-Submitted` other than `no` (out-of-office replies, vacation notices). |
| `precedence` | ignored | `Precedence: bulk`, `junk`, `list` or `auto_reply`. |
| `auto_reply` | ignored | `X-Autoreply`, `X-Autorespond` or `X-Autogenerated`. |
| `mailing_list` | ignored | `List-Id` or `List-Unsubscribe`, unless it is a reply in one of your threads from a known person. |
| `rate` | rejected | More than `inbound.per_sender_per_hour` emails from one address in an hour. |

### Who sent it

The sender is the email's From address.

- An address Helpdesk Pro has never seen is a new client. Their person record is created only if a ticket is opened for them.
- A blocked person's email is rejected (`blocked`).
- **Staff are staff only with their own reply token.** Staff notification emails carry a reply address issued to that staff member. An email to it from that staff member posts as them: a public reply when the notification was about a reply or a ticket, an internal note when it was about a note. Any other email from a staff member is treated like a client's, so a client can never add an internal note by email.
- A staff reply whose sender could not be verified (DMARC failed, or with no DMARC result neither DKIM nor SPF passed) is **held** (`unverified_staff`) instead of posted. An admin releases it from the inbound log once they know it is genuine.
- An unknown sender writing to a staff note address is rejected (`token_mismatch`).

### Which ticket

| Path | How |
|---|---|
| `in_reply_to` | The `In-Reply-To` header names one of your emails. |
| `references` | The `References` header names one of your emails, newest first. |
| `root_id` | A `References` entry is a ticket's thread root (`hd.{ticket}.root@…`). |
| `token` | The address carries a reply token (`support+t{token}@…`). Survives mail apps that drop threading headers. |
| `ref` | The invisible `ref:{ticket}.{signature}` marker your HTML emails carry. The signature is checked, so it cannot be guessed. |
| `new` | None of the above: a new ticket. |

A match is used only when the sender may add to that ticket: they are its requester or a cc, the token was issued to them, or (with `inbound.cc_join`) you emailed them about it. Anyone else writing into a thread (a forwarded email, someone never on it) opens a new ticket of their own. A merged ticket's email goes to the ticket it was merged into; a deleted ticket matches nothing.

A reply to a resolved ticket reopens it. A reply to a closed ticket opens a new ticket whose first activity links to the closed one. A staff reply to a ticket they no longer have access to is rejected (`no_access`); a client's becomes a new ticket.

### New tickets by email

A new ticket goes to the project whose email alias (Setup → Projects) is in the email's To, Cc or envelope, else to `inbound.default_project` (a project slug), else to the first project. One address may open at most `inbound.new_tickets_per_sender_per_hour` tickets by email in an hour (`new_ticket_rate`). With `inbound.cc_join`, other people in the email's To and Cc become cc's on the new ticket. The client gets the `client-received` acknowledgement while `email.acknowledge_email_tickets` is on.

Required custom fields are not enforced for tickets that arrive by email.

### Attachments and inline images

Attachments follow the same rules as uploads (`attachments.enabled`, the allowed extensions and `attachments.max_mb`, see [Attachments](../attachments)), at most `inbound.max_attachments` from one email. `winmail.dat` (Outlook's TNEF wrapper) and small inline images the kept text does not show (signature logos under 2 KB) are skipped. Every skipped file, and why, is listed in the inbound log.

The `client-received` acknowledgement for a request opened by email says which files arrived and, for each file that was not kept, why: "too large (limit 25 MB)", "that file type isn't accepted", "too many files (limit 20)", "files aren't accepted by email" or "the file couldn't be read".

An image pasted into an email (a `cid:` inline attachment) is kept with its content id and shown in place in the message, in the desk and the portal, through the same access-checked file routes as any file. Nobody ever sees a `cid:` address. A reader who may not open the file sees only its name.

## Reply addresses

While inbound email is on and can receive, every email Helpdesk Pro sends about a ticket asks for replies at an address made for that recipient and ticket:

```
Reply-To: support+t4k2qz7mfa9xw3hb@example.com
List-Unsubscribe: <https://example.com/help/unsubscribe?p=…>, <mailto:support+u4k2qz7mfa9xw3hb@example.com?subject=unsubscribe>
```

The part after `+t` is a reply token: 16 random letters and digits, issued the first time a person is emailed about a ticket and reused for every later email about it. The token alone finds the ticket and the person, so a reply matches even when the mail app dropped the threading headers. It is also what makes a staff reply count as staff.

| Email | Token audience | A reply to it becomes |
|---|---|---|
| Client email (`client-reply`, `client-received`, `client-resolved`, `client-triage`) | `client` | A public reply from the client. |
| A staff notification about one ticket | `staff` | A public reply from that staff member, emailed to the client like any reply. |
| The same, when it shows an internal note | `note` | An internal note. A quick reply to an email that shows a note can never reach the client by mistake. |
| Digests, batches that cover several tickets, and the test email | `digest` (one per staff member, naming no ticket) | Nothing. The email is logged as `ignored` (`reply_to_digest`). |

To answer a ticket from a digest, open it and reply there, or reply to that ticket's own notification. Only staff with a site account are issued `staff`, `note` and `digest` tokens. A client is only ever given a `client` token.

Mail to the `+u{token}` address unsubscribes its person: a client's token stops email about that request, and a staff token turns all of that staff member's Helpdesk email off.

### Which address

The address the token goes into is the first of these that is set:

1. `inbound.address`: set it when mail reaches you at a different address than the one you send from, such as a Cloudflare Email Routing address or a separate inbound domain.
2. The email alias of the ticket's project, so replies about a Billing ticket go to `billing+t…@`.
3. `email.support_address`.
4. The address mail is sent from (`email.from_address`, then the Email plugin's From).

Your provider or mail server must deliver mail for `{local}+anything@{domain}` to the same place as `{local}@{domain}`:

- **Cloudflare Email Routing**: turn on subaddressing (**Email Routing → Settings**). `support+t…@example.com` then follows the `support@example.com` rule.
- **Amazon SES**: a receipt rule recipient `support@example.com` also matches `support+anything@example.com`.
- **Other providers' inbound webhooks**: point the whole inbound domain, or a route that matches the plus form, at the webhook.
- **Your own mail server or an IMAP mailbox**: make sure `+detail` delivers to the base mailbox (Postfix `recipient_delimiter = +`; most hosted mailboxes do this by default).

### Without plus addressing

A mail system that rejects or strips `+detail` addresses cannot carry a token. Set `inbound.plus_addressing` to `false`, and Helpdesk Pro puts no token in any address. Replies still find their ticket through the threading headers and the hidden `ref:` marker, which is enough for almost every mail app.

What you lose: a reply from an app that drops both finds no ticket and opens a new one, staff replies by email are treated as a client's email, and there is no unsubscribe by email.

### When nothing changes

With `inbound.enabled` off, an Email plugin older than 5.3.0, or no way for mail to arrive (no webhook secret of 32 characters or more, or the `imap` receiver without a host), email is sent exactly as if inbound did not exist: no `Reply-To`, no mailto unsubscribe, no tokens issued, and client email says "View or reply to your request".

## How replies are cleaned up

An email reply carries more than the new words: the earlier conversation quoted below it, a signature, "Sent from my iPhone". Helpdesk Pro keeps only what the person wrote this time, so a ticket reads like a conversation. The message exactly as it arrived is always kept as well, behind **Show original**.

Helpdesk Pro uses the plain text part when it has any words in it, since plain text is already valid Markdown. It tidies Apple Mail's link leftovers (`https://example.com <https://example.com/>` becomes one link) and turns its invisible image marks into the inline images. When there is no usable text part, the HTML part is converted to Markdown.

The conversion never keeps anything a reader could not see or that would reach out to another server: `<style>`, `<script>`, `<head>` and hidden elements are dropped; a `javascript:` link keeps only its text; images loaded from the web keep only their alt text, so a tracking image in a client's email is never fetched when staff read the ticket; and 1×1 images are dropped.

### What is cut

Helpdesk Pro cuts at the first of these it finds, then removes a signature and a phone footer from what is left:

| Rule | What it finds |
|---|---|
| `gmail_quote` | Gmail's quoted history in HTML mail |
| `apple_cite` | Apple Mail's quote (`blockquote type="cite"`) |
| `outlook_reply`, `outlook_append`, `outlook_mac` | Outlook's reply header and quote in HTML mail |
| `yahoo_quoted` | Yahoo Mail's quote |
| `thunderbird_cite` | Thunderbird's "On … wrote:" and quote |
| `protonmail_quote` | Proton Mail's quote |
| `quote_header` | "On Mon, 22 Sep 2026 at 10:15, Jane wrote:" in plain text, also wrapped onto two lines, in English, German, French, Spanish, Dutch, Italian, Portuguese, Swedish, Danish, Norwegian, Polish and Japanese |
| `original_message` | `-----Original Message-----` and its translations |
| `outlook_header` | Outlook's `From: … Sent: … To: … Subject:` block |
| `quoted_block` | Lines starting with `>` at the end of the message, with the "Jane wrote:" line above them |
| `signature` | Everything after a `-- ` line, and Gmail's and Thunderbird's marked signatures |
| `mobile_footer` | "Sent from my iPhone", "Get Outlook for iOS" and similar, with common translations |

The rule that cut is recorded with the message, so the inbound log shows why a reply looks shorter than the email.

Some things are never cut:

- **An empty result.** If cutting would leave nothing and no quote was found (a body that is only a signature), the full text is kept.
- **Forwarded mail.** A message that forwards another ("---------- Forwarded message ---------", "Begin forwarded message:", or a subject starting "Fwd:" or "FW:") is kept whole.

> [!NOTE]
> Some people answer by writing between the lines of the quoted email. Helpdesk Pro keeps what they wrote above the first quote and cuts the rest, including answers further down. The full email is one click away under **Show original**.

### A reply with no new text

Some replies add nothing: the person pressed Reply and Send, or forwarded a notification back without writing. Such a message is stored as **"Replied without adding any text."** with the quote folded under **Show quoted text**.

It joins the thread quietly: it does not change the ticket's status, does not count as anyone answering, and nobody gets a bell or an email about it. To a closed ticket, or one the sender can no longer reply to, it adds nothing and opens no new ticket (logged as `ignored`, `no_new_text`).

## The Email screen

**Operations → Email** (`#/setup/email`, admins only) says how mail reaches the desk. At the top: whether inbound email is receiving, the receiver, when the last email arrived, and how many emails failed or are held. Anything that stops mail arriving is listed as a sentence ("No secret set, or it is shorter than 32 characters", "No support address is set") with a link to the settings tab where it is fixed.

- **Webhook address**: the address to paste into your provider, with the secret masked until **Reveal**, and **Copy**. A separate signing secret follows, with its own **Reveal** and **Copy**, and the receiver's setup steps.
- **Mailbox** (the `imap` receiver): the server and folder, when it was last read and when it is read next.
- **Replies**: the reply address your email asks replies to go to, with an example token, a line per project whose email alias takes over, and a reminder that your provider has to deliver `support+anything@` to the same place.
- **Try an email**: paste a whole email (an `.eml` file, or "Show original" from your mail app) and see what the desk would do with it: the loop guard, who sent it, which ticket it would go to, and the words it would keep. It saves nothing and emails nobody.

## The inbound log

Every email received gets a row in the inbound log, whatever happened to it, so "I emailed you and nothing happened" always has an answer. Admins see it under **Operations → Inbound log** (`#/setup/inbound-log`). The count beside it in the side menu is its failed and held emails.

| State | Meaning |
|---|---|
| `received` | Stored, waiting for the `inbound.process` job. |
| `processing` | Being processed now. |
| `appended` | Added to an existing ticket. |
| `created` | Opened a new ticket. |
| `held` | A staff reply that could not be verified, waiting for an admin to release it. |
| `ignored` | Automatic mail, an unsubscribe (`unsubscribed`), a reply to a digest (`reply_to_digest`), or a reply with no new text to a closed ticket (`no_new_text`). |
| `rejected` | Refused: `virus`, `rate`, `blocked`, `no_sender`, `token_mismatch`, `no_access`, `new_ticket_rate`, `no_project`, `too_large` or `unreadable`. |
| `failed` | Processing threw an error three times. Admins get a bell alert. |

Filter the list by state, or search by sender, subject or Message-ID. Opening an email shows each step processing ran (the loop guard, the sender and why it was held or refused, how its ticket was found, what the cleanup cut), the message it became, each attachment kept or skipped, the headers with the DMARC, DKIM and SPF results, and **Show original**.

- **Retry** processes a `failed` email again.
- **Process again** re-runs an `ignored` or `rejected` email, after you fix a setting, unblock a sender or add a project alias.
- **Release** lets a `held` staff reply through, posting as that staff member.

Process again and Release can post on a ticket, so they ask first.

The raw copy the log keeps is deleted after `privacy.inbound_raw_days` days (default 90; `0` keeps it). A message keeps its own original for as long as it exists, so **Show original** on a ticket still works.

## Routes and MCP tools

Under `/api/v1`. Everything but a message's original needs `helpdesk-pro.settings`.

| Route | Body or query | Answers | MCP tool |
|---|---|---|---|
| `GET /helpdesk-pro/inbound/log` | `state`, `q`, `page`, `per_page` | Rows, newest first | `list_inbound_log` |
| `GET /helpdesk-pro/inbound/log/{id}` | | The row with `detail`, `match`, `headers` and `message` | `get_inbound_entry` |
| `GET /helpdesk-pro/inbound/log/{id}/original` | | `{headers, text, size, format}`; `404` once the raw copy is deleted | `get_inbound_original` |
| `POST /helpdesk-pro/inbound/log/{id}/retry` | | The row, back to `received`; `409` for an email already on a ticket or held | `retry_inbound` |
| `POST /helpdesk-pro/inbound/log/{id}/release` | | The row with `released: true`; `409` unless it is held | `release_inbound` |
| `GET /helpdesk-pro/inbound/status` | | `enabled`, `available`, `receiver`, `webhook_url` (contains the secret), `steps`, `imap`, `counts`, `failed`, `held`, `last_received_at`, `problems` and `replies` | `get_inbound_status` |
| `POST /helpdesk-pro/inbound/test` | `{raw}`: a whole email as text | A dry run. Writes nothing. | `test_inbound` |
| `GET /helpdesk-pro/messages/{id}/original` | | The original email behind a message, for staff who can see the ticket's internal side (`helpdesk-pro.desk`) | `get_message_original` |

## Jobs and alerts

| Job | What it does |
|---|---|
| `inbound.process` | Processes one stored email. Three attempts; after the last, admins get an `inbound_failed` bell alert. |
| `inbound.fetch` | Fetches an email a provider only sent a reference for (Amazon SES stored in S3, Resend), then queues `inbound.process`. |
| `imap.poll` | Reads the IMAP mailbox, every `inbound.imap.interval_seconds` while the receiver is `imap`. |

The bell alerts `inbound_failed` and `imap_failed` are for admins only, never emailed, and link to the inbound log.

## Settings

On **Email & Notifications → Inbound Email**, **IMAP Mailbox** and **Reply Addresses**:

| Key | Default | What it does |
|---|---|---|
| `inbound.enabled` | `false` | Receive email. Also switches client emails to "Reply to this email or view your request". |
| `inbound.receiver` | `''` | `generic`, `cloudflare`, `imap`, or an Email plugin provider (`postmark`, `mailgun`, `sendgrid`, `ses`, `resend`, `mailersend`). |
| `inbound.route` | `/_helpdesk/inbound` | The start of the webhook address. |
| `inbound.secret` | `''` | The URL secret in the webhook address. At least 32 random characters, or the webhook stays closed. |
| `inbound.signing_secret` | `''` | The HMAC secret the `generic` and `cloudflare` receivers check. Blank uses `inbound.secret`. |
| `inbound.default_project` | `support` | The slug of the project new tickets go to when no project's email alias matches. |
| `inbound.max_bytes` | `26214400` | The largest email accepted (25 MB). |
| `inbound.max_attachments` | `20` | The most files kept from one email. |
| `inbound.per_sender_per_hour` | `20` | More emails than this from one address in an hour are rejected. |
| `inbound.new_tickets_per_sender_per_hour` | `5` | The most new tickets one address may open by email in an hour. |
| `inbound.cc_join` | `true` | People in To and Cc of a client's email become cc's on a new ticket, and someone you emailed about a ticket may reply to it. |
| `inbound.address` | `''` | Where replies to your email go, with a token added. Blank uses the project's email alias, then `email.support_address`, then the From address. |
| `inbound.plus_addressing` | `true` | Put the reply token in the address. Off only when your mail system rejects or strips `+detail`. |
| `inbound.imap.host` | `''` | The IMAP server, for example `imap.gmail.com`. |
| `inbound.imap.port` | `993` | `993` for `ssl`, usually `143` for `starttls`. |
| `inbound.imap.encryption` | `ssl` | `ssl`, `starttls` or `none` (a local test server only). |
| `inbound.imap.username` | `''` | The mailbox login, usually the full address. |
| `inbound.imap.password` | `''` | An app password. Never shown in the status or the log. |
| `inbound.imap.folder` | `INBOX` | The folder new mail is read from. |
| `inbound.imap.processed_folder` | `''` | Move imported mail here. Blank marks it read and leaves it where it is. |
| `inbound.imap.interval_seconds` | `120` | How often the mailbox is read (at least 60). |
| `privacy.inbound_raw_days` | `90` | Days the inbound log keeps each email's raw copy. |

## Related

- [Outbound email](../outbound-email)
- [Troubleshooting](../troubleshooting#emails-to-support-do-not-arrive)
- [CLI](../cli)
- [Extending](../extending#inbound-email)
