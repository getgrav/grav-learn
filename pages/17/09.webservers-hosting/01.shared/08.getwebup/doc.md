---
title: Getwebup
visible: true
taxonomy:
    category: docs
---
# Getwebup

[Getwebup](https://www.getwebup.in/web-hosting) is a hosting company in India. Its shared web hosting runs cPanel on LiteSpeed, which reads Grav's own `.htaccess` file as it is, so clean URLs and Grav's protection of the `user`, `system`, `logs` and `cache` folders work without any changes.

## Install Grav

Grav is also listed in **Softaculous** in cPanel. To install it by hand:

1. Download **Grav core + Admin plugin** from [getgrav.org/download](https://getgrav.org/download).
2. In cPanel's **File Manager**, upload the zip to `public_html` and extract it there.
3. Move the contents of the extracted `grav-admin` folder up into `public_html`, including the hidden `.htaccess` file.
4. Open your domain. Until an administrator account exists, every page redirects to the Admin plugin's **Register Admin User** form, and anyone who opens it can create that account, so create yours straight away.

## Choose the PHP version

Grav 1.7 needs PHP 7.3.6 or newer. In cPanel, open **Select PHP Version** and choose PHP 8.x. Grav runs with the extensions that are enabled by default.

## Update without SSH

Shared plans have no SSH access, so `bin/gpm` and `bin/grav` cannot be run there. Update Grav and its plugins from the Admin panel instead: its dashboard lists available updates and installs them.
