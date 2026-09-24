---
title: Custom Fields
taxonomy:
    category: docs
description: Extra questions on tickets, per project, filled in by clients or kept by staff only, with list columns, filters and rules.
---

# Custom Fields

Custom fields are extra questions on tickets: an order number the request form asks for, the browser a bug was seen in, a contract level staff look up, a churn risk only staff should read. Each field has a type, applies to every project or to some, and decides who sees it.

Managing fields needs `helpdesk-pro.projects.manage`. Anyone with the desk can read the list.

## Create a field

1. In the desk, open **Setup → Fields** and choose **New field**.
2. Enter a **Label**. The **Key** is made from it until you type your own.
3. Pick a **Type**, and add **Options** for a Select or Multi-select.
4. Choose the **Visibility** and the **Projects** it applies to.
5. Optionally tick **Clients must answer it** and **Show as a column on All tickets**.
6. Save.

The list shows the fields in the order forms and the ticket sidebar show them; reorder them with the arrows. Each row shows the field's type, who sees it, its projects and how many tickets hold a value. A field's name opens its editor (`#/setup/fields/<id>`), which asks before you leave with unsaved changes.

| Setting | What it does |
|---|---|
| Label | What people read. |
| Key | The field's permanent name: lowercase letters, digits and underscores, starting with a letter (`order_number`). Fixed once the field exists, because filters, saved views, the API, MCP and rules name the field by it. |
| Type | Text, Long text, Number, Select, Multi-select, Checkbox, Date, URL or Email. Fixed once any ticket holds a value. |
| Help text | One line under the field on forms. |
| Visibility | Who sees it (below). New fields are **Staff only** until you say otherwise. |
| Clients must answer it | Only for fields clients fill in, and only on the web forms. |
| Options | For Select and Multi-select. Each option has a value (what is stored and what filters and the API use) and a label (what people read). Relabel an option any time; a saved option's value cannot change. |
| Projects | Every project (including ones made later), or a list. |
| Show as a column on All tickets | Adds the field to the ticket list. |

### Who sees a field

| Visibility | In Setup | The client | Staff |
|---|---|---|---|
| `public` | Clients fill in | Fills it in on the request form and sees it on their request | See and change it |
| `readonly` | Clients see | Sees it on their request, cannot change it | See and change it |
| `internal` | Staff only | Never sees it, anywhere | See and change it |

Staff here means staff who work the ticket's project. An internal value never reaches a client: not the portal, not the API or MCP, not client email, not live updates, and not search, which does not index field values at all.

### Types and what they accept

| Type | Accepts |
|---|---|
| Text | One line, up to 255 characters |
| Long text | Up to 10,000 characters, lines kept |
| Number | A whole or decimal number (`3,5` reads as 3.5) |
| Select | One of its options |
| Multi-select | Any of its options, kept in the options' order |
| Checkbox | Ticked or not; not ticked is no value |
| Date | `YYYY-MM-DD` |
| URL | An `http` or `https` address, up to 2,000 characters |
| Email | An email address |

An empty answer is no value, and saving one clears the field. Removing an option leaves tickets that hold it showing the old value as it was stored.

### Delete a field

A field no ticket holds a value for is deleted. A field with values is **archived** instead, and the confirm dialog says which will happen. An archived field leaves every form, the ticket sidebar, the portal, the list and the API, and its values stay stored.

- **Restore** brings it back with its values.
- **Delete permanently**, offered only on an archived field and confirmed a second time with the number of tickets it affects, removes the field and every value.

## On the request form

The portal's request form and the guest form show the public fields of the projects they offer. When the client picks a project, the form shows that project's fields and hides the rest; a hidden field is neither sent nor required. The partial `helpdesk/partials/form-extra.html.twig` draws them, and a theme can override it.

A required field left empty, or an answer the field refuses, brings the form back with a message under that field.

- **Required applies to the web forms only.** Tickets from email skip required fields, and so do tickets staff open on the desk or through the API.
- A client or guest can only ever set public fields. A value for a readonly or internal field sent with the form is dropped.

## In the desk

- **Fields panel.** The ticket sidebar lists the fields that apply to the ticket's project. Click a value (or **Add**) to edit it; **Enter** or **Save** stores it, **Escape** or **Cancel** puts it back, and a checkbox saves as it is ticked. A field clients can see says so beside its label. Every change is written to the ticket's staff-only activity ("set Plan to Pro").
- **New ticket.** The form shows the chosen project's fields.
- **All tickets.** A field marked **Show as a column on All tickets** gets a column, left out when no ticket on the page has a value. Under **More filters**, field filters work on select and multi-select options, Yes or No for a checkbox, and a from–to range for a date. They live in the address (`#/tickets?cf_plan=gold&cf_due=2026-09-01..2026-09-30`), so a saved view keeps them.

## On the portal and in email

A client's request page lists the public and readonly fields that have a value, as label and value in words. Clients cannot change values after sending the request.

A staff notification about one ticket lists the ticket's field values in a table under the message. Client email carries no field values at all.

## In rules

Every field that is not archived is a rule condition (`field.<key>`), **A custom field changes** is a trigger, and **Set a field** is an action. See [Rules and automations](../rules-and-automations#custom-field-conditions).

## Privacy

What a client typed into a public field can be personal (a phone number, an order reference). Erasing a person clears the public field values on the tickets they are the requester of, in both erasure modes. Readonly and internal values are what staff wrote and stay. See [People and privacy](../people-and-privacy).

## API and MCP

| Route | MCP tool | Permission |
|---|---|---|
| `GET /helpdesk-pro/fields` | `list_fields` | desk; a client gets public and readonly fields |
| `POST /helpdesk-pro/fields` | `create_field` | projects.manage |
| `PUT /helpdesk-pro/fields/order` | `reorder_fields` | projects.manage |
| `GET /helpdesk-pro/fields/{id}` | `get_field` | desk |
| `PATCH /helpdesk-pro/fields/{id}` | `update_field` | projects.manage |
| `DELETE /helpdesk-pro/fields/{id}` | `delete_field` | projects.manage |
| `POST /helpdesk-pro/fields/{id}/restore` | `restore_field` | projects.manage |
| `GET /helpdesk-pro/tickets/{id}/fields` | `get_ticket_fields` | desk; a client gets public and readonly fields on tickets they read |
| `PATCH /helpdesk-pro/tickets/{id}/fields` | `set_ticket_fields` | desk, and the right to edit the ticket |

Every API ticket carries its values under `extra.fields`, key to value, for the fields the caller may see. `POST /helpdesk-pro/tickets` takes `fields`, and the list takes `cf_<key>` filters, for staff only. The details are in [REST API](../rest-api#custom-fields).

```bash
curl -k -X PATCH "$BASE/tickets/1042/fields" -H "X-API-Key: $KEY" -H 'Content-Type: application/json' \
  -d '{"fields": {"plan": "gold", "renewal": "2026-12-01", "areas": ["api", "billing"], "vip": true}}'
```

Every value is checked first, and one bad value saves none (`422` with `fields.<key>` errors).

## Related

- [Request form and guests](../request-form)
- [Rules and automations](../rules-and-automations)
- [Reports](../reports)
