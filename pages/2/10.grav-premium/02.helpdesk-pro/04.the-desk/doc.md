---
title: The Staff Desk
taxonomy:
    category: docs
description: Where staff work tickets in Admin Next - screens, filters, the ticket screen, replies and notes, boards and keyboard shortcuts.
---

# The Staff Desk

Staff work tickets in Admin Next, on the **Helpdesk** page in the sidebar. This page is the tour: the screens, finding tickets, working one, boards, and the keyboard shortcuts.

Opening the desk needs `helpdesk-pro.desk` (see [Projects and permissions](../projects-and-permissions)). The desk lives at `/admin/plugin/helpdesk-pro`, following your Admin Next route.

## Screens

Everything happens on one page. Each screen has its own address after the `#` (for example `#/tickets?category=open`), so a filtered list or a ticket is a link you can bookmark or paste to a colleague, and the browser's Back button steps through what you looked at.

| Address | Screen | What it is for |
|---|---|---|
| `#/my-work` | My work | The tickets assigned to you, grouped by what they need: **Needs your reply** (the client spoke last, oldest first), **In progress**, **Waiting on client** (with how long they have waited) and **Recently solved** (the last 7 days). With nothing assigned to you it offers the unassigned tickets. |
| `#/tickets` | All tickets | Every ticket you can read, with a search box, a sort and filter chips. |
| `#/tickets/new` | New ticket | Open a ticket yourself, for a client or for yourself. |
| `#/t/<id>` | Ticket | One ticket: the conversation, the composer and the details. |
| `#/board/<project>` | Board | A project's tickets as cards in a column per status. |
| `#/triage` | Triage | Requests waiting to be accepted, marked a duplicate or declined. See [Triage and merging](../triage-and-merging). |
| `#/notifications` | Notifications | Everything the bell told you, newest first, with **Mark read** and **Mark all read**. |
| `#/ratings` | Ratings | Customer ratings, while ratings are on. See [Customer ratings](../customer-ratings). |
| `#/reports` | Reports | Figures over a period, for those with `helpdesk-pro.reports`. See [Reports](../reports). |
| `#/saved-replies` | Saved replies | Your saved replies and the shared ones. See [Saved replies and views](../saved-replies-and-views). |
| `#/people` | People | Everyone Helpdesk Pro knows. See [People and privacy](../people-and-privacy). |
| `#/organizations` | Organizations | The companies and teams clients belong to. See [Organizations](../organizations). |
| `#/setup/rules` | Rules | When/if/then rules and the auto-close. See [Rules and automations](../rules-and-automations). |
| `#/setup/sla` | SLA | SLA policies and business hours. See [SLA](../sla). |
| `#/setup/channels` | Channels | Slack, Discord, webhook and team inbox channels. See [Notification channels](../notification-channels). |
| `#/setup/projects` | Projects | The projects, and one page per project. |
| `#/setup/statuses` | Statuses | The six categories and the statuses in each. See [Statuses and labels](../statuses-and-labels). |
| `#/setup/labels` | Labels | Global labels and per-project labels. |
| `#/setup/fields` | Fields | Custom fields. See [Custom fields](../custom-fields). |
| `#/setup/search` | Search | The search index and its rebuild. See [Search](../search). |
| `#/setup/email` | Email | How mail reaches the desk. See [Inbound email](../inbound-email#the-email-screen). |
| `#/setup/inbound-log` | Inbound log | Every email received and what happened to it. |
| `#/setup/system` | System | The database, its schema, the job queue and the last worker run. See [Troubleshooting](../troubleshooting). |

You see only the screens your permissions allow. An address with no screen behind it (a mistyped link, an old bookmark) opens My work with a short note saying so.

Every screen fetches its data when you open it, starts at its top, and Back returns you to where you had scrolled. Clicking the side-menu item of the screen you are on loads it again, and so does coming back to the browser tab after a while (unless you have unsaved changes).

The desk opens on the screen set by `desk.default_view` (`my-work` or `tickets`). The badge next to **Helpdesk** in the Admin Next sidebar counts the requests waiting in Triage (for people who triage) plus your assigned tickets that need a reply. My work names the same number at the top.

## The side menu

The screens sit in five bands: **Work** (My work, All tickets, Notifications, Triage, Ratings, Reports), **Library** (Saved replies, People, Organizations), **Automation** (Rules, SLA, Channels), **Setup** (Projects, Statuses, Labels, Fields) and **Operations** (Search, Email, Inbound log, System). A band with no screens you may open is left out.

- Click a band's heading to open or close it. With **One section at a time** switched on (the default, under the menu), opening a band closes the others.
- The pin beside a heading (it shows when you point at the heading) keeps that band open.
- The band holding the screen you are on is always open when you arrive.
- A closed band shows a count when something inside wants attention: your tickets that need a reply, unread notifications, requests in Triage, failed and held email in the Inbound log, or failing channels. Point at the count to see what it adds up.
- **Find a screen**, at the top, filters the menu as you type.
- « folds the menu to a narrow column of icons; » opens it again.

Below 900px wide the menu sits above the screen at full width and does not fold. Your browser remembers the folded menu, open bands, pins and the switch (`helpdesk-pro.nav.rail` and `helpdesk-pro.nav.bands` in local storage). The **Settings** button at the top of the page opens the plugin's settings page.

## Finding tickets

On All tickets, each row of chips filters one thing: status category, assignee (Me, Unassigned, or a person), priority, project, kind and label. Chips in the same row match any of them; chips in different rows narrow the list. The number on a chip counts every ticket that would match across the whole result, not just the page. A chip with no tickets behind it is hidden, and a row with only one choice is left out.

**More filters**, under the chips, holds the filters that have no counts: the channel a ticket arrived by, the [organization](../organizations) (once the site has organizations), and the [custom fields](../custom-fields) you can filter on. While folded, its heading says what is set inside it ("More filters · Channel: Email · Plan: Pro"). **Unread** keeps the tickets with activity you have not seen. SLA adds **Breached** and **Due soon** chips when [SLA](../sla) is on.

The sort offers recently updated, newest, priority, oldest waiting (the client who has waited longest first) and, with SLA, due soonest.

### Searching

The search box on All tickets (`/` jumps to it) finds a ticket by its number (`1042` or `#1042`), its subject, its requester's name or email address, and the words of its conversation, internal notes included. The search index's 100 best matches are added to the subject matches, and the chips, sort and pager then work on that set. A ticket found through one of its notes says **Matched in an internal note** under its subject. Notes of projects you do not work are never searched for you.

### The list

Columns that would say the same thing on every row are hidden: a site with one project has no Project column, and a list filtered to your own tickets has no Assignee column. On a narrow screen the least useful columns go first: Project, Labels and custom field columns, then Priority and Updated, then Assignee.

Every row's subject opens the ticket. **Assign to me** sits on the row; **Mark resolved** and **Delete** are in the ⋯ menu. The count of matching tickets is under the title, and the pager appears only when there is more than one page. Tick rows to [edit many tickets at once](../saved-replies-and-views#bulk-edit).

## Open a ticket yourself

**New ticket**, on All tickets and My work, is for a request that reached you some other way, such as a phone call or a chat.

1. Pick the **Project** (one you work).
2. Pick the **Requester**: search by name or email. A full email address nobody has yet creates the person, with an optional name. Leave it empty to open the ticket as yourself.
3. Write the **Subject** and **First message**.
4. Set **Kind**, **Priority** and **Assignee** (empty uses the project's default assignee).
5. Keep **Email the requester** ticked to send the first message to them as an email from you, with its files as links and a link to the request.
6. Attach files and fill in the project's custom fields if you need to.
7. Create the ticket.

Tickets opened here skip triage. In the conversation the first message reads "Anna on behalf of Maria Lopez", so nobody takes it for the client's own words. Staff can set any custom field here, staff-only ones included, and none is required.

## Work a ticket

The header shows the subject (click it to rename the ticket), the number, the project, how it arrived and who asked, with the status, priority and kind beside it. Every change saves at once. The ⋯ menu holds **Rename** and **Merge into another ticket…**.

The conversation reads top to bottom. Opening a ticket marks it read and marks your notifications about it read, so they are never emailed to you. Replies are plain cards; internal notes have a tinted background and a **Note** tag; changes appear as small lines between messages. A message that arrived by email says "via email" and has **Show original**, which opens the email as it arrived. Files are listed under their message, images as thumbnails.

### Reply or note

The composer at the bottom has two tabs:

- **Reply** goes to the client. It is emailed to the requester and shown on their request. The button says **Send reply**, and the line above the editor names who will receive it.
- **Note** stays with staff. The composer turns the note colour, the line above the editor says only staff can see it, and the button says **Add note**.

Each tab keeps its own draft, saved in your browser as you type. Leaving a ticket with an unsent draft asks first; **Discard changes** deletes the draft and any files uploaded for it. Cmd+Enter (Ctrl+Enter) sends.

Next to the send button, **then set status** changes the status in the same step. After a reply it starts on the default "waiting on client" status; after a note it keeps the current status.

Beside **Attach files**, **Insert reply** picks one of your [saved replies](../saved-replies-and-views), and **Insert article** searches the knowledge base and puts an article's link into the text. In both, the arrow keys move, Enter picks and Escape closes.

### When someone replied while you were writing

If a new public message arrives while you are writing (the client answered, or a colleague replied), sending does not go through. The new messages appear above your draft with two choices: **Edit first** puts them into the conversation so you can adjust your text, and **Send anyway** sends it as it is. This works with or without live updates.

Field changes are guarded the same way. If someone changed the ticket since you opened it, your change is not applied, the ticket reloads, and you can check what changed before trying again.

### The side panel

- **Details**: the assignee (with **Assign to me**), the project, labels (add from the list, remove with ×), and whether only the requester and cc's can read the ticket or everyone in the project.
- **People**: the requester with links to their other tickets and their person page and, for clients, **Send sign-in link**; anyone cc'd; and the staff watching. **Watch**, **Stop watching** and **Mute** apply to you; **Remove** takes someone else off.
- **Organization**: the ticket's organization, with a link and **Change**. Hidden on a site with no organizations.
- **Fields**: the custom fields that apply to the ticket's project. Click a value, or **Add**, to edit it in place.
- **SLA**: the policy, both targets with their due times, and whether each was met or breached.
- **Rating**: the client's answer to "How did we do?", while the ticket has one.
- **Triage** appears only on a ticket still waiting there, **Before writing in** only when the request started in the help center, and **Similar tickets** only when there are some.

## Boards

A project whose **Show a board for this project** setting is on (Setup → Projects) gets a board at `#/board/<project-slug>`. Boards are not in the side menu: All tickets shows a **List | Board** switch whenever a board fits. With no project filter, Board opens the only board, or a list to pick from. Only staff see boards. Set `desk.board` to `false` to turn every board off.

The board has a column for each status, in category order: New, Open, Waiting on us, Waiting on client and Resolved. A category with several statuses gets a heading over its columns. An empty column folds to a narrow strip with its count and opens while you move a card. Cards are sorted by priority, then by last activity. Each card shows the number and subject, who asked, the assignee's initials, the priority unless it is Normal, a Bug or Feature tag, and the labels. A column shows up to 50 cards and links to the full list when there are more.

The Closed column is hidden until you press **Show closed**. The choice is part of the address (`?closed=1`), like the filter chips above the board.

### Move cards

Drag a card to another column to change the ticket's status to that column's status. The change saves at once and appears in the ticket's activity. Pressing a card without moving it opens the ticket.

With the keyboard, every card is a tab stop. The arrow keys move between cards and Enter opens the ticket. Space picks a card up; the left and right arrows choose the column, Space or Enter drops it, and Escape puts it back. Each step is read out to screen readers.

If someone else changed the ticket after the board loaded, the move is not applied. The card reloads where it really is now, with a note saying so.

## Keyboard shortcuts

Press `?` anywhere in the desk for the list. Shortcuts are single keys, never combined with Cmd, Ctrl or Alt, so Admin Next's own keys still work. They never fire while you type, and they wait while a dialog is open.

| Keys | Where | What they do |
|---|---|---|
| `c` | Anywhere | New ticket (on a board, in that board's project) |
| `/` | Anywhere | Search tickets |
| `g` then `m`, `t`, `r`, `n` or `b` | Anywhere | My work, All tickets, Triage, Notifications, a board |
| `j` / `k` | Lists and boards | Next and previous ticket |
| Enter or `o` | Lists and boards | Open the ticket |
| `a` | Lists, boards, a ticket | Assign the ticket to me |
| `e` | Lists, boards, a ticket | Mark the ticket resolved |
| `r` / `n` | A ticket | Write a reply / an internal note |
| `s` | A ticket | Change the status |
| `l` | A ticket | Add a label |
| `?` | Anywhere | Show the shortcut sheet |

In Triage, with a request open, `a`, `d` and `x` start Accept, Duplicate of… and Decline. Single-key shortcuts can be turned off for your browser with the switch in the `?` sheet; `?` keeps working so you can turn them back on.

## The dashboard widget

The Admin Next dashboard gets a **Helpdesk** widget for staff: requests waiting in Triage, unassigned open tickets, your tickets needing a reply, and how long the oldest "waiting on us" ticket has waited. Each number opens the desk at that list. Set `admin2.dashboard` to `false` to turn it off.

**Tools → Reports** in Admin Next includes a Helpdesk report for accounts with `helpdesk-pro.reports`. See [Reports](../reports#admin-next-s-reports-page).

## Related

- [Triage and merging](../triage-and-merging)
- [Saved replies and views](../saved-replies-and-views)
- [Statuses and labels](../statuses-and-labels)
- [Notifications](../notifications)
- [Live updates](../live-updates)
