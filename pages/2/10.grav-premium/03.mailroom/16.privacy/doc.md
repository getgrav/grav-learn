---
title: Privacy
taxonomy:
    category: docs
description: What Mailroom keeps about a subscriber and what it never stores, exporting one person's data, erasing an address, and how long everything is kept.
---

# Privacy

Mailroom keeps what a newsletter needs to prove permission and to send well, and nothing about the reader beyond that. This page covers what is kept, one person's data export, erasure, and retention.

## What Mailroom keeps

**A subscriber** is an address (kept lower-cased), a name, a language, a status, how they joined (with an optional `source_ref` such as `footer`), and their consent: when they agreed, the address the signup came from, and a hash of the sentence they were shown.

**Their lists and tags**: one membership per list with where they stand on it and when, and the tags they carry.

**Their consent history**: one row per change to their lists, with the admin who made it and their note, or, for the person's own changes, the address and browser they came from. See [Double opt-in and consent](../double-opt-in-and-consent#the-consent-history).

**What they were sent**: one send row per campaign or automation email, with when it was sent, delivered, first opened and first clicked, and each link they pressed. Opens and clicks are timestamps and nothing else. No IP address, browser or location is stored for an open or a click.

**What the mail provider reported**: each delivery, bounce or complaint, kept with the address's hash and without the address itself, in the payload or in the provider's reason text.

**The message log**: every message Mailroom handed the Email plugin, with the address it went to.

**Rate limits** count under hashed keys: a visitor's address is never written as given, and an IPv6 address counts as its /64.

**A suppression** is keyed by the SHA-256 hash of the address, so it can outlive the address itself.

The visitor address on a signup is `REMOTE_ADDR`, unless the request came from a proxy listed in **Trusted Proxies** (see [Subscribe API](../subscribe-api#behind-a-proxy-or-a-relay)).

## Data export for one person

For somebody who asks what you keep about them, open their page and press **Export their data**. It downloads `<address>-data.json` with:

- their profile;
- every list, with where they stand on it and when;
- their tags;
- the whole consent history, oldest first;
- every message they were sent, with when it was opened and each link they pressed;
- what the mail provider reported about them;
- their automation walks;
- any suppression on their address;
- the import that brought them in;
- every message log row addressed to them.

It holds everything an erasure deletes about them. It leaves out their signing secret, the hashes, other people, and which admin made a change. The same document is `GET /mailroom/subscribers/{id}/export` and the MCP tool `mailroom_export_subscriber_data`. All three need `mailroom.manage`, like the CSV export.

## Erase an address

Erasure is for a request to be forgotten, by address, including somebody who asked by email rather than through a preference link:

```bash
bin/plugin mailroom erase ada@example.com
bin/plugin mailroom erase ada@example.com --yes   # do not ask first
```

or `POST /mailroom/erase` with `{"email": "ada@example.com"}` (needs `mailroom.manage`), or the MCP tool `mailroom_erase_address`.

Everything about the address goes: the subscriber, their list memberships, tags, sends, clicks, automation places, consent history, provider reports and every message log row. The one thing kept is a suppression, if there is one, with the address removed and only its hash left, so an address that bounced, complained or asked never to be mailed is still never mailed again. It shows as **address erased** on the Suppressions tab.

The command asks "Erase ada@example.com from Mailroom? This cannot be undone." unless you pass `--yes`, then lists how many of each were removed: subscribers, list memberships, tags, sends, clicks, automation places, consent history rows, provider reports, message log rows, and suppressions kept as a hash.

The API answers the same counts and never repeats the address:

```json
{"data": {"erased": true, "counts": {"subscribers": 1, "memberships": 2, "tags": 1, "sends": 14, "clicks": 3, "suppressions": 0, "enrolments": 1, "consent": 5, "events": 9, "messages": 15}}}
```

Erasure cannot be undone. For an address Mailroom holds nothing for, the command says "Mailroom held nothing for that address."

> [!NOTE]
> **Delete** on a subscriber's page is the lighter, everyday version: it removes the person but leaves the message log. Use erasure when somebody asked to be forgotten. See [Subscribers](../subscribers#unsubscribe-delete-suppress-or-erase).

## Retention

The daily housekeeping, run by the worker, does the deleting.

| What | Kept for | Setting |
|---|---|---|
| Individual clicks and provider events | 365 days (a campaign's totals stay) | `tracking.retain_days` |
| The message log | 180 days (`0` keeps it) | `mail_log.retain_days` |
| Finished and failed jobs | 30 days | `worker.retain_days` |
| Uploaded import files whose import never ran | 30 days (a finished import deletes its file at once; `0` keeps them) | `import.keep_days` |
| Subscribers, memberships, consent history | Until deleted or erased | |
| Suppressions | Until removed | |

Signed links carry their own expiry: confirmation links seven days, unsubscribe and preference links ninety days; the open pixel, click redirect and web view links never expire.

## Related

- [Double opt-in and consent](../double-opt-in-and-consent)
- [Subscribers](../subscribers)
- [Subscribe API](../subscribe-api)
- [CLI](../cli#erase)
