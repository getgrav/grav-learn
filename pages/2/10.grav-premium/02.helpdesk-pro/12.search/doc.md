---
title: Search
taxonomy:
    category: docs
description: The one search index for tickets and articles, who finds what, how it stays current, synonyms, similar tickets and optional semantic search.
---

# Search

One search index holds tickets and knowledge base articles. The help center, the request form, the desk and the API all ask it, and each shows the asker only what they may read. It runs on the YetiSearch library (SQLite FTS5 with BM25 ranking), bundled inside Helpdesk Pro, so there is nothing to install and no service to run.

## Where the index lives

The index is one SQLite file, `user/data/helpdesk-pro/search/helpdesk.db`, with a marker `helpdesk.meta.json` beside it. It follows `database.sqlite.path`: it is the `search/` folder next to the database's folder, and gets a deny-all `.htaccess`. It is derived data: delete it any time and the next search builds it again.

The file holds two indexes:

| Index | What is in it | Who searches it |
|---|---|---|
| `hd_public` | One document per ticket (subject, first message, public replies, label names) and one per knowledge base article (title, text, categories and tags) | Clients, guests (articles only) and staff |
| `hd_internal` | One document per ticket that has internal notes: the note text and nothing else | Staff only |

Note text is written only to `hd_internal`, and the client search code has no way to name that index, so no search a client makes reaches a note.

## Who finds what

Every search narrows by permission first, then checks each hit again against the database.

- **Guests** find public articles.
- **Signed-in clients** find the articles they may read, the tickets they asked or were copied on, and the shared tickets of projects they belong to. They see a ticket's summary and status in client words, never its notes, internal activity or people.
- **Staff** find tickets in the projects they work (admins: all), internal notes included, and every article. A ticket found through its notes says **Matched in an internal note** in the desk's list.

## How the index stays current

- **Tickets** are reindexed after every change: a new ticket, a reply or note, an edit, a label, a status, a participant, a merge or a delete. The writes are made once at the end of the request, after the response has gone. A request that changed more than 100 tickets (a bulk edit) hands them to `search.index` jobs instead.
- **Articles** are reindexed when their page is saved, translated or moved in the admin, and removed when deleted, unpublished or changed to another page type. Edits made outside Grav (git sync, FTP, a deploy) are caught by the hourly `kb.sync` job and by the first help center search after a cache clear.
- **Self-healing.** The first search of a request checks that the file and its marker exist and that no ticket was written around the index (an import or a restored database). If anything is off it rebuilds on the spot, for up to two seconds. A bigger index is finished by a `search.rebuild` job, and meanwhile searches fall back to a plain match on ticket summaries and article titles. A file that cannot be read is deleted and rebuilt the same way.

### Rebuild the index

Use any of these:

- **Operations → Search → Rebuild index** in the desk (**Rebuild articles only** rebuilds just the knowledge base part).
- `bin/plugin helpdesk-pro reindex` on the server. `--scope=tickets` or `--scope=kb` rebuilds one part; `--status` prints the index state without rebuilding.
- `POST /helpdesk-pro/search/rebuild` through the API.

**Operations → Search** also shows whether the index is built, how many documents it holds, when it was last rebuilt, its size and path, how many synonyms are loaded, and the semantic search state. It needs `helpdesk-pro.settings`.

## Synonyms

People and articles do not always use the same words. A search for any word or phrase in a group also finds the others:

```
log in, login, sign in, signin, log on
log out, logout, sign out
password, passcode, pass word, pwd
reset, forgot, recover, change password
account, profile, user
email, e-mail, mail, inbox
invoice, bill, receipt
refund, money back, chargeback
cancel, unsubscribe, stop, close account
subscription, plan, membership, renewal
error, bug, broken, not working, doesn't work, crash, issue
slow, lag, loading, performance
upload, attach, attachment, file
download, install, setup, set up
delete, remove, erase
two-factor, 2fa, mfa, authenticator, verification code
payment, card, charge, billing
shipping, delivery, tracking
license, licence, key, activation
```

To change the list:

1. Copy `user/plugins/helpdesk-pro/data/synonyms.json` to `user/data/helpdesk-pro/search/synonyms.json`.
2. Edit its `groups`. Each group is a list of words and phrases (`["log in", "login", "sign in"]`), and a phrase matches as a phrase.

Helpdesk Pro reads your copy instead of the plugin's. Set `search.synonyms` to `false` to turn synonyms off.

When a search finds nothing at all, it tries once more with typo correction, unless `search.fuzzy` is `false`.

## Similar tickets

