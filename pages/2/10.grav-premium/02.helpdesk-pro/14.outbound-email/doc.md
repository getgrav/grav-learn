---
title: Outbound Email
taxonomy:
    category: docs
description: What clients and staff are emailed, branding every email with your name, logo, colours and light or dark look, threading headers, unsubscribe and templates.
---

# Outbound Email

Helpdesk Pro sends two kinds of email. Clients get a handful of milestone emails that read like a personal email from the person helping them. Staff get their notifications by email when they did not read them in the desk first. Everything goes through the Grav Email plugin, so whichever engine your site uses (SMTP, Postmark, Mailgun, SES, Resend…) sends Helpdesk Pro's mail too.

## Set up outbound email

1. Configure the Email plugin and check it can send: `bin/plugin email test-email --to=you@example.com`.
2. Set `email.support_address` to the address clients write to. Helpdesk Pro sends from it, and replies come back to it. Until [inbound email](../inbound-email) is set up, that mailbox is where client replies land.
3. Brand your email under **Look and Branding** (see [Brand your email](#brand-your-email)).
4. Send a test: **Send a test email** on the desk's **Operations → Email** screen, or `POST /helpdesk-pro/mail/test` with `{"to": "you@example.com"}` (MCP `send_test_email`, permission `helpdesk-pro.settings`). The answer says whether it was sent, the sender address, and whether your transport keeps custom headers and the unsubscribe headers.
5. Make sure cron runs the scheduler. Client replies go out right after the request that created them, but retries and staff notification email need the worker. See [Jobs and cron](../jobs-and-cron).

## What clients receive

| Template | Sent to | When |
|---|---|---|
| `client-received` | The requester | A request arrives from the help center form (`email.acknowledge_web_tickets`) or by email (`email.acknowledge_email_tickets`). At most one an hour per person, never for spam, never in reply to automatic mail. It names the files that arrived, and for a request by email, each file that was not kept and why. |
| `client-reply` | The requester and cc's, never the author | A staff member posts a public reply. A ticket staff open on a client's behalf sends its opening message this way, unless **Email the requester** is off. |
| `client-resolved` | The requester and cc's | The ticket enters a resolved status. A reply posted in the same minute (the usual "reply and mark solved") is folded into it, so the client gets one email. With [ratings](../customer-ratings) on, the requester's copy asks "How did we do?". |
| `client-triage` | The requester | A new request is declined or marked a duplicate with notify on. Includes the public reason, and for a duplicate a link to the original when the client was added to it. |
| `client-magic-link` | The person asking | A [sign-in link](../sign-in-links). |

Client email reads like a personal email inside a branded card: the ticket's subject with "Re:", the agent's name ("Anna at Acme"), the reply text, a **View request** button, and a footer with a link to the request and a "Stop emails about this request" link. There is no ticket number (unless `email.subject_tag` is on), no quoted history and no status table.

- The line under the button reads "View or reply to your request" until inbound email can receive, and "Reply to this email or view your request" from then on, so it never invites a reply that would go nowhere.
- The request link is a sign-in link made for that recipient, so a client with no password lands on the request signed in. With `portal.magic_links` off, or for a staff recipient, it is the plain portal page.
- An email reply that added no text sends no email at all.

Internal notes never reach a client. Notes produce no client email, and before any client template is rendered, every message and file it is about to show is checked against the database. An internal message, a file on one, a deleted message or a message from another ticket stops the whole email: it is cancelled, logged as an error, and never retried.

A client gets none of this when they muted the request, turned all Helpdesk email off with an unsubscribe link, or are blocked. Staff who work the project never get client email; they have the bell.

## Files in client email

The public files of the staff reply a client email is about (`client-reply`, and the reply folded into `client-resolved`) go into the email itself, so the client does not need to sign in to see them:

- **Pictures** (png, jpg, gif, webp) are embedded and shown under the message, no wider than the card, with their name as a caption. A picture pasted into the reply shows where it sat instead.
- **Other files** are real attachments, named under the message as "Attached".
- **The cap.** Files are taken in order while their total stays within `email.attach_max_mb` (10 MB). The rest stay links, and the email says so ("2 more files are on your request:"). `0` attaches nothing and every file is a link.
- **Links sign in.** A file left as a link is a sign-in link for that recipient that lands on the file. With `portal.magic_links` off it is the plain file route, `{mount}/_file/{id}/{name}`.

A file on an internal note is never attached, embedded or linked. The bytes are read when the email is built, as the recipient, through the same access check the help center's file route makes.

Most mail providers take 20 to 25 MB per message, but base64 adds a third, and some corporate filters strip or hold attachments. Set the cap lower, or to `0`, when your clients' mail systems are strict.

## What staff receive

| Template | When |
|---|---|
| `staff-notification` | One notification is due: the ticket's title as a link, `#number · project` with its status (and priority when not Normal), one sentence ("Cleo replied to “Invoice missing”"), the message for replies and notes (notes are tinted and marked "Internal note"), the ticket's custom fields, and an **Open ticket** button. |
| `staff-batch` | Several notifications are due at once: "5 updates on 3 tickets", then one row per ticket with what happened and the newest message, then **Open the desk**. |
| `staff-digest` | The daily digest: requests waiting in Triage, tickets assigned to you that need a reply, unread notifications, and the unread updates per ticket. |
| `staff-test` | The test email. It says which headers the transport keeps and lists the look it was drawn in. |
| `staff-channel` | An email [notification channel](../notification-channels#set-up-an-email-channel) posts an event to a team inbox. |

Staff subjects carry the project and the ticket number: `[Support] Invoice missing #1042`. While inbound email can receive, staff email about one ticket ends with "Reply to this email to answer from your inbox.", or "Reply to this email to add an internal note." when it shows a note. See [Notifications](../notifications) for when these are sent.

## Brand your email

Every Helpdesk Pro email, client and staff, is drawn in one layout: a hidden preheader, a header with your logo or business name, a white card with a thin accent line along its top, and a quiet footer with why the email came and the unsubscribe link. It is at most 600px wide and one column, so it reads at phone width.

Set the look under **Email & Notifications → Look and Branding** on the plugin's settings page, or under `email.brand` in `user/config/plugins/helpdesk-pro.yaml`. No template is edited, and every email changes together.

```yaml
email:
  brand:
    name: 'Acme Support'                  # blank uses the site title
    logo: /user/images/acme-logo.png      # or https://…; blank or `none` shows the name instead
    logo_dark: /user/images/acme-logo-light.png
    logo_width: 140                       # px, 40–320
    show_name: false                      # the name beside the logo too
    accent_color: '#12805c'               # links, ticket titles, the line on top of the card
    button_color: '#12805c'               # buttons
    font: system                          # system | helvetica | verdana | trebuchet | georgia | custom
    font_custom: ''                       # the stack when font is custom
    footer: 'Acme Ltd · 1 Main Street · [acme.com](https://acme.com)'
    appearance: auto                      # auto | light | dark
```

| Key | Default | What it does |
|---|---|---|
| `email.brand.name` | blank | The business name in the header, sign-offs, the sender name ("Anna at Acme Support") and staff subject tags. Blank uses the site title, else "Helpdesk". |
| `email.brand.logo` | blank | The header image. A path on this site is made absolute from the site address; an `https://` address is used as given. Blank or `none` gives a text header with the name. Use PNG or JPG at twice the drawn width: Gmail shows no SVG. |
| `email.brand.logo_dark` | blank | A light version of the logo for mail apps in dark mode. Without it, a dark logo on a transparent background can disappear on a dark ground. |
| `email.brand.logo_width` | `140` | The width the logo is drawn at, clamped to 40–320px. |
| `email.brand.show_name` | `false` | Print the name beside the logo as well, for a logo that is only a symbol. With no logo the name is always shown. |
| `email.brand.accent_color` | `#1f6feb` | Links, ticket titles, file names and the line along the top of the card. A lighter shade is used for links in dark mode. |
| `email.brand.button_color` | `#1f6feb` | Every button. The button text is white, or near-black when the colour is light. |
| `email.brand.font` | `system` | One of five stacks every mail client has: `system` (the reader's own interface font), `helvetica`, `verdana`, `trebuchet`, `georgia`, or `custom`. |
| `email.brand.font_custom` | blank | The font stack when `font` is `custom`, such as `Inter, Arial, sans-serif`. Only names, spaces, commas and hyphens are kept. |
| `email.brand.footer` | blank | An optional line under every email, in Markdown: an address, a signature, a link. |
| `email.brand.appearance` | `auto` | Light or dark (see below). |

Colours must be hex (`#abc` or `#aabbcc`); anything else falls back to the default. To see the result in a real inbox, use **Send a test email**: the test is drawn in the saved look and lists the settings it used.

### Light and dark

`email.brand.appearance` decides how email looks in mail apps with a dark mode:

| Value | What happens |
|---|---|
| `auto` (default) | One email that each reader's mail app shows light or dark to match its own setting. Apple Mail, iOS Mail and Outlook.com follow `prefers-color-scheme` and get a dark ground, a dark card, light text, lighter links, and `logo_dark` when it is set. |
| `light` | The dark styles are left out and mail apps are asked not to darken the email. |
| `dark` | Every email is drawn dark for everyone, inline as well, so it stays dark in apps that drop the `<style>` block. Uses `logo_dark` when it is set. |

Gmail's apps and Outlook can still recolour email in their own dark mode whatever this says. The layout survives that because every panel and button carries its own background.

### One look per site

A project can have its own email alias, but the look is the site's: a client sees one help center, and sign-in links and digests belong to no project. A site that wants a look per project can set it in the `onHelpdeskMailBuild` event (see [Extending](../extending#email)), where `vars.brand` is filled before listeners run.

## Override email templates

Anything past the settings is Grav's own template override. A file at the same path in your theme wins:

```
user/themes/<your-theme>/templates/emails/helpdesk/client-reply.html.twig
user/themes/<your-theme>/templates/emails/helpdesk/partials/layout.html.twig
```

Copy the plugin's file from `user/plugins/helpdesk-pro/templates/emails/helpdesk/` as a starting point. Override `partials/layout.html.twig` to restyle every email at once. The background worker loads the theme before it renders, so your copy is used for mail the worker sends too.

Each email is a pair, `<name>.html.twig` and `<name>.txt.twig`. The text part has the same content in the same order and every link the HTML part has.

The layout's blocks are `preheader`, `header`, `content`, `footer` and `brand_footer`. A new email from an add-on or a theme extends `emails/helpdesk/partials/layout.html.twig`, fills `preheader` and `content`, and includes `partials/button.html.twig` with `url` and `label` for its button (`style: 'ghost'` for an outlined one, `align: 'center'`, `margin`).

| Partial | What it draws |
|---|---|
| `partials/layout.html.twig` | The frame |
| `partials/button.html.twig` | A button |
| `partials/client-footer.html.twig`, `.txt.twig` | The client footer |
| `partials/staff-footer.html.twig`, `.txt.twig` | The staff footer |
| `partials/staff-message.html.twig` | One message in staff mail; a note is tinted and labelled |
| `partials/ticket-row.html.twig` | One ticket in the batch and the digest |
| `partials/ticket-meta.html.twig` | `#number · project` with the status and priority pills |
| `partials/pill.html.twig` | A status or priority pill |
| `partials/files.html.twig`, `.txt.twig` | A message's files |
| `partials/csat.html.twig` | "How did we do?" with three buttons |
| `partials/staff-fields.html.twig` | The ticket's custom field values under a staff notification |

### Template variables

Every template gets `subject`, `site` (the business name), `recipient.name`, `brand` (the checked look: `name`, `logo`, `logo_dark`, `logo_width`, `show_name`, `accent`, `accent_dark`, `button`, `button_text`, `font`, `footer_html`, `footer_text`, `site_url`) and `links` (`ticket` and `portal` for clients, `desk` for staff, and `unsubscribe`).

Client templates also get `inbound` (whether replies by email reach the helpdesk), `agent`, `ticket.subject`, `ticket.status` (in client words), `message` and `reply` (each with `body_html`, `body_text`, `author_name`, `attachments`) and, for triage, `decision`, `reason` and `duplicate_url`.

Staff templates get `item` (the first notification: `sentence`, `count`, `message`, `link`, `ticket`), `items`, `groups` (per ticket: `ticket`, `link`, `items`, `latest`), `counts` for the digest, `inbound`, and `reply_as` (`note` when a reply to this email becomes an internal note, else `reply`). Each `ticket` is `{id, subject, project, status, status_label, priority, priority_label}`.

Each message's `attachments` is a list of `{id, message_id, name, url, size, visibility}`. In client mail the reply's files also carry `mode` (`inline`, `attached` or `link`), and an inline picture its `cid`, `width` and `in_body`.

Message bodies are the stored, sanitized HTML, printed with `|raw`. Everything else is escaped explicitly with `|e`, so a site whose Twig does not autoescape is safe too.

## Headers

| Header | Value |
|---|---|
| `Message-ID` | `hd.{ticket}.{kind}{row}.{random}@{domain}`: kind `m` for a reply, `n` for a notification, `a` for automatic mail. The domain is the support address's. |
| `In-Reply-To` | The newest email in this recipient's thread for the ticket. |
| `References` | `<hd.{ticket}.root@{domain}>` first, then up to nine recent ids. The virtual root makes every email about one ticket thread together in Gmail and Apple Mail. |
| `From` | The support address, named "{agent} at {site}" on client replies and "{site} Helpdesk" otherwise (just "{site}" when the site's title already says Helpdesk, Help or Support). The address never changes, so SPF and DKIM alignment are untouched. |
| `Reply-To` | Left out while inbound email is off. With it on, a reply address with a token for this recipient (see [Reply addresses](../inbound-email#reply-addresses)). |
| `List-Unsubscribe` | A signed one-click link: `ticket:{id}` on client mail, `all` on staff mail. With inbound email on, also a `mailto:` unsubscribe address on email about one ticket. |
| `List-Unsubscribe-Post` | `List-Unsubscribe=One-Click` (RFC 8058), so Gmail and Apple Mail can show their own unsubscribe button. |
| `Auto-Submitted` | `auto-generated` on notifications, batches, digests, acknowledgements, triage and resolved mail; left off mail that carries a human reply. |
| `X-Auto-Response-Suppress` | `All`, which stops Exchange out-of-office replies to your mail. |
| `X-Helpdesk-Ref` | `{ticket}.{signature}`, for diagnostics. |

Every Message-ID sent is stored with its ticket, person and audience before the email is handed to the transport, so a retry reuses it and replies can be matched when inbound email arrives. Each ticket email's HTML part also ends with an invisible `ref:{ticket}.{signature}` marker, the last-resort match for a reply that comes back without threading headers.

Transports that turn a message into an API call sometimes drop headers. The test email reports what your transport keeps: when custom headers are dropped, threading falls back to the subject; when the unsubscribe headers are dropped, mail apps show no unsubscribe button (the footer links still work).

## Unsubscribe links

The links in the footer and in `List-Unsubscribe` point at the help center:

| Route | What it does |
|---|---|
| `GET {mount}/unsubscribe?p=&s=&sig=` | A confirmation page with one button. Opening the link changes nothing, because link scanners open links in email. |
| `POST {mount}/unsubscribe` | Applies the link: `ticket:{id}` mutes that request for the person; `all` turns Helpdesk email off (a staff member's email mode becomes `off`, a client stops getting any Helpdesk email). Mail apps post `List-Unsubscribe=One-Click` here; no sign-in is needed, because the signature is the proof. |

`p` is the person, `s` the scope and `sig` an HMAC over both with a secret kept in the database, so a link cannot be altered to unsubscribe someone else. Applying a link twice changes nothing.

## How sending works

1. An event (a reply, a status change) or the notification fallback puts a row in the email queue: the template, the recipient and ids only. Nothing a template shows is stored in the queue.
2. The `mail.send` job drains the queue. An email due now is also sent right after the request that queued it, so a client sees a staff reply within seconds.
3. Each email is built when it is sent: the recipient's access is checked again, the content is loaded, and both parts are rendered.
4. A failed send is retried after 5 and then 10 minutes, and fails for good on the third attempt. An email whose recipient lost access, turned email off or was erased is cancelled quietly.
5. The daily `maintenance.prune` job deletes sent, failed and cancelled rows older than `jobs.retention_days`. The Message-IDs stay, for threading and reply matching.

Links in email are made when the email is built. The worker running from cron cannot know your site's address, so every web request records it and the worker uses the last one recorded. Set `email.site_url` when mail goes out before anyone has visited the site, or when the site is reached through an address clients do not use (an internal hostname behind a proxy). With no address known, the email still goes, with relative links and no `List-Unsubscribe`, and the log says "email links are relative: the site address is not known yet".

## Settings

On the **Email & Notifications** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `email.support_address` | blank | The address clients write to. Mail is sent from it and replies come back to it. Its domain is used in Message-IDs. |
| `email.from_address` | blank | Only when mail must go out from a different address. Blank uses the support address, then the Email plugin's From. |
| `email.site_url` | blank | The address links in email start with, such as `https://example.com`. Blank uses the address the site was last visited at. |
| `email.from_name_format` | `{agent} at {site}` | The sender name on client replies. |
| `email.subject_tag` | `false` | Adds a visible `[#123]` to client subjects. Threading never needs it. |
| `email.acknowledge_web_tickets` | `true` | Send `client-received` for help center requests. |
| `email.acknowledge_email_tickets` | `true` | Send `client-received` for requests that arrive by email. |
| `email.attach_max_mb` | `10` | How much of a staff reply's files a client email carries itself. `0` keeps every file a link. |
| `email.brand.*` | | How every email looks. See [Brand your email](#brand-your-email). |

## Related

- [Inbound email](../inbound-email)
- [Notifications](../notifications)
- [Sign-in links](../sign-in-links)
- [Jobs and cron](../jobs-and-cron)
