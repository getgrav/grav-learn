---
title: Configuration
page-toc:
  active: true
taxonomy:
    category: docs
---

All Grav configuration files are written in [YAML syntax](../../advanced/yaml) with a `.yaml` file extension.  YAML is very intuitive which makes it very easy to both read and write, however, you can check out the [YAML page in the Advanced chapter](../../advanced/yaml) to get a complete understanding of the syntax available.

## System Configuration

Grav focuses on making things as easy as possible for the user, and the same goes for configuration.  Grav comes with some sensible default options, and these are contained in a file that resides in the `system/config/system.yaml` file.

However, **you should never change this file**, instead any configuration changes you need to make should be stored in a file called `user/config/system.yaml`.  Any setting in this file with the same structure and naming will override the setting provided in the default system configuration file.

!!!! Generally speaking you should **NEVER** change anything in the `system/` folder.  All things the user does (creating content, installing plugins, editing configuration, etc.) should be done in the `user/` folder.  This way it allows simpler upgrading and also keeps your changes all in one location for backing up, synchronizing, etc.

Here are the variables found in the default `system/config/system.yaml` file:

### Basic Options

[prism classes="language-yaml line-numbers"]
absolute_urls: false
timezone: ''
default_locale:
param_sep: ':'
wrapped_site: false
reverse_proxy_setup: false
force_ssl: false
force_lowercase_urls: true
custom_base_url: ''
username_regex: '^[a-z0-9_-]{3,16}$'
pwd_regex: '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
intl_enabled: true
[/prism]

