---
title: Flex Directory
page-toc:
  active: true
taxonomy:
  category: docs
---

## getTitle()

`getTitle(): string` Get title of the directory

Returns:
- `string` Title

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set directory = grav.get('flex').directory('contacts') %}

<h2>{{ directory.title|e }}</h2>
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var string $title */
    $title = $directory->getTitle();

}
```
[/ui-tab]
[/ui-tabs]

## getDescription()

`getDescription(): string` Get description of directory

Returns:
- `string` Description

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set directory = grav.get('flex').directory('contacts') %}

<p>{{ directory.description|e }}</p>
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var string $title */
    $description = $directory->getDescription();

}
```
[/ui-tab]
[/ui-tabs]

## getObject()

`getObject(id): Object|null` Get an object, returns null if it was not found.

Parameters:
- **id** ID of the object (`string`)

Returns:
- **Object** (`object`) or `null`

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set directory = grav.get('flex').directory('contacts') %}

{% set contact = directory.object('ki2ts4cbivggmtlj') %}

{# Do something #}
{% if contact %}
  {# Got Bruce Day #}
  Email for {{ contact.first_name|e }} {{ contact.last_name|e }} is {{ contact.email|e }}
{% else %}
  Oops, contact has been removed!
{% endif %}
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var FlexObjectInterface|null $object */
    $object = $directory->getObject('ki2ts4cbivggmtlj');
    if ($object) {
        // Object exists, do something with it...
    }

}
```
[/ui-tab]
[/ui-tabs]

!!! Check what you can do with **[Flex Object](/advanced/flex/using/object)**

## getCollection()

`getCollection(): Collection|null` Get collection, returns null if it was not found.

Returns:
- **Collection** (`object`) or `null`


[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set directory = grav.get('flex').directory('contacts') %}

{% set contacts = directory.collection() %}

{# Do something #}
<h2>Ten first contacts:</h2>
<ul>
  {% for contact in contacts.filterBy({published: true}).limit(0, 10) %}
    <li>{{ contact.first_name|e }} {{ contact.last_name|e }}</li>
  {% endfor %}
</ul>
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var FlexCollectionInterface $collection */
    $collection = $directory->getCollection();

    // Do something with the collection...

}
```
[/ui-tab]
[/ui-tabs]

!!! Check what you can do with **[Flex Collection](/advanced/flex/using/collection)**
