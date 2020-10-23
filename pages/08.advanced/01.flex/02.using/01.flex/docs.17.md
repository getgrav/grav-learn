---
title: Flex
page-toc:
  active: true
taxonomy:
  category: docs
---

! **TIP:** Complete list of methods can be found from **Customizing Flex Objects** section.

## count()

`count(): int` Count the number of directories registered to Flex.

Returns:
- `int` count of **Directories**

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

Flex has {{ flex.count() }} enabled directories.
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var int $count */
$count = $flex->count();
```
[/ui-tab]
[/ui-tabs]

## getDirectories()

`getDirectories( [names] ): array` Get list of directories.

Parameters:
- **names** Optional: List of directory names (`array`)

Returns:
- `array` list of **Directories**

! **TIP:** If no list of names was provided, method returns all directories registered to Flex.

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

{# Get all directories #}
{% set directories = flex.directories() %}

{# Get listed directories #}
{% set listed_directories = flex.directories(['contacts', 'phonebook']) %}

{# Do something with the directories #}
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var FlexDirectoryInterface[] $directories */
$directories = $flex->getDirectiories();
// = ['contacts' => FlexDirectory, ...]

/** @var FlexDirectoryInterface[] $directories */
$listedDirectories = $flex->getDirectiories(['contacts', 'phonebook']);
// = ['contacts' => FlexDirectory]

/** @var array<FlexDirectoryInterface|null> $directories */
$listedDirectoriesWithMissing = $flex->getDirectiories(['contacts', 'phonebook'], true);
// = ['contacts' => FlexDirectory, 'phonebook' => null]
```
[/ui-tab]
[/ui-tabs]

! **TIP:** You may want to make sure you return only the directories you want to.

## hasDirectory()

`hasDirectory(name): bool`: Check if directory exists.

Parameters:
- **name** Name of the directory (`string`)

Returns:
- `bool` True if found, false otherwise

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

Flex has {{ not flex.hasDirectory('contacts') ? 'not' }} contacts directory.
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var bool $exists */
$exists = $flex->hasDirectory('contacts');
```
[/ui-tab]
[/ui-tabs]

## getDirectory()

`getDirectory(name): Directory|null` Get a directory, returns null if it was not found.

Parameters:
- **name** Name of the directory (`string`)

Returns:
- **Directory** (`object`) or `null`

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

{# Get contacts directory (null if not found) #}
{% set directory = flex.directory('contacts') %}

{# Do something with the contacts directory #}
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var FlexDirectoryInterface|null $directory */
$directory = $flex->getDirectory('contacts');
if ($directory) {
    // Directory exists, do something with it...
}
```
[/ui-tab]
[/ui-tabs]

!!! Check what you can do with **[Flex Directory](/advanced/flex/using/directory)**

## getObject()

`getObject(id, directory): Object|null` Get an object, returns null if it was not found.

Parameters:
- **id** ID of the object (`string`)
- **directory** Name of the directory (`string`)

Returns:
- **Object** (`object`) or `null`

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

{% set contact = flex.object('ki2ts4cbivggmtlj', 'contacts') %}

{# Do something #}
{% if contact %}
  {# Got Bruce Day #}
  {{ contact.first_name|e }} {{ contact.last_name|e }} has a website: {{ contact.websize|e }}
{% else %}
  Oops, contact has been removed!
{% endif %}
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var FlexObjectInterface|null $object */
$object = $flex->getObject('ki2ts4cbivggmtlj', 'contacts');
if ($object) {
    // Object exists, do something with it...
}
```
[/ui-tab]
[/ui-tabs]

!!! Check what you can do with **[Flex Object](/advanced/flex/using/object)**

## getCollection()

`getCollection(directory): Collection|null` Get collection, returns null if it was not found.

Parameters:
- `directory` Name of the directory (`string`)

Returns:
- **Collection** (`object`) or `null`

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set flex = grav.get('flex') %}

{% set contacts = flex.collection('contacts') %}

{# Do something #}
<h2>Ten random contacts:</h2>
<ul>
  {% for contact in contacts.filterBy({published: true}).shuffle().limit(0, 10) %}
    <li>{{ contact.first_name|e }} {{ contact.last_name|e }}</li>
  {% endfor %}
</ul>
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var FlexCollectionInterface|null $collection */
$collection = $flex->getCollection('contacts');
if ($collection) {
    // Collection exists, do something with it...
}
```
[/ui-tab]
[/ui-tabs]

!!! Check what you can do with **[Flex Collection](/advanced/flex/using/collection)**
