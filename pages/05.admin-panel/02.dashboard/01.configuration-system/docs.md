---
title: Configuration (System)
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/configuration-system'
process:
    twig: true
---

![Admin Configuration](configuration.png?width=2530&classes=shadow)

The **Configuration** page gives you access to your site's **System** and **Site** configuration settings. Additionally, you can view a breakdown of your server's properties in a number of areas including PHP, server environment, and other various components that determine how your site operates.

!! The Configuration requires an `access.admin.super` or `access.admin.configuration` access level.

The **System** tab enables you to customize the settings found in the `/user/config/system.yaml` file. These settings affect how many of the primary system-related features of Grav operate. The site's home page, caching settings, and more can be configured here.

These settings are separated into several sections, each focusing on a specific aspect of Grav's operation.

Below is a breakdown of the different configuration sections that appear in the **System** tab.

### Content

![Admin Configuration](configuration-system-content.png?width=1594&classes=shadow)

This section is where you set the basic properties of content handling for your site. The home page, default theme, and various other content display options are set here.

[div class="table table-striped table-keycol"]
| Option                      | Description                                                                |
| :-----                      | :-----                                                                     |
| **Home Page**               | Select the page you wish to have appear as the home page for your site.    |
| **Default Theme**           | Sets the primary default theme used in your site.                          |
| **Process**                 | Control how pages are processed. Can be set per-page rather than globally. |
| **Timezone**                | Override the server's default timezone.                                    |
| **Short Date Format**       | Set the short date format that can be used by themes.                      |
| **Long Date Format**        | Set the long date format that can be used by themes.                       |
| **Default Ordering**        | Pages in a list will render using this order unless it is overridden.      |
| **Default Order Direction** | The direction of pages in a list.                                          |
| **Default Page Count**      | Default maximum pages count in a list.                                     |
| **Date-based Publishing**   | Automatically (un)publish posts based on their date.                       |
| **Events**                  | Enable or Disable specific events.  Disabling these can break plugins.     |
| **Redirect Default Route**  | Automatically redirect to a page's default route.                          |
[/div]

### Languages

![Admin Configuration](configuration-system-languages.png?width=1662&classes=shadow)

Multilanguage features are set in this section.

[div class="table table-striped table-keycol"]
| Option                             | Description                                                               |
| :-----                             | :-----                                                                    |
| **Supported**                      | Comma separated list of 2-letter language codes (for example 'en,fr,de'). |
| **Translations Enabled**           | Support translations in Grav, plugins and extensions.                     |
| **Translations Fallback**          | Fallback through supported translations if active language doesn't exist. |
| **Active Language in Section**     | Store the active language in the session.                                 |
| **Home Redirect Include Language** | Include language in home redirect (/en).                                  |
| **Home Redirect Include Route**    | Home redirect include route.                                              |
[/div]

### HTTP Headers

![Admin Configuration](configuration-system-http.png?width=1336&classes=shadow)

HTTP header options can be set in this section. This is useful for browser-based caching and optimization.

[div class="table table-striped table-keycol"]
| Option                   | Description                                                                     |
| :-----                   | :-----                                                                          |
| **Expires**              | Sets the expires header. The value is in seconds.                               |
| **Last Modified**        | Sets the last modified header that can help optimize proxy and browser caching. |
| **ETag**                 | Sets the etag header to help identify when a page has been modified.            |
| **Vary Accept Encoding** | Sets the *Vary: Accept Encoding* header to help with proxy and CDN caching.     |
[/div]

### Markdown

![Admin Configuration](configuration-system-markdown.png?width=932&classes=shadow)

Markdown makes up the bulk of Grav's page content. This section gives you options to enable Markdown Extra, as well as to set how Grav handles Markdown.

[div class="table table-striped table-keycol"]
| Option               | Description                                                                                   |
| :-----               | :-----                                                                                        |
| **Markdown Extra**   | Enable default support for [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/). |
| **Auto Line Breaks** | Enable support for automatic line breaks in markdown.                                         |
| **Auto URL Links**   | Enable automatic conversion of URLs into HTML hyperlinks.                                     |
| **Escape Markup**    | Escape markup tags into HTML entities.                                                        |
[/div]

### Caching

![Admin Configuration](configuration-system-caching.png?width=1364&classes=shadow)

Grav's integrated caching feature helps make it one of the fastest flat-file CMS options out there. You can configure your site's primary caching functions in this section.

[div class="table table-striped table-keycol"]
| Option                 | Description                                                                                 |
| :-----                 | :-----                                                                                      |
| **Caching**            | Global ON/OFF switch to enable/disable Grav caching.                                        |
| **Cache Check Method** | Sets the cache check method. The options are **File**, **Folder**, and **None**.            |
| **Cache Driver**       | Choose which cache driver Grav should use. 'Auto Detect' attempts to find the best for you. |
| **Cache Prefix**       | An identifier for part of the Grav key.  Don't change unless you know what you're doing.    |
| **Lifetime**           | Sets the cache lifetime in seconds. 0 = infinite.                                           |
| **Gzip Compression**   | Enable GZip compression of the Grav page for increased performance.                         |
[/div]

