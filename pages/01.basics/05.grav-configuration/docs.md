---
title: Configuration
taxonomy:
    category: docs
---

All Grav configuration files are written in [YAML syntax](../../advanced/yaml) with a `.yaml` file extension.  YAML is very intuitive which makes it very easy to both read and write, however, you can check out the [YAML page in the Advanced chapter](../../advanced/yaml) to get a complete understanding of the syntax available.

## System Configuration

Grav focuses on making things as easy as possible for the user, and the same goes for configuration.  Grav comes with some sensible default options and these are contained in a file that resides in the `system/config/system.yaml` file.

However, **you should never change this file**, rather any configuration changes you need to make should be stored in a file called `user/config/system.yaml`.  Any setting in this file with the same structure and naming will override the setting provided in the default system configuration file.

>>>> Generally speaking you should **NEVER** change anything in the `system/` folder.  All things the user does (creating content, installing plugins, editing configuration, etc.) should be done in the `user/` folder.  This way it allows simpler upgrading and also keeps your changes all in one location for backing up, synchronizing, etc.

Here's the default `system/config/system.yaml` file:

```ruby
absolute_urls: false                   # Absolute or relative URLs for `base_url`
timezone: ''                           # Valid values: http://php.net/manual/en/timezones.php
default_locale:                        # Default locale (defaults to system)
param_sep: ':'                         # Parameter separator, use ';' for Apache on windows

languages:
  supported: []                        # List of languages supported. eg: [en, fr, de]
  translations: true                   # Enable translations by default
  translations_fallback: true          # Fallback through supported translations if active lang doesn't exist
  session_store_active: false          # Store active language in session
  home_redirect:
    include_lang: true                 # Include language in home redirect (/en)
    include_route: false               # Include route in home redirect (/blog)
  http_accept_language: false          # Attempt to set the language based on http_accept_language header in the browser
  override_locale: false               # Override the default or system locale with language specific one

home:
  alias: '/home'                       # Default path for home, ie /

pages:
  theme: antimatter                    # Default theme (defaults to "antimatter" theme)
  order:
    by: default                        # Order pages by "default", "alpha" or "date"
    dir: asc                           # Default ordering direction, "asc" or "desc"
  list:
    count: 20                          # Default item count per page
  dateformat:
    default:                           # The default date format Grav expects in the `date: ` field
    short: 'jS M Y'                    # Short date format
    long: 'F jS \a\t g:ia'             # Long date format
  publish_dates: true                  # automatically publish/unpublish based on dates
  process:
    markdown: true                     # Process Markdown
    twig: false                        # Process Twig
  events:
    page: true                         # Enable page level events
    twig: true                         # Enable twig level events
  markdown:
    extra: false                       # Enable support for Markdown Extra support (GFM by default)
    auto_line_breaks: false            # Enable automatic line breaks
    auto_url_links: false              # Enable automatic HTML links
    escape_markup: false               # Escape markup tags into entities
    special_chars:                     # List of special characters to automatically convert to entities
      '>': 'gt'
      '<': 'lt'
  types: [txt,xml,html,json,rss,atom]  # list of valid page types
  expires: 604800                      # Page expires time in seconds (604800 seconds = 7 days)
  last_modified: false                 # Set the last modified date header based on file modifcation timestamp
  etag: false                          # Set the etag header tag
  vary_accept_encoding: false          # Add `Vary: Accept-Encoding` header
  redirect_default_route: false        # Automatically redirect to a page's default route
  redirect_trailing_slash:  true       # Handle automatically or 301 redirect a trailing / URL
  ignore_files: [.DS_Store]            # Files to ignore in Pages
  ignore_folders: [.git, .idea]        # Folders to ignore in Pages

cache:
  enabled: true                        # Set to true to enable caching
  check:
    method: file                       # Method to check for updates in pages: file|folder|none
  driver: auto                         # One of: auto|file|apc|xcache|memcache|wincache
  prefix: 'g'                          # Cache prefix string (prevents cache conflicts)
  lifetime: 604800                     # Lifetime of cached data in seconds (0 = infinite)
  gzip: false                          # GZip compress the page output

twig:
  cache: true                          # Set to true to enable twig caching
  debug: false                         # Enable Twig debug
  auto_reload: true                    # Refresh cache on changes
  autoescape: false                    # Autoescape Twig vars
  undefined_functions: true            # Allow undefined functions
  undefined_filters: true              # Allow undefined filters

assets:                                # Configuration for Assets Manager (JS, CSS)
  css_pipeline: false                  # The CSS pipeline is the unification of multiple CSS resources into one file
  css_minify: true                     # Minify the CSS during pipelining
  css_minify_windows: false            # Minify Override for Windows platforms. False by default due to ThreadStackSize
  css_rewrite: true                    # Rewrite any CSS relative URLs during pipelining
  js_pipeline: false                   # The JS pipeline is the unification of multiple JS resources into one file
  js_minify: true                      # Minify the JS during pipelining
  enable_asset_timestamp: false        # Enable asset timestamps
  collections:
    jquery: system://assets/jquery/jquery-2.1.4.min.js

errors:
  display: true                        # Display full backtrace-style error page
  log: true                            # Log errors to /logs folder

debugger:
  enabled: false                       # Enable Grav debugger and following settings
  shutdown:
    close_connection: true             # Close the connection before calling onShutdown(). false for debugging

images:
  default_image_quality: 85            # Default image quality to use when resampling images (85%)
  cache_all: false                     # Cache all image by default
  debug: false                         # Show an overlay over images indicating the pixel depth of the image when working with retina for example

media:
  enable_media_timestamp: false        # Enable media timetsamps
  upload_limit: 0                      # Set maximum upload size in bytes (0 is unlimited)
  unsupported_inline_types: []         # Array of unsupported media file types to try to display inline

session:
  enabled: true                        # Enable Session support
  timeout: 1800                        # Timeout in seconds
  name: grav-site                      # Name prefix of the session cookie
```

