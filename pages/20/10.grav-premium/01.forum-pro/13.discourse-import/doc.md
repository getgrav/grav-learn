---
title: Migrating from Discourse
taxonomy:
    category: docs
description: Import a Discourse backup into Forum Pro, rehost its files, plan the DNS cutover and 301 old URLs to their new homes.
---

# Migrating from Discourse

Forum Pro imports a standard **Discourse admin backup** directly. Members keep working passwords, content converts faithfully, files rehost into your own storage, and the whole thing is resumable and idempotent.

## What you need

A Discourse backup from **Admin → Backups**, the `.sql.gz` kind. That is it. The dump is **stream-parsed in PHP**, so you do not need PostgreSQL installed anywhere, on the old server or the new one.

## The command

```bash
bin/plugin forum-pro import-discourse backup.sql.gz \
    --source-url https://discourse.example.com \
    --download-files
```

| Option | Purpose |
|---|---|
| `--source-url` | The old forum's base URL. Used to recognize and rewrite internal links, and as the base for downloading files. |
| `--download-files` | Rehost every referenced image, attachment and avatar into your own storage. |
| `--files-only` | Skip content, do the file pass only. Use this to finish a file download later. |
| `--delay-ms` | Milliseconds to wait between file downloads, to stay polite to the old CDN. |

## What comes across

**Members and identity**

- Members, with **working passwords**. Discourse's pbkdf2 hashes verify natively and are upgraded to bcrypt on each member's first login, so nobody is forced to reset anything.
- Admins and moderators, as **moderator grants**.
- Custom **groups**, including their flair colours, and their memberships.
- Custom award **badges** and **member titles**.

**Structure and content**

- **Categories.** A parent category with children becomes a **section**; restricted categories become **staff-only**.
- **Topics** and **posts**, with Markdown converted: uploads, quotes, emoji and `[details]` blocks all handled.
- **Post revision history**, so the edit trail is preserved.
- **Likes**, imported as reactions.
- **Tags**.
- **Accepted answers**.
- **Bookmarks**.
- **Polls**, with their votes.
- **Watched and muted topics**, so members' notification preferences survive.
- **Private messages**.

**Links**

- Internal links between topics and posts are **rewritten** to their new addresses.

## Idempotency

Every imported row carries its **Discourse id**. Re-running an interrupted import never duplicates anything: rows that already exist are recognized and skipped. If the import dies halfway through a 40,000-post board, run the same command again.

## Rehosting files

`--download-files` pulls every referenced image, attachment and avatar off the old CDN into [content-addressed storage](../file-storage), then rewrites the posts that use them. It is **resumable** and **rate-limited** through `--delay-ms`.

If you want the content in place quickly and the files afterwards, run the import without `--download-files`, then:

```bash
bin/plugin forum-pro import-discourse backup.sql.gz \
    --source-url https://discourse.example.com --files-only --delay-ms 250
```

The old forum needs to stay reachable until the file pass finishes, so **do not flip DNS before the files are down**.

## A suggested cutover plan

1. **Stand the new forum up on a staging host** and get it configured the way you want: categories, groups, spam settings, theming.
2. **Take a Discourse backup** and run the import with `--download-files`. Budget real time for this; a large board with years of images takes a while.
3. **Check the result.** Spot-check topics with code blocks, quotes and images. Check that a few members' badges and titles arrived. Check private messages.
4. **Take a fresh backup and re-run the import** shortly before cutover to pick up everything posted since step 2. The import is idempotent, so this only adds the delta.
5. **Put Discourse into read-only mode** so nothing new arrives after your final export.
6. **Configure legacy redirects** (below).
7. **Flip DNS last.**

Keep the Discourse instance running, read-only, for a while after the cutover. It costs little and it is your fallback.

## Legacy redirects

Old Discourse URLs can 301 to their Forum Pro equivalents, which keeps search rankings and old bookmarks working.

```yaml
frontend:
  legacy_redirects:
    enabled: true
    discourse:
      hosts: ['forum.example.com']       # old Discourse hostname(s)
      target_base: 'https://example.com' # empty means same host
```

The following Discourse URL shapes are recognized and redirected:

| Discourse path | Redirects to |
|---|---|
| `/t/<slug>/<id>` and `/t/<slug>/<id>/<post>` | The topic, at the correct post |
| `/p/<id>` | The post, in its topic |
| `/c/<slug>` | The category |
| `/u/<username>` | The member profile |
| `/` | The forum root |

With `hosts` empty the feature is **inert**, so turning `enabled: true` on early is harmless. Add the hostname when you are ready.

There are two ways to use this:

- **Point the old hostname at your Grav site.** Requests to `forum.example.com/t/...` reach Grav, which 301s them to `example.com/forum/...`.
- **Serve the forum on the old hostname.** Set `target_base` empty and the redirects stay on the same host.

## After the import

Run these once the dust settles:

```bash
bin/plugin forum-pro recount      # repair denormalized counters
bin/plugin forum-pro reindex      # build the search index over imported content
bin/plugin forum-pro integrity    # read-only consistency report
```

`recount` matters because an import writes rows directly rather than going through the posting path that normally keeps counters current. `integrity` is read-only and tells you about dangling references and counter drift without changing anything.

You will probably also want a pass through **Admin → Forum → Tags** to merge tags that arrived under multiple spellings.

## Things to know

- **The metrics ledger does not backfill.** The Dashboard's DAU/MAU and trend charts accrue from the day Forum Pro is deployed, so an imported forum starts with a flat chart. Totals such as member and post counts are computed live and are correct immediately.
- **Deleted Discourse users** import as a "Deleted User" placeholder so that their posts keep their position in threads.
- **Bulk message cleanup exists for a reason.** An import often brings across thousands of old private messages. The [bulk archive and delete tools](../notifications-and-email#private-messages) with select-all-N are how members clear them without clicking a thousand times.

## Importing from something else

Discourse is the only source shipped today, but the importer sits on a **general import layer**: id mapping for idempotency, a Markdown conversion pipeline, password-hash adapters and resumable file rehosting are all source-agnostic. Adding a new platform is mostly a matter of teaching it to read a different export format.

**Talk to us about an importer for your platform.** Email [premium@getgrav.org](mailto:premium@getgrav.org) with what you are running and what an export looks like, and we will tell you honestly what is involved. If your platform is a common one, you are probably not the only person asking.

If your current platform can export to a Discourse backup, that route works today.

## This is how getgrav.org moved

The [Grav Community Forum](https://getgrav.org/forum) runs Forum Pro. Nine years of history, **41,000+ posts across 9,300+ topics from 3,800+ members**, came out of Discourse through this importer in a single command, with every member's password still working on the other side. It is worth a look around before you plan your own move.
