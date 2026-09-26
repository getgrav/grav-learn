---
title: Campaigns
taxonomy:
    category: docs
description: Write a campaign, choose one list, several lists or every list with a segment, use merge tags, test two subjects, send a test, send or schedule it, and pause, resume, send to newcomers or retry what failed.
---

# Campaigns

A campaign is one email written once and sent to your lists: a subject, some Markdown, and who it goes to. This page covers the campaign editor, sending, and what you can do once a campaign has gone out.

Writing and editing campaigns needs `mailroom.manage`. Starting, resuming, test-sending, sending to newcomers and retrying failed sends also need `mailroom.send`.

## The Campaigns tab

**Campaigns** lists every campaign, newest first, with its status, the lists it goes to, how many it was sent to and its open and click rates. A status filter narrows it, with counts for the whole table.

| Status | Meaning |
|---|---|
| Draft | Not going anywhere. Edit it freely. |
| Scheduled | Waiting for its moment. It can still be edited, paused or cancelled. |
| Sending | Mail is going out now. It cannot be edited. |
| Paused | Stopped part way. Resuming carries on where it stopped. |
| Sent | Everybody in the audience has been sent to. |
| Cancelled | Stopped for good. It cannot be started again. |
| Stopped | Too many messages in a row were refused. Fix the mail settings and resume it. (`failed` in the API) |

## Write a campaign

