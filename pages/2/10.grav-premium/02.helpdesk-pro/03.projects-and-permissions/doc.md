---
title: Projects and Permissions
taxonomy:
    category: docs
description: Project settings and members, every helpdesk-pro permission, and the rules that decide who may read and change a ticket.
---

# Projects and Permissions

Projects decide who sees what, and permissions decide what staff may do. This page covers both, and the read and write rules that follow from them.

## Project settings

Every ticket belongs to one project. Projects are managed in the desk under **Setup → Projects**, which needs `helpdesk-pro.projects.manage`. A fresh install has one project, **Support** (slug `support`), which is public and requires triage.

| Setting | Values | What it does |
|---|---|---|
| Visibility | `private`, `members`, `groups`, `public` | Which clients may submit tickets and read the project's shared tickets (see below). Default `members`. |
| Staff access | `all`, `members` | `all`: every agent works the project. `members`: only agents added as members, directly or through a Grav group. Admins work every project either way. |
| Intake | `open`, `closed` | Whether clients may open new tickets here. Staff can always open tickets on a client's behalf. |
| Triage required | on, off | When on, tickets from the web form or email wait in Triage before anyone works them. Tickets staff create never wait. |
| Default kind | `support`, `bug`, `feature` | The kind of a new ticket when the client does not choose one. |
| Default assignee | a staff member | Accepted tickets are assigned to this person, as long as they work the project. |
| Board | on, off | Shows the project as a board in the desk. |
| Email alias | an address | Inbound email sent to this address opens tickets in this project, and replies to its tickets go there. |
| KB category | a category | The knowledge base category suggested alongside this project. |

The project page also holds its name and slug. It asks before you leave with unsaved changes.

A project that has tickets cannot be deleted. Deleting it archives it instead: an archived project keeps its tickets readable but takes no new ones.

### Members

A project has members of two kinds, each with a role, `agent` or `client`:

- **People**: a specific staff member or client.
- **Grav groups**: everyone in a Grav group. Group membership is read from the account on every request, so adding someone to the group in Admin Next is enough.

An `agent` member works a `members` project. A `client` member may submit to and read the shared tickets of a `members` project; a `client` group row does the same for a `groups` project. A client role never gives staff access.

## Permissions

Helpdesk Pro's permissions are Grav 2.0 access actions. Grant them to Grav groups or to individual accounts in Admin Next (**Accounts**, then the group or user, then **Permissions**). Grants through groups count. `api.super` counts as holding every Helpdesk Pro permission.

| Permission | What it allows |
|---|---|
| `helpdesk-pro.desk` | Work tickets: the desk, reading and working tickets in the projects you work, your own saved views and saved replies, notifications. Makes the account staff. |
| `helpdesk-pro.triage` | Accept, mark as duplicate or decline new requests; merge tickets. |
| `helpdesk-pro.tickets.delete` | Delete and restore tickets, delete messages, see deleted tickets. |
| `helpdesk-pro.people.manage` | Add and edit people, send sign-in links, block, merge and erase people. Create, edit and delete organizations and choose who is in them. |
| `helpdesk-pro.library.manage` | Create and edit shared saved replies and shared saved views. |
| `helpdesk-pro.projects.manage` | Projects, project members, labels, statuses and custom fields. |
| `helpdesk-pro.reports` | The Reports screen and `GET /helpdesk-pro/reports`, the ratings summary, the Helpdesk report on Admin Next's Reports page, and the dashboard widget. Reports cover the projects the account works. |
| `helpdesk-pro.settings` | Configure Helpdesk Pro: settings, rules, SLA policies, notification channels, the Email and Inbound log screens, search rebuilds, the status report, deleting tickets permanently. Makes the account an admin, who works every project and can do everything above. |

Staff also need `api.access`, which lets them into Admin Next at all. Everyone with `helpdesk-pro.desk` can read organizations and move a ticket they can edit to another organization.

The recommended groups are `helpdesk-agents` (`api.access`, `helpdesk-pro.desk`, `helpdesk-pro.triage`) and `helpdesk-admins` (`api.access` and every permission above). Helpdesk Pro never creates groups itself.

### Staff and clients

An account is **staff** when it holds `helpdesk-pro.desk`, `helpdesk-pro.settings` or `api.super`, and a **client** otherwise. Helpdesk Pro checks this on every request and records it on the person, so a change in Admin Next takes effect on the person's next request. Background work (emails, notifications) uses the latest known answer.

Being staff does not open every project. Which projects an agent works is set per project, with **Staff access** and members. Admins work every project.

### API keys with scopes

An API key created with a list of scopes is limited to those scopes, and Helpdesk Pro applies the same limit to its own checks. A key scoped to `helpdesk-pro.desk` cannot delete tickets, even when its owner is an admin.

## Who may read a ticket

A **client** can read a ticket (its public replies and public activity, never notes) when it is not deleted and:

1. they are its requester or a cc, whatever the project, or
2. the ticket's visibility scope is `project` and they may read the project's shared tickets, or
3. the ticket belongs to their [organization](../organizations) and the organization shares tickets. These colleagues only read.

Rule 2 follows the project's visibility:

| Project visibility | Clients who may submit | Guests may submit | Clients who read `project`-scoped tickets |
|---|---|---|---|
| `private` | none (a staff-only tracker) | no | none |
| `members` | client members (people or group rows) | no | client members |
| `groups` | clients in a Grav group listed with role `client` | no | those clients |
| `public` | any signed-in client | when `portal.guest_submissions` is on | any signed-in client |

**Staff** can read every ticket, notes included, in the projects they work. A staff member who is the requester of a ticket in a project they do not work reads it the way a client does: public messages only.

**Deleted tickets** are hidden from everyone except staff with `helpdesk-pro.tickets.delete`, who can restore them. Nothing deletes a ticket permanently on a timer; only an admin can, from the desk.

Someone who may not read a ticket is told it does not exist ("not found"), never "forbidden", so nobody can probe which ticket numbers are in use.

## What people may do

| Action | Who |
|---|---|
| Reply | Staff who work the project; any client who can read the ticket by rule 1 or 2 above. A colleague who reads it only through their organization cannot reply until they are added as a cc. |
| Add a note | Staff who work the project |
| Change status, priority, kind, subject, labels, visibility scope | Staff who work the project |
| Mark solved, reopen | The requester and cc's (only from and to the default resolved and open statuses; a closed request stays closed) |
| Assign | Staff who work the project, to someone else who works it |
| Move to another project | Staff who work both projects |
| Move to another organization | Staff who work the project |
| Add or remove cc's and watchers | Staff who work the project; anyone can take themselves off |
| Mute | Anyone who can read the ticket, except a colleague who reads it only through their organization |
| Accept, decline, mark duplicate, merge | Staff with `helpdesk-pro.triage` |
| Delete and restore | Staff with `helpdesk-pro.tickets.delete` |
| Delete permanently | Admins (`helpdesk-pro.settings`) |

A client's reply moves the ticket along: a resolved ticket reopens, and "waiting on client" becomes "waiting on us". A staff member's first public reply opens a new ticket, and a reply can set any status at the same time.

## Internal notes stay internal

Notes are kept from clients at every level, not just hidden in the page:

- Every message query that a client-facing page, email or channel runs asks the database for public messages only. The one query that returns notes refuses anyone who is not staff.
- Every event says whether it is `public` or `internal`, and the notification, email and live-update systems deliver internal events only to staff who work the project.
- Attachments on a note are as private as the note.

## Related

- [Installation](../installation#give-staff-access)
- [Triage and merging](../triage-and-merging)
- [Organizations](../organizations)
- [People and privacy](../people-and-privacy)
