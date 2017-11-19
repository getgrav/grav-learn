---
title: Configuration
taxonomy:
    category: docs
---

All Grav configuration files are written in [YAML syntax](../../advanced/yaml) with a `.yaml` file extension.  YAML is very intuitive which makes it very easy to both read and write, however, you can check out the [YAML page in the Advanced chapter](../../advanced/yaml) to get a complete understanding of the syntax available.

## System Configuration

Grav focuses on making things as easy as possible for the user, and the same goes for configuration.  Grav comes with some sensible default options and these are contained in a file that resides in the `system/config/system.yaml` file.

However, **you should never change this file**, rather any configuration changes you need to make should be stored in a file called `user/config/system.yaml`.  Any setting in this file with the same structure and naming will override the setting provided in the default system configuration file.

!!!! Generally speaking you should **NEVER** change anything in the `system/` folder.  All things the user does (creating content, installing plugins, editing configuration, etc.) should be done in the `user/` folder.  This way it allows simpler upgrading and also keeps your changes all in one location for backing up, synchronizing, etc.

Here are the variables found in the default `system/config/system.yaml` file:

### Basic Options

```yaml
absolute_urls: false
timezone: ''
default_locale:
param_sep: ':'
wrapped_site: false
reverse_proxy_setup: false
force_ssl: false
custom_base_url: ''
```

These configuration options do not appear within their own child sections. They're general options that affect the way the site operates, its timezone, and base URL.

