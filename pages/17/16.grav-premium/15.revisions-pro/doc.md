---
title: Revisions Pro
description: Install, Configure, and Use the Revisions Pro Plugin
taxonomy:
    category: docs
---

# Revisions Pro

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

Installing the Revisions Pro plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### Dependencies

This plugin requires the following plugins to be installed and enabled:

- **Grav CMS** >= 1.7.0 - Core system requirement
- **Admin Plugin** >= 1.10.0 - For the revision management interface
- **PHP** >= 7.4 - With standard extensions

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav installation, and enter:

```
bin/gpm install revisions-pro
```

This will install the Revisions Pro plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/revisions-pro`.

### Manual Installation

To install the plugin manually:

1. Download the zip-version of this repository
2. Unzip it under `/your/site/grav/user/plugins`
3. Rename the folder to `revisions-pro`
4. Navigate to the plugin directory and run `composer install` to install dependencies

You should now have all the plugin files under:

```
/your/site/grav/user/plugins/revisions-pro
```

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins` menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/revisions-pro/revisions-pro.yaml` to `user/config/plugins/revisions-pro.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                    # Enable the plugin

# Storage Settings
max_revisions_per_page: 50      # Max revisions per resource (0 = unlimited)
auto_cleanup: true              # Enable automatic daily cleanup
cleanup_older_than: 90          # Delete revisions older than X days

# Feature Toggles
track_pages: true               # Track changes to pages
track_config: true              # Track system/site configuration
track_plugins: true             # Track plugin/theme configuration

