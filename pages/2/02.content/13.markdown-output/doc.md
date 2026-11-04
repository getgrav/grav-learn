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

The output is **the rendered page converted back to Markdown**, not the raw `.md` file on disk. Grav renders the page through the theme exactly as it would for a browser, keeps the main content region of the result, and converts that. So a blog listing, a shop, a product page or anything else whose content the template builds reads the way it displays, and nothing has to change in the theme or the plugin that renders it. Shortcodes, Twig in content, modules and resolved image and link paths all come through. The source file would hand an agent unexpanded shortcodes, relative image paths that only resolve against the page folder, and page-relative links that go nowhere.

A document has three parts:

1. **A YAML block** with the title, canonical URL, the page's own `.md` URL, language, date, description and taxonomy. The description is the page's `metadata.description` when it has one, else its summary.
2. **The body**: the main content region of the rendered page. A `# Title` heading is added only when the theme did not print one.
3. **A navigation section** linking the parent, the previous and next pages in the parent's listing, and the page's children, each by its `.md` URL. An agent can walk a whole site without ever leaving Markdown.

### How the main region is found

Grav takes the first of these that the rendered page has: `<main>`, an element with `role="main"`, then the ids `main`, `content`, `main-content`, `body-wrapper`, `body` and `start`, then a lone `<article>`. Failing all of those it takes `<body>` without its own header and footer. Inside the region, `<nav>`, `<aside>`, anything with a navigation, banner, search, dialog or complementary role, and anything hidden are dropped. Quark, Quark 2 and Kahuna all wrap content in `<main>`, and most themes do; a theme that does not can get a clean result by adding a `<main>` around its content column.

Two things are tidied on the way. A card that is one link around an image, heading and text has no Markdown form, so its blocks are lifted out and the link is left after them holding the card's title. HTML5 sectioning elements the converter does not know (`header`, `section`, `figure` and the rest) are kept as blocks so their text does not run into the next line.

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

The home page is `/index.md`. Every web server treats a path segment that starts with a dot as a hidden file, so `/.md` would be refused before Grav saw it, and `index.<ext>` is what static site generators use for the same job. Grav 2.1 answers `/index.<ext>` for any page format, `/index.rss` and `/index.json` included, unless a root page is really named `index`.

A template never has to special-case the home page to build such a link. `page.url()` takes an output format as its fifth argument and does the `index` substitution itself:

```twig
{{ page.url(false, false, true, false, 'md') }}   {# /blog/post.md, or /index.md on the home page #}
{{ page.url(true, false, true, false, 'rss') }}   {# https://example.com/index.rss on the home page #}
```

`markdown_url(page)` is the same call with `md` and the host included.

## Response headers

| Header | Value |
| :----- | :---- |
| `Content-Type` | `text/markdown; charset=utf-8` |
| `X-Markdown-Tokens` | An estimated token count, the same header Cloudflare's Markdown for Agents sends |
| `Vary: Accept` | Sent on every URL without an extension while the feature is on, HTML included, so a shared cache never hands an agent the HTML or a browser the Markdown. The `.md` URL is its own resource and needs no such hint |
| `Link: <https://example.com/page.md>; rel="alternate"; type="text/markdown"` | Sent with the HTML version of a page, so a client can find the Markdown without guessing the URL |

HTML pages also carry a `<link rel="alternate" type="text/markdown">` tag in `<head>` when the theme uses Grav's [core metadata partial](/2/themes/core-templates).

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

A rendered page is request-aware: it can show a login state, a cart, a form nonce. Grav never caches it as HTML, and it does not cache its Markdown either. A `.md` request costs what the HTML request costs plus the conversion, which is a DOM parse of the page. The page content inside it is cached by Grav as usual.

## Web server configuration

A page route ending in `.md` has to reach `index.php`. The Apache and lighttpd configs shipped before 2.1 forbade **every** URL ending in `.md`, source file or not, so on those servers the rule has to be narrowed to real files. Grav does this for you on upgrade when your `.htaccess` still has the stock line; a hand-edited `.htaccess` is left alone and needs the change by hand:

```apache
# Block all direct access to .md files (a page route ending in .md is not a file, so Grav's Markdown output still works):
RewriteCond %{REQUEST_FILENAME} -f
RewriteRule \.md$ error [F,NC]
```

For lighttpd, remove `".md"` from the `url.access-deny` list. lighttpd 1.4 has no condition on whether a file exists, so the shipped `lighttpd.conf` (Grav 2.2.19 and later) hands every URL ending in `.md` to Grav before its deny rules run. Page routes get their Markdown, and Markdown source files such as `README.md` are never served as files:

```lighttpd
url.rewrite-once = (
    "(?i)^/[^?]*\.md(\?|$)" => "/index.php${qsa}"
)
url.access-deny += ("~",".inc")
```

Source files under `user/pages` are never served either way. From Grav 2.2.19 the shipped nginx, Caddy and IIS configs also refuse `.md` files that exist on disk (`README.md`, `CHANGELOG.md`) while page routes ending in `.md` still reach Grav. Earlier versions of those configs only blocked `.md` files under `user/`, `system/` and `vendor/`, so they need no change for Markdown output to work.

If a `.md` URL returns **403** on an Apache site after upgrading, this rule is the reason.

## llms.txt

