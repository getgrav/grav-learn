---
title: Creating a Shortcode
description: A practical "Twig before, shortcode after" walkthrough that moves repeatable logic out of page content and into a small, safe shortcode.
page-toc:
  active: true
taxonomy:
    category: docs
---

# Creating a Shortcode

Since Grav 2.0 sandboxes [Twig in page content](../twig-in-content), the recommended way to give authors repeatable, dynamic snippets is a **shortcode** rather than raw Twig. A shortcode is a short, readable tag like `[team folder="/team" /]` that an author drops into any page. All the logic lives in your plugin's PHP and trusted templates, so nothing runs inside the content sandbox.

===

This page walks through replacing a piece of in-content Twig with an equivalent shortcode, using the [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) plugin. Install **Shortcode Core** first:

```bash
bin/gpm install shortcode-core
```

## The Problem: Twig in Content

Say you want a page to list everyone under a `/team` folder. Before, you might have enabled Twig in content and written this directly in the page body:

```twig
{% set staff = page.collection({'items': {'@page.children': '/team'}}) %}
<div class="team">
{% for person in staff %}
  <div class="member">
    <h3>{{ person.title }}</h3>
    {{ person.summary|raw }}
  </div>
{% endfor %}
</div>
```

This works only if Twig in content is enabled, it exposes template logic to anyone editing the page, and every author who needs the list has to copy the snippet correctly. It is exactly the kind of thing the sandbox is designed to discourage.

## The Solution: A `[team]` Shortcode

With a shortcode, the author writes one line:

```
[team folder="/team" /]
```

The logic moves into a small plugin. Here is the whole thing.

### 1. Plugin blueprint

`user/plugins/team-shortcode/blueprints.yaml` declares the plugin and its dependency on Shortcode Core:

```yaml
name: Team Shortcode
slug: team-shortcode
type: plugin
version: 1.0.0
description: Adds a [team] shortcode that lists pages under a folder.
icon: users
author:
  name: Your Name
dependencies:
  - { name: grav, version: '>=2.0.0' }
  - { name: shortcode-core }
```

### 2. Plugin class

`user/plugins/team-shortcode/team-shortcode.php` subscribes to the `onShortcodeHandlers` event and registers every shortcode in the plugin's `shortcodes/` folder. It also adds the plugin's `templates/` folder to Twig so the shortcode can render a trusted template:

```php
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class TeamShortcodePlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ]);
    }

    public function onShortcodeHandlers(): void
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

    public function onTwigTemplatePaths(): void
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }
}
```

### 3. The shortcode

`user/plugins/team-shortcode/shortcodes/TeamShortcode.php` does the work. It reads the `folder` parameter, builds the collection in PHP, then hands the data to a trusted Twig template:

```php
<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TeamShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('team', function (ShortcodeInterface $sc) {
            $folder = $sc->getParameter('folder', '/');

            $root = $this->grav['pages']->find($folder);
            $members = $root ? $root->children()->published() : [];

            return $this->twig->processTemplate('shortcodes/team.html.twig', [
                'members' => $members,
            ]);
        });
    }
}
```

!! The class name (`TeamShortcode`) must match the file name. Shortcodes extend the base `Shortcode` class provided by Shortcode Core, which gives you `$this->grav`, `$this->twig`, and the `$this->shortcode` manager.

### 4. The template

`user/plugins/team-shortcode/templates/shortcodes/team.html.twig` holds the markup. This is a **trusted template file on disk**, so it is never sandboxed, and it is the right home for display logic:

```twig
<div class="team">
{% for person in members %}
  <div class="member">
    <h3>{{ person.title }}</h3>
    {{ person.summary|raw }}
  </div>
{% endfor %}
</div>
```

That's the entire migration. The page body goes back to one readable line, the Twig lives in a file you control, and Twig in content can stay disabled.

## Shortcode Anatomy

A shortcode handler receives a shortcode object with everything it needs:

* `$sc->getParameter('name', $default)` reads an attribute, for example the `folder="/team"` above.
* `$sc->getContent()` returns the text wrapped by a paired shortcode, for example `[red]wrapped text[/red]`.
* `$sc->getName()` returns the shortcode's name.

Shortcodes come in two forms:

* **Self-closing**, like `[team folder="/team" /]`, for tags that generate their own output.
* **Paired**, like `[red]...[/red]`, which wrap content. A minimal paired example:

```php
$this->shortcode->getHandlers()->add('red', function (ShortcodeInterface $sc) {
    return '<span style="color:red;">' . $sc->getContent() . '</span>';
});
```

By default handlers run **after** Markdown is processed, so a shortcode can wrap Markdown content. If you need to run **before** Markdown (for example to protect a code block from being parsed), register with `getRawHandlers()` instead of `getHandlers()`.

## Next Steps

* The [Shortcode Core README](https://github.com/getgrav/grav-plugin-shortcode-core) documents assets, the `bin/plugin shortcode-core display` CLI command, and advanced raw handlers.
* The [Shortcode UI](https://github.com/getgrav/grav-plugin-shortcode-ui) plugin is a good reference for Twig-driven shortcodes with richer markup.
* If you still need Twig directly in a page, see [Twig in Content](../twig-in-content) for how to enable it and customize the sandbox.
