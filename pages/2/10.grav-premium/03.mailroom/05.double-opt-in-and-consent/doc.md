---
title: Double Opt-in and Consent
taxonomy:
    category: docs
description: The confirmation email and page, the consent sentence and what is recorded, each person's consent history, and what counts as somebody leaving by their own hand.
---

# Double Opt-in and Consent

Mailroom keeps a real record of permission: the sentence each person agreed to, when, from which address, whether they confirmed, and every change to their lists since. This page covers double opt-in, the consent record and the consent history, and the rule that keeps people who left from being put back.

## Double opt-in

Double opt-in is a list setting, **Ask people to confirm**. The **Ask People to Confirm** setting on the **Signup** tab (`double_opt_in`, on) is only the default for new lists. The default Newsletter list asks.

When somebody signs up to a list that asks:

1. They are added as **Waiting to confirm** on that list, and campaigns leave them out.
2. Mailroom emails them "Please confirm your email address for {site name}" with one button, **Yes, sign me up**, and the line "If you did not sign up, ignore this email."
3. The button opens `{route}/confirm/{token}`. Pressing **Yes, sign me up** on that page confirms them: every list waiting on them is confirmed at once, and they land on "You are on the list".

If they never press it, nothing is sent to them. The link works for seven days; after that the page says "That link has expired" and asks them to sign up again.

Somebody already subscribed to another list who signs up to a list that asks gets the same confirmation email for that list, and stays waiting on it until they press it.

The confirmation email goes out straight after the signup's response (see [Jobs and cron](../jobs-and-cron#the-drain-after-a-request)), and it waits on the queue while Mailroom has no site URL (see [Getting started](../getting-started#check-the-site-url)). **Confirmation Emails** (`messages.confirmation`) on the **Sending** tab switches them off; then nobody new can confirm.

### The confirmation page

Mail scanners open every link in an inbox before the person does, so opening the link never confirms anybody by itself. Two settings on the **Public Pages** tab decide how the page behaves:

| Setting | Label | Default | What it does |
|---|---|---|---|
| `confirm.auto_submit` | Press the Button for Them | On | The page presses its own button from a script as it loads, so a person who clicks the email goes straight to "You are on the list". A scanner that fetches the page without running scripts only sees the button. |
| `confirm.on_get` | Confirm on Opening the Link | Off | Opening the link confirms. Leave this off: a scanner that opens the link would confirm signups nobody confirmed. |

The page never presses its own button for somebody an admin invited or an import asked to confirm, because they never filled in a form themselves. It waits for their click.

### Confirm somebody by hand

For somebody whose confirmation email went to spam and who has asked you, in writing, to be on the list: open their page and choose **Confirm by hand**. Only a person still waiting moves. The record says the site confirmed them, not the person.

## The consent sentence

**Consent Sentence** (`consent_text`, on the **Signup** tab) is the wording beside the box to check on the signup box. The default:

> I agree to receive email from this site. I can leave with one click at any time.

When somebody agrees, Mailroom stores a hash of the sentence against them, so you can later prove exactly what they said yes to. Changing the sentence changes what new people see and leaves everyone who already signed up alone.

With a sentence set, a signup must carry `consent` (the checked box, or `"consent": true` in JSON); without it the answer is "Please check the box to say you are happy to hear from us." Clearing the sentence says your site asks for no explicit consent: the box disappears and none is required.

A signup box can show and record its own wording: give `mailroom_form()` a `consent_text` and that sentence is the one stored for the people who sign up through it, carried back with the form and signed with the site's secret (see [Lists and signup forms](../lists-and-signup-forms#the-signup-box)). A Form plugin form can record its own wording too: the `mailroom` action records `consent_text` when you give it, then the consent field's own label, then the site's sentence (see [Lists and signup forms](../lists-and-signup-forms#a-form-of-your-own-the-form-plugin-action)).

## What is recorded

A subscriber's page shows, under **Details**:

| Field | What it is |
|---|---|
| How they joined | **Signup form**, **Imported**, **API**, **Added by the site** or **An automation** |
| Agreed on | When they agreed. Somebody an admin invited has no date until they confirm. |
| From | The address their signup came from. See [trusted proxies](../subscribe-api#behind-a-proxy-or-a-relay) when your site sits behind one. |
| Confirmed on | When they confirmed |
| Left on, How they left | When they left every list, and by which door |
| Came in with | The import that brought them in, if one did |

## The consent history

Every change to somebody's lists is one row in their consent history, kept for as long as they are, never edited, and erased with them. Their page shows it under **Consent history**, newest first (the newest eight, the rest behind "Show N earlier"). Each row reads as one sentence:

| What happened | How it reads |
|---|---|
| They signed up | Signed up to Newsletter. |
| They confirmed | Confirmed Newsletter. |
| An admin confirmed them | andy confirmed them on Newsletter by hand. |
| An admin invited them | andy invited them to Newsletter. |
| An admin added them as already agreed | andy added them to Newsletter as already agreed. (with the note saying where they agreed) |
| They left one list, or every list | Left Newsletter. / Left every list. |
| An admin took them off | andy took them off Newsletter. |
| They came back | Came back to Newsletter. |
| An admin put them back on | andy put them back on Newsletter. (with the note saying how they asked) |
| An import | Imported onto Newsletter as already agreed. / Imported onto Newsletter and asked to confirm. (with the file name, or the import's basis) |
| An automation's "Add to a list" step | An automation added them to Events. |

A person's own changes also record the address and browser they came from. The same history is in `GET /mailroom/subscribers/{id}` as `consent_log` and in their [data export](../privacy#data-export-for-one-person).

## Leaving by their own hand

Somebody who left a list themselves has told you something no admin can overrule. Mailroom counts these as a person's own leaving:

- the unsubscribe link in an email (**The link in an email**),
- their mail client's unsubscribe button (**Their mail client's unsubscribe button**),
- the preference center (**Preference center**),
- a spam complaint (**A spam complaint**).

Nobody who left a list, or every list, that way is put back on it by an admin's add, **Add to list**, the bulk bar, a list's **Add people**, the list boxes on their page, an import, or an automation's **Add to a list** step. Each of those skips them and says why ("They left it themselves."). An admin who later unsubscribes or suppresses them does not change how they left.

The one way back is **Put them back on**, on their page, which needs a note saying how they asked ("How they asked": the email, call or conversation, and when). The note goes into their consent history. It is refused for an address that bounced, complained or is suppressed; remove the suppression first, as its own decision.

Somebody an admin took off, by contrast, can be added back by an admin.

## Related

- [Lists and signup forms](../lists-and-signup-forms)
- [Subscribers](../subscribers)
- [Unsubscribe and preferences](../unsubscribe-and-preferences)
- [Privacy](../privacy)
