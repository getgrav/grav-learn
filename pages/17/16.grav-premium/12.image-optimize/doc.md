---
title: Image Optimize
description: How to setup and use Image Optimize on your site
taxonomy:
    category: docs
---

# Image Optimize

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

# Image Optimize Plugin

The **Image Optimize** Plugin is for [Grav CMS](http://github.com/getgrav/grav) that provides powerful image optimization via the following services:

* [**RasterFox API**](https://rasterfox.app) - The **recommended service**: a hosted optimizer for `jpg`, `png` and `webp` files using oxipng with QuantCrush, jpegli and libwebp. Requires an API key; the Free plan covers 500 images a month with files up to **5mb**, and the paid plans go up to **75mb**. See [RasterFox](#rasterfox) below.
* [**RasterFox CLI**](https://rasterfox.app) - The same encoders running on your own server, so images never leave it, and the best choice if you can install it there. No API key and no file size limit. Install it with `brew install skulkworks/tap/rasterfox-cli`.
* [**reSmush.it**](https://resmush.it/) - A cost free service that provides adequate optimization for `jpg`, `png`, and `gif` files. This is the **default service** as it does not require an API key to use, but is limited to files less than **5mb**.
* [**Tinify**](https://tinify.com) - A fast pay-as-you-go service with very good optimization and support for `jpg`, `png` and `webp` files. It requires an API key. There is a free tier of 500 compressions a month, but if you go over that the cost is very reasonable. The file limit is **32mb**.
* [**Kraken.io**](https://kraken.io) - Is a solid performer with support for `jpg`, `png`, and `gif`. It does not provide the speed or optimization capability as Tinify. Kraken.io also requires an API key, and provides 100mb of compression for free, after that you need to upgrade to a paid tier. They start at $5/month. The file limit is **32mb**.

## Installation

Installing the Image Optimize plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install image-optimize

This will install the Image Optimize plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/image-optimize`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `image-optimize`. You can find these files on [GitHub](https://github.com/trilbymedia/grav-plugin-image-optimize) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/image-optimize
	
> [!NOTE]
> Image Optimize works in Admin2 on Grav 2, which needs the [API](https://github.com/getgrav/grav-plugin-api) plugin, and in the classic [Admin](https://github.com/getgrav/grav-plugin-admin) on Grav 1.7. The screenshots on this page are from Admin2; the classic Admin has the same settings and actions.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/image-optimize/image-optimize.yaml` to `user/config/plugins/image-optimize.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                 # Enable the plugin
show_thumbs: true             # Show image thumbnails
service: resmushit            # Image optimization service [resmushit, tinify, kraken, rasterfox_api, rasterfox]
batch_workers: 2              # Concurrent workers for Bulk Optimize
per_page: 10                  # Admin listing items per page
index_cache_ttl: 900          # Seconds to cache the image index (set 0 to always rebuild)
options:                      # Image optimization options
  exif: false                 # Preserve EXIF data
  qlty: 85                    # Image quality [0 - 100]. `null` or `100` for no compression
tinify:
  api_key:                    # Tinify API key (only required if service is tinify)
kraken:
  api_key:                    # Kraken.io API key (only required if service is kraken)
  api_secret:
rasterfox_api:
  api_key:                    # RasterFox API key, starts with rf_ (only required if service is rasterfox_api)
  preset: balanced            # Compression preset [balanced, high-quality, small-size, adaptive]
  url: https://api.rasterfox.app  # API address
rasterfox:
  preset: quality             # Compression preset [quality, adaptive, balanced, high-quality, small-size]
  binary:                     # Absolute path to the rasterfox CLI (optional if it is in PATH)
ignores:                      # Paths to ignore (stream format is most flexible)
  - user://accounts
  - user://data
  - user://themes
  - plugins://
```

or in the admin under `Plugins` → `Image Optimize`:

![Admin settings](settings.png?class=image-shadow)

## RasterFox

RasterFox is the recommended service. It comes in two forms that use the same encoders (oxipng with QuantCrush for PNG, jpegli for JPEG, libwebp for WebP): a hosted API, and a CLI you install on your own server. Both optimize images in their own format and size, and both handle WebP.

### RasterFox API

The API is the easiest way to get RasterFox results, because there is nothing to install on the server.

1. Get a key on the [RasterFox plans page](https://rasterfox.app/plans). The Free plan gives you 500 images a month, with no card.
2. In `Plugins` → `Image Optimize`, choose **RasterFox API (recommended)** as the service and paste your key. Keys start with `rf_`.
3. Pick a compression preset. The API has no quality setting, so it always uses a preset, and the **Image Quality** setting is not used.

| Preset | What it does |
| --- | --- |
| Balanced | The default. Roughly quality 85. |
| Small Size | Smaller files, roughly quality 70. |
| High Quality | Larger files, roughly quality 95. |
| Adaptive | Picks settings per image. Results vary, and some images are left untouched, so test it on your own images first. |

**Preserve EXIF Data** keeps metadata when it is on and strips it when it is off. The largest file you can send depends on your plan: 5 MB on Free, 25 MB on Starter and 75 MB on Pro and Business. Sending the same image again within 8 hours doesn't count against your monthly images, and when the service is busy it asks the plugin to wait a few seconds, which the plugin does before trying again.

If something goes wrong, such as a bad key, a file over your plan's size limit or a used-up monthly quota, the image shows an error with the API's own explanation. The [RasterFox API docs](https://rasterfox.app/docs) have the details.

### RasterFox CLI

The CLI does the same work on your own server, so images never leave it, with no API key and no file size limit.

1. Install it on macOS or Linux with [Homebrew](https://brew.sh): `brew install skulkworks/tap/rasterfox-cli`
2. In `Plugins` → `Image Optimize`, choose **Rasterfox (local CLI)** as the service. The settings show the version they found.
3. If the `rasterfox` binary isn't on the web server's PATH, set **Rasterfox Binary Path** (for example `/opt/homebrew/bin/rasterfox`).

The CLI uses the **Image Quality** setting unless you pick a compression preset, which replaces it, because the CLI doesn't accept both. Which presets are offered depends on the CLI version you have installed.

The compression preset for either service can also be changed from the top of the Image Optimize page, next to the per-page selector.

## Usage

After installation, check your service options in `Plugins` → `Image Optimize`. reSmush.it is the default only because it needs no API key. RasterFox is the recommended service: the RasterFox API for most sites, or the RasterFox CLI if you can install it on your server.

If you select **RasterFox API**, **Tinify** or **Kraken.io** you will need to enter the appropriate API credentials.

![Bulk Optimize](bulk-optimize.png?class=image-shadow)

Once your setup is configured, open **Image Optimize** in the admin sidebar. It lists every image available for optimization with its current size, and you can filter the list or sort it by any column. Optimize a single image with the **Optimize** button at the end of its row, or use **Bulk Optimize** at the top: its menu can optimize the selected images, every image not yet optimized, or everything on the current page. The preset (or the quality, with services that use one) can be changed from the top of the list.

If the optimization is successful you will see the new file size and the percentage saved, and the path turns into a link. Click the path, or the **Compare** button in the row, to see the optimized image and the original side by side with a slider between them.

![Image Compare](image-compare.png?class=image-shadow)

If you are unsatisfied, click the **Restore** button in the row to put the original file back.

## Credits

This plugin would not be possible without the services available from RasterFox, reSmush.it, Tinify, and Kraken.io.  So thanks to them for creating this helpful services.
