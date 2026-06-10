---
title: YetiSearch Pro
description: Install, configure, and use YetiSearch Pro for powerful local search
taxonomy:
    category: docs
---

# YetiSearch Pro

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

Install YetiSearch Pro via GPM:

```
$ bin/gpm install yetisearch-pro
```

You can also install the plugin via the **Plugins** section in the admin plugin.

After installation, run your first index to populate the search database:

```
$ bin/plugin yetisearch-pro index --flush
```

## Requirements

* **PHP 7.4** or higher
* **SQLite 3.24.0** or higher (3.35.0+ recommended for best performance)
* **SQLite FTS5** extension enabled — YetiSearch uses FTS5 virtual tables for full-text search and BM25 ranking. Your PHP build must link against a SQLite library compiled with FTS5 (`ENABLE_FTS5`).
* **PDO SQLite** PHP extension
* **Mbstring** PHP extension
* **JSON** PHP extension

You can verify your SQLite version and FTS5 support by running the built-in check script from your Grav root:

```
$ php user/plugins/yetisearch-pro/vendor/yetisearch/yetisearch/scripts/check_sqlite_features.php
```

Or check your SQLite version directly:

```
$ php -r "echo 'SQLite: ' . \SQLite3::version()['versionString'] . PHP_EOL;"
```

