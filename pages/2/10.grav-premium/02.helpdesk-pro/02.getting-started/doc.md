---
title: Getting Started
taxonomy:
    category: docs
description: Create the help center page, set up your first project, send and answer your first ticket, and learn the words Helpdesk Pro uses.
---

# Getting Started

This page takes a fresh install to a working helpdesk: a help center on your site, a project, and a first ticket answered from the desk. It ends with the words Helpdesk Pro uses everywhere.

## Before you begin

- Helpdesk Pro is installed and your staff have the `helpdesk-agents` or `helpdesk-admins` group (see [Installation](../installation)).
- The Email plugin can send mail (`bin/plugin email test-email --to=you@example.com`).

## Create the help center page

The help center is the front door of the client portal. It lives at the route of a Grav page that uses the **Help Center** page type.

1. In Admin Next, add a top-level page and choose the **Help Center** page type.
2. Give it a title, such as "Help", and a short welcome text. The text shows at the top of the help center.
3. Publish it.

The page's route becomes the help center's address, usually `/help`, and every portal page lives under it: `/help/new`, `/help/tickets` and so on. A numbered folder also puts **Help** in your theme's menu. [The help center and portal](../help-center-and-portal) covers the rest.

Without a Help Center page, the portal still works at `portal.route` (default `/help`) inside a stand-in page, which is fine for a first look.

## Set up your first project

Every ticket belongs to a project. A fresh install has one, **Support** (slug `support`), which is public and requires triage.

1. Open **Helpdesk** in the Admin Next sidebar.
2. Go to **Setup → Projects** and open **Support**.
3. Check **Visibility** (who may submit), **Staff access** (who works it), and whether new requests wait in **Triage**.
4. Optionally pick a **Default assignee**, so accepted tickets land with someone.
5. Save.

[Projects and permissions](../projects-and-permissions) explains every project setting.

## Send your first request

1. Open `/help/new` in a private window, as a guest.
2. Fill in your name, an email address you can read, a summary and a message.
3. Send it.

The request is created, you get a "We got your request" email with a sign-in link, and the link opens the request, signed in. Because Support requires triage, the ticket waits in the desk's **Triage** queue.

## Answer it from the desk

1. In the desk, open **Triage**, then the request.
2. Choose **Accept**. Leave the assignee alone to use the project's default, or pick someone.
3. Open the ticket. Write a reply on the **Reply** tab and press **Send reply**.

The client is emailed the reply and sees it on their request page. To leave a comment only staff can read, use the **Note** tab instead. [The staff desk](../the-desk) covers everything else on the ticket screen.

## The words Helpdesk Pro uses

These words mean one thing everywhere: in the desk, the portal, the API and these docs.

| Term | Meaning |
|---|---|
| Ticket | One request: a subject, a conversation, a status, a priority, one requester, at most one assignee, labels, a kind (support, bug or feature) and a project. Clients see it called a "request". Its id is the number staff see (`#1042`). |
| Reply | A public message on a ticket. The requester and cc'd clients can read it and are emailed it. |
| Note | An internal message. Only staff who work the ticket's project can read it. Never emailed to clients, never shown in the portal. |
| Activity | An append-only record of a change: status, assignee, priority, labels, project and so on. Most activity is internal; resolving, closing, reopening, declining and merging are public. |
| Project | A queue that groups tickets and decides who can see and submit them. |
| Person | Anyone Helpdesk Pro knows: staff, clients with a Grav account, and people who only ever emailed in. |
| Requester | The person a ticket is for. Exactly one per ticket. |
| Cc | A client added to a ticket. They read and reply to its public messages like the requester. |
| Watcher | A staff member following a ticket. Staff start watching when they take part, never for a whole project. |
| Agent | Staff who work tickets: `api.access` plus `helpdesk-pro.desk`. |
| Admin | Staff who configure Helpdesk Pro: `helpdesk-pro.settings` or `api.super`. |
| Client | Someone without staff permissions. Uses the portal and email only. |
| Guest | A visitor who is not signed in. |
| Status | A named state inside one of six fixed categories. |
| Status category | One of `new`, `open`, `waiting_client`, `waiting_us`, `resolved`, `closed`. Reports, notifications and client wording read the category, never the status name. |
| Triage | The queue where a new request waits to be accepted, marked a duplicate or declined. |
| Channel | How a ticket arrived: `web`, `email`, `staff` or `api`. |
| Visibility scope | Which clients may read a ticket: `requester` (the requester and cc's, the default) or `project` (every client who may read the project's shared tickets, for public bug trackers). |
| Custom field | An extra question on tickets, such as an order number. See [Custom fields](../custom-fields). |

## People and Grav accounts

Staff always have Grav accounts, because they sign in to Admin Next. A client gets a Grav account only when they sign in to the portal. Someone who only emails in, or uses the guest form, is a person in Helpdesk Pro's database with no Grav account, so `user/accounts` only grows with people who use the portal.

An account is linked to its person by the account's storage key, which does not change when a username is edited. On every request Helpdesk Pro copies the account's kind (staff or client), its Helpdesk Pro permissions and its Grav groups onto the person. Promoting a client to staff, or taking the desk away from an agent, takes effect on their next request.

- **Earlier requests.** When someone who emailed in before signs in with an account at the same address, their earlier requests join the account only once the address is proven. See [Sign-in links](../sign-in-links#earlier-requests).
- **Deleted accounts.** Deleting a Grav account never deletes the person or their tickets. The person keeps the old key as a tombstone and loses the link, and a new account with the same username inherits nothing unless it proves the address.
- **Blocked people.** A blocked person can still read their existing tickets, but cannot submit, reply by web or email, or request sign-in links, and receives no notifications.

## How messages are written

Replies and notes are written in Markdown. Each one is rendered to HTML when it is saved (and again when edited), with raw HTML escaped and a strict list of allowed tags, and a plain-text copy is kept for search, email and previews. Line breaks count, so text typed the way people type email shows up as typed.

Staff can mention a colleague with `@username` (their Grav username, lowercased) in a reply or a note. Only staff are mentionable, and only messages written by staff are read for mentions. A mentioned colleague starts watching the ticket.

## Related

- [The staff desk](../the-desk)
- [The help center and portal](../help-center-and-portal)
- [Projects and permissions](../projects-and-permissions)
- [Outbound email](../outbound-email)
