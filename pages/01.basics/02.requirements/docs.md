---
title: Requirements
taxonomy:
    category: docs
---

Grav has intentionally been designed with few requirements.  You can easily run Grav on your local computer, as well as 99% of all Web hosting providers. If you have a pen handy, jot down the following Grav system requirements:

1. Webserver (Apache, IIS, Nginx) with **Rewrite rules** support
2. PHP 5.4 or higher
3. hmm... that's it!

Grav is built with plain text files for your content. There is no database needed, at all.

>>> A PHP user cache such as APC, APCU, XCache, Memcache, Redis is highly recommended for optimal performance.  Not to worry though, these are usually already part of your hosting package!

## Recommended Web Servers

Even though technically you do not need a standalone Web server, it is better to run one, even for local development. Luckily there are many options depending on your platform:

### Mac

* OS X 10.9 Mavericks already ships with the Apache Web server and PHP 5.4, so job done!
* [MAMP/MAMP Pro](http://mamp.info) comes with Apache, MySQL and of course PHP.  It is a great way to get more control over which version of PHP you are running, setting up virtual hosts, plus other useful features such as automatically handling dynamic DNS.

### Windows

* [XAMPP](https://www.apachefriends.org/index.html) provides Apache, PHP, and MySQL in one simple package
* [EasyPHP](http://www.easyphp.org/) provides a personal Web hosting package as well as a more powerful developer version
* [MAMP](http://mamp.info) is a long-time Mac favorite, but now available for Windows.
* [IIS with PHP](http://php.iis.net/) is a fast way to run PHP on Windows.

>>> IIS Web server is currently untested with Grav, but should work fine.

### Linux

* Many distributions of Linux already come with Apache and PHP built-in, if it's not built-in, then usually the distribution provides a package manager where you can install Apache and PHP without much hassle.  More advanced configurations should be investigated with the help of a good search engine.

>>> Running Grav with the built-in Web server provided with PHP 5.4 is explained in more detail in the next chapter.


## Recommended Tools

### Text Editors

Although you can get away with Notepad, Textedit, Vi, or whatever default text editor comes on your platform, we recommend using a good text editor with syntax highlighting to make things easier.  Here are some recommended options:

1. [SublimeText](http://www.sublimetext.com/) - OS X/Windows/Linux - A commercial developer's editor, but well worth the price. Very powerful especially combined with plugins such as [Markdown Extended](https://sublime.wbond.net/packages/Markdown%20Extended), [Pretty YAML](https://sublime.wbond.net/packages/Pretty%20YAML), and [PHP-Twig](https://sublime.wbond.net/packages/PHP-Twig).
2. [Atom](http://atom.io) - OS X/Windows - A new editor developed by Github. It's free and open source.  It is similar to Sublime, but does not have the sheer depth of plugins available yet.
3. [Notepad++](http://notepad-plus-plus.org/) - Windows - A free and very popular developer's editor for Windows.
4. [Bluefish](http://bluefish.openoffice.nl/index.html) - OS X/Windows/Linux - A free, open source text editor geared towards programmers and web developers.

### Markdown Editors

Another option if you primarily work with just creating content, is to use a **Markdown Editor**. These often are very content-centric and usually provide a **live-preview** of your content rendered as HTML.  There are literally hundreds of these, but some good options include:

1. [LightPaper](http://clockworkengine.com/lightpaper-mac/) - OS X - Free, clean, powerful.  Our markdown editor of choice on the Mac.
2. [MarkDrop](http://culturezoo.com/markdrop/) - OS X - $5, but super clean and and Droplr support built-in.
3. [MarkdownPad](http://markdownpad.com/) - Windows - Free and Pro versions. Even as YAML front-matter support.  A very solid solution for Windows users .

### FTP Clients

Although there are many ways to deploy **Grav**, the simplest is to simply copy your local site to your hosting provider.  The easiest way to accomplish this is with an [FTP Client](http://en.wikipedia.org/wiki/File_Transfer_Protocol).  There are many available, but some recommended ones include:

1. [Transmit](http://panic.com/transmit/) - OS X - The de facto FTP/SFTP client on OS X.  Easy to use, fast, folder-syncing and pretty much anything else you could ask for.
2. [FileZilla](https://filezilla-project.org/) - OS X/Windows/Linux - Probably the best option for Windows and Linux users. Free and very powerful (but very ugly on the Mac!).
3. [Cyberduck](http://cyberduck.io/) - OS X/Windows - A decent free option for both OS X and Windows users.  Not as full featured as the others.
4. [ForkLift](http://www.binarynights.com/forklift/) - OS X.  A solid alternative to Transmit, and slightly cheaper to boot.


