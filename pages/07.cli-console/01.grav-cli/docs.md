---
title: Grav command
taxonomy:
    category: docs
---

Grav comes with a built-in command-line interface (CLI) which can be found at `bin/grav`. The CLI is extremely useful for running recurring tasks such as **clearing the cache**, making **backups**, and more.

Accessing the CLI is a simple process but you need to use a **terminal**.  On a mac this is called `Terminal`, on windows, it's called `cmd` and on Linux, it's just a shell. UNIX style commands are not natively available in Windows cmd. Installing the [msysgit](http://msysgit.github.io/) package on a Windows machine adds [Git](http://git-scm.com/) and Git BASH, which is an alternative command prompt that makes UNIX commands available.  If you are accessing your server remotely, you most likely will use **SSH** to remotely log in to your server.  Check out this [great tutorial for more information on SSH](http://code.tutsplus.com/tutorials/ssh-what-and-how--net-25138).

Although some operations can be performed manually, by _relying_ on the CLI, these tasks could be automated via _cronjobs_ that run daily.

To get a list of all the commands available in Grav, you can run the command:

```bash
$ bin/grav list
```

This should display something like:

[version=15]
```text
Available commands:
  backup       Creates a backup of the Grav instance
  clean        Handles cleaning chores for Grav distribution
  clear-cache  [clearcache] Clears Grav cache
  composer     Updates the composer vendor dependencies needed by Grav.
  help         Displays help for a command
  install      Installs the dependencies needed by Grav. Optionally can create symbolic links
  list         Lists commands
  new-project  [newproject] Creates a new Grav project with all the dependencies installed
  sandbox      Setup of a base Grav system in your webroot, good for development, playing around or starting fresh
  security     Capable of running various Security checks
```
[/version]

[version=16]
```text
Available commands:
  backup       Creates a backup of the Grav instance
  cache        [clearcache|cache-clear] Clears Grav cache
  clean        Handles cleaning chores for Grav distribution
  composer     Updates the composer vendor dependencies needed by Grav.
  help         Displays help for a command
  install      Installs the dependencies needed by Grav. Optionally can create symbolic links
  list         Lists commands
  logviewer    Display the last few entries of Grav log
  new-project  [newproject] Creates a new Grav project with all the dependencies installed
  sandbox      Setup of a base Grav system in your webroot, good for development, playing around or starting fresh
  scheduler    Run the Grav Scheduler.  Best when integrated with system cron
  security     Capable of running various Security checks
```
[/version]

To get help for a specific command, you can prepend help to the command:

```bash
$ bin/grav help install
```

## Creating a Backup

[version=15]
Backing up your project is nothing more than creating an archive of the _ROOT_ of Grav. No Database, no complications.

Of course, you can simplify this even more by just using the Grav CLI. Supposing we have our `~/workspace/portfolio` project and that we want to create a backup of it, here's what we will do:

```bash
$ cd ~/workspace/portfolio
$ bin/grav backup
```

A new backup `portfolio-20140812174352.zip` file has been created at the `backup/` folder of the project. The long number after the name is just the date in the format of _year month day hour minute second_.

[/version]
[version=16]
The Grav backup system has been completely revamped in Grav 1.6 to support multiple backup profiles.  These profiles are configures in the `user/config/backups.yaml`.  If you don't have a custom configuration file, Grav will use the default one provided in `system/config/backups.yaml`.

If Grav detects multiple backup profiles, the CLI command will prompt you to choose the one you wish to backup with the CLI command.

```bash
$ cd ~/workspace/portfolio
$ bin/grav backup

Grav Backup
===========

Choose a backup?
  [0] Default Site Backup
  [1] Pages Backup
```

Alternatively you can pass an index of the profile directly:

```bash
$ cd ~/workspace/portfolio
$ bin/grav backup 1

Archiving 36 files [===================================================] 100% < 1 sec Done...

 [OK] Backup Successfully Created: /users/joe/workspace/portfolio/backup/pages_backup--20190227120510.zip
```

More information on the backup funcationality can be found in the [Advanced -> Backups](/advanced/backups) section.
[/version]

## Clean Grav

This CLI command is primarily used during the package building process, as it removes extraneous files and folders from Grav.  It is strongly recommended you **do not use this** yourself unless you are using it build your own Grav packages.

```bash
$ bin/grav clean
```

## Clearing Grav Cache

You can clear the cache by deleting all the files and folders under `cache/`.

The equivalent CLI command is:

[version=15]
```bash
$ cd ~/webroot/my-grav-project
$ bin/grav clear-cache
```

There are several aliases for compatibility (`clear-cache`, `clearcache`, `clear`).

The default option is the standard cache clearing process however, you can control this further with these options:

```text
--all             If set will remove all including compiled, twig, doctrine caches
--assets-only     If set will remove only assets/*
--images-only     If set will remove only images/*
--cache-only      If set will remove only cache/*
--tmp-only        If set will remove only tmp/*
```
[/version]

[version=16]
```bash
$ cd ~/webroot/my-grav-project
$ bin/grav cache
```

There are several aliases for compatibility (`cache`, `cache-clear`, `clearcache`, `clear`).

The default option is the standard cache clearing process however, you can control this further with these options:

```text
--purge           If set purge old caches
--all             If set will remove all including compiled, twig, doctrine caches
--assets-only     If set will remove only assets/*
--images-only     If set will remove only images/*
--cache-only      If set will remove only cache/*
--tmp-only        If set will remove only tmp/*
```
[/version]

## Composer Update

If you installed Grav via GitHub and have manually installed composer-based vendor packages, you can easily update with:

```bash
$ bin/grav composer
```

You can also pass composer options such as `install`:

```bash
$ bin/grav composer --install
```

or

```bash
$ bin/grav composer --update
```

!! These all use the `--no-dev` composer option, so to be able to perform testing you should use composer directly: `bin/composer.phar`

## Installing Grav Dependencies

To install the dependencies Grav relies on (**error** plugin, **problems** plugin, **antimatter** theme), launch a **terminal** or **console** and navigate to the grav folder where you want to install the dependencies and run the CLI command.

```bash
$ cd ~/webroot/my-grav-project
$ bin/grav install
```

You should now have the dependencies installed under:
* `~/webroot/my-grav-project/user/plugins/error`
* `~/webroot/my-grav-project/user/plugins/problems`
* `~/webroot/my-grav-project/user/themes/antimatter`

[version=16]
## Log Viewer

As part of Grav 1.6, a new logviewer CLI command was created to allow for quick viewing of Grav logs.

The simplest way to use this command is to simply type:

```bash
$ cd ~/webroot/my-grav-project
$ bin/grav logviewer
```

This will output the last 20 log entries of the `logs/grav.log` file.  There are a few options:

```text
-f, --file[=FILE]     custom log file location (default = grav.log)
-l, --lines[=LINES]   number of lines (default = 10)
-v, --verbose         verbose output including a stack trace if available
```

e.g.

```bash
 $ bin/grav logviewer --lines=4                                                                           [12:27:20]

Log Viewer
==========

viewing last 4 entries in grav.log

2019-02-27 12:00:30 [WARNING] Plugin 'foo-plugin' enabled but not found! Try clearing cache with `bin/grav cache`
2019-02-27 12:04:57 [NOTICE] Backup Created: /Users/joe/my-grav-project/backup/default_site_backup--20190227120450.zip
2019-02-27 12:05:10 [NOTICE] Backup Created: /Users/joe/my-grav-project/backup/pages_backup--20190227120510.zip
2019-02-27 12:26:00 [NOTICE] Backup Created: /Users/joe/my-grav-project/backup/pages_backup--20190227122600.zip
```
[/version]

## Creating a new Project

Every time you want to start a new project with Grav, you need to start with a clean Grav instance. Through the CLI, this process is super easy and takes only a few seconds.

1. Launch a **terminal** or **console** and navigate to the _grav_ folder (for the sake of this document we will assume it resides under  `~/Projects/grav`)

```bash
$ cd ~/Projects/grav
```

2. Run the Grav CLI to create a new project, with the destination being the location where your project will reside in (usually the [webroot](http://en.wikipedia.org/wiki/Webroot) of your Web server). Let us assume we are creating a **portfolio** and we want it at `~/Webroot/portfolio`.

```bash
$ bin/grav new-project ~/webroot/portfolio
```

This will create a new Grav instance and download all the dependencies required.

## Sandbox - Create a symlinked Grav Project

Grav has a nifty utility called `sandbox`, which can quickly create a [symlinked](/cli-console/command-line-intro#symbolic-links) copy of the Grav-installation. Simply put, running `bin/grav sandbox -s DESTINATION` - where "DESTINATION" is the path to the folder where you want the copied installation - recreates the Grav-installation in another folder.

For example, running:

```bash
$ bin/grav sandbox -s ../copy
```

From your current Grav-folder creates a sibling-folder named `copy`, where the following folders are virtual copies: `/bin, /system, /vendor, /webserver-configs`, as well as standard files that typically reside in Grav's root-folder. All content in /user will be carbon copies, not virtual, so you can easily get started with customizing the new installation without having created overhead from core files.

[version=16]
## Scheduler

As outlined in the [Advanced -> Scheduler](/advanced/scheduler) section, The scheduler can be monitored via the CLI command.

The base command will manually run the scheduler tasks that are due:

```bash
$ bin/grav scheduler
```

To get some more detail you can run with the optional `-v` option:

```bash
$ bin/grav scheduler -v

Running Scheduled Jobs
======================

[2019-02-27T12:34:07-07:00] Success: Grav\Common\Cache::purgeJob
[2019-02-27T12:34:07-07:00] Success: Grav\Common\Cache::clearJob
[2019-02-27T12:34:07-07:00] Success: ls -lah
```

Other options include:

```text
-i, --install         Show Install Command
-j, --jobs            Show Jobs Summary
-d, --details         Show Job Details
```

Please refer to the [Advanced -> Scheduler](/advanced/scheduler) section, for more detailed information on these options.
[/version]

## Security

Added in Grav 1.5 is a new security scanner CLI command.  You can run this to quickly scan your contents against the [configured security settings](/basics/grav-configuration#security).

```bash
$ bin/grav security                                                                                       [12:34:12]

Grav Security Check
===================

Scanning 11 pages [===================================================] 100% < 1 sec

[OK] Security Scan complete: No issues found...
```

#### PHP CGI-FCGI Information

To determine if your server is running `cgi-fcgi` on the command line, type the following:

```bash
$ php -v
PHP 5.5.17 (cgi-fcgi) (built: Sep 19 2014 09:49:55)
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
    with the ionCube PHP Loader v4.6.1, Copyright (c) 2002-2014, by ionCube Ltd.
```

If you see a reference to `(cgi-fcgi)` you will need to prefix all `bin/grav` commands with `php-cli`. Alternatively, you can set up an alias in your shell with something like: `alias php="php-cli"` which will ensure the **CLI** verison of PHP runs from the command line.






