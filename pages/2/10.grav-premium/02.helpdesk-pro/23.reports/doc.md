---
title: Reports
taxonomy:
    category: docs
description: The desk's Reports screen and its cards, how each number is counted, CSV export, and the Helpdesk report on Admin Next's Reports page.
---

# Reports

Reports show how the helpdesk is doing over a stretch of days: how many tickets came in and were resolved, how the backlog moved, how quickly people got a first reply and a resolution, SLA and customer satisfaction, and breakdowns by channel, project, assignee, organization and custom field. Everything is counted from facts every ticket already records, so reports cover the whole history from the first ticket, with nothing to switch on.

Reports need `helpdesk-pro.reports`. Staff see the numbers of the projects they work; admins see every project. No ticket subject, message or email address ever appears in a report.

## The Reports screen

**Reports** (`#/reports`) is in the Work band of the desk's side menu. At the top:

- **Period**: Last 7 days, Last 30 days (the default), This month, Last month, or Custom with a first and last day. The last day is included, and a last day after today counts as today.
- **Show**: one project or every project; everyone or one person's tickets (Me, Unassigned, or a staff member); and, when there are several, which custom field the "By field" card breaks tickets down by.

The choices are kept in the address (`#/reports?period=7d&project=2&staff=me`), so a report is a link you can bookmark or send.

| Card | What it shows |
|---|---|
| Tickets | Created, resolved and reopened in the period, and open now. |
| Open tickets | A line of the tickets open at the end of each day of the period. |
| Created and resolved | Bars per day. |
| Tickets now by status | Every ticket in each status category now. |
| Speed | The median and 90th percentile of the time to a first reply and to resolution, how many tickets had each, and how many tickets opened in the period still wait for a first reply. |
| SLA | Tickets opened in the period with a target, the share of first response and resolution targets met, breaches of each, and the average time against the average target. |
| Customer satisfaction | The score (the share of answers that were Great), the response rate, how many were asked, and the count of each answer. |
| By channel | Tickets created per channel with their share, and resolutions. |
| By project | Created, resolved, open now, the median first reply and CSAT per project. Left out when the report covers one project. |
| By assignee | For each staff member: tickets created in the period assigned to them now, their open tickets now, resolutions, median first reply and CSAT. Unassigned is the last row. |
| Top organizations | The ten organizations with the most tickets created in the period, with their open tickets now. |
| By field | Tickets created in the period by their answer to one select, multi-select or checkbox custom field, with "No answer". |
| Searches without an answer | The help center searches in the period that found nothing, most asked first, and how many searches found nothing out of all of them. |

Hover over a day on a chart to read its numbers. Each table and chart has a **CSV** button: durations in minutes, shares as percentages, and a cell that starts with `=`, `+`, `-` or `@` is written so a spreadsheet does not run it as a formula.

A card with nothing to show says why, and links to the fix where there is one: **SLA is off**, **No SLA policies**, **Ratings are off**, **No fields to break down by**, **No organizations yet**. When the report is narrowed to one staff member, the SLA card is not shown, because the SLA report counts every assignee.

## How the numbers are counted

- **Days** are the site's (`system.timezone`, else PHP's default). A period runs from midnight of its first day to midnight after its last, so a daylight saving day is still one day.
- **Deleted tickets** and tickets merged into another are left out everywhere.
- **Created**: tickets opened in the period.
- **Resolved**: each time a ticket moved into Resolved or Closed from any other status in the period. A ticket resolved, reopened and resolved again counts twice; one moved from Resolved to Closed does not count again. **Reopened** is each move back out of Resolved or Closed.
- **Open**: in any status that is not Resolved or Closed. The backlog on each day is worked back from the backlog now: open at the end of a day = open the day before + created − resolved + reopened.
- **First reply**: from opening to the first public reply by staff, for tickets opened in the period that have one.
- **Resolution**: from opening to when the ticket was last resolved (or closed, if it never was), for tickets whose resolution falls in the period.
- **Speed is calendar time**, nights and weekends included. The SLA card is business time where a policy uses business hours.
- **Median and 90th percentile**: half the tickets were faster than the median; 9 in 10 were as fast as the 90th percentile or faster.
- **A ticket counts in its project and against its assignee as they are now.** A ticket moved to another project takes its history with it.
- **Customer satisfaction** is over the resolutions clients were asked about in the period, per the staff member credited at the time.
- **Searches without an answer** cover the whole help center whatever the project and staff filters, lowercased so "Refund" and "refund" are one line. They are kept for `privacy.kb_events_days` days, so a period further back than that has none.

Each figure is one grouped query, never a query per ticket. On a development machine a whole report takes about 15 ms over 3,000 tickets, and 110 to 200 ms over 30,000 tickets and 60,000 status changes.

## Admin Next's Reports page

**Tools → Reports** in Admin Next includes a Helpdesk report, for accounts with `helpdesk-pro.reports` (and admins). It leads with **Last 30 days** (created, resolved, the median and 90th percentile first reply, and customer satisfaction and the SLA first response share when they are in use) and an **Open Reports** link to the desk's screen. It also shows tickets by status category and the job worker's health, and turns into a warning when the worker has stopped.

The numbers are totals only, and cover the projects the viewer works. An API key limited to scopes never sees this report.

## API and MCP

`GET /helpdesk-pro/reports` (permission `helpdesk-pro.reports`) takes:

| Parameter | Meaning |
|---|---|
| `period` | `7d`, `30d` (default), `this_month`, `last_month` or `custom`. |
| `from`, `to` | The first and last day, `YYYY-MM-DD`, for a custom period. At most 366 days. |
| `project` | Comma-separated project ids. Projects the caller does not work are dropped. |
| `staff` | Only tickets assigned to this person id, `me`, or `none` for unassigned. |
| `field` | The key of a select, multi-select or checkbox custom field for the field breakdown (default: the first). |

It answers `{period, filters, figures, cards, skipped}`:

- `period`: `{preset, from, to, start, end, timezone, days}`, where `start` and `end` are epoch seconds.
- `filters`: the project ids and staff actually applied, and the field.
- `figures`: the numbers: `volume`, `speed`, `sla`, `csat`, `channels`, `projects`, `assignees`, `organizations`, `field` and `kb_gaps`.
- `cards`: the same numbers as the desk draws them, including cards add-ons add.
- `skipped`: the ids of add-on cards that did not follow the card contract.

A bad period or an unknown field is `422` with the field named. The MCP tool is `get_report`. Add-ons can add cards of their own (see [Extending](../extending#report-cards)).

## Related

- [SLA](../sla)
- [Customer ratings](../customer-ratings)
- [Custom fields](../custom-fields)
