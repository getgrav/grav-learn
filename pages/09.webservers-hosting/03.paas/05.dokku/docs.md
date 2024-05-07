---
title: Dokku
menu: Dokku
visible: true
taxonomy:
    category: docs
---

Dokku is a Docker-based, self-hosted "mini-Heroku" that you can run out of any Virtual Machine (VM), local or remote. The main advantages of using it would be:

* Ability to use Heroku buildpacks, [Procfiles](https://devcenter.heroku.com/articles/procfile) and other architectural elements
* Ability to use Docker compose-files
* Self-hosted, so you can control the cost of the VMs or run locally at no cost
* Use Git as the deploy mechanism
* Free SSL certificates via the integrated Let's Encrypt mechanism
* Run multiple Grav sites in one VM with Dokku

The first step is to install it inside a fresh VM, running one of these Operating System distributions:

* Ubuntu x64 - Any currently supported release
* Debian 8.2+ x64
* CentOS 7 x64 (experimental)
* Arch Linux x64 (experimental)

To install the latest stable release, connect via Secure Shell (SSH) to your VM and run the following commands as a user who has access to root (sudo):

[prism classes="language-bash command-line"]
wget https://raw.githubusercontent.com/dokku/dokku/v0.17.9/bootstrap.sh
sudo DOKKU_TAG=v0.17.9 bash bootstrap.sh
[/prism]

After the installation-script ends, you need to visit your VMs IP-address or domain-name in a web browser to complete the installation. The screen will prompt you for:

* A public SSH key - This is used as the authentication token for deploys (same as Github or Gitlab does)

_Pro trick: If you are using **Vultr** or **Digital Ocean**, you can add the SSH key to the VM from the dashboard and it would be auto-added by Dokku._

* Hostname - must match the VM's hostname
* Slect between the option to use virtualhost-naming or sub-folders for apps

_Virtual host naming is typically preferred, but you could use either._

If you go down the virtualhost-naming path, you need to add a domain or subdomain to your VM, via a Domain Name Service provider like **Cloudflare** and also add a wildcard sub-domain of that domain or subdomain.

For simplicity, you can use the sub-folder structure and the VM's IP-address as hostname

Once the installation is complete, in your VM's terminal, create a new app for your Grav web site:

[prism classes="language-bash command-line"]
dokku apps:create my-grav-site
[/prism]

Let's go back to your local computer now.

Checkout the PHP "Getting Started" example Heroku provides with Git, in your local machine's web root, so you can test the site locally prior to deploying it.

[prism classes="language-bash command-line"]
git clone https://github.com/heroku/php-getting-started.git your-folder
[/prism]

[prism classes="language-bash command-line"]
cd your-folder
[/prism]

Add a Git remote to your Dokku server by doing the following:

[prism classes="language-bash command-line"]
git remote add dokku dokku@your-vm-hostname-or-ip:my-grav-site
[/prism]

and

[prism classes="language-bash command-line"]
git push dokku master
[/prism]

After deploying you should see an output similar to this one (this is from a Rails app so it's a bit different but works as an example):

[prism classes="language-bash command-line"]
Counting objects: 231, done.
Delta compression using up to 8 threads.
Compressing objects: 100% (162/162), done.
Writing objects: 100% (231/231), 36.96 KiB | 0 bytes/s, done.
Total 231 (delta 93), reused 147 (delta 53)
-----> Cleaning up...
-----> Building ruby-getting-started from herokuish...
-----> Adding BUILD_ENV to build environment...
-----> Ruby app detected
-----> Compiling Ruby/Rails
-----> Using Ruby version: ruby-2.2.1
-----> Installing dependencies using 1.9.7
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin -j4 --deployment
       Fetching gem metadata from https://rubygems.org/...........
       Fetching version metadata from https://rubygems.org/...
       Fetching dependency metadata from https://rubygems.org/..
       Using rake 10.4.2

...

=====> Application deployed:
       http://ruby-getting-started.dokku.me
[/prism]

At the end of the deploy output you will see the URL to your new app. Go ahead and visit it.

You should now see the sample PHP project. Now that all is set, you're ready to go on and run Grav instead of the sample site.

First, delete the web/ folder in your current site folder.

Copy your Grav site files there, making sure you're also copying the `.htaccess` hidden file. Overwrite all the files that were there already.

Now open the `Procfile`. This is a Heroku-specific file. Change the line to

[prism classes="language-text"]
web: vendor/bin/heroku-php-apache2 ./
[/prism]

You should make sure the site works locally, prior to uploading it to Heroku, just to ensure the are no errors.

Now commit to the repository with: `git add . ; git commit -am 'Added Grav'`

Then edit `composer.json` and add a post deploy command to the `scripts` section:

[prism classes="language-json line-numbers"]
"scripts": {
  "compile": [
    "bin/grav install",
    "bin/gpm install quark -y"
  ]
}
[/prism]

and commit that to the repository with:

[prism classes="language-bash command-line"]
git add . ; git commit -am 'Add post deploy bin/grav install'
[/prism]

Then run

[prism classes="language-bash command-line"]
git push dokku master
[/prism]

and the site should be good to go!

Due to the ephemeral nature of Dokku's filesystem, all needed plugins or themes must be added to `composer.json` just like above and kept there so they are installed every time the site is pushed to Heroku. You can make the Heroku-instance persistent, but it's not a good idea for scaling the app in the future. For example, if you need the Admin-plugin and a theme, add them in composer:

[prism classes="language-json line-numbers"]
"scripts": {
  "compile": [
    "bin/grav install",
    "bin/gpm install admin -y",
    "bin/gpm install awesome-theme-name-here -y"
  ]
}
[/prism]

**Note:** Special thanks to the author of the Heroku guide, as it was used as a base for this one due to the similarities of Dokku and Heroku.
