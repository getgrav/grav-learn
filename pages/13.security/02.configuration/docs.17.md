---
menu: Configuration
title: Recommended Configuration
taxonomy:
    category: docs
---

Like with every other application, it is important that you check through the configuration options to secure and optimize your site.

## Production Site

It is important to secure your production site by hardening the configuration. To do this, we recommend you to set your main configuration in `user/config/` to contain the default settings you want to use in your production environment and override these settings in your development site environment such as `user/env/localhost` or `user/env/site.local`. You can also override production site settings through the environments, for example if you're using multi-site setup over multiple domains.

### System Configuration (`user/config/system.yaml`)

```yaml
force_ssl: true       # Use HTTPS only (redirect from HTTP -> HTTPS)

cache:
  enabled: true       # Greatly speeds up the site
  check:
    method: hash      # Optimization, disables file modification checks for pages

twig:
  cache: true         # Greatly speeds up the site
  debug: false        # We do not want to display debug messages
  auto_reload: false  # Optimization, disables file modification checks for twig files
  autoescape: true    # Protects from many XSS attacks, but requires twig updates if used in older sites/themes/plugins

errors:
  display: 0          # Display only a simple error
  log: true           # Log errors for later inspection

debugger:
  enabled: false      # Never keep debugger enabled in a live site.
  censored: true      # In case if you happen to enable debugger, avoid displaying sensitive information

session:
  enabled: true       # NOTE: Disable sessions if you do not use user login and/or forms.
  secure: true        # Use this as your site should be using HTTPS only
  httponly: true      # Protects session cookies against client side scripts and XSS
  samesite: Strict    # Prevent all cross-site scripting attacks
  split: true         # Separate admin session from the site session for added security

strict_mode:          # Test your site before changing these. Removes backward compatibility and improves site security.
  yaml_compat: false
  twig_compat: false
  blueprint_compat: false
```

## Development Site

For development server, there are a few settings we should change to make it more convenient to update the site.

### System Configuration (`user/env/localhost/config/system.yaml`)

!!! **TIP:** Replace localhost with your local server name.

```yaml
force_ssl: false      # If the development site doesn't use SSL

cache:
  enabled: true       # Still keep cache enabled
  check:
    method: file      # Allow updating pages without clearing cache

twig:
  cache: true         # Still keep cache enabled
  debug: true         # We want to display debug messages
  auto_reload: true   # We may be editing twig files

errors:
  display: 1          # Display full backtrace if there are errors

debugger:
  enabled: true       # Debugger is handy to have
  censored: false     # We may want to see secure content in debugger

session:
  secure: false       # If the development site doesn't use SSL
  httponly: false     # If the development site doesn't use SSL

strict_mode:          # These settings help you to keep your site updated to use the latest standards
  yaml_compat: false
  twig_compat: false
  blueprint_compat: false
```
