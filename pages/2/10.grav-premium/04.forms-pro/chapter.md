---
title: Forms Pro
template: chapter
taxonomy:
    category: docs
description: A drag-and-drop form builder for Grav 2.0 inside Admin Next, with multi-step forms, conditional logic, calculators, notifications, webhooks and entries, saved as ordinary Form plugin YAML.
---

**Forms Pro** is a visual form builder that runs inside Admin Next. You build a form by dragging fields onto a canvas, set what happens when it is sent, and place it on any page with a shortcode, a Twig function or a page header. Each form is saved as one YAML file in the format the Form plugin already reads, so every Form plugin feature (validation, nonces, file uploads, process actions) keeps working underneath, and a form you edit by hand opens in the builder without losing anything.

> [!IMPORTANT]
> Premium products require the free [License Manager](https://getgrav.org/premium/license-manager) plugin. Install it and add your product license before installing Forms Pro.

## Requirements

| Requirement | Notes |
|---|---|
| **Grav** `>= 2.0.4` | Forms Pro is not compatible with Grav 1.7 |
| **PHP** `>= 8.3` | |
| **Form plugin** `>= 9.2.1` | Processes every form and provides the captcha providers |
| **Email plugin** `>= 5.0.1` | Sends notifications and the Send Email action |
| **API plugin** `>= 1.0.8` | Powers the builder and the REST API |
| **Admin Next** (`admin2`) `>= 2.0.11` | Where you build forms and read entries |

The shortcode also needs the Shortcode Core plugin. Without it you can still embed a form with the Twig function or a page header.

## What's in the box

- **A visual builder** with a palette of 49 field types, nested layouts (columns, tabs, fieldsets, sections), inline editing of labels and options, undo and redo, and a property panel for every field.
- **Eleven pro fields**: name, address, phone, rating, slider, rich text, date picker, time picker, calculation, recipients and repeater.
- **Multi-step forms** with a progress bar, numbered circles or tabs, and a check on each step before the visitor moves on.
- **Conditional logic**: show or hide fields from rules, applied live in the browser and enforced again on the server.
- **Calculations and calculator mode**: fields that work out a value from a formula, and forms that are pure calculators and never submit.
- **Actions and notifications**: store entries, send several emails per form with merge tags and conditions, route mail to a recipient the visitor picks, call a webhook, redirect or show a message.
- **Entries** in Admin Next with search, filters, stars, notes, bulk actions, CSV and JSON export and file downloads.
- **Spam protection** with a honeypot and a challenge: a basic captcha, Google reCAPTCHA, Cloudflare Turnstile or Cap.
- **A REST API and extension points**, so scripts can manage forms and entries, and other plugins can add their own fields and actions.

## Where to start

1. [Installation](../forms-pro/installation) gets the plugin running and shows where forms and entries are stored.
2. [Getting started](../forms-pro/getting-started) builds a contact form, puts it on a page and reads the first entry.
3. [The builder](../forms-pro/the-builder) is the tour of the canvas, the palette and the property panel.

If you are building a calculator, go to [Calculations](../forms-pro/calculations) and the [Formula reference](../forms-pro/formula-reference). If a form is not doing what you expect, start with [Troubleshooting](../forms-pro/troubleshooting).
