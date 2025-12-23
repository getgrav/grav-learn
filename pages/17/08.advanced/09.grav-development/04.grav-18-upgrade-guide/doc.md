---
title: Upgrading to Grav 1.8 beta
taxonomy:
    category: docs
last_checked: 1.8.0 (11/04/2025)
---
# Upgrading to Grav 1.8 beta

> [!CAUTION]
> **NOTICE:** This is a work in progress, it may contain content that is not in sync with latest released versions of Grav 1.7 or 1.8 beta

Grav 1.8 introduces significant improvements including PHP 8.3 requirement, updated dependencies, and a new safe upgrade system. Here are a few highlights:

* **PHP 8.3+ Requirement**: Major update from PHP 7.3 requirement in Grav 1.7
* **Safe Upgrade System**: Comprehensive preflight checks, staging, validation, and rollback capabilities
* **Enhanced Twig Support**: Updated to Twig 3.x (forked version for Defer compatibility)
* **Symfony 7 Integration**: Upgraded to Symfony 7.x components for better performance and security
* **Improved Caching**: Symfony Cache provider replaces Doctrine Cache (deprecated)
* **Monolog Compatibility**: Switched to Monolog 3, but retains support for Monolog 2.3+ syntax
* **Code Quality**: PHPStan level 6 support and PHP 8.4 compatibility fixes

> [!TIP]
> **IMPORTANT:** Grav 1.8 requires **PHP 8.3** or later version. This is a major change from Grav 1.7's PHP 7.3.6+ requirement. Always **take a backup** of your site and **test the upgrade in a testing environment** before upgrading your live site, or use 'safe-upgrade' which automatically creates a restorable snapshot of Grav core.

### Most Common Issues

1.  ###### PHP 8.3 Compatibility Issues
    **Issue**: Custom plugins/themes using deprecated PHP features fail to work
    **Solution**: Update code to be PHP 8.3 compatible
    - Check for nullable parameter declarations
    - Update dynamic properties usage
    - Replace deprecated functions

2.  ###### Cache Driver Errors
    **Issue**: Site breaks after upgrade due to removed cache drivers
    **Solution**:
    - Grav 1.8 automatically maps Doctrine cache adapters (`apcu`, `memcached`, `redis`, `array`, etc.) to their Symfony Cache equivalents during upgrade.
    - If Grav encounters an adapter it cannot map, it falls back to the default `filesystem` cache to keep the site running.
    - Update your `system.yaml` cache configuration to the desired adapter for clarity:
    ```yaml
    system:
      cache:
        driver: apcu  # instead of apc
        # or
        driver: memcached  # instead of memcache
    ```

3.  ###### Monolog Logging Issues
    **Issue**: Custom logging code may break with Monolog 2.3/3.x
    **Solution**: Update logging calls:
    ```php
    // Old
    $this->grav['log']->addInfo($message);
    $this->grav['log']->addError($message);
    ...

    // New (compatible with both Monolog 2.x and 3.x)
    $this->grav['log']->info($message);
    $this->grav['log']->error($message);
    ...
    ```

4.  ###### PSR-3 Logging Conflicts
    **Issue**: Plugins or themes that ship their own `vendor/` folder or `composer.json` and pin `psr/log` to an older 1.x release force Composer to install an incompatible version. This breaks Grav's Monolog 3 handler expectations and triggers errors like `Return type must be compatible with Psr\Log\LoggerInterface`.
    **Solution**:
    - Remove the explicit `psr/log` requirement from your extension, or
    - Prefer Grav's bundled version by adding a `replace` block to your `composer.json`:
    ```json
    "replace": {
        "psr/log": "*"
    }
    ```
    - Delete the plugin's `vendor/` directory after updating `composer.json` and rebuild it with `composer install`.
    
    The `bin/gpm preflight` command surfaces this issue under **PSR/log compatibility** warnings, resolve them before upgrading.

5.  ###### Missing Settings Configuration
    **Issue**: Errors due to removed `system.umask_fix` setting
    **Solution**: Remove this setting from your `system.yaml` as it's been removed for security reasons

### Quick Update Guide

> [!CAUTION]
> **Grav 1.8** requires **PHP 8.3** or later version. The recommended version is the latest **PHP 8.4** release.

