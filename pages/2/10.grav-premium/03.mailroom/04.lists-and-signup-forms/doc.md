---
title: Lists and Signup Forms
taxonomy:
    category: docs
description: Lists and their settings, the mailroom_form() Twig function and its options, several lists as boxes to tick, the Form plugin's mailroom action, and the public pages under the route base.
---

# Lists and Signup Forms

A list is a topic somebody can join and leave on its own: a newsletter, product updates, events. People join through a signup box on your site, a form of your own, the [subscribe API](../subscribe-api), an [import](../import-and-export) or an admin. This page covers the lists themselves, the signup box, the Form plugin action and the public pages.

## Lists

Lists live on the **Audience** tab, with tags and segments. A fresh install has one: **Newsletter**, code `newsletter`, which asks people to confirm and is the default list.

To add one, open **Add a list** and fill in:

| Field | What it does |
|---|---|
| Code | What a signup form names. Lowercase, no spaces, and it never changes once the list exists. |
| Name | What people read, on the preference centre and beside a box to tick. |
| Description | Optional. Shown under the name on the preference centre. |
| Ask people to confirm | Double opt-in for this list. New lists start with the **Ask People to Confirm** setting on the **Signup** tab (`double_opt_in`, on). On is the right answer for a form on a public page. |
| On the preference centre | Offer this list on the preference centre, so somebody holding a link from your mail can join it themselves. Off means it is joined through a form, an import or you. |

