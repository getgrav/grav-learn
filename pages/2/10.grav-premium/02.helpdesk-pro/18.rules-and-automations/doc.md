---
title: Rules and Automations
taxonomy:
    category: docs
description: When/if/then rules, the time trigger, the guards that stop rules looping, the built-in auto-close, and the dry run.
---

# Rules and Automations

A rule does the routine part of ticket work for you: when something happens to a ticket, and the ticket matches what you describe, change it, leave a note, tell someone, or send the client a saved reply. Rules are made in the desk under **Automation → Rules** by staff with `helpdesk-pro.settings`.

A rule is always three parts: **when** (one trigger), **if** (conditions on the ticket) and **then** (one or more actions). There is no workflow editor and no chain of states.

## When: triggers

| Trigger | Key | Fires when |
|---|---|---|
| A ticket is created | `ticket.created` | A new ticket is saved, from any channel. |
| The client replies | `client.replied` | A client (the requester or a cc) adds a public reply. A reply by email that only quoted the thread does not count. |
| Staff reply to the client | `staff.replied` | A staff member adds a public reply. |
| A note is added | `note.added` | A staff member adds an internal note. |
| The status changes | `status.changed` | The ticket moves to another status. |
| The ticket is assigned | `ticket.assigned` | The assignee changes, including to nobody. |
| The priority changes | `priority.changed` | The priority changes. |
| A custom field changes | `ticket.fields_changed` | Someone changes one or more [custom fields](../custom-fields). Pair it with **Changed field** to react to one field only. |
| The organization changes | `ticket.organization_changed` | The ticket is moved to another [organization](../organizations), or out of one. |
| An SLA target is due soon | `ticket.sla_warning` | A target enters its warning time ([SLA](../sla)). |
| An SLA target is breached | `ticket.sla_breached` | A target passes its due time with the work not done. A breach found after the ticket was already answered or resolved does not fire. |
| The client rates the ticket | `ticket.rated` | The client answers "How did we do?", or changes their answer ([Customer ratings](../customer-ratings)). |
| The client comments on their rating | `ticket.rating_commented` | The client adds or changes the comment under an answer that stays the same. |
| A ticket has been in a status for a while | `time` | The ticket has been in one status (or any status of one category) for a number of hours: "waiting on the client for 72 hours". Checked every ten minutes by the `rules.sweep` job. |

A time rule fires **once per ticket per stay** in the state. If the ticket leaves the state and comes back, the clock starts again, and the rule can fire again after the same number of hours. The stay is measured from the ticket's last status change, so moving between two statuses of the same category starts a new stay too.

## If: conditions

Each condition tests one field. Choose **all** (every condition must match) or **any** (one is enough). A rule with no conditions matches every ticket its trigger fires on.

| Field | Key | Tests |
|---|---|---|
| Project | `project` | is one of / is not one of |
| Status | `status` | is one of / is not one of |
| Status category | `status_category` | is one of / is not one of |
| Priority | `priority` | is one of / is not one of / at least / at most |
| Labels | `labels` | has any of / has all of / has none of / has a label / has no labels |
| Channel | `channel` | is one of / is not one of (web, email, staff, api) |
| Assignee | `assignee` | is one of / is not one of / is assigned / is unassigned |
| Requester email | `requester_email` | is / ends with / contains / does not contain |
| Requester email domain | `requester_domain` | is one of / is not one of (`example.com`) |
| Subject | `subject` | contains / does not contain / is |
| Message text | `body` | contains / does not contain |
| Kind | `kind` | is one of / is not one of (support, bug, feature) |
| Organization | `organization` | is one of / is not one of / has none |
| SLA state | `sla.state` | is one of / is not one of: Breached, Due soon, On track or No policy (also when SLA is off) |
| SLA target | `sla.target` | is one of / is not one of: First response or Resolution. Which target a warning or breach is about. |
| Rating | `csat.rating` | is one of / is not one of (Great, Okay, Not good) / has none. The newest time the ticket was asked. |
| Rating comment | `csat.comment` | is filled in / is empty / contains |
| Changed field | `fields.changed` | is one of / is not one of (custom field keys). Which fields an **A custom field changes** event is about. |
| A custom field | `field.<key>` | Depends on the field's type (below) |

Text tests ignore case. **Message text** is the message the trigger is about: the reply or note that was added, or the first message of a new ticket. For the time trigger, and in the dry run, it is the ticket's newest public message.

### Custom field conditions

Every custom field that is not archived is a condition of its own, keyed `field.` and the field's key (`field.plan`):

