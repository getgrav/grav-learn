---
title: Nginx
taxonomy:
    category: docs
---

*Nginx* is a HTTP server software with focus on core web server and proxy features. It is very common because of its ressource efficiency and responsiveness under load. Nginx spawns worker processes, each of which can handle thousands of connections. Each of the connections handled by the worker are placed within an event loop where they exist with other connections. Within the loop, events are processed asynchronously, allowing work to be handled in a non-blocking manner. When the connection closes, it is removed from the loop. This style of connection processing allows Nginx to scale incredibly far with limited resources.

<!-- source: https://www.digitalocean.com/community/tutorials/apache-vs-nginx-practical-considerations -->

## Requirements

This page explains how to run Grav with *Nginx* as the HTTP server and *PHP-FPM* (FastCGI Process Manager) to process PHP scripts, so these packages need to be installed on your server:

* `nginx`
* `php5-fpm`

## Configuration

If you are new to Nginx and don't yet have a basic understanding of block directives/context, it is recommended to read the Nginx [Beginners's Guide](http://nginx.org/en/docs/beginners_guide.html), especially the sections [Configuration File’s Structure](http://nginx.org/en/docs/beginners_guide.html#conf_structure) and [Serving Static Content](http://nginx.org/en/docs/beginners_guide.html#static).

It is assumed that your Nginx configuration is located in `/etc/nginx/` and your Grav installation is stored in `/var/www/grav/`. The structure of the configuration is a `http` block that contains general directives relevant for all pages served by Nginx, as well as one or multiple `server` blocks for each page, containing site-specific directives. The main server configuration file is `nginx.conf` and stores the `http` block, while site-specific configurations (`server` blocks) are stored in `sites-available` and symlinked to `sites-enabled`.

### File Permissions

The `/var/www` directory and all contained files and folders should be owned by `$USER:www-data` (or whatever you name the Nginx user/group). The section <troubleshooting/permissions> explains how to setup file and directory permissions for Grav, in this case using a shared group. Basically what you want is `775` for directories and `664` for files in the Grav directory, so Grav is allowed to modify content and upgrade itself. You should add your user to the `www-data` group so you can access files that are created by Grav/Nginx.


### Example nginx.conf

The following is an example Nginx configuration file (`/etc/nginx/nginx.conf`) with explanations and links to help understand what the different directives achieve. It has some improvements over the default configuration.

**nginx.conf**:

```nginx
user www-data; # nginx user
worker_processes 1; # increase this for high traffic sites, see [1], [2]
pid /run/nginx.pid; # path to process id file

events {
    use epoll; # see [1], [2]
    worker_connections 1024; # see [1]
    multi_accept on; # http://nginx.org/en/docs/ngx_core_module.html#multi_accept
}

http {
    # you can find documentation for http directives at
    # http://nginx.org/en/docs/http/ngx_http_core_module.html
    
    # https://t37.net/nginx-optimization-understanding-sendfile-tcp_nodelay-and-tcp_nopush.html
    sendfile on;
    tcp_nopush on;
    tcp_nodelay on;
    
    keepalive_timeout 70; # enables keep-alive connections with specified timeout
    types_hash_max_size 2048; # http://nginx.org/en/docs/http/ngx_http_core_module.html#types_hash_max_size
    server_tokens off; # disable server version output in error pages
    
    # maximum file upload size
    # if you increase it, also update 'upload_max_filesize' and 'post_max_size' in /etc/php5/fpm/php.ini
    client_max_body_size 1m;
    # increase client body timeout if you have very long file uploads
    # client_body_timeout 60s;
    
    # set default index file (can be overwritten for each site individually)
    index index.html;
    
    # load MIME types
    include mime.types;
    default_type application/octet-stream; # set default MIME type of responses
    
    # logging
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;
    
    # turn on gzip compression, see [1]
    gzip on;
    gzip_disable "msie6";
    gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript;
    
    # security
    add_header X-Content-Type-Options nosniff; # disable content type sniffing
    
    # include virtual host configs
    include sites-enabled/*;
}
```

> [1]: http://www.revsys.com/12days/nginx-tuning/  
> [2]: https://www.linode.com/docs/websites/nginx/configure-nginx-for-optimized-performance

### Grav Site Configuration

Grav gets shipped with a configuration file for your site in the `webserver-configs` directory of your Grav installation. You can copy that file into your nginx config directory:

```bash
cp /var/www/grav/webserver-configs/nginx /etc/nginx/sites-available/grav-site
```

Open that file with an editor and replace "domain.tld" with your domain/IP (or "localhost" if you want to just run it locally), then create a symbolic link of your site-config in `sites-enabled`:

```bash
ln -s /etc/nginx/sites-available/grav-site /etc/nginx-sites-enabled/grav-site
```

Finally let Nginx reload its configuration:

```bash
nginx -s reload
```

### Fix against httpoxy vulnerability

> httpoxy is a set of vulnerabilities that affect application code running in CGI, or CGI-like environments.  
> (Source: [httpoxy.org](https://httpoxy.org))

In order to secure your site against this vulnerability you should block the `Proxy` header. This can be done by adding a FastCGI parameter to your config. Simply open the file `/etc/nginx/fastcgi.conf` and add this line at the end:

```nginx
fastcgi_param  HTTP_PROXY         "";
```

### Using SSL (with an existing certificate)

If you want to use an existing SSL certificate to encrypt your website traffic, this section provides the necessary steps to modify your Nginx configuration for that.

First, create a file `/etc/nginx/ssl.conf` with the following content and adjust the paths to your certificate and key file. Also check if all of these options work for your setup.

**ssl.conf**:

```nginx
# set the paths to your cert and key files here
ssl_certificate /etc/ssl/certs/domain.tld.crt;
ssl_certificate_key /etc/ssl/private/domain.tld.key;

##########
# Originally adapted from https://gist.github.com/konklone/6532544
# See some related discussion and detail there.
##########

# HTTP Strict Transport Security: tells browsers to require https:// without first checking
# the http:// version for a redirect. Warning: it is difficult to change your mind.
#
# max-age: length of requirement in seconds (31536000 = 1 year)
# includeSubdomains: force SSL for *ALL* subdomains (remove if this is not what you want)
# preload: indicates you want browsers to ship with HSTS preloaded for your domain.
#
# Submit your domain for preloading in browsers at: https://hstspreload.appspot.com

add_header Strict-Transport-Security 'max-age=31536000; includeSubDomains';


# If you *can't* guarantee that all subdomains above the one you're securing will be TLS,
# then comment out the above and uncomment the line below.

# add_header Strict-Transport-Security 'max-age=31536000';


# Prefer certain ciphersuites, to enforce Forward Secrecy and avoid known vulnerabilities.
#
# Forces forward secrecy in all browsers and clients that can use TLS,
# but with a small exception (DES-CBC3-SHA) for IE8/XP users.
#
# Reference client: https://www.ssllabs.com/ssltest/analyze.html

ssl_prefer_server_ciphers on;
ssl_ciphers 'kEECDH+ECDSA+AES128 kEECDH+ECDSA+AES256 kEECDH+AES128 kEECDH+AES256 kEDH+AES128 kEDH+AES256 DES-CBC3-SHA +SHA !aNULL !eNULL !LOW !MD5 !EXP !DSS !PSK !SRP !kECDH !CAMELLIA !RC4 !SEED';


# Cut out the old, broken, insecure SSLv2 and SSLv3 entirely.

ssl_protocols TLSv1.2 TLSv1.1 TLSv1;


# Turn on session resumption, using a 10 min cache shared across nginx processes,
# as recommended by http://nginx.org/en/docs/http/configuring_https_servers.html
# (or also http://nginx.org/en/docs/http/ngx_http_ssl_module.html#example)

ssl_session_cache shared:SSL:10m;
ssl_session_timeout 10m;


# Buffer size of 1400 bytes fits in one MTU.

# ssl_buffer_size 1400;


# SPDY header compression (0 for none, 9 for slow/heavy compression). Preferred is 6.
#
# BUT: header compression is flawed and vulnerable in SPDY versions 1 - 3.
# Disable with 0, until using a version of nginx with SPDY 4.

# spdy_headers_comp 0;


# Now let's really get fancy, and pre-generate a 2048 bit random parameter
# for DH elliptic curves. If not created and specified, default is only 1024 bits.
#
# Generated by OpenSSL with the following command:
# openssl dhparam -outform pem -out dhparam2048.pem 2048

ssl_dhparam /etc/nginx/dhparam2048.pem;
```

As you can see in the last line there is an option `ssl_dhparam` being set, we need to create a paramter file for that to work:

```bash
cd /etc/nginx/
openssl dhparam -outform pem -out dhparam2048.pem 2048
```

Now change the content of your Grav-specific config `/etc/nginx/sites-available/grav-site` to redirect unencrypted HTTP requests to HTTPS, that means to a `server` block listening on port 443 and including your `ssl.conf` (replace "domain.tld" with your domain/IP):

**grav-site**:

```nginx
server {
    listen 80;
    server_name www.domain.tld domain.tld;

    # redirect to https
    return 301 https://domain.tld$request_uri; # or www.domain.tld
}

server {
    listen 443 ssl;
    server_name domain.tld; # or www.domain.tld (depending on redirect)

    # add ssl cert & options
    include ssl.conf

    root /var/www/grav;
    
    index index.html index.php;
    
    # ...
    # the rest of this server block (location directives) is identical to the one from the shipped config
}
```

Finally reload your Nginx configuration:

```bash
nginx -s reload
```

<!-- TODO: ### Using a Let's Encrypt SSL certificate -->
