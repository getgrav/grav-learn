---
title: Migrating from XenForo
taxonomy:
    category: docs
description: Import a XenForo 2 database dump and its file folders into Forum Pro, keep every password working, map reactions onto yours, and 301 old thread URLs in place.
---

# Migrating from XenForo

Forum Pro imports a **XenForo 2.2 forum** from a plain MySQL dump of its tables plus a copy of two folders from the install. Members keep working passwords, BBCode converts to Markdown, attachments and avatars adopt straight off disk into your own storage, and the import is resumable and idempotent.

## What you need

Ask whoever runs the XenForo install for two things:

1. **A schema-and-data dump** of the `xf_*` tables. A plain `mysqldump xenforo > dump.sql` is right; add `--no-tablespaces` on shared hosts. phpMyAdmin exports work too. A data-only dump (`mysqldump -t`) is refused, because without the `CREATE TABLE` statements nothing can name the columns.
2. **Two folders from the install**: `internal_data/attachments` and `data/avatars`. XenForo gates attachment downloads by permission, so files are read off disk rather than fetched over HTTP.

The dump is **stream-parsed in PHP**. You do not need MySQL installed on the new server, and a multi-gigabyte dump streams through in constant memory.

## The command

```bash
bin/plugin forum-pro import-xenforo dump.sql \
    --source-url https://forum.example.org \
    --xf-root /path/to/xenforo
```

| Option | Purpose |
|---|---|
| `--source-url` | The old forum's base URL, including any subfolder such as `/community`. Internal links in posts are recognized and rewritten from it. |
| `--xf-root` | The XenForo install root; `internal_data/attachments` and `data/avatars` are found under it. |
| `--attachments-dir`, `--avatars-dir` | Point at either folder individually, overriding `--xf-root`. |
| `--skip-files` | Import the data only. Useful for a first look before the folders arrive. |
| `--prefixes tag|title|skip` | What to do with thread prefixes: make them tags (the default), prepend `[Prefix]` to the title, or drop them. |
| `--skip-pms` | Leave conversations (private messages) behind. |
| `--default-section` | Section title for forums that have no top-level category above them. |

The dump can be gzipped. A 55 MB dump with 6,000 posts and 2,500 attachments imports in about ten seconds into an empty database.

## What comes across

**Members and identity**

- Members, with **working passwords**. XenForo 2 stores bcrypt, which Forum Pro verifies natively; accounts still on a XenForo 1 hash verify through a tagged legacy format and upgrade to bcrypt on first login. Usernames with spaces are sanitized into valid handles (`Jane Doe` becomes `Jane_Doe`) with the original kept as the display name.
- Admins and moderators, as **moderator grants**. Bans and disabled accounts, as suspensions.
- Custom **user groups**, with their memberships. XenForo's four stock groups are not created.
- **Trophies**, as manually awarded badges, and custom titles.
- **Signatures** and **avatars**.

**Structure and content**

- **The node tree.** A top-level category becomes a **section**; every forum becomes a **category** inside the section of its topmost ancestor. Deeper nesting is flattened rather than reproduced, because Forum Pro has exactly two levels. Page and link nodes are skipped. A forum closed to new posts becomes staff-only.
- **Threads**, with their sticky, open and deleted states and view counts. Redirect threads are skipped.
- **Posts**, with BBCode converted to Markdown: bold, italic, strikethrough, headings, lists, tables, quotes with attribution, code and inline code, spoilers (as a headed quote, since Forum Pro never renders raw HTML), images, `[USER]` mentions, `[ATTACH]` references and `[MEDIA]` embeds. Presentation-only tags such as colour, size, font and alignment lose their markup and keep their text.
- **Edit history**, as post revisions.
- **Attachments**, adopted into [content-addressed storage](../file-storage). Images render inline, other files link.
- **Reactions**, mapped onto your configured types (see below).
- **Tags** and **thread prefixes**.
- **Accepted answers** from question forums.
- **Bookmarks**, **polls** with their votes, and **thread and forum watches**.
- **Conversations**, as private messages.

**Links**

- Internal links between threads, posts, forums and members are rewritten to their new addresses, in both the friendly and the `index.php?threads/...` form.

## Reactions

XenForo ships six reactions (Like, Love, Haha, Wow, Sad, Angry) and Forum Pro ships four (`like`, `heart`, `laugh`, `confused`). Reaction types are just configuration, so the cleanest move is to configure XenForo's six **before** you import:

```yaml
reactions:
  enabled: true
  types:
    like: 1
    heart: 1
    laugh: 0
    wow: 0
    sad: 0
    angry: 0
  emoji:
    like: "👍"
    heart: "❤️"
    laugh: "😄"
    wow: "😮"
    sad: "😢"
    angry: "😡"
```