# UI Settings
show_revision_count: true       # Show revision count badge in toolbar
```

### Configuration Details

#### Storage Settings

##### `max_revisions_per_page`
- **Type**: Integer
- **Default**: 50
- **Description**: Maximum number of revisions to keep for each resource
- **Notes**: 
  - When the limit is reached, oldest revisions are automatically deleted
  - Set to 0 for unlimited revisions (not recommended for production)
  - Applies to all tracked content types

##### `auto_cleanup`
- **Type**: Boolean
- **Default**: true
- **Description**: Enable automatic cleanup of old revisions
- **Notes**:
  - Runs daily at 3:00 AM server time via Grav's scheduler
  - Requires Scheduler configured cron job
  - Can also be triggered manually via CLI

##### `cleanup_older_than`
- **Type**: Integer
- **Default**: 90
- **Description**: Age limit in days for revision cleanup
- **Notes**:
  - Revisions older than this are deleted during cleanup
  - Applies to both automatic and manual cleanup
  - Consider your compliance requirements when setting this value

#### Feature Toggles

##### `track_pages`
- **Type**: Boolean
- **Default**: true
- **Description**: Track changes to page content and frontmatter
- **Notes**:
  - Includes all page types (standard, modular, etc.)
  - Tracks both content and frontmatter changes
  - Supports multi-language pages

##### `track_config`
- **Type**: Boolean
- **Default**: true
- **Description**: Track changes to system and site configuration
- **Notes**:
  - Monitors `/user/config/system.yaml` and `/user/config/site.yaml`
  - Respects environment-specific configurations
  - Essential for tracking critical system changes

##### `track_plugins`
- **Type**: Boolean
- **Default**: true
- **Description**: Track plugin and theme configuration changes
- **Notes**:
  - Monitors all files in `/user/config/plugins/` and `/user/config/themes/`
  - Helps track plugin setting changes over time
  - Useful for debugging configuration issues

##### `show_revision_count`
- **Type**: Boolean
- **Default**: true
- **Description**: Display revision count badge on the toolbar history button
- **Notes**:
  - Shows the total number of revisions for the current resource
  - Updates automatically when revisions are created or deleted
  - Can be disabled for cleaner UI if preferred

## Usage

### Accessing Revisions

The Revisions Pro plugin integrates seamlessly into the Grav admin interface. Access revisions through the **History** button (🕐) in the admin toolbar when editing any supported content type.

#### Supported Content Types

1. **Pages** - All page types including:
   - Standard pages
   - Modular pages
   - Multi-language pages
   - Blog posts

2. **Configuration Files**:
   - System configuration (`system.yaml`)
   - Site configuration (`site.yaml`)
   - Environment-specific configs

3. **Plugin/Theme Configurations**:
   - All plugin settings
   - Theme configurations

### The Revision Panel

When you click the History button, a sliding panel appears from the right side showing:

- **Revision List**: All revisions for the current resource
- **Timestamp**: When the change was made (with star ⭐ for current version)
- **Author**: User who made the change
- **File Size**: Size of the revision
- **Action Buttons**: View, Compare, Restore, Delete

### Viewing Revisions

Click the **View** button on any revision to see its full content in a read-only format with syntax highlighting.

### Comparing Versions

1. Click the **Compare** button on any revision
2. A secondary panel slides out showing:
   - Side-by-side diff view
   - Green highlighting for additions
   - Red highlighting for deletions
   - Proper syntax highlighting (YAML, Markdown, etc.)
   - Unified diff view option

> [!TIP]
> The current version always shows a "No changes" message when comparing with itself

### Restoring Revisions

1. Click the **Restore** button on the revision you want to restore
2. Confirm in the custom dialog that appears
3. The system will:
   - Create a backup of the current version
   - Restore the selected revision
   - Reload the page with a success message

> [!TIP]
> Restoration creates a new revision of the current state before restoring, ensuring you can always undo the operation

### Deleting Revisions

1. Click the **Delete** button on any revision (except current)
2. Confirm the deletion in the dialog
3. The revision is permanently removed

> [!TIP]
> Deleted revisions cannot be recovered. Use with caution.

## Multi-Language Support

Revisions Pro fully supports Grav's multi-language features:

### How It Works

- **Language Detection**: Automatically detects the current language from the admin URL
- **Separate Tracking**: Each language version is tracked independently
- **Proper Storage**: Revisions are stored with language suffixes (e.g., `:fr`, `:de`)
- **Default Language**: Handles default language files with or without language extensions

### Language-Specific Revisions

When editing a page in a specific language:
- Only revisions for that language are displayed
- The revision count reflects only that language's history
- Restoration affects only the current language version

### Example

For a page available in English (default) and French:
- English revisions: `typography.md.20240130-143022.rev`
- French revisions: `typography.fr.md.20240130-143022.rev`

## CLI Commands

Revisions Pro provides powerful command-line tools for maintenance and automation.

### Cleanup Command

Remove old revisions based on age or other criteria:

```bash
# Use default settings from configuration
bin/plugin revisions-pro cleanup

# Specify custom age limit (overrides configuration)
bin/plugin revisions-pro cleanup --days=30

# Preview what would be deleted without actually deleting
bin/plugin revisions-pro cleanup --dry-run

# Run quietly (no output except errors)
bin/plugin revisions-pro cleanup --quiet

# Specify environment
bin/plugin revisions-pro cleanup --env=production
```

#### Command Options

| Option | Description | Example |
|--------|-------------|---------|
| `--days=DAYS` | Delete revisions older than X days | `--days=7` |
| `--dry-run` | Preview deletions without executing | `--dry-run` |
| `--quiet` | Suppress output except errors | `--quiet` |
| `--env=ENV` | Use specific environment config | `--env=production` |
| `--help` | Display help information | `--help` |

### Automation Examples

#### Cron Job for Daily Cleanup
```bash
# Run cleanup daily at 2 AM
0 2 * * * cd /path/to/grav && bin/plugin revisions-pro cleanup --quiet --days=30
```

#### Scheduled Cleanup via Grav Scheduler
```bash
# Add to crontab to run Grav scheduler every minute
* * * * * cd /path/to/grav && bin/grav scheduler 1>> /dev/null 2>&1
```

## Storage Architecture

Understanding how revisions are stored helps with backup strategies and troubleshooting.

### Storage Locations

#### Page Revisions
Stored alongside the page files:
```
/user/pages/02.typography/
├── default.md                          # Current page
├── default.md.20240130-143022.rev     # Revision
├── default.md.20240129-102015.rev     # Older revision
├── default.fr.md                      # French version
└── default.fr.md.20240130-145530.rev  # French revision
```

#### Configuration Revisions
Stored alongside configuration files:
```
/user/config/
├── system.yaml                         # Current config
├── system.yaml.20240130-143022.rev    # Revision
└── system.yaml.20240129-102015.rev    # Older revision

