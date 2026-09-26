---
title: Deliverability
taxonomy:
    category: docs
description: The Health screen's checks for your domain, transport and list, the settings behind them, deliverability alerts, deliverability:check, bounces and complaints, and the suppression list.
---

# Deliverability

Whether your mail lands in the inbox depends on your domain's DNS, how your site hands mail over, and how your list behaves. Mailroom's **Health** screen checks all three and says what to do about anything that fails. This page covers the checks, the alerts, and the suppression list that protects your sending reputation.

## The Health screen

Open **Health** in Mailroom. The screen says "N of N checks pass" and lists each check under three groups, with a status (**Pass**, **Worth a look**, **Failing** or **Not yet**), a sentence saying what is true, and under **What to do** a sentence saying how to fix it.

| Group | Check | What it looks at |
|---|---|---|
| Your domain | SPF | One SPF record on your sending domain, that it lets your transport send for you, that it stays under the ten-lookup limit, and that it does not end in `+all`. |
| | DKIM | A signing key at `{selector}._domainkey.{domain}`, and that it points where your current transport keeps its keys. |
| | DMARC | A DMARC record with a policy (Gmail and Yahoo have required one of bulk senders since February 2024). `p=none` is worth a look. |
| | From address | That there is one, that it is an address, not a free mailbox provider's, and on the domain the checks above are about. |
| Your transport | Plain-text part | Campaigns go out with a plain-text part as well as HTML. |
| | One-click unsubscribe | The unsubscribe headers survive your transport, so Gmail shows its Unsubscribe button. |
| | Sending rate | **Messages Per Minute** is neither zero nor more than a worker and most provider plans manage. |
| | Bounce webhook | A provider webhook is set up and has been heard from recently. |
| | The queue worker | The worker has run in the last 15 minutes while jobs are waiting. |
| | Site URL | Mailroom knows the address links in email start with. |
| Your list | Bounces and complaints | Your bounce and complaint rates over the last thirty days, against the lines receivers publish. |

The list checks fill in after your first campaign; the domain checks work straight away. Answers are cached for ten minutes: after changing a DNS record, press **Check again**.

### When a check cannot work it out

The domain comes from your From address and the DKIM selector from your transport, which works for almost every site. The **Health** tab of Mailroom's settings covers the rest:

| Setting | Label | When to set it |
|---|---|---|
| `deliverability.sending_domain` | Sending Domain | Your DNS records live on a domain that is not the one in your From address, such as sending as `hello@example.com` through a delegated `mail.example.com`. |
| `deliverability.dkim_selector` | DKIM Selector | The part before `._domainkey` in the DKIM record your provider gave you, when the transport plugin cannot ask the provider's API for it. Two selectors during a rotation are fine, separated by a comma. |
| `deliverability.return_path` | Custom Return Path | The host your provider told you to CNAME into their return-path zone, such as `em1234.example.com`, when the SPF check keeps failing on a domain you know is set up. |

### Alerts

Two things raise a banner on the Admin Next dashboard:

- a failing check: "Mail from this site may not be landing: ... is failing", with **Open Health**;
- a bounce rate above **Bounce Rate That Raises an Alert** (`alerts.bounce_rate_percent`, 5, on the **Health** tab) over the last thirty days. A healthy list never sees five percent; a stale imported list sees it on its first campaign, while it can still be fixed.

### On the command line

```bash
bin/plugin mailroom deliverability:check            # look everything up now
bin/plugin mailroom deliverability:check --cached   # use the ten-minute cache
bin/plugin mailroom deliverability:check --strict   # fail on a warning too
```

It prints the same three groups with the same sentences, and exits `1` when any check fails (or, with `--strict`, when any is worth a look), so it fits beside `status` in whatever runs after a deploy.

## Bounces and complaints

With a [provider webhook](../sending-and-providers#provider-webhooks) set up:

- a **hard bounce** (the mailbox does not exist) suppresses the address and takes the person off every list;
- **soft bounces** (a full mailbox, a temporary refusal) are counted, and three in thirty days count as a hard one;
- a **refused** message (the provider would not send it at all, such as a quota) marks the send bounced and says nothing about the person;
- a **complaint** (the spam button) suppresses the address and takes the person off every list.

Without a webhook, bounces are never recorded and those addresses are mailed again next time. The **Bounces and complaints** check says so when bounces are counted and nothing is suppressed.

## Suppressions

The **Suppressions** tab lists the addresses this site will never mail again, whatever any list or import says, with why and when:

| Reason | How it got there |
|---|---|
| Bounced | A hard bounce, or three soft ones in thirty days |
| Complaint | The spam button |
| Added by hand | **Add an address**, or an `unsubscribed` row in an import |
| Not a valid address | Added by hand as invalid |

- **Add an address** is for somebody who asked you directly rather than through a link. Add a **Note** saying why, for whoever reads it in a year.
- **Remove** asks "Start mailing this address again?". Only do it when you know why the address landed there: mailing an address that complained is how a sending reputation is lost. Removing a suppression does not resubscribe anybody.
- A row reading **address erased** belonged to somebody who asked to be forgotten. Only the address's hash is kept, so it is still never mailed.

Every campaign's audience is checked against the list before a single message is written, and again as each message is built. Suppressions are keyed by the SHA-256 hash of the address, which is why they survive an erasure.

## Related

- [Sending and providers](../sending-and-providers)
- [Reports and tracking](../reports-and-tracking)
- [Privacy](../privacy)
- [Troubleshooting](../troubleshooting)
