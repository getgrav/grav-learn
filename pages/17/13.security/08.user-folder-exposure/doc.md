---
title: User Folder Exposure
taxonomy:
    category: docs
description: What it means when Grav reports that your user/ folders are reachable over the web, why a default install is not at risk, and how to block direct access on any web server.
---
# User Folder Exposure

The Grav admin dashboard shows a notice like this when it can read a file from your `user/` folder directly over the web:

> Your web server is not applying Grav's access rules.

This page explains what that means and how to tidy it up. It is a configuration recommendation, not a sign that something is wrong with your site.

## Is anything at risk?

For a standard Grav install, no. Grav keeps nothing sensitive in `user/data`, and every release ships web server configurations (`.htaccess` for Apache, plus `nginx.conf` and others in the `webserver-configs/` folder) that block direct access to these folders. On a server that applies them, none of this is reachable.

The notice simply means those rules are not being applied right now, so files under `user/` can be requested directly. It is worth tightening up for two reasons:

1. **Third-party plugins.** Some plugins keep data under `user/data`. If a plugin stores something private there, you will want it behind the same protection as the rest of your site.
2. **The same rules cover more than one folder.** Applying them also keeps `user/accounts` and `user/config` private, which is good practice regardless.

Turning the rules back on takes a few lines of configuration, covered below.

## Why it happens

Grav relies on the web server to deny direct requests to its private folders. The block stops working when:

- You are on **Apache** but `.htaccess` files are ignored, because `AllowOverride` is set to `None` for your document root. This is the most common cause.
- You are on **Nginx**, **Caddy**, **LiteSpeed**, or another server that does **not** read `.htaccess` at all, and the equivalent rules were never added to the site configuration.
- A custom or host-provided server config replaced Grav's shipped rules without carrying these blocks across.

## How to fix it

The goal is the same on every server: deny direct web access to `user/accounts`, `user/config`, `user/env`, and `user/data` (while still allowing public media uploaded under `user/data`, such as images, to be served).

### Apache

First make sure `.htaccess` is being honored. In your virtual host (or the relevant `<Directory>` block), set:

```apache
<Directory /var/www/grav>
    AllowOverride All
    Require all granted
</Directory>
```

Reload Apache (`sudo systemctl reload apache2` or `sudo apachectl graceful`). Grav's bundled `.htaccess` already contains the rules below, so once `AllowOverride All` is active you are protected:

```apache
# Block all direct access to these sensitive user folders, whatever the file type
RewriteRule ^(user)/(accounts|config|env)/(.*) error [F]
# Block user/data too, but allow public media uploads (e.g. Flex Object images)
RewriteCond %{REQUEST_URI} !\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$ [NC]
RewriteRule ^(user)/data/(.*) error [F]
```

If you cannot enable `AllowOverride`, copy those rules into your virtual host configuration instead.

> [!NOTE]
> If you replaced or heavily edited the shipped `.htaccess`, compare it against the current one in the [Grav repository](https://github.com/getgrav/grav/blob/develop/.htaccess) and make sure the Security block is present.

### Nginx

Nginx does not read `.htaccess`. Add these `location` blocks to your site configuration (they are already present in the shipped `webserver-configs/nginx.conf`):

```nginx
# deny all direct access to these sensitive user folders, whatever the file type
location ~* /user/(accounts|config|env)/.*$ { return 403; }
# allow public media uploads under user/data to be served directly;
# this must come before the user/data deny so it wins the match
location ~* /user/data/.*\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$ { try_files $uri =404; }
# deny everything else under user/data
location ~* /user/data/.*$ { return 403; }
```

Then reload Nginx (`sudo nginx -t && sudo systemctl reload nginx`). The full, recommended configuration is documented under [Nginx](/webservers-hosting/servers/nginx).

### Caddy

Caddy also ignores `.htaccess`. Add a matcher that returns a 403 for the private folders, before your `php_fastcgi`/`file_server` directives:

```caddy
@gravBlocked path_regexp /user/(accounts|config|env)/.* /user/data/.*
respond @gravBlocked 403
```

If you serve public media from `user/data`, place a more specific matcher for the allowed image and media extensions ahead of the block so those requests still succeed.

### LiteSpeed

LiteSpeed reads `.htaccess` and is compatible with Grav's Apache rules, so enabling `.htaccess` (the equivalent of `AllowOverride All`) is enough. Confirm rewrite rules are turned on for the virtual host.

### Behind a proxy, CDN, or managed host

If your site sits behind a reverse proxy or CDN, or runs on a managed/shared host, the rules must be applied on whichever layer actually serves the files. Check with your host if you are unsure which server is in front.

## Confirming it is fixed

Visit the dashboard again after reloading your server. The warning checks live, by trying to download the test file the same way a visitor would, so once direct access is blocked the banner disappears on the next load.

You can also test by hand. A request like `https://www.example.com/user/config/system.yaml` should return **403 Forbidden** or **404 Not Found**, not the file's contents.

## A note on public media under user/data

Grav intentionally allows common image, audio, video, and PDF files under `user/data` to be served directly, so that media uploaded through Flex Objects and similar fields keeps working. This is by design and is not what the warning is about. The warning fires only when non-media files under your private folders are reachable. For serving private or arbitrary file uploads safely, route them through an application-level proxy rather than exposing the folder.
