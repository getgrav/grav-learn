---
title: SEO Magic
description: Learn how to use the full power of SEO Magic
taxonomy:
    category: docs
---

# SEO Magic

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

The SEO Magic plugin makes use of the **sitemap** plugin to function properly.  These are available via GPM, and because the plugin has dependencies you just need to proceed and install the SEO Magic plugin, and confirm when prompted to install the others:

```
$ bin/gpm install seo-magic
```

You can also install the theme via the **Plugins** section in the admin plugin.

## Configuration

**SEO Magic** has many configuration options to help control how the plugin should function.  These can be broken down into sections, so we'll tackle these one at a time.

### General Configuration

![General Configuration](general-config.png?class=image-shadow)

* **Plugin status** → Will enable or disable the entire plugin.  When disabled, no tray icon will display, SEO Magic tab will not display when editing pages, etc.

* **SEO Magic Actions** → You can easily **regenerate** SEO data based on the sitemap, or clear out and **Delete** existing data.

* **Enable Quicktray Icon** → The quicktray icon looks like a magic wand and allows you to quicky **regenerate** the SEO data from anywhere in the admin.

* **Enable Admin Page Events** → By default, when enabled, **Saving** a page will cause the SEO data for that page to be regenerated.  **Deleting** a page will cause the SEO data to be removed.

* **Enable Page-level SEO Report** → The SEO Report is a sub-tab available in the **SEO Magic** tab when editing page content.  The report analyzes the existing SEO data and provides a report that can help you improve your SEO ranking for the current page.

* **Enabled Site-wide SEO Report** → If enabled, the full site report is available in the **Tools** → **Reports** section of the admin

* **User Agent String** → The useragent used by the SEO Magic page data crawler.  You can target this agent name and ignore these crawl pages in your analytics data.

* **Client Timeout** → You can now configure the time it takes before the HTTP client that is used to crawl pages, images, and links times out.  This value represents the number of seconds before timeout. The smaller the number, the faster the process, but the more likely you are to encounter timeouts and potentially _false-negative_ results.

* **Client Connections** → The number of concurrent connections the HTTPClient can use