The ticket screen's **Similar tickets** panel lists tickets in the projects you work whose subject and text are like this one's. The ticket itself and tickets merged into it are left out, and weak matches (under 35% of the best one's score) are dropped, so the panel only appears when something is close. Clients never see similar tickets; the request form suggests articles and their own requests instead.

## Semantic search

Keyword search finds words. Semantic search also finds meaning: "my card was charged twice" can find the article titled "Duplicate payments". It needs an embeddings API that speaks the OpenAI format (OpenAI, OpenRouter, Ollama, Voyage, Mistral and others), and it is off by default.

Turn it on in the plugin settings (**Search** tab), or in `user/config/plugins/helpdesk-pro.yaml`:

```yaml
search:
  semantic:
    enabled: true
    api_key: 'env:OPENAI_API_KEY'
```

Write the key as `env:NAME` to read it from the environment variable `NAME`. A key typed into the settings is stored as it is in `user/config`. The key is never returned by the API or shown in the desk.

How it works:

- Documents are embedded by the `search.embed` job, in batches of `search.semantic.batch_limit`, after they are indexed. That job only runs on the worker, never at the end of a visitor's request, so semantic search needs the scheduler in cron ([Jobs and cron](../jobs-and-cron)).
- A search embeds the query and ranks by words and meaning together, with `search.semantic.weight` deciding the share. Queries shorter than `search.semantic.min_query_chars` stay keyword only.
- Only `hd_public` is embedded. Internal notes are sent to the API only when `search.semantic.notes` is on; otherwise note text never leaves your server.
- When the API fails, search carries on with keywords. **Operations → Search** shows how many documents are embedded and how many are waiting.

Tickets default to 256 dimensions. At 512 dimensions a search costs about 110 ms per 10,000 chunks; 256 halves that. Each ticket counts once in the results however many chunks its text splits into.

### Sharing settings with YetiSearch Pro

The semantic keys follow YetiSearch Pro's `semantic:` settings name for name. Any key left empty takes YetiSearch Pro's value when that plugin is enabled with its own semantic search on, and the built-in default otherwise, so a site running both configures one model in one place.

The connection keys (`base_url`, `api_key`, `model`, `dimensions` and the two prefixes) go together: setting any of them here means none are taken from YetiSearch Pro. `enabled`, `notes`, `embed_after_indexing` and `batch_limit` are never taken from YetiSearch Pro.

## Settings

| Key | Default | What it does |
|---|---|---|
| `search.fuzzy` | `true` | Retry a search that found nothing with typo correction. |
| `search.synonyms` | `true` | Expand searches with the synonym list. |
| `search.semantic.enabled` | `false` | Rank by meaning as well as words. |
| `search.semantic.provider` | `openai_compatible` | The only provider: any OpenAI-compatible embeddings API. |
| `search.semantic.base_url` | empty (`https://api.openai.com/v1`) | The API's base URL, such as `http://localhost:11434/v1` for Ollama. |
| `search.semantic.api_key` | empty | The key, or `env:NAME`. Not needed for a local server. |
| `search.semantic.model` | empty (`text-embedding-3-small`) | The embedding model. |
| `search.semantic.dimensions` | empty (`256`) | Vector length, for models that take one; `0` is the model's own. |
| `search.semantic.query_prefix` | empty | Text put before queries (`search_query: ` for nomic-embed-text). |
| `search.semantic.document_prefix` | empty | Text put before documents (`search_document: `). |
| `search.semantic.weight` | empty (`0.5`) | Share of the ranking that comes from meaning: `0` words only, `1` meaning only. |
| `search.semantic.min_similarity` | empty (`0.25`) | Documents less similar than this never appear on meaning alone. |
| `search.semantic.min_query_chars` | empty (`3`) | Shorter queries are keyword only. |
| `search.semantic.query_timeout` | empty (`5`) | Seconds a search waits for the query's embedding before going on with keywords. |
| `search.semantic.timeout` | empty (`20`) | Seconds the worker waits for a batch of document embeddings. |
| `search.semantic.embed_after_indexing` | `true` | Queue `search.embed` whenever documents change. |
| `search.semantic.batch_limit` | `200` | Documents per `search.embed` job. |
| `search.semantic.notes` | `false` | Also embed internal notes (sends note text to the API). |
| `portal.suggestions` | `true` | Suggest articles while people type in the search box and the request form. |
| `portal.kb_session_days` | `30` | How long the `hd_kb` cookie keeps a visitor's searches together. |
| `privacy.kb_events_days` | `90` | Help center searches, views and answers are deleted after this many days. |

An empty semantic key resolves as described in [Sharing settings with YetiSearch Pro](#sharing-settings-with-yetisearch-pro); the value in brackets is the built-in default.

## API and MCP

| Route | Permission | What it does |
|---|---|---|
| `GET /helpdesk-pro/search` | desk | `q`, `scope` (`all`, `tickets` or `kb`), `include_notes` (default on), `project`, `limit` (up to 100). Answers `{tickets, articles, semantic, fallback}`; ticket rows carry `score` and `matched_in_note`. `fallback: true` means the plain match answered while the index was rebuilt. |
| `GET /helpdesk-pro/tickets/{id}/similar` | desk | Similar tickets (`limit` up to 20), with a relative `score`. |
| `POST /helpdesk-pro/search/rebuild` | settings | `scope`: `all`, `tickets` or `kb`. Queues `search.rebuild` and answers `202` with `{job_id, scope, queued}`; `queued: false` when a rebuild was already waiting. |

MCP tools: `search`, `find_similar_tickets` and `rebuild_search`.

## Jobs

| Job | What it does |
|---|---|
| `search.index` | Rewrites the documents of some tickets: the overflow path for bulk changes. |
| `search.rebuild` | Rebuilds the index. One at a time. |
| `search.embed` | One embedding pass over an index, booked again while documents wait. Worker only. |
| `kb.sync` | Hourly: reindexes the knowledge base when an article changed outside Grav. |

## Related

- [Knowledge base](../knowledge-base)
- [Jobs and cron](../jobs-and-cron)
- [CLI](../cli)
