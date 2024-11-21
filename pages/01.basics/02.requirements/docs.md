---
title: Requirements
taxonomy:
    category: docs
---

Grav is intentionally designed with few requirements. You can easily run Grav on your local computer, as well as 99% of all Web hosting providers. If you have a pen handy, jot down the following Grav system requirements:

1. Web Server (Apache, Nginx, LiteSpeed, Lightly, IIS, etc.)
[version=15]
2. PHP 5.6.3 or higher
[/version]
[version=16]
2. PHP 7.1.3 or higher
[/version]
[version=17]
2. PHP 7.3.6 or higher
[/version]

3. hmm... that's it really, (but please look at PHP requirements for a smooth experience)!

Grav is built with plain text files for your content. There is no database needed.

!! A PHP user cache such as APCu, Memcached, or Redis is highly recommended for optimal performance. Not to worry though, these are usually already part of your hosting package!

## Web Servers

Grav is so simple and versatile that you don't even need a web server to run it. You can run it directly off the built-in PHP webserver, as long as you're running [version=15]**PHP 5.6.3**[/version][version=16]**PHP 7.1.3**[/version][version=17]**PHP 7.3.6**[/version] or later.

Testing with the built-in webservers is a useful way to check a Grav install and perform some brief development, but it is **not** recommended for a live site or even for advanced development tasks. We've outlined how in our [Installation guide](../installation#running-grav-with-the-built-in-php-webserver-using-routerphp).

Even though technically you do not need a standalone web server, it is better to run one, even for local development. There are many great options available:

### Mac

