---
title: Requirements
taxonomy:
    category: docs
---

Grav has intentionally been designed with few requirements.  You can easily run Grav on your local computer, as well as 99% of all Web hosting providers. If you have a pen handy, jot down the following Grav system requirements:

1. Webserver (Apache, Nginx, LiteSpeed, IIS, etc.)
2. PHP 5.4 or higher
3. hmm... that's it!

Grav is built with plain text files for your content. There is no database needed.

>>> A PHP user cache such as APC, APCU, XCache, Memcache, Redis is highly recommended for optimal performance.  Not to worry though, these are usually already part of your hosting package!

## Web Servers

Even though technically you do not need a standalone Web server, it is better to run one, even for local development. Luckily there are many options depending on your platform:

### Mac

* OS X 10.9 Mavericks already ships with the Apache Web server and PHP 5.4, so job done!
* [MAMP/MAMP Pro](http://mamp.info) comes with Apache, MySQL and of course PHP.  It is a great way to get more control over which version of PHP you are running, setting up virtual hosts, plus other useful features such as automatically handling dynamic DNS.

### Windows

* [XAMPP](https://www.apachefriends.org/index.html) provides Apache, PHP, and MySQL in one simple package
* [EasyPHP](http://www.easyphp.org/) provides a personal Web hosting package as well as a more powerful developer version
* [MAMP for Windows](http://mamp.info) is a long-time Mac favorite, but now available for Windows.
* [IIS with PHP](http://php.iis.net/) is a fast way to run PHP on Windows.

### Linux

* Many distributions of Linux already come with Apache and PHP built-in, if it's not built-in, then usually the distribution provides a package manager where you can install Apache and PHP without much hassle.  More advanced configurations should be investigated with the help of a good search engine.

>>> Running Grav with the built-in Web server provided with PHP 5.4 is explained in more detail in the next chapter.

### Apache Requirements

Even though most distributions of Apache come with everything needed, for the sake of completeness, here is a list required Apache modules:

* `mod_cache`
* `mod_expires`
* `mod_headers`
* `mod_rewrite`
* `mod_ssl`

You should also ensure you have `AllowOveride All` set in the `<Directory>` and/or `<VirtualHost>` blocks so that the `.htaccess` file processes correctly and rewrite rules take effect.

### IIS Requirements

Although IIS is considered a webserver ready to 'run-out-of-box' there are some changes that need to be made.
To get **Grav** to run on an IIS server you need to install **URL Rewrite.** This can be accomplished using **Microsoft Web Platform Installer** from within IIS. You can also install URL Rewrite by going to [iis.net](http://www.iis.net/downloads/microsoft/url-rewrite).

### PHP Requirements

Most hosting providers and even local LAMP setups have PHP pre-configured with everything you need for Grav to run out of the box.  However, some windows setups, and even Linux distributions (I'm looking at you Debian!) ship with a very minimal PHP compile. Therefore, you may need to install or enable these PHP modules:

* `gd` (a graphics library used to manipulate images)
* `curl` (client for URL handling used by GPM)
* `openssl` (secure sockets library used by GPM)
* `mbstring` (multibyte string support)

##### Optional Modules

* `apc` (PHP 5.4) or `apcu` (PHP 5.5+) for increased cache performance
* `opcache` (PHP 5.5+) for increased PHP performance
* `xcache` alternative to *apc*, not as fast, but still pretty good
* `xdebug` useful for debugging in development environment


### Permissions

For Grav to function properly your webserver needs to have the appropriate **file permissions** in order to write logs, caches, etc.  When using either the [CLI](/advanced/grav-cli) or [GPM](/advanced/grav-gpm), the user running PHP from the command line, also needs to have the appropriate permissions to modify files.

By default, Grav will install with `644` and `755` permissions for files and folders respectively. Most hosting providers have configurations that ensure the webserver running PHP will allow you to create and modify files within your user account.  This means that Grav runs **out-of-the-box** on the vast majority of hosting providers.

However, if you are running on a dedicated server, or even your local environment, you may need to adjust permissions to ensure you **user** and your **webserver** can modify files as needed.  There are a couple of approaches you can take.

1. In a **local development environment**, you can usually configure your webserver to run under you user profile.  This way the web server will always allow you to create and modify files.

2. Change the **group permissions** on all files and folders so that the webserver's group has write access to files and folders while keeping the standard permissions.  This requires a few commands to make this work (note: adjust `www-data` to be the group your apache runs under [`www-data`, `apache`, `nobody`, etc.]):

```
chgrp -R www-data .
find . -type f | xargs chmod 664
find . -type d | xargs chmod 775
find . -type d | xargs chmod +s
umask 0002
```



## Recommended Tools

### Text Editors

Although you can get away with Notepad, Textedit, Vi, or whatever default text editor comes with your platform, we recommend using a good text editor with syntax highlighting to make things easier.  Here are some recommended options:

1. [SublimeText](http://www.sublimetext.com/) - OS X/Windows/Linux - A commercial developer's editor, but well worth the price. Very powerful especially combined with plugins such as [Markdown Extended](https://sublime.wbond.net/packages/Markdown%20Extended), [Pretty YAML](https://sublime.wbond.net/packages/Pretty%20YAML), and [PHP-Twig](https://sublime.wbond.net/packages/PHP-Twig).
2. [Atom](http://atom.io) - OS X/Windows - A new editor developed by Github. It's free and open source.  It is similar to Sublime, but does not have the sheer depth of plugins available yet.
3. [Notepad++](http://notepad-plus-plus.org/) - Windows - A free and very popular developer's editor for Windows.
4. [Bluefish](http://bluefish.openoffice.nl/index.html) - OS X/Windows/Linux - A free, open source text editor geared towards programmers and web developers.

### Markdown Editors

Another option if you primarily work with just creating content, is to use a **Markdown Editor**. These often are very content-centric and usually provide a **live-preview** of your content rendered as HTML.  There are literally hundreds of these, but some good options include:

1. [LightPaper](http://www.ashokgelal.com/lightpaper-for-mac) - OS X - Free, clean, powerful.  Our markdown editor of choice on the Mac.
2. [MarkDrop](http://culturezoo.com/markdrop/) - OS X - $5, but super clean and and Droplr support built-in.
3. [MarkdownPad](http://markdownpad.com/) - Windows - Free and Pro versions. Even has YAML front-matter support.  A very solid solution for Windows users .

### FTP Clients

Although there are many ways to deploy **Grav**, the simplest is to simply copy your local site to your hosting provider.  The easiest way to accomplish this is with an [FTP Client](http://en.wikipedia.org/wiki/File_Transfer_Protocol).  There are many available, but some recommended ones include:

1. [Transmit](http://panic.com/transmit/) - OS X - The de facto FTP/SFTP client on OS X.  Easy to use, fast, folder-syncing and pretty much anything else you could ask for.
2. [FileZilla](https://filezilla-project.org/) - OS X/Windows/Linux - Probably the best option for Windows and Linux users. Free and very powerful (but very ugly on the Mac!).
3. [Cyberduck](http://cyberduck.io/) - OS X/Windows - A decent free option for both OS X and Windows users.  Not as full featured as the others.
4. [ForkLift](http://www.binarynights.com/forklift/) - OS X - A solid alternative to Transmit, and slightly cheaper to boot.