/user/config/plugins/
├── revisions-pro.yaml                 # Current plugin config
└── revisions-pro.yaml.20240130-143022.rev
```

#### Environment-Specific Configs
```
/user/env/production/config/
├── system.yaml
└── system.yaml.20240130-143022.rev
```

### Revision Index

A centralized index tracks all revisions for efficient management:
```
/user/data/revisions/index.json
```

This index contains metadata about all revisions and is used for:
- Quick revision lookups
- Cleanup operations
- Storage limit enforcement

### File Naming Convention

Revisions use a consistent naming pattern:
```
[original-filename].[timestamp].rev
```

Where timestamp format is: `YYYYMMDD-HHMMSS`

## API Reference

For developers who want to integrate with Revisions Pro programmatically.

### Getting the Revision Manager

```php
// Get revision manager instance
$revisionManager = $grav['plugins']
    ->get('revisions-pro')
    ->revisionManager;
```

### Common Operations

#### Get Revisions for a Page
```php
// Get all revisions for a page
$page = $grav['pages']->find('/typography');
$revisions = $revisionManager->getRevisions($page);

// Get limited number of revisions
$revisions = $revisionManager->getPageRevisions($page->path(), 10);
```

#### Get Revisions for Configuration
```php
// System config revisions
$revisions = $revisionManager->getRevisionsForRoute(
    'system', 
    'config-system'
);

// Plugin config revisions
$revisions = $revisionManager->getRevisionsForRoute(
    'revisions-pro', 
    'plugin-config'
);
```

#### Create a Manual Revision
```php
// Create revision for current page state
$result = $revisionManager->createRevision($page, 'page');

// Create revision for config
$result = $revisionManager->createRevision($config, 'config-system');
```

#### Restore a Revision
```php
// Restore by revision ID
$success = $revisionManager->restoreRevision($revisionId);

// Get restore result details
if ($success) {
    $restoredFile = $revisionManager->getRevision($revisionId);
}
```

#### Delete a Revision
```php
// Delete specific revision
$success = $revisionManager->deleteRevision($revisionId);

// Cleanup old revisions
$deletedCount = $revisionManager->cleanupOldRevisions(30); // days
```

### Events

Revisions Pro fires events that you can hook into:

```php
// In your plugin
public static function getSubscribedEvents()
{
    return [
        'onRevisionCreate' => ['onRevisionCreate', 0],
        'onRevisionRestore' => ['onRevisionRestore', 0],
        'onRevisionDelete' => ['onRevisionDelete', 0]
    ];
}

