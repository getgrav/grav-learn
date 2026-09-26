---
title: Automations
taxonomy:
    category: docs
description: Emails that go out on their own when somebody signs up, confirms or gets a tag, with triggers, waits, emails, tags, lists and branches, the Welcome series recipe, and how people move through them.
---

# Automations

An automation is a series of waits and emails that starts on its own the moment somebody signs up, confirms or picks up a tag, and runs one person at a time. A welcome series is the classic: an email straight away, another two days later.

Reading automations needs `mailroom.view`; writing, turning on, pausing and enrolling need `mailroom.manage`.

## The Automations tab

**Automations** lists every automation with what starts it, its steps and where its people are: how many are moving, how many are waiting on a timer, how many finished. Each is **Draft**, **Running** or **Paused**.

Press **Write an automation**, or pick one under **Start from a recipe**. A recipe writes a draft you read through and change before you turn it on; nothing is sent until you do.

## The editor

### Details

| Field | What it does |
|---|---|
| Name | What the site calls it. Nobody outside sees this. |
| What starts it | **When somebody signs up**, **When somebody confirms**, or **When the tag ... is added** (then **Which tag**). |
| Who it applies to | **Only people on this list** (or **Anybody subscribed**) and **Only people matching this segment** (or **Everybody**). Somebody the trigger happens to who is not on the list, or does not match the segment, is simply not enrolled. |
| Let somebody go through this more than once | Off, each person is enrolled once ever, however many times the trigger happens to them. On, every trigger starts them again: right for a note each time somebody is tagged, wrong for a welcome series. |

Only somebody who is subscribed is ever enrolled: never a person still waiting to confirm, and never one who left, bounced, complained or is suppressed. A new person signing up to a list that asks people to confirm is still waiting when **When somebody signs up** fires, so it is not enrolled then or later. Use **When somebody confirms** for lists that ask, and **When somebody signs up** for lists that do not.

### Steps

**Add a step** and choose a kind. Steps run from the top, and **Move up** and **Move down** reorder them.

| Step | What it does |
|---|---|
| **Send an email** | An email with a subject, preheader, message and layout, written like a campaign, with the same merge tags. Save the automation once and it can be previewed through the real layout. |
| **Wait** | **For a length of time** (a number of minutes, hours or days), or **Until a weekday and an hour**, in the site timezone. |
| **Add a tag**, **Remove a tag** | Changes one tag on the person. |
| **Add to a list** | Puts them on a list. Somebody already on it is left alone, nobody is asked to confirm again, and anybody who left that list (by their own hand or an admin's) is skipped and logged. |
| **Branch on what they did** | Looks at whether they **opened the last email** or **clicked something in the last email**, then goes to one step if they did and another (or **the end**) if they did not. It reads the email step before it; with no email above it, everybody takes the second path. |

A step somebody is standing on cannot be removed until they have moved on or been taken out.

## Turn it on

**Turn it on** asks "Turn this automation on?" From then on everybody the trigger happens to is enrolled; nobody it already happened to is enrolled after the fact. An automation with no steps, or with an email step that has no message, cannot be turned on.

- **Pause** holds everybody exactly where they are: no step runs, nobody new is enrolled, nobody is taken out. **Resume** carries each of them on from the same step; a wait that ran out while paused is over, so they move on the worker's next run.
- **Delete** removes the automation, its steps and its history; the emails it sent stay with the people who received them. With people still in it, it asks again: **Delete it and take them out**.

**Run Automations** (`automations.enabled`, on the **Automations** tab of the settings) holds every automation at once without pausing them one by one; nobody is taken out and nothing is lost. **Automation Emails** (`messages.flow_email`, on the **Sending** tab) stops their emails while leaving campaigns alone.

## People in an automation

An automation's page shows its steps with each email's sent, opened and clicked counts, and its people: which step each is on (**Moving**, **Waiting** until a time, **Finished** or **Left**), when they entered and why they left.

- **Enroll somebody**: search by name or address and put one person in by hand, under the same rules as the trigger (subscribed, on the list and in the segment if it names them, and new to it unless it allows re-entry). Useful for testing an automation on yourself before turning it on.
- **Take them out**: they stop where they are and receive nothing else from it.

People leave early, with the reason shown, when they unsubscribe from everything, bounce, mark an email as spam, are suppressed, a step fails, the automation is deleted, or somebody takes them out by hand.

The unsubscribe link in an automation's email, and the mail client's button, take the person off every list, because the automation keeps going for as long as they are subscribed to anything.

## How it runs

The worker moves people along once a minute, up to **People Moved Per Run** (`automations.per_tick`, 200, at most 1000) per run. A run that hits the limit queues itself again straight away, so a big backlog still drains in a few minutes. Automations need the worker (see [Jobs and cron](../jobs-and-cron)).

## The Welcome series recipe

Mailroom ships one recipe, **Welcome series**: two emails to somebody who has just confirmed their address. The first goes straight away and says what they signed up for and how often you write; the second, three days later, points at a few good places to start on your site. It starts **When somebody confirms**, and uses `{{ site.name }}` and `{{ site.url }}` so it names your site.

The draft has placeholders for the parts only you can write: what you send and how often, and the three pages you would show somebody new. The recipe lists them under what to change before you turn it on, and says that a list which does not ask people to confirm needs the trigger changed to **When somebody signs up**, since nobody on it ever confirms.

## From the API

The same things through the REST API and MCP: `GET /mailroom/flows`, `POST /mailroom/flows` with a `trigger` (`subscribed`, `confirmed` or `tag_added` with `trigger_json: {"tag": "code"}`) and `steps`, and `activate`, `pause`, `resume`, `enrol` and `exit`. See [REST API](../rest-api#automations).

```json
{
  "name": "Welcome",
  "trigger": "confirmed",
  "list_id": 1,
  "steps": [
    {"type": "email", "campaign": {"subject": "Welcome to {{ site.name }}", "body_md": "Thanks for joining.", "layout": "store"}},
    {"type": "wait", "config": {"seconds": 172800}},
    {"type": "email", "campaign": {"subject": "Two things worth knowing", "body_md": "...", "layout": "store"}}
  ]
}
```

A wait is `{"seconds": 172800}` or `{"until": {"weekday": 2, "hour": 9}}`; a tag step `{"tag": "code"}`; a list step `{"list": "code"}`; a branch `{"on": "opened", "yes": 3, "no": 5}`, naming steps by position from one.

## Related

- [Campaigns](../campaigns)
- [Tags and segments](../tags-and-segments)
- [Reports and tracking](../reports-and-tracking#the-reports-tab)
