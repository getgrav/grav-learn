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
* **PDF indexing** (optional, 2.2.0+) needs **PHP 8.3** or higher and the **zlib** PHP extension. On older PHP versions everything else works and PDFs are skipped

You can verify your SQLite version and FTS5 support by running the built-in check script from your Grav root:

```
$ php user/plugins/yetisearch-pro/vendor/yetidevworks/yetisearch/scripts/check_sqlite_features.php
```

Or check your SQLite version directly:

```
$ php -r "echo 'SQLite: ' . \SQLite3::version()['versionString'] . PHP_EOL;"
```

On macOS, Homebrew PHP typically includes a recent SQLite with FTS5. Some Linux distributions and shared hosting environments may ship older SQLite versions — see [Troubleshooting](#troubleshooting) below.

## Features

- **100% Local Search** - File-backed search with zero external dependencies (optional semantic search uses an embedding API)
- **Two Modal Designs** - Choose between "simple" (lightweight typeahead) or "full" (two-panel with preview)
- **Vanilla JS** - No framework dependencies, works with any theme
- **CSS Variables** - Easy theming with CSS custom properties
- **Smart Indexing** - Fingerprint-based change detection for efficient updates
- **Orphan Cleanup** - Automatically removes stale documents from deleted pages
- **Real-time Updates** - Index updates on page save/delete (optional)
- **Multi-language** - Per-language or single-index strategies
- **Fuzzy Search** - Finds results despite typing mistakes
- **Stemming** - Optional. A search also matches other forms of a word (`runs` finds "running") in English, French, German and Spanish (2.3.0+)
- **Chunked Indexing** - Precise search results within long content
- **Analytics** - Track searches, clicks, and popular terms
- **Geo Search** - Give pages a location and search by distance: a radius, nearest first, and a Near me button in the full modal (2.3.0+)
- **Permissions** - Granular admin permissions (view, modify, admin)
- **Scheduler** - Automated reindex and maintenance via Grav scheduler
- **CLI Commands** - Full command-line interface for indexing, querying, and maintenance
- **PDF Indexing** - Optional search inside PDFs, with results that link to the right page of the PDF (2.2.0+)
- **Semantic Search** - Optional search by meaning as well as keywords, through OpenAI, OpenRouter, Ollama or any OpenAI-compatible embedding API (2.1.0+)

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
    stem_weight: 0.5     # with stemming on: how much a match on a word's stem counts (0 to 1)

indexes:
  pages:
    strategy: single  # or 'per_language'
    languages: []           # empty: derive from Grav languages/versions
    stemming: false         # also match other forms of a word; see Stemming below
    geo:                    # where a page's location is read from (dot paths into the page header)
      lat: geo.lat
      lng: geo.lng
    options:
      fuzzy: true
    query_defaults:
      per_page: 10
      geo:
        units: km           # km | mi | m, for the radius and distances when a request names none
```

* Batching is controlled by `engine.max_batch_size`.
* The snippet length defaults to 75. Set it with `engine.search.snippet_length` or the CLI's `--highlight-length`.
* `stemming` is covered under [Stemming](#stemming) and `geo` under [Geo Search](#geo-search).
* Search settings (`engine.search`, and the top-level `search` block, which wins if both set the same key) apply to every index. Indexer settings come from `engine.indexer` and can be overridden per index with `indexes.<key>.options.indexer`. There is no per-index search override.

> [!NOTE]
> Earlier versions listed index settings for indexed fields, facets, geo fields and typo tolerance. Nothing read them, so 2.3.0 removed them. Values left in your own config are ignored, as they were before.

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

## Stemming

Available from **YetiSearch Pro 2.3.0**. It's optional and switched off by default.

Stemming lets a search match other forms of a word: `runs` finds "running", `configured` finds "configuration", `utilisateur` finds "utilisateurs".

### Turning It On

Turn it on per index with **Stemming (Pages)** in the plugin settings, or in the config:

```yaml
indexes:
  pages:
    stemming: true
```

### Languages

English, French, German and Spanish have stemmers. A per-language index in any other language is not stemmed, and its words match as typed. How the language is chosen depends on the index strategy:

* **`per_language`** - Each index stems in its own language, so `pages_fr` stems in French and `pages_de` in German. A search on it is stemmed in that language too.
* **`single`** - Each page is stemmed in the language it was indexed in, so a French page is stemmed in French. The index's own language is the site's default: Grav's default language, or `site.default_lang` on a site without languages. The `/ys` endpoint searches every language and sends none, so its searches are stemmed in the site's default language, while each page keeps the stems of its own language.

On a multilingual site, `per_language` gets the most out of stemming.

### Ranking and Highlights

A match on the word as typed ranks above a match on its stem. `stem_weight` (0 to 1, default `0.5`) sets how much a stem match counts: lower keeps exact matches further ahead, and `0` still finds stem matches but ranks them last. Set it under `engine.search`, or in the top-level `search` block, which wins if both set it. Highlights include stem matches, so a search for `runs` marks "running".

### Cost

Every page is stemmed when it is indexed, so indexing takes longer and the index grows. On the Helios demo site (507 documents), writing the index took 0.15 s with stemming on against 0.09 s off, and the database was about a third bigger. The library's measurements on 32,000 documents: indexing about 2.5 times slower, the database about 50% larger, and a search median of 1.7 ms against 0.9 ms.

### Turning It On or Off for an Existing Index

Changing the setting rebuilds the full-text index of each existing index once, from the documents it holds, without indexing the pages again.

* **When it happens.** When you save the plugin settings in either admin, using the settings the site runs with after the save (an environment's override included). Otherwise at the next index run (`bin/plugin yetisearch-pro index`, the admin's reindex or the scheduler), page save or page delete.
* **Another environment's settings.** Saving the settings of another environment (say `user/env/staging/config/plugins/yetisearch-pro.yaml` from the production site) changes nothing here. That environment switches at its own next index run or page save.
* **`GRAV_CONFIG__` variables.** A save also changes nothing while any `GRAV_CONFIG__` environment variable is set (for example `GRAV_CONFIG__plugins__yetisearch-pro__engine__storage_dir`), whichever settings it is for. Such a variable can override the plugin's settings, and the saved files do not hold that value. The next index run, page save or page delete switches the indexes, with the settings the site runs with.
* **What you see.** `bin/plugin yetisearch-pro index` prints a line for each index it rebuilt, and the Grav log records it.
* **How long it takes.** A few hundredths of a second per index on the Helios demo. The library measured 1.7 s at 32,000 documents.
* **With `--flush`.** A reindex with `--flush` creates the indexes with the setting.

## Semantic Search

Available from **YetiSearch Pro 2.1.0**. It's optional and switched off by default.

Keyword search finds pages that contain the words a visitor typed. **Semantic search** also finds pages that *mean* the same thing. Someone types "can't log in" and gets your password reset page. "Hire an advisor" finds your consulting page, even though neither word appears on it. YetiSearch Pro runs both searches and merges the results, so a page that matches on keywords and meaning ranks first, and a page found by meaning alone still makes the list.

To understand meaning, YetiSearch Pro turns each page into a list of numbers called an **embedding**, using an embedding model. Pages with similar meaning get similar numbers. The embeddings are stored in your existing index file, and at search time the visitor's query gets the same treatment and is compared against them.

That model has to run somewhere. Running one inside PHP isn't practical on normal hosting, so YetiSearch Pro talks to an **embedding API**. That can be a hosted service like OpenAI or OpenRouter, or your own **Ollama** server if you'd rather keep everything in-house. Keyword search stays 100% local either way, and it keeps working if the API is slow or down.

### Setting It Up

Open the plugin settings, expand **Semantic Search**, turn it on, and fill in the connection details for your service:

| Service | API Base URL | Embedding Model | Dimensions |
|---|---|---|---|
| OpenAI | `https://api.openai.com/v1` | `text-embedding-3-small` | `512` |
| OpenRouter | `https://openrouter.ai/api/v1` | `openai/text-embedding-3-small` | `512` |
| Ollama | `http://localhost:11434/v1` | `nomic-embed-text` | `0` |

Any other service that offers the OpenAI embeddings API works too (Voyage, Mistral, Together, LM Studio). Leave **API Key** empty for a local server like Ollama. If you'd rather not store the key in your config, enter `env:OPENAI_API_KEY` (or any variable name) and YetiSearch Pro reads it from the environment instead.

For **Ollama** with `nomic-embed-text`, also set **Query Prefix** to `search_query: ` and **Document Prefix** to `search_document: `. That model expects them.

Then check the connection:

```bash
bin/plugin yetisearch-pro embed --test
```

The same check is available as the **Test connection** button on the YetiSearch Pro page in Admin Next.

### Embedding Your Content

After enabling it, your pages need embedding once. Either reindex, or run:

```bash
bin/plugin yetisearch-pro embed
```

Only pages that are new or changed since their last embedding are sent to the API. Reindexing unchanged content costs nothing, and editing one page only sends that page. After that, changed pages are picked up automatically:

* **After a page save or reindex**, once the response has gone back to the browser, so a slow API never holds up saving
* By the **Semantic Search Embedding** scheduler job, every 15 minutes by default, which catches anything left over
* With the **Embed** button on the YetiSearch Pro page in Admin Next, which shows how much of your site is embedded and a progress bar while it works

Pages that haven't been embedded yet are still found by keyword search. They just aren't ranked by meaning until they're done.

With OpenAI's `text-embedding-3-small`, embedding costs a couple of cents per million words, so a typical site costs well under a dollar to embed in full. Each new search query costs one small API call, and repeated queries are cached so they cost nothing.

### How Searches Behave

* **The search modal stays instant.** Results based on keywords appear as the visitor types. Once they pause, a second request ranks by meaning and replaces the results. No keystroke waits on the API.
* **Short queries** (under **Minimum Query Length**, 3 characters by default) use keywords only.
* **Nonsense doesn't match.** A query like "asdf" returns nothing rather than whatever page happens to be closest. From **2.1.1**, YetiSearch Pro measures where that cutoff belongs for your own content: after each full embedding run it embeds a handful of meaningless test phrases, sees how closely they match your pages, and sets the cutoff just above that. The YetiSearch Pro page in Admin Next and `embed --status` both show the current cutoff.
* **If the API fails** or takes longer than **Search Timeout** (5 seconds), the search falls back to keywords.
* The JSON endpoint accepts `semantic=0` to ask for keyword ranking only, and reports `"semantic": true` when meaning was part of the ranking.

### Tuning

| Setting | Default | What it does |
|---|---|---|
| **Meaning vs Keywords** | `0.5` | How much of the ranking comes from meaning. `0` is keyword search only, `1` is meaning only. |
| **Minimum Similarity** | `0.25` | Pages less similar than this never appear on meaning alone. Raise it if unrelated pages show up. |
| **Noise Calibration** | Automatic | Measures the nonsense cutoff for each index after embedding. **Off** uses a fixed default instead. |
| **Calibration Strictness** | `2.0` | How far above typical nonsense the cutoff sits. Lower it (say `1.5`) if good matches are missing; raise it if nonsense gets through. It takes effect right away, with no re-embedding. |
| **Minimum Query Length** | `3` | Shorter queries use keywords only. |
| **Search Timeout** | `5` | Seconds a search waits for the API before falling back to keywords. |
| **Embed After Indexing** | On | Embed changed pages after saves and reindexes. |
| **Documents per Run** | `200` | How many documents each background run embeds. |
| **Dimensions** | `512` | Size of each embedding. Smaller searches faster. Only OpenAI's `text-embedding-3` models accept a value; use `0` for anything else. |

Each index also has its own **Semantic Search** toggle under Index Definitions, so you can leave it off for an index where it doesn't help.

> [!NOTE]
> Changing the model, its dimensions, or the prefixes means every page needs embedding again. Until that's done, searches on that index use keywords only. **Re-embed all** in Admin Next (or `embed --reset`) starts over from scratch.

### Limits

Semantic search compares the query against every embedded chunk of content. On a modern server that takes about 0.1 seconds for 10,000 chunks at 512 dimensions, and it grows in step with your content. That's plenty for most sites. For a very large site, use `256` dimensions or keep semantic search off for the biggest index.

## PDF Indexing

> [!NOTE]
> PDF indexing was added in YetiSearch Pro **2.2.0** and needs **PHP 8.3** or higher.

Turn on **PDF Indexing** in the plugin settings (or set `pdf.enabled: true`) and reindex. Every PDF in an indexed page's folder becomes a search result of its own, titled from the PDF's own title or its filename. Each page of the PDF is indexed separately, so a hit links to `file.pdf#page=12` and the browser opens the PDF at the page where the words were found.

```yaml
pdf:
  enabled: true
  max_file_size: 50   # MB; bigger PDFs are left out, 0 = no limit
  max_pages: 1000     # pages indexed per PDF, 0 = all
```

### Requirements

PHP 8.3 or newer with the `zlib` extension. Text extraction is done in PHP by the bundled [YetiPDF](https://github.com/yetidevworks/yetipdf) library, so there is nothing to install on the server. On PHP 8.2 and older the setting is ignored, a notice is written to the Grav log, and pages are indexed as usual.

### What Gets Indexed

PDFs that sit in the folder of a page that is itself indexed. A PDF inherits its page's language, taxonomy and version, so filters and facets apply to it too. A page that is excluded from the index takes its PDFs with it.

To keep a page in the index but leave its PDFs out, switch off **Index this page's PDFs** on the page's YetiSearch tab, or add this to its frontmatter:

```yaml
yetisearch-pro:
  index-pdfs: false
```

### Keeping Up to Date

Extracted text is cached in `cache/yetisearch-pro/pdf`, keyed on each file's size and modified time, so a reindex only reads PDFs that changed. Delete that folder to have every PDF read again. With real-time indexing on, uploading or deleting a PDF in the admin updates the index straight away, and so does saving the page.

### What Is Skipped

Scanned PDFs with no text layer (there is no OCR), PDFs that need a password to open, and PDFs over the size limit. Each one is noted in the Grav log. A PDF that could not be read is tried again on the next index run.

### In Templates

A PDF hit has `doc_type: pdf` in its metadata (`result._meta` in Twig and in the `/ys` JSON), along with `pdf_file`, `pdf_page`, `pdf_pages`, `page_route` and `page_title` (the page the PDF is attached to). Its `route` is the path the file is served from and its `url` adds `#page=N`.

## Geo Search

> [!NOTE]
> Geo search was added in YetiSearch Pro **2.3.0**.

Give pages a location and the search can list them by distance, keep only those within a radius, and show how far away each result is. Searches and the modals work as before for pages without a location, and a page without one never appears in a location search.

It works without SQLite's R-Tree module. Since YetiSearch 2.5.4 the library falls back to a plain table with the same results, and since 2.5.5 that holds without SQLite's math functions too. See [Without R-Tree](https://github.com/yetidevworks/yetisearch#without-r-tree) in the library's README for what differs.

### Giving a Page a Location

Add `geo` to the page's frontmatter, or fill in the **Location** group on the **YetiSearch** tab of the page editor, which writes the same two keys:

```yaml
geo:
  lat: 51.5074
  lng: -0.1278
```

Latitude must be from -90 to 90 and longitude from -180 to 180. A page is given a location only when both are numbers in range. A missing, empty or invalid value never turns into 0,0: the page is indexed without a location. PDFs in a page's folder are found at their page's location, and so are the page's chunks. Changing a page's location rewrites its document on the next index, and removing it takes the page out of location searches. In Admin Next a number field cannot be emptied once it has a value, so remove a location from the page's frontmatter (Expert mode).

#### Custom Paths

If your pages already store coordinates under other keys, point the index at them with dot paths into the page header:

```yaml
indexes:
  pages:
    geo:
      lat: venue.latitude
      lng: venue.longitude
```

The same settings are in the plugin's configuration, as **Page Latitude Field** and **Page Longitude Field**. Set `geo: false` to leave page frontmatter out. The Location field on the page editor always writes `geo.lat` and `geo.lng`, so it only matches the default paths. Reindex after changing the paths.

Locations from some other source, such as a database or a differently formatted value, are set from an event listener (see [Setting a Location from an Event Listener](#setting-a-location-from-an-event-listener)).

### Searching

The `query_route` endpoint (default `/ys`), the `yetisearch()` Twig function and the `onYetisearchProBeforeSearch` event's `options` take these:

| Parameter | What it does |
|---|---|
| `lat`, `lng` | The place to search around. Both are needed. Values that are not valid coordinates are ignored and the search runs as a normal one. |
| `radius` | Optional. With it, only documents within that distance are returned. Without it, every document that has a location is returned. A value that is not a positive number is ignored. |
| `units` | `km`, `mi` or `m`, for the radius and the distances. Defaults to the index's `query_defaults.geo.units`, then `km`. |
| `sort` | `distance` lists the nearest first, also with a query. A search with a query keeps relevance order without it. |

With a location and an empty `q`, the search lists the nearest documents, as if `sort=distance` were given. An empty `q` with no valid location still returns an empty result. That rule is applied after the `onYetisearchProBeforeSearch` event, so a listener can set `geo` in the event's `options` for an empty query, and one that removes it ends the search with an empty result. The same goes for the CLI: `query` with `--lat` and `--lng` and no text lists the nearest first.

```
/ys?lat=51.5074&lng=-0.1278&radius=5&units=km&sort=distance&ajax=1
/ys?q=coffee&lat=51.5074&lng=-0.1278&radius=25&ajax=1
```

Every hit of a location search has `distance` (meters) and `distance_text`, the distance in the search's units such as `1.3 km` or `0.8 mi`. The strings come from `PLUGIN_YETISEARCH_PRO.DISTANCE_KM`, `DISTANCE_MI` and `DISTANCE_M`, so they can be translated. The result envelope has a `geo` entry with the location the search used (`lat`, `lng`, `radius`, `units`, `sort`), so a page can tell that the results carry distances.

In Twig:

```twig
{% set results = yetisearch('coffee', {'lat': 51.5074, 'lng': -0.1278, 'radius': 5, 'units': 'mi', 'sort': 'distance'}) %}
{% for hit in results.results %}
    {{ hit.title }}, {{ hit.distance_text }}
{% endfor %}
```

The simple modal shows `distance_text` on each result when its requests carry a location. Pass it with `data-ys-extra-params` (see Extra Query Parameters under [Customizing Modal Templates](#customizing-modal-templates)), for example `data-ys-extra-params="lat=51.5074&lng=-0.1278&units=km"`.

### Near Me

Set `modal.near_me: true` to add a **Near me** button to the full modal. It is off by default. When the visitor turns it on, the browser asks for their location. The modal then adds `lat`, `lng`, `radius`, `units` and `sort=distance` to its requests, lists nearby results even when the search box is empty, and offers a radius menu. If the location is denied or cannot be found, the modal says so.

```yaml
modal:
  type: full
  near_me: true
  near_me_radii: [1, 5, 10, 25, 50]   # radius choices, in the index's query_defaults.geo.units
  near_me_radius: 10                  # radius selected first; 0 = any distance. It is added to the menu when it is not in near_me_radii
```

The button sits in its own `near_me` block of the full modal template, so a theme can move or replace it. A theme's own `filters.html.twig` is not affected.

### Privacy

The coordinates a visitor shares stay in the browser for as long as the page is open. They are sent only as parameters of the search request, never stored in the browser, and the plugin does not store them: analytics record the search text as before, plus whether a location was used, and never the coordinates. Searches with an empty `q` are not recorded at all.

### Location Searches in the CLI

```bash
bin/plugin yetisearch-pro query "coffee" --lat=51.5074 --lng=-0.1278 --radius=5 --units=km --sort=distance
bin/plugin yetisearch-pro query --lat=51.5074 --lng=-0.1278 --radius=25
```

`--lat` and `--lng` are both needed; write a negative number as `--lng=-0.1278`, with the equals sign. `--sort distance` needs a location. The query can be left out when there is a location. The results table gains a distance column. See the [Query Command](#query-command) for every option.

### Setting a Location from an Event Listener

`onYetisearchBuildDocument` can set a document's location from any source. Assign the document back to the event: changing `$event['doc']['geo']` in place does not reach the indexer, so a listener has to read `$event['doc']`, change its copy and assign the copy back to `$event['doc']`. This example, tested with `bin/plugin yetisearch-pro index` and with a page saved in the admin, reads a header key `location: "48.8584, 2.2945"`:

```php
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class MyPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return ['onYetisearchBuildDocument' => ['onYetisearchBuildDocument', 0]];
    }

    public function onYetisearchBuildDocument(Event $event): void
    {
        $location = (string)($event['subject']->header()->location ?? '');
        if (strpos($location, ',') === false) {
            return;
        }
        [$lat, $lng] = array_map('trim', explode(',', $location, 2));

        $doc = $event['doc'];
        $doc['geo'] = ['lat' => $lat, 'lng' => $lng];
        $event['doc'] = $doc;
    }
}
```

The indexer checks the location and turns the two values into numbers; a value that is not a valid coordinate leaves the document without a location. A document can also carry `geo_bounds` (`north`, `south`, `east`, `west`) instead of a point. The event fires for a page's PDFs too, with the page as `subject`, so the same code gives them the location.

## Modal Configuration

YetiSearch Pro includes two modal designs that themes can use.

### Modal Types

* **`full`** - Two-panel modal with results on the left and a live preview on the right. Includes pagination, filter controls, breadcrumbs, and On This Page sections. Best for documentation sites with longer content.

* **`simple`** (default) - Lightweight typeahead modal with grouped results. Single panel, no preview. Best for general sites that want a clean, fast search experience.

### Configuration

```yaml
modal:
  type: simple    # 'full' or 'simple'
  branding: true  # Show "Powered by YetiSearch" in footer
  near_me: false  # full modal only (2.3.0+): add a "Near me" button
  near_me_radii: [1, 5, 10, 25, 50]   # radius choices, in the index's query_defaults.geo.units
  near_me_radius: 10                  # radius selected first; 0 = any distance
```

`near_me` adds a button that searches around the visitor's location. It is off by default. `near_me_radii` lists the radius choices and `near_me_radius` is the one selected first; it is added to the menu when it is not in the list. See [Near Me](#near-me) for how it works.

## Theme Integration

### Adding the Search Modal

Include the modal in your theme's base template:

```twig
{# In your theme's partials/base.html.twig or similar #}
{% if config.plugins['yetisearch-pro'].enabled %}
    {% include 'partials/yetisearch-pro/modal.html.twig' %}
{% endif %}
```

The modal automatically selects the correct type based on your configuration.

The modals send their requests to `query_route` (default `/ys`), with the site's base URL in front, so changing `query_route` is enough. Themes that build their own modal need to read `query_route` themselves.

To include a specific modal directly:

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

### Built-in Search Page

> [!NOTE]
> The built-in search page works from YetiSearch Pro **2.3.0**. In earlier versions its template called Twig functions that were never registered, so the page failed to render.

Set `built_in_search_page: true` to serve a ready-made results page at `search_route` (default `/search`). It uses the theme's `partials/base.html.twig`. If your site already has a page at that route, even an unpublished one, that page is used and the built-in one is not added.

```yaml
built_in_search_page: true
search_route: /search
```

The page is built from two Twig functions that any template can use:

* `yetisearch(query, options)` runs the same search as the `query_route` endpoint, including language handling, the `onYetisearchProBeforeSearch` event and analytics, and returns the same result envelope: `results`, `total`, `page`, `pages`, `limit`, `time` and `time_ms` (milliseconds), `suggestion` and `semantic`. `options` can hold `page`, `per_page`, `type` (`content`, `api` or `both`), `filter` (see the [Filter DSL](#filter-dsl)), `version`, `fuzzy`, `semantic`, `unique_by_route`, `max_results`, and `lat`, `lng`, `radius`, `units` and `sort` for a location search (see [Geo Search](#geo-search)).
* `yetisearch_form(options)` returns a search form that sends `q` to the search page. `options` can hold `placeholder`, `button_text`, `action`, `value` and `class`.

Each hit has `title`, `url`, `route`, `excerpt`, `tags` (a comma-separated string) and `_highlights`, with `date`, `anchor` and `heading` in `_meta`. On a location search it also has `distance` (meters) and `distance_text`.

Highlights contain `<mark>` tags around the matches, and nothing in them is escaped: titles are stored as typed, and page text keeps entities such as `&lt;`. Before you output one as HTML, turn every `<` that does not start `<mark>` or `</mark>` into `&lt;`, as `templates/search.html.twig` does with `{{ text|regex_replace('~<(?!/?mark>)~i', '&lt;')|raw }}`, or output only the plain fields. Do not escape the whole text again, or code samples in your pages show up as `&lt;img` instead of `<img`.

The built-in page turns into a location search when its URL carries `lat` and `lng`, for example `/search?q=coffee&lat=51.5074&lng=-0.1278&radius=5&units=km&sort=distance`. Each result then shows its distance, and an empty `q` lists the nearest pages. The location stays in the page links, so paging keeps it.

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
| `near_me` | The Near me row under the input (empty unless `modal.near_me` is on) |
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

Control indexing per-page via frontmatter, or with the same settings on the **YetiSearch** tab of the page editor:

```yaml
yetisearch-pro:
  index-page: false      # Exclude this page from the index
  ignore: true           # Same as index-page: false
  index-children: false  # Exclude child pages from the index
  index-pdfs: false      # Keep the page but leave its PDFs out (2.2.0+)
  fields:                # Extra frontmatter fields to index with the page
    - seo.description
```

> [!NOTE]
> Before 2.2.0 only the older `yetisearch:` key was read, and settings made on the page editor's YetiSearch tab (which saves under `yetisearch-pro:`) had no effect. From 2.2.0 both keys are read. `yetisearch-pro:` is the one to use, and it wins if a page sets the same option under both.

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
* **Location**: `geo` with `lat` and `lng`, only for pages that have a location (2.3.0+)
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
      --no-embed          Skip embedding for semantic search afterwards
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

When an index fails, or a run could not remove a stale document (one whose page is gone), the command names the index and the reason and exits with status 1, with `--raw` too, whose JSON then has `"success": false`. A stale document that could not be removed stays recorded, so the next run removes it. The reindex in either admin, the API and the scheduler report such a failure too (2.3.0+).

### Query Command

```bash
bin/plugin yetisearch-pro query [QUERY] [options]

Core:
  -x,  --index=INDEX             Index key or suffixed key
  -l,  --lang=LANG               Language/Version
  -p,  --page=PAGE               Page number (default: 1)
       --per-page=N              Results per page (default: 10)
       --compact                 Compact output
  -r,  --raw                     Raw JSON output

Location (2.3.0+, see Geo Search):
       --lat=LAT                 Latitude of the search location (needs --lng)
       --lng=LNG                 Longitude of the search location (needs --lat)
       --radius=R                Only documents within R of the location, in --units
       --units=km|mi|m           Units for the radius and distances (default: the index's setting, else km)
  -s,  --sort=distance           Nearest first (needs a location)

Search behavior:
       --fuzzy                   Enable fuzzy search
       --fuzziness=F             Fuzziness score (0..1, default: 0.8)
       --fields=LIST             Comma-separated fields to search
  -s,  --sort=SPEC               Sort spec, e.g. "title:asc,updated_at:desc"
  -F,  --filter=EXPR             Repeatable filter: field<op>value, e.g. type=content or price>=10 (op: =,!=,>,>=,<,<=)
       --no-highlight            Disable highlight markup
       --highlight-length=N      Snippet window length (default: 75)
  -d,  --distinct[=BOOL]         Distinct per route (default: true)
       --suggestions             Show suggestions after results
       --suggestions-limit=N     Suggestion count (default: 10)
```

The query text is optional when there is a location: `query` with `--lat` and `--lng` and no text lists the nearest documents first. `--lat` and `--lng` are both needed, and a negative number is written with the equals sign, as in `--lng=-0.1278`. `--sort distance` needs a location. With a location, the results table gains a distance column.

A filter is written without brackets: `type=content`, `price>=10`, `taxonomy.category=plugins`. The field is letters, digits, `_` and `.`, and starts with a letter or `_`. From 2.3.0 a filter the command can't read, such as `type[=]content`, prints a warning that names it on stderr (so `--raw` JSON on stdout stays valid) and is left out of the search.

Examples:

```bash
# Fuzzy search in a per-language index
bin/plugin yetisearch-pro query "install theme" --index pages_17 --fuzzy

# Search with language in single-index strategy
bin/plugin yetisearch-pro query "installer" --index pages --lang fr

# With filters and sort
bin/plugin yetisearch-pro query "config" -x pages_17 -F "taxonomy.category=plugins" -s "title:asc"

# Nearest places within 5 km, no query text
bin/plugin yetisearch-pro query --lat=51.5074 --lng=-0.1278 --radius=5 --sort=distance
```

### Schedule Command

```bash
bin/plugin yetisearch-pro schedule [options]

Options:
  -l, --list              Display configured schedule summary
  -t, --task=TASK         Task to run: reindex, maintenance, embed, or all (default: all)
  -f, --force             Run even if the task is disabled
```

### Embed Command

Embeds new and changed documents for [Semantic Search](#semantic-search). Needs semantic search enabled.

```bash
bin/plugin yetisearch-pro embed [options]

Options:
  -x, --index=INDEX       Index key (e.g., pages); all semantic indexes by default
  -l, --limit=LIMIT       Documents per API round [default: 100]
  -s, --status            Show embedding coverage and exit
  -t, --test              Check the provider settings with one short request
      --reset             Forget stored embeddings and embed everything again
```

`--status` also shows each index's noise cutoff and whether it was measured on your content or is the default. After upgrading to 2.1.1, run `embed` once: it measures the cutoff even when every page is already embedded.

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

Pass filters with the `filter` query parameter, in either of two forms.

**Array form**, one `filter[field][operator]=value` per condition. The operator is a name: `eq`, `eqor` (equals or empty), `neq` or `ne`, `gt`, `gte`, `lt`, `lte`, `in`, `nin`, `like`, `contains` or `exists`. `filter[field]=value` on its own means equals:

```
/ys?q=search+terms&filter[version][eqor]=v3&filter[category][eq]=plugins
```

**String form**, `field:operator:value`, with several conditions joined by `AND` (a space on each side, URL-encoded as `%20` or `+`). The operator is one of `=`, `=?`, `!=`, `>`, `>=`, `<`, `<=`, `in`, `like`, `contains` or `exists`. For `in`, separate the values with commas:

```
/ys?q=search+terms&filter=version:=?:v3
/ys?q=search+terms&filter=version:=?:v3%20AND%20category:=:plugins
/ys?q=search+terms&filter=version:in:v2,v3
```

`=?` matches the value or an empty field, which suits pages that apply to every version. A condition the parser can't read, such as `version[=]v3`, is skipped without an error and the search runs unfiltered. Passing `filter` twice (`filter=a&filter=b`) keeps only the last one, so use `AND` or the array form for more than one condition. The older `version=v3` parameter is still accepted and behaves like `filter=version:=?:v3`.

On and off flags in a request (`unique_by_route`, `semantic`, `fuzzy`) take `1`, `true`, `yes` and `on`, or `0`, `false`, `no` and `off`. `unique_by_route=0` returns every matching document instead of one per route.

A location search adds `lat`, `lng`, `radius`, `units` and `sort=distance` to the request. See [Geo Search](#geo-search) for what each one does.

With [Semantic Search](#semantic-search) on, add `semantic=0` to a request to get keyword ranking only. The response includes `"semantic": true` when meaning was part of the ranking.

### Suggestions Endpoint

A lightweight suggestions endpoint is available at `<query_route>/suggest` (e.g., `/ys/suggest`):

* Parameters: `term` or `q` (input string), `limit` (default: 10)
* Returns JSON array of `{ text, score, count }` with minimal Grav overhead

## Events (Extensibility)

These Grav events allow custom indexing and changes to a document before it is indexed:

* **`onYetisearchCollectObjects(index, lang, &documents)`** - Add or modify non-page documents to index
* **`onYetisearchBuildDocument(subject, lang, index, &doc)`** - Change a document before it is indexed (e.g., add custom frontmatter fields or a location). From 2.2.0 it also fires for each PDF document, with the owning page as `subject`; check `doc['doc_type'] === 'pdf'` to tell them apart. Assign the changed document back with `$event['doc'] = $doc`; editing `$event['doc']['key']` in place is not kept. See [Geo Search](#setting-a-location-from-an-event-listener) for another example
* **`onYetisearchProBeforeSearch(query, lang, &filters, &options)`** - Add custom filters or modify search options before a query is executed. A location search has its checked location in `options['geo']` (`lat`, `lng`, `radius`, `units`, `sort`)
* **`onYetisearchPageSkip(page, config)`** - Decide whether to skip a page during indexing. `config` is the definition of the index being built. Set `skip` to `true` on the event to leave the page out

An event hands a listener its values by copy. Read a value from the event, change it, and assign it back (`$event['options'] = $options`). A change made in place, such as `$event['options']['geo'] = ...` or `$doc = &$event['doc']`, is lost.

### Example: Adding Custom Fields

```php
public function onYetisearchBuildDocument(Event $event)
{
    $page = $event['subject'];
    $doc = $event['doc'];

    // Add a custom field from page headers
    $doc['author'] = $page->header()->author ?? '';

    // Assign the changed document back, or the change is not kept
    $event['doc'] = $doc;
}
```

### Example: Indexing FlexObjects

```php
public function onYetisearchCollectObjects(Event $event)
{
    $documents = $event['documents'];

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

    $event['documents'] = $documents;
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
* Enable fuzzy search (`options.fuzzy`, on by default) to find results despite typing mistakes. If it lets in too many false matches, raise `search.trigram_threshold` (`0.45` in the plugin's default config; higher is stricter) or set `options.fuzzy: false` for the index. A request can turn it off with `fuzzy=0`
* With [Stemming](#stemming) on, lower `stem_weight` to keep exact matches further ahead of matches on other forms of a word
* With semantic search on, raise **Minimum Similarity** if loosely related pages show up, or lower **Meaning vs Keywords** if exact keyword matches should win more often

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
$ php user/plugins/yetisearch-pro/vendor/yetidevworks/yetisearch/scripts/check_sqlite_features.php
```

This reports your SQLite version and whether FTS5 and R-tree modules are available

### Upgrading to 2.3.0: the full-text index is rebuilt once

The bundled YetiSearch library is updated to 2.6.1 in this release. With the library's 2.5.x versions, deleting a page that has chunks or PDFs, or saving one that is left out of search (an unpublished page, for one), added the field names of the stored documents (`title`, `route`, `content`, `url` and so on) to the index as words. A search for `title` or `route` then returned every document until the next page save rebuilt the index.

YetiSearch Pro rebuilds the full-text index of each existing index once after the upgrade, before anything is written to it or deleted from it. That happens at the first index run, page save, page delete, PDF change or settings save, and it is recorded in the index so it never runs again. It matters because with library 2.6.0 a delete from an index still holding those words breaks every later search for one of them (2.6.1 also rebuilds such an index itself on its first write). On the Helios demo sites it took about a hundredth of a second per index, and nothing needs to be reindexed by hand.

If the rebuild fails, the Grav log says so and nothing is written to that index until a later request rebuilds it.
