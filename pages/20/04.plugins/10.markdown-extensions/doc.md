---
title: Markdown Extensions
taxonomy:
    category: docs
---
# Extending Markdown

Grav renders Markdown through a fork of [Parsedown](https://parsedown.org/) and Parsedown Extra, wrapped by Grav's own extension layer. A plugin can teach that parser **new block and inline syntax** — alerts, shortcode-like blocks, custom inline marks, and so on.

Grav 2.0 adds a formal **Markdown Extension API** for this: a small registry, a set of handler interfaces, and a fluent `Element` builder. The older approach (assigning closures to the parser and calling `addBlockType()`/`addInlineType()`) still works unchanged, so existing plugins keep running — but new plugins should prefer the API described here.

## Overview

Every time Grav builds a Markdown parser for a page it fires the `onMarkdownInitialized` event. Your plugin listens for that event, wraps the parser in a `MarkdownExtensionRegistry`, and adds one or more **extensions**. Each extension registers **handlers** against a trigger character (a "marker"), and each handler returns parsed output as an element array — most easily produced with the `Element` builder.

The pieces, all under `Grav\Common\Markdown`:

[div class="table"]
| Class / interface | Role |
| --- | --- |
| `Extension\MarkdownExtensionInterface` | An extension: `getName()`, `isEnabled()`, `register()`. |
| `Extension\AbstractMarkdownExtension` | Base class — accepts a config in its constructor and defaults `isEnabled()` to `true`. |
| `Extension\MarkdownExtensionRegistry` | Wraps the parser; `add()` an extension, or `registerBlock()` / `registerInline()` directly. |
| `Extension\BlockHandlerInterface` | A block handler — `block()`. |
| `Extension\BlockContinuableInterface` | Optional — `blockContinue()` for multi-line blocks. |
| `Extension\BlockCompletableInterface` | Optional — `blockComplete()` to finalize a block. |
| `Extension\InlineHandlerInterface` | An inline handler — `inline()`. |
| `Element` | Fluent builder that compiles to a Parsedown element array. |
| `BlockResult` | Optional helper that wraps an element plus block state. |
[/div]

## The `onMarkdownInitialized` event

This event fires once per parser, with the parser instance and the current page:

[codesh=php]
public static function getSubscribedEvents(): array
{
    return [
        'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
    ];
}

public function onMarkdownInitialized(\RocketTheme\Toolbox\Event\Event $event): void
{
    $markdown = $event['markdown'];   // the Parsedown instance
    $page     = $event['page'];       // the PageInterface being rendered

    $registry = new \Grav\Common\Markdown\Extension\MarkdownExtensionRegistry($markdown, $page);
    $registry->add(new \Grav\Plugin\MyMarkdown\CiteExtension($this->config->get('plugins.my-plugin')));
}
[/codesh]

> [!NOTE]
> Because the event carries the `page`, an extension can vary its behaviour per page — for example reading a flag from the page's front matter before deciding whether to register.

## Building an extension

### 1. The extension class

Extend `AbstractMarkdownExtension` and implement one or more handler interfaces. `getName()` returns a short identifier; `isEnabled()` lets you switch the whole extension off (it defaults to `true`); `register()` is where you attach handlers to the registry.

[codesh=php]
use Grav\Common\Markdown\Element;
use Grav\Common\Markdown\Extension\AbstractMarkdownExtension;
use Grav\Common\Markdown\Extension\InlineHandlerInterface;
use Grav\Common\Markdown\Extension\MarkdownExtensionRegistry;

class CiteExtension extends AbstractMarkdownExtension implements InlineHandlerInterface
{
    public function getName(): string
    {
        return 'cite';
    }

    public function register(MarkdownExtensionRegistry $r): void
    {
        // tag (StudlyCase logical name), marker (trigger character), handler
        $r->registerInline('Cite', '@', $this);
    }

    public function inline(array $excerpt): ?array
    {
        // Match @@text@@ and emit <cite>text</cite>
        if (preg_match('/^@@(?=\S)(.+?)@@/', $excerpt['text'], $m)) {
            return [
                'extent'  => strlen($m[0]),                          // characters consumed
                'element' => Element::create('cite')->setInlineText($m[1])->toArray(),
            ];
        }

        return null; // decline — let other handlers try
    }
}
[/codesh]

That single extension turns `a @@b c@@ d` into `<p>a <cite>b c</cite> d</p>`.

### 2. Register block or inline handlers

The registry maps your handler onto Parsedown's dispatch by **marker** — the first character that can trigger your syntax.

[div class="table"]
| Method | Purpose | Options |
| --- | --- | --- |
| `registerInline($tag, $marker, $handler, $options)` | Inline syntax (runs inside a line). | `index` |
| `registerBlock($tag, $marker, $handler, $options)` | Block syntax (a whole line/region). | `continuable`, `completable`, `index` |
[/div]

- **`tag`** — a StudlyCase logical name (`'Cite'`, `'Note'`). It only needs to be unique per parser.
- **`marker`** — the trigger character (`'@'`, `'>'`). For a block, an empty string `''` registers an *unmarked* block that is tried on every line.
- **`index`** — where your handler sits in the list for that marker (lower runs first). Use `['index' => 0]` to take priority.
- **`continuable` / `completable`** — set these (or just implement `BlockContinuableInterface` / `BlockCompletableInterface`) for multi-line blocks.

The handler methods receive Parsedown's working arrays and return element arrays:

[div class="table"]
| Method | Receives | Returns |
| --- | --- | --- |
| `inline(array $excerpt)` | `text` (from the marker on) and `context` (the whole line) | `['extent' => int, 'element' => array]`, or `null` to decline |
| `block(array $line, ?array $block)` | `line` (`body`, `indent`, `text`) and the open block, if any | a block array `['element' => [...], ...state]`, or `null` |
| `blockContinue(array $line, array $block)` | the next line and the current block | the mutated block to keep it open, or `null` to close it |
| `blockComplete(array $block)` | the finished block | the finalized block |
[/div]

### 3. Build elements with the `Element` builder

Parsedown represents output as nested arrays. The `Element` builder produces those arrays without you having to remember the exact keys, and chooses the right "handler" for the content type:

[codesh=php]
use Grav\Common\Markdown\Element;

// <span class="badge">New</span>  (text parsed as inline markdown)
Element::span()->addClass('badge')->setInlineText('New')->toArray();

// <div class="note"> ...child block lines parsed as markdown... </div>
Element::div()->addClass('note')->setRawLines(['line one', 'line two'])->toArray();

// arbitrary element with attributes
Element::create('figure')->attr('id', 'fig-1')->setChildren([$child])->toArray();
[/codesh]

[div class="table"]
| Method | Content treatment |
| --- | --- |
| `setInlineText(string)` | Parsed as **inline** markdown (Parsedown `line` handler). |
| `setRawLines(array)` | Each string parsed as a **block** (Parsedown `lines` handler). |
| `setChildren(array)` | Child `Element`s / arrays rendered in order (`elements` handler). |
| `setListItems(array)` | Each string becomes a list item (`li` handler). |
| `setText(string)` | Escaped literal text — no markdown, no HTML. |
| `setRawHtml(string, $allowInSafeMode=false)` | Verbatim HTML (use with care). |
| `attr(name, value)` / `attributes([...])` / `addClass(...)` | Set attributes / classes. |
| `setNonNestables(array)` | Inline types that must not nest inside this element. |
| `toArray()` | Compile to the final Parsedown element array. |
[/div]

### 4. Wire it into a plugin

Put it together in a normal Grav plugin. The plugin subscribes to `onMarkdownInitialized`, creates a registry, and adds the extension:

[codesh=php]
<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Markdown\Extension\MarkdownExtensionRegistry;
use Grav\Plugin\MyMarkdown\CiteExtension;
use RocketTheme\Toolbox\Event\Event;

class MyMarkdownPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized'  => ['onPluginsInitialized', 0],
            'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
        ];
    }

    public function onPluginsInitialized(): void
    {
        /** @var ClassLoader $loader */
        $loader = $this->grav['loader'];
        $loader->addPsr4('Grav\\Plugin\\MyMarkdown\\', __DIR__ . '/classes', true);
    }

    public function onMarkdownInitialized(Event $event): void
    {
        $registry = new MarkdownExtensionRegistry($event['markdown'], $event['page']);
        $registry->add(new CiteExtension($this->config->get('plugins.my-markdown')));
    }
}
[/codesh]