On macOS, Homebrew PHP typically includes a recent SQLite with FTS5. Some Linux distributions and shared hosting environments may ship older SQLite versions — see [Troubleshooting](#troubleshooting) below.

## Features

- **100% Local Search** - File-backed search with zero external dependencies
- **Two Modal Designs** - Choose between "simple" (lightweight typeahead) or "full" (two-panel with preview)
- **Vanilla JS** - No framework dependencies, works with any theme
- **CSS Variables** - Easy theming with CSS custom properties
- **Smart Indexing** - Fingerprint-based change detection for efficient updates
- **Orphan Cleanup** - Automatically removes stale documents from deleted pages
- **Real-time Updates** - Index updates on page save/delete (optional)
- **Multi-language** - Per-language or single-index strategies
- **Fuzzy Search** - Configurable typo tolerance
- **Chunked Indexing** - Precise search results within long content
- **Analytics** - Track searches, clicks, and popular terms
- **Geospatial Search** - Location-based queries with radius and bounding box filters
- **Permissions** - Granular admin permissions (view, modify, admin)
- **Scheduler** - Automated reindex and maintenance via Grav scheduler
- **CLI Commands** - Full command-line interface for indexing, querying, and maintenance

## Configuration

YetiSearch Pro is configured via `user/plugins/yetisearch-pro/yetisearch-pro.yaml` or through the Admin plugin interface.

### Basic Configuration

```yaml
enabled: true

engine:
  storage_dir: 'user://data/yetisearch-pro'
  index_prefix: 'grav_'
  timeout: 5
  max_batch_size: 10
  search:
    snippet_length: 75   # default snippet window length

indexes:
  pages:
    strategy: single  # or 'per_language'
    languages: []           # empty: derive from Grav languages/versions
    fields: [title, url, taxonomy.*, meta.description, content]
    facets: [taxonomy.category, taxonomy.tag]
    geo_fields: []
    options:
      fuzzy: true
      typo_tolerance: 2
```

### Index Strategies

YetiSearch Pro supports two index strategies:

* **`single`** (default) - One database for all languages. Language is stored in each document.
  * File: `user/data/yetisearch-pro/<prefix><index>.db` (e.g., `grav_pages.db`)
  * Query with `--index pages --lang fr` to leverage language-aware processing.

* **`per_language`** - One database file per language/version.
  * File: `user/data/yetisearch-pro/<prefix><index>_<lang>.db` (e.g., `grav_pages_17.db`)
  * Query with `--index pages_17` or `--index pages --lang 17`.

### Query Defaults & Field Boosting

Configure default search fields and boost weights per index:

```yaml
indexes:
  pages:
    query_defaults:
      per_page: 10
      fields: [title, headers_h1, headers_h2, headers_h3, headers, content, excerpt, tags]
      boost:
        title: 5.0
        headers_h1: 4.0
        headers_h2: 3.0
        headers_h3: 2.0
        headers: 1.5
        tags: 2.5
        excerpt: 2.0
        content: 1.0
      rerank:
        title_exact: 10.0    # bonus for exact word match in title
        title_prefix: 8.0    # bonus for prefix/starts-with title match
        title_word: 5.0      # bonus for word match in title
        headers_exact: 7.0   # bonus for exact word match in headers
        headers_prefix: 6.0  # bonus for prefix match in headers
        headers_word: 3.0    # bonus for word match in headers
        chunk: 1.0           # slight preference for chunk hits
        fuzzy_factor: 1.2    # scale rerank bonuses when fuzzy is enabled
        demote_prefixes: ['/api']
        demote_penalty: 10.0
```

The `rerank` settings allow client-side re-ranking after engine scoring, giving you fine control over result ordering.

### Environment Modes

The plugin supports environment-aware configuration to prevent index collisions:

```yaml
environment:
  mode: auto          # auto | production | staging | development
  append_environment_to_index: true   # suffix index prefix with environment name
  realtime_in_development: true       # enable realtime indexing in dev mode
```

When `mode` is `auto`, the plugin follows Grav's environment detection. The `append_environment_to_index` option prevents staging/development indexes from colliding with production.

## Modal Configuration

YetiSearch Pro includes two modal designs that themes can use.

### Modal Types

* **`full`** (default) - Two-panel modal with results on the left and a live preview on the right. Includes pagination, filter controls, breadcrumbs, and On This Page sections. Best for documentation sites with longer content.

* **`simple`** - Lightweight typeahead modal with grouped results. Single panel, no preview. Best for general sites that want a clean, fast search experience.

### Configuration

```yaml
modal:
  type: full      # 'full' or 'simple'
  branding: true  # Show "Powered by YetiSearch" in footer
```

## Theme Integration

### Adding the Search Modal

Include the modal in your theme's base template:

```twig
{# In your theme's partials/base.html.twig or similar #}
{% if config.plugins['yetisearch-pro'].enabled %}
    {% include 'partials/yetisearch-pro/modal.html.twig' %}
{% endif %}
```

The modal automatically selects the correct type based on your configuration. To include a specific modal directly:

```twig
{% include 'partials/yetisearch-pro/modal-simple.html.twig' %}
{# or #}
{% include 'partials/yetisearch-pro/modal-full.html.twig' %}
```

### Search Trigger Button

Include a ready-made search button:

```twig
{% include 'partials/yetisearch-pro/search-trigger.html.twig' %}

{# With custom options #}
{% include 'partials/yetisearch-pro/search-trigger.html.twig' with {
    placeholder: 'Search docs...',
    show_shortcut: true,
    class: 'my-custom-class'
} %}
```

### Opening the Modal Programmatically

Add `data-ys-open` to any element to make it open the search modal:

```html
<button data-ys-open>Search</button>
<input type="text" data-ys-open placeholder="Search...">
```

Keyboard shortcuts: `Cmd/Ctrl+K` or `/` (when not in a text field).

### Customizing with CSS Variables

Both modals use CSS variables for easy theming:

```css
/* Simple modal variables */
:root {
  --ys-simple-dialog-bg: #ffffff;
  --ys-simple-text: #111827;
  --ys-simple-accent: #3b82f6;
  --ys-simple-highlight-bg: #fef08a;
}

/* Full modal variables */
:root {
  --ys-panel-bg: #181a1f;
  --ys-text: #d3d7df;
  --ys-accent: #4ea1ff;
}
```

### Twig Variables

The plugin exposes the modal type to Twig:

```twig
{{ yetisearch_modal_type }} {# 'full' or 'simple' #}
```

### Customizing Modal Templates

Both modals use a **base template + extends** pattern that lets themes override specific parts without reimplementing the entire modal.

#### Template Inheritance

```
Plugin:  partials/yetisearch-pro/base/modal-simple.html.twig   ← canonical ({% block %} tags)
Plugin:  partials/yetisearch-pro/modal-simple.html.twig         ← thin {% extends %} wrapper
Theme:   partials/yetisearch-pro/modal-simple.html.twig         ← theme override (extends base)
```

The theme's file shadows the plugin's wrapper via Grav's template resolution. The `{% extends %}` path points to `base/...` which only lives in the plugin, so there's no circular lookup.

The same pattern applies to `modal-full.html.twig`.

#### Available Blocks – Simple Modal

| Block | Description |
|-------|-------------|
| `modal` | Entire modal container |
| `modal_data_attrs` | Empty slot for extra `data-*` attributes on the root `<div>` |
| `backdrop` | Backdrop overlay |
| `search_input` | Input wrapper (icon + input + ESC badge) |
| `results` | Full results section |
| `results_header` | Results count header |
| `loading` | Loading spinner |
| `empty` | Empty state message |
| `type_more` | "Type more characters" prompt |
| `results_list` | Grouped results container |
| `footer` | Footer section |
| `keyboard_hints` | Keyboard shortcut hints |
| `branding` | "Powered by YetiSearch" link |

#### Available Blocks – Full Modal

| Block | Description |
|-------|-------------|
| `config_script` | Inline `<script>` for endpoint/theme detection |
| `modal` | Entire modal container |
| `modal_data_attrs` | Empty slot for extra `data-*` attributes on the root `<div>` |
| `backdrop` | Backdrop overlay |
| `search_input` | Input row (icon + input + filters + cancel button) |
| `body` | Body container (left + right panels) |
| `results_panel` | Left panel (meta + list + pagination) |
| `preview_panel` | Right panel (breadcrumbs + title + excerpt) |
| `item_template` | `<template>` element for result item cloning |

#### Example: Theme Override

A minimal theme override that injects a custom data attribute:

```twig
{# themes/my-theme/templates/partials/yetisearch-pro/modal-full.html.twig #}
{% extends 'partials/yetisearch-pro/base/modal-full.html.twig' %}

{% block modal_data_attrs %}
data-ys-extra-params="filter[version][eqor]={{ some_version|url_encode }}"
{% endblock %}
```

This passes extra query parameters to the search endpoint without touching any other part of the modal.

#### Extra Query Parameters (`data-ys-extra-params`)

Add a `data-ys-extra-params` attribute to the modal's root element to append arbitrary parameters to every search request. The value is appended as-is to the fetch URL:

```html
<!-- Rendered output -->
<div id="ys-modal" data-ys-extra-params="filter[version][eqor]=17">
```

The plugin's JS reads this attribute at init and appends it to every search URL:

```
/ys?q=twig&page=1&type=content&ajax=1&filter[version][eqor]=17
```

The `modal_data_attrs` block is the recommended way to set this from Twig.

#### Example: Replacing the Preview Panel

```twig
{% extends 'partials/yetisearch-pro/base/modal-full.html.twig' %}

{% block preview_panel %}
<div class="ys-right custom-preview">
    {# Your custom preview layout #}
</div>
{% endblock %}
```

#### Example: Adding Content After Results

```twig
{% extends 'partials/yetisearch-pro/base/modal-simple.html.twig' %}

{% block footer %}
    <div class="my-custom-footer">
        Custom footer content
    </div>
    {{ parent() }}
{% endblock %}
```

Use `{{ parent() }}` to include the original block content alongside your additions.

## Page-Level Controls

### Frontmatter Options

Control indexing per-page via frontmatter:

```yaml
yetisearch:
  index-page: false      # Exclude this page from the index
  ignore: true           # Same as index-page: false
  index-children: false  # Exclude child pages from the index
```

### Ignore Shortcode

Exclude specific content blocks from indexing while keeping them visible on the page:

```markdown
[yetisearch=ignore]
This content will be visible but not indexed for search.
[/yetisearch]
```

## Default Document Fields

Each indexed document contains:

* **Content fields**: `title`, `content`, `excerpt`, `url`, `route`, taxonomy-derived `tags`, `category`
* **Metadata**: `taxonomy`, `meta`, `breadcrumbs`, `date`, `updated_at`
* **Language**: `language` (set per-page for single-index strategy)
* **Stable ID**: `<lang>:<route>`

## Admin Dashboard

YetiSearch Pro includes a full admin dashboard accessible from the sidebar in the Admin plugin.

### Index Dashboard

Monitor index health and trigger maintenance actions:

* View total documents, index sizes, and last updated timestamps
* Reindex all content with progress tracking
* Clear and reset indexes

### Search Analytics

Track search engagement and performance:

* Total and unique queries
* Result clicks and zero-result searches
* Average response time
* Popular searches and top clicked results
* Frequent zero-result queries (to identify content gaps)

### Index Browser

Inspect and manage indexed documents:

* Browse all documents with pagination
* Search within the index
* View individual document details with full JSON
* Edit document data directly
* Debug index statistics and frequent terms
* Optimize indexes

### Permissions

YetiSearch Pro registers granular admin permissions:

* `yetisearch-pro.view` - View search dashboard and statistics
* `yetisearch-pro.modify` - Trigger reindex and manage indexes
* `yetisearch-pro.admin` - Full access including configuration changes

## CLI Commands

All commands are run from the Grav site root.

### Index Command

```bash
bin/plugin yetisearch-pro index [options]

Options:
  -x, --index=INDEX       Index key (e.g., pages) [default: pages]
  -l, --lang=LANG         Language/Version (e.g., 17)
  -f, --flush             Drop and recreate the target index before indexing
  -q, --quiet             Minimal output
  -r, --raw               Raw JSON status
```

Examples:

```bash
# Full rebuild for one language
bin/plugin yetisearch-pro index --index pages --lang 17 --flush

# Full rebuild for all languages (per_language)
bin/plugin yetisearch-pro index --index pages --flush

# Index a specific suffixed index
bin/plugin yetisearch-pro index --index pages_17 --flush
```

### Query Command

```bash
bin/plugin yetisearch-pro query QUERY [options]

Core:
  -x,  --index=INDEX             Index key or suffixed key
  -l,  --lang=LANG               Language/Version
  -p,  --page=PAGE               Page number (default: 1)
       --per-page=N              Results per page (default: 10)
       --compact                 Compact output
  -r,  --raw                     Raw JSON output

Search behavior:
       --fuzzy                   Enable fuzzy search
       --fuzziness=F             Fuzziness score (0..1, default: 0.8)
       --fields=LIST             Comma-separated fields to search
  -s,  --sort=SPEC               Sort spec, e.g. "title:asc,updated_at:desc"
  -F,  --filter=EXPR             Filter: field[op]value (op: =,!=,>,>=,<,<=)
       --no-highlight            Disable highlight markup
       --highlight-length=N      Snippet window length (default: 75)
  -d,  --distinct[=BOOL]         Distinct per route (default: true)
       --suggestions             Show suggestions after results
       --suggestions-limit=N     Suggestion count (default: 10)
```

Examples:

```bash
# Fuzzy search in a per-language index
bin/plugin yetisearch-pro query "install theme" --index pages_17 --fuzzy

# Search with language in single-index strategy
bin/plugin yetisearch-pro query "installer" --index pages --lang fr

# With filters and sort
bin/plugin yetisearch-pro query "config" -x pages_17 -F "taxonomy.category=plugins" -s "title:asc"
```

### Schedule Command

```bash
bin/plugin yetisearch-pro schedule [options]

Options:
  -l, --list              Display configured schedule summary
  -t, --task=TASK         Task to run: reindex, maintenance, or all (default: all)
  -f, --force             Run even if the task is disabled
```

### Cache Command

```bash
bin/plugin yetisearch-pro cache [ACTION] [options]

Actions:
  stats                   Display cache statistics (default)
  monitor                 Monitor cache activity in real-time
  purge                   Clear all cache entries
  warm                    Pre-populate cache with common queries

Options:
  -i, --index=INDEX       Index name (auto-detected if omitted)
  -d, --details           Show detailed cache entries
```

## Query Endpoint & Filters

The JSON query endpoint (`query_route`, default `/ys`) is handled during `onPluginsInitialized` when the request explicitly asks for JSON (Accept: application/json, `?ajax=1`, or `.json`). This short-circuits page initialization for fast typeahead and API responses.

### Filter DSL

Pass filters via the `filter` query parameter using the syntax `field[op]value`:

```
/ys?q=search+terms&filter=taxonomy.category[=]plugins&filter=version[=?]v3
```

Supported operators: `=`, `!=`, `>`, `>=`, `<`, `<=`, `=?` (match value OR null).

### Suggestions Endpoint

A lightweight suggestions endpoint is available at `<query_route>/suggest` (e.g., `/ys/suggest`):

* Parameters: `term` or `q` (input string), `limit` (default: 10)
* Returns JSON array of `{ text, score, count }` with minimal Grav overhead

## Events (Extensibility)

These Grav events allow custom indexing and document shaping:

* **`onYetisearchCollectObjects(index, lang, &documents)`** - Add or modify non-page documents to index
* **`onYetisearchBuildDocument(subject, lang, index, &doc)`** - Shape fields per document (e.g., add custom frontmatter fields, facets, geo data)
* **`onYetisearchProBeforeSearch(query, lang, &filters, &options)`** - Add custom filters or modify search options before a query is executed
* **`onYetisearchPageSkip(page, index, lang)`** - Decide whether to skip a page during indexing

### Example: Adding Custom Fields

```php
public function onYetisearchBuildDocument(Event $event)
{
    $page = $event['subject'];
    $doc = &$event['doc'];

    // Add a custom field from page headers
    $doc['author'] = $page->header()->author ?? '';
}
```

### Example: Indexing FlexObjects

```php
public function onYetisearchCollectObjects(Event $event)
{
    $documents = &$event['documents'];

    // Add FlexObjects or other custom content
    $flex = $this->grav['flex'];
    $collection = $flex->getCollection('my-objects');

    foreach ($collection as $object) {
        $documents[] = [
            'id' => 'flex:' . $object->getKey(),
            'title' => $object->getProperty('title'),
            'content' => $object->getProperty('description'),
            'url' => $object->url(),
        ];
    }
}
```

## Helios Theme Integration

YetiSearch Pro and the Helios documentation theme are designed to work together. Helios includes built-in YetiSearch Pro support with the `Cmd+K` / `Ctrl+K` keyboard shortcut pre-configured.

To enable YetiSearch Pro in Helios, set the search provider in your Helios configuration:

```yaml
# user/config/themes/helios.yaml
search:
  provider: yetisearch
```

## Tips & Best Practices

### Indexing

* Run `--flush` for the first index or after major content restructuring
* Use the Grav Scheduler for automated reindexing on production sites
* Enable real-time updates for sites where content changes frequently in Admin

### Search Tuning

* Adjust `boost` weights to prioritize title and header matches over body content
* Use `rerank.demote_prefixes` to push less relevant sections (like API references) lower in results
* Enable fuzzy search for better typo tolerance, but tune `typo_tolerance` to avoid too many false positives

### Performance

* The `single` index strategy is simpler and works well for most sites
* Use `per_language` strategy for large multi-language sites where index size matters
* Configure `max_batch_size` based on your server's memory constraints
* Use the cache warm command to pre-populate frequently searched terms

## Troubleshooting

### `General error: 1 near "RETURNING": syntax error`

This error means your SQLite version is older than **3.35.0**. The `RETURNING` clause was introduced in SQLite 3.35.0 (March 2021). **Update to YetiSearch Pro 1.1.0+** (which uses YetiSearch library 2.3.1+) — this version automatically falls back to a compatible query method on older SQLite versions. The minimum supported SQLite version is now **3.24.0**.

If you cannot update the plugin, you will need to upgrade your SQLite version:

* **Ubuntu/Debian**: `sudo apt update && sudo apt install --only-upgrade libsqlite3-0` (Ubuntu 22.04+ ships 3.37+)
* **CentOS/RHEL**: Consider using Remi's repository for newer PHP builds that bundle a recent SQLite
* **Shared hosting**: Contact your hosting provider to request a SQLite upgrade, or ensure PHP is compiled against SQLite 3.24.0+

### `no such module: fts5`

Your PHP's SQLite was not compiled with FTS5 support. Solutions:

* **Ubuntu/Debian**: Install `php-sqlite3` from the default repositories — most modern packages include FTS5
* **macOS**: Use Homebrew PHP (`brew install php`) which includes FTS5 by default
* **Compile from source**: Ensure `-DSQLITE_ENABLE_FTS5` is set when building SQLite

### How do I check my SQLite version?

Run from the command line:

```
$ php -r "echo \SQLite3::version()['versionString'];"
```

Or use the bundled diagnostic script:

```
$ php user/plugins/yetisearch-pro/vendor/yetisearch/yetisearch/scripts/check_sqlite_features.php
```

This reports your SQLite version and whether FTS5 and R-tree modules are available
