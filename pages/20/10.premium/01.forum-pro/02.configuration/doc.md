---
title: Configuration
taxonomy:
    category: docs
description: The complete Forum Pro configuration reference, block by block, with the admin tab each option lives under.
---

# Configuration

Everything lives in `user/config/plugins/forum-pro.yaml` and almost all of it is editable in **Admin → Plugins → Forum Pro**, which organizes the options into seven tabs: **General**, **Posting**, **Members**, **Moderation**, **Spam Protection**, **Storage** and **System**.

A few keys are intentionally YAML-only, either because they are credentials or because they are lists that a form field renders badly. Those are called out below.

## Block map

| Block | Admin tab | Controls |
|---|---|---|
| `maintenance` | General | Read-only mode and its banner |
| `frontend` | General | Route, per-page counts, timeline, suggested topics, in-page navigation, legacy redirects |
| `search` | General | Engine choice |
| `comments` | General | Article comments |
| `posting` | Posting | Edit window, title and body lengths |
| `tags` / `polls` / `reactions` | Posting | Topic tags, polls, reaction types and reputation weights |
| `attachments` | Posting | Size, count and daily limits, allowed extensions, cleanup |
| `auth` / `security` | Members | Registration, verification, password rules, captcha, trusted host |
| `account` | Members | Member self-deletion and its grace window |
| `messages` | Members | Private messages |
| `email` | Members | Notification email throttle |
| `moderation` | Moderation | Flag auto-hide, premoderation threshold, moderator digest |
| `retention` | Moderation | Purge windows |
| `spam` | Spam Protection | Heuristic thresholds and the ML classifier |
| `ai_spam` | Spam Protection | The hourly AI review |
| `provisional` | Spam Protection | New-account restrictions |
| `storage` | Storage | Local or S3-compatible blob storage and CDN |
| `database` / `auto_migrate` | System | Connection and migration policy |
| `jobs` | System | Background worker batching |
| `realtime` | System | Live updates and presence |
| `admin2` | System | The admin dashboard widget |

## General

### `maintenance`

Read-only mode. Members can browse but not post, react or sign up.

```yaml
maintenance:
  enabled: false
  include_staff: false   # true also locks staff out of writing
  message: ""            # optional plain-text notice on the banner
```

### `frontend`

```yaml
frontend:
  enabled: false              # serve the public forum pages
  route: /forum               # base route
  topics_per_page: 25
  posts_per_page: 20
  members_per_page: 48
  online_window_minutes: 15   # activity window for who's-online counts
  stats_cache_seconds: 60     # 0 recomputes board totals on every view
  topic_timeline: true        # scrollspy timeline rail on topic pages (desktop)
  suggested_topics: 5         # 0 disables
  htmx: true                  # in-page navigation between forum pages
  legacy_redirects:
    enabled: false
    discourse:
      hosts: []               # old Discourse hostname(s); empty means inert
      target_base: ''         # absolute base for targets; empty means same host
```

`legacy_redirects` is covered in detail under [Migrating from Discourse](../discourse-import).

### `search`

```yaml
search:
  engine: builtin    # builtin | yetisearch
```

See [Search](../search).

### `comments`

```yaml
comments:
  enabled: false
  category: null         # forum category id that holds article threads
  templates: []          # page templates that accept comments, e.g. [item]
  author: ""             # forum username that authors seed topics ('' = System)
  max_inline: 20         # comments shown before "view all"
  excerpt_length: 300    # characters of article excerpt in the seed post
```

See [Article comments](../article-comments).

## Posting

```yaml
posting:
  edit_window_minutes: 60   # 0 lets authors edit indefinitely
  min_title_length: 3
  max_title_length: 255
  min_body_length: 2
  max_body_length: 65535
```

### `tags`

```yaml
tags:
  enabled: true
  allow_create: staff   # staff | members | none
```

### `polls`

```yaml
polls:
  enabled: true    # polls on new topics
```

### `reactions`

Each reaction type carries a **reputation weight** applied to the post author. A weight of `0` means the reaction is expressive but does not affect reputation.

```yaml
reactions:
  enabled: true
  types:
    like: 1
    heart: 1
    laugh: 0
    confused: 0
  # emoji:            # YAML-only: optional emoji per type, custom types welcome
  #   like: "👍"
  #   rocket: "🚀"
```

### `attachments`

