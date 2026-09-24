---
title: Statuses and Labels
taxonomy:
    category: docs
description: The six fixed status categories, managing your own statuses inside them, the automatic status changes, and labels.
---

# Statuses and Labels

Statuses say where a ticket stands, and labels tag it for filtering and reports. Both are managed in the desk by staff with `helpdesk-pro.projects.manage`.

## Status categories

Every status belongs to one of six fixed categories. The categories never change; they are what reports, notifications, SLA clocks and client wording read.

| Category | Meaning | Clients see |
|---|---|---|
| `new` | Nobody has looked at it yet | Received |
| `open` | Being worked on | In progress |
| `waiting_client` | Waiting for the client to answer | Waiting for your reply |
| `waiting_us` | The client answered; the ball is with staff | In progress |
| `resolved` | Solved; the client can still reopen it | Solved |
| `closed` | Finished for good | Closed |

A fresh install has one status per category (New, Open, Waiting on client, Waiting on us, Resolved, Closed), each the default of its category.

## Manage statuses

**Setup → Statuses** (`#/setup/statuses`) is one table grouped by category, with how many tickets use each status (a link to those tickets). There are no transitions and no workflow: any status can follow any other.

- **Add status** asks for the category, a name and a colour. For example, add "Waiting on vendor" in `waiting_client`.
- Rename and recolour statuses, and move them up and down within their category.
- Choose each category's default. It is marked only where a category has more than one status.
- Archive a status you no longer use, or delete it.

These rules keep the history honest:

- Each category always has exactly one default and at least one status.
- A status's category can change only while no ticket uses it. Add a new status instead.
- Deleting a status that tickets use means choosing another status of the same category to move them to.
- An archived status cannot be the default and cannot be picked for a ticket. Tickets already on it keep it.

## What a status change records

Each ticket keeps the facts that reports and SLA need: when its status last changed, how long it has spent waiting on the client in total, when it was last resolved and closed, how many times it was reopened, and when staff first replied. These are recorded as they happen and cannot be rebuilt afterwards.

Status changes are internal activity, except entering or leaving `resolved` or `closed`, which the client sees in their request.

## Automatic changes

- The first public staff reply on a `new` ticket moves it to the default `open` status, unless the reply sets a status itself.
- A client's reply to a `resolved` ticket reopens it (default `open`), and one to a `waiting_client` ticket moves it to the default `waiting_us`.
- A client can mark their request solved (the default `resolved` status) and reopen it while it is resolved. A `closed` request cannot be reopened or replied to; the portal offers to start a new one.

## Labels

A label is either global (usable in every project) or belongs to one project. Names are unique within a project and among global labels.

**Setup → Labels** (`#/setup/labels`) creates, renames, recolours, archives and deletes labels. A label's name opens the tickets carrying it. Deleting a label takes it off every ticket.

- A label's slug is set when it is created and never changes, so renaming "Billing" to "Invoices" keeps anything that looks the label up by slug working.
- Moving a ticket to another project drops the labels that belonged to the old project and keeps the global ones.

## API and MCP

| Route | Permission | Request | Response |
|---|---|---|---|
| `GET /helpdesk-pro/statuses` | desk | `archived=1` | `{new: [...], open: [...], waiting_client: [...], waiting_us: [...], resolved: [...], closed: [...]}`, each status `{id, name, category, color, slug, position, is_default, archived, tickets}` |
| `POST /helpdesk-pro/statuses` | projects.manage | `{category, name, color}` | `201` with the status |
| `POST /helpdesk-pro/statuses/reorder` | projects.manage | `{category, ids}` | `204` |
| `PATCH /helpdesk-pro/statuses/{id}` | projects.manage | `{name, color, is_default, archived, category}` (category only while unused) | The status |
| `DELETE /helpdesk-pro/statuses/{id}` | projects.manage | `move_to_id` (query or body), required when tickets use it | `204` |
| `GET /helpdesk-pro/labels` | desk | `project`, `archived=1` | Global labels and those of projects you work; with `project`, what a ticket there can carry |
| `POST /helpdesk-pro/labels` | projects.manage | `{name, color, description, project_id}` (no `project_id` for a global label) | `201` with the label; `409` when the name is taken |
| `PATCH /helpdesk-pro/labels/{id}` | projects.manage | `{name, color, description, position, archived}` | The label |
| `DELETE /helpdesk-pro/labels/{id}` | projects.manage | | `204`. The label comes off every ticket |

MCP tools: `list_statuses`, `create_status`, `reorder_statuses`, `update_status`, `delete_status`, `list_labels`, `create_label`, `update_label` and `delete_label`.

## Related

- [The staff desk](../the-desk)
- [SLA](../sla)
- [Reports](../reports)