The [Sitemap plugin](https://github.com/getgrav/grav-plugin-sitemap) 5.3 and later adds the index that goes with per-page Markdown, following the [llms.txt convention](https://llmstxt.org) that AI agents look for. Two files are served from the site root:

| File | Default | Contains |
| :--- | :------ | :------- |
| `/llms.txt` | On | Every page in the sitemap as a Markdown link to its `.md` URL, grouped by section, with each page's description |
| `/llms-full.txt` | Off | Every page's whole Markdown document, joined into one file |

Nothing has to be written or generated by hand: both are built from the site's pages on request, so they are always current.

> [!NOTE]
> The links point at the pages' `.md` URLs, so llms.txt needs Grav 2.1 or later with Markdown output enabled. On Grav 2.0 the plugin still answers `/llms.txt`, but with no Markdown output to link to it lists no pages.

### What llms.txt contains

The file starts with the site's title (`site.title`) as a heading and the site's `metadata.description` from `site.yaml` as a quote. Then come the pages:

- **Pages** lists the home page first, then every top-level page.
- Every top-level page with children gets a section of its own, headed with its title, listing everything below it at any depth.
- Each entry is a link to the page's `.md` URL, followed by the page's own `metadata.description` when it has one. A page without a description is listed by its title alone, so a short description in each page's frontmatter makes the index much more useful to an agent.

```markdown
# My Site

> A short description of the site, from site.yaml

## Pages

- [Home](https://example.com/index.md)
- [About](https://example.com/about.md): Who we are and what we do
- [Blog](https://example.com/blog.md): News and release announcements

## Blog

- [My Post](https://example.com/blog/my-post.md): What the post is about
- [An Older Post](https://example.com/blog/older-post.md)
```

### What llms-full.txt contains

`/llms-full.txt` is every page's Markdown document, exactly as its `.md` URL returns it (frontmatter, body and navigation section), joined in the same order as `llms.txt`. An agent can load the whole site in one request instead of following every link.

The file is built on the first request and cached. Changing a page or the plugin's configuration rebuilds it. Only the version built for an anonymous visitor is cached: a request from a logged-in user is built fresh and not stored, because a rendered page can carry that user's state.

> [!WARNING]
> Every page is rendered through the theme to build `llms-full.txt`, and the result holds all of them. On a site with thousands of pages that is a slow first request and a very large file, which is why it is off by default.

### Which pages are listed

Both files list the same pages as the XML sitemap, so the sitemap's rules decide what agents see:

- Only published, routable pages.
- Pages matching a pattern in the plugin's `ignores` list are left out.
- A page with `sitemap: ignore: true` in its frontmatter is left out.
- With `ignore_protected` on (the default), pages with an `access` rule are left out.
- With `ignore_redirect` and `ignore_external` on (the defaults), pages with a `redirect` or `external_url` are left out.
- URLs added to the sitemap by hand (`additions`) are not listed, since they have no Markdown version.

On a multi-language site each language has its own files: `/llms.txt` lists the pages of the default language, and `/fr/llms.txt` lists the French pages with French titles and `/fr/…` links.

### Configuration

Both files are switched in the Sitemap plugin's settings, in the Admin under **Plugins → Sitemap → Markdown for AI Agents**, or in `user/config/plugins/sitemap.yaml`:

```yaml
llms_txt: true         # Serve /llms.txt
llms_full_txt: false   # Serve /llms-full.txt
```

A file that is switched off returns a 404. The paths are fixed at the site root and do not follow the sitemap's own `route` setting. Both are served as `text/markdown` with the same `X-Markdown-Tokens` header as a page's Markdown version.

### Customizing the output

Each file is rendered by a Twig template in the plugin, `llms.txt.twig` and `llms-full.txt.twig`. To change one, copy it from `user/plugins/sitemap/templates/` into your theme's `templates/` folder and edit the copy; the theme's version is used in its place.

`llms.txt.twig` is handed `llms_sections`, a list of sections, each with a `title` and its `entries`. Every entry has a `title`, its `markdown` URL, its `description`, the page's canonical URL as `location`, its `route`, `lang` and `lastmod`, and `home`, which is true for the home page. The shipped template:

```twig
{%- autoescape false -%}
# {{ site.title }}
{% if site.metadata.description %}

> {{ site.metadata.description|replace({"\n": ' '}) }}
{% endif %}
{% for section in llms_sections %}

## {{ section.title }}

{% for entry in section.entries %}
- [{{ entry.title ?: 'PLUGIN_SITEMAP.UNTITLED'|t }}]({{ entry.markdown }}){% if entry.description %}: {{ entry.description }}{% endif %}

{% endfor %}
{%- endfor %}
{%- endautoescape -%}
```

A theme override is the place to add an `## Optional` section of links the convention allows for, or a paragraph of instructions for agents under the title. `llms-full.txt.twig` is handed the joined document as `llms_full`. To change what each page contributes to it, change the page's [Markdown template](#custom-markdown-templates) instead, so the page's `.md` URL and `llms-full.txt` stay the same.

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
| `markdown_body(page)` | The main content region of the rendered page, with a title added when the theme printed none |
| `markdown_links(page)` | The navigation section |
| `markdown_url(page)` | The page's absolute `.md` URL |
| `html|html_to_markdown` | Any rendered HTML converted to Markdown |

Every helper defaults to the current page when called without one. Unlike other formats, a `.md` request never falls back to the theme's HTML template when no Markdown template matches: a client that asked for Markdown must not be handed HTML, so core's `default.md.twig` is the fallback instead.

Modules never get a Markdown template of their own. They keep rendering through their normal HTML module template, and the parent's document converts that output, so a theme's `modular/hero.html.twig` decides what the agent reads without needing a Markdown twin.
