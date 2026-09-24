---
title: People and Privacy
taxonomy:
    category: docs
description: The People screen, blocking, merging, legal holds, erasing a person, and what Helpdesk Pro keeps about guests, clients and staff.
---

# People and Privacy

Everyone Helpdesk Pro knows is a person: staff, clients who sign in with a Grav account, and people who only ever wrote in by email or through the guest form. This page covers managing people, merging, legal holds and erasure, and what Helpdesk Pro keeps about everyone.

Reading people needs `helpdesk-pro.desk`. Everything that changes a person needs `helpdesk-pro.people.manage`.

## The People screen

**People** (`#/people`, in the Library band) lists everyone with a search box (name or email address), a kind filter (everyone, clients, staff) and a state filter (active, blocked, erased). All three are part of the address, so a filtered list is a link. A row's ⋯ menu has **Send sign-in link** and **Block** or **Unblock**. **Add person** creates an email-only client, for when you want to open a ticket for someone who has not written in yet.

A person's page (`#/people/<id>`) shows:

- their name, whether they are staff or a client, their state and any legal hold, and their address and Grav account;
- their requests, newest first;
- details: the address (with "not verified" when their account has not proven it), the linked Grav account, language, time zone, and when they were first and last seen;
- for staff who manage people, **What Helpdesk Pro holds about them**: the row counts behind a subject access request (requests, replies, notes, files, notifications, emails waiting, sign-in links, help center searches…), and a note about every other record with the same address, with **Merge it into** this person.

The ⋯ menu has Edit, Block or Unblock, Link a Grav account or Unlink it, Merge into…, Place or Release legal hold, and Erase. Erase is not offered while a legal hold is on.

## What staff can do

- **Edit** the name or the address. The address has to be free: two people can never hold the same one.
- **Block and unblock.** A blocked person cannot send requests, reply on the web or by email, or get sign-in links, and mail from them is logged and dropped. Their tickets stay and keep working for everyone else.
- **Send a sign-in link.** Emails the client a [sign-in link](../sign-in-links). The link is never shown to staff. It is refused for staff, for blocked and erased people, for people with no address, when `portal.magic_links` is off, and after five links to the same person in an hour.
- **Link or unlink a Grav account.** Link an existing account by its username when you know it is theirs: the account then sees the person's requests in the portal. An account another person already has is refused (merge the two people instead). Unlinking keeps the person and their tickets. An account whose address is proven and matches links itself again on its next sign-in, so unlink and change the address if they really are different people.

## One address, one requester

The same address can end up on two records: an email-only person who wrote in, and an account whose owner registered with that address but never proved it. Helpdesk Pro keeps them apart, because anybody can type anybody's address when registering.

The desk hides this from staff opening a ticket:

- The New ticket form's requester search shows **one entry per address**: the person a ticket for that address goes to. That is the account once its address is proven, and the email-only person until then.
- When an account has the address but has not proven it, the entry says **account not verified**. Picking it sends the address rather than the account, so the ticket goes to an email-only person for that address.

When the client proves the address later (a sign-in link, or "Verify your email to see earlier requests" in the portal), the two records join by themselves. The People list shows every record, so you can find both and merge them when they are the same human.

## Merge two people

Merge when two records are the same human: two addresses they write from, or an email-only record and the account they made without proving the address.

1. Open the person to merge away.
2. Choose **Merge into…** and enter the person to keep (their address or their number, such as `#42`).
3. Confirm.

Everything that points at the merged person moves to the kept one: requests, messages, cc and watcher rows, assignments, notifications, queued and sent email, uploaded files, sign-in links, project memberships, activity, help center history, saved views and replies, and received email. The merged record is then deleted.

- The kept person keeps their own name, address and account, and takes only what they lack.
- When the merged record held the address the kept account had not proven, the address becomes proven.
- The kept person keeps their organization, or takes the merged person's when they have none.
- If the merged record was blocked, the kept one is blocked too, and a legal hold moves to the kept person.
- Each ticket that changed hands gets an internal "person merged" line in its activity.

Two records that each have their own Grav account are never merged. Merging yourself away, merging into yourself and merging an erased person are refused too. A merge cannot be undone.

The same merge runs on its own when an account proves an address an email-only person already had: the account's record folds into the email-only person, who keeps their id and history and gains the account.

## Legal holds

A legal hold keeps a person's records from being erased, for example during a dispute or under a court order. While a person is held, erasing them is refused, and an erasure that was already queued stops when its job runs (its report says `held`).