### Critical Breaking Changes

#### PHP Version Requirement
- **Minimum PHP: 8.3+** (was 7.3.6+ in Grav 1.7)
- Ensure your hosting environment supports PHP 8.3 or higher
- Update any deprecated PHP code in custom plugins/themes

#### Removed Cache Drivers
The following unsupported cache drivers have been removed. Supported adapters (APCu, Memcached, Redis, Array, Filesystem, etc.) are handled by Symfony Cache with the same names, and Grav falls back to `filesystem` if it cannot resolve a custom adapter:
- `APC` (use `apcu` instead)
- `WinCache`
- `XCache`
- `Memcache` (use `memcached` instead)

#### Removed Settings
- `system.umask_fix` setting removed for security reasons

### Safe Upgrade System

Grav 1.8 introduces a comprehensive safe upgrade system:

#### Preflight Checks
Run compatibility checks before upgrading:
```bash
bin/grav preflight
```

The preflight command checks for:
- Plugins pending updates
- PSR-3 logging conflicts
- Monolog version conflicts
- Other compatibility issues

#### Automated Safe Upgrades
The new upgrade system includes:
- **Staging**: Creates snapshots before upgrading
- **Validation**: Verifies upgrade integrity
- **Rollback**: Automatic recovery if upgrade fails

#### Recovery Mode
- Token-gated recovery UI
- Plugin quarantine system
- CLI rollback support

### Enhanced Twig Support

- Updated to Twig 3.x (forked version for PHP 8.4 compatibility)
- New `strict_mode.twig2_compat` and `strict_mode.twig3_compat` settings
- Deferred Extension support for Twig 1.x compatibility
- Twig Sandbox security improvements

#### Manual Twig 3 Updates

The compatibility toggles rewrite a handful of Twig 1/2 constructs on the fly, but you should update templates permanently to avoid runtime transforms.

- **Loop guards**: Replace legacy `for` loops with inline `if` guards (`{% for page in collection if page.published %}`) by filtering the sequence first.
  ```twig
  {# Legacy #}
  {% for page in collection if page.published %}
      {{ page.title }}
  {% endfor %}

  {# Twig 3 friendly #}
  {% for page in collection|filter(page => page.published) %}
      {{ page.title }}
  {% endfor %}
  ```
- **`spaceless` and `filter` blocks**: Twig 3 removed `{% spaceless %}` and `{% filter %}` blocks; switch them to `{% apply %}`.
  ```twig
  {# Legacy #}
  {% spaceless %}
      <div>{{ content|raw }}</div>
  {% endspaceless %}

  {# Twig 3 #}
  {% apply spaceless %}
      <div>{{ content|raw }}</div>
  {% endapply %}
  ```
- **`sameas` test**: Use `is same as` instead of `is sameas`.
  ```twig
  {% if theme is same as('my-theme') %}
  ```
- **`replace` filter signature**: Twig 3 expects a map instead of two string arguments.
  ```twig
  {{ title|replace({'_': ' '}) }}
  ```

After fixing templates, disable `system.strict_mode.twig2_compat` and `system.strict_mode.twig3_compat` and clear the cache to confirm everything renders without the compatibility layer.

### Symfony 7 Integration

- Upgraded to Symfony 7.x components
- Symfony Cache provider (replaces Doctrine Cache)
- Better performance and security

### Dependency Updates

#### Core Dependencies
- **PHP**: 8.3+ (was 7.3.6+)
- **Twig**: 3.x (forked for Defer compatibility)
- **Symfony**: 7.x (was 4.4)
- **Monolog**: 3.x (was 1.25)
- **RocketTheme/Toolbox**: 2.0 (was 1.0)

#### Removed Dependencies
- Doctrine Cache (replaced with Symfony Cache)
- Legacy cache drivers (APC, WinCache, XCache, Memcache)

### Configuration Changes

#### New Settings
```yaml
system:
  strict_mode:
    twig2_compat: true    # Enable Twig 2 compatibility mode
    twig3_compat: true    # Enable Twig 3 compatibility mode
```

#### Updated Defaults
- Cache drivers changed to use Symfony Cache
- Security settings tightened

### Developer Changes

