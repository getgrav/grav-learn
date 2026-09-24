---
title: Triage and Merging
taxonomy:
    category: docs
description: Accept, mark as duplicate or decline new requests in the Triage queue, and merge two tickets about the same thing.
---

# Triage and Merging

Triage is the queue where requests from clients and guests wait before anyone works them. Merging turns two tickets about the same thing into one. Both need `helpdesk-pro.triage`.

## When a ticket waits in Triage

A ticket waits (its triage state is `pending`) when:

- it arrives from the web form or by email in a project whose **Triage required** setting is on, or
- the portal's guards hold a guest submission back as suspicious (see [Request form and guests](../request-form#spam)).

Tickets staff create never wait. The seeded Support project requires triage.

The client is told "We got your request" as soon as it arrives, whether it waits or not (the `client-received` email), and can read it in the portal straight away.

## The Triage screen

`#/triage` lists every waiting ticket you can see, oldest first. The count in the side menu and in the sidebar badge is the same number. Each row opens in place with the client's message, who sent it and any similar tickets, and three buttons:

- **Accept**: the ticket joins the normal flow. You can first move it to another project and choose its assignee, priority and kind. Leave the assignee alone and the project's default assignee takes it; pick "Nobody" to leave it unassigned.
- **Duplicate of…**: the ticket is closed as a copy of another. Search for the original by number or subject (similar tickets are offered first). **Let them follow the original** adds the client to the original as a cc, so they can read its replies, and their email links to it. It is ticked for you when both tickets share a client or the original is already shared with the project's clients.
- **Decline**: the ticket is closed. Write a short reason for the client, or tick **Don't email the client** to close it quietly (spam, for example).

Every decision can carry a note for the team, which is added as an internal note and never reaches the client. With a request open, the keys `a`, `d` and `x` start Accept, Duplicate of… and Decline.

`#/triage/<id>` opens one request directly. A waiting ticket opened anywhere else in the desk shows a **Triage** card in its sidebar with **Decide in Triage**. Without the triage permission the screen is read-only and says so.

## What each decision does

| Decision | Ticket | Activity | Client email |
|---|---|---|---|
| Accept | Triage state `accepted`; project, assignee, priority and kind as chosen | `triage`, internal | None, unless the client never got "We got your request" (a submission held back as suspected spam): then they get it now |
| Duplicate of… | Triage state `duplicate`, status closed; with "follow" the client joins the original as a cc | `triage`, public | `client-triage`: "We're already following this in another request", your reason, and a link to the original when they follow it |
| Decline | Triage state `declined`, status closed | `triage`, public | `client-triage`: "We won't be taking this request further" and your reason; nothing when **Don't email the client** is ticked |

A request is decided once; deciding it again answers `409`. The client's portal page shows "declined" or "duplicate" in their own words, never your note. The reason shows on the activity only when it was emailed.

## Merge two tickets

When the same problem arrives twice, merge one ticket into the other.

1. Open the ticket to merge away.
2. Choose **Merge into another ticket…** from the ⋯ menu in its header.
3. Enter the number of the ticket that should hold both conversations.
4. Read who would gain access, and confirm.

A merge:

- moves every reply and note, with their files and email threads, onto the target, in the order they were written;
- adds the merged ticket's requester and cc's to the target as cc's, and its watchers as watchers;
- carries over the labels the target's project can use;
- closes the merged ticket, pointing at the target, with its own activity kept, so an old link still says where the conversation went. A merged ticket that was waiting in Triage leaves the queue as a duplicate of the target.

A ticket merged into another stands for the ticket it was merged into, so a duplicate of it points at the live one.

### When a merge widens access

Merging can let people read what they cannot read today:

- the merged ticket's clients start reading the target's replies;
- the target's clients (its requester, cc's and, for a ticket shared with the project, the project's clients) start reading the merged ticket's replies;
- staff who work the target's project but not the merged ticket's start reading its notes.

Before merging, the desk shows who would gain access in plain words ("Ada Lovelace will be able to read the replies on #1042") and asks you to confirm. The API does the same: it answers `409` with `code: access_widens` until the request is sent again with `confirm: true`. Merging two tickets from the same client in the same project widens nothing and goes straight through.

## API and MCP

| Route | Permission | Body or query | Answer |
|---|---|---|---|
| `POST /helpdesk-pro/tickets/{id}/triage` | triage | `{decision, duplicate_of_id, follow_original, reason, notify, note, project_id, assignee_id, priority, kind}` | The ticket, with the stored decision under `decision`. `409` when it was already decided. |
| `GET /helpdesk-pro/tickets/{id}/merge` | triage | `?into_id=` | `{source, target, widens, reasons, target_thread, source_thread, source_notes}`; each group is `{count, people: [{id, name, kind}]}`. |
| `POST /helpdesk-pro/tickets/{id}/merge` | triage | `{into_id, confirm}` | The target ticket with `merged_from` and `moved_messages`. `409` `access_widens` with `widening` until confirmed. |

The waiting list is `GET /helpdesk-pro/tickets?triage=pending&sort=created&order=asc`. MCP tools: `triage_ticket`, `preview_merge` and `merge_ticket`. An AI client should call `preview_merge` and show its reasons before calling `merge_ticket` with `confirm`.

The `ticket.triaged` and `ticket.merged` events are listed in [Extending](../extending#domain-events).

## Related

- [The staff desk](../the-desk)
- [Request form and guests](../request-form)
- [Outbound email](../outbound-email)
