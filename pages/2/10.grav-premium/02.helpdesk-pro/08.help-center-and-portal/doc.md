---
title: Help Center and Portal
taxonomy:
    category: docs
description: Set up the help center page, what clients see on the portal, its routes, styling it to your theme, template overrides and Twig functions.
---

# Help Center and Portal

The client portal is where the people you help follow their requests on your site: a list of their requests, each conversation, a reply box, and buttons to mark a request solved or reopen it. The help center is its front door. This page covers setting both up, what clients see, and how to fit them into your theme.

Clients see a ticket called a "request", and a status in their own words, never your internal status names. Below, `{mount}` is the help center's route, usually `/help`.

## Set up the help center

1. In Admin Next, add a page and choose the **Help Center** page type (the `helpdesk` template).
2. Give it a title (for example "Help") and a short welcome text. The text shows at the top of the help center.
3. Publish it.

The page's route becomes the help center's address, and every portal page lives under it.

Helpdesk Pro finds the page by its template, not its route. It first looks at the route in `portal.route`, then, if nothing there uses the `helpdesk` template, scans the site once and remembers the first Help Center page it finds (cached until pages change). With no Help Center page at all, the portal still works at `portal.route` (default `/help`) inside a stand-in page, with no welcome text to edit.

The address it settles on is also stored in the database, so links in emails sent by the background worker point at the right place.

