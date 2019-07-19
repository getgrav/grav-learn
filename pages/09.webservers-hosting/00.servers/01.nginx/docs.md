---
title: Nginx
routes:
    aliases:
        - '/webservers-hosting/local/nginx'
taxonomy:
    category: docs
shortcode-core:
    parser: regex
---

*Nginx* is a HTTP server software with focus on core web server and proxy features. It is very common because of its resource efficiency and responsiveness under load. Nginx spawns worker processes, each of which can handle thousands of connections. Each of the connections handled by the worker get placed within an event loop where they exist with other connections. Within the loop, events get processed asynchronously, allowing work to be handled in a non-blocking manner. When the connection closes, it gets removed from the loop. This style of connection processing allows Nginx to scale incredibly far with limited resources.

<!-- source: https://www.digitalocean.com/community/tutorials/apache-vs-nginx-practical-considerations -->

## Requirements

This page explains how to run Grav with *Nginx* as the HTTP server and *PHP-FPM* (FastCGI Process Manager) to process PHP scripts, so these packages need to be installed on your server:

* `nginx`
* `php5-fpm`

## Configuration

If you are new to Nginx and don't yet have a basic understanding of block directives/context, it is recommended to read the Nginx [Beginners's Guide](http://nginx.org/en/docs/beginners_guide.html), especially the sections [Configuration File’s Structure](http://nginx.org/en/docs/beginners_guide.html#conf_structure) and [Serving Static Content](http://nginx.org/en/docs/beginners_guide.html#static).

It is assumed that your Nginx configuration is located in `/etc/nginx/` and your Grav installation is stored in `/var/www/grav/`. The structure of the configuration is a `http` block that contains general directives relevant for all pages served by Nginx, as well as one or multiple `server` blocks for each page, containing site-specific directives. The main server configuration file is `nginx.conf` and stores the `http` block, while site-specific configurations (`server` blocks) are stored in `sites-available` and symlinked to `sites-enabled`.

### File Permissions

The `/var/www` directory and all contained files and folders should be owned by `$USER:www-data` (or whatever you name the Nginx user/group). The section [Troubleshooting/Permissions](https://learn.getgrav.org/16/troubleshooting/permissions) explains how to setup file and directory permissions for Grav, in this case using a shared group. Basically what you want is `775` for directories and `664` for files in the Grav directory, so Grav is allowed to modify content and upgrade itself. You should add your user to the `www-data` group so you can access files that are created by Grav/Nginx.


### Example nginx.conf

The following configuration is an improved version of the default `/etc/nginx/nginx.conf` file, mainly with improvements from [github.com/h5bp/server-configs-nginx](https://github.com/h5bp/server-configs-nginx). See their repository for explanations on these settings or the Nginx [core module](http://nginx.org/en/docs/ngx_core_module.html) and [http module](http://nginx.org/en/docs/http/ngx_http_core_module.html) documentation to look up specific directives.

!! It is recommended to use an updated MIME types definition file (`mime.types`) from [github.com/h5bp/server-configs-nginx](https://github.com/h5bp/server-configs-nginx). This will make sure that the types are correctly set for gzip compression.

**nginx.conf**:

[prism classes="language-nginx line-numbers"]
user www-data;
worker_processes auto;
worker_rlimit_nofile 8192; # should be bigger than worker_connections
pid /run/nginx.pid;

events {
    use epoll;
    worker_connections 8000;
    multi_accept on;
}

http {
    sendfile on;
    tcp_nopush on;
    tcp_nodelay on;

    keepalive_timeout 30; # longer values are better for each ssl client, but take up a worker connection longer
    types_hash_max_size 2048;
    server_tokens off;

    # maximum file upload size
    # update 'upload_max_filesize' & 'post_max_size' in /etc/php5/fpm/php.ini accordingly
    client_max_body_size 32m;
    # client_body_timeout 60s; # increase for very long file uploads

    # set default index file (can be overwritten for each site individually)
    index index.html;

    # load MIME types
    include mime.types; # get this file from https://github.com/h5bp/server-configs-nginx
    default_type application/octet-stream; # set default MIME type

    # logging
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;

    # turn on gzip compression
    gzip on;
    gzip_disable "msie6";
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 5;
    gzip_buffers 16 8k;
    gzip_http_version 1.1;
    gzip_min_length 256;
    gzip_types
        application/atom+xml
        application/javascript
        application/json
        application/ld+json
        application/manifest+json
        application/rss+xml
        application/vnd.geo+json
        application/vnd.ms-fontobject
        application/x-font-ttf
        application/x-web-app-manifest+json
        application/xhtml+xml
        application/xml
        font/opentype
        image/bmp
        image/svg+xml
        image/x-icon
        text/cache-manifest
        text/css
        text/plain
        text/vcard
        text/vnd.rim.location.xloc
        text/vtt
        text/x-component
        text/x-cross-domain-policy;

    # disable content type sniffing for more security
    add_header "X-Content-Type-Options" "nosniff";

    # force the latest IE version
    add_header "X-UA-Compatible" "IE=Edge";

    # enable anti-cross-site scripting filter built into IE 8+
    add_header "X-XSS-Protection" "1; mode=block";

    # include virtual host configs
    include sites-enabled/*;
}
[/prism]

### Grav Site Configuration

Grav gets shipped with a configuration file for your site in the `webserver-configs` directory of your Grav installation. You can copy that file into your nginx config directory:

[prism classes="language-bash command-line"]
cp /var/www/grav/webserver-configs/nginx.conf /etc/nginx/sites-available/grav-site
[/prism]

Open that file with an editor and replace "example.com" with your domain/IP (or "localhost" if you want to just run it locally), replace the "root" line with "root /var/www/grav/;" and then create a symbolic link of your site-config in `sites-enabled`:

[prism classes="language-bash command-line"]
ln -s /etc/nginx/sites-available/grav-site /etc/nginx/sites-enabled/grav-site
[/prism]

<!--
!! It is recommended to use the file `expires.conf` from [github.com/h5bp/server-configs-nginx](https://github.com/h5bp/server-configs-nginx) (in the directory `h5bp/location/`). It will set "Expires" headers for different file types, so the browser can cache them. Save the file somewhere in your `/etc/nginx/` directory and include it in your site config, e.g. before the first location directive in `/etc/nginx/sites-available/grav-site`.
-->

Finally let Nginx reload its configuration:

[prism classes="language-bash command-line"]
nginx -s reload
[/prism]

### Fix against httpoxy vulnerability

> httpoxy is a set of vulnerabilities that affect application code running in CGI, or CGI-like environments.
> (Source: [httpoxy.org](https://httpoxy.org))

In order to secure your site against this vulnerability you should block the `Proxy` header. This can be done by adding a FastCGI parameter to your config. Simply open the file `/etc/nginx/fastcgi.conf` and add this line at the end:

[prism classes="language-nginx"]
fastcgi_param  HTTP_PROXY         "";
[/prism]

### Using SSL (with an existing certificate)

If you want to use an existing SSL certificate to encrypt your website traffic, this section provides the necessary steps to modify your Nginx configuration for that.

First, create a file `/etc/nginx/ssl.conf` with the following content and adjust the paths to your certificate and key file. The last section is about OSCP stapling and requires you to provide a chain+root certificate. If you don't want this, you can comment or remove everything below the `OCSP Stapling` comment. If your website is SSL only (including subdomains), you can submit your domain for preloading in browsers at <https://hstspreload.appspot.com>. If that isn't the case, you can remove ` preload;` from the line that adds the "Strict-Transport-Security" header. Make sure to check if all of these options work for your setup.

**ssl.conf**:

[prism classes="language-nginx line-numbers"]
# set the paths to your cert and key files here
ssl_certificate /etc/ssl/certs/example.com.crt;
ssl_certificate_key /etc/ssl/private/example.com.key;

ssl_protocols TLSv1 TLSv1.1 TLSv1.2;

ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:DHE-DSS-AES128-GCM-SHA256:kEDH+AESGCM:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:DHE-DSS-AES128-SHA256:DHE-RSA-AES256-SHA256:DHE-DSS-AES256-SHA:DHE-RSA-AES256-SHA:ECDHE-RSA-DES-CBC3-SHA:ECDHE-ECDSA-DES-CBC3-SHA:AES128-GCM-SHA256:AES256-GCM-SHA384:AES128-SHA256:AES256-SHA256:AES128-SHA:AES256-SHA:AES:CAMELLIA:DES-CBC3-SHA:!aNULL:!eNULL:!EXPORT:!DES:!RC4:!MD5:!PSK:!aECDH:!EDH-DSS-DES-CBC3-SHA:!EDH-RSA-DES-CBC3-SHA:!KRB5-DES-CBC3-SHA;
ssl_prefer_server_ciphers on;

ssl_session_cache shared:SSL:10m; # a 1mb cache can hold about 4000 sessions, so we can hold 40000 sessions
ssl_session_timeout 24h;

# Use a higher keepalive timeout to reduce the need for repeated handshakes
keepalive_timeout 300s; # up from 75 secs default

# submit domain for preloading in browsers at: https://hstspreload.appspot.com
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload;";

# OCSP stapling
# nginx will poll the CA for signed OCSP responses, and send them to clients so clients don't make their own OCSP calls.
# see https://sslmate.com/blog/post/ocsp_stapling_in_apache_and_nginx on how to create the chain+root
ssl_stapling on;
ssl_stapling_verify on;
ssl_trusted_certificate /etc/ssl/certs/example.com.chain+root.crt;
resolver 198.51.100.1 198.51.100.2 203.0.113.66 203.0.113.67 valid=60s;
resolver_timeout 2s;
[/prism]

Now change the content of your Grav-specific config `/etc/nginx/sites-available/grav-site` to redirect unencrypted HTTP requests to HTTPS, that means to a `server` block listening on port 443 and including your `ssl.conf` (replace "example.com" with your domain/IP). You can also change this to redirect from the non-www to the www version of your domain.

**grav-site**:

[prism classes="language-nginx line-numbers"]
# redirect http to non-www https
server {
    listen [::]:80;
    listen 80;
    server_name example.com www.example.com;

    return 302 https://example.com$request_uri;
}

# redirect www https to non-www https
server {
    listen [::]:443 ssl;
    listen 443 ssl;
    server_name www.example.com;

    # add ssl cert & options
    include ssl.conf;

    return 302 https://example.com$request_uri;
}

# serve website
server {
    listen [::]:443 ssl;
    listen 443 ssl;
    server_name example.com;

    # add ssl cert & options
    include ssl.conf;

    root /var/www/example.com;

    index index.html index.php;

    # ...
    # the rest of this server block (location directives) is identical to the one from the shipped config
}
[/prism]

Finally reload your Nginx configuration:

[prism classes="language-bash command-line"]
nginx -s reload
[/prism]

<!-- TODO: ### Using a Let's Encrypt SSL certificate -->