* **Robots String** → if no `robots.txt` file is found in the root of your site, SEO Magic will use this string and dynamically set it in a meta tag for every page. [Read more information on the `robots` meta tag](https://moz.com/learn/seo/robots-meta-directives?target=_blank)

* **CSS Body Selectors** → An array of CSS selectors that are used by SEO Magic to find content to be parsed and used for automatic detection of **meta description** and **meta keywords**.

* **Custom Stop-Words** → Words that should be ignored and not picked up from content and used as keywords. These will not be counted as _interesting_ words.

### Link Checker Configuration

![Link Checker](link-checker.png?class=image-shadow)

* **Enable Link Checker** → A new feature that checks all the link on each page is available as part of the **generate SEO Data** process.  When enabled, link status will show up in the page and site reports.

* **Link Checker Timeout** → How long to wait before timing out when crawling images and links

* **Maximum Retries** → Number of times to retry a link that is broken or unreachable

* **Whitelist URLs** → Ignore links for these URLs

### Meta Content Configuration

![Meta Configuration](meta-content.png?class=image-shadow)

* **OpenGraph Enabled** → Render OpenGraph meta-tags automatically when displaying a page.

* **Twitter Card Enabled** → Render Twitter specific meta-tags automatically when displaying a page.

* **Twitter Username** → Your username to add context for the Twitter card.

* **Twitter Card Type** → The Twitter card style to display. Options include `Summary Large Image`, `Summary`, `App`, and `Player`.

* **Facebook Card Enabled** → Render Facebook specific meta-tags automatically when displaying a page.

* **Facebook App** → The Facebook App ID associated to this site. This can be useful for tracking and is recommended by Facebook. You can find this on your [Facebook Developer dashboard](https://developers.facebook.com/apps/redirect/dashboard?target=_blank).
 
 ### Meta Images Configuration
 
![](meta-images.png?class=image-shadow)
 
* **Image Type** → Choose from the following approaches when finding an image to use in meta-data and OpenGraph tags:

    [div class="table"]
    | Option | Description |
    |--------|-------------|
    |**Automatic** | SEO Magic will fallback through the following image type list until an image is found: `Image Name` → `Image Attribute` → `OG-Image` → `First image found in Page` → `Default URL`|
    |**WebShot Automatic Screenshot Service** | **An SEO Magic exclusive!** Each SEO Magic license entitles you to register a URL that can then be used to take screenshots of your pages automatically. These will be generated and cached for optimal performance |
    |**Specific filename in each page folder** | The `Image Name` selected below will be used (if it exists) as the screenshot for the page. |
    |**Specific attribute in page header** | The image name filename located in the `Image Attribute` found in the current page header/front-matter will be used (if it exists) as the screenshot for the page.|
    |**A provided OG-Image in the page** | The `OG-Image` Option will use an existing `og-image.jpg` or `og-image.png` found in the page folder. |
    |**First image found in Page** | This will just grab the first image found in the page. This is usually the first **alphabetically** but order can be dependent on your filesystem. |
    |**Default URL of a specific image** | A specific image URL will be used for all images |
    [/div]

> [!IMPORTANT]
> The default fallback order for finding images is the same as the **Automatic** mode.  All other modes will also fall back from the selected option to the right. For example, if you selected **OG-Image** for the image type, SEO Magic will first look for appropriate OG-Image files, if none are found, it will try to use the **First Image found in Page**, if no image at all is found, then it will try to fallback on the provided **Default Image**.
 
* **Image Name** → The default image name that should be used if found in a particular page.

* **Image Attribute** → The image attribute that if set, will contain the filename of the image that should be used for the page's image.
    
* **Default Image** → The URL of an image that will be used no other image can be found.
   
* **Image Size X** → The width of the image generated in `px`.

* **Image Size Y** → The height of the image generated in `px`.

 ### Meta Auto-Generation Configuration
 
![Meta Auto-Generation](meta-auto-generation.png?class=image-shadow)

* **Keep UTF8 Characters** → Enabled by default to support UTF-8 characters in multi-language content.  Disable this if you are running into problems with weird UTF-8 characters showing up in your auto-generated content.
 
* **Global Keywords** → An array of keywords that will prefix any auto-generated keywords.  This is particularly useful if you have some key keywords that are appropriate for all pages.

* **Global Keywords** → Enable or Disable the auto-generation of keywords capability.  The keywords are based on the content found with the `CSS Body Selectors` in the **General Configuration** section above.

* **Keywords Default Fallback** - Enable or Disable the ability to fallback to the keyword values provided in the **Site Configuration**, if they are available.

* **Global Description** → Enable or Disable the auto-generation of description capability.  The description is based on the content found with the `CSS Body Selectors` in the **General Configuration** section above.

* **Description Default Fallback** - Enable or Disable the ability to fallback to the description value provided in the **Site Configuration**, if it is available.

* **Description Summarization** → Either use `Simple Content Summarization` which uses the page's content to generate the summary, or `PHP.Science Textrank Algorithm` which uses a sophisticated algorithm to summarize what it considers the important parts of the page content and generates a summary from it.

## Usage


The **SEO Magic** tab will show up for every page that is both **published** and **visible**. That means that the parent **modular page** will show the tab, but **modular sub-pages** will not show it.

When you first install the plugin, you should perform an index or crawl on your site to generate the SEO data that is used for automatic description and keywords, as well as being used to provide an SEO score for each page. The **sitemap** plugin is required to be installed for this to function properly.  This can be performed in a number of ways:

1. From the Admin **Quick Tray**.  Simply click the magic wand icon to kick off the process.

2. From the **Plugins** -> **SEO Magic** Options.  Then click the **Regenerate SEO Data** button.

3. From the CLI, you can run the index process with the following command:

    ```shell
    bin/plugin seo-magic process https://yoursite.com/sitemap.json
    ```
   
    Where the URL provided is the URL of your sitemap that is available with the sitemap plugin installed.

4. You can also regenerate the **SEO Data** for a specific page simply by saving that page, or by running the following style of CLI command:

    ```shell
    bin/plugin seo-magic process https://yoursite.com/your/page-url
    ```
   
    Where the URL provided is the URL of a specific page on your site.
   
Each time you save a page, the **SEO Data** is updated.  It's updated in the same way as the index, but only for a single page.  This way SEO Magic can analyze how your actual page looks for a search engine.  This ensure the results are more realistic that simply checking the data.

### Broken Link Checker

This is enabled by default, but as long as you don't disable it, links will be crawled and checked to ensure they are not broken when you generate your SEO Data.  Alternatively you can use the new CLI command to generate a quick CLI report of broken link status:

```shell
bin/plugin seo-magic link-checker https://yoursite.com/your/page-url
```

Where the URL provided is the URL of your sitemap that is available with the sitemap plugin installed. You can use the optional `-a` option to show all the links on a page including ones that are not broken. e.g.:

```shell
bin/plugin seo-magic link-checker https://yoursite.com/your/page-url -a
```

Or you can provide a specific page URL to check broken links for that page only:

```shell
bin/plugin seo-magic link-checker https://yoursite.com/your/page-url
```

Where the URL provided is the URL of a specific page on your site.


## Troubleshooting

### Unable to Regenerate SEO Data

If you are having trouble crawling your site when you **Regenerate SEO Data**, then there two things you should check first:

1. In a new browser, or icognito mode, see if you can reach your **Sitemap** URL as defined in Sitemap + SEO Magic configuration properties.  If the sitemap doesn't load, then you might have **disabled** the plugin, or perhaps changed the **sitemap URL**, please check these first.

2. If you are prompted for a username/password, then you will need to disable this before the sitemap will be reachable by SEO Magic.

3. If you have a development SSL Certificate and you get prompted to **Accept the Certificate**, this could also be a problem for SEO Magic.  It won't be able to reach your pages to regenerate the SEO data, if a regular browser is not able to.

### Metadata set in content is not showing up in browser

The most likely culprint in this scenario is the theme you are using may be missing the standard metadata partial that includes any dynamcially set metadata.  This is a common scenario where the theme developer has simply hardcoded in specific metadata tags.  You will need to use the standard metadata approach in order for SEO Magic to function properly.

Check your theme, most likely the `partials/base.html.twig` exists and contains something like this:

```twig
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
{% include 'partials/metadata.html.twig' %}
```

If it **does not** provide this `partials/metadata.html.twig` include (which is actually provided by Grav core itself), then you  should remove any other custom metadata tags (the 3 shown here are fine to keep), and add the include as shown.

### Link Checker Timeouts

If you are getting timeouts during your link checking, you should increase the **Link Check Timeout**. The default of 10 seconds, might be too slow when the page is not cached or hosted on a slow server.

Also you might want to look at changing the **Maximum Retries** value to a larger number if it takes a few cache 'hits' to access the link within the timeout.

### Link Checker Blocking

Some sites have sophisticated firewall rules in places to stop DDoS attacks and other non-human scripts accessing a site.  The Link Checker might trigger these so some approaches you can try to mitigate these situations include:

* **Whitelist any sites that are commonly problematic**.  Some sites will quickly lock down a barrage of requests with a **429 Error code** (Too many requests).  If you have a lot of links to a site that is throwing this, you can whitelist the site in question.

* **Using localhost if possible**.  If your site is behind a proxy, firewall or other rate-limiting proxy service (e.g. Cloudflare). Any requests from your server to link-check it's own links, will probably be requested as a regular client would, i.e. via the full URL which will mean they are susceptible to being blocked.  An approach to get around this for your own links, is to set up a simple `/etc/hosts` file entry where you set your public URL to the localhost IP (e.g. `127.0.0.1`).
