---
title: File Storage
taxonomy:
    category: docs
description: Content-addressed blob storage for attachments and avatars, moving to S3 or Cloudflare R2, CDN delivery, and the sync commands.
---

# File Storage

Attachments and avatars are stored as **content-addressed blobs**: the storage key is derived from the file's own hash, so the same image uploaded by five people is stored once and serving it can use immutable caching.

## Local storage (the default)

```yaml
storage:
  driver: local
```

Blobs live under `user/data/forum-pro/` and are served at `{forum}/_file/<hash>` with far-future cache headers.

> [!WARNING]
> As with the SQLite database, stock nginx configs do not block access to `user/data/`. See the [nginx note in Installation](../installation#sqlite-the-default).

## S3-compatible storage

Point the driver at any S3-compatible store. **Cloudflare R2** is the recommended option because it has no egress fees, but S3, Backblaze B2 and MinIO all work.

```yaml
storage:
  driver: s3
  s3:
    endpoint: https://<account>.r2.cloudflarestorage.com
    bucket: grav-forum
    region: auto
    access_key: '...'        # R2 API token with Object Read & Write
    secret_key: '...'
    prefix: forum            # object key prefix inside the bucket
    public_url: ''           # public/CDN domain, once the bucket has one
```

> [!NOTE]
> Credentials are YAML-only by design. Keep them out of version control, for example by putting the `storage` block in an [environment-specific config](/20/advanced/environment-config) or by using Grav's config alias and `.env` support.

There is **no AWS SDK dependency**. Request signing is implemented in the plugin, which keeps the install small and avoids a large transitive dependency tree.

### How local and remote interact

Switching to `s3` does not orphan anything:

- **New uploads** go to the bucket and stay **locally cached**.
- A blob **missing locally pulls back through** from the bucket on first request, then caches.
- Serving therefore **never depends on the bucket being reachable** for content you already have.

## CDN delivery

Once your bucket has a public domain, set it:

```yaml
storage:
  s3:
    public_url: https://cdn.example.com
```

Pages then reference files on the CDN directly. This is applied **at render time**, not written into the database, so turning it on or off is instant and reversible with no rewrite and no migration.

## Moving existing files

Both commands are **idempotent**, so an interrupted run is resumed by running it again.

```bash
bin/plugin forum-pro files-sync      # push local blobs up to S3/R2
bin/plugin forum-pro avatars-sync    # adopt legacy avatars into blob storage
```

`avatars-sync` is the one you need after upgrading from an older layout or after an import that wrote avatars outside the blob store.

### Recommended migration order

1. Configure `storage.s3` with credentials, leaving `public_url` empty.
2. Set `driver: s3`.
3. Run `files-sync`, then `avatars-sync`.
4. Verify attachments and avatars still load (they will, from the local cache).
5. Add `public_url` and confirm pages now reference the CDN.

## Attachment limits

Limits are enforced before anything is written, and live in the `attachments` block:

```yaml
attachments:
  enabled: true
  max_size_kb: 4096         # per file
  max_per_post: 8
  member_daily_limit: 40    # 0 disables
  draft_ttl_hours: 24       # unclaimed uploads expire after this
  purge_grace_days: 7       # orphans are removed this long after being flagged
  # allowed_extensions: [png, jpg, gif, webp, svg, pdf, zip, txt, log, md, yaml, json, csv, mp4, mov]
```

`allowed_extensions` is YAML-only. Removing `svg` is worth considering if you allow uploads from untrusted members, since SVG is an executable format in a browser context.

## Cleanup

Uploads have a lifecycle:

1. A file uploaded but never attached to a submitted post is a **draft**, and expires after `draft_ttl_hours`.
2. A file whose post is deleted becomes an **orphan** and is flagged.
3. Flagged orphans are removed `purge_grace_days` later by the background worker.

The grace period exists so that restoring a deleted post within the [undo window](../moderation#undo) also restores its attachments.

## Provisional members

With `provisional.block_attachments: true` (the default), brand-new accounts cannot upload at all. See [Spam protection](../spam-protection#provisional-members).

## A note on attachment URLs

Blob URLs are **unauthenticated capability URLs**: anyone holding the URL can fetch the file, including for attachments in private messages. This is a deliberate tradeoff that makes content-addressed deduplication and CDN delivery work. Treat a forum attachment as shareable-if-leaked rather than as a private document store.