* **absolute_urls**: Absolute or relative URLs for `base_url`.
* **timezone**: Valid values can be found [here](http://php.net/manual/en/timezones.php).
* **default_locale**: Default locale (defaults to system)
* **param_sep**: This is used for Grav parameters in the URL.  Don't change this unless you know what you are doing.  Grav > `1.1.16` automatically sets this to `;` for users running Apache web server on Windows.
* **wrapped_site**: For themes/plugins to know if Grav is wrapped by another platform. Can be `true` or `false`.
* **reverse_proxy_setup**: Running in a reverse proxy scenario with different webserver ports than proxy. Can be `true` or `false`.
* **force_ssl**: If enabled, Grav forces to be accessed via HTTPS (NOTE: Not an ideal solution). Can be `true` or `false`.
* **custom_base_url**: Manually set the base_url here.

### languages

```yaml
languages:
  supported: []
  include_default_lang: true
  translations: true
  translations_fallback: true
  session_store_active: false
  http_accept_language: false
  override_locale: false
```

The **Languages** area of the file establishes the site's language settings. This includes which language(s) are supported, designation of the default language in the URLs, and translations. Here is the breakdown for the **Languages** area of the system configuration file:

* **supported**: List of languages supported. eg: `[en, fr, de]`
* **include_default_lang**: Include the default lang prefix in all URLs. Can be `true` or `false`.
* **translations**: Enable translations by default. Can be `true` or `false`.
* **translations_fallback**: Fallback through supported translations if active lang doesn't exist. Can be `true` or `false`.
* **session_store_active**: Store active language in session. Can be `true` or `false`.
* **http_accept_language**: Attempt to set the language based on http_accept_language header in the browser. Can be `true` or `false`.
* **override_locale**: Override the default or system locale with language specific one. Can be `true` or `false`.

### home

```yaml
home:
  alias: '/home'
  hide_in_urls: false
```

The **Home** section is where you set the default path for the site's home page. You can also choose to hide the home route in URLs.

* **alias**: Default path for home, ie: `/home` or `/`.
* **hide_in_urls**: Hide the home route in URLs. Can be `true` or `false`.

### pages

```yaml
pages:
  theme: antimatter
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
  last_modified: false
  etag: false
  vary_accept_encoding: false
  redirect_default_route: false
  redirect_default_code: 302
  redirect_trailing_slash: true
  ignore_files: [.DS_Store]
  ignore_folders: [.git, .idea]
  ignore_hidden: true
  url_taxonomy_filters: true
  frontmatter:
    process_twig: false
    ignore_fields: ['form','forms']
```

The **Pages** section of the `system/config/system.yaml` file is where you set a lot of the main theme-related settings. For example, this is where you set the theme used to render the site, page ordering, twig and markdown processing defaults, and more. This is where most of the decisions that affect the way your pages are rendered are made.

* **theme**: This is where you set the default theme. This defaults to `antimatter`.
* **order**:
    - **by**: Order pages by `default`, `alpha` or `date`.
    - **dir**: Default ordering direction, `asc` or `desc`.
* **list**:
    - **count**: Default item count per page.
* **dateformat**:
    - **default**: The default date format Grav expects in the `date: ` field.
    - **short**: Short date format. Example: `'jS M Y'`
    - **long**: Long date format. Example: `'F jS \a\t g:ia'`
* **publish_dates**: Automatically publish/unpublish based on dates. Can be set `true` or `false`.
* **process**:
    - **markdown**: Enable or disable the processing of markdown on the front end. Can be set `true` or `false`.
    - **twig**: Enable or disable the processing of twig on the front end. Can be set `true` or `false`.
* **twig_first**: Process Twig before markdown when processing both on a page. Can be set `true` or `false`.
* **never_cache_twig**: Enabling this will allow you to add a processing logic that can change dynamically on each page load, rather than caching the results and storing it for each page load. This can be enabled/disabled site-wide in the **system.yaml**, or on a specific page. Can be set `true` or `false`.
* **events**:
    - **page**: Enable page-level events. Can be set `true` or `false`.
    - **twig**: Enable Twig-level events. Can be set `true` or `false`.
* **markdown**:
    - **extra**: Enable support for Markdown Extra support (GitHub-flavored Markdown (GFM) by default). Can be set `true` or `false`.
    - **auto_line_breaks**: Enable automatic line breaks. Can be set `true` or `false`.
    - **auto_url_links**: Enable automatic HTML links. Can be set `true` or `false`.
    - **escape_markup**: Escape markup tags into entities. Can be set `true` or `false`.
    - **special_chars**: List of special characters to automatically convert to entities. Each character consumes a line below this variable. Example: `'>': 'gt'`.
* **types**: List of valid page types. For example: `[txt,xml,html,htm,json,rss,atom]`
* **append_url_extension**: Append page's extension in Page URLs (e.g. `.html` results in **/path/page.html**).
* **expires**: Page expires time in seconds (604800 seconds = 7 days) (`no cache` is also possible).
* **last_modified**: Set the last modified date header based on file modification timestamp. Can be set `true` or `false`.
* **etag**: Set the etag header tag. Can be set to `true` or `false`.
* **vary_accept_encoding**: Add `Vary: Accept-Encoding` header. Can be set to `true` or `false`.
* **redirect_default_route**: Automatically redirect to a page's default route. Can be set to `true` or `false`.
* **redirect_default_code**: Default code to use for redirects. For example: `302`.
* **redirect_trailing_slash**: Handle automatically or 302 redirect a trailing / URL.
* **ignore_files**: Files to ignore in Pages. Example: `[.DS_Store] `.
* **ignore_folders**: Folders to ignore in Pages. Example: `[.git, .idea]`
* **ignore_hidden**: Ignore all Hidden files and folders. Can be set to `true` or `false`.
* **url_taxonomy_filters**: Enable auto-magic URL-based taxonomy filters for page collections. Can be set to `true` or `false`.
* **frontmatter**:
    - **process_twig**: Should the frontmatter be processed to replace Twig variables? Can be set to `true` or `false`.
    - **ignore_fields**: Fields that might contain Twig variables and should not be processed. Example: `['form','forms']`

### cache

```yaml
cache:
  enabled: true
  check:
    method: file
  driver: auto
  prefix: 'g'
  lifetime: 604800
  gzip: false
  allow_webserver_gzip: false
  redis:
    socket: false
```

The **Cache** section is where you can configure the site's caching settings. You can enable, disable, choose the method, and more.

* **enabled**: Set to true to enable caching. Can be set to `true` or `false`.
* **check**:
    - **method**: Method to check for updates in pages. Options: `file`, `folder`, `hash` and `none`. [more details](../../advanced/performance-and-caching#grav-core-caching)
* **driver**: Select a cache driver. Options are: `auto`, `file`, `apc`, `xcache`, `redis`, `memcache`, and `wincache`.
* **prefix**: Cache prefix string (prevents cache conflicts). Example: `g`.
* **lifetime**: Lifetime of cached data in seconds (`0` = infinite). `604800` is 7 days.
* **gzip**: GZip compress the page output. Can be set to `true` or `false`.
* **allow_webserver_gzip**: This option will change the header to `Content-Encoding: identity` allowing gzip to be more reliably set by the webserver although this usually breaks the out-of-process `onShutDown()` capability.  The event will still run, but it won't be out of process, and may hold up the page until the event is complete.

### twig

```yaml
twig:
  cache: true
  debug: true
  auto_reload: true
  autoescape: false
  undefined_functions: true
  undefined_filters: true
  umask_fix: false
```

The **Twig** section gives you a quick set of tools with which to configure Twig on your site for debugging, caching, and optimization.

* **cache**: Set to true to enable Twig caching. Can be set to `true` or `false`.
* **debug**: Enable Twig debug. Can be set to `true` or `false`.
* **auto_reload**: Refresh cache on changes. Can be set to `true` or `false`.
* **autoescape**: Autoescape Twig vars. Can be set to `true` or `false`.
* **undefined_functions**: Allow undefined functions. Can be set to `true` or `false`.
* **undefined_filters**: Allow undefined filters. Can be set to `true` or `false`.
* **umask_fix**: By default Twig creates cached files as 755, fix switches this to 775. Can be set to `true` or `false`.

### assets

```yaml
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
```

The **Assets** section enables you to configure options related to the Assets Manager (JS, CSS).

* **css_pipeline**: The CSS pipeline is the unification of multiple CSS resources into one file. Can be set to `true` or `false`.
* **css_pipeline_include_externals**: Include external URLs in the pipeline by default. Can be set to `true` or `false`.
* **css_pipeline_before_excludes**: Render the pipeline before any excluded files. Can be set to `true` or `false`.
* **css_minify**: Minify the CSS during pipelining. Can be set to `true` or `false`.
* **css_minify_windows**: Minify Override for Windows platforms. False by default due to ThreadStackSize. Can be set to `true` or `false`.
* **css_rewrite**: Rewrite any CSS relative URLs during pipelining. Can be set to `true` or `false`.
* **js_pipeline**: The JS pipeline is the unification of multiple JS resources into one file. Can be set to `true` or `false`.
* **js_pipeline_include_externals**: Include external URLs in the pipeline by default. Can be set to `true` or `false`.
* **js_pipeline_before_excludes**: Render the pipeline before any excluded files. Can be set to `true` or `false`.
* **js_minify**: Minify the JS during pipelining. Can be set to `true` or `false`.
* **enable_asset_timestamp**: Enable asset timestamps. Can be set to `true` or `false`.
* **collections**: This contains collections, designated as sub-items. For example: `jquery: system://assets/jquery/jquery-2.x.min.js`

### errors

```yaml
errors:
  display: 0
  log: true
```

The **Errors** section determines how Grav handles error display and logging.

* **display**: Determines how errors are displayed. Enter either `1` for full backtrace, `0` for Simple Error, or `-1` for System Error.
* **log**: Log errors to `/logs` folder. Can be set to `true` or `false`.

### debugger

```yaml
debugger:
  enabled: false
  shutdown:
    close_connection: true
```

This section gives you the ability to activate Grav's debugger. A useful tool during development.

* **enabled**: Enable Grav debugger and following settings. Can be set to `true` or `false`.
* **shutdown**:
    - **close_connection**: Close the connection before calling `onShutdown()`. `false` for debugging.

### images

```yaml
images:
  default_image_quality: 85
  cache_all: false
  cache_perms: '0755'
  debug: false
  auto_fix_orientation: false
```

This section gives you the ability to set the default image quality images are resampled to, as well as to control image caching and debugging features.

* **default_image_quality**: Default image quality to use when resampling images. For example: `85` = 85%.
* **cache_all**: Cache all image by default. Can be set to `true` or `false`.
* **cache_perms**: MUST BE IN QUOTES!! Default cache folder perms. Usually `'0755'` or `'0775'`
* **debug**: Show an overlay over images indicating the pixel depth of the image when working with retina, for example. Can be set to `true` or `false`.

### media

```yaml
media:
  enable_media_timestamp: false
  unsupported_inline_types: []
  allowed_fallback_types: []
```

The **Media** section handles the configuration options for settings related to the handling of media files. This includes timestamp display, upload size, and more.

* **enable_media_timestamp**: Enable media timetsamps.
* **unsupported_inline_types**: Array of supported media types to try to display inline. These file types are placed within `[]` brackets.
* **allowed_fallback_types**: Array of allowed media types of files found if accessed via Page route. These file types are placed within `[]` brackets.

### session

```yaml
session:
  enabled: true
  timeout: 1800
  name: grav-site
  secure: false
  httponly: true
  split: true
  path:
```

These options determine session properties for your site.

* **enabled**: Enable Session support. Can be set to `true` or `false`.
* **timeout**: Timeout in seconds. For example: `1800`.
* **name**: Name prefix of the session cookie. Use alphanumeric, dashes or underscores only. Do not use dots in the session name. For example: `grav-site`.
* **secure**: Set session secure. If `true`, indicates that communication for this cookie must be over an encrypted transmission. Enable this only on sites that run exclusively on HTTPS. Can be set to `true` or `false`.
* **httponly**: Set session HTTP only. If true, indicates that cookies should be used only over HTTP, and JavaScript modification is not allowed. Can be set to `true` or `false`.
* **path**:

### gpm

```yaml
gpm:
  releases: stable
  proxy_url:
  method: 'auto'
  verify_peer: true
  official_gpm_only: true
```

The **GPM** section offers the user options that control how Grav's GPM sources and makes ready updates for your site. You can choose between stable and testing releases, as well as set up a proxy URL.

* **releases**: Set to either `stable` or `testing` to determine if you want to update to the latest stable or testing build.
* **proxy_url**: Configure a manual proxy URL for GPM. For example: `127.0.0.1:3128`.
* **verify_peer**: On some systems (Windows mostly) GPM is unable to connect because the SSL certificate cannot be verified. Disabling this setting might help.
* **official_gpm_only**: By default GPM direct-install will only allow URLs via the official GPM proxy to ensure security, disable this to allow other sources.

!! You do not need to copy the **entire** configuration file to override it, you can override as little or as much as you like.  Just ensure you have the **exact same naming structure** for the particular setting you want to override.


## Site Configuration

As well as the `system.yaml` file, Grav also provides a default `site.yaml` configuration file that is used to set some front-end specific configuration such as author name, author email, as well as some key taxonomy settings.  You can override these in the same way as you would the system.yaml by providing your own configuration file in `user/config/site.yaml`. You can also use this file to put in arbitrary configuration options that you may want to reference from your content or templates.

The default `system/config/site.yaml` file that ships with Grav looks something like this:

```ruby
title: Grav                                 # Name of the site

author:
  name: John Appleseed                      # Default author name
  email: 'john@email.com'                   # Default author email

taxonomies: [category,tag]                  # Arbitrary list of taxonomy types

metadata:
  description: 'My Grav Site'               # Site description

summary:
  enabled: true                             # enable or disable summary of page
  format: short                             # long = summary delimiter will be ignored; short = use the first occurrence of delimiter or size
  size: 300                                 # Maximum length of summary (characters)
  delimiter: ===                            # The summary delimiter

redirects:
#  '/redirect-test': '/'                         # Redirect test goes to home page
#  '/old/(.*)': '/new/$1'                        # Would redirect /old/my-page to /new/my-page

routes:
#  '/something/else': '/blog/sample-3'         # Alias for /blog/sample-3
#  '/new/(.*)': '/blog/$1'                     # Regex any /new/my-page URL to /blog/my-page Route

blog:
  route: '/blog'                            # Custom value added (accessible via system.blog.route)

#menu:                                      # Sample Menu Example
#    - text: Source
#      icon: github
#      url: https://github.com/getgrav/grav
#    - icon: twitter
#      url: http://twitter.com/getgrav
```

Let's break down the elements of this sample file:

| Field                | Description                                                                                                                                                                                                                                                                                                                                                              |
| :-----               | :-----                                                                                                                                                                                                                                                                                                                                                                   |
| **title:**           | The title is a simple string variable that can be referenced whenever you want to display the name of this site.                                                                                                                                                                                                                                                         |
| **author: name:**    | The name of the author of the site, that can be referenced whenever you need it.                                                                                                                                                                                                                                                                                         |
| **author: email:**   | A default email for use in your site.                                                                                                                                                                                                                                                                                                                                    |
| **taxonomies:**      | An arbitrary list of high-level types that you can use to organize your content.  You can assign content to specific taxonomy types, for example, categories or tags. Feel free to edit, or add your own.                                                                                                                                                                |
| **metadata:**        | Set default metadata for all your pages, see the [content page headers](../../content/headers) section for more details                                                                                                                                                                                                                                                  |
| **summary: size:**   | A variable to override the default number of characters that can be used to set the summary size when displaying a portion of content.                                                                                                                                                                                                                                   |
| **routes:**          | This is a basic map that can provide simple URL alias capabilities in Grav.  If you browse to `/something/else` you will actually be sent to `/blog/sample-3`. Feel free to edit, or add your own as needed. **Regex Replacements** (`(.*) - $1`) are now supported at the end of route aliases.  You should put these at the bottom of the list for optimal performance |
| **(custom options)** | You can create any option you like in this file and a good example is the `blog: route: '/blog'` option that is accessible in your Twig templates with `system.blog.route`                                                                                                                                                                                               |

!! For most people, the most important element of this file is the `Taxonomy` list.  The taxonomies in this list **must** be defined here if you wish to use them in your content.

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

## Config Variable Namespacing

Paths to the configuration files will be used as a **namespace** for your configuration options.

Alternatively, you can put all the options into one file and use YAML structures to specify the hierarchy for your configuration options. This namespacing is built from a combination of the **path + filename + option name**.

For example: An option such as `author: Frank Smith` in file `plugins/myplugin.yaml` could be accessible via: `plugins.myplugin.author`. However, you could also have a `plugins.yaml` file and in that file have a option name called `myplugin: author: Frank Smith` and it would still be reachable by the same `plugins.myplugin.author` namespace.

Some example configuration files could be structured:

| Filename                              | Description                                       |
| :-----                                | :-----                                            |
| **user/config/system.yaml**           | Global system configuration file                  |
| **user/config/site.yaml**             | A site-specific configuration file                |
| **user/config/plugins/myplugin.yaml** | Individual configuration file for myplugin plugin |
| **user/config/themes/mytheme.yaml**   | Individual configuration file for mytheme theme   |

!! Having a namespaced configuration file will override or mask all options having the same path in the default configuration files

### Plugins Configuration

Most **plugins will come with their own YAML configuration file. We recommend copying this file to the **user/config/plugins/** directory rather than editing configuration options directly to the file located in the plugin's directory. Doing this will ensure that an update to the plugin will not overwrite your settings, and keep all of your configurable options in one, convenient place.

If you have a plugin called `user/plugins/myplugin` that has a configuration file called `user/plugins/myplugin/myplugin.yaml` then you would copy this file to `user/config/plugins/myplugin.yaml` and edit the file there.

The YAML file that exists within the plugin's primary directory will act as a fallback. Any settings listed there and not in the User folder's copy will be picked up and used by Grav.

### Themes Configuration

The same rules for themes apply as they did for plugins.  So if you have a theme called `user/themes/mytheme` that has a configuration file called `user/themes/mytheme/mytheme.yaml` then you would copy this file to `user/config/themes/mytheme.yaml` and edit the file there.
