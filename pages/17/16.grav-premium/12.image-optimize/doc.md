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

The **Image Optimize** Plugin is for [Grav CMS](http://github.com/getgrav/grav) that provides powerful image optimization via the following APIs:

* [**reSmush.it**](https://resmush.it/) - A cost free service that provides adequate optimization for `jpg`, `png`, and `gif` files. This is the **default service** as it does not require an API key to use, but is limited to files less than **5mb**.
* [**Tinify**](https://tinify.com) - The best optimization service currently available with support for `jpg`, `png` and `webp` files.  This is the **best service** but does require an API key to use.  There is a free tier of 500 compressions a month, but if you go over that the cost is very reasonable.  The file limit is **32mb**.
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
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Admin](https://github.com/getgrav/grav-plugin-admin) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/image-optimize/image-optimize.yaml` to `user/config/plugins/image-optimize.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                 # Enable the plugin
show_thumbs: true             # Show image thumbnails
service: resmushit            # Image optimization service [resmushit, tinify, kraken]
options:                      # Image optimization options
  exif: false                 # Preserve EXIF data
  qlty: 92                    # Image quality [0 - 100]. `null` or `100` for no compression
tinify:
  api_key:                    # Tinify API key (only required if service is tinify)
kraken:
  api_key:                    # Kraken.io API key (only required if service is kraken)
  api_secret:
ignores:                      # Paths to ignore (stream format is most flexible)
  - user://accounts
  - user://data
  - user://themes
  - plugins://
```

or via the **Admin plugin**:

![Admin settings](settings.png?class=image-shadow)

## Usage

After installation, you should verify your service options `Plugins` → `Image Optimize`. reSmush.it is default as it does not need any API key.  It's strongly recommended to use Tinify however as it provides superior image optimization and also supports webp which is the new emerging web image format.  

If you select **Tinify** or **Kraken.io** you will need to enter the appropriate API credentials.

![Bulk Optimize](bulk-optimize.png?class=image-shadow)

Once your setup is configured, you can navigate to the `Image Optimize` menu in the left sidebar.  This will show you all the image found that are available for optimization, as well as the current size. You can individual optimize with the **compress** button on the right, or you can **Bulk Optimize** using the button at the top.  

If the optimization is successful you will see the new file size, as well as the % of size savings.  The filepath will be highlighted in green, and you can then click this link to view a side-by-side comparison of the before/after files.

![Image Compare](image-compare.png?class=image-shadow)

If you are unsatisfied you can click the **revert** button to reverse the optimization and return to the previous file.

## Credits

This plugin would not be possible without the APIs available from reSmush.it, Tinify, and Kraken.io.  So thanks to them for creating this helpful services.
