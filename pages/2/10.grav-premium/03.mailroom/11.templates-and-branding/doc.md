---
title: Templates and Branding
taxonomy:
    category: docs
description: The branded email layout and its settings, the plain layout, campaign templates as starting points, and overriding Mailroom's email and page templates in your theme.
---

# Templates and Branding

Every campaign, confirmation and automation email is drawn in one layout with your logo and colors. This page covers the layout's settings, the campaign templates on the **Templates** tab, and overriding Mailroom's Twig templates in a theme.

## The email layout

The **Email Design** tab of Mailroom's settings sets the frame: your logo or your site's name at the top, a white card for the message, and a footer with the unsubscribe links.

| Setting | Label | Default | What it does |
|---|---|---|---|
| `branding.logo` | Logo | empty | An image URL, or a path on this site such as `/user/images/logo.png`. Empty prints your site's name in the header. |
| `branding.logo_width` | Logo Width (pixels) | `160` | How wide the logo is drawn (16 to 600). Its height follows. |
| `branding.accent` | Accent Color | empty | Links, the confirmation button and the rule under the header in every email, and the buttons and links on Mailroom's public pages and signup box. Empty is teal (`#1a6f83`) in email, and on the pages your theme's own accent where it has one (Quark2 does), else teal. |
| `branding.background` | Background Color | `#f4f5f7` | What the card sits on. |
| `branding.text` | Text Color | `#222222` | The color of the message itself. |
| `branding.footer_text` | Footer Text | empty | A line or two under every message, such as why people are receiving it. Plain text. |
| `branding.postal_address` | Postal Address | empty | Printed at the foot of every message, branded or plain, and in its plain-text part. |

Colors are hex codes (`#abc` or `#aabbcc`); anything else is replaced by the default rather than printed, so a typo cannot break the email.

> [!IMPORTANT]
> Bulk mail law in many countries, the United States' CAN-SPAM among them, expects a real postal address on marketing email. Fill in **Postal Address** before your first campaign.

### The plain layout

A campaign or automation email set to **Plain** leaves out the header, the card and the branding: white ground and your message, with the unsubscribe footer below. The **Footer Text** and **Postal Address** are still printed under that footer, and at the end of the plain-text part of every email, because the address is expected in every message.

## Templates

A template is a starting point for campaigns: the subject, preheader, message and layout you keep retyping. A campaign copies a template when it is created and never reads it again, so changing or deleting a template never touches campaigns already written from it.

On the **Templates** tab:

1. Press **New template**.
2. Give it a name, a subject, a preheader, a message and a layout, the same fields as a campaign. Merge tags are checked the same way.
3. Leave **Offered when writing a campaign** checked to offer it in the campaign editor.
4. Save. The preview draws it through the real layout.

**Start a campaign from this** on a template opens a new campaign with its fields filled in. Through the API, pass `template_id` when creating a campaign.

## Override the templates in your theme

Mailroom's templates are ordinary Twig files. Copy one into your theme's `templates/` folder at the same path and your copy wins.

### Email templates

| Template | What it is |
|---|---|
| `emails/mailroom-email-layout.html.twig` | The branded layout every email extends |
| `emails/newsletter-plain-layout.html.twig` | The plain layout |
| `emails/newsletter-campaign.html.twig`, `emails/newsletter-campaign.txt.twig` | A campaign or automation email, HTML and plain text |
| `emails/newsletter-confirmation.html.twig`, `emails/newsletter-confirmation.txt.twig` | The confirmation email |

The layouts share one contract, so a child template extends either without knowing which:

- **Blocks**: `title`, `preheader`, `content` and `footer`, which the children fill; the branded layout also has `header`, for a copy that wants a different header without touching the rest.
- **Variables** every email is given: `subject`, `site_name`, `site_url`, `store_url` (the site's front page), `email_layout` and `t_prefix`. A campaign adds `preheader`, `content`, `campaign`, `eyebrow`, `unsubscribe_url`, `preferences_url`, `browser_url` and `plain_layout`; the confirmation adds `confirm_url`, `list_name` and `subscriber_email`.
- The footer text and postal address are printed after the `footer` block rather than inside it, so a child that replaces the footer still carries them.

> [!WARNING]
> Keep `emails/newsletter-campaign.txt.twig` if you override the campaign templates. Without a plain-text part, campaigns go out as HTML only, which spam filters score against, and the Health screen's **Plain-text part** check fails.

### Page templates

The public pages and the signup box can be overridden the same way: `newsletter-confirm.html.twig`, `newsletter-unsubscribe.html.twig`, `newsletter-preferences.html.twig`, `newsletter-message.html.twig` and `partials/newsletter-signup.html.twig`. See [Lists and signup forms](../lists-and-signup-forms#the-public-pages).

Each of them includes `partials/mailroom-accent.html.twig` on its outer element, which hands the page the **Accent Color** when one is set. Keep the include in a copy, or set the color in your theme's stylesheet instead:

```css
.mailroom { --mailroom-accent: #7c3aed; }
```

## Related

- [Campaigns](../campaigns)
- [Lists and signup forms](../lists-and-signup-forms)
- [Configuration](../configuration#email-design)
