---
title: Installation
taxonomy:
    category: docs
process:
	twig: true    
---

Installation of Grav is a trivial process. In fact, there is no real installation.  The steps for getting Grav up-and-running are as follows:

1. Download the latest-and-greatest **Grav Base** package from the [Downloads][downloads]
2. Extract the ZIP file in your [webroot][webroot] of your web server

If your web root is for example `~/public_html` then you could extract it into this folder and reach it via `http://localhost`.  If you extracted it into `~/public_html/grav` then you would reach it via `http://localhost/grav`.

## Using the PHP's Web Server

Grav is incredibly easy to set up and get running. You can do this without even installing or configuring a web server!  Be sure you have at least PHP version 5.4 by going to the terminal and typing:

```bash
$ php -v
```

This should report the version and build information.  For example:

```bash
PHP 5.4.24 (cli) (built: Jan 19 2014 21:32:15)
Copyright (c) 1997-2013 The PHP Group
Zend Engine v2.4.0, Copyright (c) 1998-2013 Zend Technologies
```


To try Grav, simply navigate to the directory where you extracted your **Grav Base** package file in your terminal and type:

```bash
$ php - S localhost:8000
```

This runs the built-in PHP web server.  Then, point your browser to `http://localhost:8000` and you should see your Grav site. The first time it loads, there is some compilation happening. Refresh your browser and you will get a faster, cached version.

{{ media['install.png'].cropResize(600,600).html('Grav Installed','border') }}

>>> In the previous examples, **$** represents the command prompt.  This may look different on various platforms. 

By default, Grav comes with some sample pages to give you something to get started with.  Your site is already fully functional and you can configure it, add content, extend it, or customize it as much as you like.

## Updates

We plan on providing an improved update solution including **automatic updates** via the upcoming **Admin Panel** plugin - as well as updating via the **Console Application**.  Until then, you should download the [Update Package][update] from our [Downloads section][downloads].

You can extract the update package over the top of your existing Grav installation and it will copy over any updates in the `core system folder` as well as any library updates in the `vendor folder`.

[downloads]: http://getgrav.org/downloads
[webroot]: http://en.wikipedia.org/wiki/Webroot
[update]: http://getgrav.org/downloads