| Type | Tests |
|---|---|
| Select | is one of / is not one of / is filled in / is empty |
| Multi-select | includes any of / includes none of / includes all of / is filled in / is empty |
| Checkbox | is yes / is no |
| Number | is at least / is at most / is filled in / is empty |
| Date | is on or after / is on or before (`YYYY-MM-DD`) / is filled in / is empty |
| Text, long text, URL, email | contains / does not contain / is / is filled in / is empty |

A condition reads the value staff see, whatever its visibility. When a field is **archived**, a rule that tests it keeps the condition, but the condition never matches while the field is archived: the rules list marks the rule **Needs attention**, and the dry run marks the condition **Never matches**. Restore the field and the rule works again.

## Then: actions

A rule runs its actions in the order they are listed, each against the ticket as the actions before it left it.

| Action | Key | Value |
|---|---|---|
| Set the status | `status` | A status |
| Set the priority | `priority` | Low, Normal, High or Urgent |
| Assign to | `assign` | A staff member, or nobody (`none`) |
| Add labels | `add_labels` | One or more labels |
| Remove labels | `remove_labels` | One or more labels |
| Set the kind | `kind` | Support, bug or feature |
| Move to project | `project` | A project |
| Add an internal note | `note` | The note's text (Markdown) |
| Notify | `notify` | The assignee, everyone who works the project, or one staff member, with an optional message |
| Send the client a saved reply | `reply` | A shared saved reply that has text |
| Set a field | `set_field` | A custom field, then a value of its type; empty clears it |
| Post to channels | `channels` | An optional message (up to 500 characters) |

Every change goes through the same path as a person's change, so the activity, events, notifications, emails and live updates are exactly what they would be if a person had made it. Assigning to someone who does not work the ticket's project fails the same way it would on the desk.

- **Notify** puts a notification in the person's bell ("Rule “Big customers” flagged “Invoice missing”: please look today") and emails it when they do not read it in time. Only staff who can open the ticket are notified.
- **Post to channels** posts the ticket to every enabled [notification channel](../notification-channels) that ticks **Rule posts** and covers the ticket's project.
- **Set a field** checks the value like one typed on the desk. A field that does not apply to the ticket's project, or has been archived since, is skipped and the next action runs.
- **Send the client a saved reply** posts the reply as the Helpdesk system person, with its placeholders filled (`{{agent.name}}` is "Helpdesk"), and the client is emailed it as usual. Only shared saved replies can be used. The saved reply's own macro actions are not applied.

## The guards

Rules run in the order of the list; change it with **Move up** and **Move down** in Automation → Rules. A later rule sees the ticket as the earlier rules left it.

- **Rules act as the system.** A rule's changes are made by the Helpdesk system person, with the rule named in the activity: the ticket's timeline says "Rule “Big customers”" changed it.
- **A change made by a rule never triggers rules again.** A rule cannot set off another rule, or itself, so there is no loop to break. That includes a field set by a rule, and an SLA breach brought on when a rule raised the priority.
- **A rule never fires twice for the same event.** A replayed or retried event does nothing.
- **A failing rule is skipped, never fatal.** If an action fails (a person who no longer works the project, a deleted saved reply), the error is logged and shown on the rule, and the next rule still runs. The request that caused the event is never affected.

Rules run after the change that triggered them is saved, in the same request (or job, for email and the time trigger). Search, notifications and live updates hear about the change before any rule acts on it.

`rules.enabled` switches every rule off at once, without deleting any. Each rule can also be switched off on its own.

## The built-in auto-close

Helpdesk Pro ships one rule of its own, shown at the top of Automation → Rules: **Auto-close**. A resolved ticket whose client has been quiet for `rules.auto_close.nudge_days` gets a reply from Helpdesk saying the request will be closed in `rules.auto_close.close_days` days unless they answer. If the client stays quiet, the ticket is closed that many days after the nudge.

A reply from the client after the nudge cancels the close, because a client's reply reopens a resolved ticket. If the ticket is resolved again later, the cycle starts over.

It is **off by default**, because switching it on sends email to clients and closes their requests. Turn it on with the switch in Automation → Rules, or on the plugin settings' **Rules** tab. At most 50 tickets are nudged, and 50 closed, per sweep, so switching it on over a backlog spreads the email out.

The nudge's text is `rules.auto_close.message`; `{days}` becomes the close delay. Auto-close acts like a rule: it is named "Auto-close" in the activity, and its reply and close never trigger other rules.

## Examples

- **Escalate a breach.** Trigger **An SLA target is breached**, no conditions, actions **Set the priority** Urgent and **Notify** everyone who works the project.
- **Follow up an unhappy client.** Trigger **The client rates the ticket**, condition **Rating** is one of Not good, actions **Add an internal note** ("The client was not happy. Please call them.") and **Assign to** the team lead.
- **Tag VIPs from a field.** Trigger **A custom field changes**, conditions **Changed field** is Plan and **Plan** is Gold, action **Set a field** VIP customer to Yes.
- **Chase quiet clients.** Trigger **A ticket has been in a status for a while** (waiting on client, 72 hours), actions **Send the client a saved reply** and **Notify** the assignee.