Knowledge base articles can live as child pages of the help center (`/help/getting-started/reset-password`). The portal claims only its own paths, listed in [Routes](#routes); every other path under the help center is an ordinary Grav page.

### Put Help in your site's menu

The portal lives at a route, so a theme's menu (which lists pages) does not show it on its own. Give the help center a real page:

1. Add a top-level page such as `user/pages/04.help/helpdesk.md` (the `helpdesk` template) with `title: Help`, or pick **Help Center** in Admin Next.
2. A numbered folder is visible in menus, so the theme lists **Help** like any other page.

Every portal page under it counts as a child of that page, so themes that highlight the current section keep **Help** highlighted. Menu links elsewhere can point at any portal page with `helpdesk_url()`, for example `{{ helpdesk_url('list') }}` for My requests.

## The help center home

`{mount}/` is laid out the way people look for help: check the articles first, then ask. From top to bottom, under the nav row:

- a hero band with "How can we help?", your welcome text as a one-line intro, and a big search box;
- for a signed-in person, **Your requests**: their three most recently active requests, and **See all**;
- **Browse by topic**: a card per knowledge base category with its icon, description and article count, and **Browse all articles** (see [Knowledge base](../knowledge-base#browse-articles));
- **Popular articles**;
- a "Still need help?" band with **Contact us**, which opens the new request form, and a sign-in link for visitors who are not signed in.

## The nav row

Every portal page and every help article starts with one quiet row of links under your theme's header: **Help center**, **Articles**, **My requests** (and **My organization** for members of an [organization that shares requests](../organizations#share-requests-with-colleagues)) and **Contact us**, and on the right the signed-in person's name with **Sign out**, or **Sign in**. When some of their open requests wait for their reply, My requests shows how many. On a phone the links stay on one line and scroll sideways.

**Sign out** is the Login plugin's sign-out link. Where the person lands is the Login plugin's `route_after_logout` (the site's home by default), or the help center home when its `redirect_after_logout` is off. **Sign in** carries the page it was clicked on, so signing in comes back to it.

To place the row yourself, for example inside your theme's header, set `portal.nav` to `false` (**Help Center → Nav Row** on the settings page) and call `{{ helpdesk_nav() }}` where you want it.

## Signing in

Every portal page except the help center home and the new request form asks for a signed-in Grav account. A visitor who is not signed in gets the sign-in form in place of the page ("Sign in to continue"): one email field and **Email me a link**, which sends a [sign-in link](../sign-in-links) and needs no password, and "Have a password? Sign in with it" for people who have one. Either way they come back to the page they asked for. The page is the same whether the request exists or not, so it gives nothing away.

The portal's own sign-in page is `{mount}/login`. Clients need an enabled account with site login access (`access.site.login: true`); they need no admin or `helpdesk-pro.*` permission. With `portal.magic_links` off, the page points at the Login plugin's sign-in page instead.

When Helpdesk Pro creates accounts for clients itself (from an emailed sign-in link), it puts them in the Grav groups listed in `portal.client_groups` (empty by default).

### Deep links come back after signing in

A link straight to a request (`{mount}/tickets/12`) works for someone who is not signed in yet. The sign-in form carries the address as `return`, and once they are in they land on that exact page. With an emailed link, the link itself carries the address; with a password, the portal leaves it in the session as the Login plugin's `redirect_after_login`.

A return address is checked at every step and dropped when in doubt. It must be a path on your own site, under the help center, not a sign-in page, with no percent-encoding, backslash, space, control character, `.` or `..` segment, doubled slash, or anything unusual in the query. Anything else, like `//evil.test` or `/help/%2e%2e/admin`, is ignored and the person lands on their requests. A file link, `{mount}/_file/{id}/{name}`, is allowed so a file link from an email can come back to it.

## Routes

| Method | Path | What it does |
|---|---|---|
| GET | `{mount}/` | The help center home. Open to everyone. |
| GET | `{mount}/new` | The new request form (see [Request form and guests](../request-form)). |
| POST | `{mount}/new` | Sends the form and opens the new request. |
| GET | `{mount}/new/thanks` | Where a guest lands after sending the form. |
| GET | `{mount}/tickets` | Your requests. `?state=waiting` shows the Waiting on you tab and `?state=closed` the Closed tab, `?q=` searches, `?page=` pages through (20 per page). |
| GET | `{mount}/organization` | Your organization's requests, for members of an organization that shares them; "not found" for everyone else. Takes the same `state`, `q` and `page`. |
| GET | `{mount}/tickets/{id}` | One request: the conversation, the reply box and the actions. |
| POST | `{mount}/tickets/{id}/reply` | Adds a reply. |
| POST | `{mount}/tickets/{id}/resolve` | "This is solved": marks the request solved. |
| POST | `{mount}/tickets/{id}/reopen` | Reopens a solved request. |
| POST | `{mount}/tickets/{id}/mute` | Stops emails about the request (`muted=1`), or starts them again (`muted=0`). |
| POST | `{mount}/tickets/{id}/rate` | "How did we do?" on a solved request (see [Customer ratings](../customer-ratings)). |
| GET, POST | `{mount}/rate/{token}` | The page a rating link in the resolved email opens, and the answer it sends. |
| GET, POST | `{mount}/login`, `{mount}/login/verify` | Sign-in links (see [Sign-in links](../sign-in-links#the-pages)). |
| POST | `{mount}/login/verify-email` | A signed-in client asks for a link that proves their address. |
| GET, POST | `{mount}/unsubscribe` | The unsubscribe link in email (see [Outbound email](../outbound-email#unsubscribe-links)). |
| GET | `{mount}/search`, `{mount}/articles`, `{mount}/articles/{category}` | Knowledge base search and browsing (see [Knowledge base](../knowledge-base#portal-routes)). |
| GET | `{mount}/_file/{id}/{name}` | A file, after the access check (see [Attachments](../attachments)). |
| POST | `{mount}/_upload`, `{mount}/_upload/{id}/remove` | Draft uploads from the reply box and the form. |
| GET, POST | `{mount}/_live/config`, `{mount}/_live/presence` | Live updates for signed-in clients (see [Live updates](../live-updates#in-the-portal)). |

Every POST except the rating and unsubscribe links carries Grav's form nonce for the `helpdesk-portal` action. A POST with a stale nonce (a page left open overnight) changes nothing and shows the page again with what the person typed and a note to try again.

## Your requests

`{mount}/tickets` lists the requests the signed-in person asked or was copied on, most recent activity first, under one search box and three tabs, each with its count:

- **Open**: received, in progress, or waiting for their reply.
- **Waiting on you**: the open ones waiting for their reply.
- **Closed**: solved or closed.

Each row shows the summary, the status, the number (`#1042`) and when it last changed. A request waiting for their reply stands out with a warm edge, and one with a reply they have not read is marked **New reply**.

Signed-in people can type a request number (`1042` or `#1042`) into the help center's search box or the list's search box and go straight to it when it is one they may read. Any other number is searched for like any other words, and the two answers look the same, so the box never tells anyone whether a number is in use.

Staff who also use the portal see only their own requests here, never the whole queue. A client who may read a project's shared requests can open them from a link, but the list shows only the ones they are on.

### Your organization's requests

A client in an [organization](../organizations) that shares requests gets **My organization** in the nav row and a **Mine | Acme** switch above their list. `{mount}/organization` lists every request of the organization, with the same tabs, search and paging, and each row says who asked ("Asked by Ada", or "Asked by you").

Opening one shows the public conversation, never staff notes. They can read it but cannot reply, mark it solved or mute it unless they are on it; the page says so where the reply box would be. They are not emailed about these requests.

## One request

`{mount}/tickets/{id}` shows the summary, the status, **Request #{id}** and when it was opened, then a banner saying what happens next ("We need something from you. Please reply below."), then the conversation oldest first. The person's own messages read **You**; support replies carry the agent's name, a **Support** tag and an accent edge. Internal notes, internal activity and your status names never appear: the page is built only from the public thread and public activity.

The request's [custom fields](../custom-fields) that the client may see, and that have a value, are listed under the header. The client cannot change them here.

A request staff opened for a client (in the desk, "Anna on behalf of Maria Lopez") shows the first message as the requester's: **You** to them, with a quiet "added by our team".

The status shows in the client's words:

| Status category | The client sees |
|---|---|
| `new` | Received |
| `open`, `waiting_us` | In progress |
| `waiting_client` | Waiting for your reply |
| `resolved` | Solved |
| `closed` | Closed |

What the person can do depends on the request:

- **Reply.** Replying to a solved request reopens it, and replying to one that waits for them moves it back to your side. Replies are plain text: a blank line starts a paragraph, a pasted link becomes a link, and a fenced code block stays a code block.
- **This is solved** marks an open request solved. Only the requester and cc's see it.
- **Reopen** brings a solved request back.
- A **closed** request takes no more replies. It offers **Start a new request** with the summary filled in, and shows any reply that was typed so it can be copied over.
- **Stop emails about this request** mutes it for that person; the link then reads **Email me about this request again**.

"You can also reply to any of our emails about this request" shows only once inbound email is on (`inbound.enabled`).

A request the person may not read answers with a 404 and a "We couldn't find that request" page, exactly like a request that does not exist.

Staff who work the request's project are sent to the desk instead (`/admin/plugin/helpdesk-pro#/t/{id}`, following your Admin Next route). The portal never shows the staff side, and staff never reply through it. Any other staff member who opens a request page (one they sent themselves, in a project they do not work) sees the client's view with an **Open in the desk** link.

### Times

Every time on the portal has one format, `Sep 23, 2026, 2:22 PM`, in the reader's timezone: their Helpdesk profile's timezone, else their Grav account's `timezone`, else `system.timezone`, else PHP's default. Times from the last 24 hours read "just now", "12 min ago" or "3 h ago" with the full time as a tooltip. With JavaScript the portal redraws them in the browser's own timezone.

### Files

When attachments are enabled, the reply box and the new request form have an **Attach files** button, and files can also be dropped on the form or pasted into the text box. With JavaScript each file uploads as soon as it is chosen; without it the files are sent with the form. Files always open through the portal's own access-checked link, never a storage address. See [Attachments](../attachments).

## With and without JavaScript

Everything works with JavaScript turned off: each button is a normal form that posts and returns to the request, with a short confirmation at the top ("Your reply has been sent.").

With JavaScript on, the portal's script (`assets/dist/portal.js`) loads htmx on pages that need it, and the same forms update the request in place: the reply appears without a page load, the confirmation is announced to screen readers, and reply boxes grow as you type. Ctrl+Enter (Cmd+Enter on a Mac) sends. If your theme already ships htmx, the portal uses it. A theme that boosts every link with htmx is handled too: a boosted link into the portal becomes a full page load, so its styles and script come with it.

Portal pages are personal, so they are sent with `Cache-Control: private, no-cache, no-store, must-revalidate`, whatever your page cache settings are.

## Style the portal

The portal inherits your theme's fonts and colours. All portal markup uses `helpdesk-` prefixed classes inside a `.helpdesk` wrapper, and every colour, radius and space comes from one set of CSS custom properties. On a Pico-based theme (Quark2 and others) they follow Pico's own variables; on any other theme they fall back to neutral values mixed from the text colour. Light and dark modes both work with no changes.

Restyle the portal by setting any of these on `:root` or `.helpdesk`, without copying a template:

| Property | What it sets |
|---|---|
| `--helpdesk-accent` | Links, primary buttons, the focus ring, the edge of support replies, topic icons |
| `--helpdesk-accent-contrast` | Text on the accent colour |
| `--helpdesk-text` | Body text |
| `--helpdesk-muted` | Secondary text (meta lines, hints) |
| `--helpdesk-border` | Hairlines |
| `--helpdesk-surface` | Card backgrounds |
| `--helpdesk-subtle` | Tinted bands ("Still need help?", the article feedback line) |
| `--helpdesk-team` | The tint behind support replies |
| `--helpdesk-radius` | Corner radius (cards use one and a half times it) |
| `--helpdesk-gap` | Base spacing; every space in the portal is a multiple of it |
| `--helpdesk-width` | The widest the portal gets (default `68rem`) |
| `--helpdesk-success`, `--helpdesk-warning`, `--helpdesk-danger` | Status and notice colours |

For example, in your theme's CSS:

```css
:root { --helpdesk-accent: #8428df; }
```

Inside the portal, the theme's heading decorations and automatic hyphenation are turned off, and lists carry no theme bullets.

## Override templates

Every portal template lives under the plugin's `templates/`, and your theme wins when it ships a file with the same path under its own `templates/`. The text comes from `languages/en.yaml` under `ICU.PLUGIN_HELPDESK_PRO.PORTAL_*`, so translating the portal means translating those strings.

| Template | What it renders |
|---|---|
| `helpdesk.html.twig` | The Help Center page type; hosts every portal page inside your theme's layout |
| `helpdesk/home.html.twig` | The help center home |
| `helpdesk/form.html.twig` | The new request page |
| `helpdesk/list.html.twig` | Your requests |
| `helpdesk/ticket.html.twig` | One request |
| `helpdesk/not-found.html.twig` | "We couldn't find that request" (or "that topic"), sent with a 404 |
| `helpdesk/articles.html.twig`, `helpdesk/category.html.twig` | The articles index and one category |
| `helpdesk/sign-in.html.twig` | The sign-in form shown in place of a page that needs an account |
| `helpdesk/unsubscribe.html.twig` | The unsubscribe confirmation page |
| `helpdesk/rate.html.twig` | The rating page |
| `helpdesk/partials/*.html.twig` | The pieces: `portal-nav`, `search-box`, `ticket-form`, `form-extra`, `ticket-body`, `thread`, `message`, `attachments`, `reply-form`, `attach-field`, `status-pill`, `ticket-row`, `my-requests`, `notice`, `sign-in-form`, `time`, `icon`, `topic-card`, `link-list` |

Templates read everything from one `portal` variable (`portal.urls`, `portal.ticket`, `portal.timeline` and so on) and never see raw database rows. The knowledge base templates are listed in [Knowledge base](../knowledge-base#templates).

## Twig functions

Use these in any template, or in a page with Twig processing on, to bring the portal into the rest of your site.

| Function | Returns |
|---|---|
| `helpdesk_url(name, params = {})` | The URL of a portal page. Names: `home`, `form` (or `new`), `list` (or `tickets`), `ticket` (pass `{id: 12}`), `login`, `search` (pass `{q: '…'}`), `articles`. Other params become the query string, so `helpdesk_url('form', {q: 'Refund'})` opens the form with the summary filled in. |
| `helpdesk_nav(options = {})` | The portal's nav row, for a theme that set `portal.nav` to `false`. Options: `current` (`home`, `articles`, `list` or `new`; by default the one the page's address falls under) and `wrap` (`false` leaves out the `.helpdesk` wrapper). |
| `helpdesk_ticket_form(options = {})` | The new request form. Options: `project` (an id or slug to preselect) and `compact` (a smaller form for a sidebar). A visitor who is not signed in sees a sign-in link instead. |
| `helpdesk_my_requests(limit = 5)` | The signed-in person's most recently active requests, with a link to all of them. Empty for visitors. |

```twig
<a href="{{ helpdesk_url('list') }}">My support requests</a>

{{ helpdesk_ticket_form({project: 'billing', compact: true}) }}

{{ helpdesk_my_requests(3) }}

{# In a theme that set portal.nav: false #}
{{ helpdesk_nav() }}
```

The functions add the portal's stylesheet and script to the page themselves, and wrap their output in `.helpdesk` so the styles apply outside the help center too. The knowledge base adds [functions of its own](../knowledge-base#twig-functions).

## Accessibility

Every field has a visible label, errors are tied to their field and announced, the current tab and nav link are marked with `aria-current`, the conversation is a labelled list, times are real `<time>` elements, and focus is visible on every control. Status colours are never the only signal: each status also has its words. Every page works without JavaScript, in the theme's light and dark modes, and at phone width with no sideways scroll.

## Related

- [Request form and guests](../request-form)
- [Sign-in links](../sign-in-links)
- [Knowledge base](../knowledge-base)
- [Configuration](../configuration)