```yaml
attachments:
  enabled: true             # file/image uploads on posts (members only)
  max_size_kb: 4096         # per file
  max_per_post: 8
  member_daily_limit: 40    # 0 disables
  draft_ttl_hours: 24       # unclaimed uploads expire after this
  purge_grace_days: 7       # orphans are removed this long after being flagged
  # allowed_extensions:     # YAML-only
  #   [png, jpg, gif, webp, svg, pdf, zip, txt, log, md, yaml, json, csv, mp4, mov]
```

Uploads are content-addressed, so the same file posted twice is stored once. See [File storage](../file-storage) for where the bytes actually live.

## Members

### `auth`

```yaml
auth:
  enabled: true
  grav_members: true               # treat authenticated Grav users as forum members
  allow_registration: true
  require_email_verification: true
  min_password_length: 8
  captcha: false                   # transparent proof-of-work check (needs the Form plugin)
```

### `security`

```yaml
security:
  site_url: ''    # absolute base URL for reset and verification links
```

Set this in production. See [Installation](../installation#set-your-trusted-site-url).

### `account`

```yaml
account:
  self_deletion: true       # let members delete their own account (GDPR erasure)
  deletion_grace_days: 30   # 0 erases immediately on confirm
```

### `messages`

```yaml
messages:
  enabled: true
  max_participants: 5           # people per conversation, including the starter
  max_threads_per_hour: 10      # 0 disables
  max_messages_per_minute: 10   # 0 disables
```

### `email`

```yaml
email:
  throttle_minutes: 15   # at most one notification email per member per topic per window
```

## Moderation

```yaml
moderation:
  new_member_post_threshold: 1     # 'new_members' premoderation applies below this post count
  auto_hide_flag_threshold: 3      # open reports that hide a post until review (0 disables)
  mod_digest: true                 # daily email to moderators
  mod_digest_time: '00:00'         # local time, HH:MM
  mod_digest_timezone: UTC         # e.g. America/Denver
```

### `retention`

Every window is enforced by the background worker. `0` means keep forever.

```yaml
retention:
  purge_deleted_after_days: 30            # hard-delete soft-deleted content
  purge_spam_after_days: 30               # hard-delete spam-queue content
  anonymize_ip_after_days: 90             # scrub stored IP addresses
  purge_flag_snapshots_after_days: 180    # drop closed reports' content snapshots
  purge_read_notifications_after_days: 90
  purge_sent_emails_after_days: 7         # drop sent email payloads
```

See [Privacy and retention](../privacy-and-retention).

## Spam protection

Covered in full under [Spam protection](../spam-protection). In summary:

```yaml
spam:
  enabled: true
  pending_threshold: 30
  spam_threshold: 60
  min_submit_seconds: 3
  max_links: 2
  new_member_post_count: 3
  duplicate_window_minutes: 60
  max_posts_per_minute: 6      # 0 disables
  max_topics_per_hour: 12      # 0 disables
  max_flags_per_hour: 10       # 0 disables
  classifier:
    enabled: false
    url: ""
    timeout_ms: 800
    min_probability: 0.6
    weight: 60
    trust_post_count: 20

ai_spam:
  enabled: false
  provider: ""
  model: ""
  lookback_hours: 24
  max_posts: 50
  trust_post_count: 20
  min_confidence: 0.85

provisional:
  enabled: true
  post_threshold: 5
  min_age_hours: 24
  strip_links: true
  hide_profile: true
  noindex_profile: true
  newbie_badge: true
  block_attachments: true
  block_messages: true
```

## Storage

```yaml
storage:
  driver: local     # local | s3
  s3:
    endpoint: ""    # e.g. https://<account>.r2.cloudflarestorage.com
    bucket: ""
    region: auto
    access_key: ""
    secret_key: ""
    prefix: forum
    public_url: ""  # public/CDN domain
```

See [File storage](../file-storage).

## System

### `database` and `auto_migrate`

Covered under [Installation](../installation#database-setup).

### `jobs`

```yaml
jobs:
  enabled: true
  max_jobs_per_run: 50
  max_seconds_per_run: 50
  stale_lock_seconds: 300
```

`max_seconds_per_run` should stay comfortably below your PHP CLI time limit. `stale_lock_seconds` is how long a worker lock is honoured before another run is allowed to steal it, which is what recovers the queue after a crash.

### `realtime`

```yaml
realtime:
  enabled: true                # inert without the sync plugin
  new_replies_threshold: 5     # above this many unseen replies, show a load button
  presence:
    enabled: true              # who's-viewing counts and typing indicators
    heartbeat_seconds: 15
```

See [Live updates](../realtime).

### `admin2`

```yaml
admin2:
  dashboard: true    # show the Forum Activity widget on the site-wide admin dashboard
```