These configuration options do not appear within their own child sections. They're general options that affect the way the site operates, its timezone, and base URL. 

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **absolute_urls:** | Absolute or relative URLs for `base_url` |
| **timezone:** | Valid values can be found [here](https://php.net/manual/en/timezones.php) |
| **default_locale:** | Default locale (defaults to system) |
| **param_sep:** | This is used for Grav parameters in the URL.  Don't change this unless you know what you are doing.  Grav > `1.1.16` automatically sets this to `;` for users running Apache web server on Windows |
| **wrapped_site:** | For themes/plugins to know if Grav is wrapped by another platform. Can be `true` or `false` |
| **reverse_proxy_setup:** | Running in a reverse proxy scenario with different webserver ports than proxy. Can be `true` or `false` |
| **force_ssl:** | If enabled, Grav forces to be accessed via HTTPS (NOTE: Not an ideal solution). Can be `true` or `false` |
| **force_lowercase_urls:** |If you want to support mixed cased URLs set this to `false` |
| **custom_base_url:** | Manually set the base_url here |
| **username_regex:** | Only lowercase chars, digits, dashes, underscores. 3 - 16 chars |
| **pwd_regex:** | At least one number, one uppercase and lowercase letter, and be at least 8+ chars |
| **intl_enabled:** | Special logic for PHP International Extension (mod_intl) |
[/div]

### Languages

[prism classes="language-yaml line-numbers"]
languages:
  supported: []
  include_default_lang: true
  pages_fallback_only: false
  translations: true
  translations_fallback: true
  session_store_active: false
  http_accept_language: false
  override_locale: false
[/prism]

The **Languages** area of the file establishes the site's language settings. This includes which language(s) are supported, designation of the default language in the URLs, and translations. Here is the breakdown for the **Languages** area of the system configuration file:

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **supported:** | List of languages supported. eg: `[en, fr, de]` |
| **include_default_lang:** | Include the default lang prefix in all URLs. Can be `true` or `false` |
| **pages_fallback_only:** | Only fallback to find page content through supported languages. Can be `true` or `false` |
| **translations:** | Enable translations by default. Can be `true` or `false` |
| **translations_fallback:** | Fallback through supported translations if active lang doesn't exist. Can be `true` or `false` |
| **session_store_active:** | Store active language in session. Can be `true` or `false` |
| **http_accept_language:** | Attempt to set the language based on http_accept_language header in the browser. Can be `true` or `false` |
| **override_locale:** | Override the default or system locale with language specific one. Can be `true` or `false` |
[/div]

### Home

[prism classes="language-yaml line-numbers"]
home:
  alias: '/home'
  hide_in_urls: false
[/prism]

The **Home** section is where you set the default path for the site's homepage. You can also choose to hide the home route in URLs.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **alias:** | Default path for home, ie: `/home` or `/` |
| **hide_in_urls:** | Hide the home route in URLs. Can be `true` or `false` |
[/div]

### Pages

[prism classes="language-yaml line-numbers"]
pages:
  theme: quark
  order:
    by: default
    dir: asc
  list:
    count: 20
  dateformat:
    default:
    short: 'jS M Y'
    long: 'F jS \a\t g:ia'
  publish_dates: true
  process:
    markdown: true
    twig: false
  twig_first: false
  never_cache_twig: false
  events:
    page: true
    twig: true
  markdown:
    extra: false
    auto_line_breaks: false
    auto_url_links: false
    escape_markup: false
    special_chars:
      '>': 'gt'
      '<': 'lt'
  types: [txt,xml,html,htm,json,rss,atom]
  append_url_extension: ''
  expires: 604800
  cache_control:
  last_modified: false
  etag: false
  vary_accept_encoding: false
  redirect_default_route: false
  redirect_default_code: 302
  redirect_trailing_slash: true
  ignore_files: [.DS_Store]
  ignore_folders: [.git, .idea]
  ignore_hidden: true
  hide_empty_folders: false
  url_taxonomy_filters: true
  frontmatter:
    process_twig: false
    ignore_fields: ['form','forms']
[/prism]

The **Pages** section of the `system/config/system.yaml` file is where you set a lot of the main theme-related settings. For example, this is where you set the theme used to render the site, page ordering, twig and markdown processing defaults, and more. This is where most of the decisions that affect the way your pages are rendered are made.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **theme:** | This is where you set the default theme. This defaults to `quark` |
| **order:** | |
| ... **by:** | Order pages by `default`, `alpha` or `date` |
| ... **dir:** | Default ordering direction, `asc` or `desc` |
| **list:** | |
| ... **count:** | Default item count per page |
| **dateformat:** | |
| ... **default:** | The default date format Grav expects in the `date: ` field |
| ... **short:** | Short date format. Example: `'jS M Y'` |
| ... **long:** | Long date format. Example: `'F jS \a\t g:ia'` |
| **publish_dates:** | Automatically publish/unpublish based on dates. Can be set `true` or `false` |
| **process:** | |
| ... **markdown:** | Enable or disable the processing of markdown on the front end. Can be set `true` or `false` |
| ... **twig:** | Enable or disable the processing of twig on the front end. Can be set `true` or `false` |
| **twig_first:** | Process Twig before markdown when processing both on a page. Can be set `true` or `false` |
| **never_cache_twig:** | Enabling this will allow you to add a processing logic that can change dynamically on each page load, rather than caching the results and storing it for each page load. This can be enabled/disabled site-wide in the **system.yaml**, or on a specific page. Can be set `true` or `false` |
| **events:** | |
| ... **page:** | Enable page-level events. Can be set `true` or `false` |
| ... **twig:** | Enable Twig-level events. Can be set `true` or `false` |
| **markdown:** | |
| ... **extra:** | Enable support for Markdown Extra support (GitHub-flavored Markdown (GFM) by default). Can be set `true` or `false` |
| ... **auto_line_breaks:** | Enable automatic line breaks. Can be set `true` or `false` |
| ... **auto_url_links:** | Enable automatic HTML links. Can be set `true` or `false` |
| ... **escape_markup:** | Escape markup tags into entities. Can be set `true` or `false` |
| ... **special_chars:** | List of special characters to automatically convert to entities. Each character consumes a line below this variable. Example: `'>': 'gt'` |
| **types:** | List of valid page types. For example: `[txt,xml,html,htm,json,rss,atom]` |
| **append_url_extension:** | Append page's extension in Page URLs (e.g. `.html` results in **/path/page.html**) |
| **expires:** | Page expires time in seconds (604800 seconds = 7 days) (`no cache` is also possible) |
| **cache_control:** | Can be blank for no setting, or a [valid](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control) `cache-control` text value |
| **last_modified:** | Set the last modified date header based on file modification timestamp. Can be set `true` or `false` |
| **etag:** | Set the etag header tag. Can be set to `true` or `false` |
| **vary_accept_encoding:** | Add `Vary: Accept-Encoding` header. Can be set to `true` or `false` |
| **redirect_default_route:** | Automatically redirect to a page's default route. Can be set to `true` or `false` |
| **redirect_default_code:** | Default code to use for redirects. For example: `302` |
| **redirect_trailing_slash:** | Handle automatically or 302 redirect a trailing / URL |
| **ignore_files:** | Files to ignore in Pages. Example: `[.DS_Store] ` |
| **ignore_folders:** | Folders to ignore in Pages. Example: `[.git, .idea]` |
| **ignore_hidden:** | Ignore all Hidden files and folders. Can be set to `true` or `false` |
| **hide_empty_folders:** | If folder has no .md file, should it be hidden. Can be set to `true` or `false` |
| **url_taxonomy_filters:** | Enable auto-magic URL-based taxonomy filters for page collections. Can be set to `true` or `false` |
| **frontmatter:** | |
| ... **process_twig:** | Should the frontmatter be processed to replace Twig variables? Can be set to `true` or `false` |
| ... **ignore_fields:** | Fields that might contain Twig variables and should not be processed. Example: `['form','forms']` |
[/div]

### Cache

[version=15]
[prism classes="language-yaml line-numbers"]
cache:
  enabled: true
  check:
    method: file
  driver: auto
  prefix: 'g'
  clear_images_by_default: true
  cli_compatibility: false
  lifetime: 604800
  gzip: false
  allow_webserver_gzip: false
  redis:
    socket: false
[/prism]
[/version]

[version=16]
[prism classes="language-yaml line-numbers"]
cache:
  enabled: true
  check:
    method: file
  driver: auto
  prefix: 'g'
  purge_at: '0 4 * * *'
  clear_at: '0 3 * * *'
  clear_job_type: 'standard'
  clear_images_by_default: true
  cli_compatibility: false
  lifetime: 604800
  gzip: false
  allow_webserver_gzip: false
  redis:
    socket: false
[/prism]
[/version]

The **Cache** section is where you can configure the site's caching settings. You can enable, disable, choose the method, and more.

[version=15]
[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **enabled:** | Set to `true` to enable caching. Can be set to `true` or `false` |
| **check:** | |
| ... **method:** | Method to check for updates in pages. Options: `file`, `folder`, `hash` and `none`. [more details](../../advanced/performance-and-caching#grav-core-caching) |
| **driver:** | Select a cache driver. Options are: `auto`, `file`, `apcu`, `redis`, `memcache`, and `wincache` |
| **prefix:** | Cache prefix string (prevents cache conflicts). Example: `g` |
| **clear_images_by_default:** | By default grav will include processed images when cache clears, this can be disabled by setting this to `false` |
| **cli_compatibility:** | Ensures only non-volatile drivers are used (file, redis, memcache, etc.) |
| **lifetime:** | Lifetime of cached data in seconds (`0` = infinite). `604800` is 7 days |
| **gzip:** | GZip compress the page output. Can be set to `true` or `false` |
| **allow_webserver_gzip:** | This option will change the header to `Content-Encoding: identity` allowing gzip to be more reliably set by the webserver although this usually breaks the out-of-process `onShutDown()` capability.  The event will still run, but it won't be out of process, and may hold up the page until the event is complete |
| **redis:** | |
| **... socket:** | The path to the redis socket file |
[/div]
[/version]

[version=16]
[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **enabled:** | Set to `true` to enable caching. Can be set to `true` or `false` |
| **check:** | |
| ... **method:** | Method to check for updates in pages. Options: `file`, `folder`, `hash` and `none`. [more details](../../advanced/performance-and-caching#grav-core-caching) |
| **driver:** | Select a cache driver. Options are: `auto`, `file`, `apcu`, `redis`, `memcache`, and `wincache` |
| **prefix:** | Cache prefix string (prevents cache conflicts). Example: `g` |
| **purge_at:** | Scheduler: How often to purge old cache using cron `at` syntax |
| **clear_at:** | Scheduler: How often to clear the cache using cron `at` syntax |
| **clear_job_type:** | Type to clear when processing the scheduled clear job. Options: `standard` \| `all` |
| **clear_images_by_default:** | By default grav will include processed images when cache clears, this can be disabled by setting this to `false` |
| **cli_compatibility:** | Ensures only non-volatile drivers are used (file, redis, memcache, etc.) |
| **lifetime:** | Lifetime of cached data in seconds (`0` = infinite). `604800` is 7 days |
| **gzip:** | GZip compress the page output. Can be set to `true` or `false` |
| **allow_webserver_gzip:** | This option will change the header to `Content-Encoding: identity` allowing gzip to be more reliably set by the webserver although this usually breaks the out-of-process `onShutDown()` capability.  The event will still run, but it won't be out of process, and may hold up the page until the event is complete |
| **redis:** | |
| **... socket:** | The path to the redis socket file |
[/div]
[/version]

### Twig

[prism classes="language-yaml line-numbers"]
twig:
  cache: true
  debug: true
  auto_reload: true
  autoescape: false
  undefined_functions: true
  undefined_filters: true
  umask_fix: false
[/prism]

The **Twig** section gives you a quick set of tools with which to configure Twig on your site for debugging, caching, and optimization.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **cache:** | Set to `true` to enable Twig caching. Can be set to `true` or `false` |
| **debug:** | Enable Twig debug. Can be set to `true` or `false` |
| **auto_reload:** | Refresh cache on changes. Can be set to `true` or `false` |
| **autoescape:** | Autoescape Twig vars. Can be set to `true` or `false` |
| **undefined_functions:** | Allow undefined functions. Can be set to `true` or `false` |
| **undefined_filters:** | Allow undefined filters. Can be set to `true` or `false` |
| **umask_fix:** | By default Twig creates cached files as 755, fix switches this to 775. Can be set to `true` or `false` |
[/div]

### Assets

[prism classes="language-yaml line-numbers"]
assets:
  css_pipeline: false
  css_pipeline_include_externals: true
  css_pipeline_before_excludes: true
  css_minify: true
  css_minify_windows: false
  css_rewrite: true
  js_pipeline: false
  js_pipeline_include_externals: true
  js_pipeline_before_excludes: true
  js_minify: true
  enable_asset_timestamp: false
  collections:
    jquery: system://assets/jquery/jquery-2.x.min.js
[/prism]

The **Assets** section enables you to configure options related to the Assets Manager (JS, CSS).

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **css_pipeline:** | The CSS pipeline is the unification of multiple CSS resources into one file. Can be set to `true` or `false` |
| **css_pipeline_include_externals:** | Include external URLs in the pipeline by default. Can be set to `true` or `false` |
| **css_pipeline_before_excludes:** | Render the pipeline before any excluded files. Can be set to `true` or `false` |
| **css_minify:** | Minify the CSS during pipelining. Can be set to `true` or `false` |
| **css_minify_windows:** | Minify Override for Windows platforms. `false` by default due to ThreadStackSize. Can be set to `true` or `false` |
| **css_rewrite:** | Rewrite any CSS relative URLs during pipelining. Can be set to `true` or `false` |
| **js_pipeline:** | The JS pipeline is the unification of multiple JS resources into one file. Can be set to `true` or `false` |
| **js_pipeline_include_externals:** | Include external URLs in the pipeline by default. Can be set to `true` or `false` |
| **js_pipeline_before_excludes:** | Render the pipeline before any excluded files. Can be set to `true` or `false` |
| **js_minify:** | Minify the JS during pipelining. Can be set to `true` or `false` |
| **enable_asset_timestamp:** | Enable asset timestamps. Can be set to `true` or `false` |
| **collections:** | This contains collections, designated as sub-items. For example: `jquery: system://assets/jquery/jquery-3.x.min.js` |
[/div]

### Errors

[prism classes="language-yaml line-numbers"]
errors:
  display: 0
  log: true
[/prism]

The **Errors** section determines how Grav handles error display and logging.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **display:** | Determines how errors are displayed. Enter either `1` for the full backtrace, `0` for Simple Error, or `-1` for System Error |
| **log:** | Log errors to `/logs` folder. Can be set to `true` or `false` |
[/div]

### Log

[prism classes="language-yaml line-numbers"]
log:
  handler: file
  syslog:
    facility: local6
[/prism]

The **Log** section allows you to configure alternate logging capabilities for Grav.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **handler:** | Log handler. Currently supported: `file` \| `syslog` |
| **syslog:** | |
| ... **facility:** | Syslog facilities output |
[/div]

### Debugger

[prism classes="language-yaml line-numbers"]
debugger:
  enabled: false
  shutdown:
    close_connection: true
[/prism]

The **Debugger** section gives you the ability to activate Grav's debugger. A useful tool during development.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **enabled:** | Enable Grav debugger and following settings. Can be set to `true` or `false` |
| **shutdown:** | |
| ... **close_connection:** | Close the connection before calling `onShutdown()`. `false` for debugging |
[/div]

### Images

[prism classes="language-yaml line-numbers"]
images:
  default_image_quality: 85
  cache_all: false
  cache_perms: '0755'
  debug: false
  auto_fix_orientation: false
  seofriendly: false
[/prism]

The **Images** section gives you the ability to set the default image quality images are resampled to, as well as to control image caching and debugging features.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **default_image_quality:** | Default image quality to use when resampling images. For example: `85` = 85% |
| **cache_all:** | Cache all images by default. Can be set to `true` or `false` |
| **cache_perms:** | **Must be in quotes!** Default cache folder perms. Usually `'0755'` or `'0775'` |
| **debug:** | Show an overlay over images indicating the pixel depth of the image when working with retina, for example. Can be set to `true` or `false` |
| **auto_fix_orientation:** | Try to automatically fix images uploaded with non-standard rotation |
| **seofriendly:** | SEO-friendly processed image names |
[/div]


### Media

[prism classes="language-yaml line-numbers"]
media:
  enable_media_timestamp: false
  unsupported_inline_types: []
  allowed_fallback_types: []
  auto_metadata_exif: false
[/prism]

The **Media** section handles the configuration options for settings related to the handling of media files. This includes timestamp display, upload size, and more.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **enable_media_timestamp:** | Enable media timetsamps |
| **unsupported_inline_types:** | Array of supported media types to try to display inline. These file types are placed within `[]` brackets |
| **allowed_fallback_types:** | Array of allowed media types of files found if accessed via Page route. These file types are placed within `[]` brackets |
| **auto_metadata_exif:** | Automatically create metadata files from Exif data where possible |
[/div]

### Session

[prism classes="language-yaml line-numbers"]
session:
  enabled: true
  initialize: true
  timeout: 1800
  name: grav-site
  uniqueness: path
  secure: false
  httponly: true
  split: true
  path:
[/prism]

These options determine session properties for your site.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **enabled:** | Enable Session support. Can be set to `true` or `false` |
| **initialize:** | Initialize session from Grav (if `false`, plugin needs to start the session) |
| **timeout:** | Timeout in seconds. For example: `1800` |
| **name:** | Name prefix of the session cookie. Use alphanumeric, dashes or underscores only. Do not use dots in the session name. For example: `grav-site` |
| **uniqueness:** | Should sessions be `path` based or `security.salt` based |
| **secure:** | Set session secure. If `true`, indicates that communication for this cookie must be over an encrypted transmission. Enable this only on sites that run exclusively on HTTPS. Can be set to `true` or `false` |
| **httponly:** | Set session HTTP only. If `true`, indicates that cookies should be used only over HTTP, and JavaScript modification is not allowed. Can be set to `true` or `false` |
| **path:** | The path where sessions are stored |
[/div]

### GPM

[prism classes="language-yaml line-numbers"]
gpm:
  releases: stable
  proxy_url:
  method: 'auto'
  verify_peer: true
  official_gpm_only: true
[/prism]

Options in the **GPM** section control Grav's GPM (Grav Package Manager). For example, you can restrict GPM to using official sources and select the method GPM uses to retrieve packages. You can also choose between stable and testing releases, as well as set up a proxy URL.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **releases:** | Set to either `stable` or `testing` to determine if you want to update to the latest stable or testing build |
| **proxy_url:** | Configure a manual proxy URL for GPM. For example: `127.0.0.1:3128` |
| **method:** | Either `'curl'`, `'fopen'` or `'auto'`. `'auto'` will try fopen first and if not available cURL |
| **verify_peer:** | On some systems (Windows mostly) GPM is unable to connect because the SSL certificate cannot be verified. Disabling this setting might help |
| **official_gpm_only:** | By default GPM direct-install will only allow URLs via the official GPM proxy to ensure security, disable this to allow other sources |
[/div]

### Strict Mode

[prism classes="language-yaml line-numbers"]
strict_mode:
  yaml_compat: true
  twig_compat: true
[/prism]

Strict mode allows for a cleaner migration to future versions of Grav by moving to the newer versions of YAML and Twig processors.  These may not be compatible with all 3rd party extensions.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **yaml_compat:** | Enables YAML backwards compatibility |
| **twig_compat:** | Enables deprecated Twig autoescape setting |
[/div]

[version=16]
### Accounts

[prism classes="language-yaml line-numbers"]
accounts:
  type: data
  storage: file
[/prism]

Accounts is a new setting for 1.6 that allows you to try out the new experimental Flex Users.  This basically means that Users are stored as Flex objects allowing more power and performance.

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **type:** | Account type: `data` or `flex` |
| **storage:** | Flex storage type: `file` or `folder` |
[/div]

!! You do not need to copy the **entire** configuration file to override it, you can override as little or as much as you like.  Just ensure you have the **exact same naming structure** for the particular setting you want to override.
[/version]

## Site Configuration

As well as the `system.yaml` file, Grav also provides a default `site.yaml` configuration file that is used to set some front-end specific configuration such as author name, author email, as well as some key taxonomy settings.  You can override these in the same way as you would the system.yaml by providing your own configuration file in `user/config/site.yaml`. You can also use this file to put in arbitrary configuration options that you may want to reference from your content or templates.

The default `system/config/site.yaml` file that ships with Grav looks something like this:

[prism classes="language-yaml line-numbers"]
title: Grav                                 # Name of the site
default_lang: en                            # Default language for site (potentially used by theme)

author:
  name: John Appleseed                      # Default author name
  email: 'john@example.com'                 # Default author email

taxonomies: [category,tag]                  # Arbitrary list of taxonomy types

metadata:
  description: 'My Grav Site'               # Site description

summary:
  enabled: true                             # enable or disable summary of page
  format: short                             # long = summary delimiter will be ignored; short = use the first occurrence of delimiter or size
  size: 300                                 # Maximum length of summary (characters)
  delimiter: ===                            # The summary delimiter

redirects:
#  '/redirect-test': '/'                    # Redirect test goes to home page
#  '/old/(.*)': '/new/$1'                   # Would redirect /old/my-page to /new/my-page

routes:
#  '/something/else': '/blog/sample-3'      # Alias for /blog/sample-3
#  '/new/(.*)': '/blog/$1'                  # Regex any /new/my-page URL to /blog/my-page Route

blog:
  route: '/blog'                            # Custom value added (accessible via site.blog.route)

#menu:                                      # Menu Example
#    - text: Source
#      icon: github
#      url: https://github.com/getgrav/grav
#    - icon: twitter
#      url: http://twitter.com/getgrav
[/prism]

Let's break down the elements of this sample file:

[div class="table-keycol"]
| Property | Description |
| -------- | ----------- |
| **title:** | The title is a simple string variable that can be referenced whenever you want to display the name of this site |
| **author:** | |
| ... **name:** | The name of the author of the site, that can be referenced whenever you need it |
| ... **email:** | A default email for use in your site |
| **taxonomies:** | An arbitrary list of high-level types that you can use to organize your content.  You can assign content to specific taxonomy types, for example, categories or tags. Feel free to edit, or add your own |
| **metadata:** | Set default metadata for all your pages, see the [content page headers](../../content/headers) section for more details |
| **summary:** | |
| ... **size:** | A variable to override the default number of characters that can be used to set the summary size when displaying a portion of content |
| **routes:** | This is a basic map that can provide simple URL alias capabilities in Grav.  If you browse to `/something/else` you will actually be sent to `/blog/sample-3`. Feel free to edit, or add your own as needed. **Regex Replacements** (`(.*) - $1`) are now supported at the end of route aliases.  You should put these at the bottom of the list for optimal performance |
| **(custom options)** | You can create any option you like in this file and a good example is the `blog: route: '/blog'` option that is accessible in your Twig templates with `system.blog.route` |
[/div]

!! For most people, the most important element of this file is the `Taxonomy` list.  The taxonomies in this list **must** be defined here if you wish to use them in your content.

## Security

In Grav 1.5 we introduced a new `system/config/security.yaml` file that sets some sensible defaults and is used by the Admin plugin when **Saving** content[version=16], as well in the new **Reports** section of **Tools**[/version].

The default configuration looks like this:

[prism classes="language-yaml line-numbers"]
xss_whitelist: [admin.super]
xss_enabled:
    on_events: true
    invalid_protocols: true
    moz_binding: true
    html_inline_styles: true
    dangerous_tags: true
xss_invalid_protocols:
    - javascript
    - livescript
    - vbscript
    - mocha
    - feed
    - data
xss_dangerous_tags:
    - applet
    - meta
    - xml
    - blink
    - link
    - style
    - script
    - embed
    - object
    - iframe
    - frame
    - frameset
    - ilayer
    - layer
    - bgsound
    - title
    - base
uploads_dangerous_extensions:
    - php
    - html
    - htm
    - js
    - exe
[/prism]

If you wish to make any changes to these settings, you should copy this file to `user/config/security.yaml` and make edits there.

## Other Configuration Settings and Files

User configuration is completely optional. You can override as little or as much of the default settings as you need. This applies to both the system, site, and any plugin configurations in your site.

You are also not limited to the `user/config/system.yaml` or the `user/config/site.yaml` files as described above. You can create any arbitrary `.yaml` configuration file in the `user/config` folder you wish and it will get picked up by Grav automatically.

As an example if the new configuration file is named `user/config/data.yaml` and a yaml variable in this file is called count:

```
count: 39
```

The variable would be accessed in your Twig template by using the following syntax:

```
{{ config.data.count }}
```

It would also be accessible via PHP from any plugin with the code:

```
$count_var = Grav::instance()['config']->get('data.count');
```

! You can also provide a custom blueprint to enable your custom file to be editable in the admin plugin. Check out the relevant [recipe in the Admin Cookbook section](/cookbook/admin-recipes#add-a-custom-yaml-file).

### Config Variable Namespacing

Paths to the configuration files will be used as a **namespace** for your configuration options.

Alternatively, you can put all the options into one file and use YAML structures to specify the hierarchy for your configuration options. This namespacing is built from a combination of the **path + filename + option name**.

For example: An option such as `author: Frank Smith` in file `plugins/myplugin.yaml` could be accessible via: `plugins.myplugin.author`. However, you could also have a `plugins.yaml` file and in that file have an option name called `myplugin: author: Frank Smith` and it would still be reachable by the same `plugins.myplugin.author` namespace.

Some example configuration files could be structured:

[div class="table-keycol"]
| File | Description |
| -------- | ----------- |
| **user/config/system.yaml**           | Global system configuration file                  |
| **user/config/site.yaml**             | A site-specific configuration file                |
| **user/config/plugins/myplugin.yaml** | Individual configuration file for myplugin plugin |
| **user/config/themes/mytheme.yaml**   | Individual configuration file for mytheme theme   |
[/div]

!! Having a namespaced configuration file will override or mask all options having the same path in the default configuration files

### Plugins Configuration

Most **plugins** will come with their own YAML configuration file. We recommend copying this file to the `user/config/plugins/` directory rather than editing configuration options directly to the file located in the plugin's directory. Doing this will ensure that an update to the plugin will not overwrite your settings, and keep all of your configurable options in one, convenient place.

If you have a plugin called `user/plugins/myplugin` that has a configuration file called `user/plugins/myplugin/myplugin.yaml` then you would copy this file to `user/config/plugins/myplugin.yaml` and edit the file there.

The YAML file that exists within the plugin's primary directory will act as a fallback. Any settings listed there and not in the User folder's copy will be picked up and used by Grav.

### Themes Configuration

The same rules for **themes** apply as they did for plugins.  So if you have a theme called `user/themes/mytheme` that has a configuration file called `user/themes/mytheme/mytheme.yaml` then you would copy this file to `user/config/themes/mytheme.yaml` and edit the file there.
