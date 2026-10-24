---
title: REST API
taxonomy:
    category: docs
description: Forum Pro's routes under /api/v1/forum-pro, how a key posts as a member, which routes need a Grav permission, and every route grouped by area.
---

# REST API

Forum Pro adds its routes to the Grav API plugin, under `/api/v1/forum-pro/`. The Forum area in Admin Next is built on these routes, and members can read, post, reply, edit, react and report through them too, so a script or a bot can do what a member does on the forum. Paths below leave out the `/api/v1` prefix.

## Authenticate

Use any credential the API plugin accepts:

- An **API key**, sent as `X-API-Key`. Create one in Admin Next (your account, then **API Keys**) or on the server with `bin/plugin api keys:generate --user=<username>`.
- A **JWT** from `POST /auth/token`, sent as `X-API-Token` (Admin Next does this).

```bash
curl -k "https://example.test/api/v1/forum-pro/structure" -H "X-API-Key: $KEY"
```

## Who may call what

There are two kinds of route, and they are authorized differently.

**Content routes** (reading and writing topics and posts) act as the forum member linked to the calling account. They need no Grav permission, not even `api.access`. The forum decides, with exactly the rules it applies on the site: the [category permissions](../administration#category-permissions) for reading, starting topics and replying, closed topics and categories, the edit window, bans, rate limits, spam scoring, premoderation, and the [provisional account](../spam-protection) restrictions. A post made through the API is the same as one made on the forum, and notifies, counts and appears live the same way.

The member is the account's linked forum account, created on its first call the way it is on a first visit ([Grav accounts](../members-and-accounts#grav-accounts)). A content write is refused when:

- `auth.grav_members` is `false`, so Grav accounts are not forum members (`403 You must be logged in to …`).
- The forum account is suspended or deleted.
- The account has not chosen a forum username yet.
- The category does not let that member's groups do it.

An account holding `admin.forum-pro.moderate`, `admin.forum-pro.admin` or `api.super`, or a [moderator role](../moderation#moderator-roles), is staff on these routes, and may edit and delete other people's posts and change topics, within its moderation scope.

**Management routes** (structure, the queue, bans, moderators, groups, tags, members, invites, status and metrics) need `api.access` plus a Forum Pro permission ([Permissions](../administration#permissions)). The tables say **admin** for `admin.forum-pro.admin` and **moderate** for `admin.forum-pro.moderate`; `admin` and `api.super` count as both. A key created with scopes is limited to them on these routes: give it `admin.forum-pro.moderate` or `admin.forum-pro.admin`.

Content routes act with the full standing of the key's account, so for a bot or an integration, create a dedicated Grav account, sign in to the forum with it once to choose a username, and create the key on that account. Its posts then carry its own name, and it has no more power than a member.

## Public reads

The four read routes, `GET /forum-pro/structure`, `GET /forum-pro/categories/{id}/topics`, `GET /forum-pro/topics/{id}` and `GET /forum-pro/topics/{id}/posts`, answer without credentials. A guest gets what a guest may read on the forum; send a key and the answer includes what that member may read. A topic the caller cannot see answers `404`, the same as one that does not exist. With `gate.private` on, the forum has no public API and these routes need credentials too.

## Conventions

- Answers wrap their payload in `data`. Lists take `page` and `per_page` and carry `meta.pagination` (`page`, `per_page`, `total`, `total_pages`) and `links`.
- Errors are problem details (`application/problem+json`) with `status`, `title` and `detail`. The forum's reason is in `detail`: `422 Title must be between 3 and 255 characters`, `403 You are not allowed to reply in this category`, `409 This topic is closed`.
- Times are UTC epoch seconds.
- Post bodies are sent as Markdown in `body_md` and rendered on the server, @mentions and quotes included. Reads answer the rendered `body_html`.
- Writes send an `X-Invalidates` header (`forum:topic:<id>`, `forum:category:<id>`, `forum:structure`, …) so Admin Next refetches what changed. `GET /forum-pro/topics/{id}` sends an `ETag`.

## Routes

### Reading

| Route | Permission | What it does |
|---|---|---|
| `GET /forum-pro/structure` | public | Sections with their categories (and subcategories in `children`), counts and each category's last post |
| `GET /forum-pro/categories/{id}/topics` | public | A category's topics, pinned first. `sort` is `bumped` (the default), `created` or `replies`; `page`, `per_page` (at most 100). |
| `GET /forum-pro/topics/{id}` | public | One topic, with its `category` |
| `GET /forum-pro/topics/{id}/posts` | public | Its posts, oldest first, with author, rank, badges, `reactions`, `my_reactions` and `replies`. `page`, `per_page`. |

### Topics and posts

| Route | Permission | What it does |
|---|---|---|
| `POST /forum-pro/topics` | member | `{category_id, title, body_md}`: start a topic. Answers `201` with `{topic, post}`. |
| `POST /forum-pro/topics/{id}/posts` | member | `{body_md, parent_post_id, quoted_post_ids}`: reply. `parent_post_id` threads it under a post; both must belong to the topic. Answers `201` with the post. |
| `PATCH /forum-pro/posts/{id}` | member | `{body_md}`: edit a post. Its author within `posting.edit_window_minutes`, staff any time. The old body is kept as a revision. |
| `DELETE /forum-pro/posts/{id}` | member | `{reason}` optional: delete a post. Its author or staff. The opening post cannot be deleted; delete the topic. |
| `POST /forum-pro/posts/{id}/react` | member | `{type}`: toggle a reaction, one of the `reactions.types` keys (`like`, `heart`, `laugh`, `confused` by default). Not on your own post. Answers `{reacted, type, counts}`. |
| `POST /forum-pro/posts/{id}/report` | member | `{reason, message}`: report a post to the moderators. `reason` is `spam`, `abuse`, `off_topic` or `other`; `message` is at most 1000 characters. Once per post. |
| `PATCH /forum-pro/topics/{id}` | staff | Any of `title`, `slug`, `is_pinned`, `state` (`open`, `closed`, `archived`, `hidden`) and `category_id` (move it) |
| `DELETE /forum-pro/topics/{id}` | staff | `{reason}` optional: delete a topic |
| `POST /forum-pro/topics/{id}/merge` | staff | `{target_topic_id}`: move every post into another topic. Answers the target. |
| `POST /forum-pro/topics/{id}/split` | staff | `{post_ids, title, category_id}`: move posts into a new topic, in this category unless `category_id` says otherwise. Answers `201` with the new topic. |

A topic or reply can be born `pending` rather than published, when the category premoderates the member or the spam score holds it for review. It then appears once a moderator approves it.

### Moderation

| Route | Permission | What it does |
|---|---|---|
| `GET /forum-pro/moderation/counts` | moderate | How many are waiting in each queue tab |
| `GET /forum-pro/moderation/queue` | moderate | One tab of the queue: `tab` is `pending` (the default), `spam`, `deleted` or `flagged`; `page`, `per_page` |
| `POST /forum-pro/moderation/posts/{id}` | moderate | `{action, reason}`: `approve`, `hide`, `spam` or `delete` one post. Its open reports are closed with it. |
| `POST /forum-pro/moderation/bulk` | moderate | `{action, post_ids, reason}`: the same over 1 to 100 posts. Answers `{done, errors}`. |
| `POST /forum-pro/moderation/flags/{id}/dismiss` | moderate | Dismiss one report |
| `GET /forum-pro/bans` | moderate | Active bans; `all=1` includes expired and revoked ones. `page`, `per_page`. |
| `POST /forum-pro/bans` | moderate | `{user_id, scope, scope_id, reason, expires_at, content_disposition}`. `scope` is `global` (the default), `section` or `category`; `content_disposition` is `keep` (the default), `hide_all`, `anonymize` or `delete_all` ([Content disposition](../moderation#content-disposition)). |
| `DELETE /forum-pro/bans/{id}` | moderate | `{reason}` optional: lift a ban |
| `GET /forum-pro/appeals` | moderate | Open ban appeals |
| `POST /forum-pro/appeals/{id}` | moderate | `{accept, note}`: accept or reject an appeal |

### Structure

| Route | Permission | What it does |
|---|---|---|
| `POST /forum-pro/sections` | admin | `{title, description, position, icon}` |
| `PATCH /forum-pro/sections/{id}` | admin | Any of the same |
| `DELETE /forum-pro/sections/{id}` | admin | Delete an empty section. One with categories answers `409`. |
| `POST /forum-pro/categories` | admin | `{section_id, title, parent_id, description, icon, perms, state, position}`. `parent_id` makes it a subcategory, in the same section. |
| `PATCH /forum-pro/categories/{id}` | admin | Any of the same, plus `slug`. A new slug leaves a redirect from the old one. |
| `DELETE /forum-pro/categories/{id}` | admin | Delete a category with no topics and no subcategories, otherwise `409` |
| `POST /forum-pro/structure/reorder` | admin | `{sections: [{id, position}], categories: [{id, position}]}` |
| `GET /forum-pro/icons` | admin | Every icon name a section or category may use |

### Moderators, groups and tags

| Route | Permission | What it does |
|---|---|---|
| `GET /forum-pro/moderators` | admin | Every moderator role |
| `POST /forum-pro/moderators` | admin | `{user_id or username, scope, scope_id}`: grant a role. `scope` is `global`, `section` or `category`. |
| `DELETE /forum-pro/moderators/{id}` | admin | Revoke one |
| `GET /forum-pro/groups` | admin | Every group |
| `POST /forum-pro/groups` | admin | `{title, description, color, icon, position, grav_group}`. `grav_group` links it to a Grav group ([Groups](../members-and-accounts#groups)). |
| `PATCH /forum-pro/groups/{id}` | admin | Any of the same |
| `DELETE /forum-pro/groups/{id}` | admin | Delete a group |
| `GET /forum-pro/groups/{id}/members` | admin | Its members. `page`, `per_page`. |
| `POST /forum-pro/groups/{id}/members` | admin | `{username}`: add a member |
| `DELETE /forum-pro/groups/{id}/members/{userId}` | admin | Take one out |
| `GET /forum-pro/tags` | admin | Every tag with its use count |
| `PATCH /forum-pro/tags/{id}` | admin | `{title}`: rename it |
| `POST /forum-pro/tags/{id}/merge` | admin | `{target_id}`: fold it into another tag |
| `DELETE /forum-pro/tags/{id}` | admin | Delete it and take it off every topic |

### Members and invitations

| Route | Permission | What it does |
|---|---|---|
| `GET /forum-pro/members` | admin | The member table. `search`, `group`, `badge`, `moderators=1`, `sort` (`joined`, `active`, `state`, `rank`, `posts`, `topics`, `rep`, `badges`), `dir` (`asc` or `desc`), `page`, `per_page`. |
| `GET /forum-pro/members/meta` | admin | The groups, ranks and badges the member screens offer |
| `POST /forum-pro/members` | admin | `{username, email, group_ids}`: create a native member and email them a link to set a password. Answers `201` with `{member, email_sent, email_error}`. |
| `GET /forum-pro/members/{id}` | admin | One member in full |
| `PATCH /forum-pro/members/{id}` | admin | Any of `display_name`, `email`, `email_verified`, `title`, `rank_id`, `custom_rank`, `custom_rank_icon` and `state` (`active` or `suspended`). A member who signs in with a site account keeps the email address it has there. |
| `DELETE /forum-pro/members/{id}` | admin | Delete a member |
| `POST /forum-pro/members/{id}/password` | admin | `{password}`: set a native member's password |
| `POST /forum-pro/members/{id}/set-password-link` | admin | Email a fresh set-password link to a member who has no password yet |
| `POST /forum-pro/members/{id}/badges` | admin | `{badge_id}`: award a badge |
| `DELETE /forum-pro/members/{id}/badges/{badgeId}` | admin | Take one back |
| `GET /forum-pro/invites` | admin | Invitations to a closed forum. `status` is `open` (the default) or `all`. |
| `POST /forum-pro/invites` | admin | `{email, group_ids}`: invite someone |
| `POST /forum-pro/invites/{id}/resend` | admin | Send it again |
| `DELETE /forum-pro/invites/{id}` | admin | Revoke it |

### Status and metrics

| Route | Permission | What it does |
|---|---|---|
| `GET /forum-pro/status` | admin | The Status tab: database, schema, jobs and scheduler health |
| `GET /forum-pro/dashboard/metrics` | admin | The Dashboard tab. `range` in days, 30 by default. |

## A quick check with curl

```bash
KEY=...   # an API key on the account the bot posts as
BASE=https://example.test/api/v1/forum-pro

# Find a category id
curl -k "$BASE/structure" -H "X-API-Key: $KEY"

# Start a topic in it
curl -k -X POST "$BASE/topics" -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"category_id": 3, "title": "Nightly build 2.0.4 is out", "body_md": "Changes since yesterday: ..."}'

# Reply to topic 9434
curl -k -X POST "$BASE/topics/9434/posts" -H "X-API-Key: $KEY" -H "Content-Type: application/json" \
  -d '{"body_md": "Thanks, that fixed it for me."}'
```

## Related

- [Administration](../administration#permissions)
- [Members and Accounts](../members-and-accounts#grav-accounts)
- [Moderation](../moderation)
- [Grav API: Authentication](/2/api/authentication)
