---
title: Configuration
taxonomy:
    category: docs
description: The Forms Pro plugin settings in Admin2 and in user/config/plugins/forms-pro.yaml. Covers the built-in stylesheet, entry privacy options, the shortcode, the Call Function action, webhook limits and the storage folders.
---

# Configuration

The plugin's settings apply to every form. Open **Plugins** in Admin2, choose **Forms Pro**, and change them there, or write them in `user/config/plugins/forms-pro.yaml`. Settings that belong to one form, such as its buttons and spam protection, are on the form's own [Settings tab](../settings-tab).

The settings with a switch in Admin2:

| Setting | YAML key | Default | What it does |
|---|---|---|---|
| **Plugin Status** | `enabled` | on | Turns Forms Pro on or off. Forms stop showing and the builder stops working while it is off. |
| **Built-in CSS** | `built_in_css` | on | Loads the Forms Pro stylesheet for the forms on your pages. Turn it off to style forms entirely from your theme. |
| **Store IP Address** | `submissions.store_ip` | on | Records the visitor's IP address with each entry. |
| **Store User Agent** | `submissions.store_user_agent` | on | Records the visitor's browser with each entry. |
| **Enable Shortcode** | `shortcode.enabled` | on | Lets the `[forms-pro]` shortcode and its aliases show forms. Off, the shortcode shows nothing, and forms named only in shortcodes are not set up. Forms named in a page header or a Twig call still work. |
| **Expose Call Action** | `expose_call_action` | off | Shows the **Call Function** action in the builder and lets forms that use it be saved. See below. |
| **Allow Webhooks to Private Addresses** | `webhooks.allow_private_hosts` | off | Lets a [webhook](../webhooks) call localhost and private networks. |

Settings that are written in the YAML only:

| YAML key | Default | What it does |
|---|---|---|
| `webhooks.timeout` | `10` | Seconds a webhook waits for an answer, when the webhook does not set its own. No webhook waits more than 30. |
| `storage.path` | `user://data/forms-pro` | The folder for everything Forms Pro stores. |
| `storage.forms_folder` | `forms` | The folder for form definitions, inside `storage.path`. |
| `storage.submissions_folder` | `submissions` | The folder for entries, inside `storage.path`. |

A complete file with the defaults:

```yaml
enabled: true
built_in_css: true

storage:
  path: 'user://data/forms-pro'
  forms_folder: forms
  submissions_folder: submissions

submissions:
  store_ip: true
  store_user_agent: true

shortcode:
  enabled: true

webhooks:
  timeout: 10
  allow_private_hosts: false

expose_call_action: false
```

You only need to write the keys you change.

## Entry privacy

An entry holds what the visitor sent, and, with the two **Store** settings on, their IP address and browser. An IP address counts as personal data in many places. If you do not need it, turn off **Store IP Address** and **Store User Agent**. The change applies to entries stored from then on, and does not remove what is already in older entries. A form can also record the IP address on its own with the **User IP** action (see [Actions and notifications](../actions-and-notifications#data-actions)), which is a separate choice per form.

## Call Function

**Call Function** (`call`) runs a PHP function or `[class, method]` you name, with the form as its argument, on every submission. It is as powerful as it sounds, so it is hidden by default. While **Expose Call Action** is off, the builder does not list it and the API refuses to save a form that uses it, with a message that names the setting. Turn it on only if you need it and write the callable yourself.

## Storage

The default places forms and entries under `user/data/forms-pro/`, which `bin/gpm` and Grav updates do not touch, and which is backed up with the rest of `user/data`. You can move them by changing `storage.path`, for example to a folder outside the web root. Move the existing files first, because Forms Pro does not move them for you. The folder must be writable by the web server. See [Installation](../installation#where-things-are-stored).

## Settings in other plugins

Some behaviour of the forms comes from other plugins:

- Challenge keys and appearance for reCAPTCHA, Turnstile, Cap and the basic captcha are in the **Form** plugin's settings (see [Spam protection](../spam-protection)).
- Site-wide defaults for errors next to fields, browser checks and refresh prevention are in the **Form** plugin's settings, and a form follows them until its own Settings tab changes them.
- The sender, mail transport and default content type for notifications are in the **Email** plugin's settings.

## Related

- [Installation](../installation)
- [Webhooks](../webhooks)
- [Spam protection](../spam-protection)
