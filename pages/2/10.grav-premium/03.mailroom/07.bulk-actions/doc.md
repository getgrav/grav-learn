---
title: Bulk Actions
taxonomy:
    category: docs
description: Select subscribers by hand, by page or by filter, then add or remove a list or a tag, unsubscribe or delete them, and read what was done and who was left alone.
---

# Bulk Actions

The Subscribers table, and every list's own page, can act on many people at once. Bulk actions need `mailroom.manage`.

## Select people

- Tick the box on a row to select that person.
- Tick the box in the header to select everybody on the page ("Select everybody on this page").
- Then choose **Select all N matching these filters** to act on everybody the current filters match, including people on other pages.

The bar shows "N selected" and a **Clear selection** link.

## The six actions

| Action | What it does |
|---|---|
| **Add to list** | Adds them to a list, asking how: an invite to confirm, or as already agreed with a note (see [Subscribers](../subscribers#add-people)). |
| **Remove from list** | Takes them off one list, recorded as done by you. Their other lists are not touched, and anybody not on that list is left as they are. |
| **Add tag** | Puts a tag on them: one you have, or a new one named in the dialog. |
| **Remove tag** | Takes a tag off them. |
| **Unsubscribe** | Takes them off every list, recorded as done by the site. Asks first: "Take N people off every list?" |
| **Delete** | Deletes them the way the single **Delete** does, leaving the suppression list alone. Asks first with the count: "Delete N subscribers?" |

A big selection is worked through 500 people at a time, with "Working: X of Y done." while it runs. People who start matching the filters halfway through are left out, so nobody who signs up mid-walk is swept in.

## What it says afterwards

When it finishes, the bar says what was done ("12 added", "3 invited to confirm", "40 tagged") and, by reason, who was left alone:

| Reason | Why |
|---|---|
| suppressed, bounced or complained | The address is never mailed, so it is never added. |
| left every list themselves / left this list themselves | Nobody is put back on a list they left by their own hand. |
| already on the list / already waiting to confirm | Nothing to add. |
| not on the list / without the tag / already tagged / already off every list | Nothing to change. |
| not an email address | A pasted line that is not an address. |
| no longer here | Deleted by somebody else in the meantime. |

"Nothing changed." means every selected person was left alone.

## From the API

The same actions are `POST /mailroom/subscribers/bulk` and the MCP tool `mailroom_bulk_subscribers`. Name who with exactly one of:

- `ids`: up to 500 subscriber ids;
- `filter`: the Subscribers table's filters (`q`, `status`, `source`, `list`, `list_status`, `tag`, `campaign_id`, `campaign_received`, `test`), walked 500 at a time. Send the answer's `next` back as `after`, and its `max_id` back as `max_id`, until the answer says it is finished;
- `addresses`: pasted addresses, one per line or separated by commas, each optionally with a name, for `add_to_list` only (at most 1000). New addresses become subscribers.

```bash
curl -k -X POST https://example.test/api/v1/mailroom/subscribers/bulk \
  -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"action": "add_tag", "tag": "webinar-2026", "filter": {"list": 3, "status": "subscribed"}}'
```

| Field | For |
|---|---|
| `action` | `add_to_list`, `remove_from_list`, `add_tag`, `remove_tag`, `unsubscribe` or `delete` |
| `list_id` | `add_to_list` and `remove_from_list` |
| `mode`, `note` | `add_to_list`: `invite` or `subscribed`, and with `subscribed`, where they agreed (required) |
| `tag` | `add_tag`: the tag, made if it is new |
| `tag_id` | `remove_tag` |
| `all` | `unsubscribe` and `delete` over a filter with nothing set: `true` to mean everybody |

The answer counts what was done and, by reason, who was skipped. See [REST API](../rest-api#subscribers).

## Related

- [Subscribers](../subscribers)
- [Tags and segments](../tags-and-segments)
- [REST API](../rest-api)