public function onRevisionCreate($event)
{
    $revision = $event['revision'];
    $type = $event['type'];
    // Custom logic here
}
```

## Troubleshooting

### Revisions Not Being Created

1. **Check Plugin Status**
   - Ensure the plugin is enabled in configuration
   - Verify the specific tracking toggle is enabled
   
2. **File Permissions**
   - Web server must have write access to content directories
   - Check permissions on `/user/pages/`, `/user/config/`, etc.
   
3. **Review Logs**
   ```bash
   tail -f logs/grav.log
   ```

### Cleanup Not Running Automatically

1. **Verify Configuration**
   ```yaml
   auto_cleanup: true
   ```

2. **Check Scheduler**
   - Ensure Grav Scheduler is enabled and running correctly
   - Verify cron job is configured:
   ```bash
   crontab -l | grep scheduler
   ```

3. **Test Manually**
   ```bash
   bin/plugin revisions-pro cleanup --dry-run
   ```

### Storage Issues

1. **Monitor Disk Space**
   ```bash
   # Check revision storage usage
   du -sh user/pages/**/*.rev
   du -sh user/config/**/*.rev
   ```

2. **Adjust Retention Settings**
   - Lower `max_revisions_per_page`
   - Reduce `cleanup_older_than`
   - Run manual cleanup more frequently

### Performance Issues

1. **Large Number of Revisions**
   - Consider reducing `max_revisions_per_page`
   - Run cleanup to remove old revisions
   
2. **Slow Panel Loading**
   - Check if specific resources have excessive revisions
   - Consider implementing pagination (contact support)

### Language-Specific Issues

1. **Wrong Language Revisions Showing**
   - Clear Grav cache: `bin/grav clear-cache`
   - Ensure you're on the correct language URL in admin
   
2. **Missing Language Revisions**
   - Check that multi-language is properly configured
   - Verify language files exist for the content

### Debug Mode

Enable debug mode for detailed error messages:

```yaml
# user/config/system.yaml
debugger:
  enabled: true
  
# Also check plugin logs
log:
  handler: file
  syslog:
    facility: local6
```

### Common Error Messages

| Error | Cause | Solution |
|-------|-------|----------|
| "No revisions found" | No revisions exist yet | Make and save a change to create first revision |
| "Failed to create revision" | Permission issue | Check file/directory permissions |
| "Revision not found" | Revision was deleted or ID is wrong | Verify revision exists in file system |
| "Restore failed" | File permissions or corruption | Check permissions and file integrity |

## Best Practices

### Storage Management

1. **Set Reasonable Limits**
   - Production: 20-50 revisions per page
   - Development: 10-20 revisions per page
   
2. **Regular Cleanup**
   - Enable automatic cleanup
   - Set appropriate age limits based on your needs
   - Monitor storage usage periodically

### Security Considerations

1. **Access Control**
   - Only admin users can access revisions
   - Consider additional role-based restrictions
   
2. **Sensitive Data**
   - Be aware that revisions may contain sensitive data
   - Clean up old revisions containing outdated sensitive information
   - Consider shorter retention for configuration files

### Performance Optimization

1. **Caching Compatibility**
   - Revisions Pro is fully compatible with Grav caching
   - No need to disable caching on pages with revisions
   
2. **Large Sites**
   - Use more aggressive cleanup settings
   - Consider disabling revision count badges for better performance
   - Monitor the revision index size

### Backup Strategy

1. **Include Revisions in Backups**
   - Revision files (`.rev`) should be included in backups
   - The revision index (`/user/data/revisions/index.json`) is important
   
2. **Restore Procedures**
   - Revisions will be available after restoring backup
   - Run `bin/grav clear-cache` after restore

## Migration Guide

### From Manual Backups

If you've been manually backing up files:

1. Install and configure Revisions Pro
2. Your existing content becomes the "current" version
3. New revisions are created automatically going forward
4. Old manual backups can be kept separately

### From Other Version Control

If migrating from Git or other VCS:

1. Revisions Pro complements Git, not replaces it
2. Git for code, Revisions Pro for content
3. Both can be used simultaneously
4. Consider shorter retention for Revisions Pro if using Git

## Support

For issues, questions, or feature requests:

1. **Documentation**: Check this guide first
2. **GitHub Issues**: Report bugs at the [issues URL](https://github.com/getgrav/grav-premium-issues/issues?q=label:revisions-pro)
3. **Grav Discord**: Get community help in #premium-support
4. **Premium Support**: Available for license holders

When reporting issues, include:
- Grav version
- PHP version
- Plugin version
- Error messages from logs
- Steps to reproduce
