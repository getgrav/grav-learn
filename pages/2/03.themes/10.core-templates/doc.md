---
title: Core Templates
description: The Twig templates Grav ships, and how a theme extends one instead of copying it
page-toc:
  active: true
taxonomy:
    category: docs
---
# Core Templates

Grav ships a small set of Twig templates in `system/templates` that every theme gets for free. A theme only has to provide a template when it wants something different, and since **Grav 2.1** it can build on the core one instead of keeping a copy.

## What core provides

| Template | Purpose |
| :------- | :------ |
| `partials/metadata.html.twig` | The `<meta>` tags for a page from `page.metadata`, plus the `<link rel="alternate" type="text/markdown">` tag that advertises the page's [Markdown version](/2/content/markdown-output) |
| `partials/messages.html.twig` | Flash messages from `grav.messages` |
| `default.md.twig` | The [Markdown output](/2/content/markdown-output) of a page |
| `default.html.twig`, `modular/default.html.twig` | Placeholders that report a missing theme template. A theme always provides its own |
| `external.html.twig` | The `external` page type |
| `flex/…` | Debug views for Flex objects and collections |

A theme's `base.html.twig` includes the partials by name:

```twig
<head>
    {% include 'partials/metadata.html.twig' %}
</head>
```

Twig looks for the template in the theme first, then in Grav core. When the theme has no `partials/metadata.html.twig` of its own, the core one is used.

## Overriding versus extending

A file with the same name in the theme **replaces** the core template. That is the right tool when the theme wants different markup altogether, as most themes do for messages.

It is the wrong tool for adding a line. A copied partial stops receiving core's fixes and additions: a theme that copied `partials/metadata.html.twig` before 2.1 never got the Markdown alternate link, and one that re-escaped `meta.content` on top of the escaping core already does printed `&amp;amp;` in its descriptions.

Since Grav 2.1 the core templates are also registered under the `@grav` Twig namespace, so a theme template can reach the core original even when a theme file of the same name exists:

```twig
{# user/themes/mytheme/templates/partials/metadata.html.twig #}
{% include '@grav/partials/metadata.html.twig' %}
<link rel="me" href="https://social.example/@me">
```

The same works for `{% extends %}` on any core template that defines blocks, and for `{% embed %}`. Without the namespace this is impossible: a theme's `partials/metadata.html.twig` shadows core's in Twig's main namespace, and `include 'partials/metadata.html.twig'` from inside that file would include itself.

> [!NOTE]
> `@grav` only ever points at `system/templates`. Plugin templates are added to the main namespace by each plugin and are reached the usual way.

## Checking what you override

To see which core templates a theme replaces, compare the two folders:

```bash
cd user/themes/mytheme/templates
for f in $(cd ../../../../system/templates && find . -name '*.twig'); do
  [ -f "$f" ] && echo "overrides $f"
done
```

If an override turns out to be a copy with a line or two added, switch it to an `@grav` include and keep only the additions.
