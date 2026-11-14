---
title: Installation
taxonomy:
    category: docs
description: Install Forms Pro, check its requirements, see where forms and entries are stored and give your team the permissions they need.
---

# Installation

This page gets Forms Pro installed and shows where it keeps your forms and the entries people send.

## Before you begin

- Grav 2.0.4 or newer, with Admin Next (`admin2` 2.0.11 or newer) and the API plugin (1.0.8 or newer).
- PHP 8.3 or newer.
- The Form plugin 9.2.1 or newer, which processes every form, and the Email plugin 5.0.1 or newer if you want notifications.
- The Shortcode Core plugin if you want to embed forms with a shortcode.
- Your Forms Pro license added to the [License Manager](https://getgrav.org/premium/license-manager).

## Install the plugin

Install through GPM like any other plugin:

```bash
bin/gpm install forms-pro
```

You can also install it from **Plugins** in Admin Next. Once enabled, Forms Pro adds a **Forms Pro** item to the Admin Next sidebar, with an **Entries** item under it and a badge that counts unread entries.

To enable it by hand, set `enabled: true` in `user/config/plugins/forms-pro.yaml`.

> [!NOTE]
> Forms Pro does not run without the Form plugin. If the Form plugin is missing or disabled, forms render as an HTML comment saying so, and the log gets a warning. See [Troubleshooting](../troubleshooting#a-form-shows-nothing-on-the-page).

## Where things are stored

Everything lives under `user/data/forms-pro/`:

| What | Where |
|---|---|
| A form | `user/data/forms-pro/forms/<name>.yaml`, one file per form |
| The entries of a form | `user/data/forms-pro/submissions/<name>/`, one YAML file per entry, plus an `index.json` that speeds up lists and counts |
| Files visitors upload | Wherever the field's **Upload Destination** says. A new File Upload field starts with `user-data://uploads`. |

Form names use lowercase letters, numbers and hyphens, start with a letter and run to at most 100 characters. They share a few words with the API, so these names are refused: `config`, `catalog`, `badge`, `forms`, `submissions`, `export` and `duplicate`.

The location can be moved with `storage.path`, `storage.forms_folder` and `storage.submissions_folder` in the plugin configuration. See [Configuration](../configuration).

Back up `user/data/forms-pro/` with the rest of your site. A form file is plain YAML, so it also works well in version control: copy it to another site's `forms` folder and the form is there.

> [!NOTE]
> Saving a form in the builder clears what needs clearing, so the site picks up the change right away. If you edit a form file by hand, run `bin/grav clear` afterwards, or a cached page can keep showing the old form.

> [!WARNING]
> Grav's stock server rules refuse direct requests for the YAML and JSON files under `user/data`, so forms and entries cannot be downloaded by URL. They do allow images, PDFs and media files under `user/data` to be served directly. A file a visitor uploaded to `user-data://uploads` can therefore be opened by anyone who knows its address. Leave **Randomize Filenames** on (it is on for a new File Upload field) so the address cannot be guessed, and do not collect files that must stay private without checking your server rules. See [Entries](../entries#files).

## Give your team access

Reaching Forms Pro in Admin Next takes `api.access`, plus one or more Forms Pro permissions. Super users have all of them. Create groups in Admin Next under **Accounts** for everyone else:

| Group | Permissions |
|---|---|
| `forms-editors` | `api.access`, `api.forms-pro.forms.read`, `api.forms-pro.forms.write` |
| `forms-readers` | `api.access`, `api.forms-pro.submissions.read`, `api.forms-pro.submissions.write` |

An account that can only handle entries sees an **Entries** section and no builder. [Permissions](../permissions) lists what each one allows.

## First checks

1. Open Admin Next. **Forms Pro** is in the sidebar for any account with a Forms Pro permission.
2. Click **New Form**, give it a title and click **Create**. The builder opens on a starter form.
3. Click **Embed** to copy the shortcode, and put it on a page. [Getting started](../getting-started) walks through the whole round trip.

## Related

- [Getting started](../getting-started)
- [Configuration](../configuration)
- [Permissions](../permissions)
- [Troubleshooting](../troubleshooting)
