---
title: Flex Directory
page-toc:
  active: true
taxonomy:
  category: docs
---
# Flex Directory

## getTitle()

`getTitle(): string` Get title of the directory

Returns:
- `string` Title

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

<h2>{{ directory.title|e }}</h2>
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var string $title */
    $title = $directory->getTitle();

}
[/codesh]
[/codesh-group]

## getDescription()

`getDescription(): string` Get description of directory

Returns:
- `string` Description

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

<p>{{ directory.description|e }}</p>
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexDirectoryInterface|null $directory */
$directory = Grav::instance()->get('flex')->getDirectory('contacts');
if ($directory) {

    /** @var string $title */
    $description = $directory->getDescription();

}
[/codesh]
[/codesh-group]

## getObject()

`getObject( id ): Object | null` Get an object, returns null if it was not found.

Parameters:
- **id** ID of the object (`string`)

Returns:
- **[Object](/17/advanced/flex/using/object)** (`object`)
- `null` Object not found

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

{% set contact = directory.object('ki2ts4cbivggmtlj') %}

{# Do something #}
{% if contact %}
  {# Got Bruce Day #}
  Email for {{ contact.first_name|e }} {{ contact.last_name|e }} is {{ contact.email|e }}
{% else %}
  Oops, contact has been removed!
{% endif %}
[/codesh]
[codesh=php title="PHP"]
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
[/codesh]
[/codesh-group]

> [!NOTE]
> Check what you can do with **[Flex Object](/17/advanced/flex/using/object)**

## getCollection()

`getCollection(): Collection` Get collection, returns null if it was not found.

Returns:
- **[Collection](/17/advanced/flex/using/collection)** (`object`)

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

{% set contacts = directory.collection() %}

{# Do something #}
<h2>Ten first contacts:</h2>
<ul>
  {% for contact in contacts.filterBy({published: true}).limit(0, 10) %}
    <li>{{ contact.first_name|e }} {{ contact.last_name|e }}</li>
  {% endfor %}
</ul>
[/codesh]
[codesh=php title="PHP"]
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
[/codesh]
[/codesh-group]

> [!NOTE]
> Check what you can do with **[Flex Collection](/17/advanced/flex/using/collection)**
