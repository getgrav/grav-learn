---
title: Public Webroot Layout
taxonomy:
    category: docs
---

# Public Webroot Layout

By default, **Grav** lives in one folder and your web server serves that whole folder. The public webroot layout is an optional alternative: Grav sits in a private folder, and the web server serves only one subfolder of it, usually `public/`. `system/`, `vendor/`, `bin/`, `cache/`, `logs/`, `tmp/`, `backup/`, `.env` and the Composer files stay above the web server's reach, so no URL can ever lead to them.

The single-folder layout stays the default and works exactly as before. You do not have to change anything.

> [!NOTE]
> The public webroot layout needs **Grav 2.3.0 or later**.

## Why use it

In the single-folder layout, Grav keeps private files out of reach with rules in `.htaccess` (Apache) or in your Nginx or Caddy configuration. If those rules are missing, ignored or misconfigured, the web server hands out whatever a visitor asks for: `.env`, `composer.json`, files in `vendor/`, logs, backups.

With the public webroot layout, the web server cannot hand out those files because they are not in the folder it serves. A bad rule can no longer expose them.

> [!IMPORTANT]
> This guards against the **web server** handing out files. It does not protect against bugs in PHP code, because PHP can read files above the docroot. Keep your plugins updated and your file permissions tight, as you would with any layout.

## When to use it

Use it on a VPS, a dedicated server, or a host where you can choose which folder the web server serves. It also suits hosts like cPanel, where `public_html` sits inside your home folder and you can keep Grav's private files next to it (see [Other layouts](#other-layouts)).

Do not use it on a host where you can only write to the docroot and nothing above it. The layout needs a place for the private folder.

## What you need

* Grav 2.3.0 or later.
* A host that lets you put files above the web server's docroot and point the docroot at a subfolder.

## What goes where

The Grav folder holds everything private. The webroot holds only what a browser needs.

```txt
/var/www/example.com            the Grav folder (private)
├── .env
├── backup/
├── bin/
├── cache/
├── composer.json
├── composer.lock
├── logs/
├── system/
├── tmp/
├── vendor/
├── webserver-configs/
└── public/                     the webroot (the web server docroot)
    ├── .htaccess
    ├── index.php
    ├── robots.txt
    ├── assets/
    ├── images/
    ├── system/                 a published copy of a few static files from system/
    └── user/
        ├── accounts/
        ├── config/
        ├── data/
        ├── pages/
        ├── plugins/
        └── themes/
```

