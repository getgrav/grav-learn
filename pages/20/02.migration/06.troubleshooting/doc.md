---
title: Troubleshooting
taxonomy:
    category: docs
---
# Migration Troubleshooting

Common issues encountered during a Grav 1.x → 2.0 migration, with the fixes.

## "PHP version too low"

The wizard refuses to proceed if it cannot find PHP 8.3 or newer.

Grav 2.0 requires PHP 8.3 minimum. If your host only offers older versions, you cannot migrate yet. Most shared hosts allow per-domain PHP version selection in their control panel. Switch to 8.3 or newer there, then re-run the wizard.

If you have multiple PHP binaries available on the server (for example, `php` is 8.1 but `php8.3` exists), set the path explicitly when running the CLI:

```bash
php8.3 bin/plugin migrate-grav init
```

## A Plugin Is Flagged as Incompatible

The wizard checks each installed plugin's [`compatibility:` blueprint flag](/20/plugins/plugin-compatibility) for `2.0`. A plugin is treated as incompatible if it lists `1.7` only, or if it has no flag and its `dependencies:` declares `grav >= 1.7`.

You have three options:

1. **Skip it.** If you no longer use the plugin, this is the right answer. Choose the `skip` policy in the wizard, or just don't copy it across in a manual migration.
2. **Disable it.** If you want to keep the files in place pending a 2.0 release from the author, choose the `disable` policy. The plugin folder is preserved on the stage but a config entry sets `enabled: false`.
3. **Test it anyway.** If you have reason to believe the plugin actually works on 2.0 (for example, you've tested it yourself), switch the wizard's compatibility mode to **Permissive**. Plugins that fall back to inference are then promoted to "compatible." Plugins explicitly marked incompatible are still blocked.

For custom or private plugins you maintain yourself, see the [AI-Assisted Development](../04.ai-assisted-development) page for the fastest path through porting them.

## "I don't recognise this plugin in the compat list"

The wizard scans the installed plugins on your live site, which sometimes turns up packages you don't remember installing. Treat the migration as a chance to clean house: use the `skip` policy for anything you don't actively use.

## The Staged Site Returns 404 or Redirect Loops

Most commonly caused by your live `.htaccess` (or nginx config) rewriting requests for `/grav-2/` back to the live install.

**Apache.** Add a rule near the top of your live `.htaccess` to bypass rewrites for the stage path:

```apache
RewriteRule ^grav-2/ - [L]
```

The migrate-grav wizard adds this marker automatically. If you're doing a manual migration, add it by hand.

**Nginx.** Add a location block above your existing `try_files` directive:

```nginx
location ^~ /grav-2/ {
    try_files $uri $uri/ /grav-2/index.php?$query_string;
}
```

## Admin Login Fails on the Staged Site

Two common causes:

1. **PHP version mismatch between stage and live.** Sessions and password hashes are portable, but make sure both are using compatible PHP versions during testing. If your live site is on PHP 8.1 and the stage on 8.3, log in fresh on the stage rather than expecting an existing session cookie to carry across.
2. **Two-factor codes.** If you have 2FA enabled, you need access to your authenticator app: the secret carries across with the account file, the active TOTP window does not.

## Recovering from a Failed Promote

The promote step is the only point where the wizard modifies your live webroot. It runs in three phases:

1. **Backup zip.** Every file in your live 1.x install (except the staged `grav-2/`) is zipped to `grav-2/backup/migration-backup-<version>--<timestamp>.zip`. After promote this lands at `backup/<…>.zip` next to Grav's other backups.
2. **Delete.** Top-level entries at the webroot are removed.
3. **Promote.** Contents of `grav-2/` are renamed up to the webroot.

If Phase 2 or 3 fails partway through, your live webroot may be partially destroyed. The backup zip from Phase 1 is your recovery artifact.

### Identify the Lock

The most common failure (especially on Windows, where open files cannot be deleted) is a process holding a file handle on something inside your webroot: a code editor with `.git/index` open, a tail running on a log file, a git GUI scanning `.git/objects/`. The wizard reports the specific path that failed. Close whatever has the file open before retrying.

### Restore from the Backup Zip

The migration backup is a standard zip. Extract it back over your webroot:

- **Windows.** In File Explorer, right-click the zip → **Extract All…** and pick your webroot. The Extract All wizard reconstructs the directory tree correctly. 7-Zip and WinRAR also work.
- **macOS.** Double-click in Finder, or `unzip migration-backup-*.zip -d /path/to/webroot` from Terminal.
- **Linux.** `unzip migration-backup-*.zip -d /path/to/webroot`.

Once the webroot is restored, clear the wizard state and re-run the wizard:

- Remove `.migrating` at the webroot
- Remove the `grav-2/` staged directory
- Remove `tmp/grav-2.0-staged.zip`

### "The zip extracts as flat files with `·` or `\` in their names"

If the wizard ran on **Windows** with a version **prior to 1.0.0-rc.3**, the backup zip has a separator bug where entry names use `\` instead of `/`. Every standards-tolerant extractor treats the backslashes as literal filename characters and dumps every file in the zip's root with names like `user\plugins\admin\file.php`.

The migrate-grav plugin ships a repair script at `user/plugins/migrate-grav/wizard/mg-repair-backup.php`. Copy it anywhere and run:

```bash
php mg-repair-backup.php migration-backup-1.7.x--20260507111032.zip
```

It writes `migration-backup-1.7.x--20260507111032.fixed.zip` next to the original with all entry names normalised to forward slashes. Extract the fixed zip with any tool and the directory tree will be correct.

The script is self-contained: no Grav, no Composer, no plugin context required. It needs PHP 8.1+ with the `zip` extension. Backup zips written by rc.3 and later are not affected.

## Deprecated Config Keys

A small number of `system.yaml` keys have been renamed or removed in Grav 2.0. The wizard flags these during the content import step with suggested replacements. For a manual migration, scan your `user/config/system.yaml` after the copy and check it against the [Grav 2.0 release notes](https://github.com/getgrav/grav/blob/develop/CHANGELOG.md).

## A Theme Renders Incorrectly

If your active theme has no 2.0-compatible release, your two options are:

1. **Switch to [Quark 2](https://github.com/getgrav/grav-theme-quark2)**, the new default theme that ships with Grav 2.0. Pages render with Quark 2's defaults until you customise.
2. **Port the theme.** Theme structure has not changed dramatically; the most common issues are Twig syntax that was deprecated in older versions and is now removed, asset references that depended on plugin-classic admin output, and PHP type errors in theme `.php` files under the new minimum PHP version. The [AI-Assisted Development](../04.ai-assisted-development) skills cover the porting work for plugins; the same patterns apply to themes.

## I Want to Start Over

At any point **before the promote step**, you can abandon the migration without affecting your live site. Click **Reset** in the wizard, or manually remove:

- `.migrating` at the webroot
- The staged `grav-2/` directory
- `tmp/grav-2.0-staged.zip`

After the promote step, "starting over" means restoring the migration backup zip and re-running the wizard.

## Reporting Issues

If you hit a migration issue that isn't covered here:

- File an issue on the [migrate-grav repository](https://github.com/getgrav/grav-plugin-migrate-to-2/issues) with the contents of `.migrating` and the relevant entries from `logs/grav.log`.
- Or ask in the `#migration` channel on the [Grav Discord](https://chat.getgrav.org).
