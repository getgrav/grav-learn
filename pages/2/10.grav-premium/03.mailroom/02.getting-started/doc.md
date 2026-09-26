---
title: Getting Started
taxonomy:
    category: docs
description: Check the site URL, set who mail comes from, put a signup box on the site, make sure the worker runs, send your first campaign, and learn the words Mailroom uses.
---

# Getting Started

This page takes a fresh install to a working newsletter: a signup box on your site, a confirmed subscriber and a first campaign. It ends with a tour of the admin and the words Mailroom uses.

## Before you begin

- Mailroom is installed and you have `mailroom.manage` and `mailroom.send`, or are a super user (see [Installation](../installation)).
- The Email plugin can send mail (`bin/plugin email test-email --to=you@example.com`).

## Check the site URL

Every link in Mailroom's email (the confirmation button, the unsubscribe link, tracked links) starts with the site's address. Mailroom reads it from its own **Site URL** setting on the **Public Pages** tab, then from Grav's **Custom Base URL** (`system.custom_base_url`).

You usually do not have to set it. With neither set, Mailroom fills in **Site URL** the first time an admin who can manage Mailroom (or a super user) opens the Admin Next dashboard or Mailroom's page, using the address they came in on, and writes one line to Grav's log saying so. It does this only over HTTPS, or over plain HTTP for a site on this machine or the local network (`localhost`, a `.test`, `.local`, `.localhost` or `.lan` name, a private address). A value that is already there is never replaced.

Open Mailroom's **Settings**, then the **Public Pages** tab, and check **Site URL** is the address people use, such as `https://www.example.com` (with the subdirectory, if Grav lives in one).

