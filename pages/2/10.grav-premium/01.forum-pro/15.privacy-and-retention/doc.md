---
title: Privacy and Retention
taxonomy:
    category: docs
description: Member self-deletion, retention windows, IP anonymization, legal holds, and what the background worker actually purges.
---

# Privacy and Retention

Running your own forum means you hold the data, which means the compliance obligations are yours too. Forum Pro ships the controls you need to meet them without writing scripts.

## Member self-deletion (GDPR erasure)

```yaml
account:
  self_deletion: true
  deletion_grace_days: 30
```

A member requests deletion from `{forum}/settings`. The flow is deliberately hard to trigger by accident and easy to reverse:

1. The member requests deletion.
2. Forum Pro sends an **email double opt-in**. Nothing happens until they click through, which means a hijacked session cannot erase someone's account.
3. The account enters a **cooling-off window** of `deletion_grace_days`.
4. **Logging back in cancels the request**, which protects people who acted in anger or changed their mind.
5. After the window, the background worker finalizes the erasure.

Set `deletion_grace_days: 0` to erase immediately on confirmation, and `self_deletion: false` to require members to contact staff instead.

Staff can also delete an account from **Admin → Forum → Members**, with the same content disposition choices as a [ban](../moderation#content-disposition): keep, hide, anonymize or delete the member's content.

## Retention windows

Every window is enforced by the [background worker](../installation#the-background-worker). `0` means keep forever.

```yaml
retention:
  purge_deleted_after_days: 30            # hard-delete soft-deleted content
  purge_spam_after_days: 30               # hard-delete spam-queue content
  anonymize_ip_after_days: 90             # scrub stored IP addresses
  purge_flag_snapshots_after_days: 180    # drop closed reports' content snapshots
  purge_read_notifications_after_days: 90 # drop read bell entries
  purge_sent_emails_after_days: 7         # drop sent email payloads
```

### What each window does

**`purge_deleted_after_days`** turns soft-deleted content into hard-deleted content. Until it fires, deletions are recoverable from the [Deleted tab](../moderation#undo). After it fires they are gone. This is the setting that decides how long your undo window is, so treat 30 days as "moderators have a month to catch a mistake" rather than as an archive policy.

**`purge_spam_after_days`** does the same for the spam queue. Spam is never deleted the moment it is caught, which means a false positive is always recoverable for this long.

**`anonymize_ip_after_days`** scrubs stored IP addresses. IPs are recorded for spam scoring and abuse investigation, and they are personal data under GDPR. Ninety days is a common answer; shorten it if your policy is stricter.

**`purge_flag_snapshots_after_days`** drops the content snapshots kept with closed member reports. The snapshot preserves what a post said when it was reported, in case the author edits it, so this window is really "how long do we keep evidence for closed cases".

**`purge_read_notifications_after_days`** trims the bell history once entries are read. Unread entries are not touched.

**`purge_sent_emails_after_days`** drops the stored payload of sent notification email. The queue keeps the body until delivery is confirmed; this window stops your database becoming a copy of every email your forum has ever sent.

## Legal holds

A **legal hold** exempts a member, topic or post from all automated cleanup. Retention windows do not touch held content and the purge worker skips it entirely.

Apply a hold to anything under investigation, subject to a preservation request, or involved in a dispute. It overrides every window above, including `purge_deleted_after_days`, so held content survives even after a moderator deletes it.

## The audit log

Every staff action is recorded: publishes, deletions, restores, bans, lifts, role grants, rank and badge changes, and access to reported private messages. Moderator access to a reported PM is specifically audited, because that is the one place staff can read something a member intended to be private.

## What Forum Pro stores about a member

| Data | Why | Retention |
|---|---|---|
| Username, display name, email | Account identity | Until deletion |
| Password hash (bcrypt) | Authentication | Until deletion |
| Posts, topics, reactions, bookmarks | The forum itself | Per disposition on deletion |
| Private messages | Messaging | Until deletion |
| IP addresses | Spam scoring and abuse investigation | `anonymize_ip_after_days` |
| Session records | Authentication | Cleaned up by the worker |
| Notification records | The bell | `purge_read_notifications_after_days` once read |
| Sent email payloads | Delivery and retry | `purge_sent_emails_after_days` |
| Report snapshots | Moderation evidence | `purge_flag_snapshots_after_days` after closing |

## Practical advice

- **Set `security.site_url` in production.** It is a privacy control as much as a security one: it stops password-reset links being redirected to an attacker by a spoofed `Host` header.
- **Check `retention` before you launch**, not after. Shortening a window later does not un-store what you already collected, but it does start clearing it.
- **Block the data directory in nginx.** See [Installation](../installation#sqlite-the-default). An unreachable database is worth more than any retention policy.
- **Keep `purge_deleted_after_days` long enough to be a useful undo window** and short enough to honour deletion requests. Thirty days is a reasonable default for both.
- **Document what you keep.** The table above is a reasonable starting point for the privacy policy your forum probably needs.
