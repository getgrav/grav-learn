---
title: Generic VPS Installation
---

### Update and Upgrade Packages

At this point, you might want to either setup a local `/etc/hosts` entry to give the IP provided a nice friendly name such as `{{ page.header.localname }}`.  That way you can more easily SSH to your server with `ssh root@{{ page.header.localname }}`.

After successfully SSH'ing to your server as **root**, the first thing you will want to do is update and upgrade all the installed packages.  This will ensure you are running the _latest-and-greatest_:

```
$ apt-get update
$ apt-get upgrade
```

Just answer `Y` if prompted.

Next you will want to install some essential packages:

```
$ apt-get install vim zip unzip nginx git php5-fpm php5-cli php5-gd php5-curl php5-apcu
```

This will install the complete VIM editor (rather than the mini version that ships with Ubuntu), Nginx web server, GIT commands, and **PHP 5.5**.

!! If you would prefer to use **PHP 5.6**, you probably should start over and provision your server with **Ubuntu 15.10** which is the more cutting edge version of Ubuntu.

### Configure Nginx Connection Pool

Nginx has already been installed, but you should configure is so that it uses a user-specific PHP connection pool.  This will ensure you are secure and avoid any potential file permissions when working on the files as your user account, and via the web server.

Navigate to the pool directory and create a new `grav` configuration:

```
$ cd /etc/php5/fpm/pool.d
$ vi grav.conf
```

In Vi, you can paste the following pool configuration:

```
[grav]

user = grav
group = grav

listen = /var/run/php5-fpm.grav.sock

listen.owner = www-data
listen.group = www-data

pm = dynamic
pm.max_children = 5
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3

chdir = /
```

The key things here are the `user` and `group` being set to a user called `grav`, and the listen socket having a unique name from the standard socket.  Save and exit this file.

We need to create the dedicated `grav` user now:

```
$ adduser grav
```

Provide a strong password, and leave the other values as default. We need to next create an appropriate location for Nginx to serve files from, so let's switch user and create those folder, and create a couple of test files:

```
$ su - grav
$ mkdir www;cd www;mkdir html;cd html
```

Create a simple `index.html` with the contents of `<h1>Working!</h1>` and a file called `info.php` with the contents of `<?php phpinfo();`

Now we can exit out of this user and return to root in order to setup the Nginx server configuration:

```
$ exit
$ cd /etc/nginx/sites-available/
$ vi grav
```

Then simply paste in this configuration:

```
server {
    #listen 80;
    index index.html index.php;

    ## Begin - Server Info
    root /home/USER/www/html;
    server_name localhost;
    ## End - Server Info

    ## Begin - Index
    # for subfolders, simply adjust:
    # `location /subfolder {`
    # and the rewrite to use `/subfolder/index.php`
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
        # Choose either a socket or TCP/IP address
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        # fastcgi_pass unix:/var/run/php5-fpm.sock; #legacy
        # fastcgi_pass 127.0.0.1:9000;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    }
    ## End - PHP
}
```

This is the stock `nginx.conf` file that comes with Grav with 2 changes. 1) the `root` has been adapted to our user/folder we just created and the `fastcgi_pass` option has been set to the socket we defined in our `grav` pool. Now we just need to link this file appropriately so that it's **enabled**:

```
$ cd ../sites-enabled
$ ln -s ../sites-available/grav
$ rm default
```

Now all we have to do is restart Nginx and the php5-fpm process and test to ensure we have configured Nginx and the PHP connection pool correctly:

```
$ service nginx restart
$ service php5-fpm restart
```

Now point your browser at your server: `http://{{ page.header.localname }}` and you should see the text: **Working!**

You can also test to ensure that PHP is installed and working correctly by pointing your browser to: `http://{{ page.header.localname }}/info.php`.  You should see a standard PHP info page with APCu, Opcache, etc listed.

### Installing Grav

This is the easy part!  First we need to jump back over to the Grav user, so either SSH as `grav@{{ page.header.localname }}` or `su - grav` from the root login. then follow these steps:

```
$ cd ~/www
$ wget https://getgrav.org/download/core/grav/latest
$ unzip grav-v{{ grav_version }}.zip
$ rm -Rf html
$ mv grav html
```

Now That's done you can confirm Grav is installed by poiting your browser to `http://{{ page.header.localname }}` and you should be greeted with the **Grav is Running!** page.

Because you have followed these instructions diligently, you will also be able to use the [Grav CLI](../../../advanced/grav-cli) and [Grav GPM](../../../advanced/grav-gpm) commands such as:

```
$ cd ~/www/html
$ bin/grav clear

Clearing cache

Cleared:  cache/twig/*
Cleared:  cache/compiled/*

Touched: /home/grav/www/html/user/config/system.yaml
```

and GPM commands:

```
$ bin/gpm index
```
