---
title: Caddy
taxonomy:
    category: docs
description: How to run Grav on the Caddy web server using the Caddyfile bundled with every release, including automatic HTTPS and the security rules that protect Grav's private folders.
---
# Caddy

*Caddy* is a modern, open-source web server written in Go. Its main draw is automatic HTTPS: Caddy obtains and renews TLS certificates for you with no extra configuration. Like Nginx, Caddy does **not** read Apache `.htaccess` files, so Grav ships an equivalent `Caddyfile` in the `webserver-configs/` folder of every release.

## Requirements

* `caddy` (v2 or newer)
* `php-fpm` (FastCGI Process Manager) to process PHP scripts

## Quick start

Grav ships a ready-to-run `Caddyfile` in `webserver-configs/`. To try it locally, run the following from the root of your Grav site:

[codesh=bash]
caddy run --config webserver-configs/Caddyfile
[/codesh]

By default this serves the site at `https://localhost` and redirects `http://localhost` to it (Caddy v2 enables HTTPS automatically). Make sure your PHP-FPM process is listening on `127.0.0.1:9000`, or adjust the `php_fastcgi` address to match your setup.

## The bundled Caddyfile

The shipped file is the canonical reference. For production, replace `localhost` with your domain so Caddy can provision a real certificate, and point `root` at your Grav directory:

[codesh=caddy line-numbers="true"]
example.com
encode gzip
root * /var/www/grav
file_server

php_fastcgi 127.0.0.1:9000

# Begin - Security
# deny all direct access for these folders
rewrite /(\.git|cache|bin|logs|backups|tests)/.* /403

# deny all direct access to these sensitive user folders, whatever the file type
rewrite /user/(accounts|config|env)/.* /403

# block user/data too, but allow public media uploads (e.g. Flex Object images)
# to be served directly. SVG is intentionally excluded as a stored-XSS vector.
# (Go's RE2 has no lookbehind, so this uses a negated matcher.)
@user_data_nonmedia {
	path_regexp /user/data/.*
	not path_regexp (?i)\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$
}
rewrite @user_data_nonmedia /403

# deny running scripts inside core system folders
rewrite /(system|vendor)/.*\.(txt|xml|md|html|htm|shtml|shtm|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$ /403

# deny running scripts inside user folder
rewrite /user/.*\.(txt|md|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$ /403

# deny access to specific files in the root folder
rewrite /(LICENSE\.txt|composer\.lock|composer\.json|nginx\.conf|web\.config|htaccess\.txt|\.htaccess) /403

# deny access to .env environment files
@dotenv path_regexp \.env(\..+)?$
respond @dotenv 403

respond /403 403
## End - Security

# global rewrite should come last.
try_files {path} {path}/ /index.php?_url={uri}&{query}
[/codesh]

> [!NOTE]
> The global `try_files` rewrite must come **last** so the security rules above it win first. Because Go's RE2 engine has no lookbehind, the `user/data` media carve-out is expressed as a negated matcher rather than a single pattern.

## Running as a service

For a permanent install, place your edited file at `/etc/caddy/Caddyfile` and manage Caddy with systemd:

[codesh=bash]
sudo systemctl reload caddy
[/codesh]

## Confirming it works

A request for a private file such as `https://example.com/user/config/system.yaml` should return **403 Forbidden**, while a media file you uploaded under `user/data` (for example a `.jpg`) should still load normally. See the [User Folder Exposure](/security/user-folder-exposure) page for more on the admin warning that fires when these rules are not applied.
