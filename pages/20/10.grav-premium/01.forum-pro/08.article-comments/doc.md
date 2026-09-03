---
title: Article Comments
taxonomy:
    category: docs
description: Turn any Grav page into a commentable article whose discussion lives in the forum, with one Twig call and a counter helper for listings.
---

# Article Comments

Forum Pro can put a comment section on any Grav page, with the discussion stored as a **real forum topic**. Because the forum runs in the same Grav install, there is no iframe, no third-party JavaScript embed and no second account system. The comment your reader leaves on a blog post is an ordinary forum post: it is spam-scored, moderated, searchable, notified on, and continuable in the forum.

## Setup

### 1. Create a category to hold article threads

In **Admin → Forum → Structure**, add a category (something like *Blog* or *Article Comments*) and note its **id**. You will need the numeric id, not the slug.

### 2. Enable comments

```yaml
comments:
  enabled: true
  category: 17          # forum category that holds article threads
  templates: [item]     # page templates that accept comments
  author: ''            # member who authors seed topics ('' = neutral System account)
  max_inline: 20        # comments shown under the article before "view all"
  excerpt_length: 300   # characters of article excerpt in the seed post
```

`templates` is the list of Grav page templates that accept comments. For a standard blog it is usually `[item]`; check what your theme names its post template.

`author` is the forum username credited with the seed topic. Leave it empty and Forum Pro uses a neutral **System** account, which is usually what you want so that the seed post does not look like a real person wrote a stub.

### 3. Render the block in your template

Add this where you want comments to appear in your article template:

```twig
{% if (config.plugins['forum-pro'].enabled ?? false) and (config.plugins['forum-pro'].comments.enabled ?? false) %}
  {{ forum_comments(page) }}
{% endif %}
```

The guard means the template keeps working if the plugin is disabled or removed, which matters if you share the theme.

## How the thread is created

The **first comment opens the forum topic automatically**. The seed post contains the article excerpt (`excerpt_length` characters) and a link back to the page, so someone who finds the thread in the forum has context and a way to reach the original.

Nothing is created until someone actually comments, so enabling this on a blog with 400 posts does not create 400 empty topics.

## Per-page control

`templates` sets the default. Individual pages opt in or out in their frontmatter, which overrides the template list:

```yaml
---
title: My Post
forum:
  comments: true    # or false to switch them off for this page
---
```

Use `false` on a page like a legal notice or a changelog where you do not want a discussion, and `true` on a one-off page whose template is not in the list.

## Comment counts on listings

`forum_comments_count(page)` returns the number of comments on a page, for "12 comments" links in your blog listing:

```twig
{% set count = forum_comments_count(page) %}
{% if count %}
  <a href="{{ page.url }}#forum-comments">{{ count }} comment{{ count == 1 ? '' : 's' }}</a>
{% endif %}
```

## What comes with it

Because comments are forum posts, everything that applies to the forum applies here:

- **Spam scoring** and **premoderation** on the holding category
- The **review queue**, both on the forum and in the admin
- **Search**, so comments are findable alongside forum content
- **Notifications**, so a member who comments is watching the thread
- **Reputation and reactions**
- **Moderation actions**, including hide, delete, restore and ban

And because the thread is a real topic, the conversation can outgrow the article. A reader who leaves a two-line comment and gets three replies ends up in a genuine discussion, in your forum, under your moderation.

## One account for everything

A member who registered on the forum can comment immediately. A reader who registers to leave a comment gets a full forum account. There is no separate comment identity to reconcile later.

## Migrating from a comment plugin

There is no automated importer from other Grav comment plugins today. If you are switching, the practical approach is to leave the old comments rendering on historical posts and enable Forum Pro comments for new ones, then retire the old plugin once the archive stops attracting replies.
