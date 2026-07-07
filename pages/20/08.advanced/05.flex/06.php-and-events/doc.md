---
title: Extending Flex in PHP
taxonomy:
    category: docs
process:
    twig: false
---

Blueprints get you a very long way, but every Flex Type eventually meets a job that YAML alone cannot express: a computed property, a directory that ships from a plugin, a custom frontend route, or a side effect that should fire whenever an object is saved. That is where PHP comes in.

This page walks through the five extension points you are most likely to reach for:

1. Subclassing the object, collection, and index classes and wiring them into your blueprint.
2. Registering a directory type from a plugin with the `FlexRegisterEvent`.
3. Hooking the frontend routing event, `flex.router.{name}`.
4. The event contract for saves and deletes.
5. The `convert-data` CLI command.

Everything below is part of the core framework (`Grav\Framework\Flex` and `Grav\Common\Flex`) or the flex-objects plugin, so it is available to any plugin or theme.

## Custom object, collection, and index classes

Every Flex Type is backed by three classes:

[div class="table-keycol"]

| Class          | Role                                                                                     |
| :------------- | :--------------------------------------------------------------------------------------- |
| **Object**     | A single item. This is where per-item logic and computed properties live.                |
| **Collection** | A set of loaded objects. This is where list-wide helpers (filtering, grouping) live.     |
| **Index**      | A lightweight, cached lookup of every key in the directory, used before objects are loaded. |

[/div]

If you do not name your own, Flex uses the generic defaults: `Grav\Common\Flex\Types\Generic\GenericObject`, `GenericCollection`, and `GenericIndex`. They work fine for plain data, but the moment you want a method of your own, you subclass the one you need and point your blueprint at it.

### Writing the class

A minimal object subclass adds a method and nothing else. Because a Flex object is a normal PHP object, any public method you add is immediately callable from Twig.

[codesh=php]
<?php
namespace Grav\Plugin\MyPlugin\Flex\Types\Product;

use Grav\Common\Flex\Types\Generic\GenericObject;

class ProductObject extends GenericObject
{
    /**
     * Price with tax applied, ready for display.
     */
    public function getPriceWithTax(float $rate = 0.2): float
    {
        $price = (float) $this->getProperty('price');

        return round($price * (1 + $rate), 2);
    }
}
[/codesh]

`getProperty()` reads a value from the object's stored data, and you return whatever you like. You can override framework methods too (`getFormValue()`, `prepareStorage()`, `save()`), but start with plain helper methods, they cover most cases.

!!! Put your classes somewhere autoloadable. In a plugin, add a PSR-4 entry to the plugin's `composer.json` (then run `composer dump-autoload`), or register the namespace from the plugin's `autoload()` method. The class file above lives at `user/plugins/my-plugin/classes/Flex/Types/Product/ProductObject.php`.

### Wiring it into the blueprint

Point your blueprint's `config.data` at the classes you wrote. Any key you leave out falls back to the generic default, so it is fine to override only the object class.

[codesh=yaml]
title: Products
type: flex-objects

config:
    data:
        object: 'Grav\Plugin\MyPlugin\Flex\Types\Product\ProductObject'
        collection: 'Grav\Common\Flex\Types\Generic\GenericCollection'
        index: 'Grav\Common\Flex\Types\Generic\GenericIndex'
        storage:
            class: 'Grav\Framework\Flex\Storage\FolderStorage'
            options:
                folder: 'user-data://products'
                formatter:
                    class: 'Grav\Framework\File\Formatter\MarkdownFormatter'
[/codesh]

### Calling your method from Twig

Once the class is wired in, every object in the directory is an instance of `ProductObject`, so your method is available wherever you loop over a collection.

[codesh=twig]
{% set products = flex_objects('products') %}
{% for product in products %}
    <li>{{ product.title }} ({{ product.getPriceWithTax|number_format(2) }})</li>
{% endfor %}
[/codesh]

!!! A custom class only takes effect after the directory's cache is rebuilt. Run `bin/grav clear` after adding or changing `config.data` classes so Flex picks up the new object type.

## Registering a directory type from a plugin

Most directories are activated in Admin Next by enabling a blueprint file, which appends its path to the plugin config. A plugin can register a directory itself instead, so the type exists as soon as the plugin is active, with no manual step for the site owner.

The framework fires `Grav\Events\FlexRegisterEvent` the first time `$grav['flex']` is accessed. The event carries the `Flex` instance on its `flex` property. Subscribe to it, then call `addDirectoryType()` with a type name and a blueprint path.

[codesh=php]
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Events\FlexRegisterEvent;

class MyPluginPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            FlexRegisterEvent::class => [
                ['onRegisterFlex', 0],
            ],
        ];
    }

    public function onRegisterFlex(FlexRegisterEvent $event): void
    {
        $flex = $event->flex;

        $flex->addDirectoryType(
            'products',
            'plugin://my-plugin/blueprints/flex-objects/products.yaml'
        );
    }
}
[/codesh]

The first argument is the type name (the key you pass to `flex_objects('products')` and use in REST routes). The second is a stream path to the blueprint. `addDirectoryType()` also accepts an optional third `array $config` argument that is merged over the blueprint's own config, useful for overriding storage paths per environment.

