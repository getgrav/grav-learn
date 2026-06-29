---
title: Apache
taxonomy:
    category: docs
description: How to run Grav on Apache, the AllowOverride requirement that makes the bundled .htaccess work, the RewriteBase setting for subfolder installs, and the security rules Grav ships.
---
# Apache

*Apache* is the most widely deployed HTTP server and the default on the majority of shared hosts. Grav is designed to run on Apache out of the box: every release ships an `.htaccess` file in the site root that handles URL rewriting and blocks direct access to private folders, so in most cases there is nothing to configure beyond making sure Apache is allowed to read that file.

## Requirements

To run Grav on Apache you need:

* `apache2` with the `mod_rewrite` module enabled (`sudo a2enmod rewrite`)
* `php` available to Apache, either through `mod_php`, or (recommended) `php-fpm` via `mod_proxy_fcgi`

## Enable .htaccess overrides

Apache only reads the bundled `.htaccess` when `AllowOverride` is set to `All` for your document root. This is the single most common reason Grav's rewrite and security rules do not take effect. In your virtual host (or the relevant `<Directory>` block), set:

[codesh=apache]
<Directory /var/www/grav>
    AllowOverride All
    Require all granted
</Directory>
[/codesh]

Then reload Apache:

[codesh=bash]
sudo systemctl reload apache2   # or: sudo apachectl graceful
[/codesh]

If you cannot enable `AllowOverride` (for example on a locked-down host), copy the contents of the shipped `.htaccess` into your virtual host configuration instead, inside the matching `<Directory>` block.

## Subfolder installs and RewriteBase

If Grav lives at the root of your domain, the default rules work as-is. If you installed Grav into a subfolder and you get 500 or 404 errors on subpages, uncomment the `RewriteBase` line near the top of `.htaccess` and set it to your subfolder:

[codesh=apache]
RewriteBase /your_sub_folder
[/codesh]

## Behind a load balancer or proxy

In hosted or load-balanced environments where SSL is terminated upstream, uncomment the `X-Forwarded-Proto` block in `.htaccess` so Grav recognises the connection as secure:

[codesh=apache]
RewriteCond %{HTTP:X-Forwarded-Proto} https
RewriteRule .* - [E=HTTPS:on]
[/codesh]

## The shipped security rules

The bundled `.htaccess` is the canonical source of these rules, so you should not need to maintain your own copy. For reference, the Security block blocks direct access to Grav's private folders and to script files inside its system and user folders, while still allowing public media uploaded under `user/data` (for example images added through Flex Objects) to be served directly:

[codesh=apache line-numbers="true"]
## Begin - Security
# Block all direct access for these folders
RewriteRule ^(\.git|cache|bin|logs|backup|webserver-configs|tests)/(.*) error [F,NC]
# Block all direct access to these sensitive user folders, whatever the file type
RewriteRule ^(user)/(accounts|config|env)/(.*) error [F,NC]
# Block user/data too, but allow public asset uploads (e.g. Flex Object images)
# to be served directly. SVG stays blocked as a stored-XSS vector; .css/.js are
# served per project policy despite the same risk on this user-writable folder.
RewriteCond %{REQUEST_URI} !\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf|woff2|woff|ttf|otf|eot|css|js)$ [NC]
RewriteRule ^(user)/data/(.*) error [F,NC]
# Block access to specific file types for these system folders
RewriteRule ^(system|vendor)/(.*)\.(txt|xml|md|html|htm|shtml|shtm|json|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$ error [F,NC]
# Block access to specific file types for these user folders
RewriteRule ^(user)/(.*)\.(txt|md|json|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$ error [F,NC]
# Block all direct access to .md files:
RewriteRule \.md$ error [F,NC]
# Block all direct access to files and folders beginning with a dot
RewriteRule (^|/)\.(?!well-known) - [F]
# Block access to specific files in the root folder
RewriteRule ^(LICENSE\.txt|composer\.lock|composer\.json|\.htaccess)$ error [F,NC]
## End - Security
[/codesh]

> [!NOTE]
> If you replaced or heavily edited the shipped `.htaccess`, compare it against the current one in the [Grav repository](https://github.com/getgrav/grav/blob/develop/.htaccess) and make sure the Security block is present and up to date. The [User Folder Exposure](/security/user-folder-exposure) page explains the admin warning that fires when these rules are not being applied.

## Confirming it works

A request for a private file such as `https://www.example.com/user/config/system.yaml` should return **403 Forbidden**, not the file's contents. A request for a media file you uploaded under `user/data` (for example a `.jpg`) should still load normally.

> [!TIP]
> LiteSpeed reads `.htaccess` and is fully compatible with Grav's Apache rules, so the same configuration applies. Just make sure rewrite rules are enabled for the virtual host.