Press **Write a campaign**, or **Start a campaign from this** on a [template](../templates-and-branding#templates), which copies the template's fields once.

| Field | What it is |
|---|---|
| Name | What the site calls it. Nobody outside sees this. |
| Subject | The subject line. May carry merge tags. |
| Preheader | The line an inbox shows after the subject. Empty lets the mail client pick the first words of the message. |
| Message | Markdown, wrapped in the same layout as every other email the site sends. |
| Layout | **Site branding** (your logo, colours and card) or **Plain** (no header or card). See [Templates and branding](../templates-and-branding). |

### Who it goes to

- **Send it to**: the first list, or **All lists, with a segment** to mail everybody on any list who matches a segment.
- **Also send to**: tick more lists. Somebody on more than one of them gets one copy.
- **Narrow it with a segment**: only the people on those lists who also match the segment are mailed. With **All lists, with a segment** a segment is required.

The count under the pickers says how many people will receive it right now, worked out the way the send is: each person once, and anybody suppressed, already off those lists, or who never confirmed left out. The campaign's page afterwards says "Sent to: Newsletter, Events" (or "All lists, matching" the segment).

### Who it comes from

**From name**, **From address** and **Reply-to**. Leave them empty to use the defaults from Mailroom's **Sending** tab; the editor says where each value comes from ("from Mailroom settings", "from the Email plugin").

### Counting and link tagging

- **Count opens** and **Count clicks** decide whether this campaign carries the open pixel and sends its links through the click redirect (see [Reports and tracking](../reports-and-tracking)).
- **How links are tagged** overrides the site's UTM values for this campaign's links back to your own site. Leave one empty to use the site default.

A new campaign starts with **Count opens** and **Count clicks** set the way **Track Opens** and **Track Clicks** are on the **Tracking** tab, and each campaign can say otherwise.

## Merge tags

Merge tags fill in per person. Write them in the subject, preheader or message:

| Tag | What it becomes |
|---|---|
| `{{ subscriber.name }}` | Their name |
| `{{ subscriber.first_name }}` | The first word of their name |
| `{{ subscriber.email }}` | Their address |
| `{{ site.name }}` | Your site's title (`site.title`) |
| `{{ site.url }}` | Your site's address |
| `{{ campaign.name }}` | The campaign's name |
| `{{ unsubscribe_url }}` | Their unsubscribe link |
| `{{ preferences_url }}` | Their preference centre link |
| `{{ browser_url }}` | The campaign in the browser |

`{{ store.name }}` and `{{ store.url }}` also work and give the same values as `site.*`. Not everybody has a name, so give a fallback:

```twig
Hello {{ subscriber.first_name|default('there') }},
```

Anything else is refused when you save, with the variable named, so a typo never reaches an inbox. The **Merge tags you can use** panel in the editor lists them.

## Test two subjects

Tick **Test two subjects** and write **The other subject**. Some of the audience gets one subject and some the other, and everybody else gets whichever did better. Only the subject differs.

- **How much of the list is tested**: 10 to 50 percent (default 20).
- **How long to wait before the winner goes out**: 1, 2, 4, 8 or 24 hours (default 4), counted from the moment the campaign starts.

The editor spells it out: "N people get one of the two subjects now; the other N get the winner at ...". The winner is the subject more people opened; on a campaign not counting opens it is the one more people clicked, and on a tie it is the first subject. The campaign's page shows both subjects with their own sent, opened and clicked counts, and which one won.

## Preview and test

Save the campaign, and the **Preview** pane draws it through the real layout with a sample subscriber, with the **Plain text part** below. Tracking is off in the preview, so nothing counts.

**Send a test** sends one copy to the address you give, with `[Test]` in front of the subject. Nothing is counted. Look at it in a real inbox before you send it to anybody else. A test send writes a test address row, so the unsubscribe link in it points at somebody; test addresses are left out of every table and audience.

## Send or schedule

- **Send it now**: asks "Send this to N people?", and mail starts leaving as soon as the worker picks it up.
- **Schedule it**: pick **Send at**, then confirm. It waits in the queue until then, and can still be edited, paused or cancelled.

Campaigns need the worker (see [Jobs and cron](../jobs-and-cron)). The worker sends at **Messages Per Minute** across every campaign, a slice of **Recipients Per Run** at a time.

Consent is checked again as each message is built, so somebody who left or was suppressed after the campaign started is not mailed.

## While it sends

| Button | What it does |
|---|---|
| **Pause** | Sending stops within one message. Resuming carries on where it stopped, and nobody is mailed twice. |
| **Resume** | Carries on a paused or stopped campaign. |
| **Cancel it** | Stops it for good. Whoever already received it keeps it. Offered on a scheduled, sending, paused or stopped campaign; a draft has **Delete** instead. |

After **Stop After Consecutive Failures** refused sends in a row (25), the campaign stops itself and a dashboard banner says so. Fix the mail settings, then **Resume**.

**Keep it up to date** fetches the campaign again every thirty seconds while its screen is open.

## After it went out

The campaign's page shows:

- the figures: sent to, delivered (or **Accepted**, what the transport took, when no provider reports deliveries), opened, clicked, bounced, failed, unsubscribed, with open and click rates;
- **The first 48 hours**: cumulative by the hour from the first message;
- **Links**: every link with its clicks;
- **Recipients**: everybody it went to, with what happened to each.

Two more buttons appear on a sent campaign:

- **Send to newcomers**: people who joined its lists after it went out (and match its segment) and never received it. "N people joined after this went out and never received it. Send it to them now?" Nobody gets a second copy, and it stays one campaign with one report. A subject test that already has a winner sends the winner.
- **Retry failed (N)**: sends the messages the transport refused (usually a transport that could not be reached for a moment) again. Bounces and complaints are never retried, and consent and suppression are checked again. A single failed send can be retried from the recipients list with **Retry**.

Only a draft or a cancelled campaign can be deleted; everything it recorded goes with it.

## Unsubscribing from a campaign

The unsubscribe link, and the mail client's unsubscribe button, take the person off whichever of the campaign's lists they are on and leave their other lists alone. See [Unsubscribe and preferences](../unsubscribe-and-preferences).

## Related

- [Templates and branding](../templates-and-branding)
- [Tags and segments](../tags-and-segments)
- [Reports and tracking](../reports-and-tracking)
- [Sending and providers](../sending-and-providers)
