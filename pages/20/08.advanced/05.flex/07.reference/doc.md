---
title: Twig & PHP Reference
page-toc:
  active: true
taxonomy:
  category: docs
process:
  twig: false
---

# Twig & PHP Reference

Once a Flex Type is registered you interact with its data at runtime through four objects: the **Flex** service, a **Directory**, a **Collection**, and an **Object**. The same methods are available from both Twig and PHP, so a template and a plugin class read almost identically. This page is the method reference for all four.

The entry point is always the Flex service, registered in the Grav container under the `flex` key. In Twig you reach it with `grav.get('flex')`; in PHP with `Grav::instance()->get('flex')`. From there you request a directory by name, then a collection or a single object, then work with individual objects and their properties.

!!! Collection and object manipulation methods (`sort`, `filterBy`, `limit`, and friends) return **a modified copy**. The original instance is left untouched, so you can chain calls safely without mutating shared state.

## Flex

The **Flex** service is the top-level registry. It knows about every directory that has been enabled (see [Registering a Directory](/20/advanced/flex)) and hands you directories, collections, and objects by name.

### count()

`count(): int` Count the number of directories registered to Flex.

Returns:
- `int` Number of [directories](#directory)

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

Flex has {{ flex.count() }} enabled directories.
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var int $count */
$count = $flex->count();
[/codesh]
[/codesh-group]

### getDirectories()

`getDirectories( [names] ): array` Get a list of directories.

Parameters:
- **names** Optional: list of directory names (`array`)

Returns:
- `array` List of [directories](#directory)

!!! If no list of names is provided, the method returns every directory registered to Flex.

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

{# Get all directories #}
{% set directories = flex.directories() %}

{# Get listed directories #}
{% set listed_directories = flex.directories(['contacts', 'phonebook']) %}

{# Do something with the directories #}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var FlexDirectoryInterface[] $directories */
$directories = $flex->getDirectories();
// = ['contacts' => FlexDirectory, ...]

/** @var FlexDirectoryInterface[] $listedDirectories */
$listedDirectories = $flex->getDirectories(['contacts', 'phonebook']);
// = ['contacts' => FlexDirectory]

/** @var array<FlexDirectoryInterface|null> $listedDirectoriesWithMissing */
$listedDirectoriesWithMissing = $flex->getDirectories(['contacts', 'phonebook'], true);
// = ['contacts' => FlexDirectory, 'phonebook' => null]
[/codesh]
[/codesh-group]

### hasDirectory()

`hasDirectory( name ): bool` Check if a directory exists.

Parameters:
- **name** Name of the directory (`string`)

Returns:
- `bool` True if found, false otherwise

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

Flex has {{ not flex.hasDirectory('contacts') ? 'no' }} contacts directory.
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexInterface;

/** @var FlexInterface $flex */
$flex = Grav::instance()->get('flex');

/** @var bool $exists */
$exists = $flex->hasDirectory('contacts');
[/codesh]
[/codesh-group]

### getDirectory()

`getDirectory( name ): Directory | null` Get a directory, returns null if it was not found.

Parameters:
- **name** Name of the directory (`string`)

Returns:
- [Directory](#directory) (`object`)
- `null` Directory not found

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

{# Get contacts directory (null if not found) #}
{% set directory = flex.directory('contacts') %}

{# Do something with the contacts directory #}
[/codesh]
[codesh=php title="PHP"]
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
[/codesh]
[/codesh-group]

### getObject()

`getObject( id, directory ): Object | null` Get an object, returns null if it was not found.

Parameters:
- **id** ID of the object (`string`)
- **directory** Name of the directory (`string`)

Returns:
- [Object](#object) (`object`)
- `null` Object not found

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

{% set contact = flex.object('ki2ts4cbivggmtlj', 'contacts') %}

{# Do something #}
{% if contact %}
  {{ contact.first_name|e }} {{ contact.last_name|e }} has a website: {{ contact.website|e }}
{% else %}
  Oops, contact has been removed!
{% endif %}
[/codesh]
[codesh=php title="PHP"]
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
[/codesh]
[/codesh-group]

### getCollection()

`getCollection( directory ): Collection | null` Get a collection, returns null if it was not found.

Parameters:
- **directory** Name of the directory (`string`)

Returns:
- [Collection](#collection) (`object`)
- `null` Directory not found

[codesh-group]
[codesh=twig title="Twig"]
{% set flex = grav.get('flex') %}

{% set contacts = flex.collection('contacts') %}

<h2>Ten random contacts:</h2>
<ul>
  {% for contact in contacts.filterBy({published: true}).shuffle().limit(0, 10) %}
    <li>{{ contact.first_name|e }} {{ contact.last_name|e }}</li>
  {% endfor %}
</ul>
[/codesh]
[codesh=php title="PHP"]
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
[/codesh]
[/codesh-group]

## Directory

A **Flex Directory** represents one registered Flex Type. It carries the type's title and description, and it is where you request the type's collection or a single object by id.

### getTitle()

`getTitle(): string` Get the title of the directory.

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

### getDescription()

`getDescription(): string` Get the description of the directory.

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

    /** @var string $description */
    $description = $directory->getDescription();

}
[/codesh]
[/codesh-group]

### getObject()

`getObject( [id] ): Object | null` Get an object from the directory, returns null if it was not found. Called without an id it returns a new, empty object.

Parameters:
- **id** ID of the object (`string`)

Returns:
- [Object](#object) (`object`)
- `null` Object not found

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

{% set contact = directory.object('ki2ts4cbivggmtlj') %}

{# Do something #}
{% if contact %}
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

### getCollection()

`getCollection(): Collection` Get a collection of every object in the directory.

Returns:
- [Collection](#collection) (`object`)

[codesh-group]
[codesh=twig title="Twig"]
{% set directory = grav.get('flex').directory('contacts') %}

{% set contacts = directory.collection() %}

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

The directory also exposes a handful of introspection helpers you will occasionally reach for from PHP: `getFlexType()` (the directory name), `getObjectClass()` and `getCollectionClass()` (the classes configured under `config.data`), `getConfig()` (the resolved blueprint config), and `getBlueprint()` (the directory's blueprint). These are most useful when you are writing your own object or collection classes.

## Collection

A **Flex Collection** is an **ordered map of objects** that can also be used like a list. It provides methods to render output, fetch objects by key, and to sort, filter, group, and slice the set. Flex collections build on [Doctrine Collections](https://www.doctrine-project.org/projects/doctrine-collections/en/2.2/index.html), so the standard array-style helpers (`first()`, `last()`, `getKeys()`, `toArray()`, `isEmpty()`, `contains()`, and so on) are available too.

!!! Every method below returns **a modified copy** of the collection. The original is never changed, which makes long chains such as `collection.filterBy(...).sort(...).limit(...)` safe.

### render()

`render( [layout], [context] ): Block` Renders the collection.

Parameters:
- **layout** Layout name (`string`)
- **context** Extra variables that can be used inside the Twig template file (`array`)

Returns:
- **Block** (`object`) HtmlBlock instance containing the output

!!! In Twig, use the `{% render %}` tag rather than calling the method directly. The tag lets the collection's JS/CSS assets register properly.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}
{% set page = 2 %}
{% set limit = 10 %}
{% set start = (page - 1) * limit %}

<h2>Contacts:</h2>

{% render contacts.limit(start, limit) layout: 'cards' with { background: 'gray', color: 'white' } %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\ContentBlock\HtmlBlock;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

$page = 2;
$limit = 10;
$start = ($page - 1) * $limit;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->limit($start, $limit);

    /** @var HtmlBlock $block */
    $block = $collection->render('cards', ['background' => 'gray', 'color' => 'white']);

}
[/codesh]
[/codesh-group]

### sort()

`sort( orderings ): Collection` Sort the collection by a list of `property: direction` pairs.

Parameters:
- **orderings** Pairs of `property: direction`, where direction is either `ASC` or `DESC` (`array`)

Returns:
- [Collection](#collection) (`object`) New sorted instance

!!! A default sort order can be set for the frontend in the Flex Type blueprint.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.sort({last_name: 'ASC', first_name: 'ASC'}) %}

<div>Displaying all contacts in alphabetical order:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->sort(['last_name' => 'ASC', 'first_name' => 'ASC']);
    // Collection is now sorted by last name, then first name...

}
[/codesh]
[/codesh-group]

### limit()

`limit( start, limit ): Collection` Return a subset of the collection starting from `start` and including only `limit` objects.

Parameters:
- **start** Start index, starting from 0 (`int`)
- **limit** Maximum number of objects (`int`)

Returns:
- [Collection](#collection) (`object`) New filtered instance

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}
{% set page = 3 %}
{% set limit = 6 %}
{% set start = (page - 1) * limit %}

{% set contacts = contacts.limit(start, limit) %}

<div>Displaying page {{ page|e }}:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

$start = 0;
$limit = 6;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->limit($start, $limit);
    // Collection now contains only the objects on the current page...

}
[/codesh]
[/codesh-group]

### filterBy()

`filterBy( filters ): Collection` Filter the collection by a list of `property: value` pairs.

Parameters:
- **filters** Pairs of `property: value` used to filter the collection (`array`)

Returns:
- [Collection](#collection) (`object`) New filtered instance

!!! Default filtering can be set for the frontend in the Flex Type blueprint.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.filterBy({'published': true}) %}

<div>Displaying only published contacts:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->filterBy(['published' => true]);
    // Collection now contains only published objects...

}
[/codesh]
[/codesh-group]

### reverse()

`reverse(): Collection` Reverse the order of the objects in the collection.

Returns:
- [Collection](#collection) (`object`) New reversed instance

!!! If you are already using `sort()`, reverse the ordering there instead. It saves an extra step.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.reverse() %}

<div>Displaying contacts in reverse order:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->reverse();
    // Collection is now in reverse order...

}
[/codesh]
[/codesh-group]

### shuffle()

`shuffle(): Collection` Shuffle the objects into a random order.

Returns:
- [Collection](#collection) (`object`) New randomly ordered instance

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.shuffle().limit(0, 6) %}

<div>Displaying 6 random contacts:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->shuffle()->limit(0, 6);
    // Collection now contains 6 random contacts...

}
[/codesh]
[/codesh-group]

### select()

`select( keys ): Collection` Keep only the objects whose keys are in the given list.

Parameters:
- **keys** List of object keys to select (`array`)

Returns:
- [Collection](#collection) (`object`) New instance

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}
{% set selected = ['gizwsvkyo5xtms2s', 'gjmva53uoncdo4sb', 'mfzwwtcugv5hkocd', 'k5nfctkeoftwi4zu'] %}

{% set contacts = contacts.select(selected) %}

<div>Displaying 4 selected contacts:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

$selected = ['gizwsvkyo5xtms2s', 'gjmva53uoncdo4sb', 'mfzwwtcugv5hkocd', 'k5nfctkeoftwi4zu'];

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->select($selected);
    // Collection now contains the 4 selected contacts...

}
[/codesh]
[/codesh-group]

### unselect()

`unselect( keys ): Collection` Remove the objects whose keys are in the given list.

Parameters:
- **keys** List of object keys to remove (`array`)

Returns:
- [Collection](#collection) (`object`) New instance

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}
{% set ignore = ['gizwsvkyo5xtms2s', 'gjmva53uoncdo4sb', 'mfzwwtcugv5hkocd', 'k5nfctkeoftwi4zu'] %}

{% set contacts = contacts.unselect(ignore) %}

<div>Displaying all but 4 ignored contacts:</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

$ignore = ['gizwsvkyo5xtms2s', 'gjmva53uoncdo4sb', 'mfzwwtcugv5hkocd', 'k5nfctkeoftwi4zu'];

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->unselect($ignore);
    // Collection now contains all but the 4 ignored contacts...

}
[/codesh]
[/codesh-group]

### search()

`search( string, [properties], [options] ): Collection` Search the collection for a string.

Parameters:
- **string** Search string (`string`)
- **properties** Properties to search; if null (or not provided), the defaults are used (`array` or `null`)
- **options** Extra search options (`array`)
  - starts_with: `bool`
  - ends_with: `bool`
  - contains: `bool`
  - case_sensitive: `bool`

Returns:
- [Collection](#collection) (`object`) New filtered instance

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.search('Jack', ['first_name', 'last_name', 'email'], {'contains': true}) %}

<div>Displaying all search results for 'Jack':</div>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->search('Jack', ['first_name', 'last_name', 'email'], ['contains' => true]);
    // Collection now contains all matching results...

}
[/codesh]
[/codesh-group]

### copy()

`copy(): Collection` Create a copy of the collection by cloning every object in it.

Returns:
- [Collection](#collection) (`object`) New instance holding cloned objects

!!! If you intend to modify objects in a collection, always work on a `copy()` first. The bulk `setProperty()` / `defProperty()` / `unsetProperty()` helpers mutate the object instances that are shared across every collection referencing them.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set contacts = contacts.shuffle().limit(0, 10) %}
{% set fakes = contacts.copy() %}

{% do fakes.setProperty('first_name', 'JACK') %}

<h2>Fake cards</h2>
{% render fakes layout: 'cards' %}

<h2>Original cards</h2>
{% render contacts layout: 'cards' %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    $collection = $collection->shuffle()->limit(0, 10);

    /** @var FlexCollectionInterface $fakes */
    $fakes = $collection->copy();
    $fakes->setProperty('first_name', 'JACK');
    // $collection is untouched; only the cloned objects in $fakes changed...

}
[/codesh]
[/codesh-group]

### chunk()

`chunk( size ): array` Split the collection into chunks of `size` objects.

Parameters:
- **size** Size of each chunk (`int`)

Returns:
- `array` Two-dimensional list of `key: Object` pairs

!!! Handy for laying content out in rows and columns.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set columns = contacts.limit(0, 10).chunk(5) %}

<div>Displaying two columns of 5 emails each:</div>
<div class="columns">
{% for column, list in columns %}
    <div class="column">
    {% for object in list %}
        <div>{{ object.email|e }}</div>
    {% endfor %}
    </div>
{% endfor %}
</div>
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    /** @var array $columns */
    $columns = $collection->limit(0, 10)->chunk(5);

    /**
     * @var int $column
     * @var array<string, FlexObjectInterface> $objects
     */
    foreach ($columns as $column => $objects) {
        // Do something with the objects...
    }

}
[/codesh]
[/codesh-group]

### group()

`group( property ): array` Group the objects by a property and return them as an associative array.

Parameters:
- **property** Property name used to group the objects (`string`)

Returns:
- `array` Two-dimensional list of `key: Object` pairs, where the property value is the first-level key

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set by_name = contacts.sort({last_name: 'ASC', first_name: 'ASC'}).group('last_name') %}

<div>Displaying contacts grouped by last name:</div>
<div>
{% for last_name, list in by_name %}
    {{ last_name|e }}:
    <ul>
    {% for object in list %}
        <li>{{ object.first_name|e }}</li>
    {% endfor %}
    </ul>
{% endfor %}
</div>
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    /** @var array $byName */
    $byName = $collection->group('last_name');

    /**
     * @var string $lastName
     * @var array<string, FlexObjectInterface> $objects
     */
    foreach ($byName as $lastName => $objects) {
        // Do something with the objects...
    }

}
[/codesh]
[/codesh-group]

### Fetching a single object

You can pull one object out of a collection by its key, either with array access or with the `get()` method. Both return `null` when the key is not present.

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{# Array access #}
{% set contact = contacts['ki2ts4cbivggmtlj'] %}

{# Or the equivalent get() method #}
{% set contact = contacts.get('ki2ts4cbivggmtlj') %}

{% if contact %}
  Email for {{ contact.first_name|e }} {{ contact.last_name|e }} is {{ contact.email|e }}
{% else %}
  Oops, contact has been removed!
{% endif %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    /** @var FlexObjectInterface|null $object */
    $object = $collection->get('ki2ts4cbivggmtlj'); // or $collection['ki2ts4cbivggmtlj']
    if ($object) {
        // Object exists, do something with it...
    }

}
[/codesh]
[/codesh-group]

### getKeys() and getObjectKeys()

`getKeys(): array` Gets all keys of the collection. `getObjectKeys(): array` is an alias of `getKeys()`.

Returns:
- `array` List of keys

[codesh-group]
[codesh=twig title="Twig"]
{% set contacts = grav.get('flex').collection('contacts') %}

{% set keys = contacts.keys() %}

Keys are: {{ keys|join(', ')|e }}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;

/** @var FlexCollectionInterface|null $collection */
$collection = Grav::instance()->get('flex')->getCollection('contacts');
if ($collection) {

    /** @var string[] $keys */
    $keys = $collection->getKeys();
    $keysList = implode(', ', $keys);

}
[/codesh]
[/codesh-group]

## Object

A **Flex Object** represents a single record in a directory: one contact, one order, one entry. It wraps that record's data with typed property access (`getProperty`, `setProperty`, and friends), knows its own key and type, renders itself through a layout, and can answer authorization questions. Objects also carry the persistence methods (`save()`, `delete()`, `update()`, `create()`) when you need to write data back to storage.

### render()

`render( [layout], [context] ): Block` Renders the object.

Parameters:
- **layout** Layout name (`string`)
- **context** Extra variables that can be used inside the Twig template file (`array`)

Returns:
- **Block** (`object`) HtmlBlock instance containing the output

!!! In Twig, use the `{% render %}` tag rather than calling the method directly, so the object's JS/CSS assets register properly.

[codesh-group]
[codesh=twig title="Twig"]
{% set contact = grav.get('flex').object('gizwsvkyo5xtms2s', 'contacts') %}

{% render contact layout: 'details' with { my_variable: true } %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\ContentBlock\HtmlBlock;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexObjectInterface|null $object */
$object = Grav::instance()->get('flex')->getObject('gizwsvkyo5xtms2s', 'contacts');
if ($object) {

    /** @var HtmlBlock $block */
    $block = $object->render('details', ['my_variable' => true]);

}
[/codesh]
[/codesh-group]

### getKey()

`getKey(): string` Get the key of the object.

Returns:
- `string` Object key

### hasKey()

`hasKey(): bool` Returns true if the object key has been set.

Returns:
- `true` if the object has a key, `false` otherwise

### getFlexType()

`getFlexType(): string` Get the type of the object.

Returns:
- `string` Name of the Flex directory the object belongs to

### hasProperty()

`hasProperty( property ): bool` Returns true if the property has been defined and has a value (not null).

Parameters:
- **property** Property name (`string`)

Returns:
- `true` if the property has a value, `false` otherwise

### getProperty()

`getProperty( property, [default] ): mixed` Returns the value of the object property.

Parameters:
- **property** Property name (`string`)
- **default** Optional value returned when the property is not set (`mixed`)

Returns:
- `mixed` Value of the property
- `null` if the property is not defined or has no value

### setProperty()

`setProperty( property, value ): Object` Set a new value on the object property.

Parameters:
- **property** Property name (`string`)
- **value** New value (`mixed`)

Returns:
- **Object** (`object`) The object, for chaining

!!! This method modifies the object instance, which is shared across every collection that references it. If that is not intended, `clone` the object first.

### defProperty()

`defProperty( property, default ): Object` Define a default value for the object property (only applied when the property is not already set).

Parameters:
- **property** Property name (`string`)
- **default** Default value (`mixed`)

Returns:
- **Object** (`object`) The object, for chaining

!!! This method modifies the shared object instance. If that is not intended, `clone` the object first.

### unsetProperty()

`unsetProperty( property ): Object` Remove the value of the object property.

Parameters:
- **property** Property name (`string`)

Returns:
- **Object** (`object`) The object, for chaining

!!! This method modifies the shared object instance. If that is not intended, `clone` the object first.

### isAuthorized()

`isAuthorized( action, [scope], [user] ): bool | null` Check whether a user is authorized to perform an action on the object.

Parameters:
- **action** (`string`)
  - One of: `create`, `read`, `update`, `delete`, `list`
- **scope** Optional (`string`)
  - Usually either `admin` or `site`
- **user** Optional user object (`object`); defaults to the current user

Returns:
- `true` Allow the action
- `false` Deny the action
- `null` Not set (treated as deny)

!!! There are two "deny" values: explicitly denied (`false`) and not set (`null`). Keeping them distinct lets multiple rules be chained together, so a later rule can decide a case that an earlier one did not match.

[codesh-group]
[codesh=twig title="Twig"]
{% set contact = grav.get('flex').object('gizwsvkyo5xtms2s', 'contacts') %}

{% if contact.isAuthorized('update', 'admin') %}
  <a href="...">Edit this contact</a>
{% endif %}
[/codesh]
[codesh=php title="PHP"]
use Grav\Common\Grav;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexObjectInterface|null $object */
$object = Grav::instance()->get('flex')->getObject('gizwsvkyo5xtms2s', 'contacts');
if ($object && $object->isAuthorized('update', 'admin')) {
    // Current user may edit this object...
}
[/codesh]
[/codesh-group]

Beyond these, objects expose persistence and form helpers that you will use when writing data: `getFlexKey()` and `getStorageKey()` (unique identifiers), `getTimestamp()`, `exists()`, `update( data, files )`, `create( [key] )`, `createCopy( [key] )`, `save()`, `delete()`, `getBlueprint()`, and `getForm()`. Saving and deleting fire the `onFlexObjectAfterSave` and `onFlexObjectAfterDelete` events, so plugins can react to writes (see the [Flex REST API](/20/api/endpoints/flex-objects) and the events reference for the full picture).
