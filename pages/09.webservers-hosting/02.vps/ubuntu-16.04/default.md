---
title: Ubuntu 16.04 VPS Installation
---
{% set ssh_port = page.header.ssh_port %}

### Update and Upgrade Packages

At this point, you might want to either setup a local `/etc/hosts` entry to give the IP provided a nice friendly name such as `{{ page.header.localname }}`.  That way you can more easily SSH to your server with `ssh root@{{ page.header.localname }}{% if ssh_port %} -p{{ ssh_port }}{% endif %}`.

{% if ssh_port %}
!!! The `-p{{ ssh_port}}` configuration option is required in order to be able to the non-standard SSH port
{% endif %}

After successfully SSH'ing to your server as **root**, the first thing you will want to do is update and upgrade all the installed packages.  This will ensure you are running the _latest-and-greatest_:

```
$ apt update
$ apt upgrade
```

Just answer `Y` if prompted.

Before we go any further, let's remove **Apache2** which we will replace with **Nginx**:

```
$ apt remove apache2*
$ apt autoremove
```

Next you will want to install some essential packages:

```
$ apt install vim zip unzip nginx git php7.0-fpm php7.0-cli php7.0-gd php7.0-curl php7.0-mbstring php7.0-xml php7.0-zip php-apcu
```

This will install the complete VIM editor (rather than the mini version that ships with Ubuntu), Nginx web server, GIT commands, and **PHP 7.0**.

### Configure PHP7 FPM
Once php-fpm is installed, there is a slight configuration change that needs to take place for a more secure setup.

```
$ vi /etc/php/7.0/fpm/php.ini
```

Search for `cgi.fix_pathinfo`. This will be commented out by default and set to '1'.

This is an extremely insecure setting because it tells PHP to attempt to execute the closest file it can find if the requested PHP file cannot be found. This basically would allow users to craft PHP requests in a way that would allow them to execute scripts that they shouldn't be allowed to execute.

Uncomment this line and change '1' to '0' so it looks like this

```
$ cgi.fix_pathinfo=0
```

Save and close the file, and then restart the service.

```
$ systemctl restart php7.0-fpm
```

### Configure Nginx Connection Pool

Nginx has already been installed, but you should configure is so that it uses a user-specific PHP connection pool.  This will ensure you are secure and avoid any potential file permissions when working on the files as your user account, and via the web server.

Navigate to the pool directory and create a new `grav` configuration:

```
$ cd /etc/php/7.0/fpm/pool.d
$ mv www.conf www.conf.bak
$ vi grav.conf
```

In Vi, you can paste the following pool configuration:

```
[grav]

user = grav
group = grav

listen = /run/php/php7.0-fpm.sock

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

Create a simple `index.html` with the contents of:

```
 <h1>Working!</h1>
```

..and a file called `info.php` with the contents of:

```
<?php phpinfo();
```

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
    root /home/grav/www/html;
    server_name {{ page.header.localname }};
    ## End - Server Info

    ## Begin - Index
    # for subfolders, simply adjust the rewrite:
    # to use `/subfolder/index.php`
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    ## End - Index

    ## Begin - PHP
    location ~ \.php$ {
        # Choose either a socket or TCP/IP address
        fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;

        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    }
    ## End - PHP

    ## Begin - Security
    # deny all direct access for these folders
    location ~* /(.git|cache|bin|logs|backups)/.*$ { return 403; }
    # deny running scripts inside core system folders
    location ~* /(system|vendor)/.*\.(txt|xml|md|html|yaml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny running scripts inside user folder
    location ~* /user/.*\.(txt|md|yaml|php|pl|py|cgi|twig|sh|bat)$ { return 403; }
    # deny access to specific files in the root folder
    location ~ /(LICENSE|composer.lock|composer.json|nginx.conf|web.config|htaccess.txt|\.htaccess) { return 403; }
    ## End - Security
}
```

This is the stock `nginx.conf` file that comes with Grav with 2 changes. 1) the `root` has been adapted to our user/folder we just created and the `fastcgi_pass` option has been set to the socket we defined in our `grav` pool. Now we just need to link this file appropriately so that it's **enabled**:

```
$ cd ../sites-enabled
$ ln -s ../sites-available/grav
$ rm default
```

You can test the configuration with the command `nginx -t`. It should return the following.

```
nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
```

Now all we have to do is restart Nginx and the php7-fpm process and test to ensure we have configured Nginx and the PHP connection pool correctly:

```
$ service nginx restart
$ service php7.0-fpm restart
```

Now point your browser at your server: `http://{{ page.header.localname }}` and you should see the text: **Working!**

You can also test to ensure that PHP is installed and working correctly by pointing your browser to: `http://{{ page.header.localname }}/info.php`.  You should see a standard PHP info page with APCu, Opcache, etc listed.

### Installing Grav

This is the easy part!  First we need to jump back over to the Grav user, so either SSH as `grav@{{ page.header.localname }}` or `su - grav` from the root login. then follow these steps:

```
$ cd ~/www
$ wget -O grav-latest.zip https://getgrav.org/download/core/grav/latest
$ unzip grav-latest.zip
$ rm -Rf html
$ mv grav html
```

Now That's done you can confirm Grav is installed by pointing your browser to `http://{{ page.header.localname }}` and you should be greeted with the **Grav is Running!** page.

Because you have followed these instructions diligently, you will also be able to use the [Grav CLI](../../advanced/grav-cli) and [Grav GPM](../../advanced/grav-gpm) commands such as:

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