The `user/` folder lives in the webroot, so your content, configuration, plugins and themes are where the web server and **GPM** expect them. The `system/` folder inside the webroot is not the real one: it holds only the static files that URLs point at. See [Published system files](#published-system-files-and-webroot-sync).

## How Grav finds its folders

You do not configure anything. Grav works out the layout by itself.

* **Web requests.** The stock `index.php` in the webroot checks for `vendor/` next to itself. If it is missing, and the folder above has `vendor/` and `system/defines.php`, that folder is the Grav folder.
* **Command line.** `bin/grav`, `bin/gpm` and `bin/plugin` run from the Grav folder. They look for the first of `public/`, `public_html/`, `web/`, `www/` or `htdocs/` that contains both an `index.php` and the `user/` folder, and use it as the webroot.

Two settings override this for other layouts (see [Other layouts](#other-layouts)):

* The `GRAV_ROOT` server variable tells `index.php` where the Grav folder is. In Apache it is `SetEnv`, in Nginx it is `fastcgi_param`.
* `GRAV_WEBROOT` in the `.env` file in the Grav folder tells the command line where the webroot is.

Run `bin/grav webroot:status` at any time to see what Grav found. The `Found by` line tells you whether the webroot came from one of the folder names or from `GRAV_WEBROOT`.

## Convert an existing site

`bin/grav webroot:split` moves a single-folder site into the public webroot layout. It creates `public/` (or the folder you name with `--dir`), moves `index.php`, `.htaccess`, `robots.txt`, `user/`, `assets/` and `images/` into it, rewrites relative symlinks, publishes the system files and clears the cache.

> [!WARNING]
> Between the split and the docroot change, a web server still pointed at the old Grav folder would serve private files, and Grav's `.htaccess` is no longer there to block them. That is why the steps below change the docroot **first**.

1. **Back up the whole site.** Copy the entire Grav folder, or take a snapshot from your host. The split moves files, and a backup is the only way to undo a mistake you did not expect.

2. **Check the starting point.** From the Grav folder, run:

   ```bash
   cd /var/www/example.com
   bin/grav webroot:status
   ```

   A single-folder site prints four checks. If `index.php` is reported as an older or edited copy, replace it with the stock `index.php` from your Grav version before you go on.

3. **Point the web server at the new folder.** Create an empty `public/` folder, set the docroot to it, and reload the web server (see [Web server settings](#web-server-settings)). The site is offline until the split runs, because the web server has nothing to serve yet, but nothing private is exposed. The split accepts an empty `public/` folder.

   ```bash
   mkdir /var/www/example.com/public
   ```

4. **Do a dry run.** It prints the plan and changes nothing:

   ```bash
   bin/grav webroot:split --dry-run
   ```

   ```txt
   Split into a public webroot
   ===========================

   Private folder: /var/www/example.com
   Webroot:        /var/www/example.com/public

   Use the empty folder /var/www/example.com/public
   Move:
       .htaccess  ->  public/.htaccess
       assets  ->  public/assets
       images  ->  public/images
       robots.txt  ->  public/robots.txt
       user  ->  public/user
       index.php  ->  public/index.php
   Publish system/assets, system/images into public/system
   Clear the cache

    ! [NOTE] Dry run: nothing was changed.
   ```

   Read the list. If the command lists files under `Left in the private folder`, see [Files Grav does not know](#files-grav-does-not-know) before you run it for real.

5. **Run the split.**

   ```bash
   bin/grav webroot:split
   ```

   Answer `y` when it asks `Split this site now?`, or add `-y` to skip the question. `index.php` moves last, so a web server that still points at the old folder keeps showing the "Site Upgrading" maintenance page until the end. Do not rely on that: change the docroot first, as in step 3.

   The command lists each move, publishes the system files and clears the cache. At the end it prints the docroot settings again, with a reminder to change the docroot. If you already did in step 3, there is nothing more to change.

6. **Check the result.** Run `bin/grav webroot:status` and open the site in your browser. See [Check the layout](#check-the-layout).

### Options

| Option | What it does |
| :----- | :----------- |
| `--dir=DIR` | Name of the webroot folder to create: `public` (the default), `public_html`, `web`, `www` or `htdocs`. These are the names Grav looks for, so no other setting is needed afterwards. |
| `--move=MOVE` | Move one more top-level file or folder into the webroot, such as `favicon.ico` or `.well-known`. Repeat the option for each one. |
| `--dry-run` | Print the plan and change nothing. |
| `-y`, `--yes` | Do not ask for confirmation. |

### Files Grav does not know

The split moves the files Grav knows about. Any other top-level file or folder, such as `favicon.ico`, `.well-known/` (used for certificate checks) or a search engine verification file, stays in the private folder, because Grav cannot tell whether it is meant to be public. The command lists these so you can decide:

```txt
Left in the private folder (not part of Grav, so it stays private):
    .well-known
Re-run with --move=NAME for any of these that must be public (favicon.ico, .well-known/, site verification files...).
```

Add `--move` for each file or folder that browsers need to reach:

```bash
bin/grav webroot:split --move=favicon.ico --move=.well-known
```

The split never moves `system/`, `vendor/`, `bin/`, `cache/`, `logs/`, `tmp/`, `backup/`, `.env`, the Composer files or the other Grav package files, even when you ask. It tells you so and stops.

### Symlinks

If `user/` holds relative symlinks that point outside it, for example a plugin you develop in a separate folder, the split rewrites them so they still reach the same place. The dry run lists each one:

```txt
Rewrite relative symlinks so they point at the same place:
    public/user/plugins/foo: ../../../grav-plugin-foo  ->  ../../../../grav-plugin-foo
```

Absolute symlinks are left as they are, since they already point at a fixed place.

> [!TIP]
> If your host requires a webroot folder with another name, create the layout by hand and set `GRAV_WEBROOT` in `.env`. See [Other layouts](#other-layouts).

## Go back to one folder

`bin/grav webroot:join` undoes the split. It moves everything from the webroot back into the Grav folder, removes the published system files and the empty webroot, puts relative symlinks back and clears the cache.

```bash
bin/grav webroot:join --dry-run
bin/grav webroot:join
```

It refuses to start if a name exists in both folders (a second `user/`, for example), or if the webroot's `system/` folder holds files that `webroot:sync` did not put there. Fix what it names and run it again. It accepts the same `--dry-run` and `-y` options as the split.

Afterwards, point the web server docroot back at the Grav folder. If `GRAV_WEBROOT` is set in `.env`, remove it, or Grav keeps looking for the old webroot.

## Check the layout

`bin/grav webroot:status` shows which layout the site uses and runs a set of checks. Here is a healthy site in the public webroot layout:

```bash
bin/grav webroot:status
```

```txt
Webroot status
==============

Layout:         public webroot (split)
Grav folder:    /var/www/example.com
Webroot:        /var/www/example.com/public
Found by:       the "public" folder (one of public, public_html, web, www, htdocs)

  [pass] No private files inside the webroot.
  [pass] The webroot has index.php, .htaccess, robots.txt, user/, assets/ and images/.
  [pass] No index.php or user/ left in the private folder.
  [pass] 180 published system files are in sync.
  [pass] index.php is a stock copy that detects the layout.
  [pass] No relative symlinks in user/ point outside it.

The web server docroot must be the webroot:
Apache
    DocumentRoot "/var/www/example.com/public"
    <Directory "/var/www/example.com/public">
        AllowOverride All
        Require all granted
    </Directory>
nginx
    root /var/www/example.com/public;    # in the server block from webserver-configs/nginx.conf
Caddy
    root * /var/www/example.com/public    # in webserver-configs/Caddyfile

 [OK] All checks passed.
```

And here is a site with problems. A stray `user/` folder is in the Grav folder, a published file is missing and a symlink is broken:

```txt
  [pass] No private files inside the webroot.
  [pass] The webroot has index.php, .htaccess, robots.txt, user/, assets/ and images/.
  [FAIL] The private folder has its own user/ folder next to the webroot one. Only the webroot copy is used.
         user
  [FAIL] Published system files are out of sync. Run bin/grav webroot:sync.
         missing: system/assets/jquery/jquery-3.x.min.js
  [pass] index.php is a stock copy that detects the layout.
  [FAIL] Relative symlinks in user/ point outside it and are broken.
         user/plugins/missing -> ../../../gone
```

### What each check means

| Check | What it looks for |
| :---- | :---------------- |
| Private files inside the webroot | `vendor`, `system` (other than the published copy), `bin`, `.env`, `cache`, `logs`, `tmp`, `backup`, `composer.json` or `composer.lock` inside the webroot. Any of them fails the check, because the web server can reach them. |
| The webroot has its files | `index.php` and `user/` must exist, or the check fails. A missing `.htaccess`, `robots.txt`, `assets/` or `images/` only warns: `.htaccess` matters on Apache only, and Grav creates `assets/` and `images/` when it first needs them. |
| Nothing left in the private folder | A `user/` folder in the Grav folder fails the check, since only the webroot copy is used. An `index.php` there warns: if the web server serves the Grav folder by mistake, everything in it is exposed. |
| Published system files | The static files copied from `system/` match their source. If not, run `bin/grav webroot:sync`. |
| `index.php` | In the public webroot layout it must be a stock copy that looks for the Grav folder, or the site cannot start. In the single-folder layout an older or edited copy only warns. |
| Symlinks | Relative symlinks in `user/` that point outside it must still work. A broken one fails the check. |

The command exits with `1` when any check fails, so you can use it in a deploy script. Warnings do not change the exit code. Add `--json` to get the same result as JSON.

In the single-folder layout the command runs four checks: the webroot files, the published system files (always a pass there), `index.php` and symlinks.

### Check from outside

Also ask the web server directly. These private paths should all answer `403` or `404`:

```bash
curl -I https://example.com/.env
curl -I https://example.com/composer.json
curl -I https://example.com/vendor/autoload.php
curl -I https://example.com/system/defines.php
```

## Published system files and webroot:sync

A few files inside `system/` are linked by URL: jQuery and the debugger's CSS and JS in `system/assets/`, and the media type icons in `system/images/`. In this layout the real `system/` folder is private, so those URLs would return 404.

`bin/grav webroot:sync` solves this by copying those static files into a `system/` folder in the webroot, for example `public/system/assets/jquery/`. Grav looks in the webroot copy first for these URLs, so they come out as `/system/assets/...`. Every other lookup in `system/` still goes to the real, private folder.

What it copies and what it does not:

* It copies only static files from `system/assets/` and `system/images/` (CSS, JS, images, SVG, fonts and source maps). It never copies PHP, YAML, Twig or configuration files.
* It writes a manifest, `.published.json`, next to the copy. The manifest lets it remove files that are gone from `system/` without touching anything else in that folder. Files it did not put there are listed as `extra` and left alone.
* The shipped `.htaccess` and `webserver-configs/` rules already allow these static files under `/system/` and block everything else there, so they need no changes.

**You usually do not run it.** `webroot:split` runs it, and core upgrades run it on their own at the end of the upgrade. If publishing fails during an upgrade, the upgrade tells you to run the command.

Run it by hand when the real `system/` folder changed without a core upgrade. The common case is deploying Grav with `rsync` or `git` instead of the self-upgrade. Run it after each such deploy, and the webroot copy follows the new files.

```bash
bin/grav webroot:sync
```

```txt
Published system files to /var/www/example.com/public/system: 1 new, 0 changed, 0 removed, 180 in total.
```

With `--check` it changes nothing. It prints what is out of date and exits with `1` when the copy is stale, which makes it useful in CI or at the end of a deploy script:

```bash
bin/grav webroot:sync --check
```

```txt
  new      system/assets/jquery/jquery-3.x.min.js
Published system files in /var/www/example.com/public/system are out of sync. Run bin/grav webroot:sync.
```

When many files differ, the command prints a count instead of one line each. Add `-v` to list them. In the single-folder layout there is nothing to publish and the command says so.

## Web server settings

Point the docroot at the webroot folder. `bin/grav webroot:status` prints the lines below with your real path filled in.

**Apache**: set `DocumentRoot` and allow `.htaccess` overrides in the virtual host:

```apache
DocumentRoot "/var/www/example.com/public"
<Directory "/var/www/example.com/public">
    AllowOverride All
    Require all granted
</Directory>
```

**Nginx**: set `root` in the server block you took from `webserver-configs/nginx.conf`:

```nginx
root /var/www/example.com/public;
```

**Caddy**: set `root` in the Caddyfile you took from `webserver-configs/Caddyfile`:

```txt
root * /var/www/example.com/public
```

The `.htaccess` file in the webroot and the files in `webserver-configs/` (Nginx, Caddy, IIS and lighttpd) work unchanged. You can find the configuration files in the [`webserver-configs` folder](https://github.com/getgrav/grav/tree/master/webserver-configs) on GitHub.

Reload the web server after you change the setting.

## Other layouts

`webroot:split` builds the layout described above. If your host has another arrangement, for example a Grav folder in `/home/example/grav` and a docroot in `/home/example/public_html` that is not inside it, you set two things yourself.

**Tell `index.php` where the Grav folder is** with a `GRAV_ROOT` server variable.

In Apache, add it to the virtual host (or the webroot's `.htaccess`):

```apache
SetEnv GRAV_ROOT /home/example/grav
```

In Nginx, add it to the PHP location block:

```nginx
fastcgi_param GRAV_ROOT /home/example/grav;
```

**Tell the command line where the webroot is** by adding `GRAV_WEBROOT` to the `.env` file in the Grav folder:

```txt
GRAV_WEBROOT=/home/example/public_html
```

You need `GRAV_WEBROOT` in `.env` as well when your webroot folder has a name other than `public`, `public_html`, `web`, `www` or `htdocs`.

## The command line

Run `bin/grav`, `bin/gpm` and `bin/plugin` from the **Grav folder**, not from the webroot:

```bash
cd /var/www/example.com
bin/grav cache:clear
bin/gpm update
```

The commands find the webroot by themselves, so every command works as before. See the [Grav CLI](/2/cli-console/grav-cli) documentation.

## Updates

* **Self-upgrade.** `bin/gpm selfupgrade` puts the new `index.php` in the webroot and everything else in the Grav folder. The stock `index.php` works in both layouts, so the upgrade can always replace it. The `.htaccess` and `user/` updates, the maintenance page flag and the plugin checks all use the webroot. At the end it runs `webroot:sync`.
* **GPM.** `bin/gpm install`, `update` and `direct-install` put plugins and themes in the webroot's `user/` folder. This includes plugins that install packages through GPM with the Grav folder as the destination, such as the API plugin.

See [Updates](/2/basics/updates) for the general update process.

## Scheduler cron

The cron line that Grav generates for the [Scheduler](/2/advanced/scheduler) starts with a `cd` into the Grav folder, so it works in this layout without changes:

```bash
* * * * * cd /var/www/example.com;/usr/bin/php bin/grav scheduler 1>> /dev/null 2>&1
```

Use the line the Scheduler shows you (`bin/grav scheduler -i`) rather than writing your own.

## Troubleshooting

### "FATAL: Must be run from ROOT directory of Grav!"

The command line could not find the webroot. There are two causes:

* You are in the wrong folder. Change to the Grav folder (the one that holds `bin/`, `system/` and `vendor/`) and run the command again.
* Your webroot has a name Grav does not look for. Add `GRAV_WEBROOT` to `.env` in the Grav folder, with the absolute path of the webroot. See [Other layouts](#other-layouts).

### jQuery or debugger files return 404

The published copy in `<webroot>/system/` is missing or out of date. Run:

```bash
bin/grav webroot:sync
```

This happens after you deploy core files with `rsync` or `git`, or when the webroot's `system/` folder was deleted.

### A new `user/` folder appears in the Grav folder

`bin/grav webroot:status` reports it as a failed check. A plugin or theme built a path from `GRAV_ROOT` and created its own `user/` folder in the private folder, where Grav does not read it. Look at what is inside, move anything you want to keep into the webroot's `user/` folder, and delete the stray folder. Then tell the plugin author: the plugin should build `user/` paths from `GRAV_WEBROOT` or locator streams. See [For plugin and theme developers](#for-plugin-and-theme-developers).

### A symlinked plugin or theme is broken

Relative symlinks in `user/` that point outside it break when the folder moves. `webroot:split` and `webroot:join` rewrite them for you. If you moved folders by hand, `webroot:status` lists the broken ones with their targets:

```txt
  [FAIL] Relative symlinks in user/ point outside it and are broken.
         user/plugins/foo -> ../../../grav-plugin-foo
```

Recreate each link with a target that works from its new place. For the layout above, a plugin folder next to the Grav folder is one level further up:

```bash
cd /var/www/example.com/public/user/plugins
ln -sfn ../../../../grav-plugin-foo foo
```

### The split stops with "already exists and is not empty"

The folder you asked for is already there and holds files. Move them out, or choose another name with `--dir`.

### The split or join says "This site already uses..."

`webroot:split` refuses to run on a site that already uses the public webroot layout, and `webroot:join` refuses on a single-folder site. Run `bin/grav webroot:status` to see which layout the site has.

## For plugin and theme developers

In the single-folder layout `GRAV_ROOT` and `GRAV_WEBROOT` are the same folder, so code written for one works with the other. In the public webroot layout they differ, and the wrong one points at a folder that does not hold what you want.

| Constant | Points to | Use it for |
| :------- | :-------- | :--------- |
| `GRAV_WEBROOT` | The webroot (`public/`) | `user/`, `assets/`, `images/`, and anything you turn into a URL |
| `GRAV_ROOT` | The Grav folder | `vendor/`, `system/`, `cache/`, `logs/`, `tmp/`, `backup/` |

Follow these rules:

* Build every path under `user/` from `GRAV_WEBROOT`, or better, from a locator stream: `user://`, `plugins://`, `themes://`. Streams work in both layouts.
* Turn a file path into a URL by removing `GRAV_WEBROOT`, not `GRAV_ROOT`.
* Keep `GRAV_ROOT` for the private folders. Prefer the streams (`cache://`, `logs://`, `tmp://`, `backup://`) there as well.

Before and after:

```php
// Before: breaks in the public webroot layout.
$file = GRAV_ROOT . '/user/data/my-plugin/store.json';
$url  = str_replace(GRAV_ROOT, '', $imagePath);

// After: works in both layouts.
$locator = Grav::instance()['locator'];
$file    = $locator->findResource('user://data/my-plugin', true, true) . '/store.json';
$url     = str_replace(GRAV_WEBROOT, '', $imagePath);
```

With `GRAV_ROOT`, the "before" code resolves to `/var/www/example.com/user/data/...`, a folder that does not exist in this layout. Creating it is what produces the stray `user/` folder described above.

If you must ask which layout is running, `Grav\Common\Config\InstallLayout::isSplit()` returns `true` when `GRAV_ROOT` and `GRAV_WEBROOT` are different folders. You rarely need it: code that uses the constants correctly does not have to care.

Test your plugin on a site in the public webroot layout before you release it. See the checklist in [Plugin Compatibility](/2/plugins/plugin-compatibility).
