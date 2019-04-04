---
title: Scripted Upgrades
taxonomy:
    category: docs
---

Or: Upgrading multiple Grav-installations at once.

This is a guide to make upgrading multiple Grav-installations easier, using [Deployer](https://deployer.org/). By multiple I mean separate installations, not a [multisite-installation](/advanced/multisite-setup). We'll use the path to each installation to run [Grav's CLI](/cli-console/grav-cli) commands, but without having to type each of them manually.

A benefit of a task-runner like Deployer is that as it runs through its tasks, it will let you know exactly what it is doing along the way. It will also show you any output from the server from the commands being run. For example, this is an output from Deployer:

[prism classes="language-text"]
Executing task packages

GPM Releases Configuration: Stable

Found 8 packages installed of which 1 need updating

01. Email           [v2.5.2 -> v2.5.3]

GPM Releases Configuration: Stable

Preparing to install Email [v2.5.3]
  |- Downloading package...   100%
  |- Checking destination...  ok
  |- Installing package...    ok
  '- Success!

Clearing cache

Cleared:  /home/username/public_html/deployer/grav/cache/twig/*
Cleared:  /home/username/public_html/deployer/grav/cache/doctrine/*
Cleared:  /home/username/public_html/deployer/grav/cache/compiled/*

Touched: /home/username/public_html/deployer/grav/user/config/system.yaml
[/prism]

And as simple as that, Deployer told Grav to upgrade all packages, which upgraded the Email-plugin to its newest version.

## Prerequisites

[version=15]
Like with Grav, you need PHP **v5.6.4** or above. This also applies for the command line (CLI), so if you have multiple versions installed use the one which refers to the right version. Use the command `php -v` to check your default version, mine is **PHP 5.4.45**.

On shared environments, check with your host which command to use for CLI. In my case, this is `php56` which with `-v` returns **PHP 5.6.28**. This also means prepending every path like this: `php56 vendor/bin/dep list`.
[/version]
[version=16]
Like with Grav, you need PHP **v7.1.3** or above. This also applies for the command line (CLI), so if you have multiple versions installed use the one which refers to the right version. Use the command `php -v` to check your default version, mine is **PHP 5.4.45**.

On shared environments, check with your host which command to use for CLI. In my case, this is `php71` which with `-v` returns **PHP 7.1.26**. This also means prepending every path like this: `php71 vendor/bin/dep list`.
[/version]

Some hosts also allow you to select your default PHP version to use for CLI, check with your host how to do this.

## Setup

In your servers public root (like **public_html** or **www**), create a folder named `deployer` and enter it. We'll use this as a basis for the project. You'll want to password-protect this directory (see [DigitalOcean Guide](https://www.digitalocean.com/community/tutorials/how-to-set-up-password-authentication-with-apache-on-ubuntu-14-04) for a manual approach, or use [CPanel](https://www.siteground.com/tutorials/cpanel/pass_protected_directories.htm) if available).

You need to have a working installation of Grav, as well as [Composer](https://getcomposer.org/). Some hosts have Composer installed already, which you can check by running `composer -v`. If it is not installed you can install it through SSH -- from the root directory -- with the following:

[prism classes="language-bash command-line"]
export COMPOSERDIR=~/bin;mkdir bin
curl -sS https://getcomposer.org/installer | php -- --install-dir=$COMPOSERDIR --filename=composer
[/prism]

Or, if you prefer a [local installation](https://getcomposer.org/download/), run the following in the `public_html/deployer/`-folder:

[prism classes="language-bash command-line"]
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
[/prism]

With a local installation, composer is ran through `composer.phar` rather than just `composer`. Now, while still in the `public_html/deployer/`-folder, run the following to install [Deployer](https://deployer.org/docs/installation):

[prism classes="language-bash command-line"]
composer require deployer/deployer
[/prism]

Now, still in the same folder, create a file named `deploy.php`. We'll use this to run each task with Deployer. Copy and paste the following into the file:

[prism classes="language-php line-numbers"]
<?php
namespace Deployer;
require 'vendor/autoload.php';

// Configuration
set('default_stage', 'production');
set(php, 'php56');

// Servers
localServer('site1')
	->stage('production')
	->set('deploy_path', '/home/username/public_html/deployer/grav');

desc('Backup Grav installations');
task('backup', function () {
	$backup = run('{{php}} bin/grav backup');
	writeln($backup);
});
desc('Upgrade Grav Core');
task('core', function () {
	$self_upgrade = run('{{php}} bin/gpm self-upgrade -y');
	writeln($self_upgrade);
});
desc('Upgrade Grav Packages');
task('packages', function () {
	$upgrade = run('{{php}} bin/gpm update -y');
	writeln($upgrade);
});
?>
[/prism]

## Configuration

Because Deployer needs an explicit staging-environment, we set it to `production`. Further, to allow for specific php version we set a default executable to be used. This can be a named executable or the path to a specific version of PHP. Our configuration now looks like this:

[prism classes="language-php line-numbers"]
// Configuration
set('default_stage', 'production');
set(php, 'php56');
[/prism]

If your default PHP CLI version is **5.6\*** or higher, you change this to `set(php, 'php');`.

### Servers

We can set up as many servers/sites as needed, the script will be ran for each of them in order. They can be local installations or on external servers, but since this is a local setup we use `localServer` (see [Deployer/servers](https://deployer.org/docs/servers) for more configurations). Here's an example with multiple sites:

[prism classes="language-php line-numbers"]
// Servers
localServer('site1')
	->stage('production')
	->set('deploy_path', '/home/username/public_html/deployer/grav1');
localServer('site2')
	->stage('production')
	->set('deploy_path', '/home/username/public_html/deployer/grav2');
localServer('site3')
	->stage('production')
	->set('deploy_path', 'C:\caddy\grav1');
localServer('site4')
	->stage('production')
	->set('deploy_path', 'C:\caddy\grav2');
[/prism]

Note that we use absolute paths to the installations, but they are relative to how the path is interpreted by SSH. This means that on the server, we want the full path because Deployer interprets this correctly, but we could also use the tilde-key if a HOMEDIR is set, like this: `~/public_html/deployer/grav1`.

### Tasks

Three tasks are currently set up: `backup`, `core`, and `packages`. Running `php vendor/bin/dep backup` creates a backup of each installation, available in **deploy_path/backup/BACKUP.zip**, where `deploy_path` is the paths you configured for the servers.

Running `php vendor/bin/dep core` upgrades Grav itself, and does this with the `--all-yes` option to skip all Yes/No questions asked. The same applies when running `php vendor/bin/dep packages`, which upgrades all plugins and themes.

## Conclusion

We can now upgrade all your defined sites easily by running the tasks in order. First we enter the `public_html/deployer/`-folder, and then we run each command as needed:

[prism classes="language-bash command-line"]
php vendor/bin/dep backup
php vendor/bin/dep core
php vendor/bin/dep packages
[/prism]

We will now have made a backup of each site, upgraded Grav itself, as well as upgraded all plugins and themes.
