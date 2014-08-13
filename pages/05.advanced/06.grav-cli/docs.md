---
title: Grav CLI
taxonomy:
    category: docs
---

Grav comes with a built-in command-line interface (CLI) which can be found at `bin/grav`. The CLI is extremely useful for running recurring tasks such as **clearing the cache**, making **backups**, and more.

Although some operations can be performed manually, by _relying_ on the CLI, these tasks could be automated via _cron-jobs_ that run daily.

To get a list of all the commands available in Grav, you can run the command:

```bash
$ bin/grav help
```


## Creating a new Project

Every time you want to start a new project with Grav, you need to start with a clean Grav instance. Through the CLI, this process is super easy and takes only few seconds.

1. Launch a **terminal** or **console** and navigate to the _grav_ folder (for the sake of this document we will assume it resides under  `~/Projects/grav`)

    ```bash
    $ cd ~/Projects/grav
    ```

2. Run the Grav CLI to create a new project, with the destination being the location where your project will resides in (usually the [webroot][webroot] of your Web server). Let us assume we are creating a **portfolio** and we want it at `~/Webroot/portfolio`.

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

[webroot]: http://en.wikipedia.org/wiki/Webroot
[github-grav]: https://github.com/getgrav/grav
