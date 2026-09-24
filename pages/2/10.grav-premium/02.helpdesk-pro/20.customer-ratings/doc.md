---
title: Customer Ratings
taxonomy:
    category: docs
description: Ask clients "How did we do?" when a request is solved, keep mail scanners from answering for them, and read the answers in the desk.
---

# Customer Ratings

When a request is solved, Helpdesk Pro can ask the client "How did we do?" with three one-click answers: **Great**, **Okay** and **Not good**. The question is in the resolved email and on the client's request page. The client can add a comment and change their answer for a while afterwards. Staff see the answer on the ticket, in the ticket list and on the Ratings screen; other clients never see it.

## Turn ratings on

1. Open the plugin's settings page and go to the **Ratings** tab.
2. Switch on **Ask for Ratings** (`csat.enabled`).
3. Optionally list the project slugs to ask in (`csat.projects`); empty asks in every project.
4. Save.

## Who is asked, and when

- **When:** each time a ticket enters a resolved status. That opens one ask for that resolution. If the ticket is reopened and solved again, there is a new ask, so a request collects one answer per resolution.
- **Who:** only the requester, and only when they are a client. A cc'd client gets the same resolved email without the links, and a request a staff member opened for themselves is never asked about.
- **How long:** `csat.token_days` (14 days) from the resolution. After that the email's links stop working and the request page stops asking. Reopening the request closes the ask at once.
- **Credit:** each ask credits one staff member: the ticket's assignee when it was solved, or, when nobody was assigned, the staff member who solved it. A client who marks their own unassigned request solved, or an automation, credits nobody.

A ticket solved while ratings were off, or in a project that is not asked, gets no ask.

## The email

The `client-resolved` email has a "How did we do?" line with three links, in both the HTML and the text part:

```
How did we do?
Great: https://example.com/help/rate/Xb3…?r=great
Okay: https://example.com/help/rate/Xb3…?r=okay
Not good: https://example.com/help/rate/Xb3…?r=not_good
```

The links carry a token made for that email. Helpdesk Pro keeps only a hash of it, so a copy of the database cannot rate anything. The token works for one request and one person, without signing in, until the ask closes.

The links are drawn by `templates/emails/helpdesk/partials/csat.html.twig`. A theme can restyle them by shipping its own copy of that partial.

## Why a link never counts on its own

Mail systems open links before people do. Outlook Safe Links, Gmail's scanners and corporate mail gateways fetch every link in a message to check it. If opening a rating link recorded a rating, every scanned email would arrive already rated, often as "Not good", because the scanner opens all three links and the last one wins. So the click is split in two:

1. **`GET {mount}/rate/{token}?r=great` only shows a page.** It records nothing, not even "the link was opened". The page shows the three answers with the one from the email selected.
2. **A small script on the page sends that answer at once**, so for a person the click in the email is still the only click. If the tab opened in the background, the script waits until the person looks at it. Without JavaScript, the page says "Press your answer to send it".
3. **`POST {mount}/rate/{token}` records the answer**, then the page says thanks and offers the comment box.

A scanner that only fetches pages never records anything. A scanner that runs scripts in a real browser could still send an answer, which is rare, and the client can change it until the ask closes.

The POST needs no sign-in and no form nonce: the token is the key, like the one-click unsubscribe link. Someone the email was forwarded to can use the link too.

## The rate page

`{mount}/rate/{token}` renders `templates/helpdesk/rate.html.twig` inside the help center page, with the portal's styles, so it follows your site's light or dark mode. It shows:

- **Before an answer:** "How did we do?", the request's subject and the three answers.
- **After one:** "Thanks for your feedback", the answer given, buttons to change it, and a comment box. After "Not good" the box asks "Sorry to hear that. What could we have done better?" when `csat.ask_comment_on_not_good` is on. It says until when the answer can be changed.
- **A link that cannot be used:** it says why (unknown, expired, the request is open again, solved again since, or ratings switched off for its project) and links to the request or the help center.

A comment can be up to 2,000 characters. Sending an empty comment clears it.

