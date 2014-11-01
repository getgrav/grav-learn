---
title: Grav CLI
taxonomy:
    category: docs
---

Grav comes with a built-in command-line interface (CLI) which can be found at `bin/grav`. The CLI is extremely useful for running recurring tasks such as **clearing the cache**, making **backups**, and more.

Although some operations can be performed manually, by _relying_ on the CLI, these tasks could be automated via _cron-jobs_ that run daily.

To get a list of all the commands available in Grav, you can run the command:

```bash
$ bin/grav list
```

To get help for a specific command, you can prepend help to the command:

```bash
$ bin/grav help install
```

## Creating a new Project

Every time you want to start a new project with Grav, you need to start with a clean Grav instance. Through the CLI, this process is super easy and takes only few seconds.

1. Launch a **terminal** or **console** and navigate to the _grav_ folder (for the sake of this document we will assume it resides under  `~/Projects/grav`)

    ```bash
    $ cd ~/Projects/grav
    ```

2. Run the Grav CLI to create a new project, with the destination being the location where your project will reside in (usually the [webroot][webroot] of your Web server). Let us assume we are creating a **portfolio** and we want it at `~/Webroot/portfolio`.

    ```bash
    $ bin/grav new-project ~/webroot/portfolio
    ```

This will create a new Grav instance and download all the dependencies required.

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

## Clearing Grav Cache

You can clear the cache by deleting all the files and folders under `cache/`.

The equivalent CLI command is:

```bash
$ cd ~/webroot/my-grav-project
$ bin/grav clear-cache
```

## Creating a Backup

Backing up your project is nothing more than creating an archive of the _ROOT_ of Grav. No Database, no complications.

Of course you can simplify this even more by just using the Grav CLI. Supposing we have our `~/workspace/portfolio` project and that we want to create a backup of it, here's what we will do:

```bash
$ cd ~/workspace/portfolio
$ bin/grav backup
```

A new backup `portfolio-20140812174352.zip` file has been created at the _ROOT_ of the project. The long number after the name is just the date in the format of _year month day hour minute second_.

You can also pass a destination. So let's say we want to backup our `portfolio` project under `~/Documents/Backups`, this is what we will do instead:

```bash
$ cd ~/workspace/portfolio
$ bin/grav backup ~/Documents/Backups
```

Very simple. Like above, a new backup has been created, but this time in a different location: `~/Documents/Backups/portfolio-20140812174352.zip`

[webroot]: http://en.wikipedia.org/wiki/Webroot
[github-grav]: https://github.com/getgrav/grav
