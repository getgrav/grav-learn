---
title: Installation
taxonomy:
    category: docs
---

Installation of Grav is a trivial process. In fact, there is no real installation. You have several options for installing Grav. The first – and simplest – way is to download the **zip** archive, and extract it. The second way is to install with **Composer**. The third way is to clone the source project directly from **GitHub**, and then run an included script command to install needed dependencies. There are [more ways](#further-options) that involve running bundled scripts.

## Check for PHP version

Grav is incredibly easy to set up and get running. Be sure you have at least PHP version [version=15]5.6.3+[/version][version=16]7.1.3+[/version][version=17]7.3.6+[/version] by going to the terminal and typing `php -v`:

[prism classes="language-bash command-line" cl-output="2-10"]
php -v
PHP 7.3.18 (cli) (built: Jun  5 2020 11:06:30) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.3.18, Copyright (c) 1998-2018 Zend Technologies
    with Zend OPcache v7.3.18, Copyright (c) 1999-2018, by Zend Technologies
[/prism]


## Option 1: Install from ZIP package

The easiest way to install Grav is to download the ZIP package and extract it:

1. Download the latest-and-greatest **[Grav](https://getgrav.org/download/core/grav/latest)** or **[Grav + Admin](https://getgrav.org/download/core/grav-admin/latest)** package.
2. Extract the ZIP file in the [webroot](https://www.wordnik.com/words/webroot) of your web server, e.g. `~/webroot/grav`

!!! There are [Skeleton](https://getgrav.org/downloads/skeletons)-packages available, which include the core Grav system, sample pages, plugins, and configuration. They are a great way to get started; all you have to do is [download the Skeleton](https://getgrav.org/downloads/skeletons)-package you prefer, and follow the steps above.

You can also download any pre-packaged installation of a [tagged release](https://github.com/getgrav/grav/tags) from getgrav.org. Use the format `https://getgrav.org/download/TYPE/PACKAGE/VERSION`.

- [getgrav.org/download/core/grav/1.7.0](https://getgrav.org/download/core/grav/1.7.0) downloads Grav Core v1.7.0
- [getgrav.org/download/core/grav/1.7.0-rc.10?testing=true](https://getgrav.org/download/core/grav/1.7.0-rc.10?testing=true) downloads Grav Core v1.7.0-rc.10, a testing release
- [getgrav.org/download/core/grav-admin/1.7.0](https://getgrav.org/download/core/grav-admin/1.7.0) downloads Grav Core with the Admin plugin, at Core v1.7.0
- [getgrav.org/download/core/grav-admin/1.7.0-rc.10?testing=true](https://getgrav.org/download/core/grav-admin/1.7.0-rc.10?testing=true) downloads Grav Core v1.7.0-rc.10 with the Admin plugin, a testing release
- [getgrav.org/download/core/grav-update/1.7.0](https://getgrav.org/download/core/grav-update/1.7.0) downloads the update package for Grav Core
- [getgrav.org/download/plugins/flex-objects-json/0.1.0](https://getgrav.org/download/plugins/flex-objects-json/0.1.0) downloads the Flex Objects JSON plugin at v0.1.0
- [getgrav.org/download/themes/quark/2.0.3](https://getgrav.org/download/themes/quark/2.0.3) downloads the Quark theme at v2.0.3

!!!! If you downloaded the ZIP file and then plan to move it to your webroot, please move the **ENTIRE FOLDER** because it contains several hidden files (such as .htaccess) that will not be selected by default. The omission of these hidden files can cause problems when running Grav.


## Option 2: Install with composer

The alternative method is to install Grav with [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx):

[prism classes="language-bash command-line"]
composer create-project getgrav/grav ~/webroot/grav
[/prism]

If you want to check out the bleeding edge version of Grav, add `1.x-dev` as an additional parameter:

[prism classes="language-bash command-line"]
composer create-project getgrav/grav ~/webroot/grav 1.x-dev
[/prism]

## Option 3: Install from GitHub

Another method is to clone Grav from the GitHub repository, and then run a simple dependency installation script:

1. Clone the Grav repository from [GitHub](https://github.com/getgrav/grav) to a folder in the webroot of your server, e.g. `~/webroot/grav`. Launch a **terminal** or **console** and navigate to the webroot folder:

   [prism classes="language-bash command-line"]
   cd ~/webroot
   git clone -b master https://github.com/getgrav/grav.git
   [/prism]

2. Install **vendor dependencies** via [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx):

   [prism classes="language-bash command-line"]
   cd ~/webroot/grav
   composer install --no-dev -o
   [/prism]

3. Install the **plugin** and **theme dependencies** by using the [Grav CLI application](../../advanced/grav-cli) `bin/grav`:

   [prism classes="language-bash command-line"]
   cd ~/webroot/grav
   bin/grav install
   [/prism]

   This will automatically **clone** the required dependencies from GitHub directly into this Grav installation.

## Further options

### Install with Docker

[Docker](https://en.wikipedia.org/wiki/Docker_(software)) is an extremely efficient way to bootstrap platforms and services on both servers and local environments. If you are setting up several environments that need to be the same, or working collaboratively, it offers a simple way to ensure consistency between installations. If you are developing several Grav sites, you can streamline setting them up using Docker.

Stable Docker images are available that use [Apache](https://github.com/getgrav/docker-grav) (the official image), [Nginx](https://github.com/dsavell/docker-grav), and [Caddy](https://github.com/hughbris/grav-daddy) webservers. If you search, you will find more that you can try. With any image, make sure you create volumes to persist Grav's `user`, `backups`, and `logs` folders. (Backups and logs are optional if you don't need to keep that data.)

### Install on Cloudron

Cloudron is a complete solution for running apps on your server and keeping them up-to-date and secure. On your Cloudron you can install Grav with a few clicks. If you host multiple sites, you can install them completely isolated from one another on the same server.

[![button: Cloudron install](https://cloudron.io/img/button.svg)](https://cloudron.io/store/org.getgrav.cloudronapp.html)

The source code for the package can be found [here](https://git.cloudron.io/cloudron/grav-app).

### Install through Linode Marketplace

If you use Linode servers, there is an [easy, documented method using Linode Marketplace](https://www.linode.com/docs/guides/grav-marketplace-app/). This will set up a new Grav site on a new dedicated Linode virtual server. The virtual server will incur a periodic charge.

## Webservers

#### Apache/IIS/Nginx

Using Grav with a web server such as Apache, IIS, or Nginx is as simple as extracting Grav into a folder under the [webroot](https://www.wordnik.com/words/webroot). All it requires to function is [version=15]PHP 5.6.3[/version][version=16]PHP 7.1.3[/version][version=17]PHP 7.3.6[/version] or higher, so you should make sure that your server instance meets that requirement. More information about Grav requirements can be found in the [requirements](../requirements) chapter of this guide.

If your web root is, for example, `~/public_html` then you could extract it into this folder and reach it via `http://localhost`. If you extracted it into `~/public_html/grav` you would reach it via `http://localhost/grav`.

!!! Every web server must be configured. Grav ships with .htaccess by default, for Apache, and comes with some [default server configuration files](https://github.com/getgrav/grav/tree/master/webserver-configs), for `nginx`, `caddy server`, `iis`, and `lighttpd`. Use them accordingly when needed.

#### Running Grav with the Built-in PHP Webserver

You can run Grav using a simple command from Terminal / Command Prompt using the built-in PHP server available as long as you have PHP installed.

All you need to do is navigate to the root of your Grav install using the Terminal or Command Prompt and enter `bin/grav server`.

!! While technically all you need is PHP installed, if you install the [Symfony CLI application](https://symfony.com/download) the server will provide an SSL certificate so you can use `https://` and make use of PHP-FPM for better performance.

Entering this command will present you with output similar to the following:

[prism classes="language-bash command-line" cl-output="2-100"]
➜ bin/grav server

Grav Web Server
===============

Tailing Web Server log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3.log)
Tailing PHP-FPM log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3/53fb8ec204547646acb3461995e4da5a54cc7575.log)
Tailing PHP-FPM log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3/53fb8ec204547646acb3461995e4da5a54cc7575.log)

[OK] Web server listening
The Web server is using PHP FPM 8.0.8
https://127.0.0.1:8000


[Web Server ] Jul 30 14:54:53 |DEBUG  | PHP    Reloading PHP versions
[Web Server ] Jul 30 14:54:54 |DEBUG  | PHP    Using PHP version 8.0.8 (from default version in $PATH)
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    fpm is running, pid 64992
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    ready to handle connections
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    fpm is running, pid 64992
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    ready to handle connections
[Web Server ] Jul 30 14:54:54 |INFO   | PHP    listening path="/usr/local/Cellar/php/8.0.8_2/sbin/php-fpm" php="8.0.8" port=65140
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    fpm is running, pid 73709
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    ready to handle connections
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    fpm is running, pid 73709
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    ready to handle connections
[/prism]

Your terminal will also give you real-time updates of any activity on this ad hoc-style server. You can copy the URL provided in the `[OK] Web server listening` line and paste that into your browser of choice to access your site, including the administrator.

```
https://127.0.0.1:8000
```

!!!! This is a useful tool for quick development, and should **not** be used in place of a dedicated web server such as Apache or Nginx.

## Successful Installation

The first time it loads, Grav pre-compiles some files. If you now refresh your browser, you will get a faster, cached version.

![Grav Installed](install.png)

!! In the previous examples, **$** represents the command prompt. This may look different on various platforms.

By default, Grav comes with some sample pages to give you something to get started with. Your site is already fully functional and you can configure it, add content, extend it, or customize it as much as you like.

## Installation & Setup Problems

If any issues are discovered during the initial page load (or after a cache-flush event) you may see an error page:

![Grav with Problems](problems.png)

Please consult the [Troubleshooting](../../troubleshooting) section for help regarding specific issues.

! If you have issues with file permissions, please check the [Permissions Troubleshooting documentation](/troubleshooting/permissions). Also, you could look at the [Hosting Guides documentation](/webservers-hosting) that has specific instructions for various hosting environments

## Grav Updates

To keep your site up to date, please read [Updating Grav & Plugins](/basics/updates).
