---
title: Ubuntu 18.04 VPS Installation
---
{% set ssh_port = page.header.ssh_port %}

### Update and Upgrade Packages

At this point, you might want to either setup a local `/etc/hosts` entry to give the IP provided a nice friendly name such as `{{ page.header.localname }}`.  That way you can more easily SSH to your server with `ssh root@{{ page.header.localname }}{% if ssh_port %} -p{{ ssh_port }}{% endif %}`.

{% if ssh_port %}
!!! The `-p{{ ssh_port}}` configuration option is required in order to be able to the non-standard SSH port
{% endif %}

After successfully SSH'ing to your server as **root**, the first thing you will want to do is update and upgrade all the installed packages.  This will ensure you are running the _latest-and-greatest_:

[prism classes="language-bash command-line"]
# apt update
# apt upgrade
[/prism]

Just answer `Y` if prompted.

Before we go any further, let's remove **Apache2** which we will replace with **Nginx**:

[prism classes="language-bash command-line"]
# apt remove apache2*
# apt autoremove
[/prism]

!! NOTE: You might not have this installed.  But better safe than sorry!

Next you will want to install some essential packages:

[prism classes="language-bash command-line"]
# apt install vim zip unzip nginx git php-fpm php-cli php-gd php-curl php-mbstring php-xml php-zip php-apcu
[/prism]

This will install the complete VIM editor (rather than the mini version that ships with Ubuntu), Nginx web server, GIT commands, and **PHP 7.2**.

### Configure PHP7.2 FPM
Once php-fpm is installed, there is a slight configuration change that needs to take place for a more secure setup.


[prism classes="language-bash command-line"]
# vim /etc/php/7.2/fpm/php.ini
[/prism]

Search for `cgi.fix_pathinfo`. This will be commented out by default and set to '1'.

This is an extremely insecure setting because it tells PHP to attempt to execute the closest file it can find if the requested PHP file cannot be found. This basically would allow users to craft PHP requests in a way that would allow them to execute scripts that they shouldn't be allowed to execute.

Uncomment this line and change '1' to '0' so it looks like this


[prism classes="language-bash command-line"]
cgi.fix_pathinfo=0
[/prism]

Save and close the file, and then restart the service.


[prism classes="language-bash command-line"]
# systemctl restart php7.2-fpm 
[/prism]

### Configure Nginx Connection Pool

Nginx has already been installed, but you should configure is so that it uses a user-specific PHP connection pool.  This will ensure you are secure and avoid any potential file permissions when working on the files as your user account, and via the web server.

Navigate to the pool directory and create a new `grav` configuration:


[prism classes="language-bash command-line"]
# cd /etc/php/7.2/fpm/pool.d
# mv www.conf www.conf.bak
# vim grav.conf
[/prism]

In Vim, you can paste the following pool configuration:

[prism classes="language-apache line-numbers"]
[grav]

user = grav
group = grav

listen = /var/run/php/php7.2-fpm.sock

listen.owner = www-data
listen.group = www-data

pm = dynamic
pm.max_children = 5
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3

chdir = /
[/prism]

The key things here are the `user` and `group` being set to a user called `grav`, and the listen socket having a unique name from the standard socket.  Save and exit this file.

We need to create the dedicated `grav` user now:

[prism classes="language-bash command-line"]
# adduser grav
[/prism]

Provide a strong password, and leave the other values as default. We need to next create an appropriate location for Nginx to serve files from, so let's switch user and create those folder, and create a couple of test files:

[prism classes="language-bash command-line"]
# su - grav
$ mkdir -p www/html
$ cd www/html
[/prism]

Create a simple `index.html` with the contents of:

[prism classes="language-html"]
 <h1>Working!</h1>
[/prism]

..and a file called `info.php` with the contents of:

[prism classes="language-php"]
<?php phpinfo();
[/prism]

Now we can exit out of this user and return to root in order to setup the Nginx server configuration:

[prism classes="language-bash command-line"]
$ exit
# cd /etc/nginx/sites-available/
# vim grav
[/prism]

Then simply paste in this configuration:

[prism classes="language-nginx line-numbers"]
server {
    #listen 80;
    index index.html index.php;

    ## Begin - Server Info
    root /home/grav/www/html;
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
[/prism]

This is the stock `nginx.conf` file that comes with Grav with 2 changes. 1) the `root` has been adapted to our user/folder we just created and the `fastcgi_pass` option has been set to the socket we defined in our `grav` pool. Now we just need to link this file appropriately so that it's **enabled**:

[prism classes="language-bash command-line"]
# cd ../sites-enabled
# ln -s ../sites-available/grav
# rm default
[/prism]

You can test the configuration with the command `nginx -t`. It should return the following.

[prism classes="language-bash command-line"]
nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
[/prism]

Now all we have to do is restart Nginx and the php7-fpm process and test to ensure we have configured Nginx and the PHP connection pool correctly:

[prism classes="language-bash command-line"]
# systemctl restart nginx 
# systemctl restart php7.2-fpm
[/prism]

Now point your browser at your server: `http://{{ page.header.localname }}` and you should see the text: **Working!**

You can also test to ensure that PHP is installed and working correctly by pointing your browser to: `http://{{ page.header.localname }}/info.php`.  You should see a standard PHP info page with APCu, Opcache, etc listed.

### Installing Grav

This is the easy part!  First we need to jump back over to the Grav user, so either SSH as `grav@{{ page.header.localname }}` or `su - grav` from the root login. then follow these steps:

[prism classes="language-bash command-line"]
$ cd ~/www
$ wget -O grav.zip https://getgrav.org/download/core/grav/latest
$ unzip grav.zip
$ rm -Rf html
$ mv grav html
[/prism]

Now That's done you can confirm Grav is installed by pointing your browser to `http://{{ page.header.localname }}` and you should be greeted with the **Grav is Running!** page.

Because you have followed these instructions diligently, you will also be able to use the [Grav CLI](../../advanced/grav-cli) and [Grav GPM](../../advanced/grav-gpm) commands such as:

[prism classes="language-bash command-line"]
$ cd ~/www/html
$ bin/grav clear

Clearing cache

Cleared:  cache/twig/*
Cleared:  cache/compiled/*

Touched: /home/grav/www/html/user/config/system.yaml
[/prism]

and GPM commands:

[prism classes="language-bash command-line"]
$ bin/gpm index
[/prism]