## On the request page

A signed-in client viewing their own solved request sees the same "How did we do?" box at the top of the conversation while the ask is open. A client who marks their own request solved gets no resolved email, so this is where they are asked. Cc'd clients and other clients never see the box, the answer or the comment.

## In the desk

- **The ticket's Rating card** shows the answer as a coloured pill, the comment, who is credited, when it was answered, and whether the client can still change it. Earlier resolutions' answers are listed under it.
- **The ticket list** shows a small mark beside the subject of a rated ticket.
- **Ratings** (`#/ratings`, in the Work band, shown while ratings are on) lists the answers, newest first, with chips for each answer, **With a comment**, **Credited to me**, and a project filter. Each row opens the ticket.

Every desk view only shows ratings on tickets in projects the staff member works. Reports show the score and response rate (see [Reports](../reports)).

## "Not good" notifications

When `csat.notify_not_good` is on, a new "Not good" rings the bell of the credited staff member: "Cleo rated “Invoice missing” Not good". It counts as aimed at them, so at the default `aimed` level it is also emailed unless they read it first. Changing the comment, or answering "Not good" again, does not ring again. Nobody is notified when nobody is credited.

Ratings also work in [rules](../rules-and-automations): **The client rates the ticket** and **The client comments on their rating** are triggers, and **Rating** and **Rating comment** are conditions. For example: "When a client rates Not good, add a note and assign to the team lead".

## Settings

On the **Ratings** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `csat.enabled` | `false` | Ask for ratings at all. |
| `csat.projects` | `[]` | Project slugs to ask in. Empty asks in every project. |
| `csat.token_days` | `14` | How long an ask stays open. |
| `csat.ask_comment_on_not_good` | `true` | After "Not good", ask "What could we have done better?" instead of offering a quiet optional comment. |
| `csat.notify_not_good` | `true` | A "Not good" notifies the credited staff member. |

Turning ratings off stops new asks and makes the links in emails already sent say "Ratings are closed". Answers already given stay.

## Privacy

Ratings and comments are personal data, and they join merges and erasure:

- **Merging two people:** the ratings one gave, the ratings that credit them and their open rating links move to the kept person.
- **Erasing (`anonymize`):** their rating links are deleted, and each rating they gave loses its comment and its link to them. The answer stays as an anonymous figure.
- **Erasing (`delete_content`):** the ratings they gave are deleted.
- A staff member's erasure keeps their credit on ratings, under "Erased person #id".

Expired rating links are deleted by the daily `maintenance.prune` job.

## API and MCP

Staff only. Clients never reach these routes.

| Route | Permission | Query | Answer | MCP tool |
|---|---|---|---|---|
| `GET /helpdesk-pro/ratings` | desk | `rating` (`great`, `okay`, `not_good`), `project`, `staff` (a person id, `me` or `none`), `from`, `to`, `comment=1`, `answered` (`1`, `0` or `all`), `page`, `per_page` | Rows `{id, round, rating, label, comment, source, asked_at, rated_at, updated_at, staff, ticket, requester_id, person_id}`; `meta.counts` per answer and `meta.enabled` | `list_ratings` |
| `GET /helpdesk-pro/ratings/summary` | reports | As above, plus `group` (`staff` or `project`) | `{counts, answered, asked, score, response_rate, from, to}`, and `groups` when grouped | `get_ratings_summary` |
| `GET /helpdesk-pro/tickets/{id}/rating` | desk | | The ticket's newest ask, or `null` when it was never asked | `get_ticket_rating` |

`score` is the share of answers that were Great, in whole percent, and `response_rate` the share of asks that got an answer.

API ticket payloads carry the rating under `extra.csat`. Staff who work the ticket get the full answer with `open`, `expires_at` and `earlier`. The requester reading their own request gets `{rating, label, comment, rated_at, open}`. Anyone else gets no `csat` key.

## Related

- [Outbound email](../outbound-email)
- [Reports](../reports)
- [Rules and automations](../rules-and-automations)
