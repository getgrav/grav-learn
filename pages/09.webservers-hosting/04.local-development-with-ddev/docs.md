---
title: 'Local Development with ddev'
---

[ddev](https://ddev.readthedocs.io) is an open-source, PHP development tool, built upon Docker.  It can easily create local hosting environments, and its server configurations can be version controlled.  Originally meant for Drupal development, ddev easily can host Drupal, WordPress, and GravCMS sites.  Since it is based on Docker, ddev is compatible with Windows, Mac, and Linux.


## Installing ddev

Please see the [official ddev documentation](https://ddev.readthedocs.io/en/latest/) for the most up to date instructions for installing ddev.  

## Configuration

* Place the Grav files in a folder on the host machine (/home/USER/projects/grav).
* In your terminal, cd to that folder `cd /home/USER/projects/grav`
* Type `ddev config`.  The following prompts will display:
 * Project name (defaults to \[GRAV_ROOT]'s folder name
 * Docroot path (defaults to the \[GRAV_ROOT])
 * Project type (use type `php` for this option)
* run `ddev start `from the \[GRAV_ROOT] folder.
* Let ddev build out the containers it requires.  Root/ Sudo credentials may be required in order to make local hosts changes.

## Note about ddev and the Feed plugin
ddev defaults to using nginx and the default configuration as of 2020-09-18 is sufficient for most use cases.  However, if you plan on using the [feed plugin](https://github.com/getgrav/grav-plugin-feed), you'll need to make the following configuration changes:
  * Edit \[GRAV_ROOT]/.ddev/nginx_full/nginx-site.conf
  * Remove line 3 to make changes permanent (`#ddev-generated`)
  * Remove lines 58-62 which forced rss and atom static caching (`# Expire rules for static content ...`)
  * Run `ddev restart` to load the new nginx configuration.

Failing to make these changes will cause HTTP Error 404 on attempts to load rss or atom feeds.

## Using ddev

Run these commands from the \[GRAV_ROOT] on the host machine:
* `ddev describe` - Views all available services
* `ddev ssh` - Connects a shell to the webserver at the docroot.
* `ddev exec 'params'` - Executes params at the docroot (e.g. `ddev exec 'bin/grav clear'` to clear the cache)

> I need to install \[insert plugin/ theme here].  How do I access `bin/gpm`?

From the \[GRAV_ROOT], type `ddev ssh` and you'll be connected to the web server at the docroot. From here, you can run any php command (composer, bin/gpm, bin/grav, etc).

> Where do I edit my files?

An editor on the host machine can edit the files at  \[GRAV_ROOT].  Changes will reflect into the ddev container automatically.  Changes performed in the container (i.e. `bin/gpm install admin`) will reflect to the host machine.



