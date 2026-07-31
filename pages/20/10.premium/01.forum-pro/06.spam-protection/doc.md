---
title: Spam Protection
taxonomy:
    category: docs
description: The three-stage spam pipeline (heuristics, a self-hosted ML classifier, an hourly AI review), provisional-member restrictions, and the invisible captcha.
---

# Spam Protection

Forum Pro layers **three independent detection stages** on top of **account-level gates**. Each stage is optional except the first, each fails safe, and everything any of them catches lands in the [review queue](../moderation#the-review-queue-on-the-forum) rather than being deleted outright.

## Stage 1: heuristics

Instant, always on, no dependencies. Every post is scored on submission using:

- A **honeypot** field
- **Submit speed** (forms completed faster than a human could type)
- **Link count**
- **Blocklists**
- **New-member weighting**
- **Burst and duplicate detection** (the same phone number or a near-identical body across recent posts)
- **Flood limits** on posts per minute, topics per hour and reports per hour

```yaml
spam:
  enabled: true
  pending_threshold: 30          # score at which content needs approval
  spam_threshold: 60             # score at which content lands in the spam queue
  min_submit_seconds: 3          # faster than this looks automated
  max_links: 2                   # links beyond this raise the score
  new_member_post_count: 3       # members below this count score as new
  duplicate_window_minutes: 60   # window for the burst/duplicate check
  max_posts_per_minute: 6        # 0 disables
  max_topics_per_hour: 12        # 0 disables
  max_flags_per_hour: 10         # 0 disables
```

The two thresholds are the dials that matter. A post scoring 30 to 59 is **held for approval**; 60 or above goes **straight to the spam queue**. Lower both if spam is getting through, raise them if legitimate members are being held.

## Stage 2: the ML classifier

Instant, optional, self-hosted. Posts from low-trust members are scored by a quantized [DistilRoBERTa spam model](https://huggingface.co/valurank/distilroberta-spam-comments-detection) (~82M parameters, ~85MB quantized to int8) served by a small Python and ONNX sidecar. Roughly 200ms per post on two CPU threads, no GPU.

The classifier's spam probability is multiplied by `weight` and added to the heuristic score, so a confident verdict alone is enough to route a post to the spam queue and a moderate one tips it into pending.

```yaml
spam:
  classifier:
    enabled: true
    url: http://127.0.0.1:8787/classify
    timeout_ms: 800          # posting never waits longer than this
    min_probability: 0.6     # verdicts below this add nothing
    weight: 60               # score added = probability x weight
    trust_post_count: 20     # members above this post count skip the classifier
```

> [!NOTE]
> The client **fails open**. If the sidecar is slow, unreachable or dead, posting continues on heuristics alone. A broken classifier can never block your members from posting.

### Installing the sidecar

The plugin ships an installer under `sidecar/`:

```bash
scp -r user/plugins/forum-pro/sidecar/ server:
ssh server 'bash sidecar/install.sh'
```

No root required. The script installs [uv](https://docs.astral.sh/uv/), creates a Python 3.12 virtualenv (your system Python is untouched and can be any age), exports and int8-quantizes the model in a throwaway venv, installs a **user systemd unit** called `forum-spam-classifier.service`, and smoke-tests it.

If `loginctl enable-linger` needs root on your box, the script falls back to a cron watchdog that keeps the service alive. Ask an administrator to run `loginctl enable-linger <user>` once and you can remove the cron line.

Runtime footprint is roughly **300MB RSS**, listening on `127.0.0.1:8787` only. Point `spam.classifier.url` at it and you are done.

## Stage 3: the hourly AI review

Optional, needs the [AI Pro](https://getgrav.org/premium/ai-pro) plugin. Once an hour, an LLM reviews recent posts by new members with full topic context and queues confident spam for moderators, logging its reasoning on every decision.

```yaml
ai_spam:
  enabled: true
  provider: ""             # ai-pro provider name ('' = ai-pro default)
  model: ""                # model override ('' = provider default)
  lookback_hours: 24       # only posts newer than this are judged
  max_posts: 50            # posts judged per run
  trust_post_count: 20     # members above this post count are never scanned
  min_confidence: 0.85     # verdicts below this confidence are left alone
```

This is the stage that catches well-written spam that reads fine to a scorer but is obviously promotional to a reader. It runs on the [background worker](../installation#the-background-worker), so the scheduler must be installed.

Run a scan by hand to test your configuration:

```bash
bin/plugin forum-pro ai-scan
```

## Provisional members

The account-level gate. New accounts stay **provisional** until they have **both** posted a configurable number of times **and** been registered for a configurable period. Both thresholds must clear, which stops a spammer from burning through the post gate in ninety seconds.

```yaml
provisional:
  enabled: true
  post_threshold: 5        # stay provisional below this many published posts
  min_age_hours: 24        # ...and until the account is this old (0 disables the age gate)
  strip_links: true        # de-link URLs in their posts (kept as plain text)
  hide_profile: true       # hide website, social links, signature and title
  noindex_profile: true    # mark their profile noindex
  newbie_badge: true       # show a 'New' badge on their posts and profile
  block_attachments: true  # block file and image uploads
  block_messages: true     # block them from starting private conversations
```

Every restriction is an independent switch, so you can be as strict or as relaxed as your community needs. `strip_links` on its own removes most of the incentive to spam a forum at all: the post still appears, but the URL is inert text that carries no SEO value.

Staff accounts are never treated as provisional.

## The invisible captcha

```yaml
auth:
  captcha: true
```

A transparent proof-of-work check on register and login, provided through the **Form** plugin. It requires **no user interaction at all**: no images to squint at, no boxes to tick. The browser does a small amount of work in the background, which is cheap once and expensive at scale.

## Tuning advice

Start with the defaults and watch the queue for a week.

- **Legitimate posts being held?** Raise `pending_threshold`, or raise `spam.max_links` if your community shares a lot of URLs.
- **Spam getting published?** Lower `spam_threshold` first. If that catches too much, add the classifier instead of turning the thresholds down further.
- **Spam accounts registering in bulk?** Turn on `auth.captcha` and keep `provisional.enabled` on with `strip_links` and `block_messages`.
- **Well-written promotional posts slipping through?** That is what `ai_spam` is for.

Nothing is ever deleted automatically before your [retention window](../privacy-and-retention), so a stage that turns out to be too aggressive costs you review time, not content.