>>> You do not need to copy the **entire** configuration file to override it, you can override as little or as much as you like.  Just ensure you have the **exact same naming structure** for the particular setting you want to override.

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
  /redirect-test: /                         # Redirect test goes to home page
  /old/(.*): /new/$1                        # Would redirect /old/my-page to /new/my-page

routes:
  /something/else: '/blog/sample-3'         # Alias for /blog/sample-3
  /new/(.*): '/blog/$1'                     # Regex any /new/my-page URL to /blog/my-page Route

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

| Field                | Description                                                                                                                                                                                                                                                                                                                                             |
| :----------          | :----------                                                                                                                                                                                                                                                                                                                                             |
| **title:**           | The title is a simple string variable that can be referenced whenever you want to display the name of this site.                                                                                                                                                                                                                                        |
| **author: name:**    | The name of the author of the site, that can be referenced whenever you need it.                                                                                                                                                                                                                                                                        |
| **author: email:**   | A default email for use in your site.                                                                                                                                                                                                                                                                                                                   |
| **taxonomies:**      | An arbitrary list of high-level types that you can use to organize your content.  You can assign content to specific taxonomy types, for example, categories or tags. Feel free to edit, or add your own.                                                                                                                                               |
| **metadata:**        | Set default metadata for all your pages, see the [content page headers](../../content/headers) section for more details                                                                                                                                                                                                                                 |
| **summary: size:**   | A variable to override the default number of characters that can be used to set the summary size when displaying a portion of content.                                                                                                                                                                                                                  |
| **routes:**          | This is a basic map that can provide simple URL alias capabilities in Grav.  If you browse to `/something/else` you will actually be sent to `/blog/sample-3`. Feel free to edit, or add your own as needed. **Regex Replacements** (`(.*) - $1`) are now supported at the end of route aliases.  You should put these at the bottom of the list for optimal performance |
| **(custom options)** | You can create any option you like in this file and a good example is the `blog: route: '/blog'` option that is accessbile in your Twig templates with `system.blog.route`                                                                                                                                                                                     |

>>> For most people, the most important element of this file is the `Taxonomy` list.  The taxonomies in this list **must** be defined here if you wish to use them in your content.

## Other Configuration Settings and Files

User configuration is completely optional. You can override as little or as much of the default settings as you need. This applies to both the system, site, and any plugin configurations in your site.

You are also not limited to the `user/config/system.yaml` or the `user/config/site.yaml` files as described above. You can create any arbitrary `.yaml` configuration file in the `user/config` folder you wish and it will get picked up by Grav automatically.

Paths to the configuration files will be used as a **namespace** for your configuration options.

Alternatively, you can put all the options into one file and use YAML structures to specify the hierarchy for your configuration options. This namespacing is built from a combination of the **path + filename + option name**.

For example: An option such as `author: Frank Smith` in file `plugins/myplugin.yaml` could be accessible via: `plugins.myplugin.author`. However, you could also have a `plugins.yaml` file and in that file have a option name called `myplugin: author: Frank Smith` and it would still be reachable by the same `plugins.myplugin.author` namespace.

Some example configuration files could be structured:

| Filename                              | Description                                       |
| :----------                           | :----------                                       |
| **user/config/system.yaml**           | Global system configuration file                  |
| **user/config/site.yaml**             | A site-specific configuration file                |
| **user/config/plugins/myplugin.yaml** | Individual configuration file for myplugin plugin |

>>> Having a namespaced configuration file will override or mask all options having the same path in the default configuration files

Most plugins will come with their own YAML configuration file. We recommend copying this file to the **user/config/plugins/** directory rather than editing configuration options directly to the file located in the plugin's directory. Doing this will ensure that an update to the plugin will not overwrite your settings, and keep all of your configurable options in one, convenient place.

The YAML file that exists within the plugin's primary directory will act as a fallback. Any settings listed there and not in the User folder's copy will be picked up and used by Grav.
