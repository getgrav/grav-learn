---
title: Organizations
taxonomy:
    category: docs
description: Group clients by company, let them join by email domain, decide which organization a ticket belongs to, and share requests between colleagues.
---

# Organizations

An organization groups the clients who work at one company or team. It has a name, the email domains its people write from, notes only staff see, and one switch: whether its members read each other's requests.

Organizations are for clients. Staff never belong to one; which tickets staff read is set by the projects they work.

## What an organization holds

| Field | What it is |
|---|---|
| Name | Shown to staff everywhere, and to members on the portal. Unique, ignoring case. |
| Email domains | Up to 50, such as `acme.com`. A client whose address is at one of them joins by themselves. Each domain belongs to one organization at most. |
| Sharing (`share_tickets`) | Off by default. When on, members read each other's requests. |
| Notes | For staff only. Never sent to a client. |

Each client belongs to one organization at most. Deleting an organization leaves its people and tickets in place, with no organization.

## Create an organization

1. In the desk, open **Organizations** (in the Library band) and choose **New organization**.
2. Enter the name, the email domains, and any notes.
3. Switch on sharing if colleagues should read each other's requests.
4. Save.
5. On the organization's page, use **Add people from its domains** to bring in the clients you already have at those domains.

Reading organizations needs `helpdesk-pro.desk`; creating, editing and managing members needs `helpdesk-pro.people.manage`.

## Joining by email domain

A client joins the organization that lists their address's domain, by themselves, when:

- Helpdesk Pro first meets them by email (a new ticket or a reply from a new address), or
- they prove an address (a verified account, a sign-in link, or claiming an address), or
- staff change their address on the People screen.

Only a proven address counts, and only for a client who is in no organization yet. Someone who registers with an address they have not proven does not join, so nobody can read Acme's requests by signing up as `someone@acme.com`. A client already in an organization is never moved by their domain; staff move them.

**Public email providers are refused.** An organization cannot list `gmail.com`, `outlook.com`, `icloud.com`, `proton.me` or the other public providers Helpdesk Pro knows, because everyone with such an address would join it. Add more (a regional ISP, say) with `organizations.blocked_domains`. A refused domain comes back as a field error ("gmail.com is a public email provider"), and so does one another organization already lists.

When you add a domain to an organization that already has clients at it, **Add people from its domains** adds every client with a proven address there who is in no organization yet. An organization with no members offers the same on its Members card: **Add 2 people from acme.com**.

## Which organization a ticket belongs to

A ticket takes its requester's organization when it is created, and keeps it. **Moving a person to another organization does not move their earlier tickets**: those stay with the organization they were opened for, and new tickets go to the new one. A person who changes jobs does not take their old employer's requests with them.

Staff who can edit a ticket move it with **Change** on the ticket's Organization card. The move is written to the ticket's activity for staff, and when either organization shares tickets the desk says who gains or loses sight of it before moving.

## Share requests with colleagues

With sharing on, every member reads the organization's requests, whatever project they are in:

- **They read the public conversation**: the replies, the status and the public activity. Never internal notes or internal activity.
- **They only read.** A colleague cannot reply to, mute or mark solved a request they are not on. To let a colleague take part, add them to the request as a cc.
- **They are not emailed or notified** about requests they can merely read. Live updates do reach an open page.
- **They never read another organization's requests**, and nothing is shared while sharing is off.

Access follows membership on every request. Someone taken out of the organization, or whose organization turns sharing off, loses sight of its requests on their next page load.

On the portal, members of a sharing organization get **My organization** in the nav row, the organization's requests at `{mount}/organization`, and a **Mine | Acme** switch above both lists. Each shared request says who asked ("Asked by Ada"). See [Help center and portal](../help-center-and-portal#your-organization-s-requests). Search follows the same rule.

## On the desk