* MacOS 10.14 Mojave already ships with the Apache Web server and PHP 7.1, so job done!
* [MAMP/MAMP Pro](https://www.mamp.info/en/mac/) comes with Apache, MySQL and of course PHP. It is a great way to get more control over which version of PHP you are running, setting up virtual hosts, plus other useful features such as automatically handling dynamic DNS.
* [DDEV](https://ddev.com/) for docker-based PHP development environments.
* [AMPPS](https://www.ampps.com/downloads) is a software stack from Softaculous enabling Apache, PHP, Perl, Python,.. This includes everything you need (and more) for GRAV development.
* [Brew Apache/PHP](https://getgrav.org/blog/macos-mojave-apache-multiple-php-versions) is an alternative approach that allows a fully configurable installation with various PHP versions.

### Windows

* [Laragon](https://laragon.org/) portable, isolated, fast & powerful universal development environment for PHP, Node.js, and more. It is fast, lightweight, easy-to-use and easy-to-extend.
* [XAMPP](https://www.apachefriends.org/index.html) provides Apache, PHP, and MySQL in one simple package.
* [EasyPHP](https://www.easyphp.org/) provides a personal Web hosting package as well as a more powerful developer version.
* [MAMP for Windows](https://www.mamp.info/en/windows/) is a long-time Mac favorite, but now available for Windows.
* [IIS with PHP](https://php.iis.net/) is a fast way to run PHP on Windows.
* [DDEV](https://ddev.com/) for docker-based PHP development environments.
* [AMPPS](https://www.ampps.com/downloads) is a software stack from Softaculous enabling Apache, PHP, Perl, Python,.. This includes everything you need (and more) for GRAV development.
* [Linux Subsystem](https://medium.freecodecamp.org/setup-a-php-development-environment-on-windows-subsystem-for-linux-wsl-9193ff28ae83) is a great way to Run a linux-like environment on Windows

### Linux

* Many distributions of Linux already come with Apache and PHP built-in. If they're not, the distribution usually provides a package manager through which you can install them without much hassle. More advanced configurations should be investigated with the help of a good search engine.

### Apache Requirements

Even though most distributions of Apache come with everything needed, for the sake of completeness, here is a list of required Apache modules:

* `mod_rewrite`
* `mod_ssl` (if you wish to run Grav under SSL)
* `mod_mpm_itk_module` (if you wish to run Grav under its own user account)

You should also ensure you have `AllowOverride All` set in the `<Directory>` and/or `<VirtualHost>` blocks so that the `.htaccess` file processes correctly, and rewrite rules take effect.

### IIS Requirements

Although IIS is considered a web server ready to run 'out-of-the-box', some changes need to be made.

To get **Grav** running on an IIS server, you need to install **URL Rewrite**. This can be accomplished using **Microsoft Web Platform Installer** from within IIS. You can also install URL Rewrite by going to [iis.net](https://www.iis.net/downloads/microsoft/url-rewrite).

### PHP Requirements

Most hosting providers and even local LAMP setups have PHP pre-configured with everything you need for Grav to run 'out-of-the-box'. However, some Windows setups, and even Linux distributions local or on VPS (I'm looking at you Debian!) - ship with a very minimal PHP compile. Therefore, you may need to install or enable these PHP modules:

* `curl` (client for URL handling used by GPM)
* `ctype` (used by symfony/yaml/Inline)
* `dom` (used by grav/admin newsfeed)
* `gd` (a graphics library used to manipulate images)
* `json` (used by Symfony/Composer/GPM)
* `mbstring` (multibyte string support)
* `openssl` (secure sockets library used by GPM)
* `session` (used by toolbox)
* `simplexml` (used by grav/admin newsfeed)
* `xml` (XML support)
* `zip` extension support (used by GPM)

For enabling `openssl` and (un)zip support you will need to find in the `php.ini` file of your Linux distribution for lines like:

[prism classes="language-bash line-numbers"]
;extension=openssl.so
;extension=zip.so
[/prism]

and remove the leading semicolon.

##### Optional Modules

* `apcu` for increased cache performance
* `opcache` for increased PHP performance
* `yaml` PECL Yaml provides native yaml processing and can dramatically increase performance
* `xdebug` useful for debugging in a development environment

### Permissions

For Grav to function correctly, your web server needs to have the appropriate **file permissions** to write logs, caches, etc. When using either the [CLI](/advanced/grav-cli) (Command Line Interface) or [GPM](/advanced/grav-gpm) (Grav Package Manager), the user running PHP from the command line also needs to have the appropriate permissions to modify files.

By default, Grav will install with `644` and `755` permissions for files and folders, respectively. Most hosting providers have configurations that ensure that a web server running PHP will allow you to create and modify files within your user account. This means that Grav runs **out-of-the-box** on the vast majority of hosting providers.

However, if you are running on a dedicated server or even your local environment, you may need to adjust permissions to ensure your **user** and your **web server** can modify files as needed. There are a couple of approaches you can take.

1. In a **local development environment**, you can usually configure your web server to run under your user profile. This way the web server will always allow you to create and modify files.

2. Change the **group permissions** on all files and folders so that the web server's group has write access to files and folders while keeping the standard permissions. This requires a few commands to make this work.

First, find out which user Apache runs with by running the following command:

[prism classes="language-bash command-line"]
ps aux | grep -v root | grep apache | cut -d\  -f1 | sort | uniq
[/prism]

Now, find out which group this user belongs to by running this command (note: adjust USERNAME with the apache username you found in the previous command)

[prism classes="language-bash command-line"]
groups USERNAME
[/prism]

(note: adjust `GROUP` to be the group your apache runs under, found in the previous command. [`www-data`, `apache`, `nobody`, etc.]):

[prism classes="language-bash line-numbers"]
chgrp -R GROUP .
find . -type f | xargs chmod 664
find . /bin -type f | xargs chmod 775
find . -type d | xargs chmod 775
find . -type d | xargs chmod +s
umask 0002
[/prism]

If you need to invoke superuser permissions, you would run `find … | sudo xargs chmod …` instead.

## Recommended Tools

### PhpStorm

Grav is developed using [PhpStorm](https://www.jetbrains.com/phpstorm/), which makes it the best IDE for Grav. However, it does not come for free.

PhpStorm is best suited for PHP developers, including people who write complicated Grav plugins. It offers automated code compilation for Grav (you just need to add Grav and any plugin you use into includes), and many other tools to aid with the code development. It has also good support for formatting twig, yaml, html, js, scss and tailwind.

### Text Editors

Although you can get away with Notepad, Textedit, Vi, or whatever default text editor comes with your platform, we recommend using a good text editor with syntax highlighting to make things easier. Here are some recommended options:

1. [Visual Studio Code](https://code.visualstudio.com/) - Similar to Atom, it's built using Electron, Node, as well as HTML/CSS.  It's quite lightweight and has many plugins available, including very good support for PHP and JavaScript.  This is the current recommended editor for developing for Grav.
2. [SublimeText](https://www.sublimetext.com/) - MacOS/Windows/Linux - A commercial developer's editor, but well worth the price. Very powerful especially combined with plugins such as [Markdown Extended](https://sublime.wbond.net/packages/Markdown%20Extended), [Pretty YAML](https://sublime.wbond.net/packages/Pretty%20YAML), and [PHP-Twig](https://sublime.wbond.net/packages/PHP-Twig).
3. [Notepad++](https://notepad-plus-plus.org/) - Windows - A free and very popular developer's editor for Windows.
4. [Bluefish](https://bluefish.openoffice.nl/index.html) - MacOS/Windows/Linux - A free, open source text editor geared towards programmers and web developers.
5. [Kate](https://kate-editor.org/about-kate/) - MacOS/Windows/Linux - A light yet powerfull and versatile opensource text editor and programming tool, supporting highlighting for over 300 languages (including Markdown).

### Markdown Editors

Another option if you primarily work with just creating content, is to use a dedicated **Markdown Editor**. These often are very content-centric and usually provide a **live-preview** of your content rendered as HTML. There are literally hundreds of these, but some good options include:

1. [MacDown](https://macdown.uranusjr.com/) - MacOS - Free, a simple, lightweight open source Markdown editor.
2. [LightPaper](https://getlightpaper.com/) - MacOS - $17.99, clean, powerful. Our markdown editor of choice on the Mac. **Get 25% OFF with Discount Code: GET_GRAV_25**
3. [MarkDrop](https://culturezoo.com/markdrop/) - MacOS - $5, but super clean and Droplr support built-in.
4. [MarkdownPad](https://markdownpad.com/) - Windows - Free and Pro versions. Even has YAML front-matter support. An excellent solution for Windows users.
5. [Mark Text](https://github.com/marktext/marktext) - Free, open source Markdown editor for Windows / Linux / MacOS.

### FTP Clients

Although there are many ways to deploy **Grav**, fundamentally you only need to copy your local site to your hosting provider. The most basic way to do this is with an [FTP Client](https://en.wikipedia.org/wiki/File_Transfer_Protocol). There are many available, but some recommended ones include:

1. [Transmit](https://panic.com/transmit/) - MacOS - The de facto FTP/SFTP client on MacOS. Easy to use, fast, folder-syncing and pretty much anything else you could ask for.
2. [FileZilla](https://filezilla-project.org/) - MacOS/Windows/Linux - Probably the best option for Windows and Linux users. Free and very powerful (but very ugly on the Mac!).
3. [Cyberduck](https://cyberduck.io/) - MacOS/Windows - A decent free option for both MacOS and Windows users. Not as full-featured as the others.
4. [ForkLift](https://www.binarynights.com/forklift/) - MacOS - A solid alternative to Transmit, and slightly cheaper to boot.

### Git

If you run the [Git](https://git-scm.com/) distributed version control system on your development and server environments, you can set up a simple workflow via a hosted Git service like [Github](https://github.com) or [GitLab](https://about.gitlab.com/). This is slightly more work to set up, but provides a cleaner, more robust workflow that takes care of backups for you. Try this only if you are comfortable with Git and its client tools.

!!! We provide more details about using Git in your workflow later under [Deploying with Git](/webservers-hosting/deploying-with-git) section in the [Web Servers & Hosting chapter](/webservers-hosting).
