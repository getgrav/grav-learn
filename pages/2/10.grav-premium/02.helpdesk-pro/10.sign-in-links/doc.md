---
title: Sign-in Links
taxonomy:
    category: docs
description: How clients sign in to the portal with an emailed link and no password, how those links are protected, and how earlier requests join an account.
---

# Sign-in Links

Most people who write to a helpdesk never want a password. Helpdesk Pro signs clients in with a link it emails them: they type their address, open the email, click, and they are looking at their requests. The link in every client email works the same way, so a guest who sent the form clicks "View or reply to your request" and lands on that request, signed in.

These are Helpdesk Pro's own links, not the Login plugin's magic link. The Login plugin's link needs an existing Grav account, and most of the people a helpdesk hears from have none yet. Helpdesk Pro creates the account the first time they use a link.

## The pages

| Route | What it does |
|---|---|
| `GET {mount}/login` | One email field and an **Email me a link** button. People with a password also get a link to the Login plugin's page. `?return=` names the portal page to come back to. Someone already signed in is sent there, or to "Your requests". |
| `POST {mount}/login` | Asks for a link. Always answers with the same "Check your email" page, whatever the address was. |
| `GET {mount}/login/verify?token=` | The page a link opens. It names the address and draws one button, and uses up nothing. |
| `POST {mount}/login/verify` | That button: uses the link, signs the person in and opens where the link points. |
| `POST {mount}/login/verify-email` | A signed-in client asks for a link that proves their account's address. |
| `GET {mount}/new/thanks` | Where a guest lands after sending the form: "Check your email". |

Every POST needs the portal's `helpdesk-portal` nonce, like every other portal form.

## What happens when someone asks for a link

The page always says "If that address has requests with us, we've sent it a link to sign in", and looks the same for every address. Behind it:

- An address Helpdesk Pro knows, belonging to an active client, gets the `client-magic-link` email.
- An unknown address gets nothing. So does a blocked or erased person, and so does anyone who is staff: an emailed link must never open a staff session.
- Asking is rate-limited: 10 requests per IP address per hour, and 5 per address (and per person) per hour. Past the limit the page still looks the same, and nothing is sent.

The email is sent by the `magic_link.send` job, right after the page answers or on the next worker run. The link is made while the email is built and is never written anywhere.

## How a link is protected

- It is 32 random bytes, written as 43 URL-safe characters. Only its SHA-256 is stored, so a copy of the database cannot sign anybody in.
- It works once. Two clicks racing each other cannot both use it.
- It ends early when it is used, when the person asks for another (a new link ends their outstanding ones), or when the password on their Grav account changes.
- A link someone asked for lasts `portal.magic_link_minutes` (30). The link inside a client email lasts `portal.email_link_days` (7).
- A used, expired, replaced or unknown link lands on the sign-in page with "That link has expired or was already used. We can send a new one." When it came from a client email, the address is already filled in. Every case gets the same sentence, so the page never tells anyone probing which it was.
- Links are deleted a day after they expire or are used.

### The link opens a page, not a session

Clicking a link lands on a small page ("Sign in to see your request", "Sign in", or "Confirm your email address"), the address the link belongs to, and one button. Nothing is used up at that point. The button is a POST, and the POST is what signs the person in.

Corporate mail scanners and link previewers open every link in an inbox before the recipient sees it. A link that signed somebody in on a GET would be spent before the client ever clicked it. The same rule covers every link Helpdesk Pro emails.

A visitor already signed in as that person, with a proven address, goes straight to where the link points. A page left open so long that its nonce expired draws itself again with "Your page was open for a long time"; the link is still unused.

## Using a link

The button (`POST {mount}/login/verify`) uses the link, then:

1. The person's address counts as proven.
2. Their Grav account is found, or created when they have none: the username is their email address when Grav accepts it and it is free, else the part before the `@` with a number; no password; `access.site.login`; the groups in `portal.client_groups`. Nothing the visitor typed goes into it, so nobody can give themselves groups or permissions this way.
3. An account that can reach the admin is refused: one with `api.access`, any `helpdesk-pro.*` permission, `admin.login` or `admin.super`. The person sees "That link can't sign you in here".
4. The Login plugin signs them in, with its own checks (the account must be enabled and allowed `site.login`) and every `onUserLogin*` listener your site has.
5. They land on the request the link was for, the portal page they asked from, or "Your requests".

### Two-factor authentication

When the Login plugin's two-factor option is on (`plugins.login.twofa_enabled`) and the account has two-factor set up, the link proves the mailbox but not the second factor. The person is sent to the Login plugin's page for their code, and goes on to the request once it is right.

## Earlier requests

A person can have a history with you before they have an account: requests they sent by email or through the guest form belong to an email-only person with that address. When they later sign in with an account whose address is proven, those requests join the account automatically. An address counts as proven when:

- the account is staff, or
- an admin created the account in Admin Next (or through an invitation), or
- the Login plugin requires an activation email and the account has been activated, or
- they used a sign-in link Helpdesk Pro emailed to that address.

An account whose address nobody has confirmed (someone registered on the site without an activation email) does not get them automatically, because anyone can type anyone's address when registering. Instead, the portal shows that client "Verify your email to see earlier requests" at the top of "Your requests" and the help center home. The button sends a link to the account's address; using it proves the address, and the earlier requests join the account with everything the account had (see [People and privacy](../people-and-privacy#merge-two-people)).

Any sign-in link counts as proof: when a client with an unproven account uses the link from one of their own client emails, the address is proven and earlier requests join.

## The email

`client-magic-link` (`templates/emails/helpdesk/client-magic-link.html.twig` and `.txt.twig`, overridable by your theme) gets `subject`, `site`, `brand`, `recipient.name`, `purpose` (`login` or `verify`), `link`, `expires.minutes` and `expires.days`. It is marked `Auto-Submitted: auto-generated` and has no threading headers. It says "If you didn't ask for it, you can ignore this email".

The other client emails (`client-received`, `client-reply`, `client-resolved`, `client-triage`) link the request with a sign-in link of their own for each recipient. When `portal.magic_links` is off, or the recipient is staff, they link the plain portal page instead, which asks the reader to sign in.

## Settings

On the **Portal & Access** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `portal.magic_links` | `true` | Sign-in links on or off. Off: the sign-in page only points at the Login plugin, and client emails link the plain portal page. |
| `portal.magic_link_minutes` | `30` | How long a link someone asked for works. |
| `portal.email_link_days` | `7` | How long the link inside a client email works. |

## Related

- [Help center and portal](../help-center-and-portal#signing-in)
- [Outbound email](../outbound-email)
- [People and privacy](../people-and-privacy)