That is all that is required — `@@…@@` now renders everywhere Grav renders Markdown, and you can disable it from the plugin's own configuration by returning `false` from the extension's `isEnabled()`.

## Example: a multi-line block

A *continuable* block reads more than one line. Register it as continuable, then implement `blockContinue()` to keep absorbing lines until the block ends. Here a `@note` line opens a `<div class="note">` whose following lines are its content:

[codesh=php]
use Grav\Common\Markdown\BlockResult;
use Grav\Common\Markdown\Element;
use Grav\Common\Markdown\Extension\AbstractMarkdownExtension;
use Grav\Common\Markdown\Extension\BlockHandlerInterface;
use Grav\Common\Markdown\Extension\BlockContinuableInterface;
use Grav\Common\Markdown\Extension\MarkdownExtensionRegistry;

class NoteExtension extends AbstractMarkdownExtension implements BlockHandlerInterface, BlockContinuableInterface
{
    public function getName(): string
    {
        return 'note';
    }

    public function register(MarkdownExtensionRegistry $r): void
    {
        $r->registerBlock('Note', '@', $this, ['index' => 0]);
    }

    public function block(array $line, ?array $block = null): ?array
    {
        if (preg_match('/^@note\s*$/', $line['text'])) {
            // BlockResult pairs the element with extra block state ('note' here)
            return BlockResult::fromElement(Element::div()->addClass('note')->setRawLines([]))
                ->set('note', true)
                ->toArray();
        }

        return null;
    }