- **Organizations** (`#/organizations`) lists every organization with its domains, members and tickets, and searches names and domains.
- **An organization's page** (`#/organizations/<id>`) shows its members (with **Remove**), its recent tickets, its domains, whether it shares, and its notes. Its actions are **Edit**, **Add a member…** (by email; a new address becomes a new person), **Add people from its domains** and **Delete…**.
- **The editor** (`#/organizations/new`, `#/organizations/<id>/edit`) asks before you leave with unsaved changes.
- **A person's page** shows their organization and, for clients, has **Set organization…** in its menu.
- **A ticket** has an Organization card that links to the organization and moves the ticket.
- **All tickets** has an Organization filter under **More filters**: Any, No organization, or one organization (`#/tickets?organization=4` or `?organization=none`).

Organizations also work in [rules](../rules-and-automations) (the **Organization** condition and **The organization changes** trigger) and in [reports](../reports) (Top organizations).

## Merging and erasing people

Merging two people keeps the kept person's organization, or takes the other's when the kept person has none. Erasing a person takes them out of their organization; the tickets they opened keep it. See [People and privacy](../people-and-privacy).

## Settings

On the **Client Organizations** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `organizations.blocked_domains` | `[]` | More email domains no organization may list, on top of the public email providers Helpdesk Pro already refuses. |

## API and MCP

Every route is under `/api/v1`. Reading needs `helpdesk-pro.desk`; every change needs `helpdesk-pro.people.manage`, except moving a ticket, which needs the right to edit that ticket.

| Route | Permission | Request | Response | MCP tool |
|---|---|---|---|---|
| `GET /helpdesk-pro/organizations` | desk | `q`, `page`, `per_page` | Organizations by name | `list_organizations` |
| `POST /helpdesk-pro/organizations` | people.manage | `{name, domains, share_tickets, notes}` | `201` with the organization | `create_organization` |
| `GET /helpdesk-pro/organizations/{id}` | desk | | The organization with an `ETag` and `joinable` (how many clients `members/by-domain` would add) | `get_organization` |
| `PATCH /helpdesk-pro/organizations/{id}` | people.manage | `If-Match`; any of `{name, domains, share_tickets, notes}` | The organization | `update_organization` |
| `DELETE /helpdesk-pro/organizations/{id}` | people.manage | | `204` | `delete_organization` |
| `GET /helpdesk-pro/organizations/{id}/members` | desk | `page`, `per_page` | Its members | `list_organization_members` |
| `POST /helpdesk-pro/organizations/{id}/members` | people.manage | `{person_id}` or `{email, name}` | The person. Staff are refused (`422`). | `add_organization_member` |
| `POST /helpdesk-pro/organizations/{id}/members/by-domain` | people.manage | | `{added}` | `add_organization_members_by_domain` |
| `DELETE /helpdesk-pro/organizations/{id}/members/{personId}` | people.manage | | `204` | `remove_organization_member` |
| `GET /helpdesk-pro/people/{id}/organization` | desk | | `{organization: {id, name, share_tickets}}` or `{organization: null}` | `get_person_organization` |
| `PUT /helpdesk-pro/people/{id}/organization` | people.manage | `{organization_id}`, or `null` | The same | `set_person_organization` |
| `PUT /helpdesk-pro/tickets/{id}/organization` | desk, edit on the ticket | `{organization_id}`, or `null` | The ticket | `set_ticket_organization` |

An organization reads:

```json
{
  "id": 4, "name": "Acme", "domains": ["acme.com", "acme.co.uk"], "share_tickets": true,
  "notes": "Pays yearly.", "member_count": 12, "ticket_count": 87,
  "created_at": 1790000000, "updated_at": 1790000000
}
```

A ticket's organization is in its `extra.organization` as `{id, name}` (or `null`) for staff; clients never get it through the API.

## Related

- [Projects and permissions](../projects-and-permissions)
- [People and privacy](../people-and-privacy)
- [Help center and portal](../help-center-and-portal)