> [!NOTE]
> A visitor's request is never trusted to say where the site is, because its `Host` header is anybody's to write. Until one of the two settings is there, confirmation emails and anything the worker sends on its own wait on the queue. They go out on the next worker run after it is set. See [Troubleshooting](../troubleshooting#the-site-url-is-not-set).

## Say who mail comes from

On the **Sending** tab, set **From Name** and **From Address**, or leave them empty to send as the Email plugin's own From. Either way the address has to be one your mail provider lets you send as. Use a real mailbox on your own domain, not a no-reply.

The **Can this site send mail?** card at the top of the tab says whether the Email plugin is installed and sending, which engine it uses, and whether the unsubscribe headers reach it. [Sending and providers](../sending-and-providers) covers the rest of the tab.

## Put a signup box on the site

A fresh install has one list, **Newsletter** (code `newsletter`), which is the default list and asks people to confirm. Draw a signup box for it anywhere in your theme:

```twig
{{ mailroom_form() }}
```

or for one list by its code:

```twig
{{ mailroom_form('newsletter') }}
```

In page content, turn on Twig processing for the page (`process: twig: true` in its front matter); `mailroom_form()` is allowed in page content. The box has an email field, the consent sentence with a box to check, and a **Sign me up** button. [Lists and signup forms](../lists-and-signup-forms) covers the options, several lists as checkboxes, and the other ways in.

## Sign up and confirm

1. Open a page with the box in a private window.
2. Enter an address you can read, check the box and press **Sign me up**. The fields give way to the answer: "We have sent you a confirmation email."
3. Open the email ("Please confirm your email address for ...") and press **Yes, sign me up**.

The confirmation page presses its own button when it loads, so you land on "You are on the list". Open **Subscribers** in Mailroom: you are there, subscribed, with how you joined (**Signup form**), when you agreed and the consent sentence you were shown.

The confirmation email went out straight after your signup, because the jobs a request queues run right after its response. Campaigns need the worker.

## Make sure the worker runs

Grav's scheduler has to be in the site's crontab (see [Installation](../installation#set-up-cron)). Then run:

```bash
bin/plugin mailroom status
```

It ends with "Healthy: the database is current, mail can leave and the queue is moving." or with a warning for each problem, including the crontab line to add when the worker has not run.

## Send your first campaign

1. Open **Campaigns** and press **Write a campaign**.
2. Give it a **Name** (only you see it), a **Subject** and a **Message** in Markdown. You can write `Hello {{ subscriber.first_name|default('there') }},` to greet people by name.
3. Under **Send it to**, choose **Newsletter**. The count under it says how many people will receive it.
4. Save. The **Preview** pane draws it through the real layout with a sample subscriber.
5. Under **Send a test**, enter your address. The test copy arrives with `[Test]` in front of the subject.
6. Press **Send it now** and confirm.

The campaign goes out as the worker picks it up, at the rate set by **Messages Per Minute**, and its page fills in with sent, delivered, opened and clicked figures. [Campaigns](../campaigns) covers everything else.

## The admin

Mailroom's page lives at `/admin/plugin/mailroom` and every screen has its own address after the `#`, so a reload or Back lands where you were (`#/campaigns/12`, `#/subscribers/import`, `#/health` for the Health tab). Editors ask before you leave with changes you have not saved.

| Tab | What it is |
|---|---|
| Overview | Subscribed, waiting to confirm, left and never mail again, new subscribers over 30 days, recent campaigns and how the last ones did |
| Campaigns | Every campaign with its status and rates, and the campaign editor. See [Campaigns](../campaigns) |
| Subscribers | The subscriber table, each person's page, the import. See [Subscribers](../subscribers) |
| Audience | Lists, tags and segments. See [Lists and signup forms](../lists-and-signup-forms) and [Tags and segments](../tags-and-segments) |
| Automations | Emails that go out on their own. See [Automations](../automations) |
| Templates | Starting points for campaigns. See [Templates and branding](../templates-and-branding) |
| Suppressions | Addresses the site will never mail again. See [Deliverability](../deliverability#suppressions) |
| Reports | Seven reports with CSV export. See [Reports and tracking](../reports-and-tracking) |
| Health | The deliverability checks. See [Deliverability](../deliverability) |
| Settings | The plugin's settings form and the status cards. See [Configuration](../configuration) |

The **Settings** button above the page, the plugin's **Configure** button and `/admin/plugins/mailroom` all open the Settings tab, so there is one settings form.

The Admin Next dashboard also shows Mailroom's banners to anybody who can read Mailroom: mail that cannot leave, a campaign that stopped itself, no From address anywhere, a transport that drops the unsubscribe header, a segment that could not be counted, a failing deliverability check, a high bounce rate, a webhook that went quiet or has no secret, and a missing site URL.

## The words Mailroom uses

| Term | Meaning |
|---|---|
| Subscriber | One email address Mailroom knows, with a name, a language, a status, how they joined and their consent. |
| Status | Where a subscriber stands overall: **Waiting to confirm** (`pending`), **Subscribed**, **Left** (`unsubscribed`), **Bounced** or **Complained**. |
| List | A topic somebody can join and leave on its own, with a code a signup form names it by. |
| Membership | Where one person stands on one list: **Waiting to confirm**, **On** or **Left**. |
| Double opt-in | A list's **Ask people to confirm**: newcomers get a confirmation email and are mailed nothing until they press it. |
| Consent | The sentence a person agreed to (kept as a hash), when, and from which address. |
| Consent history | One row for every change to somebody's lists: signing up, confirming, an admin's add, leaving, coming back, an import. |
| Tag | Something the site noticed about a person, such as where they signed up. No consent, no state. |
| Segment | A saved question about your audience, such as "has not opened anything in 90 days". |
| Campaign | One email written once and sent to lists, optionally narrowed by a segment. |
| Send | One campaign or automation email to one person, with what happened to it. |
| Automation | A series of waits and emails that starts on its own when somebody signs up, confirms or gets a tag. |
| Suppression | An address the site will never mail again: a hard bounce, a complaint, or one added by hand. |
| Route base | Where the public pages answer, `/newsletter` unless changed. |
| Worker | `bin/plugin mailroom work`, run every minute by Grav's scheduler, which sends everything on the queue. |

## Related

- [Lists and signup forms](../lists-and-signup-forms)
- [Double opt-in and consent](../double-opt-in-and-consent)
- [Campaigns](../campaigns)
- [Sending and providers](../sending-and-providers)
