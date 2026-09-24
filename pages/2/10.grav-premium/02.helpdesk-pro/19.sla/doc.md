---
title: SLA
taxonomy:
    category: docs
description: SLA policies with first response and resolution targets, business hours with timezones and holidays, the clock, warnings and breaches.
---

# SLA

SLA targets say how quickly a ticket should get its first reply and how quickly it should be resolved. Helpdesk Pro keeps a clock on every ticket a policy applies to, shows staff how long is left, warns before a target is missed, and records every breach for reports.

SLA is for staff. Clients never see a due time, a breach or a policy: not in the portal, not in their email, not through the API or MCP, and not in search.

## Policies

A policy is a pair of targets and the tickets they apply to. Set them in the desk under **Automation → SLA**, which needs `helpdesk-pro.settings`. Anyone with desk access can read them.

- **First response**: business minutes from the ticket's arrival until the first public reply by staff. A note does not count, and neither does a client's reply.
- **Resolution**: business minutes until the ticket is resolved or closed. Time spent waiting on the client does not count.

Either target may be left empty; a policy needs at least one.

A policy applies to a ticket when the ticket meets its conditions. Each condition is a list of projects, priorities or kinds. The ticket must match one entry of every list that is not empty, and an empty list matches everything, so a policy with no conditions matches every ticket.

Policies are checked in the order Automation → SLA lists them, and **the first match wins**. Move a policy up or down with its row menu. One policy may be marked **default**: it applies to any ticket no other policy matches. A disabled policy is skipped. A ticket that nothing matches has no SLA.

A typical setup is one policy per priority, most urgent first, with the normal one as the default:

| Policy | Conditions | First response | Resolution |
|---|---|---|---|
| Urgent | priority urgent | 30 minutes | 4 hours |
| High | priority high | 2 hours | 1 day |
| Standard (default) | none | 8 hours | 3 days |

## Business hours

A policy counts its targets in business hours, or around the clock when it has none. A set of business hours has:

- a **timezone** (an IANA name such as `Europe/London`). The schedule and holidays are in that timezone, whatever the server or the viewer uses.
- a **weekly schedule**: time ranges per day, in 24-hour time. A day with no range is closed. Several ranges make a lunch break (`09:00–12:00`, `13:00–17:30`). A range whose end is at or before its start runs past midnight: `22:00–06:00` on Monday covers Monday night until Tuesday 06:00. `24:00` is the end of the day.
- **holidays**: dates the whole day is closed, including the early hours of a night shift that began the evening before. A yearly holiday repeats on the same month and day every year.

Days that lose or gain an hour to daylight saving count the time that really passed. A target of 8 business hours set at 16:00 on a Friday, with 09:00–17:00 on weekdays, falls due at 16:00 on Monday.

Business hours used by a policy cannot be deleted; move the policy to other hours first.

## The clock

Each ticket a policy applies to has one clock. It runs while the ticket is in an active status category (new, open, waiting on us), **pauses** while it waits on the client, and **stops** when it is resolved or closed. Both targets are measured on the same clock.

- The first response is due when the clock has run the first response target. The first public staff reply meets it.
- The resolution is due when the clock has run the resolution target.

When the client answers and the ticket goes back to open, the clock carries on from where it stopped, so the waiting time is not held against the team. A due time exists only while the clock runs; a paused ticket shows how much is left instead.

A reopened ticket carries on too: a ticket resolved after 3 hours of an 8-hour target has 5 hours left when it comes back. A target breached before the ticket was resolved stays breached.

When a ticket's priority, kind or project changes, the policies are matched again and the due times recomputed with the time already spent carried over. Raising a ticket to urgent after 20 minutes, with a 30-minute urgent target, leaves 10 minutes. If the new target is already used up, the ticket is breached at once.

When a policy or a set of business hours changes, every live ticket is matched again in the background (the `sla.recompute` job). Resolved and closed tickets keep the record they finished with. A ticket that gets a policy for the first time this way is measured from its creation, less the time it spent waiting on the client.

## Warnings and breaches

- A target that comes within the warning time (`sla.warning_minutes`, default 60) raises a **warning** once.
- A target that falls due unmet is **breached** once. The breach is stamped with the moment it fell due and stays on the ticket for reports.

Both are found by the `sla.scan` job every minute, and straight away when a change moves a due time into the past. Each notifies:

- the **assignee**, at once (after the usual grace period for email), or
- when nobody is assigned, **every staff member who works the project**, in their next batch.

Notifications follow each person's level and email settings ([Notifications](../notifications)). SLA notifications count as aimed at the person, so the default `aimed` level emails them. A breach found after the fact, because the ticket was already answered or resolved, is recorded but not notified.

A warning or breach that a setup change brings about is recorded but not notified either. When you add the first policy to a busy desk, or shorten a target, the tickets that are now overdue show as Breached or Due soon and count in reports, but no bell rings and no email goes out, so the change does not flood everyone at once. From then on each ticket's clock notifies as usual.

A target shorter than the warning time warns as soon as its clock starts. Set `sla.warning_minutes` to `0` to send breaches only.

