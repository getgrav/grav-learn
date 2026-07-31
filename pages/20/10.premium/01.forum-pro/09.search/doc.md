---
title: Search
taxonomy:
    category: docs
description: The built-in full-text engine, the YetiSearch Pro engine, result filters and permission scoping, and rebuilding the index.
---

# Search

Search lives at `{forum}/search` and covers every published post. It is always **constrained by the visitor's category permissions**, so a guest never sees a result from a staff-only category and a member never sees one from a category they cannot read.

## Filters

The search form supports:

- **Keywords**
- **Author**
- **A single forum** (category)
- **Topics only**, which searches first posts and ignores replies

## Result cards

Results render as post-style cards rather than a list of links: author avatar, display name and group badges, date, a **solution flag** on accepted answers, and the matching text highlighted in context. The intent is that a searcher can often get their answer from the results page without opening anything.

## Engines

```yaml
search:
  engine: builtin    # builtin | yetisearch
```

### `builtin`

Zero setup. Forum Pro uses whatever full-text facility your database provides:

| Engine | Mechanism |
|---|---|
| SQLite | FTS5 |
| MySQL / MariaDB | `FULLTEXT` indexes |
| PostgreSQL | `tsvector` |

The index maintains itself as content is created, edited and deleted.

### `yetisearch`

Hands indexing to the [YetiSearch Pro](https://getgrav.org/premium/yetisearch-pro) plugin, which adds **fuzzy matching** (so a typo still finds the post) and **tuned relevance**.

If `engine: yetisearch` is set but the plugin is not installed, Forum Pro **falls back to `builtin`** rather than failing. Switching engines is therefore safe to try.

## Rebuilding the index

After a large import, an engine switch, or any operation that wrote to the database outside the normal path, rebuild:

```bash
bin/plugin forum-pro reindex
```

This drops and repopulates the search index from the posts table. It is safe to run on a live forum; search results are simply incomplete while it runs.

## Re-rendering stored posts

Search indexes rendered post text, so a change to the text pipeline (a new `codesh` version, a Markdown setting, a mention-rendering fix) can leave the index and the display out of step with each other. Re-render, then reindex:

```bash
bin/plugin forum-pro rerender
bin/plugin forum-pro reindex
```

## Search and article comments

[Article comments](../article-comments) are ordinary forum posts, so they are indexed and searchable alongside everything else. A reader searching your forum finds relevant blog comments too.

## What is not indexed

- **Unpublished content**: anything pending, spam-queued, hidden or soft-deleted
- **Private messages**, which are never searchable outside the conversation
- **Categories the visitor cannot read**
