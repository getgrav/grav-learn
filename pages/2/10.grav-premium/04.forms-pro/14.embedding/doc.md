---
title: Embedding
taxonomy:
    category: docs
description: Put a Forms Pro form on a page with the shortcode, a Twig function or a page header. Covers the Embed tab, the options of each method, several forms on one page, caching, and what a missing form looks like.
---

# Embedding

A Forms Pro form is not part of any page. It is stored on its own, so you decide where it appears by naming it in a page. Three methods do the same job, and submissions, validation and actions work the same through each.

Open a form in the builder and click its **Embed** tab. It shows the three snippets for this form, each with a copy button. The form's name in them is the file name of the form, such as `contact-us`.

## Shortcode

Paste this anywhere in a page's Markdown:

```markdown
[forms-pro name="contact-us" /]
```

`[form-pro]` and `[fp]` are shorter names for the same thing, and the form name can also go between tags:

```markdown
[fp name="contact-us" class="wide" /]

[form-pro]contact-us[/form-pro]
```

| Attribute | Meaning |
|---|---|
| `name` | The form's name. `form` works too, and so does putting the name between opening and closing tags. |
| `class` | Extra CSS classes added to the box around the form. |

The shortcode needs the Shortcode Core plugin to be installed. It works in any content that shortcodes work in, including pages written with Editor Pro. To turn it off site-wide, switch off **Enable Shortcode** in the plugin's settings (see [Configuration](../configuration)). Forms in a page's header or a Twig template are not affected.

## Twig

In a theme template, or in page content with Twig processing turned on:

```twig
{{ forms_pro('contact-us') }}
{{ forms_pro('contact-us', {classes: 'wide'}) }}
```

The second argument takes `classes`, like the shortcode's `class`. In page content, turn Twig processing on in the page's frontmatter:

```yaml
---
title: Contact
process:
    twig: true
---

Write to us here:

{{ forms_pro('contact-us', {classes: 'my-wrapper'}) }}
```

Two more functions help theme authors. `forms_pro_form('contact-us')` returns the form object, to render yourself, or `null` if there is no such form. `forms_pro_text(field, value)` and `forms_pro_html(field, value)` turn a stored answer into readable text or sanitized HTML, the way entries and emails show it.

## Page header

Name the form in the page's frontmatter:

```yaml
---
title: Contact
forms_pro: contact-us
---
```

A list works for several forms: `forms_pro: [contact-us, newsletter]`. The header method does not draw the form itself. It hands the form to the Form plugin, so the page needs a template that draws the page's forms. The theme's `form` template does, so name the file `form.md`. A page named `default.md` with `forms_pro:` in its header shows no form, because the `default` template does not draw forms. Use the shortcode or Twig there instead.

A form drawn this way comes from the Form plugin's template, so it does not have the `forms-pro-container` box around it, the title and description from the Settings tab, or the `class` option.

## More than one form on a page

Embed as many as you like, each by its own name:

```markdown
[fp name="contact-us" /]

[fp name="newsletter" class="narrow" /]
```

Each form is processed on its own, by the name it was embedded with.

## Caching

A page that embeds a form is left out of Grav's page cache, so each visitor gets their own security token and sees their own validation messages and remembered answers. A page that only embeds [calculators](../calculations#calculator-mode) can still be cached, because a calculator is never submitted.

## When a form does not appear

The shortcode and Twig methods leave a comment in the page's HTML when something is wrong, so view the page source:

| Comment | Meaning |
|---|---|
| `<!-- forms-pro: form 'name' not found -->` | No form has that name. Check the spelling against the form's file name in `user/data/forms-pro/forms/`. |
| `<!-- forms-pro: no form name specified -->` | The shortcode has no name. |

The shortcode written out as text on the page means the Shortcode Core plugin is not installed or enabled. Nothing at all where a form should be, with no comment, usually means the header method on a page whose template does not draw forms. [Troubleshooting](../troubleshooting#a-form-shows-nothing-on-the-page) covers these in order.

## Related

- [Settings tab](../settings-tab)
- [Configuration](../configuration)
- [Troubleshooting](../troubleshooting)
