---
title: Spam Protection
taxonomy:
    category: docs
description: Keep bots out of Forms Pro forms with the honeypot and a challenge: Basic CAPTCHA, Google reCAPTCHA, Cloudflare Turnstile or Cap. Covers the Settings tab switch, the two halves every challenge needs, and where the keys go.
---

# Spam Protection

Forms Pro uses the Form plugin's spam protection, and adds a switch for it on the **Settings** tab. There are two layers, and you can use both: a **honeypot**, which costs visitors nothing, and a **challenge**, which asks the visitor or their browser to prove something.

## Honeypot

A honeypot is a text field hidden from people. Bots that fill in every field fill it in too, and a submission with that field filled is refused: nothing is stored, no notification is sent, and the visitor sees the form again. Real visitors never see the field.

**Settings** has a **Honeypot** switch. A new form starts with it on. Turning it off removes the field. In the YAML it is a field of type `honeypot`:

```yaml
fields:
  honeypot:
    type: honeypot
```

The honeypot's value is never stored in an entry, a notification or a webhook. A honeypot catches simple bots only. For forms that attract spam, add a challenge as well.

## Challenges

On the **Settings** tab, **Challenge** chooses one:

| Choice | What the visitor does | Needs keys from the provider |
|---|---|---|
| **None** | Nothing. | No |
| **Basic math or text** | Types the characters shown in an image, or answers a small puzzle. | No, it runs on your server. |
| **Google reCAPTCHA** | Ticks the checkbox, or nothing for the invisible and score-based versions. | Yes |
| **Cloudflare Turnstile** | Usually nothing. | Yes |
| **Cap (proof of work)** | Usually nothing. The browser does a small calculation. | No, it runs on your server. |

Pick one and the builder adds both halves a challenge needs:

1. **A field** that draws the challenge, placed at the end of the form (in the last step of a multi-step form), where the visitor meets it before **Submit**.
2. **A validation action** of the same name on the **Actions** tab, which checks the answer on the server before any other action runs.

Both are needed. A field alone only shows a box. Without the action, a bot that skips the box is not stopped. If the field is there and the action is missing, the Settings tab warns **This form shows a challenge but nothing checks it**, with an **Add the check** button. Choosing **None** removes both halves. A form can use one challenge at a time.

The validation actions run first (see [Actions and notifications](../actions-and-notifications#the-actions-tab)), so a refused submission never reaches **Store Submission**, a notification or a webhook.

### In the YAML

The Form plugin's own field types are used, with the matching action in `process`:

```yaml
fields:
  challenge:
    type: basic-captcha
    label: Type the characters you see
process:
  - basic-captcha: true
  - submission: true
  - message: Thanks!
```

| Challenge | Field `type` | Action |
|---|---|---|
| Basic math or text | `basic-captcha` | `basic-captcha: true` |
| Google reCAPTCHA | `captcha` | `captcha: {}`, or `captcha: { recaptcha_secret: '...' }` to use another secret key for this form |
| Cloudflare Turnstile | `turnstile` | `turnstile: true` |
| Cap | `cap` | `cap: true` |

The palette also has a **CAPTCHA** field with a **Provider** list, as a single place to pick any of the four. It is written to the file as the provider's own field type.

Field options differ by challenge. **Turnstile** has a **Theme** (`turnstile_theme`: `light` or `dark`, or empty to follow the Form plugin's setting). **Cap** has a **Mode** (`mode`: `invisible` or `checkbox`, or empty to follow the Form plugin's setting). **reCAPTCHA** has an **Error Message** (`recaptcha_not_validated`), the text shown when the check fails.

The field can have any name.

A refused Basic CAPTCHA answer comes back as an error above the form that says **Human verification has identified this form submission is problematic**, and nothing is stored.

### Keys and settings

Keys and appearance are not set per form. They are in the Form plugin's settings, which the Settings tab links to when you choose reCAPTCHA or Turnstile:

| Challenge | Where | Settings |
|---|---|---|
| reCAPTCHA | Form plugin, reCAPTCHA | `recaptcha.site_key`, `recaptcha.secret_key`, `recaptcha.version` (`2-checkbox` and others), `recaptcha.score_threshold`, `recaptcha.theme` |
| Turnstile | Form plugin, Turnstile | `turnstile.site_key`, `turnstile.secret_key`, `turnstile.theme` |
| Cap | Form plugin, Cap | `cap.mode` and the difficulty, expiry and abuse settings |
| Basic | Form plugin, Basic captcha | `basic_captcha.type` (`characters`, `math`, `dotcount`, `position`), sizes and colours |

Each provider's keys come from the provider's own dashboard. Details of every setting, and how each captcha works, are in the Form plugin's documentation: [Basic captcha](../../../forms/forms/fields-available#basic-captcha-field), [Cap](../../../forms/forms/fields-available#cap-captcha-field-proof-of-work), [Turnstile](../../../forms/forms/fields-available#turnstile-captcha-field-cloudflare) and [reCAPTCHA](../../../forms/forms/fields-available#google-captcha-field-recaptcha).

> [!NOTE]
> A form in [calculator mode](../calculations#calculator-mode) never submits, so its spam settings are switched off while it is on.

## Choosing

- A form that is only on your own small site: the **honeypot** often does it on its own.
- A form that gets spam anyway: add **Turnstile** or **Cap**. Neither asks most visitors to do anything, and Cap needs no account with a provider.
- When you do not want to send visitors' data to a third party: **Basic** or **Cap**. Both run on your own server.

## Related

- [Settings tab](../settings-tab)
- [Actions and notifications](../actions-and-notifications)
- [Troubleshooting](../troubleshooting)
