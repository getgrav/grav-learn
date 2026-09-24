---
title: Request Form and Guests
taxonomy:
    category: docs
description: The new request form, filling it from a link, guest requests, and the captcha, rate limits, blocklist and spam score that guard it.
---

# Request Form and Guests

The request form is how people send you a new request from your site. It lives at `{mount}/new` (usually `/help/new`), behind the **Contact us** button on the help center, and can be embedded in any page with `helpdesk_ticket_form()` (see [Help center and portal](../help-center-and-portal#twig-functions)). This page covers the form, guest requests, and the checks that keep spam out.

## What the form asks

- **What is this about?**: the project, shown only when the person may send to more than one.
- **Summary**: a few words, up to 255 characters.
- **Your message**: plain text, as long as it needs to be.
- **Attach files**, when attachments are enabled.
- The public [custom fields](../custom-fields) of the chosen project, under the message. When the person picks a project the form shows that project's fields and hides the others. The partial `helpdesk/partials/form-extra.html.twig` draws them.

A signed-in person is not asked for a name or email: the form says "Sending as Maria Lopez · Not you? Sign out" instead. Articles that match what they type show in a "You may be looking for" panel under the message (see [Knowledge base](../knowledge-base#the-help-center-flow)).

The form offers only the projects the person may open requests in: projects whose intake is open and whose visibility lets them submit (see [Projects and permissions](../projects-and-permissions#who-may-read-a-ticket)). With none, the form says so. A blocked person sees a short "you can't send requests right now" message.

## Fill the form from a link

| Query | What it does |
|---|---|
| `?q=` | Fills the summary, for example from a search that found nothing (`/help/new?q=Can't sign in`). |
| `?project=` | Picks the project, by id or slug (`/help/new?project=billing`). |
| `?from=` | The page that led here, carried along for the knowledge base's "already read" record. |

## What happens when it is sent

The request is created in the chosen project for the signed-in person, as a web request, and they land on it with "Thanks! We've got your request". Whether it waits in Triage first follows the project's triage setting; either way the person can see it straight away.

If something is missing, the form comes back with what they typed and a message under each field that needs attention ("Please add a short summary."), and the browser lands on the first one. A required custom field left empty, or an answer the field refuses, is explained the same way. A form that sat open too long (its nonce expired) comes back with a note to send it again; nothing is created twice.

## Guest requests

When `portal.guest_submissions` is on and at least one project has visibility `public` and open intake, visitors who are not signed in get the form too, with two more fields at the top: **Your name** (optional) and **Your email** (required). Only public projects are offered to them. With guest requests off, or no public project, the form asks them to sign in instead.

A guest request goes through these checks, in order:

1. **The fields.** A missing summary, message or email, or an invalid address, comes back with the message under the field.
2. **Captcha** (`portal.captcha`). A missing or wrong answer comes back as "We couldn't confirm this came from a person. Please try sending it again."
3. **Rate limits** (`portal.limits`): 5 requests per IP address per hour, 5 per email address per hour, and 60 from all guests together per hour. Past a limit the form comes back with "We've had a lot of requests from here in the last hour" (HTTP 429). The counters store hashes, never the addresses or IPs.
4. **The blocklist.** A blocked address, domain or IP address gets the same "Thanks, check your email" page as a real request, and nothing is created, so the sender learns nothing. A person staff have blocked is treated the same way.
5. **The spam score** (below).

Then the request is created for the person with that email address. A guest is never linked to a Grav account here: an unknown address becomes an email-only person, and an address that belongs to someone already known gets the request on their record, with nothing on screen to say so. Files the guest attached join the request's first message.

The guest lands on `{mount}/new/thanks`: "Thanks, we've got your request. Check your email." The `client-received` email carries a [sign-in link](../sign-in-links) that opens the request; the first time they use it, their Grav account is created and they are signed in. The thanks page is the same for every guest, whatever became of the request.

## Spam

Each guest request gets a spam score:

| Signal | Points |
|---|---|
| The hidden honeypot field (`website`) was filled in | 100 |
| Sent sooner than `portal.min_submit_seconds` after the form was drawn | 60 |
| No valid time stamp at all (a script that never loaded the form) | 60 |
| Each link past the second | 15 |
| Each blocked word from the blocklist | 25 |
| A phone number | 20, plus 15 when the message is little more than that |
| Each request from the same address in the last hour that says the same thing (at most 3) | 30 |

The total decides what happens:

- **60 or more** is spam. The request is still created, so nothing a real person sent is lost, but it waits in Triage with the `spam` label, and no acknowledgement email goes out.
- **30 or more** waits in Triage like any triaged request, and is acknowledged.
- **Below 30** follows the project's own triage setting.

The time trap uses a signed stamp in the form's hidden `form_ts` field, so a script cannot send an old time to look patient. The honeypot is hidden from people and from screen readers.

## The blocklist

Blocked words add to the spam score rather than dropping the request, so a real request that happens to use one lands in Triage instead of disappearing. Blocked addresses, domains and IP addresses drop it.

Manage the blocklist from the command line:

```bash
bin/plugin helpdesk-pro blocklist                                  # list every entry
bin/plugin helpdesk-pro blocklist list domain                      # list one type
bin/plugin helpdesk-pro blocklist add domain spam.example --note="bulk spam"
bin/plugin helpdesk-pro blocklist add ip 203.0.113.0/24
bin/plugin helpdesk-pro blocklist remove word casino
```

The types are `email`, `domain` (which also blocks its subdomains), `ip` (an address or a CIDR range) and `word`. Values are stored lowercased.

## Captcha

`portal.captcha` picks one of the Form plugin's captcha providers:

| Value | What it does |
|---|---|
| `cap` (default) | Cap, an invisible proof-of-work check served by the Form plugin itself at `/forms-cap/`. No outside service and no puzzle. |
| `turnstile` | Cloudflare Turnstile, using the site key and secret in the Form plugin's settings. |
| `recaptcha` | Google reCAPTCHA (the v2 checkbox), using the Form plugin's settings. |
| `none` | No captcha. |

Without the Form plugin (or the chosen provider) the form has no captcha, rather than turning every guest away. Signed-in clients are not asked unless `portal.captcha_signed_in` is on. Turnstile and reCAPTCHA send the visitor's answer and IP address to those companies; mention that in your privacy notice if you use them.

## Settings

On the **Portal & Access** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `portal.guest_submissions` | `true` | Whether guests may send the form at all. Only `public` projects accept guest requests. |
| `portal.client_groups` | `[]` | Grav groups given to the accounts Helpdesk Pro creates for clients when they first sign in through an email link. |
| `portal.captcha` | `cap` | `none`, `cap`, `turnstile` or `recaptcha`. |
| `portal.captcha_signed_in` | `false` | Ask signed-in clients for the captcha too. |
| `portal.min_submit_seconds` | `3` | A guest request sent sooner than this after the form opened scores as spam. |
| `portal.limits.ip_per_hour` | `5` | Guest requests per IP address per hour. `0` turns the limit off. |
| `portal.limits.email_per_hour` | `5` | Guest requests per email address per hour. |
| `portal.limits.guest_per_hour` | `60` | Guest requests from everyone together per hour. |

## Related

- [Help center and portal](../help-center-and-portal)
- [Sign-in links](../sign-in-links)
- [Triage and merging](../triage-and-merging)
- [People and privacy](../people-and-privacy)
