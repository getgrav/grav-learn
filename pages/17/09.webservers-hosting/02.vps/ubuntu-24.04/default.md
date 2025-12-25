---
title: Ubuntu 24.04 LTS VPS Installation
---
<% set ssh_port = page.header.ssh_port %>

This guide covers installing Grav on a fresh Ubuntu 24.04 LTS (Noble Numbat) VPS with Nginx and PHP 8.3.

### Initial Server Setup

First, set up a local `/etc/hosts` entry to give your server IP a friendly name such as `<< page.header.localname|default('myserver.local') >>`. This makes it easier to SSH to your server:

[codesh=bash]
ssh root@<< page.header.localname|default('myserver.local') >><% if ssh_port %> -p<< ssh_port >><% endif %>
[/codesh]

<% if ssh_port %>
> [!NOTE]
> The `-p<< ssh_port >>` option is required for the non-standard SSH port.
<% endif %>

### Update System Packages

After connecting as **root**, update all installed packages:

[codesh=bash]
apt update && apt upgrade -y
[/codesh]

### Install Required Packages

Install Nginx, PHP 8.3, and essential extensions for Grav:

[codesh=bash]
apt install -y vim zip unzip nginx git \
    php8.3-fpm php8.3-cli php8.3-gd php8.3-curl \
    php8.3-mbstring php8.3-xml php8.3-zip php8.3-intl php8.3-apcu
[/codesh]

This installs:
- **Nginx** - High-performance web server
- **PHP 8.3-FPM** - FastCGI Process Manager for PHP
- **PHP Extensions** - Required by Grav for image processing, caching, etc.

### Configure PHP-FPM

Edit the PHP configuration for better security:

[codesh=bash]
vim /etc/php/8.3/fpm/php.ini
[/codesh]

Find `cgi.fix_pathinfo` (use `/cgi.fix_pathinfo` in vim to search), uncomment it and set to `0`:

[codesh=ini]
cgi.fix_pathinfo=0
[/codesh]

> [!WARNING]
> This setting prevents PHP from executing the closest matching file when the requested file isn't found - a significant security risk if left enabled.

### Create a Dedicated User

Create a `grav` user to run the site (don't run web apps as root):

[codesh=bash]
adduser grav
[/codesh]

Provide a strong password when prompted.

### Configure PHP-FPM Pool

Create a dedicated PHP-FPM pool for the grav user:

[codesh=bash]
cd /etc/php/8.3/fpm/pool.d
mv www.conf www.conf.bak
vim grav.conf
[/codesh]

Add the following configuration:

[codesh=ini line-numbers="true" title="grav.conf"]
[grav]
user = grav
group = grav

listen = /run/php/php8.3-fpm-grav.sock

listen.owner = www-data
listen.group = www-data

pm = dynamic
pm.max_children = 10
pm.start_servers = 3
pm.min_spare_servers = 2
pm.max_spare_servers = 5

chdir = /
[/codesh]

### Create Web Directory

Switch to the grav user and create the web directory:

[codesh=bash]
su - grav
mkdir -p ~/www/html
[/codesh]

Create a test file to verify the setup:

[codesh=bash]
echo '<?php phpinfo();' > ~/www/html/info.php
exit
[/codesh]

### Configure Nginx

Create the Nginx server block:

[codesh=bash]
vim /etc/nginx/sites-available/grav
[/codesh]

Add the following configuration:

[codesh=nginx line-numbers="true" title="grav"]
server {
    listen 80;
    index index.html index.php;

    ## Begin - Server Info
    root /home/grav/www/html;
    server_name _;
    ## End - Server Info

    ## Begin - Index
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    ## End - Index

    ## Begin - Security
    # deny all direct access for these folders
    location ~* /(\.git|cache|bin|logs|backup|tests)/.*$ { return 403; }
    # deny running scripts inside core system folders
    location ~* /(system|vendor)/.*\.(txt|xml|md|html|yaml|yml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny running scripts inside user folder
    location ~* /user/.*\.(txt|md|yaml|yml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny access to specific files in the root folder
    location ~ /(LICENSE\.txt|composer\.lock|composer\.json|nginx\.conf|web\.config|htaccess\.txt|\.htaccess) { return 403; }
    ## End - Security

    ## Begin - PHP
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm-grav.sock;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    }
    ## End - PHP
}
[/codesh]

Enable the site and remove the default:

[codesh=bash]
ln -s /etc/nginx/sites-available/grav /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default
[/codesh]

Test the configuration:

[codesh=bash]
nginx -t
[/codesh]

You should see:

[codesh=txt]
nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
[/codesh]

### Start Services

Restart Nginx and PHP-FPM:

[codesh=bash]
systemctl restart nginx
systemctl restart php8.3-fpm
[/codesh]

Verify PHP is working by visiting `http://YOUR_SERVER_IP/info.php`. You should see the PHP info page with PHP 8.3 and APCu listed.

> [!CAUTION]
> Remove the info.php file after testing: `rm /home/grav/www/html/info.php`

### Install Grav

Switch to the grav user and download Grav:

[codesh=bash]
su - grav
cd ~/www
wget -O grav.zip https://getgrav.org/download/core/grav/latest
unzip grav.zip
rm -rf html
mv grav html
[/codesh]

### Verify Installation

Visit `http://YOUR_SERVER_IP` and you should see the **Grav is Running!** page.

### Test CLI Tools

Since you're running as the `grav` user, CLI tools work out of the box:

[codesh=bash]
cd ~/www/html
bin/grav clear
[/codesh]

Output:

[codesh=txt]
Clearing cache

Cleared:  cache/twig/*
Cleared:  cache/compiled/*

Touched: /home/grav/www/html/user/config/system.yaml
[/codesh]

GPM commands also work:

[codesh=bash]
bin/gpm index
[/codesh]

### Optional: Install Admin Plugin

To install the Grav Admin panel:

[codesh=bash]
bin/gpm install admin
[/codesh]

Then visit `http://YOUR_SERVER_IP/admin` to create your admin account.

### Optional: Enable HTTPS with Let's Encrypt

For production sites, enable HTTPS using Certbot:

[codesh=bash]
apt install -y certbot python3-certbot-nginx
certbot --nginx -d yourdomain.com
[/codesh]

Certbot will automatically configure Nginx for SSL and set up auto-renewal.

### Next Steps

- [Configure your site](/17/basics/grav-configuration)
- [Install themes](/17/themes)
- [Add plugins](/17/plugins)
- [Create content](/17/content)
