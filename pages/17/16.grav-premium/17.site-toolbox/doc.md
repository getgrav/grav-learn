---
title: Site Toolbox
description: Learn how to use the plugins in Site Toolbox
taxonomy:
    category: docs
---

# Site Toolbox

<style>
kbd { 
    display:inline-flex; 
    border-radius: 2px;
    padding: 1rem;
    white-space: nowrap;
    color: #7676f4;
    background: #f1f1fe;
    border: 0;
}

.w-8 { width: 4rem; }
.w-12 { width: 6rem; }
.h-12 { height: 6rem; }
.w-24 { width: 12rem; }
.h-24 { height: 12rem; }
.text-blue-600 { color: #006ae1; } 
.text-red-500 { color: rgba(239, 68, 68, 1); }
.stroke-1 { stroke-width: 1; }
.rotate-90 { transform: rotate(90deg); }
</style>

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

These plugins are available via GPM, and you can install them in one go via the CLI:

```
$ bin/gpm install svg-icons warm-cache zapier-rss mega-frontmatter
```

> [!IMPORTANT]
> The **Warm Cache** plugin makes use of the **sitemap** plugin to function properly, so allow installation when prompted.

You can also install the theme via the **Plugins** section in the admin plugin.

## SVG Icons

The **SVG Icons** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav) that provides over 8000 SVG icons with various sets of SVG icons that can be used in your content and Twig templates by using either a unique shortcode (for content) or Twig function (for templates).

This package currently contains 6 primary SVG icon sets:

