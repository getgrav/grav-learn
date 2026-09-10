---
title: Markdown for AI Agents
description: Serve any Grav page as Markdown for AI agents and other text clients
page-toc:
  active: true
taxonomy:
    category: docs
---
# Markdown for AI Agents

> [!NOTE]
> Markdown output is new in **Grav 2.1**.

Every routable page on a Grav 2.1 site can be read as Markdown. Add `.md` to the page's URL, or send an `Accept: text/markdown` request header, and Grav answers with the page as Markdown instead of the theme's HTML:

```bash
curl https://example.com/blog/my-post.md
curl -H 'Accept: text/markdown' https://example.com/blog/my-post
```

The feature exists for AI agents, coding assistants and any other client that would rather read text than parse a themed HTML page. It is on by default and needs nothing from the theme.

## What the Markdown contains

The output is **the rendered page converted back to Markdown**, not the raw `.md` file on disk. Shortcodes, Twig in content, resolved image and link paths and, on a modular page, every module all come through the way a browser sees them, so an agent reads what a human reads. The source file would hand it unexpanded shortcodes, relative image paths that only resolve against the page folder, and page-relative links that go nowhere.

A document has three parts:

1. **A YAML block** with the title, canonical URL, the page's own `.md` URL, language, date, description and taxonomy. The description is the page's `metadata.description` when it has one, else its summary.
2. **The body**: a `# Title` heading, the page content, then each module of a modular page under its own `## Title`, in the order the page lists them.
3. **A navigation section** linking the parent, the previous and next pages in the parent's listing, and the page's children, each by its `.md` URL. An agent can walk a whole site without ever leaving Markdown.

```markdown
---
title: 'My Post'
url: 'https://example.com/blog/my-post'
markdown: 'https://example.com/blog/my-post.md'
lang: en
date: '2026-09-10'
description: 'What the post is about'
taxonomy:
  tag:
    - grav
---

# My Post

The post content, converted from the rendered HTML.

---

## Navigation

- Parent: [Blog](https://example.com/blog.md)
- Previous: [An Older Post](https://example.com/blog/older-post.md)
- Next: [A Newer Post](https://example.com/blog/newer-post.md)
```

Forms, scripts, styles, inline SVG and other markup with no Markdown equivalent are dropped. Root-relative links and images are turned into absolute URLs so they still work once the document has left the site. Tables and fenced code blocks with their language survive the conversion.

The home page is linked as `/home.md` (its real route) rather than `/.md`, because every web server config Grav ships refuses a path segment that starts with a dot.

## Response headers

| Header | Value |
| :----- | :---- |
| `Content-Type` | `text/markdown; charset=utf-8` |
| `X-Markdown-Tokens` | An estimated token count, the same header Cloudflare's Markdown for Agents sends |
| `Vary: Accept` | Sent on every URL without an extension while the feature is on, HTML included, so a shared cache never hands an agent the HTML or a browser the Markdown. The `.md` URL is its own resource and needs no such hint |
| `Link: <https://example.com/page.md>; rel="alternate"; type="text/markdown"` | Sent with the HTML version of a page, so a client can find the Markdown without guessing the URL |

HTML pages also carry a `<link rel="alternate" type="text/markdown">` tag in `<head>` when the theme uses Grav's [core metadata partial](/20/themes/core-templates).

A redirect answered to a `.md` request keeps the extension, so a section URL that forwards to its first child lands on that child's Markdown.

## Configuration

The settings live under `pages.markdown_output` in `system.yaml`, and in the Admin under **Configuration → System → Content → Markdown Output**:

```yaml
pages:
  markdown_output:
    enabled: true          # Answer `<route>.md` URLs and `Accept: text/markdown` requests with Markdown
    frontmatter: true      # Start with the YAML block
    links: true            # End with the navigation section
    max_links: 100         # Most child pages listed there (0 for no limit)
    absolute_urls: true    # Turn root-relative links and images into absolute URLs
    token_header: true     # Send the `X-Markdown-Tokens` header
```

Turning `enabled` off removes `.md` from the page types Grav answers, the `Accept` negotiation, and the `Link` and `Vary` headers together.

## Caching

The conversion is cached per page under the same rules as the page content itself: the site cache must be on, the page must not set `cache_enable: false`, and a page whose content Twig runs on every request (`never_cache_twig`, or content Twig on a non-modular page) is converted on every request too, so one visitor's render is never served to the next.

## Web server configuration

A page route ending in `.md` has to reach `index.php`. The Apache and lighttpd configs shipped before 2.1 forbade **every** URL ending in `.md`, source file or not, so on those servers the rule has to be narrowed to real files. Grav does this for you on upgrade when your `.htaccess` still has the stock line; a hand-edited `.htaccess` is left alone and needs the change by hand:

```apache
# Block all direct access to .md files (a page route ending in .md is not a file, so Grav's Markdown output still works):
RewriteCond %{REQUEST_FILENAME} -f
RewriteRule \.md$ error [F,NC]
```

For lighttpd, remove `".md"` from the `url.access-deny` list and deny it only as a real file:

```lighttpd
url.access-deny += ("~",".inc")
$PHYSICAL["existing-path"] =~ "(?i)\.md$" {
    url.access-deny = ("")
}
```

Source files under `user/pages` stay blocked either way by the `user/` rule that precedes it. The nginx, Caddy and IIS configs only ever blocked `.md` files under `user/`, `system/` and `vendor/`, so they need no change.

If a `.md` URL returns **403** on an Apache site after upgrading, this rule is the reason.

## llms.txt

The [Sitemap plugin](https://github.com/getgrav/grav-plugin-sitemap) 5.3 adds the index that goes with per-page Markdown: `/llms.txt` lists every page in the sitemap as a Markdown link with its description, grouped by section, following the [llms.txt convention](https://llmstxt.org) agents look for. An optional `/llms-full.txt` joins every page's Markdown into one document. Both respect the sitemap's ignore rules.

## Custom Markdown templates

The Markdown document is rendered by a Twig template like any other page format, so a theme can take it over. Grav ships `default.md.twig`, which is a single call:

```twig
{%- autoescape false -%}
{{ markdown_output(page) }}
{%- endautoescape -%}
```

A theme provides its own `default.md.twig`, or a `<template>.md.twig` for one page type (`blog.md.twig`, `item.md.twig`), and assembles the document from the pieces:

| Twig helper | Returns |
| :---------- | :------ |
| `markdown_output(page)` | The whole document |
| `markdown_frontmatter(page)` | The YAML block |
| `markdown_body(page)` | Title, content and modules |
| `markdown_links(page)` | The navigation section |
| `markdown_url(page)` | The page's absolute `.md` URL |
| `html|html_to_markdown` | Any rendered HTML converted to Markdown |

Every helper defaults to the current page when called without one. Unlike other formats, a `.md` request never falls back to the theme's HTML template when no Markdown template matches: a client that asked for Markdown must not be handed HTML, so core's `default.md.twig` is the fallback instead.

Modules are left out of this override on purpose. They keep rendering through their normal HTML module template, and the parent's document converts that output, so a theme's `modular/hero.html.twig` decides what the agent reads without needing a Markdown twin.