    public function blockContinue(array $line, array $block): ?array
    {
        if (isset($block['interrupted']) || empty($block['note'])) {
            return null; // a blank line (or a foreign block) closes the note
        }

        $block['element']['text'][] = $line['body']; // append the raw line
        return $block;
    }
}
[/codesh]

Input:

[codesh=markdown]
@note
hello **world**
second line
[/codesh]

renders a `<div class="note">` containing the two content lines, with `**world**` parsed as inline markdown inside.

## Legacy approach (still supported)

Before the API, plugins extended the parser by assigning a closure to a dynamically-named method and registering the marker by hand. This **still works** and is fully backward compatible — closures take priority over the new handler routing, so existing plugins are never shadowed:

[codesh=php]
$markdown = $event['markdown'];

$markdown->blockLegacy = function ($line) {
    if (preg_match('/^%legacy\s*$/', $line['text'])) {
        return [
            'legacy'  => true,
            'element' => ['name' => 'div', 'handler' => 'lines', 'attributes' => ['class' => 'legacy'], 'text' => []],
        ];
    }
    return null;
};
$markdown->blockLegacyContinue = function ($line, array $block) {
    if (isset($block['interrupted']) || empty($block['legacy'])) {
        return null;
    }
    $block['element']['text'][] = $line['body'];
    return $block;
};

// addBlockType($marker, $tag, $continuable, $completable, $index)
$markdown->addBlockType('%', 'Legacy', true, false, 0);
[/codesh]

The new API does the same thing more safely (typed handler objects instead of magic method names, and the `Element` builder instead of hand-built arrays), but you are free to mix the two in one plugin.

> [!NOTE]
> Grav's own built-in GitHub Flavored Markdown features — [task lists, marks, autolinks, and the enhanced tables](../../content/markdown) — are part of core and are *not* registered through this API. This API is for the syntax your plugin adds on top.

## API reference

All classes live under the `Grav\Common\Markdown` namespace (handler interfaces under `Grav\Common\Markdown\Extension`).

[div class="table"]
| Member | Signature |
| --- | --- |
| `MarkdownExtensionInterface::getName()` | `: string` |
| `MarkdownExtensionInterface::isEnabled()` | `: bool` |
| `MarkdownExtensionInterface::register()` | `(MarkdownExtensionRegistry $registry): void` |
| `MarkdownExtensionRegistry::__construct()` | `($markdown, ?PageInterface $page = null)` |
| `MarkdownExtensionRegistry::add()` | `(MarkdownExtensionInterface $extension): void` |
| `MarkdownExtensionRegistry::registerBlock()` | `(string $tag, string $marker, object $handler, array $options = []): void` |
| `MarkdownExtensionRegistry::registerInline()` | `(string $tag, string $marker, object $handler, array $options = []): void` |
| `BlockHandlerInterface::block()` | `(array $line, ?array $block = null): ?array` |
| `BlockContinuableInterface::blockContinue()` | `(array $line, array $block): ?array` |
| `BlockCompletableInterface::blockComplete()` | `(array $block): array` |
| `InlineHandlerInterface::inline()` | `(array $excerpt): ?array` |
[/div]
