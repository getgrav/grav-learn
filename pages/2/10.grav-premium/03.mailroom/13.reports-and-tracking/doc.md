---
title: Reports and Tracking
taxonomy:
    category: docs
description: How opens and clicks are counted without storing anything about the reader, link tagging for your analytics, and the seven reports with their windows, CSV export and definitions.
---

# Reports and Tracking

Mailroom counts opens and clicks in your own database, as timestamps against a send row. No IP address, no browser and no location is ever stored, and the numbers stay yours when you change mail provider. This page covers tracking, link tagging and the **Reports** tab.

## Opens and clicks

| Setting | Label | Default | What it does |
|---|---|---|---|
| `tracking.opens` | Track Opens | On | Adds an invisible image to each campaign (`{route}/o/{token}.gif`), so the site knows when it was read. |
| `tracking.clicks` | Track Clicks | On | Sends campaign links through the site's own redirect (`{route}/c/{token}`) so each link is counted. The reader lands on exactly the page the link named. |
| `tracking.retain_days` | Keep Detail For (days) | `365` | How long individual clicks and provider events are kept before the daily housekeeping sweeps them. A campaign's own totals survive the sweep. |

Each campaign has its own **Count opens** and **Count clicks** (see [Campaigns](../campaigns#counting-and-link-tagging)). A campaign that counts neither shows "Tracking is off for this campaign" on its page.

Opens are always an undercount: plenty of mail clients block the image, and somebody reading with images off never counts. When a provider webhook reports an open or a click that Mailroom's own pixel or redirect did not see, it fills the gap.

## Link tagging

Campaign links that point back at your own site can carry `utm_source`, `utm_medium`, `utm_campaign` and `utm_content`, which is how Google Analytics, Plausible, Fathom, Matomo and Umami tell you which visitors came from a campaign. Links to anywhere else are never tagged, and a link you tagged yourself in the message is left alone.

| Setting | Label | Default | What it does |
|---|---|---|---|
| `utm.enabled` | Tag Campaign Links | On | Off sends links exactly as written. |
| `utm.source` | Source | `newsletter` | What `utm_source` says. |
| `utm.medium` | Medium | `email` | What `utm_medium` says. |
| `utm.campaign` | Campaign | empty | What `utm_campaign` says. Empty uses each campaign's own name, as a slug. |
| `utm.content` | Content | empty | What `utm_content` says. Usually set on a campaign, to tell two versions apart. |

A campaign overrides any of the four under **How links are tagged**; one left empty falls back to the site default.

## The Reports tab

**Reports** answers why a campaign did what it did, and how it looks beside the ones before it. Pick a report, then a window: **Last 7 days**, **Last 30 days**, **Last 90 days**, **This year**, **All time** or **Between two dates**. Some reports are **Grouped by** day, week or month, and some can be narrowed to one list, campaign or automation. The window and choices travel in the page's address.

Every report has a row of headline figures, a table, **Export CSV**, and **What each of these figures means**, which gives the sentence that defines every figure and column. Numbers are kept for five minutes; **Refresh** reads the site again. Dates are in UTC, the clock Mailroom keeps; the send-times report uses the site's own timezone.

| Report | What it answers |
|---|---|
| Campaign performance | Every campaign that went out in the window, with sent, accepted, opened, clicked, bounced, left and complained, and five rates. A subject test says which subject won. |
| List growth | Who joined, confirmed, left and was suppressed per day, week or month, and how the people who joined came in. Narrow it to one list. |
| Engagement | How many subscribers read something in 30, 60 and 90 days, how many never opened anything, and how many are dormant, by list and by tag. |
| Links | What people pressed, across every campaign in the window, with each link's share of that campaign's opens. Narrow it to one campaign. |
| Bounces and complaints | Where mail is not arriving, by the company receiving it and by the company sending it, with hard, soft and refused bounces. |
| Automations | Who went into each automation, who is walking it now, who finished, who left early and why, and its emails' open and click rates. Pick one automation to see it step by step. |
| Send times | Opens by hour of the day and day of the week, and the busiest hour and day. |

A few definitions worth knowing:

- **Open rate** and **click rate** are worked out from the totals, not by averaging campaigns, so a campaign to forty people does not weigh the same as one to forty thousand. They are shares of everybody the campaign reached.
- **Accepted** is what the transport reported as delivered. A site whose transport reports nothing has zeroes there, which is a fact about the transport, not the campaign.
- **Bounced** on a campaign counts only messages that did not arrive (permanent bounces and refusals). The Bounces and complaints report counts every bounce, soft ones too, so its number is larger.
- **Dormant** is subscribers who were written to in the last ninety days and opened none of it. Somebody you simply have not written to is not dormant.
- The **complaint rate** is the figure to watch: Gmail asks bulk senders to stay under 0.1% and treats 0.3% as the line.

The **Overview** tab carries the short version: **Last campaigns**, each as its open, click, unsubscribe, bounce and complaint rate.

## From the API

`GET /mailroom/reports/{type}` answers a report as JSON, and `GET /mailroom/reports/{type}.csv` as a file. `type` is `campaigns`, `list-growth`, `engagement`, `links`, `bounces`, `automations` or `send-times`. Query parameters: `from` and `to` (dates, `YYYY-MM-DD`) or `preset` (`7d`, `30d`, `90d`, `year`, `all`), `bucket` (`day`, `week`, `month`), `list`, `campaign`, `flow`, and `refresh=1` to skip the five-minute cache. Rates are fractions between 0 and 1, and null where there was nothing to divide by. Both need `mailroom.view`.

## Related

- [Campaigns](../campaigns)
- [Deliverability](../deliverability)
- [Privacy](../privacy)
