---
title: Server-side
taxonomy:
    category: docs
---

Protecting your Grav-installation server-side consists of using sensible options for your server and PHP. This guide does not cover settings for the server you run Grav on, nor ideal conditions, but rather highlights some tips and best practices in securing Grav or links to resources which detail how to secure the server. **This is relevant for a production-server, not local development, and not recommended for novice users!**

## Grav and default configuration

For Grav, you should always use an up-to-date directory-specific configuration relevant to your server. These are found in the [GitHub repository](https://github.com/getgrav/grav/tree/develop/webserver-configs). Further, periodically update your installation of Grav as new security-patches are implemented in new versions - for details consult the [CHANGELOG](https://github.com/getgrav/grav/blob/develop/CHANGELOG.md).

## PHP configuration

Before meddling with PHP's configuration, be aware that most shared hosts that you rent hosting-space from will likely already have set up sensible, secure defaults. Also, in most cases they do not allow you to edit this yourself. Before disabling or changing any configuration, you should familiarize yourself with Grav's [requirements, including PHP-extensions](https://github.com/getgrav/grav/blob/develop/composer.json) and how changes will affect them.

Generally, PHP's configuration is changed through `php.ini`. You can find the location of this file from the command-line with the `php --ini`-command, or if you do not have access to direct commands, create a file named `phpinfo.php` in your webservers public root folder that contains `<?php phpinfo(); ?>` and open it with your browser. The path will be listed under "Loaded Configuration File". Once located, delete the `phpinfo.php`-file.

Some general recommendations:

- **Always keep your PHP-version up to date**: Use a [supported version](https://php.net/supported-versions.php) of PHP, preferably one that is in active, stable development. For instance, PHP 5.6 and PHP 7.0 will only have security-fixes implemented until December 2018, whilst PHP 7.1 remains in active development alongside PHP 7.2.
- Consider disabling the display of errors and PHP-version publicly: [PHP.earth article](https://php.earth/doc/security/intro#php-configuration).
- Use a separate user with restricted permissions to execute PHP for Grav: [Permissions in Docs](https://learn.getgrav.org/troubleshooting/permissions).
- Use Suhosin for [advanced protection of PHP](https://suhosin.org/stories/feature-list.html).

## Webserver configuration

Common webserver, or HTTP server software includes Nginx and Apache, as well as more modern alternatives such as LiteSpeed or CaddyServer. The aforementioned [webserver configurations](https://github.com/getgrav/grav/tree/develop/webserver-configs) include necessary defaults for Grav, but you can further secure the webserver through its configuration. Some relevant resources:

- [How To Secure Nginx](https://www.digitalocean.com/community/tutorials/how-to-secure-nginx-on-ubuntu-14-04) on DigitalOcean, and [Nginx WebServer Best Security Practices](https://www.cyberciti.biz/tips/linux-unix-bsd-nginx-webserver-security.html) on nixCraft.
- [Apache Web Server Hardening & Security Guide](https://geekflare.com/apache-web-server-hardening-security/) on Geek Flare, and [Apache Web Server Security and Hardening Tips](https://www.tecmint.com/apache-security-tips/) on Tecmint.
- [Ways of improving security in Litespeed](https://bobcares.com/blog/ways-of-improving-security-in-litespeed/) on Bobcares.

## Server configuration

You should **always keep your Operating System (OS) up to date**. OS' are vulnerable to exploits and intrusions, even more so than PHP, and should be updated as frequently as possible. Also, you should **always keep other software up to date**: Your installation is never just OS, PHP, and Grav. Other software packages are also risk-factors, and should be updated frequently.

To protect your users' connection to your site, you should enable and enforce [HTTPS with a SSL-certificate](https://php.earth/doc/security/ssl). This ensures that all communication between the server and browser remains private and encrypted. Free certificates and services are available through for example [Let's Encrypt](https://letsencrypt.org/about/) or [CloudFlare](https://www.cloudflare.com/ssl/).

If your server runs on Linux, enable [Security Enhanced Linux](https://selinuxproject.org/page/Main_Page). SELinux is typically enabled by default, and [well worth the trouble](http://www.computerworld.com/article/2717423/security/why-selinux-is-more-work--but-well-worth-the-trouble.html) to have. Some more recommendations for SysAdmins are available on [nixCraft](https://www.cyberciti.biz/tips/php-security-best-practices-tutorial.html).