* [Tabler Icons (2664)](https://tabler-icons.io/) → [DEFAULT] Developed by [Csaba Kissi](https://twitter.com/csaba_kiss) (v1.95.1)
* [Hero Icons (292)](https://heroicons.dev/) → Developed by [Steve Schoger](https://twitter.com/steveschoger) with both `outline` and `solid` variants (v2.0.11)
* [Simple Icon Brands (2340)](https://simpleicons.org/) → Over 2100 popular brand icons (v7.11.0)
* [Social Icons (6)](#) → A few basic consistent social networking icons (v1.0)
* **NEW** [Bootstrap Icons (1811)](https://icons.getbootstrap.com/) → Over 1500 icons (v1.9.1)
* **NEW** [Iconsax icons (1792)](https://iconsax.io/) →  `outline` and `bold` variants (v1.0)

#### Configuration

* **Plugin status** → Will enable or disable the entire plugin.  

#### Shortcode for Content

Valid icon sets include:

* `tabler`
* `heroicons\solid`
* `heroicons\outline`
* `brands`
* `bootstrap`
* `iconsax\bold`
* `iconsax\outline`
* `social`

When you need to use an SVG icon in your content, you can use the `[svg-icon]` shortcode. Here are some examples:

```bbcode
[raw]
[svg-icon="alien" /] 
[/raw]
```


<kbd>[svg-icon="alien" /]</kbd>

This is the quickest most basic approach. This will use the default `tabler` SVG icon set. Note, no extension is required for the icon name as they are all SVGs.

```bbcode
[raw]
[svg-icon=award set="tabler" /]
[/raw]
```


<kbd>[svg-icon="award" set="tabler" /]</kbd>

Another example with an explicit set defined and no trailing slash.

```bbcode
[raw]
[svg-icon icon="atom" /]
[/raw]
```


<kbd>[svg-icon icon="atom" /]</kbd>

The more commonly used approach with icon specifically defined.

```bbcode
[raw]
[svg-icon icon="battery-4" set="tabler" /]
[/raw]
```


<kbd>[svg-icon icon="battery-4" set="tabler" /]</kbd>

Icon and set defined, but no trailing slash.

```bbcode
[raw]
[svg-icon icon="clipboard-document-check" class="w-12" set="heroicons|solid" /]
[/raw]
```


<kbd>[svg-icon icon="clipboard-document-check" class="w-12" set="heroicons|solid" /]</kbd>

Example from HeroIcons / Solid and a TailwindCSS class of `w-12` to specify a width.

```bbcode
[raw]
[svg-icon icon="shield-check" class="w-12 h-12 text-blue-600" /]
[/raw]
```

[svg-icon icon="grav" class="w-8" set="brands" /]
[svg-icon icon="apple" class="w-8" set="brands" /] 
[svg-icon icon="ferrari" class="w-8" set="brands" /]
[svg-icon icon="spacex" class="w-8" set="brands" /]

Example of some popular brands from Simple Icons.

```bbcode
[raw]
[svg-icon icon="grav" class="w-8" set="brands" /]
[svg-icon icon="apple" class="w-8" set="brands" /]
[svg-icon icon="ferrari" class="w-8" set="brands" /]
[svg-icon icon="spacex" class="w-8" set="brands" /]
[/raw]
```




<kbd>[svg-icon icon="shield-check" class="w-12 h-12 text-blue-600" /]</kbd>

More complex example with TailwindCSS classes for width/height and also a color.

```bbcode
[raw]
[svg-icon icon="shield-check" class="w-24 h-24 text-red-500 stroke-1 transform rotate-90" /]
[/raw]
```


<kbd>[svg-icon icon="shield-check" class="w-24 h-24 text-red-500 stroke-1 transform rotate-90" /]</kbd>

Just showing off now with vector stroke modified and a custom rotation.

#### Twig Function for Templates

Using the plugin directly from Twig templates is a little different. There's an `svg_icon()` twig function available to use but it only takes a path to the SVG icon, plus classes. Some examples include:

```twig
{{ svg_icon('tabler/plus.svg', 'h-6 w-6 text-gray-600 stroke-3/2')|raw }}
```

This is using the `tabler/plus.svg` icon with various TailwindCS classes for width, height, color and stroke.  Note the use of `|raw` filter at the end. This is important as the output is the raw inline HTML of the SVG.

```twig
{{ svg_icon('heroicons/outline/star.svg', 'current-color h-8 w-8')|raw }}
```

Here we are using the `star.svg` from HeroIcons in Outline style.  The classes use the current color.

#### Custom Icons

If you want to add your own icons, you should clean them up to ensure any hardcoded colors are removed and `currentColor` is used instead.  For example, search and replace:

```
stroke=\"#(?:[0-9a-fA-F]{3}){1,2}\"
stroke="currentColor"

fill=\"#(?:[0-9a-fA-F]{3}){1,2}\"
fill="currentColor"
```

## Mega-Frontmatter

Mega-Frontmatter allows specified frontmatter fields to be stored and loaded via an external YAML file, which can lead to increased performance when a site is using large amounts of frontmatter-stored data.

The external frontmatter file is stored alongside the page file itself and is not included in the frontmatter during page initialization.  It's only loaded when you view or edit the page which can significantly improve performance.

#### Features

* Stores specific frontmatter fields into an external file
* Seamlessly loads and merges the external file into frontmatter when viewing or editing a page
* Fully multi-language compatible
* Automatically creates the frontmatter file if it doesn't exist, or merges the data if it does
* CLI command to automatically loop through all pages to extract and frontmatter into the external file, or revert from separate file into page frontmatter.

#### Configuration

* **Plugin status** → Will enable or disable the entire plugin.  
* **Mega Filename** → The name of the YAML file to house your custom frontmatter fields that will be stored alongside your page `.md` file.  Default is `mega-frontmatter.yaml`.
* **Mega Fields** → The top-level fields from your page frontmatter that will be stored in the mega file.  Default is `field1, field2, field3, feild4`.  You can modify these to reflect your needs.

#### Usage

The easiest way to explain usages is to give an example.  Let's say you have a page that looks like this:

```yaml
---
title: My Custom Page
published: true
taxonomy:
    category: [cat1, cat2]
    tag: [tag1, tag2]
hero: 
    title: Hero Title
    subtitle: Hero Subtitle
    image: /images/hero.jpg
    content: Hero Content
features:
  - name: Feature 1
    type: foo
    list: [a, b, c]
    content: Aliquam erat volutpat. Donec volutpat diam quis finibus finibus. Etiam sodales finibus mauris eget feugiat. Sed egestas nibh a massa tincidunt finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In commodo lobortis sapien et facilisis. Cras mattis arcu in ipsum euismod scelerisque. Vestibulum consequat consectetur nibh at euismod. Praesent sed cursus ante, ac sagittis mauris. Maecenas id egestas justo, id ullamcorper lorem. Duis ornare fringilla volutpat. In massa est, sodales non cursus ut, gravida id diam.
  - name: Feature 3
    type: bar
    list: [d, e, f]
    content: Curabitur eu cursus enim. In sodales tempus tempor. Quisque auctor facilisis congue. Nunc et est sagittis, ullamcorper ligula a, dictum dolor. Proin sed tempor neque, scelerisque hendrerit nibh. Quisque pharetra, sem eu efficitur hendrerit, nisi erat tristique erat, at placerat eros purus a elit. Mauris ut facilisis quam. Ut risus tellus, volutpat a porta mattis, consectetur et magna. Curabitur congue aliquam mattis. Curabitur rhoncus interdum ipsum, eu laoreet velit egestas sit amet. In hac habitasse platea dictumst.
    ...
---

Your page content here...
```

I've shortened this for brevity, but imagine you have 30 such features, and this is causing the frontmatter to be quite large.   If you have many such pages, you might find your Grav site is performing slower than expected.  This is probably due to the large amount of frontmatter that has to get processed for every page.  Imagine a world where you could specify specific frontmatter that is now processed for every page, but only processed when needed.  That's what this plugin does.

Simply specify the `hero` and `features` fields in your `mega_fields` config attribute, if it's found in a page's fronttmatter it will be moved to the external mega frontmatter file. 

If you are using the admin panel,  this will happen automatically when **edit** and **save** a page. It's transparent to you as the data is merged on load, and extracted on save.  After adding the `hero` and `features` fields, then editing and saving your page, you will not notice any difference, but if you look in the page folder, you will find the `mega-frontmatter.yaml` file. You would be left with a page markdown file that looks like this:

```yaml
---
title: My Custom Page
published: true
taxonomy:
    category: [cat1, cat2]
    tag: [tag1, tag2]
---

Your page content here...
```

and a `mega-frontmatter.yaml` file that looks like this:

```yaml
hero: 
    title: Hero Title
    subtitle: Hero Subtitle
    image: /images/hero.jpg
    content: Hero Content
features:
  - name: Feature 1
    type: foo
    list: [a, b, c]
    content: Aliquam erat volutpat. Donec volutpat diam quis finibus finibus. Etiam sodales finibus mauris eget feugiat. Sed egestas nibh a massa tincidunt finibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In commodo lobortis sapien et facilisis. Cras mattis arcu in ipsum euismod scelerisque. Vestibulum consequat consectetur nibh at euismod. Praesent sed cursus ante, ac sagittis mauris. Maecenas id egestas justo, id ullamcorper lorem. Duis ornare fringilla volutpat. In massa est, sodales non cursus ut, gravida id diam.
  - name: Feature 3
    type: bar
    list: [d, e, f]
    content: Curabitur eu cursus enim. In sodales tempus tempor. Quisque auctor facilisis congue. Nunc et est sagittis, ullamcorper ligula a, dictum dolor. Proin sed tempor neque, scelerisque hendrerit nibh. Quisque pharetra, sem eu efficitur hendrerit, nisi erat tristique erat, at placerat eros purus a elit. Mauris ut facilisis quam. Ut risus tellus, volutpat a porta mattis, consectetur et magna. Curabitur congue aliquam mattis. Curabitur rhoncus interdum ipsum, eu laoreet velit egestas sit amet. In hac habitasse platea dictumst.
    ...
```

#### CLI Command

> [!NOTE] 
> If you use the CLI commands you should ensure your configuration is accurate. 

There are two commands available, the first will use your configuration settings and loop through all the pages in a site and **extract** configure frontmatter headers into the external _mega_filename_.

```shell
bin/plugin mega-frontmatter morph extract
```

The second command does the reverse, it loops through all pages, and if a _mega_filename_ is found, it will **insert** those back into the page frontmatter:

```shell
bin/plugin mega-frontmatter morph insert
```

## Warm Cache

#### Configuration

![](warm-cache.png?class=image-shadow)

* **Plugin status** → Will enable or disable the entire plugin.  When disabled, no tray icon will display.

* **Sitemap URL** → This defaults to the value set in the **Sitemap** plugin

* **Enable Quicktray** → Enables or disables the quicktray icon to trigger an Ajax-powered warm-cache call of your site.

* **Quicktray Icon** → Allows you to override the default `tachometer` icon with a different Fontawesome icon

* **onCacheClear Events** → When enabled, **Clearing the Cache** either via Admin or CLI will then trigger a warm-cache call.

* **Show Count in Results** → By default the number of pages that were warmed shows in the results of the call.  This can be disabled.

* **Log Results** → The results of the cache clear can be logged for debugging errors.

* **User Agent** → This is the string set by the crawler that hits each page.  You can configure this or use it to filter out these cache-warming calls from your analytics data.

#### Usage

##### Admin Plugin

To use warm-cache plugin in the admin, you simply click the icon in the quicktray.  This is configurable but is a **Tachometer** by default.  You should see a 'toast' message in the top-right corner with a message after completion.

![Quick Try](warm-cache-quicktray.png?class=image-shadow&style=max-width:300px;)

##### CLI Command

The warm-cache plugin also includes a useful CLI command that also be scripted or used via a cron-job or scheduler as needed.

To use this from the CLI you need to call the command pass the URL of the sitemap.  For example:

```shell
bin/plugin warm-cache warm https://mysite.com/sitemap.json
```

Interestingly you can run this from any Grav instance that has warm-cache installed, and warm the cache of any other Grav server that has the sitemap plugin installed.  This is because warm-cache simply iterates over the entries in the sitemap and causes Grav to respond with the page requested, hence forcing Grav to warm the cache for that page.

##### Scripted

The simplest way to script the warm cache process for a site we have in `/Useres/joe/workspace/grav-example-site` is to create a shell script that runs the CLI command.  In this example, we'll create `/Users/joe/bin/warm-cache.sh` file with the contents:

```shell
#!/bin/sh
cd /Users/joe/workspace/grav-example-site
bin/plugin warm-cache warm https://localhost/grav-example-site/sitemap.json
```

Then we ensure this `warm-cache.sh` is executable via:

```shell
chmod +x warm-cache.sh
```

Assuming the `bin/` folder is in Joe's path, then anytime we're in the CLI we can simply run:

```shell
warm-cache.sh
```

##### Cron Job

With the `warm-cache.sh` script created you can run this daily by running this file via crontab.  Edit your crontab file with `crontab -e` then add the following line:

```crontab
* 3 * * * /Users/joe/bin/warm-cache.sh
```

##### Grav Scheduler

To use the Grav Scheduler, a simple approach is to first creat a `warm-cache.sh` script as provided above, then set that up in the scheduler in the "Custom Schedular Jobs"

First make sure your scheduler is working, then you can add a custom entry in your `user/config/scheduler.yaml` configuration file:

```yaml
...
custom_jobs:
  warm-cache:
    command: /Users/joe/bin/warm-cache.sh
    args: null
    at: '* 3 * * *'
    output: logs/warm-cache.log
    output_mode: append
    email: null
```

or via Admin:

![Warm Cache Scheduler](warm-cache-scheduler.png?class=image-shadow)

This will run the warm-cache script every day at 3am and store the output in Grav's `logs/warm-cache.log` file by appending the output each time.

## Zapier RSS

#### Configuration

Before configuring this plugin, you should copy the `user/plugins/zapier-rss/zapier-rss.yaml` to `user/config/plugins/zapier-rss.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                                                 # plugin enabled
active: false                                                 # default zapier state
template: zapier-feed.zrss.twig                               # TWIG template to use
description: For Zapier RSS integration with other services   # Description
limit: 20                                                     # Number of items to include
length: 1000                                                  # Number of chars per item
order:                                                        # Ordering of items
  by: date
  dir: desc
```

Note that if you use the Admin Plugin, a file with your configuration named zapier-rss.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

#### Usage

Simply install the plugin and then the URL you would use to integrate with would be your existing blog page with the new `.zrss` extension appended to it:

```
http://yoursite.com/your/blog.zrss
```  
  
This ensures the feed uses the custom `templates/zapier-feed.zrss.twig` file to process.  To modify this Twig file, simply copy it into your theme or plugin's `templates/` folder and modify as you like.

You can override the regular collection properties, or any of the other config options at the blog level, by modifying the frontmatter of the page that contains the collection.  For example:

```yaml
---
title: 'My Blog'
header_image: custom_header.jpg
content:
    items:
        - self@.children
    order:
        by: date
        dir: desc
    limit: 8

zapier-rss:
    active: true
    description: 'My Custom Zapier ZRSS Feed'
    template: 'zapier-custom-feed.rss.twig'
    limit: 20
    length: 500
---
```

You can also control if a particular item in the collection should not be included in this feed by skipping it:

```yaml
---
title: 'My Blog Post"

zapier-rss:
    skip: true
---
```
