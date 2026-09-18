---
title: User Folder Exposure
taxonomy:
    category: docs
description: How to detect and prevent direct web access to private Grav files, form submissions, backups and temporary downloads.
---
# User Folder Exposure

The Grav admin dashboard can warn when a harmless test file in a private storage directory is reachable directly over the web:

> Your web server is not applying Grav's access rules.

Take a confirmed exposure seriously. Depending on the directory and file types the server exposes, visitors could download account files, configuration, saved form submissions or whole-site backups. The check uses harmless sentinel files; it does not download your actual private data.

Updated Admin2 and API versions test `.dat`, `.txt` and `.zip` files in `user/data`, `backup` and `tmp`, and list the directory/file-type combinations found reachable. Older versions only test a `.dat` file under `user/data`; passing that one check does not establish that other file types or directories are protected. Network errors and unsuccessful checks are inconclusive, and an absent warning is not a complete security audit.

## Why it happens

Grav relies on the web server to deny direct requests to its private folders. The block stops working when:

- You are on **Apache** but `.htaccess` files are ignored, because `AllowOverride` is set to `None` for your document root. This is the most common cause.
- You are on **Nginx**, **Caddy**, or another server that does **not** read `.htaccess` at all, and the equivalent rules were never added to the site configuration.
- A front proxy serves existing static files itself and forwards only other requests to PHP or Apache. The front server may expose `.txt` and `.zip` even while `.dat` requests reach Apache and receive a 403.
- A custom or host-provided server config replaced Grav's shipped rules without carrying these blocks across.

## How to fix it

The goal is the same on every server: deny direct web access to `backup`, `tmp`, `logs`, `user/accounts`, `user/config`, `user/env`, and `user/data`, while still allowing the files Grav intends to be public — avatar images under `user/accounts`, and media and assets uploaded under `user/data`. Those exceptions have to come before the matching deny rule, or they never take effect.

### Apache

First make sure `.htaccess` is being honored. In your virtual host (or the relevant `<Directory>` block), set:

```apache
<Directory /var/www/grav>
    AllowOverride All
    Require all granted
</Directory>
```

Reload Apache (`sudo systemctl reload apache2` or `sudo apachectl graceful`). Compare your root `.htaccess` with the current Grav version and ensure it includes these rules; older versions may omit `tmp`:

```apache
# Block private storage regardless of file extension
RewriteRule ^(backup|tmp|logs)/(.*) error [F,NC]
# Block all direct access to these sensitive user folders, whatever the file type
RewriteRule ^(user)/(config|env)/(.*) error [F,NC]
# Block user/accounts too, but allow avatar images to be served directly, whether
# stored at user/accounts/avatars/<file> or user/accounts/<username>/<file>
RewriteCond %{REQUEST_URI} !/user/accounts/[^/]+/[^/]+\.(jpe?g|png|gif|webp|avif|bmp|ico)$ [NC]
RewriteRule ^(user)/accounts/(.*) error [F,NC]
# Block user/data too, but allow public asset uploads (e.g. Flex Object images)
RewriteCond %{REQUEST_URI} !\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf|woff2|woff|ttf|otf|eot|css|js)$ [NC]
RewriteRule ^(user)/data/(.*) error [F,NC]
```

If you cannot enable `AllowOverride`, copy those rules into your virtual host configuration instead.