## In the desk

- **All tickets** shows a due badge on each open ticket that falls due within a day ("in 2h", "35m late"), with the exact due time on hover.
- The **Breached** and **Due soon** chips filter the list, with counts over the whole result, and save with a saved view like any other filter. **Breached** includes tickets resolved after a breach; add a status filter to see only open ones.
- The **Due soonest** sort puts overdue tickets first, then the nearest due, then tickets with no due.
- The ticket's **SLA** panel shows the policy, both targets with their due times, whether the clock is paused, and whether each target was met or breached.
- **Automation → SLA** lists the policies in matching order and the sets of business hours. Each opens in its own editor (`#/setup/sla/<id>`, `#/setup/sla-hours/<id>`), which asks before you leave with unsaved changes. Without `helpdesk-pro.settings` the screens are read-only.

SLA also works in [rules](../rules-and-automations): **An SLA target is due soon** and **An SLA target is breached** are triggers, and **SLA state** and **SLA target** are conditions.

## Settings

On the **SLA** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `sla.enabled` | `true` | Keep SLA clocks on tickets. Off, nothing is tracked, the desk shows no SLA, and the scan does nothing; policies and hours stay as they are. |
| `sla.warning_minutes` | `60` | How long before a target falls due the warning is sent. `0` sends no warnings. |

## API and MCP

Reading needs `helpdesk-pro.desk`; changing needs `helpdesk-pro.settings`.

| Route | Permission | Body | Answer |
|---|---|---|---|
| `GET /helpdesk-pro/sla/policies` | desk | | The policies in matching order, each `{id, name, description, enabled, is_default, position, conditions: {project_ids, priorities, kinds}, first_response_minutes, resolution_minutes, business_hours_id, business_hours, open_tickets}`, and `meta: {enabled, warning_minutes}` |
| `POST /helpdesk-pro/sla/policies` | settings | `{name, description, enabled, is_default, conditions, first_response_minutes, resolution_minutes, business_hours_id}` | `201` with the policy. Priorities take `0`–`3` or their names. |
| `POST /helpdesk-pro/sla/policies/reorder` | settings | `{ids}`: every policy id, once | `204` |
| `GET /helpdesk-pro/sla/policies/{id}` | desk | | The policy |
| `PATCH /helpdesk-pro/sla/policies/{id}` | settings | Any field of the create body | The policy |
| `DELETE /helpdesk-pro/sla/policies/{id}` | settings | | `204`. Its tickets are matched against the other policies. |
| `GET /helpdesk-pro/sla/business-hours` | desk | | Each set `{id, name, timezone, schedule: {mon: [{start, end}], …, sun: []}, holidays: [{date, name, yearly}], policies}` |
| `POST /helpdesk-pro/sla/business-hours` | settings | `{name, timezone, schedule, holidays}` | `201` with the set |
| `GET /helpdesk-pro/sla/business-hours/{id}` | desk | | The set |
| `PATCH /helpdesk-pro/sla/business-hours/{id}` | settings | Any field of the create body | The set |
| `DELETE /helpdesk-pro/sla/business-hours/{id}` | settings | | `204`, or `409` while a policy uses it |
| `GET /helpdesk-pro/tickets/{id}/sla` | desk | | The ticket's SLA (below), or `null` when no policy applies |

A ticket's SLA, also under `extra.sla` in every staff ticket payload:

```json
{
  "policy": {"id": 1, "name": "Urgent"},
  "business_hours": {"id": 1, "name": "Office", "timezone": "Europe/London"},
  "state": "due_soon",
  "next_due_at": 1790000000,
  "breached_at": null,
  "paused": false,
  "paused_since": null,
  "first_response": {"status": "pending", "target_minutes": 30, "due_at": 1790000000, "met_at": null, "breached_at": null, "remaining_minutes": null},
  "resolution": {"status": "pending", "target_minutes": 240, "due_at": 1790012600, "met_at": null, "breached_at": null, "remaining_minutes": null}
}
```

`state` is `breached`, `due_soon` or null. A target's `status` is `pending`, `paused` (`remaining_minutes` says what is left), `met`, `breached`, `stopped` (resolved without a first response) or `none` (the policy has no such target). The ticket list takes `sla=breached,due_soon` and `sort=due` from staff.

MCP tools: `list_sla_policies`, `get_sla_policy`, `create_sla_policy`, `update_sla_policy`, `delete_sla_policy`, `reorder_sla_policies`, `list_business_hours`, `get_business_hours`, `create_business_hours`, `update_business_hours`, `delete_business_hours` and `get_ticket_sla`.

## Jobs

| Job | What it does |
|---|---|
| `sla.scan` | Every minute: stamps and notifies the warnings and breaches that have come due. Not booked while `sla.enabled` is off. |
| `sla.recompute` | After a policy or business hours change: matches every live ticket again and recomputes its due times, 200 tickets per run. |

## Related

- [Rules and automations](../rules-and-automations)
- [Reports](../reports)
- [Notifications](../notifications)