## Create a rule

1. Open **Automation → Rules** and choose **New rule**.
2. Name the rule and pick the trigger.
3. Add conditions, and choose **all** or **any**. Each value is drawn for its field: pickers for projects, statuses, labels, staff and organizations, a number or date box, or text.
4. Add actions.
5. Use **Test against ticket** with a ticket number to see what the rule would do.
6. Save.

The rules list shows each rule as one sentence ("When a ticket is created, if the subject contains “invoice”: set priority to High."), with a switch, when it last fired and how many times, and the last error. A row's ⋯ menu has Move up, Move down and Delete.

**Test against ticket** is a dry run of the rule as it is in the editor, saved or not. It says which conditions the ticket meets now, each in a sentence, and what the rule would change ("Set status to Resolved (now Open)"). It saves nothing and ignores the trigger: it answers "if this rule ran on this ticket now".

## Settings

On the **Rules** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `rules.enabled` | `true` | Runs the rules made in Automation → Rules. Off stops every rule at once without deleting any; the auto-close has its own switch. |
| `rules.auto_close.enabled` | `false` | The built-in auto-close. |
| `rules.auto_close.nudge_days` | `7` | Days a resolved ticket's client has been quiet before the nudge is sent. |
| `rules.auto_close.close_days` | `3` | Days after the nudge before the ticket is closed, unless the client replies. |
| `rules.auto_close.message` | `''` | The nudge's text. `{days}` becomes `close_days`. Blank uses the built-in text. |

## API and MCP

Every route needs `helpdesk-pro.settings`.

| Route | Body or query | Answer |
|---|---|---|
| `GET /helpdesk-pro/rules` | | `{items, builtin}`: the rules in order, each with its trigger, conditions, actions, `fire_count`, `last_fired_at`, `last_error`, `summary` (the rule in one sentence) and `problems`; `builtin` holds the auto-close. |
| `GET /helpdesk-pro/rules/catalog` | | `{triggers, conditions, actions}`: what the editor offers, including anything an add-on registered. |
| `POST /helpdesk-pro/rules` | `{name, enabled, trigger, time, match, conditions, actions}` | `201` with the rule. |
| `GET /helpdesk-pro/rules/{id}` | | The rule. |
| `PATCH /helpdesk-pro/rules/{id}` | Any of the create fields | The rule. Changing a rule clears its last error. |
| `DELETE /helpdesk-pro/rules/{id}` | | `204`. What the rule already did stays. |
| `POST /helpdesk-pro/rules/order` | `{ids}`, every rule once, first runs first | The rules in their new order. |
| `POST /helpdesk-pro/rules/test` | `{ticket_id, rule_id}` for a saved rule, `{ticket_id, rule}` for an unsaved one | `{ticket_id, matched, match, conditions, actions, summary}`. A ticket you cannot read is `404`. |

A rule in the API:

```json
{
  "name": "Chase quiet clients",
  "enabled": true,
  "trigger": "time",
  "time": {"status_category": "waiting_client", "hours": 72},
  "match": "all",
  "conditions": [{"field": "project", "op": "in", "value": [2]}],
  "actions": [
    {"type": "reply", "value": 14},
    {"type": "notify", "value": "assignee", "message": "Chased the client for you."}
  ]
}
```

`time` takes `status_id` instead of `status_category` for one status. **Set a field** is `{"type": "set_field", "field": "plan", "value": "gold"}`; a multi-select takes a list, a checkbox `true` or `false`, and `null` clears the field. A custom field condition is `{"field": "field.plan", "op": "in", "value": ["gold"]}`. Operators are stored as `in`, `not_in`, `has_any`, `has_all`, `has_none`, `is_set`, `is_empty`, `contains`, `not_contains`, `equals`, `ends_with`, `gte` and `lte`.

The auto-close is set through the plugin's config (`rules.auto_close.*`). The desk's switch saves it through the API plugin's config route (`PATCH /config/plugins/helpdesk-pro`), which needs `api.config.write`.

MCP tools: `list_rules`, `get_rule_catalog`, `get_rule`, `create_rule`, `update_rule`, `delete_rule`, `reorder_rules` and `test_rule`. A rule acts with the system's authority on every ticket, so give these tools to an AI client only with an API key you would trust to configure the desk.

## Related

- [Saved replies and views](../saved-replies-and-views)
- [SLA](../sla)
- [Troubleshooting](../troubleshooting#a-rule-did-not-fire)
- [Extending](../extending#rules-triggers-conditions-and-actions)