> [!NOTE]
> If you replaced or heavily edited the shipped `.htaccess`, compare it against the current one in the [Grav repository](https://github.com/getgrav/grav/blob/develop/.htaccess) and make sure the Security block is present.

### Nginx

Nginx does not read `.htaccess`. Compare your configuration with the shipped `webserver-configs/nginx.conf` and add these `location` blocks before generic static-file handlers. Adjust the paths if Grav is installed in a subdirectory or uses custom storage paths:

```nginx
# deny private storage regardless of file extension
location ~* ^/(backup|tmp|logs)/ { return 403; }
# deny all direct access to these sensitive user folders, whatever the file type
location ~* ^/user/(config|env)/.*$ { return 403; }
# allow avatar images under user/accounts to be served directly, whether stored at
# user/accounts/avatars/<file> or user/accounts/<username>/<file>; this must come
# before the user/accounts deny so it wins the first-match
location ~* ^/user/accounts/[^/]+/[^/]+\.(jpe?g|png|gif|webp|avif|bmp|ico)$ { try_files $uri =404; }
# deny everything else under user/accounts
location ~* ^/user/accounts/.*$ { return 403; }
# allow public media uploads under user/data to be served directly;
# this must come before the user/data deny so it wins the match
location ~* ^/user/data/.*\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$ { try_files $uri =404; }
# deny everything else under user/data
location ~* ^/user/data/.*$ { return 403; }
```

Then reload Nginx (`sudo nginx -t && sudo systemctl reload nginx`). The full, recommended configuration is documented under [Nginx](/webservers-hosting/servers/nginx).

### Caddy

Caddy also ignores `.htaccess`. Compare your configuration with the shipped `webserver-configs/Caddyfile`. Two Caddy behaviours matter here, and both fail silently when you get them wrong:

- Caddy's `path` matcher is literal — it understands `*` wildcards but is **not** a regex. Anything needing alternation, character classes or anchors has to use `path_regexp`.
- Outside a `route` block, Caddy applies its own directive order rather than the order you wrote, and the global `try_files` rewrite runs before `respond`. That disables every deny rule for any path Caddy cannot resolve to a file on disk. Put the rules inside a `route` block, which runs top to bottom as written.

Caddy matchers compile with Go's RE2, which has no lookbehind, so the media exceptions use a negated matcher rather than an inline one:

```caddy
@denied_dirs path_regexp (?i)^/(\.git|cache|bin|logs|backups?|tmp|tests)/
@denied_user_config path_regexp (?i)^/user/(config|env)/
# block user/accounts, but allow avatar images to be served directly
@denied_user_accounts {
	path_regexp (?i)^/user/accounts/
	not path_regexp (?i)^/user/accounts/[^/]+/[^/]+\.(jpe?g|png|gif|webp|avif|bmp|ico)$
}
# block user/data, but allow public media uploads (e.g. Flex Object images)
@denied_user_data {
	path_regexp (?i)^/user/data/
	not path_regexp (?i)\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$
}

route {
	respond @denied_dirs 403
	respond @denied_user_config 403
	respond @denied_user_accounts 403
	respond @denied_user_data 403

	# global rewrite should come last
	try_files {path} {path}/ /index.php?_url={uri}&{query}
	php_fastcgi 127.0.0.1:9000
	file_server
}
```

### LiteSpeed

LiteSpeed reads `.htaccess` and is compatible with Grav's Apache rules, so enabling `.htaccess` (the equivalent of `AllowOverride All`) is enough. Confirm rewrite rules are turned on for the virtual host.

### Behind a proxy, CDN, or managed host

If your site sits behind a reverse proxy or CDN, or runs on a managed/shared host, the rules must be applied on whichever layer actually serves the files. Check with your host if you are unsure which server is in front.

## Managed hosts and storage outside the web root

On hosts such as Cloudways, confirm which stack serves static files. Apache rules cannot protect a file served directly by nginx, even when Apache is behind it. Ask the host to apply the deny rules on the front server, ahead of its generic static-file handlers. Blocking access in PHP cannot intercept those requests.

In Grav versions with native `.env` support, you can relocate backups and temporary downloads using absolute paths in the Grav root's `.env`:

```dotenv
GRAV_BACKUP_PATH=/srv/private/grav-backups
GRAV_TMP_PATH=/srv/private/grav-tmp
```

Choose directories outside the document root and any public server aliases, writable by the PHP process. These settings redirect `backup://` and `tmp://`; they do not move or remove old files. Move existing backups out of the old public directory, and remove obsolete temporary files when no installation or update is running. Verify the former URLs no longer return their contents. Relocating these directories does not protect `user/accounts`, `user/config` or saved form submissions; those still need access rules.

The Form plugin's `save` action defaults to `.txt`. On a host that serves `.txt` directly but blocks `.dat`, configure `extension: dat` as an interim measure and verify the saved-file URL is denied. A file extension alone is not access control: an nginx-only stack without deny rules may serve both. Extensions such as `yaml`, `yml`, `json` and `md` may be refused by `security.uploads_dangerous_extensions`; do not disable that protection to change the submission format.

## Confirming it is fixed

Visit the dashboard again after reloading your server. The warning checks live, by trying to download the test file the same way a visitor would, so once direct access is blocked the banner disappears on the next load.

You can also test by hand using only harmless files. Write a short random marker into fresh `.dat`, `.txt` and `.zip` files in each directory being checked, request those URLs without authentication, and remove your test files afterward. A response containing the marker proves exposure. A 403 or 404 blocks that particular test; a server error, login page or failed request does not prove protection. Avoid using real backups, account files or submissions as test payloads.

## A note on public media under user/data

Grav intentionally allows common image, audio, video, and PDF files under `user/data` to be served directly, so that media uploaded through Flex Objects and similar fields keeps working. This is by design and is not what the warning is about. The warning fires only when non-media files under your private folders are reachable. For serving private or arbitrary file uploads safely, route them through an application-level proxy rather than exposing the folder.
