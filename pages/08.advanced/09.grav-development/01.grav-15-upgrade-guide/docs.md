---
title: Upgrading from Grav <1.6
taxonomy:
    category: docs
---

!!! This guide has been tested for Grav v1.2.0 and all the later versions.

!! **WARNING**: Upgrading Grav directly to the latest version works, but is not fully supported and will likely cause your site to break!

## Preparations

The easiest way to upgrade older versions of Grav is to create a copy of your site into a Linux/Unix server which has **PHP 7.3** installed and supports SSH login to access CLI commands. This guide also works with Linux subsystem for Windows 10, but if you do not have it installed, you may have to download and rename the update packages manually.

**PHP 7.3** was chosen because of it is the only version of PHP which can be used for all the versions of Grav. You may also use PHP 7.1 or 7.2, but going that only allows you to upgrade Grav up to v1.6.31. At that point you would need to switch to PHP 7.3 or 7.4 before continuing the upgrade process. PHP 8 should only be used after upgrading to Grav 1.7 or later version.

This guide includes instructions to upgrade **Grav**, and the most commonly used packages: **Problems**, **Error**, **Form**, **Email**, **Login** and **Admin**. For every other plugin, make sure that they are still maintained and that it supports both Grav 1.6 and the latest version of Grav. As of writing this guide, almost all actively maintained plugins should fit into this category. The safest plugins are those, which have been updated after Grav 1.7.0 release (01/18/2021) or have been confirmed to work in Grav 1.7.

Your **theme** and any **custom** or **unmaintained plugins** will need more work. Any custom code should be checked through to make sure it still works with the current versions of Grav and PHP. The same is true with **Markdown**, **YAML** and **twig** files as the latter versions of the libraries have fixes which catch the errors, usually meaning that parsing of broken files will fail. Newer versions of Grav provide tools to check these files, but the checks do not catch all the issues, so some testing is also needed.

Checklist (using a console and Grav CLI):

* Take a backup
* Figure out Grav version by `bin/gpm version grav`
* Check PHP CLI version by `php -v`, it should be **PHP 7.3** (>=7.3.6)
* Check PHP server version, it should be the same as in CLI
* List all installed plugins and categorize them (supported, custom, unmaintained)
* Do the same with your theme

## Step to Grav 1.6.31

This part assumes that you have already made a copy of your site and the CLI commands work. Windows users who do not have Linux subsystem installed need to download the files manually and rename them.

Perform the following commands in the root folder of your Grav site (omit `-y` parameter in GPM command if you're using Grav 1.2 or below):

[prism classes="language-bash command-line"]
wget -q https://getgrav.org/download/core/grav-update/1.6.31 -O tmp/grav-update-v1.6.31.zip

bin/gpm direct-install -y tmp/grav-update-v1.6.31.zip
[/prism]

Grav can also be updated manually. Delete following folders: `assets bin system vendor  webserver-configs` and copy/override **all** the files from the Grav update zip file [found from here](https://getgrav.org/download/core/grav-update/1.6.31). Note that the files in the zip file are inside a `grav-update` folder.

Next we need to update the base plugins.

[prism classes="language-bash command-line"]
wget -q https://getgrav.org/download/plugins/problems/2.0.3 -O tmp/grav-plugin-problems-v2.0.3.zip
wget -q https://getgrav.org/download/plugins/error/1.7.1 -O tmp/grav-plugin-error-v1.7.1.zip
wget -q https://getgrav.org/download/plugins/form/4.3.0 -O tmp/grav-plugin-form-v4.3.0.zip
wget -q https://getgrav.org/download/plugins/email/3.1.0 -O tmp/grav-plugin-email-v3.1.0.zip
wget -q https://getgrav.org/download/plugins/login/3.3.8 -O tmp/grav-plugin-login-v3.3.8.zip
wget -q https://getgrav.org/download/plugins/admin/1.9.19 -O tmp/grav-plugin-admin-v1.9.19.zip


bin/gpm direct-install -y tmp/grav-plugin-problems-v2.0.3.zip
bin/gpm direct-install -y tmp/grav-plugin-error-v1.7.1.zip
bin/gpm direct-install -y tmp/grav-plugin-form-v4.3.0.zip
bin/gpm direct-install -y tmp/grav-plugin-email-v3.1.0.zip
bin/gpm direct-install -y tmp/grav-plugin-login-v3.3.8.zip
bin/gpm direct-install -y tmp/grav-plugin-admin-v1.9.19.zip
[/prism]

Alternatively plugins can be installed manually by just deleting all the files in `user/plugins/pluginnname` and copying files back from the zip file. Note that the files in the zip file are inside a semi-randomly named folder.

## Upgrading to Grav 1.7

Run following CLI commands one by one and follow their instructions:

[prism classes="language-bash command-line"]
bin/gpm self-upgrade
bin/gpm update
[/prism]

You may also want to update other plugins one by one to the latest version, but please do it only if the latest version of the plugin supports Grav 1.6. Rest of the plugins should be disabled if you are not sure if they will work. They can be re-enabled later, when you are testing the site.



!!! If you do not have broken plugins, Administration Panel and the site should be fully operational at this point.

!! **WARNING**: Avoid upgrading Grav or Admin plugin any further before you have read **[Upgrading to Grav 1.7](/advanced/grav-development/grav-17-upgrade-guide)**. You may end up breaking both your site and Admin Panel.