The importer matches each XenForo reaction by its title against your `reactions.types`. A title that names a type keeps its identity, and two synonyms are understood: **Love becomes `heart`** and **Haha becomes `laugh`**. A reaction you have no type for becomes a `like`, so nothing is lost even with the default four. Add-on reactions work the same way: name a type after them and they come across as themselves.

## Media embeds

`[MEDIA]` tags become links to the original post, rebuilt from the provider id XenForo stores. YouTube, Vimeo, Twitter/X, Instagram, TikTok, Imgur, Reddit, Facebook, Dailymotion, SoundCloud, Giphy, Flickr, Pinterest and Spotify are recognized. A provider that is not is dropped and counted in the report.

## Reading the report

The import ends with a table of counts. Most are inventory; a handful tell you about fidelity:

| Metric | Meaning |
|---|---|
| `transform regex bailouts` | A post was too much for the BBCode converter, so it kept its raw BBCode rather than lose text. Zero is normal. |
| `posts transform fallbacks` | A post would have come out empty (it was nothing but tags with no equivalent), so it kept its BBCode. |
| `attachments missing` | A post referenced a file that was not in the folders you supplied. |
| `attachments unresolved` | A post referenced an attachment id the dump itself no longer has. Nothing to fix; XenForo had already lost it. |
| `media unsupported` | An embed from a provider with no known link pattern. |
| `mentions unresolved` | An `@mention` of a member who is not in the dump, usually a deleted account. |
| `passwords dropped` | An account on a password scheme Forum Pro cannot verify, such as an add-on's. Those members use the reset flow once. |

## Idempotency

Every imported row carries its **XenForo id**. Re-running an interrupted import never duplicates anything, and re-running against a fresh dump before cutover only adds what is new.

Behind the scenes the dump is read once into a spool in the system temp directory, keyed on the dump file. A second run of the same file reuses the spool, which is why re-runs are fast.

## Mounting at the old address

Most XenForo forums live at their own hostname, often at its root. To keep the address, mount the forum at the site root and let the legacy redirects handle the old URL shapes on the same host:

```yaml
frontend:
  route: ''
  legacy_redirects:
    enabled: true
    xenforo:
      hosts: ['forum.example.org']
      base_path: ''
      target_base: ''
      catch_all: false
```

Make the forum page Grav's home (`system.home.alias`) as described in [Installation](../installation#mounting-the-forum). A visitor arriving at `/threads/some-title.123/` then lands on the right topic without leaving the host.

If the forum lived in a subfolder, set `base_path: '/community'`; if the old hostname is going away entirely, `catch_all: true` sends anything unmapped under that path to the forum index. Unlike the Discourse source, the XenForo one defaults to **no** catch-all, because the rest of the old host usually keeps working.

| XenForo path | Redirects to |
|---|---|
| `/threads/<slug>.<id>/` and `/threads/<slug>.<id>/post-<n>` | The topic, at the correct post |
| `/posts/<id>/` | The post, in its topic |
| `/forums/<slug>.<id>/` | The category |
| `/members/<name>.<id>/` | The member profile |
| `/tags/<tag>/` | The tag |
| `/index.php?threads/<slug>.<id>/` | The same, for installs without friendly URLs |

## A suggested cutover plan

1. **Stand the new forum up on a staging host.** Configure reactions, groups, spam settings and theming first, because reactions in particular map at import time.
2. **Get the dump and the two folders** and run the import. Read the report.
3. **Check the result.** Open a few BBCode-heavy posts: a release announcement with lists and links, a proposal with a table, a long quoted thread, a post that is mostly attachments. Check a member's avatar, a poll, and a private message.
4. **Take a fresh dump shortly before cutover** and re-run the import to pick up the delta.
5. **Close the old forum** to new posts.
6. **Point the hostname at the new site** with the legacy redirects enabled.

## After the import

```bash
bin/plugin forum-pro recount      # repair denormalized counters
bin/plugin forum-pro reindex      # build the search index
bin/plugin forum-pro integrity    # read-only consistency report
```

## Things to know

- **Custom BBCode from add-ons** has no converter, so its tags are stripped and the text kept. If a forum leans on one, tell us which; common ones are quick to add.
- **A bare `[word]` with no closing tag is kept as text**, because changelog-style posts label entries that way and XenForo shows them verbatim.
- **The metrics ledger does not backfill.** The dashboard's activity charts accrue from the day Forum Pro is deployed; totals are correct immediately.
- **Links to an even older platform stay as they were.** A forum that came to XenForo from somewhere else often still carries that platform's URLs in old posts. Those are not XenForo links, so the importer leaves them alone.
