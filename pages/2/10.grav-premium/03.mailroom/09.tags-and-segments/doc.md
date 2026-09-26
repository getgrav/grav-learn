---
title: Tags and Segments
taxonomy:
    category: docs
description: Tags as notes the site keeps about people, and segments as saved questions about your audience, with every field, operator and count, and how campaigns and automations use them.
---

# Tags and Segments

A list is a topic somebody chose. A tag is something the site noticed. A segment is a question asked of both. Tags and segments live on the **Audience** tab, below the lists.

## Tags

A tag is a label on a person, such as `webinar` or `early-adopter`. It has no consent and no state: removing one unsubscribes nobody, and deleting a tag takes it off everybody who has it and changes nothing else.

Tags come from:

- a signup box's `tags` option, the Form plugin action's `tags` parameter, or `tags` on the [subscribe API](../subscribe-api);
- an import's **Tags** column, or **Tag everybody in this file**;
- a person's page (the chips and the "A tag, new or existing" box), or **Add tag** on the [bulk bar](../bulk-actions);
- an automation's **Add a tag** step.

**Add a tag** on the Audience tab creates one from a **Label**. Codes are normalised: lower case, with spaces and underscores turned into hyphens, so "Early Access", "early access" and "early-access" are one tag. Each tag shows how many people carry it, and the count opens the Subscribers table filtered to them.

A tag can start an automation: **When the tag ... is added** (see [Automations](../automations)).

## Segments

A segment is a saved question about your audience: who is on which list, who has stopped opening, who joined last month. A campaign or an automation can be pointed at the answer.

### Build one

On the **Audience** tab, press **Build a segment**:

1. Give it a **Name** (what you pick it by when you write a campaign) and, optionally, a **Description**.
2. **Limit it to a list**, or leave it on **Everybody subscribed** and let the campaign decide the list.
3. Add conditions under **All of these** (somebody must match every one), **Any of these** (at least one) and **None of these** (anybody matching one is left out). Each condition is a **Field**, an **Operator** and a **Value**.
4. Watch **Who matches** beside the editor: the count as you build it, and the first ten people. Conditions with nothing filled in yet are left out of the count.
5. Save.

Anybody suppressed, already off the list, or who never confirmed is left out of every audience whatever the conditions say, and the count says how many ("12 are left out.").

### Fields and operators

| Field | Operators | Value |
|---|---|---|
| On list | is, is not | A list |
| Tagged | is, is not | A tag |
| Subscriber status | is, is not | A status |
| Joined | is before, is after, is within the last, is longer ago than | A date, or a number of days |
| How they joined | is, is not | `form`, `import`, `api`, `admin` or `automation` |
| Language | is, contains, is set, is empty | A language code |
| Was sent campaign | is, is not | A campaign |
| Opened campaign | is, is not | A campaign |
| Clicked in campaign | is, is not | A campaign |
| Has not opened anything in | is at least | A number of days |

The editor groups them under **Subscriber** and **Engagement**.

### Counts

A segment's count is worked out by the worker rather than on every page view, so every screen says how old it is ("Counted 4 minutes ago"). The worker recounts stale segments every **Recount Segments Every** (`segments.count_every_minutes`, 15, on the **Segments** tab); `0` recounts on every worker run, which is useful while you build one and not something to leave on. Changing a segment's conditions or list clears its count until the next recount.

Each segment's row has **Recount** (now), **Duplicate** and **Delete**, and says how many campaigns use it. A segment that draft or scheduled campaigns point at cannot be deleted until they point somewhere else. A segment that fails to count (usually a field from something no longer installed) raises a dashboard banner, "The segment ... could not be counted".

From the command line:

```bash
bin/plugin mailroom segments:count          # recount every segment now
bin/plugin mailroom segments:count --id=4   # one segment
bin/plugin mailroom segments:preview 4      # the count, who is left out, and ten masked addresses
```

### Where segments are used

- **Campaigns**: **Narrow it with a segment** mails only the people on the campaign's lists who also match it, and **All lists, with a segment** mails everybody on any list who matches it (see [Campaigns](../campaigns#who-it-goes-to)). A segment limited to a list needs that list among the campaign's lists.
- **Automations**: **Only people matching this segment** decides who is enrolled (see [Automations](../automations)).

### In the API

A segment's conditions are a document with three containers, `all`, `any` and `none`, each a list of `{field, op, value}`:

```json
{
  "name": "Quiet readers",
  "list_id": 1,
  "definition": {
    "all": [
      {"field": "not_opened_in_days", "op": "gte", "value": 90},
      {"field": "subscribed_at", "op": "older_than_days", "value": 180}
    ],
    "none": [
      {"field": "tag", "op": "is", "value": 7}
    ]
  }
}
```

`GET /mailroom/segments/vocabulary` lists every field with its type, operators and options; `POST /mailroom/segments/preview` answers a document without saving it. See [REST API](../rest-api#segments).

## Related

- [Lists and signup forms](../lists-and-signup-forms)
- [Campaigns](../campaigns)
- [Automations](../automations)