The hold records its reason, who placed it and when. Releasing it deletes it, so keep the reason in your own records if you need it later.

## Erase a person

Erasure is for a request to be forgotten (GDPR). There are two modes:

| Mode | What happens |
|---|---|
| `anonymize` (default) | Their name and address become "Erased person #id". Their Grav account link, language, time zone, preferences, IP hash and sign-in links go; their bell and help center history are deleted; the raw emails kept behind their messages are deleted; they are taken off every ticket they only followed and unassigned; mail waiting for them is cancelled. What they wrote stays, as your record of the conversation. |
| `delete_content` | Everything `anonymize` does, and every message they wrote becomes "[removed]", the subject of every request they opened becomes "[removed]", and every file they uploaded is deleted. |

1. Open the person's page.
2. Choose **Erase** from the ⋯ menu and pick the mode.
3. Confirm.

Erasure runs as the `people.erase` job, normally within a minute, in one database transaction, and it cannot be undone. The person's page shows the erasure while it waits and its report once it has run. To erase at once from the server, run `bin/plugin helpdesk-pro erase <id>` (see [CLI](../cli#erase)).

It is safe to repeat: running it again changes nothing, and `delete_content` after `anonymize` removes what is left. Their Grav account is not deleted, since the account is the site's; remove it under **Accounts** in Admin Next if they asked for that too. If they sign in with it again, they start as a new, empty person.

### What erasure removes

| Data | `anonymize` | `delete_content` adds |
|---|---|---|
| Mail waiting for them | Cancelled; the address, variables and headers on their rows are emptied | |
| Their bell | Deleted. Other staff's notifications about them name "Erased person #id". | |
| Sign-in links and reply addresses | Deleted | |
| Files | Uploads they never sent are deleted | Every file on their messages and every file they uploaded is deleted |
| Messages | The raw email kept behind their messages is deleted | The body of every message they wrote becomes "[removed]" |
| Tickets | They are unassigned everywhere. Their requests stay theirs and show "Erased person #id". | The subject of every request they opened becomes "[removed]" |
| Ticket participation | They stop following every ticket; their requester rows are muted | |
| Projects | They leave every project and stop being any project's default assignee | |
| Help center history | Their searches and article views are deleted | "Before writing in" on their requests is deleted |
| Presence and live listeners | Deleted | |
| Saved views and replies | Their personal ones are deleted; shared ones stay | |
| Inbound log | The sender address is cleared and the raw message deleted | Subject and detail are cleared too |
| Ratings | Their rating links are deleted; ratings they gave lose their comment and their link to them | The ratings they gave are deleted |
| Organization | They leave it; the requests they opened keep it | |
| Custom fields | Public field values on their requests are cleared; readonly and internal values stay | |
| The person | Name becomes "Erased person #id"; address, proof, account link, language, time zone, preferences, permissions copy, last seen and IP hash are cleared; state becomes `erased` | |
| Activity | Each ticket they were on gets an internal "erased" line saying which mode ran | |

Files are never deleted inside the transaction. A file nothing else uses is marked for collection, and the `attachments.gc` job removes it from disk and from the bucket right after. The same bytes attached by someone else keep the file for them.

### Names in other people's words

Staff write the client's name: a saved reply fills in "Hi Nia,", a note says "Nia Long called again". So the erasure also goes through every ticket the person was on and replaces their name with "Erased person #id", in both modes. Tickets they were not on are never touched.

What is replaced, as whole words in any mix of upper and lower case:

- **Their email address**, as it was before the erasure.
- **Their full display name** ("Nia Long").
- **Their first name on its own**, when it is at least three letters long and is not also an everyday word.
- **A short or everyday first name** ("Al", "Will", "May", "Grace", and about a hundred more) only right after a greeting or thanks: "Hi", "Hello", "Hey", "Dear", "Thanks", "Thank you", "Cheers", "Welcome" or "Good morning/afternoon/evening".

Their last name alone is left, and so is a nickname they signed with. A colleague who shares their first name loses it on those tickets too. Formatting is kept, and running the erasure again changes nothing.

Emails are built when they are sent, so mail about the person's tickets that goes out after the erasure already reads "[removed]" and "Erased person #id". The search index rebuilds every ticket the person was on, and open desks refresh them. The blocklist keeps any entry staff made with their address.

## What Helpdesk Pro keeps

