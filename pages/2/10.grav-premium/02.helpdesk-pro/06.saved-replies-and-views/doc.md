---
title: Saved Replies and Views
taxonomy:
    category: docs
description: Saved replies with placeholders, macros that also change the ticket, saved views of the ticket list, and bulk edit.
---

# Saved Replies and Views

Three tools save staff from doing the same work twice: saved replies for text you send often, saved views for lists you open often, and bulk edit for changing many tickets at once.

## Personal and shared

Saved replies and saved views each come in two sets:

- **Personal**: only you see them. Anyone with `helpdesk-pro.desk` keeps their own.
- **Shared**: every staff member sees them. Creating, changing and deleting shared ones needs `helpdesk-pro.library.manage`, so a team lead keeps the shared set tidy.

A shared reply or view that you cannot change still shows for you, without Edit or Delete.

## Saved replies

**Saved replies** (`#/saved-replies`, in the Library band) lists the shared replies and yours, most used first.

### Create a saved reply

1. Open **Saved replies** and choose **New saved reply**.
2. Enter a **title** and the **text** (Markdown). Use [placeholders](#placeholders) for the client's name and the ticket's details.
3. Choose who sees it (you, or the team) and which project it is offered in (all projects, or one).
4. Optionally pick what else it does to the ticket under **When used, also** (see [Macros](#macros)).
5. Save.

In a ticket, **Insert reply** beside **Attach files** lists the replies offered in the ticket's project, most used first. Type to search titles and text; pick one and its text goes into the open composer tab (Reply or Note) with the placeholders already filled, and **then set status** moves to the reply's status when it has one. Sending counts a use of the reply.

### Macros

A saved reply that also changes the ticket is a macro. Under **When used, also**, pick any of:

- a status to set (the composer's "then set status")
- a priority
- an assignee: a staff member, **Me** (whoever uses the macro) or **Nobody**
- labels to add and labels to remove
- a project to move it to
- a kind (support, bug, feature)

When you insert a macro, a line above the text says what it will do before you send ("Also when sent: Assign to you; Add label Billing; Set priority to High"), with a **Leave the ticket as it is** button that keeps only the text. The status goes with the reply; the other changes are applied right after the reply is sent, as you, with the usual activity, notifications and live updates.

A macro may have no text at all: "Escalate" might only set Urgent and assign to the team lead. Picking one of those applies it at once, without sending anything.

A change the macro names that is no longer possible (an archived status, label or project, or a person who is no longer staff) is left out quietly rather than stopping the reply. [Rules](../rules-and-automations) can send shared saved replies to clients too, but not their actions.

### Placeholders

Write a placeholder in double braces. It is filled from the ticket when the reply is inserted.

| Placeholder | Filled with |
|---|---|
| `{{client.name}}` | The requester's name |
| `{{client.first_name}}` | The requester's first name |
| `{{client.email}}` | The requester's email address |
| `{{agent.name}}` | Your name |
| `{{agent.first_name}}` | Your first name |
| `{{ticket.id}}` | The ticket number, like 1042 |
| `{{ticket.subject}}` | The ticket's subject |
| `{{ticket.status}}` | The ticket's status |
| `{{ticket.url}}` | The link to the request in the help center |
| `{{project.name}}` | The ticket's project |
| `{{site.name}}` | The site's name |

Some people have no name on file, such as an email-only requester. Give a fallback after a bar: `Hi {{client.first_name | there}},` becomes "Hi Ada," or "Hi there,". A name that is really an email address counts as no name. A placeholder Helpdesk Pro does not know is left as written, so a typo shows in the draft instead of vanishing.

## Saved views

A saved view is a name for a set of filters and a sort on All tickets.

1. Filter and sort All tickets the way you want.
2. Choose **Save view**, name it, and say whether the team should see it too.

Your views and the shared ones appear as a row of links above the list, and a view opens the list exactly as it was saved. With a view open, **Update view** saves the current filters into it and **Delete view** removes it. A view marked as a default is listed first.

A view stores the list's own filter names, so a view naming a label that has since been deleted still opens; the missing label is dropped.

## Bulk edit

1. On All tickets, tick the tickets (or tick the box in the header for the whole page).
2. Use the bar that appears above the list: **Status**, **Assign**, **Priority**, **Project**, **Add label**, **Remove label**, or **Delete** (with `helpdesk-pro.tickets.delete`).

Up to 200 tickets change at a time. Each ticket is changed on its own, with its own activity and checks, so a ticket you may not change is skipped and the rest are saved. The desk tells you how many were changed and which were not, with the reason.

Watchers hear about a bulk change once. The bell folds what one person would get from it into one notification ("Anna changed the status of 50 tickets to Waiting on client"), which links to All tickets and is emailed at most once.

## API and MCP

| Route | Permission | Body or query | Answer |
|---|---|---|---|
| `GET /helpdesk-pro/saved-replies` | desk | `?project=&q=` | Your replies and the shared ones: `{id, title, body, project_id, shared, actions, usage_count, last_used_at, can_edit}` |
| `POST /helpdesk-pro/saved-replies` | desk (shared needs library.manage) | `{title, body, shared, project_id, actions}`; `actions` is `{status_id, priority, assignee_id, add_labels, remove_labels, project_id, kind}` (`assignee_id` is a staff id, `"me"` or `"none"`); `body` may be empty when there are actions | `201` with the reply |
| `GET /helpdesk-pro/saved-replies/{id}` | desk | | The reply, text as written |
| `PATCH /helpdesk-pro/saved-replies/{id}` | owner, or library.manage for shared | Any of the create fields | The reply |
| `DELETE /helpdesk-pro/saved-replies/{id}` | owner, or library.manage for shared | | `204` |
| `POST /helpdesk-pro/saved-replies/{id}/render` | desk | `{ticket_id}` | `{id, title, body, actions, summary}` with placeholders filled; `actions` holds only what is still possible |
| `POST /helpdesk-pro/saved-replies/{id}/apply` | desk, and editing the ticket | `{ticket_id, with_status}` | Applies the macro's actions and answers the ticket |
| `GET /helpdesk-pro/saved-views` | desk | | `{id, name, filters, sort, order, columns, shared, is_default, can_edit}` |
| `POST /helpdesk-pro/saved-views` | desk (shared needs library.manage) | `{name, filters, sort, order, columns, shared, is_default}`; `filters` is an object or a query string of list filters | `201` with the view |
| `PATCH /helpdesk-pro/saved-views/{id}` | owner, or library.manage for shared | Any of the create fields | The view |
| `DELETE /helpdesk-pro/saved-views/{id}` | owner, or library.manage for shared | | `204` |
| `POST /helpdesk-pro/tickets/bulk` | desk (delete needs tickets.delete) | `{ids, changes: {status_id, assignee_id, priority, kind, project_id, add_labels, remove_labels, delete}}` | `{updated: [ids], failed: [{id, reason}]}` |

`POST /helpdesk-pro/tickets/{id}/messages` takes `saved_reply_id` to count a use. Another person's personal reply or view is a `404`, like one that does not exist.

MCP tools: `list_saved_replies`, `get_saved_reply`, `create_saved_reply`, `update_saved_reply`, `delete_saved_reply`, `render_saved_reply`, `apply_saved_reply`, `list_saved_views`, `create_saved_view`, `update_saved_view`, `delete_saved_view` and `bulk_update_tickets`.

## Related

- [The staff desk](../the-desk)
- [Rules and automations](../rules-and-automations)
- [REST API](../rest-api)
