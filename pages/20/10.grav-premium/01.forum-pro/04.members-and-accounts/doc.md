---
title: Members and Accounts
taxonomy:
    category: docs
description: How Forum Pro's account system works, how Grav accounts link in, and how ranks, badges, groups, titles, avatars and profiles fit together.
---

# Members and Accounts

Forum Pro runs its own account system. Members register, verify their email and reset their password entirely inside the forum, and their accounts never touch your Grav user files. At the same time, your existing Grav accounts are recognized automatically, so one login covers your whole site.

## Native forum accounts

With `auth.enabled: true` (the default), the forum serves registration, login, verification, password reset and settings under [reserved routes](../installation#reserved-routes).

```yaml
auth:
  enabled: true
  allow_registration: true
  require_email_verification: true
  min_password_length: 8
  captcha: false
```

### How accounts are secured

- Passwords are hashed with **PHP's native bcrypt**.
- Sessions ride an **HttpOnly `forum_session` cookie** with a sliding window, 30 days with remember-me.
- Verification and password-reset links are **single-use** and **hashed at rest**, so a leaked database does not hand out working links.
- Those links are pinned to the trusted host in `security.site_url`, which prevents reset-poisoning through a spoofed `Host` header.
- Registration, login and password reset are **rate-limited per IP**.

### Turning registration off

Set `auth.allow_registration: false` to close signups while leaving existing members able to log in and post. This is different from [maintenance mode](../moderation#maintenance-and-read-only-mode), which stops everyone from writing.

## Grav accounts

```yaml
auth:
  grav_members: true
```

With this on, an authenticated Grav user is treated as a forum member. A linked forum account is created on their first visit, carrying their username and display name across. Your admins and moderators are therefore already present, with their staff status recognized, without anyone creating a second account.

Set it to `false` to keep Grav logins out of the forum entirely, which is what you want if your Grav accounts are strictly for site staff and you would rather they participated under separate forum identities.

Members are tagged `native` or `grav` in the admin Members tab so you can always tell which is which.

## Profiles

A public profile lives at `{forum}/u/<username>` and shows:

- Avatar, display name, **rank** and **group badges**
- Join date, post count, topic count and **reputation**
- **Award badges**
- Recent posts
- **Send message** and **Block** buttons for signed-in visitors
- A **Lift ban** action for staff, when the member is banned

Optional profile fields (website, social links, signature, title) are shown when set, and hidden while an account is [provisional](../spam-protection#provisional-members).

## Avatars

Members upload, change or remove their own avatar from `{forum}/settings`. A member without one gets a **letter avatar** in a color derived deterministically from their username, so every member is visually distinct from day one and your topic lists never look empty.

Avatars are stored in the same content-addressed [blob storage](../file-storage) as attachments, which means they move to S3 or R2 along with everything else and can be served from your CDN.

## Ranks

### Automatic ranks

Members climb a configurable ladder as they post. Ranks appear beside the member's name in posts, in the directory and on their profile.

### Custom ranks

Staff can grant a handpicked honor from **Admin → Forum → Members → Edit**. A custom rank has its own label and its own icon (trophy, crown, medal, star and others) and replaces the automatic rank for that member. This is how you mark a Founder, a sponsor or a long-serving contributor.

## Badges

Badges are awarded **automatically** for milestones by the background worker, and can also be **granted or revoked by staff**. They render as compact icons beside member names, naming themselves on hover so the author column stays tidy, and are listed in full on the profile.

Custom badges imported from Discourse arrive intact, so award history carries across a migration.

## Groups

Member groups (Core Team, Moderators, and whatever else your community needs) each have a **color** and an **icon** and show up as badge bars under member names in posts and topic lists, and on profiles.

Groups are managed from **Admin → Forum → Groups**. They are presentational and organizational. Moderation powers are granted separately in the **Moderators** tab, which means you can have a visible "Core Team" group whose members are not all moderators, and vice versa.

## Titles

A **member title** is free text shown under the member's name, editable from the admin. Discourse titles are imported.

## The member directory

`{forum}/members` lists every member with their rank, post count, website, join date and last-active date, plus a **Send message** button. It is searchable and sortable, paginates at `frontend.members_per_page` (48 by default), and shows who's-online counts based on `frontend.online_window_minutes`.

## The member toolbar

Signed-in members get a persistent toolbar above every forum page with:

- Search
- Quick links to **new posts**, **unanswered**, **tags**, **members**, **unread**, **my topics** and **bookmarks**
- A **notification bell** with a live unread count
- An **envelope** with a live unread private-message count
- An **avatar menu** reaching profile, notifications, messages, bookmarks, your topics and settings

## Member settings

`{forum}/settings` is where a member controls their own account: display name, avatar, optional profile fields, password, email notification preferences (see [Notifications and email](../notifications-and-email)), and account deletion.

## Self-deletion (GDPR erasure)

```yaml
account:
  self_deletion: true
  deletion_grace_days: 30
```

A member requests deletion from their settings page. The request is confirmed by an **email double opt-in**, then enters a cooling-off window. **Logging back in cancels it**, which protects people who change their mind or act in anger.

Set `deletion_grace_days: 0` to erase immediately on confirmation. See [Privacy and retention](../privacy-and-retention) for what erasure actually removes.

## Announcements

Staff can post **announcements**: dismissible banners that appear above every forum page for members and guests alike. Each has a Markdown body, an optional expiry, a color variant and an icon. Use them for downtime notices, community guidelines, or pointing everyone at a new subforum.
