---
title: Assisted Migration to Grav 2.0
taxonomy:
    category: docs
---
# Assisted Migration to Grav 2.0

The **[Migrate to Grav 2.0](https://github.com/getgrav/grav-plugin-migrate-to-2)** plugin is the recommended way to move from Grav 1.7 or 1.8 to Grav 2.0. It installs on your existing 1.x site, downloads a fresh Grav 2.0 build, and hands off to a standalone browser-based wizard that performs the rest of the migration in a clean PHP process with no Grav 1.x code loaded.

> [!NOTE]
> The plugin itself does very little. Its only job is the **handoff**: download the 2.0 zip, stage it alongside your live site, drop a self-contained `migrate.php` at the webroot, and redirect you to it. Everything risky happens in the wizard, which runs entirely outside of Grav 1.x.

## Prerequisites

- Grav **1.7.50+** or **1.8.x**
- Write access to your webroot and `tmp/` directory
- **PHP 7.3.6+** for running the kickoff itself (Grav 1.x's minimum)
- **PHP 8.3+** available for the 2.0 wizard (this is what Grav 2.0 requires; it does not need to be the active CLI/web PHP yet, but the wizard will refuse to proceed on anything older)

> [!IMPORTANT]
> If your hosting only offers PHP versions below 8.3, do not start the migration until you have a way to switch. Most shared hosts let you change the PHP version per-domain in their control panel.

## Step 1: Back Up Your Site

Before you start, take a full backup of your existing site. Either:

- Use Grav's built-in backup tool: **Admin → Tools → Backup**, or `bin/grav backup` from the CLI.
- Or copy `user/`, `backup/`, and `logs/` manually if you prefer.

The wizard will also create its own backup zip during the final promote step (see [Troubleshooting](../06.troubleshooting#recovering-from-a-failed-promote)), but having an independent backup before you begin is good practice.

## Step 2: Install the Plugin

From the **GPM**:

```bash
bin/gpm install migrate-grav
```

Or via the admin: **Plugins → Add → Migrate to Grav 2.0 → Install**.

After installation a new **Migrate to Grav 2.0** entry appears in the admin sidebar.

## Step 3: Stage the Migration

You can launch the staging step from either the admin or the CLI.

### From the Admin

1. Click **Migrate to Grav 2.0** in the sidebar.
2. Review the requirements panel. Anything that is not satisfied is flagged with a clear explanation.
3. Press the **Start Migration** button.
4. The plugin downloads the latest Grav 2.0 build, extracts it to `grav-2/` next to your live install, copies the wizard to `/migrate.php` at your webroot, and redirects your browser to it.

### From the CLI

```bash
bin/plugin migrate-grav init
```

The command prints the next step, including the URL to open the wizard. From this point on, everything happens in the wizard.

```bash
bin/plugin migrate-grav status
```

Reports the current state of the migration: staged, extracted, plugins reviewed, accounts imported, content imported, awaiting test, or promoted.

## Step 4: Walk Through the Wizard

The wizard is a multi-step browser UI served by the standalone `migrate.php`. Each step writes its result to a `.migrating` state file at the webroot so the wizard can be safely reloaded, resumed, or restarted at any point without losing progress.

The steps are:

### Extract

The downloaded zip is expanded into the `grav-2/` stage directory and the redundant `grav-admin/` prefix from the archive is stripped.

### Plugins & Themes

For each plugin and theme installed on your 1.x site the wizard:

1. Reads the package's `blueprints.yaml`
2. Checks the [`compatibility:` flag](/20/plugins/plugin-compatibility) for `2.0`
3. Falls back to inference from the `dependencies:` array if no flag is present
4. Pulls the catalog metadata from `getgrav.org` (using the curated `_all` compatibility list as a tiebreaker for ambiguous cases)

You then choose a **compatibility mode** and a **plugin policy**:

| Setting | Options | Effect |
|---|---|---|
| **Mode** | `strict` (default) / `permissive` | `strict` trusts the flags as declared. `permissive` promotes inferred-incompatibles to "compatible" so you can test them on the staged 2.0 site even if their authors haven't formally flagged them. |
| **Policy** | `skip` (default) / `disable` | What to do with incompatible packages. `skip` removes the package from the staged install. `disable` keeps the files in place but writes a config entry that disables the plugin on 2.0. |

Compatible packages are then installed fresh into the stage from GPM at their latest 2.0-ready version.

> [!TIP]
> If you don't recognise some of the plugins flagged here, this is a good moment to clean house. `skip` is the right policy for anything you no longer use.

### Accounts

User accounts, roles, and permissions are copied from `user/accounts/` into the stage.

### Content

The following directories are copied from your 1.x site into the staged 2.0 install:

- `user/pages/`: all page content (unchanged between 1.7 and 2.0)
- `user/config/`: system and site configuration (deprecated keys are flagged with suggested replacements)
- `user/data/`: form submissions, login data, anything plugins persist here
- `user/env/`: environment-specific overrides
- `user/languages/`: site-level translations

### Test

The wizard pauses and asks you to verify the staged 2.0 site. The stage is available at `/grav-2/` relative to your live webroot, so you can browse it side-by-side with the unchanged 1.x site.

> [!IMPORTANT]
> This is your last chance to abandon the migration without touching the live site. If something is wrong, hit **Reset** and your live install is exactly as it was before you started.

Things worth checking before you proceed:

- The homepage and a representative sample of inner pages render correctly
- Admin login works with your existing credentials
- Configured plugins load without errors
- The active theme renders correctly (or has been replaced with [Quark 2](https://github.com/getgrav/grav-theme-quark2) if your old theme has no 2.0-compatible version yet)
- Pages that used **Twig in their content** (`{{ ... }}` or `{% ... %}` in the page body) still render as intended. In 2.0 this is gated off by default, so such pages show raw Twig until you re-enable it. The **Tools → Reports → Twig in Content** report flags every affected page. See [Twig in Content](/20/content/twig-in-content) for how to re-enable it and the safer alternatives.

### Promote

This is the only step where the wizard touches your live webroot. It runs in three phases:

1. **Backup.** Every file in your live 1.x install (except the staged `grav-2/`) is zipped to `grav-2/backup/migration-backup-<version>--<timestamp>.zip`. After promote this lands at `backup/<…>.zip` next to Grav's other backups.
2. **Delete.** Top-level entries at the webroot are removed.
3. **Promote.** Contents of `grav-2/` are renamed up to the webroot.

When the wizard reports success, your 2.0 site is live. The migration backup zip is preserved alongside Grav's standard backups so you can roll back if anything was missed.

For what to do if the promote step fails partway through, see [Troubleshooting](../06.troubleshooting#recovering-from-a-failed-promote).

## Step 5: Remove the Plugin

The migration plugin is a one-time tool. After a successful promote it has no further purpose. Uninstall it:

```bash
bin/gpm uninstall migrate-grav
```

Or remove it from the admin **Plugins** list.

## Aborting Before Promote

At any point before the promote step, you can abandon the migration entirely without affecting your live site. Either click **Reset** in the wizard, or manually remove:

- `.migrating` at your webroot
- The staged subdirectory (default: `grav-2/`)
- `tmp/grav-2.0-staged.zip`

Your existing Grav 1.x site is untouched.

## Configuration Reference

The plugin's defaults work for almost every site. The configurable options live at `user/config/plugins/migrate-grav.yaml`:

```yaml
enabled: true
source_url: 'https://getgrav.org/download/core/grav-update/latest'
source_local_zip: ''        # absolute path to a local 2.0 zip (dev only)
stage_dir: 'grav-2'
require_super_admin: true
```

The `source_local_zip` option is intended for offline testing during development. For normal use, leave it empty so the wizard pulls the latest stable Grav 2.0 build.