**A person** is a name, an address, whether the address is proven, the linked Grav account, a language and time zone, notification preferences, when they were last active (and a hash of their IP address, see below), and, for staff, a copy of their permissions and groups. **What Helpdesk Pro holds about them** on their person page is the starting point for a subject access request.

**A guest request** stores what the guest typed: their name (optional), their email address and the request. The address becomes an email-only person with no Grav account until they use a sign-in link. Nothing about the guest's browser or IP address is stored with the request.

**Sign-in links** are stored only as a SHA-256 hash, with who they were for, what they open, when they expire and when they were used, plus a hash of the IP address that asked. Rows are deleted a day after the link expires or is used.

**Rate limits** for the guest form and sign-in links count under hashed keys: an IP address or email address is never written as given. Counters are dropped after a couple of hours.

**The blocklist** holds exactly what staff put on it.

**The spam checks** read the form and nothing else. The honeypot is an empty field people never see, and the time trap is a signed time stamp in the form, not a cookie.

**Cookies.** The guest form and the sign-in page need Grav's session cookie for their form nonce. The help center sets one functional cookie, `hd_kb`, to connect a request to the searches before it (see [Knowledge base](../knowledge-base#the-help-center-cookie)). Signing in with a link adds nothing beyond the Login plugin's usual session.

**Captcha.** The default, Cap, runs entirely on your site. Cloudflare Turnstile and Google reCAPTCHA, if you pick them in `portal.captcha`, load a script from those companies and send them the visitor's answer and IP address. Mention that in your privacy notice if you use them.

**Notification channels** copy ticket facts to Slack, Discord, a webhook or a mailbox. Notes, internal fields, staff replies and the conversation never leave, and the client's own words only when you turn on **Include the first lines of a client's message**. Once posted, a message lives under that service's retention, not yours: erasing a person does not reach a Slack channel's history. See [Notification channels](../notification-channels#what-a-message-contains).

### Retention

| What | Kept for | Setting |
|---|---|---|
| A person's last IP address | Stored as a SHA-256 hash, or as given when off | `privacy.ip_hashing` (`true`) |
| Help center searches, views and answers | 90 days | `privacy.kb_events_days` |
| The raw copy of each received email | 90 days (`0` keeps it) | `privacy.inbound_raw_days` |
| Read notifications | 90 days | `notifications.keep_read_days` |
| Sent, failed and cancelled email rows, finished jobs | 30 days | `jobs.retention_days` |
| Channel delivery logs | 14 days | `channels.log_days` |
| Sign-in links and expired rating links | A day after they expire or are used | |

The daily `maintenance.prune` job does the deleting.

## API and MCP

The core people routes are in [REST API](../rest-api#people). These need `helpdesk-pro.people.manage`:

| Route | Body | Answer | MCP tool |
|---|---|---|---|
| `GET /helpdesk-pro/people/{id}/privacy` | | `{person, account, legal_hold, erasure, holdings, same_email, sign_in_link}` | `get_person_privacy` |
| `POST /helpdesk-pro/people/{id}/magic-link` | | `{sent: true}`; `409` with the reason when a link cannot go to them | `send_sign_in_link` |
| `POST /helpdesk-pro/people/{id}/merge` | `{into_id}` | The kept person; `409` for two accounts; `422` without `into_id` | `merge_person` |
| `POST /helpdesk-pro/people/{id}/erase` | `{mode: anonymize or delete_content}` | `202 {job_id, mode}`; `409` under a legal hold or for yourself | `erase_person` |
| `POST /helpdesk-pro/people/{id}/account` | `{username}` | The person; `409` when the account belongs to someone else | `link_person_account` |
| `DELETE /helpdesk-pro/people/{id}/account` | | The person | `unlink_person_account` |
| `PUT /helpdesk-pro/people/{id}/legal-hold` | `{reason}` | The hold | `place_legal_hold` |
| `DELETE /helpdesk-pro/people/{id}/legal-hold` | | `204`; `404` when there is none | `release_legal_hold` |

In the privacy summary, `holdings` is row counts by area, `erasure` is the newest erasure (`job_id`, `mode`, `state`, `requested_at`, `report`), `same_email` lists other records with the same address, and `sign_in_link` says whether a link can go to them and, when not, why.

## Related

- [Projects and permissions](../projects-and-permissions)
- [Sign-in links](../sign-in-links)
- [Organizations](../organizations)
- [Extending](../extending#people-and-erasure)