#### Code Quality Improvements
- PHPStan level 6 support in Framework classes
- PHP 8.4 compatibility fixes
- Better type declarations
- Improved error handling

#### API Changes
- Updated event system
- Enhanced logging interface
- Improved caching abstractions

### Plugin & Theme Compatibility

#### Required Updates
- Plugins must support PHP 8.3+
- Update logging calls for Monolog compatibility
- Replace deprecated function calls
- Test with Symfony 6.4/7.x components

#### Testing Checklist
- [ ] Plugin loads without errors
- [ ] Admin interface works correctly
- [ ] Forms process properly
- [ ] Media uploads function
- [ ] Caching works as expected

### Upgrade Process

#### Pre-Upgrade Checklist
1. **Backup your site** - Always backup before upgrading
2. **Check PHP version** - Ensure PHP 8.3+ is available
3. **Run preflight check** - `bin/grav preflight`
4. **Update custom code** - Fix PHP 8.3 compatibility issues
5. **Test in staging** - Never upgrade production directly

#### Upgrade Methods

##### Method 1: Safe Upgrade (Recommended)
```bash
# Perform Grav safe upgrade
bin/gpm self-upgrade --safe

# Monitor for any issues
bin/grav logviewer
```

##### Method 2: Legacy Manual Upgrade w/manual backup
```bash
# Backup first
bin/grav backup

# Run manual preflight checks
bin/gpm preflight

# Update all packages
bin/gpm update -f

# Update Grav with old upgrade system
bin/gpm self-upgrade --legacy

```

#### Post-Upgrade Steps
1. **Verify site functionality**
2. **Check admin panel**
3. **Test forms and user interactions**
4. **Review error logs**
5. **Update plugin configurations** if needed

### Troubleshooting

#### Common Issues

##### Cache Errors After Upgrade
```bash
# Clear all cache
bin/grav clear-cache --all

# Check cache configuration
cat user/config/system.yaml | grep -A 5 cache:
```

##### Logging Issues
```bash
# Check log permissions
ls -la logs/

# Test logging
bin/grav log --level=debug
```

##### Plugin Compatibility
```bash
# List all plugins
bin/plugin list

# Check for updates
bin/gpm update --list-only
```

#### Recovery Procedures

##### Using Recovery Mode
1. Access `/recovery` URL with recovery token
2. Quarantine problematic plugins
3. Rollback to previous version if needed

##### CLI Recovery
```bash
# Recovery with prompt to pick from latest snapshots
bin/restore

# List snapshots
bin/restore list

# Rollback to previous snapshot version
bin/restore apply <version>

# Command Help
bin/restore -h

# Get recovery status
bin/restore recovery status

# Clear recovery status
bin/restore recovery clear
```

### Additional Changelog Callouts

- **Safe upgrade snapshots**: Early Grav 1.8 betas (pre `1.8.0-beta.10`) could miss dotfiles during safe upgrades. If you upgraded with those builds, double-check your project root for files such as `.htaccess` and re-run the latest safe-upgrade flow if anything is missing.
- **CLI script permissions**: A fix in `1.8.0-beta.16` restores executable permissions on the `bin/*` scripts after upgrades. If CLI tools stop working (permission denied), run `chmod +x bin/*` to align with the expected state.
- **YamlUpdater API tweaks**: `1.8.0-beta.5` through `beta.7` introduced new public `YamlUpdater::get()`, `set()`, and `exists()` helpers. Update any automation or plugins that interact with YAML updates to call these methods instead of relying on private internals.

### Getting Help

#### Resources
- [Grav Documentation](https://learn.getgrav.org)
- [GitHub Issues](https://github.com/getgrav/grav/issues)
- [Community Forums](https://discourse.getgrav.org)

#### Support Information
When reporting issues, include:
- PHP version
- Grav version (before and after upgrade)
- Preflight command output
- Error logs
- List of installed plugins

### Migration from Development

If upgrading a development site:
1. Update local PHP to 8.3+
2. Update composer dependencies
3. Run automated tests
4. Update CI/CD pipelines
5. Deploy to staging before production

---

**⚠️ Important**: Always test upgrades in a staging environment before applying to production. The new safe upgrade system provides rollback capabilities, but prevention is better than recovery.
