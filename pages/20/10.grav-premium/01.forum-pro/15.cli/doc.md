---
title: CLI Reference
taxonomy:
    category: docs
description: Every bin/plugin forum-pro command, what it does, when to run it, and which ones are safe on a live forum.
---

# CLI Reference

All commands run through Grav's plugin CLI from your Grav root:

```bash
bin/plugin forum-pro <command> [options]
```

## Quick reference

| Command | Does | Safe live? |
|---|---|---|
| `status` | Reports connection, schema, jobs and scheduler health | Yes, read-only |
| `migrate` | Applies pending database migrations | Yes, run-locked |
| `work` | Processes background jobs once | Yes |
| `recount` | Repairs denormalized counters | Yes |
| `reindex` | Rebuilds the full-text search index | Yes, search is incomplete while running |
| `rerender` | Re-renders stored posts through the text pipeline | Yes |
| `integrity` | Read-only consistency report | Yes, read-only |
| `import-discourse` | Imports a Discourse backup | Use maintenance mode |
| `files-sync` | Pushes local blobs to S3/R2 | Yes, idempotent |
| `avatars-sync` | Adopts legacy avatars into blob storage | Yes, idempotent |
| `ai-scan` | Runs the AI spam review once | Yes |

## `status`

```bash
bin/plugin forum-pro status
```

Prints database engine and connection state, how many schema steps have been applied, whether migrations are pending, background job counts, and whether the Grav scheduler has been seen recently. This is the first command to run when something is not happening: no email, no badges, no purges almost always means the scheduler is not installed.

The same information is in **Admin → Forum → Status**, with the exact crontab line for your install.

## `migrate`

```bash
bin/plugin forum-pro migrate --status   # preview what would run
bin/plugin forum-pro migrate            # apply
```

Applies pending migrations. Migrations take a **database run-lock**, so two concurrent runs can never apply the same step twice, and it is safe to call from a deploy script.

Whether migrations also apply automatically is controlled by `auto_migrate`. See [Installation](../installation#migration-policy).

## `work`

```bash
bin/plugin forum-pro work
```

Drains the background job queue once: email delivery, badge awards, retention purges, session cleanup, view-count folding and scheduled scans.

In production this runs from the Grav scheduler. Call it by hand to test a configuration change or to flush a backlog without waiting for the next tick.

Batch size and runtime are bounded by the `jobs` block:

```yaml
jobs:
  max_jobs_per_run: 50
  max_seconds_per_run: 50
  stale_lock_seconds: 300
```

## `recount`

```bash
bin/plugin forum-pro recount
```

Recomputes denormalized counters (topic counts, post counts, reply counts, reaction totals) from the underlying rows.

Forum Pro keeps these counters current as content is created and removed, because counting rows on every page view does not scale. Run `recount` after anything that wrote to the database outside the normal posting path, most obviously an **import**.

## `reindex`

```bash
bin/plugin forum-pro reindex
```

Drops and rebuilds the full-text search index from the posts table. Run it after an import, after switching `search.engine`, or after `rerender`.

Safe on a live forum. Search results are simply incomplete while it runs.

## `rerender`

```bash
bin/plugin forum-pro rerender
```

Re-renders every stored post through the Markdown and text pipeline. Run it after a change that affects how posts are rendered: a new `codesh` version, a Markdown setting change, or a mention-rendering fix.

Follow it with `reindex`, since search indexes rendered text.

## `integrity`

```bash
bin/plugin forum-pro integrity
```

A **read-only** consistency report covering dangling references and counter drift. It changes nothing, so it is safe to run any time and useful to run after an import or a large moderation action. If it reports counter drift, `recount` is the fix.

## `import-discourse`

```bash
bin/plugin forum-pro import-discourse backup.sql.gz \
    --source-url https://discourse.example.com \
    --download-files
```

| Option | Purpose |
|---|---|
| `--source-url` | The old forum's base URL, for link rewriting and file downloads |
| `--download-files` | Rehost referenced images, attachments and avatars into your storage |
| `--files-only` | Skip content, do the file pass only |
| `--delay-ms` | Milliseconds between file downloads |

Idempotent and resumable. See [Migrating from Discourse](../discourse-import) for the full guide.

## `files-sync`

```bash
bin/plugin forum-pro files-sync
```

Pushes existing local blobs up to your configured S3-compatible bucket. Idempotent, so an interrupted run resumes by running it again. See [File storage](../file-storage).

## `avatars-sync`

```bash
bin/plugin forum-pro avatars-sync
```

Adopts avatars stored outside the blob store (from an older layout or an import) into content-addressed storage. Idempotent.

## `ai-scan`

```bash
bin/plugin forum-pro ai-scan
```

Runs the [AI spam review](../spam-protection#stage-3-the-hourly-ai-review) once, immediately, rather than waiting for the hourly schedule. Needs `ai_spam.enabled` and the AI Pro plugin. Useful for checking your provider configuration works before trusting it to run unattended.

## Common sequences

**After an import**

```bash
bin/plugin forum-pro recount
bin/plugin forum-pro reindex
bin/plugin forum-pro integrity
```

**After changing how posts render**

```bash
bin/plugin forum-pro rerender
bin/plugin forum-pro reindex
```

**Moving files to R2**

```bash
bin/plugin forum-pro files-sync
bin/plugin forum-pro avatars-sync
```

**In a deploy script**

```bash
bin/plugin forum-pro migrate
bin/plugin forum-pro status
```