This is exactly how the plugin registers user-enabled directories: in `flex-objects.php`, `onRegisterFlex()` reads the configured directory list and hands each blueprint to `registerDirectories()`, which calls `addDirectoryType()` for every type that is not already enabled.

!!! `FlexRegisterEvent` fires only once, on first access to Flex. Register your type there rather than in `onPluginsInitialized`, otherwise the directory may already be built by the time your code runs.

## Frontend routing with `flex.router.{name}`

The flex-objects page type lets a page act as a front controller for a directory (see [Frontend Display](/20/advanced/flex/frontend)). The mechanism behind it is a dynamically named event.

When a page whose header contains a `flex` block with a `router` value is resolved, the plugin's `onPagesInitialized` handler builds a routing event and fires `flex.router.{router}`, where `{router}` is the string from the header. This lets any plugin own a named router without patching the core.

[codesh=yaml]
# In a page's frontmatter
flex:
    directory: products
    router: default
[/codesh]

The event passed to `flex.router.default` carries everything a router needs: `flex`, the `directory`, the owning `page` (also as `parent`), the `base` route, the remaining `path`, the `route` object, the parsed `options`, the incoming `request`, and a by-reference `response`.

[codesh=php]
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class MyRouterPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'flex.router.default' => [
                ['onFlexRouterDefault', 0],
            ],
        ];
    }

    public function onFlexRouterDefault(Event $event): Event
    {
        $directory = $event['directory'];
        $path      = $event['path']; // remaining URL segments after the base page

        // Look up an object by the path and render it directly.
        $object = $path ? $directory->getObject($path) : null;
        if ($object) {
            // $object->render($layout) returns the object's rendered HTML.
            $html = (string) $object->render('default');
            $event['response'] = new \Grav\Framework\Psr7\Response(200, [], $html);
        }

        return $event;
    }
}
[/codesh]

Two things the plugin does with what you return: if you set the by-reference `response` to a PSR-7 response, Grav sends it immediately and stops. Otherwise, if you set `page` on the event, Grav swaps that page in as the active page and stops further routing. Set neither and the normal not-found handling continues.

!!! The plugin ships a `default` router for the flex-objects page type, so most sites never write one. Reach for a custom `flex.router.{name}` only when you need routing behavior the built-in router does not provide.

## The save and delete event contract

There are two families of write events, and knowing which is which saves a lot of confusion.

### Core object events (always fire)

`Grav\Framework\Flex\FlexObject::save()` calls `triggerEvent('onBeforeSave')` before writing and `triggerEvent('onAfterSave')` after. `delete()` does the same with `onBeforeDelete` and `onAfterDelete`. These are mapped to the public Grav event names:

[div class="table-keycol"]

| Internal trigger  | Grav event                  | Fires                        |
| :---------------- | :-------------------------- | :--------------------------- |
| `onBeforeSave`    | `onFlexObjectBeforeSave`    | before the object is written |
| `onAfterSave`     | `onFlexObjectAfterSave`     | after the object is written  |
| `onBeforeDelete`  | `onFlexObjectBeforeDelete`  | before the object is removed |
| `onAfterDelete`   | `onFlexObjectAfterDelete`   | after the object is removed  |

[/div]

These fire on every save and delete regardless of where the write came from (admin, REST API, or your own PHP), which makes `onFlexObjectAfterSave` the right place for side effects like clearing a cache or sending a notification.

[codesh=php]
<?php
public function onFlexObjectAfterSave(Event $event): void
{
    // Only react to one directory.
    $object = $event['object'];
    if ($object->getFlexType() !== 'products') {
        return;
    }

    // ... reindex, notify, invalidate a cache, etc.
}
[/codesh]

### Admin compatibility events (opt-out)

For backward compatibility with plugins written against the classic data flow, the Pages and Users Flex types also fire the generic `onAdminSave` and `onAdminAfterSave` events on save. Each carries an event with `type` set to `flex`, the `directory`, and the `object`. These fire only on the admin site, and only when the directory's `object.compat.events` config is left at its default of `true`.

If a directory does not need that legacy bridge (or an old plugin is misbehaving on your Flex objects), turn it off in the blueprint:

[codesh=yaml]
config:
    object:
        compat:
            events: false
[/codesh]

!!! During `onAdminSave` you must not replace the object with a different instance. The core throws a `RuntimeException` if the object is switched out, because downstream save logic still holds the original. Modify the object in place instead.

## Converting stored data with the CLI

The plugin ships one CLI command for data maintenance: `convert-data`, which rewrites a data file from one format to another (JSON and YAML).

[codesh=bash]
bin/plugin flex-objects convert-data --in user/data/products.json --out yaml
[/codesh]

The `--in` (`-i`) option is the path to the source file, and `--out` (`-o`) is the target format. It is handy when you change a directory's storage formatter and need to migrate an existing SimpleStorage file to match.

## Where to go next

- [Storage & Configuration](/20/advanced/flex/custom-types/blueprint-reference#config-data) for the `config.data` block these classes plug into.
- [Permissions](/20/advanced/flex/custom-types/blueprint-reference#permissions) before you expose a plugin-registered directory over the REST API.
- [Frontend Display](/20/advanced/flex/frontend) for the page type that the routing event powers.