### Twig Templating

![Admin Configuration](configuration-system-twig.png?width=906&classes=shadow)

This section focuses on Grav's Twig templating feature. You can set Twig caching, debug, and change detection settings here.

[div class="table table-striped table-keycol"]
| Option                   | Description                                                                                   |
| :-----                   | :-----                                                                                        |
| **Twig Caching**         | Control the Twig caching mechanism. Leave this enabled for best performance.                  |
| **Twig Debug**           | Allows the option of not loading the Twig Debugger extension.                                 |
| **Detect Changes**       | Twig will automatically recompile the Twig cache if it detects any changes in Twig templates. |
| **Autoescape Variables** | Autoescapes all variables. This will break your site most likely.                             |
[/div]

### Assets

![Admin Configuration](configuration-system-assets.png?width=1502&classes=shadow)

This section deals with assets handling, including CSS and JavaScript assets.

[div class="table table-striped table-keycol"]
| Option                          | Description                                                                     |
| :-----                          | :-----                                                                          |
| **CSS Pipeline**                | The CSS pipeline is the unification of multiple CSS resources into one file.    |
| **CSS Minify**                  | Minify the CSS during pipelining.                                               |
| **CSS Minify Windows Override** | Minify Override for Windows platforms. False by default due to ThreadStackSize. |
| **CSS Rewrite**                 | Rewrite any CSS relative URLs during pipelining.                                |
| **JavaScript Pipeline**         | The JS pipeline is the unification of multiple JS resources into one file.      |
| **JavaScript Minify**           | Minify the JS during pipelining.                                                |
| **Enable Timestamps on Assets** | Enable asset timestamps.                                                        |
| **Collections**                 | Add individual asset collections.                                               |
[/div]

### Error Handler

![Admin Configuration](configuration-system-error.png?width=1336&classes=shadow)

You can set how Grav handles error reporting and display here. This is a useful tool to have during site development.

[div class="table table-striped table-keycol"]
| Option            | Description                              |
| :-----            | :-----                                   |
| **Display Error** | Display full backtrace-style error page. |
| **Log Errors**    | Log errors to /logs folder.              |
[/div]

### Debugger

![Admin Configuration](configuration-system-debugger.png?width=950&classes=shadow)

Like error handling, Grav's integrated debugging tools give you the ability to locate and troubleshoot issues. This is especially useful during development.

[div class="table table-striped table-keycol"]
| Option                        | Description                                                            |
| :-----                        | :-----                                                                 |
| **Debugger**                  | Enable Grav debugger and following settings.                           |
| **Debug Twig**                | Enable debugging of Twig templates.                                    |
| **Shutdown Close Connection** | Close the connection before calling onShutdown(). false for debugging. |
[/div]

### Media

![Admin Configuration](configuration-system-media.png?width=1670&classes=shadow)

This section determines how Grav handles media content. Image quality and other media handling options are configured here.

[div class="table table-striped table-keycol"]
| Option                         | Description                                                                                               |
| :-----                         | :-----                                                                                                    |
| **Default Image Quality**      | Default image quality to use when resampling or caching images (85%).                                     |
| **Cache All Images**           | Run all images through Grav's cache system even if they have no media manipulations.                      |
| **Image Debug Watermark**      | Show an overlay over images indicating the pixel depth of the image when working with Retina for example. |
| **Enable Timestamps on Media** | Appends a timestamp based on last modified date to each media item.                                       |
[/div]

!! Caching images that have already been optimised (outside of Grav) could result in the output file being a much larger filesize than the original. This is due to a bug in the Gregwar image library and not directly related to Grav (see this [open issue](https://github.com/Gregwar/Image/issues/115) for more information). The alternative is to set "Cache All Images" to No

### Session

![Admin Configuration](configuration-system-session.png?width=1184&classes=shadow)

This section gives you the ability to enable session support, set timeout limits, and the name of the session cookie used to handle this information.

[div class="table table-striped table-keycol"]
| Option      | Description                                                                                                                                  |
| :-----      | :-----                                                                                                                                       |
| **Enable**  | Enable session support within Grav.                                                                                                          |
| **Timeout** | Sets the session timeout in seconds.                                                                                                         |
| **Name**    | An identifier used to form the name of the session cookie. Use alphanumeric, dashes or underscores only. Do not use dots in the session name |
[/div]

### Advanced

![Admin Configuration](configuration-system-advanced.png?width=1360&classes=shadow)

This section contains advanced system options.

[div class="table table-striped table-keycol"]
| Option                  | Description                                                                |
| :-----                  | :-----                                                                     |
| **Absolute URLs**       | Absolute or relative URLs for `base_url`.                                  |
| **Parameter Separator** | Separater for passed parameters that can be changed for Apache on Windows. |
[/div]