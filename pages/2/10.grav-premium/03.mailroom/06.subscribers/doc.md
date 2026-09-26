---
title: Subscribers
taxonomy:
    category: docs
description: The Subscribers table and its filters, a subscriber's page with their lists and tags, adding people with an invite or as already agreed, and the difference between unsubscribing, deleting, suppressing and erasing.
---

# Subscribers

A subscriber is one email address Mailroom knows, with a name, a language, a status, how they joined, their consent and their lists. This page covers the Subscribers table, a subscriber's page, and adding people by hand.

Reading subscribers needs `mailroom.view`. Every change needs `mailroom.manage`.

## The Subscribers table

**Subscribers** lists everybody, newest first. Above it:

- a search box ("An address or a name"), matching anywhere in an address or a name;
- a status filter: **Waiting to confirm**, **Subscribed**, **Left**, **Bounced**, **Complained**, with counts for the whole table rather than for the page;
- **How they joined**: Signup form, Imported, API, Added by the site, An automation;
- a list, and once a list is chosen, where they stand on it ("On it in any way", waiting to confirm, subscribed or left);
- a tag;
- a campaign, with **Sent** or **Not sent**: the people one campaign reached, or the people it did not, which is who a follow-up goes to.

The filters travel in the page's address, so Back and reload keep them and a filtered table is a link you can share. Counts on the Audience tab open the table already filtered. The Lists column names the lists somebody is on, and lists they are waiting to confirm as "Newsletter (pending)".

The buttons above the table are **Add somebody**, **Import** (see [Import and export](../import-and-export)) and **Export CSV**, which downloads the table as filtered. Every row has a box to tick for the [bulk bar](../bulk-actions).

**Test addresses** are kept apart. Sending yourself a test copy of a campaign writes a row for your address, so the unsubscribe link in it points at somebody. Those rows are left out of the table, the counts and every audience; the **Test addresses** view lists them.

## A subscriber's page

Click an address to open the person's page. It shows:

- **Details**: their status, how they joined (with the form's `source_ref`), when they agreed and from which address, when they confirmed, when and how they left, the import they came in with, their language and when they joined. See [Double opt-in and consent](../double-opt-in-and-consent#what-is-recorded).
- **Lists**: every list, with where they stand on it (**On**, **Waiting to confirm**, **Left** or **Not on it**) and **Add to list** or **Remove** beside it. A list they left themselves says "They left it themselves." and offers nothing.
- **Tags**: chips, each with a way to take it off, and a box ("A tag, new or existing") that adds one.
- **Consent history**: every change to their lists (see [Double opt-in and consent](../double-opt-in-and-consent#the-consent-history)).
- **What they were sent**: every campaign they were part of, with what happened to it (sent, delivered, opened, clicked, bounced, failed).

A form under the details edits their **Name** and **Language**. The email address cannot be changed: it is the key every consent record, suppression, send and signed link hangs off. To change an address, add the new one and remove the old.

The buttons at the top depend on where they stand:

| Button | Shown when | What it does |
|---|---|---|
| **Unsubscribe** | Subscribed | Takes them off every list, recorded as done by the site ("The site"). They can sign up again themselves. |
| **Put them back on** | Left, and not suppressed | Puts them back, with a required note saying how they asked. The only way back for somebody who left themselves. |
| **Confirm by hand** | Waiting to confirm, and not suppressed | Confirms them, recorded as confirmed by the site. Only when they asked in writing. |
| **Export their data** | Always, with `mailroom.manage` | Downloads everything held about them as `<address>-data.json`. See [Privacy](../privacy#data-export-for-one-person). |
| **Delete** | Always, with `mailroom.manage` | Removes the person, their lists, tags, consent history and every send they were part of. A suppression on the address stays. |

A suppressed address shows a notice at the top of the page and cannot be added to a list, put back or confirmed until the suppression is removed on the **Suppressions** tab.

## Add people

Every way of adding somebody by hand asks how:

| Choice | What happens |
|---|---|
| **Send them an invite to confirm** | The ordinary confirmation email. They wait on the list until they press it, and have no consent date until they do. |
| **Add as subscribed, they already agreed** | They are on the list now. Needs a note under **Where they agreed** (the form, email or conversation), which is kept in their consent history. |

The default follows the list's **Ask people to confirm**. The ways in:

- **Add somebody** on the Subscribers table: an address, a name and a list, then the choice above.
- **Add to list** on a person's page.
- **Add people** on a list's page: paste one or many addresses, on separate lines or with commas between them, each with a name beside it if you like. Addresses that are not subscribers yet become new ones.
- **Add to list** on the [bulk bar](../bulk-actions).

Some people are never added, whichever way you try:

- a suppressed, bounced or complained address ("This address is on the suppression list, so it is never mailed.");
- anybody who left that list, or every list, themselves (see [Leaving by their own hand](../double-opt-in-and-consent#leaving-by-their-own-hand)).

Somebody already on the list, or already waiting on it, is left as they are. People added by hand are recorded as **Added by the site** (`admin`).

For a whole list from another tool, use the [import](../import-and-export): it checks suppressions, counts what it did and keeps the file name as evidence.

## Unsubscribe, delete, suppress or erase

Four ways to stop mailing somebody, for four different requests:

| Action | Where | What goes | Can they come back? |
|---|---|---|---|
| Unsubscribe | Their page, the bulk bar | Nothing: they are taken off every list, recorded as done by the site | Yes, by signing up again |
| Delete | Their page, the bulk bar | The person, their lists, tags, consent history, sends and clicks | Yes, as a new person. A suppression stays |
| Suppress | **Suppressions**, **Add an address** | Nothing: the address is never mailed again, whatever any list or import says | Only if the suppression is removed |
| Erase | `bin/plugin mailroom erase`, `POST /mailroom/erase` | Everything about the address, including the message log, except a suppression's hash | Yes, as a new person, unless suppressed |

Erasure is for a request to be forgotten. See [Privacy](../privacy).

## Related

- [Bulk actions](../bulk-actions)
- [Double opt-in and consent](../double-opt-in-and-consent)
- [Import and export](../import-and-export)
- [Privacy](../privacy)