Click a list to open its own page: its code and settings, **Edit** (name, description, **Ask people to confirm**, **Default list**, **On the preference centre**), **Add people** (paste addresses, see [Subscribers](../subscribers#add-people)) and its people, with chips for where each stands on it and the same [bulk bar](../bulk-actions) as the Subscribers table.

- **Default list** is where a signup that names no list goes. Making one list the default clears the flag on any other.
- A list's code cannot be changed, because every signup form, import and campaign finds the list by it.
- Lists cannot be deleted. A list you no longer use can simply stay off the preference centre and out of your forms.
- A list's count on the Audience tab opens the Subscribers table filtered to the people subscribed to it.

## The signup box

`mailroom_form()` draws a signup box anywhere in a theme or in page content:

```twig
{{ mailroom_form() }}                    {# the default list #}
{{ mailroom_form('newsletter') }}        {# one list, by code #}
{{ mailroom_form('newsletter', {heading: 'Get the newsletter', name: true, source_ref: 'footer'}) }}
```

The first argument is the list's code. Left out, empty, or a code that names no list, the signup goes to the default list rather than being thrown away. The second argument is a set of options:

| Option | What it does |
|---|---|
| `heading` | The heading over the box. Default "Join the mailing list"; `''` for none. |
| `intro` | A line of text under the heading. |
| `button` | The button's text. Default "Sign me up". |
| `placeholder` | The email field's placeholder. Default "you@example.com". |
| `email_label`, `name_label` | The field labels. Defaults "Email address" and "Your name". |
| `name` | `true` adds a name field. |
| `tags` | Tag codes put on everybody who signs up here, as a list or one comma-separated string. |
| `source_ref` | Your own note of where they came from, such as `footer`, kept on the subscriber (up to 190 characters). |
| `lists` | More list codes to offer as boxes to tick (below). |
| `lists_label` | The heading over those boxes. Default "What would you like to hear about?". |
| `consent_text` | Different wording beside this form's box, and the wording recorded for the people who sign up through it (see the note below). |
| `template` | Draw a different partial instead of `partials/newsletter-signup.html.twig`. |

> [!NOTE]
> A form's own `consent_text` is the sentence recorded against the people who sign up through it. The form carries it back to the site in a hidden `consent_form` field, signed with the site's secret, so nobody can claim a sentence the site never showed. An empty `consent_text` shows the site's **Consent Sentence** (on the **Signup** tab) while the site has one; the box goes only when that setting is empty too. See [Double opt-in and consent](../double-opt-in-and-consent#the-consent-sentence).

### Several lists as boxes to tick

Offer two or more lists and the box draws them as boxes to tick, under each list's own name, none ticked:

```twig
{{ mailroom_form('newsletter', {lists: ['security', 'events'], lists_label: 'What should we send you?'}) }}
```

The first argument comes first, then `lists`, each once. A code that names no list is not offered. The person is signed up to the lists they tick, and the form will not send with none ticked ("Choose at least one list to join."). Each list keeps its own **Ask people to confirm**: one that asks is left waiting, one that does not is joined now, and one they are already on is left alone. However many lists wait on them, one confirmation email goes out, and pressing it confirms them all.

With fewer than two lists offered, the box is the ordinary one-list box.

### What the box does

- **With JavaScript**, the box posts its fields as JSON to `{route}/subscribe` and prints the answer where the form was.
- **Without JavaScript**, the same form posts normally with the site's nonce, and the site answers with a page saying the same sentence.
- **The consent box** is drawn when there is a consent sentence, and must be ticked. A form with no box sends no consent at all.
- **A honeypot field**, `website`, sits off screen with the label "Leave this field empty". A form filler that completes it is told it worked, and nothing is written.
- **The answer is the same** for a new address, one already on the list and a suppressed one, so the form never tells anybody whether a particular person reads your mail.
- **Signups are limited** to **Signups Per Hour** (`rate_limits.subscribe`, 10) from one visitor address. The eleventh gets "That is a few too many tries."

A signup through the box is recorded as **Signup form** (`form`), with or without JavaScript.

### Change the markup

Copy `templates/partials/newsletter-signup.html.twig` from the plugin into your theme's `templates/partials/` and edit it there. Every element has a `mailroom-*` class, and the form's ids are `mailroom-1`, `mailroom-1-email` and so on, numbered per form on the page. The box is styled by Mailroom's small stylesheet, which is on every front-end page (so the box is styled wherever you put it) and which **Mailroom Stylesheet** (`pages.builtin_css`) on the **Public Pages** tab turns off when your theme styles the classes itself. Its buttons and tick boxes take the **Accent Color** on the **Email Design** tab when you set one, and otherwise your theme's own accent where the theme has one (Quark2 does).

## A form of your own: the Form plugin action

For a form you define with the Form plugin, add Mailroom's `mailroom` action to its `process` list:

```yaml
form:
  name: newsletter-footer
  fields:
    email:
      type: email
      label: Email
      validate:
        required: true
    name:
      type: text
      label: Name
    consent:
      type: checkbox
      label: 'I agree to receive email from this site. I can leave with one click at any time.'
      validate:
        required: true
  buttons:
    submit:
      type: submit
      value: Sign me up
  process:
    - mailroom:
        list: newsletter
        tags: [site]
        email_field: email
        name_field: name
        consent_field: consent
    - message: 'Thanks. Check your inbox.'
    - reset: true
```

Every parameter is optional:

| Parameter | What it does |
|---|---|
| `list` | The list's code. Default: the default list. |
| `lists` | More list codes to join at once, as a list or one comma-separated string. Each keeps its own double opt-in, with one confirmation email for the lot. |
| `tags` | Tag codes for everybody who signs up. |
| `email_field` | The field holding the address. Default `email`. |
| `name_field` | The field holding their name. |
| `consent_field` | The consent box. Only a `checkbox`, `toggle` or `switch` field is a box that must be ticked. |
| `consent_text` | The sentence to record. Without it, the consent field's own label is recorded, then the site's **Consent Sentence**. |
| `language` | A language code to store on the subscriber. |

An address that is not an address, or a consent box left unticked, sets the form's error and stops the rest of the `process` list. Everything else succeeds with the same message the signup box gives. The signup is recorded as `form`, with the form's name as its `source_ref`, and it counts in the same hourly limit as the signup box.

## The public pages

Everything a subscriber sees answers under the route base, `/newsletter` unless **Route Base** (`route`, on the **Public Pages** tab) says otherwise:

| Path | What it is |
|---|---|
| `POST {route}/subscribe` | The signup box posts here. See [Subscribe API](../subscribe-api). |
| `{route}/confirm/{token}` | The double opt-in link |
| `{route}/u/{token}` | Unsubscribe |
| `{route}/p/{token}` | The preference centre |
| `{route}/v/{token}` | A campaign in the browser |
| `{route}/o/{token}.gif`, `{route}/c/{token}` | The open pixel and the click redirect |
| `POST {route}/webhook/{provider}/{secret}` | Provider events. See [Sending and providers](../sending-and-providers#provider-webhooks) |

A signed token is the only credential on any of them: none needs a login, and none is ever cached (`Cache-Control: private, no-store`, `Referrer-Policy: no-referrer`, `X-Robots-Tag: noindex, nofollow`). Anything else under the route base falls through to your site's own pages.

> [!IMPORTANT]
> Set the route base before your first campaign goes out. Links already mailed keep the route base they were sent with. An empty route base is read as `/newsletter`, since pages at the site root would sit in front of your own.

The confirm, unsubscribe, preference and message pages are drawn inside your theme (the web view is the email itself): they extend **Page Template** (`pages.base_template`, `partials/base.html.twig` when empty) and fill its `content` block. To change one, copy it from the plugin's `templates/` into your theme under the same name: `newsletter-confirm.html.twig`, `newsletter-unsubscribe.html.twig`, `newsletter-preferences.html.twig` or `newsletter-message.html.twig`.

Link pages (confirm, unsubscribe, preferences, view in browser) are limited to **Link Pages Per Hour** (`rate_limits.token`, 60) per visitor address, and the pixel and click redirect to **Opens and Clicks Per Hour** (`rate_limits.tracking`, 600). A spent limit on the pixel still answers its image, and on a click sends the reader to your site's front page, with nothing recorded.

## Related

- [Double opt-in and consent](../double-opt-in-and-consent)
- [Subscribe API](../subscribe-api)
- [Unsubscribe and preferences](../unsubscribe-and-preferences)
- [Subscribers](../subscribers)
