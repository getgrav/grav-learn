---
title: Crucial Web Hosting
menu: Crucial
visible: true
twig_first: true
process:
    twig: true
taxonomy:
    category: docs
---

[Crucial Web Hosting](http://www.crucialwebhost.com/promo/1421086/) is another of the new bread of modern web hosting platforms that focuses on both speed and support.  The use of **SSD drives** and **Litespeed** web servers with the latest **Intel XEON processors** ensures that Grav performs fantastically. Crucial also now provides PHP all the way up to the latest PHP 7.0 releases.

![](crucial.png)

In this guide, we will cover the essentials for configuring the **Tier-1 Split-Shared** hosting package to work optimally with Grav.

## Picking your Hosting Plan

[Crucial Web Hosting](http://www.crucialwebhost.com/promo/1421086/) has two primary options when it comes to hosting: **Spit-Shared** and **Split-Dedicated** hosting.  According to Crucial, these cloud-based options are superior to traditional hosting setups as they provide better isolation and performance.

Split-Shared hosting ranges from $10/month to $100/month depending on memory and SSD space.  Split Dedicated ranges from $150/month to $650/month depending on number of cores, memory, SSD space and bandwidth.  We'll just be using the baseline $10/month option that comes with 256MB of memory and 10GB of SSD space.

## Enabling SSH

First, you will have to open the **Toggle SSH Access** option in the **Security** section of cPanel. On this SSH Access page, you should click the **Enable SSH Access** button.

Then from the **Security Section** again, click the **Manage SSH Keys** option.

![](manage-ssh-keys.png)

There are two options at this point.  **Generate a New Key**, or **Import Key**. It's simpler to create your public/private key pair locally on your computer and then just import the DSA Public Key.

!! Windows users will first need to install [Cygwin](https://www.cygwin.com/) to provide many useful GNU and open source tools that are available on Mac and Linux platforms. When prompted to choose packages, ensure you check the SSH option. After installation, launch the `Cygwin Terminal`

Fire up a terminal window and type:

[prism classes="language-bash command-line"]
ssh-keygen -t dsa
[/prism]

This key generation script will prompt you to fill in some values, or you can just hit `[return]` to accept the default values.  This will create an `id_dsa` (private key), and an `id_dsa.pub` (public key) in a folder called `.ssh/` in your home directory. It is important to ensure you **NEVER** give out your private key, nor upload it anywhere, **only your public key**.

Once generate you can paste the contents of your `id_dsa.pub` public key into the `Public Key` field in the **Import SSH key** section of the **SSH Access** page:

![](ssh-public-key.png)

After uploading, you should see the key listed at the **Public Keys** section of the Manage SSH Keys page.  You then need to click **Manage** to ensure the key is authorized:

![](authorized-keys.png)

This means you are ready to test ssh'ing to your server.

[prism classes="language-bash command-line"]
ssh crucial_username@crucial_servername
[/prism]

Obviously, you will need to put in your Crucial-provided username for `crucial_username`, and the crucial-provided servername for `crucial_servername`.

## Configuring PHP

Currently Crucial Web Hosting defaults to **PHP 5.3**, which is not up to the minimum requirements for Grav. Luckily Crucial supports PHP all the way up to the latest **PHP 7.0** so we change the PHP version to something more current.

To do this, we have to add a special handler call in the `.htaccess` file in the web root.  So create the `~/www/.htaccess` file and put the following:

[prism classes="language-bash command-line"]
AddHandler application/x-httpd-php70 .php
[/prism]

Save the file. To test that you have the **correct version of PHP**, you can create a temporary file: `~/www/info.php` and put this in the contents:

[prism classes="language-php"]
<?php phpinfo();
[/prism]

Save the file and point your browser to this info.php file on your site, and you should be greeted with PHP information reflecting the version you selected earlier:

![](php-info.png)


!! If you are installing Grav at the root of your hosting account, you will need to add the **AddHandler** method to the top of the `.htaccess` file that is provided with Grav

!!! You can choose another version of php to run Grav under using such as PHP 5.6 with `x-httpd-php56` for example

## Setup CLI PHP

At the time of this writing, Crucial's default PHP version is **5.3**.  Because Grav requires PHP **5.5+**, we need to ensure that Grav is using a newer version of PHP on the command line (CLI).  To accomplish this, you should use SSH to access your server and create a new symbolic link to a newer PHP version in your user's `bin/` folder:

[prism classes="language-bash command-line"]
ln -s /usr/local/bin/php-70 ~/bin/php
[/prism]

Next, edit your `.bash_profile` file and add move the `$HOME/bin` reference in front of the regular `$PATH` string:

[prism classes="language-text line-numbers"]
# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
        . ~/.bashrc
fi

# User specific environment and startup programs

PATH=$HOME/bin:$PATH

export PATH
[/prism]

You will need _source_ the profile: `$ source ~/.bash_profile` or re-login to your terminal for you path change to take effect, but after doing so you should be able to type `php -v` and see:

[prism classes="language-bash command-line" cl-output="2-5"]
php -v
PHP 7.0.1 (cli) (built: Dec 28 2015 17:55:36) ( NTS )
Copyright (c) 1997-2015 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2015 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2015, by Zend Technologies
[/prism]

## Install and Test Grav

Using your new found SSH capabilities, let's SSH to your Crucial server (if you are not already there) and download the latest version of Grav, unzip it and test it out!

We will extract Grav into a `/grav` subfolder, but you could unzip directly into the root of your `~/www/` folder to ensure Grav is accessible directly.

[prism classes="language-bash command-line"]
cd ~/www
wget --no-check-certificate https://getgrav.org/download/core/grav/latest
unzip grav-v{{ grav_version }}.zip
[/prism]

You should now be able to point your browser to `http://mycrucialserver.com/grav` using the appropriate URL of course.

Because you have followed these instructions diligently, you will also be able to use the [Grav CLI](../../advanced/grav-cli) and [Grav GPM](../../advanced/grav-gpm) commands such as:

[prism classes="language-bash command-line" cl-output="3-13"]
cd ~/public_html/grav
bin/grav clear-cache

Clearing cache

Cleared:  cache/twig/*
Cleared:  cache/doctrine/*
Cleared:  cache/compiled/*
Cleared:  cache/validated-*
Cleared:  images/*
Cleared:  assets/*

Touched: /home/your_user/public_html/grav/user/config/system.yaml
[/prism]
