---
title: Unsubscribe and Preferences
taxonomy:
    category: docs
description: The links at the foot of every campaign, the unsubscribe page and which lists it leaves, the mail client's one-click button, the preference centre, and view in browser.
---

# Unsubscribe and Preferences

Every campaign and automation email ends with a way out. This page covers the unsubscribe link, the mail client's own unsubscribe button, the preference centre and view in browser. None of them needs a login: the signed link is the credential.

## The email footer

Below every campaign and automation email:

- **Unsubscribe**: the unsubscribe page;
- **Choose what you hear about**: the preference centre;
- **View in your browser**: the email as a web page;
- "You are receiving this because you signed up for email from this site.", then your **Footer Text** and **Postal Address** on the branded layout (see [Templates and branding](../templates-and-branding)).

## The unsubscribe link

`{route}/u/{token}` opens a page, "Leave the mailing list?", with one button, **Unsubscribe me**, and a link, **Or choose what you hear about**, for somebody who wanted to leave one topic rather than all of them.

Opening the link changes nothing, because mail scanners open every link in an inbox before the person does. Pressing the button unsubscribes them at once (nothing waits for the worker) and shows "Done, you are off the list", with "Changed your mind? You can sign up again on the site whenever you like."

Which lists they leave depends on the email the link came from:

| The email | What they leave |
|---|---|
| A campaign | Whichever of the campaign's lists they are on. Their other lists stay. |
| An automation email | Every list, because an automation keeps going for as long as they are subscribed to anything. |
| An email with no campaign behind it | Every list |

Unsubscribe links work for ninety days. After that the page says "That link has expired" and points them at the link in a more recent email.

The unsubscribe is recorded as **The link in an email**, which counts as leaving by their own hand (see [Double opt-in and consent](../double-opt-in-and-consent#leaving-by-their-own-hand)).

> [!NOTE]
> **Unsubscribe on Opening the Link** (`unsubscribe.confirm_on_get`, on the **Signup** tab) is meant to let the link act on being opened. In 1.0.0 the unsubscribe page always waits for the button, whatever it says. Leave it off either way.

## The mail client's unsubscribe button

Campaign and automation emails carry `List-Unsubscribe` and `List-Unsubscribe-Post` headers (RFC 8058), which put an Unsubscribe button next to your name in Gmail, Apple Mail and others. The mail client sends a `POST` to the unsubscribe link with the body `List-Unsubscribe=One-Click`, and Mailroom acts on it at once and answers `200` with an empty body.

It leaves the same lists the link does, and is recorded as **Their mail client's unsubscribe button**. Because these requests come from a handful of the mail provider's servers, one with a valid link is never counted against the hourly limit; one whose link does not check out is counted as usual.

The Health screen's **One-click unsubscribe** check, and a dashboard banner, say when your transport drops these headers.

## The preference centre

`{route}/p/{token}` ("Your email preferences") shows:

- the address it is for;
- **Your name**, which they can change;
- a language picker, on a site with more than one language;
- **What you hear about**: every list they are on, plus every list marked **On the preference centre**, each with its description, to tick or untick;
- **Save my preferences**, and **Or stop all email from us**, which goes to the unsubscribe page.

On save:

- **Ticking a list they are not on joins it.** Somebody already confirmed joins straight away. Somebody who has not confirmed yet joins waiting, and the one confirmation they already have outstanding covers it ("We are still waiting for you to confirm this one. Check the email we sent.").
- **Unticking a list they are on** unsubscribes them from that list, recorded as **The preference centre**.
- A list that was not drawn on the page cannot be joined, whatever the form sends.

Every change is a row in their consent history. Preference links work for ninety days.

## View in browser

`{route}/v/{token}` shows the email itself as a web page, for a mail client that will not draw it. These links never expire, and neither do the open pixel and the click redirect, so an old email in somebody's inbox keeps working.

## Related

- [Lists and signup forms](../lists-and-signup-forms#the-public-pages)
- [Double opt-in and consent](../double-opt-in-and-consent)
- [Deliverability](../deliverability)
