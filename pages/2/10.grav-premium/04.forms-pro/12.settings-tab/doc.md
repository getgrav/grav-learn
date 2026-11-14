---
title: Settings Tab
taxonomy:
    category: docs
description: The Settings tab of a Forms Pro form. Covers the title and description, calculator mode, the submit and reset buttons, error and validation behaviour, sending without a page reload, spam protection switches and the form's CSS classes.
---

# Settings Tab

The **Settings** tab holds what applies to the form as a whole, rather than to one field. Each switch on it writes a plain key in the form's YAML, and the Form plugin acts on it, so the same keys work in a form you write by hand. This page goes through the tab from top to bottom. [Spam protection](../spam-protection) covers the last section in more depth.

Some switches have a site-wide default in the Form plugin's own settings. Such a switch shows that default until the form sets its own. The tab only stores a value in the form when it differs from the default, so a form that follows the site keeps a clean YAML file and follows later changes to the default.

## General

| Setting | YAML key | What it does |
|---|---|---|
| **Form Title** | `title` | The form's name in the builder and in lists. |
| **Show Title on the Page** | `show_title: true` | Prints the title as a heading above the fields. |
| **Description** | `description` | Plain text shown under the title, above the fields. |

The title and description are shown only where the form is embedded with the shortcode or the Twig function (see [Embedding](../embedding)). They are printed as `<h2 class="fp-form-title">` and `<p class="fp-form-description">` inside a `fp-form-header` element, so your theme can style them. Without **Show Title on the Page** the title is not printed, but the description is shown whenever it is set.

## Calculator mode

**Calculator Mode** turns the form into a calculator: it shows no buttons, runs no actions, never submits, and the page can be cached. It is `mode: calculator` in the YAML. [Calculations](../calculations#calculator-mode) covers what it does and when to use it. While it is on, the **Submitting** and **Spam Protection** sections of this tab are greyed out and a note says so, and the Actions tab shows a warning. The settings and actions you had are kept for when you turn it off.

## Submitting

| Setting | YAML key | What it does |
|---|---|---|
| **Submit Button Label** | `buttons` | The text on the submit button. Empty uses `Submit`. |
| **Reset Button** | `buttons` | Adds a button next to Submit that clears everything the visitor typed. Its label is `Reset`. |
| **Errors Next to Fields** | `inline_errors` | Shows each validation error under its field, instead of only at the top. |
| **Check Fields in the Browser** | `client_side_validation` | The browser checks required fields and formats before sending. The server always checks again. On by default. |
| **Prevent Resending on Refresh** | `refresh_prevention` | Reloading the page after sending does not send the form a second time. |
| **Send Without Reloading the Page** | `xhr_submit` | The form sends in the background, and the response is shown without loading a new page. |

The buttons are stored as the form's `buttons` list, which you can also edit directly:

```yaml
buttons:
  - type: submit
    value: Send it
  - type: reset
    value: Clear
```

A reset button added from the tab is stored the same way, with `Reset` as its text. Edit the YAML if you want a different label.

**Errors Next to Fields**, **Check Fields in the Browser** and **Prevent Resending on Refresh** follow the Form plugin's defaults until you change them here. 

**Send Without Reloading the Page** is off unless you turn it on. With it on, a validation error appears next to the field without a page load, and after a successful send the confirmation message appears above the form, which stays on the page.

> [!TIP]
> **Check Fields in the Browser** only saves a visitor a round trip, because the server checks every submission again. Turn it off if you prefer the server's wording for every message.

## Spam protection

| Setting | What it does |
|---|---|
| **Honeypot** | Adds a hidden field that only bots fill in. A submission that fills it is refused, and visitors never see it. A new form starts with one. |
| **Challenge** | Adds a challenge at the end of the form and the action that checks it before anything else runs. Choose **None**, **Basic math or text**, **Google reCAPTCHA**, **Cloudflare Turnstile** or **Cap (proof of work)**. |

Choosing a challenge adds both halves: a field on the form and a validation action on the Actions tab. If the field is there but the action has been removed, the tab shows a notice that nothing checks the challenge, with **Add the check** to put the action back. The site and secret keys for reCAPTCHA and Turnstile are not set here. They live in the Form plugin's settings, and the tab links to them. See [Spam protection](../spam-protection) for each option.

## Advanced

**Form CSS Classes** (`classes`) adds your own classes to the `<form>` element, for styling from your theme:

```yaml
classes: contact-form compact
```

## The same settings in YAML

A form that uses most of the tab, written by hand:

```yaml
title: Settings Demo
type: forms-pro
show_title: true
description: Tell us how we can help.
classes: contact-form
inline_errors: true
client_side_validation: false
xhr_submit: true
fields:
  name:
    type: text
    label: Name
    validate:
      required: true
buttons:
  - type: submit
    value: Send it
  - type: reset
    value: Clear
process:
  - submission: true
  - message: Got it.
```

## Related

- [The builder](../the-builder)
- [Spam protection](../spam-protection)
- [Embedding](../embedding)
- [Calculations](../calculations)
