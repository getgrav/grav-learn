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

# Begin - Security
# deny all direct access for these folders
@denied_dirs path_regexp (?i)^/(\.git|cache|bin|logs|backups?|tmp|tests)/

# deny all direct access to these sensitive user folders, whatever the file type
@denied_user_config path_regexp (?i)^/user/(env/[^/]+/)?config/

# block user/accounts too, but allow avatar images to be served directly, whether
# stored at user/accounts/avatars/<file> (flatfile accounts) or user/accounts/
# <username>/<file> (Flex folder storage). SVG is excluded as a stored-XSS vector.
@denied_user_accounts {
	path_regexp (?i)^/user/(env/[^/]+/)?accounts/
	not path_regexp (?i)^/user/(env/[^/]+/)?accounts/[^/]+/[^/]+\.(jpe?g|png|gif|webp|avif|bmp|ico)$
}

# block user/data too, but allow public media uploads (e.g. Flex Object images)
# to be served directly. SVG is intentionally excluded as a stored-XSS vector.
@denied_user_data {
	path_regexp (?i)^/user/(env/[^/]+/)?data/
	not path_regexp (?i)\.(jpe?g|png|gif|webp|avif|bmp|ico|mp4|webm|ogg|ogv|mov|mp3|wav|m4a|flac|pdf)$
}

# deny running scripts in the public cache folders (image derivatives and combined assets)
@denied_cache_scripts path_regexp (?i)^/(images|assets)/.*\.(php|php2|php3|php4|php5|php7|php8|phar|phtml|pht|phtm|phps|pl|py|cgi|sh|bat)$

# deny running scripts inside core system folders
@denied_system path_regexp (?i)^/(system|vendor)/.*\.(txt|xml|md|html|htm|shtml|shtm|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$

# deny running scripts inside user folder
@denied_user_scripts path_regexp (?i)^/user/.*\.(txt|md|yaml|yml|php|php2|php3|php4|php5|phar|phtml|pl|py|cgi|twig|sh|bat)$

# deny access to specific files in the root folder
@denied_root_files path_regexp (?i)^/(LICENSE\.txt|composer\.lock|composer\.json|nginx\.conf|web\.config|htaccess\.txt)$

# deny hidden files and directories at any depth (.htaccess, .env, nested .git
# repositories), except ACME challenges
@denied_dotfiles {
	path_regexp (?i)(^|/)\.
	not path /.well-known/*
}
## End - Security

route {
	respond @denied_dirs 403
	respond @denied_user_config 403
	respond @denied_user_accounts 403
	respond @denied_user_data 403
	respond @denied_cache_scripts 403
	respond @denied_system 403
	respond @denied_user_scripts 403
	respond @denied_root_files 403
	respond @denied_dotfiles 403

	# global rewrite should come last
	try_files {path} {path}/ /index.php?_url={uri}&{query}

	php_fastcgi 127.0.0.1:9000
	file_server
}
[/codesh]

> [!NOTE]
> Caddy's `path` matcher is literal and only understands `*` wildcards, so every rule that needs alternation, character classes or anchors uses a named `path_regexp` matcher. Outside a `route` block Caddy applies its own directive order, and the global `try_files` rewrite would run before `respond`, so the rules sit in a `route` block, which runs top to bottom as written. Because Go's RE2 engine has no lookbehind or lookahead, the `user/accounts`, `user/data` and `.well-known` exceptions are negated matchers rather than single patterns. The `config`, `accounts` and `data` rules also match under an optional `env/<name>/` prefix, so a [multisite](/17/advanced/multisite-setup) subsite's own folders are protected while its themes, plugins and assets stay public. Caddy does not read `.htaccess`, so when you upgrade Grav, compare your Caddyfile with the shipped `webserver-configs/Caddyfile` and copy any changed rules by hand.

## Running as a service

For a permanent install, place your edited file at `/etc/caddy/Caddyfile` and manage Caddy with systemd:

[codesh=bash]
sudo systemctl reload caddy
[/codesh]

## Confirming it works

A request for a private file such as `https://example.com/user/config/system.yaml` should return **403 Forbidden**, while a media file you uploaded under `user/data` (for example a `.jpg`) should still load normally. See the [User Folder Exposure](/security/user-folder-exposure) page for more on the admin warning that fires when these rules are not applied.
