---
title: Theming
taxonomy:
    category: docs
description: The design token chain, giving the forum your accent colour, dark mode detection, template overrides, icons, accessibility and SEO.
---

# Theming

Forum Pro is **theme-agnostic by design**. Every colour, radius, font and shadow resolves through a chain of custom properties, so a theme that publishes design tokens gets a forum that looks native to the site with no forum-specific work at all.

## The token chain

```
--forum-*  (site override)  →  --grav-*  (theme design system)  →  --theme-accent  →  neutral fallback
```

Read it left to right: a `--forum-*` property you set yourself always wins; failing that the theme's `--grav-*` token is used; failing that the theme's accent colour; failing that an accessible neutral default.

In practice this means:

- **Themes that publish `--grav-*` design tokens** get matching typography, cards, buttons, chips and labels automatically. Nothing to configure.
- **Themes that do not** get contrast-checked neutral styling in both light and dark schemes. It looks deliberate, not broken.
- **Anything you want to tune independently** is one `--forum-*` custom property away.

## Giving the forum your accent

A theme or plugin that only wants the forum to match its brand colour publishes a single property:

```css
:root { --theme-accent: #8428df; }
```

That is the whole integration. No forum-specific knowledge required.

`--forum-accent` still wins over `--theme-accent`, so a site can override a theme's choice:

```css
:root { --forum-accent: #0ebcf3; }
```

With neither set, the forum uses its own blue.

### Text on the accent

Labels that sit **on** a filled accent (count badges, toasts, primary buttons) pick black or white automatically based on how light the accent resolves, so a pale brand colour does not end up carrying white text nobody can read. Pin the choice yourself if you would rather:

```css
:root {
  --forum-on-accent: #000;
  --forum-on-accent-2: #fff;
}
```

## Dark mode

A few surfaces need a solid, page-matching colour: dropdowns, popovers and dialogs. Forum Pro falls back to the `Canvas` system colour for those, which follows the used `color-scheme` rather than whatever mode a theme happens to be painting.

Themes that flip dark mode with any of the following are recognized and handled automatically:

- `data-theme="dark"`
- `data-bs-theme="dark"`
- a `dark` class on `<html>` or `<body>`

If your theme signals dark mode some other way, you have two options:

1. **Set `color-scheme` on the page.** Worth doing regardless, since it also fixes native form controls and scrollbars:

   ```css
   :root { color-scheme: dark; }
   ```

2. **Set the two base properties explicitly:**

   ```css
   :root {
     --forum-bg: #12141a;
     --forum-fg: #e6e9ef;
   }
   ```

## Icons

Every badge, state and action uses **inline Lucide SVGs** that inherit `currentColor`, so they recolour with the surrounding text in both schemes. There are no icon fonts to load and no emoji that render differently on every platform.

Sections and categories can each carry their own icon, chosen in **Admin → Forum → Structure**.

## Overriding templates

Forum Pro's Twig templates follow the normal Grav override rules. Copy the template you want to change from `user/plugins/forum-pro/templates/` into your theme's `templates/` directory and edit it there. Your copy wins.

The main templates are:

| Template | Renders |
|---|---|
| `forum-index.html.twig` | The forum index |
| `forum-category.html.twig` | A category |
| `forum-topiclist.html.twig` | Recent, unread, unanswered and other listing modes |
| `forum-topic.html.twig` | A topic |
| `forum-profile.html.twig` | A member profile |
| `forum-members.html.twig` | The member directory |
| `forum-search.html.twig` | Search |
| `forum-queue.html.twig` | The moderator review queue |
| `forum-pm-inbox.html.twig` / `forum-pm-thread.html.twig` | Private messages |
| `forum-notifications.html.twig` | Notifications |
| `forum-settings.html.twig` | Member settings |
| `forum-login.html.twig` / `forum-register.html.twig` / `forum-reset.html.twig` | Account flows |

> [!NOTE]
> Overriding a template means you own it. Take the smallest override that does the job, because a full copy will drift from the plugin as it is updated.

Prefer custom properties over template overrides wherever you can. Most visual changes people reach for a template override to make are a `--forum-*` property away.

## Extending post rendering

Every body the forum renders goes through one Markdown parser and then a sanitizer: posts, private messages, signatures, announcements and the excerpt in a notification email. Two hooks let a plugin take part.

**`onMarkdownInitialized`** is Grav's own event and fires when the forum's parser is built, so a plugin can register block or inline handlers exactly as it would for page content. Forum bodies pass a `page` of `null`.

**`onForumProRenderBody`** is Forum Pro's event. It fires after the parse and before the sanitizer with three values:

| Key | Contains |
|---|---|
| `markdown` | The source, as the member wrote it. Read it; changing it here has no effect. |
| `html` | The parsed body. Replace it and the replacement is what gets sanitized and stored. |
| `context` | What is being rendered: `kind` (`post`, `message`, `signature`, `announcement` or `email_excerpt`) plus the ids the caller knows (`post_id`, `topic_id`, `category_id`, `user_id`, `message_id`, `announcement_id`). Imports add `import: xenforo` or `discourse`. |

The sanitizer still runs on whatever a listener returns, so its allowlist holds: paragraphs, lists, headings, tables, code, links and images survive; custom classes, inline styles and scripts do not. A listener can reshape a post but never smuggle markup past the forum.

A plugin that turns a `Key: Value` block at the top of a post into a table:

```php
public static function getSubscribedEvents(): array
{
    return ['onForumProRenderBody' => ['onForumProRenderBody', 0]];
}

public function onForumProRenderBody(Event $event): void
{
    if (($event['context']['kind'] ?? '') !== 'post') {
        return;
    }

    $event['html'] = preg_replace_callback(
        '~<pre><code>((?:[A-Z][\w ]+: .*\n?)+)</code></pre>~',
        static function (array $m): string {
            $rows = '';
            foreach (explode("\n", trim($m[1])) as $line) {
                [$key, $value] = array_pad(explode(':', $line, 2), 2, '');
                $rows .= '<tr><th>' . htmlspecialchars(trim($key)) . '</th><td>' . htmlspecialchars(trim($value)) . '</td></tr>';
            }

            return '<table>' . $rows . '</table>';
        },
        $event['html']
    );
}
```

Rendered HTML is stored with each post, so a new listener applies to posts written from then on. Run [`rerender`](../cli#rerender) to apply it to the existing ones, then `reindex` so search sees the same text.

## Accessibility

- **Focus moves to new content** after in-page navigation and after live inserts, so screen readers announce where the reader landed instead of leaving them stranded at the top of a stale page.
- **Icon-only buttons** carry accessible names.
- **The editor, its toolbar and the live-update bar** are labelled and announced.
- Colour choices are **contrast-checked** in both light and dark schemes when the theme does not supply its own.

## SEO

- **Server-rendered.** The whole forum works with JavaScript off. Live updates and the editor are progressive enhancements, so a crawler sees complete content.
- **Canonical URLs.** Topic addresses canonicalize by id. A slug mismatch, a stale category in the path, or a renamed category all **301 to the correct address**, so links never rot and search engines only ever index one URL per topic.
- **Per-page browser titles** that follow in-page navigation.
- **Breadcrumb trails** back to the forum root on every page.
- **`noindex`** on provisional and hidden profiles, which keeps spam-signup profiles out of the index.

## Translations

All visitor-facing text is translatable through the plugin's `languages/` directory, following the standard Grav translation mechanism. See [Multi-Language](/17/content/multi-language) for how Grav resolves language files.
