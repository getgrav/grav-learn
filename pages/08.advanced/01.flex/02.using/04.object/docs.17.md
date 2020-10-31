---
title: Flex Object
page-toc:
  active: true
taxonomy:
    category: docs
---

# Render Object

## render()

`render( [layout], [context] ): Block` Renders the object.

Parameters:
- **layout** Layout name (`string`)
- **context** Extra variables that can be used inside the Twig template file (`array`)

Returns:
- **Block** (`object`) HtmlBlock class containing the output

!!! **NOTE:** In twig there is a `{% render %}` tag, which should be used instead of calling the method directly. This will allow JS/CSS assets from the object to work properly.

[ui-tabs]
[ui-tab title="Twig"]
```twig
{% set contact = grav.get('flex').object('gizwsvkyo5xtms2s', 'contacts') %}

{% render contact layout: 'details' with { my_variable: true } %}
```
[/ui-tab]
[ui-tab title="PHP"]
```php
use Grav\Common\Grav;
use Grav\Framework\ContentBlock\HtmlBlock;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

/** @var FlexObjectInterface|null $collection */
$object = Grav::instance()->get('flex')->getObject('gizwsvkyo5xtms2s', 'contacts');
if ($object) {

    /** @var HtmlBlock $block */
    $block = $object->render('details', ['my_variable' => true]);

}
```
[/ui-tab]
[/ui-tabs]

# Other

## getKey()

`getKey(): string` Get key of the object.

Returns:
- `string` Object key

## hasKey()

`hasKey(): bool` Returns true if the object key has been set.

Returns:
- `true` if object has a key, `false` otherwise

## getFlexType()

`getFlexType(): string` Get type of the object.

Returns:
- `string` Flex directory name where the object belongs into

## hasProperty()

`hasProperty( property ): bool` Returns true if the object property has been defined and has a value (not null).

Parameters:
- **property** Property name (`string`)

Returns:
- `true` if property has a value, `false` otherwise.

## getProperty()

`getProperty( property, default ): mixed` Returns the value of the object property.

Parameters:
- **property** Property name (`string`)

Returns:
- `mixed` Value of the property
- `null` if the property is not defined or has no value

## setProperty()

`setProperty( property, value ): Object` Set new value to the object property.

Parameters:
- **property** Property name (`string`)
- **value** New value (`mixed`)

Returns:
- **Object** (`object`) The object for chaining the method calls

!! **WARNING:** This method modifies the object instance shared between all the collections. If that is not intended, please `clone` the object before using this method.

## defProperty()

`defProperty( property, default ): Object` Define default value to the object property.

Parameters:
- **property** Property name (`string`)
- **default** Default value (`mixed`)

Returns:
- **Object** (`object`) The object for chaining the method calls

!! **WARNING:** This method modifies the object instance shared between all the collections. If that is not intended, please `clone` the object before using this method.

## unsetProperty()

`unsetProperty( property ): Object` Remove value of the object property.

Parameters:
- **property** Property name (`string`)

Returns:
- **Object** (`object`) The object for chaining the method calls

!! **WARNING:** This method modifies the object instance shared between all the collections. If that is not intended, please `clone` the object before using this method.

## isAuthorized()

`isAuthorized( action, [scope], [user] ): bool | null` Check if user is authorized for the action.

Parameters:
- **action** (`string`)
  - One of: `create`, `read`, `update`, `delete`, `list`
- **scope** Optional (`string`)
  - Usually either `admin` or `site`
- **user** Optional User Object (`object`)

Returns:
- `true` Allow action
- `false` Deny action
- `null` Not set (acts as Deny)

!!! **Note:** There are two deny values: denied (false), not set (null). This allows chaining multiple rules together when the previous rules were not matched.`

## getFlexDirectory()

`getFlexDirectory(): Directory`

Returns:
- **[Directory](/advanced/flex/using/directory)** (`object`)

## getTimestamp()

`getTimestamp(): int` Get last modified timestamp for the object.

Returns:
- `int` Timestamp.

## search()

`search(string, [properties], [options] ): float` Search a string from the object, returns weight between 0 and 1.

Parameters:
- **string** Search string (`string`)
- **properties** Properties to search, if null (or not provided), use defaults (`array` or `null`)
- **options** Extra options used while searching (`array`)
  - starts_with: `bool`
  - ends_with: `bool`
  - contains: `bool`
  - case_sensitive: `bool`

Returns:
- `float` Search weight between 0 and 1, used for ordering the results
- `0` Object does not match the search

!!! **Note:** If you override this function, make sure you return value in range 0...1!

## getFlexKey()

`getFlexKey(): string` Get a unique key for the object.

Returns:
- `string` **Flex key** of the object

Flex Keys can be used without knowing the Directory the Object belongs into.

## getStorageKey()

`getStorageKey(): string` Get a unique storage key (within the directory) which is used for figuring out the filename or database id.

Returns:
- `string` **Storage key** of the object

## exists()

`exists(): bool` Returns true if the object exists in the storage.

Returns:
- `true` Object exists in the storage
- `false` Object has not been saved

## update()

`update( data, files ): Object` Updates object in the memory.

Parameters:
- **data** (`array`) Nested arrays of properties with their values
- **files** (`array`) Array of `Psr\Http\Message\UploadedFileInterface` objects

Returns:
- **Object** (`object`) The object for chaining the method calls

! **TIP:** You need to save the object after calling this method.

## create()

`create( [key] ): Object` Create new object into the storage.

Parameters:
- **key** (`string`) Optional key

Returns:
- **Object** (`object`) Saved object

## createCopy()

`createCopy( [key] ): Object` Create a new object from the current one and save it into the storage.

Parameters:
- **key** (`string`) Optional key

Returns:
- **Object** (`object`) Saved object

## save()

`save(): Object` Save object into the storage.

Returns:
- **Object** (`object`) Saved object

## delete()

`delete(): Object` Delete object from the storage.

Returns:
- **Object** (`object`) Deleted object

## getBlueprint()

`getBlueprint( [name] ): Blueprint` Returns the blueprint of the object.

Parameters:
- **name** (`string`) Optional name for the blueprint

Returns:
- **Blueprint** (`object`)

## getForm()

`getForm( [name], [options] ): Form` Returns a form instance for the object.

Parameters:
- **name** (`string`) Optional name for the form
- **options** (`array`) Optional options to the form

Returns:
- **Form** (`object`)

## getDefaultValue()

`getDefaultValue( name, [separator] ): mixed` Returns default value suitable to be used in a form for the given property.

Parameters:
- **name** (`string`) Name of the property
- **separator** (`string`) Optional separator character for nested properties, defaults to `.` (dot)

Returns:
- `mixed` Default value of the property

## getDefaultValues()

`getDefaultValues(): array` Returns default values suitable to be used in a form for the given property.

Returns:
- `array` All default values

## getFormValue()

`getFormValue( name, [default], [separator] ): mixed` Returns raw value suitable to be used in a form for the given property.

Parameters:
- **name** (`string`) Name of the property
- **default** (`mixed`) Optional default value of the field, `null` if not given
- **separator** (`string`) Optional separator character for nested properties, defaults to `.` (dot)

Returns:
- `mixed` Value of the form field

## triggerEvent()

`triggerEvent( name, [Event] ): Object` Trigger an event of your choice.

Parameters:
- **name** (`string`) Name of the event
- **Event** (`object`) Optional event class

Returns:
- **Object** (`object`) The object for chaining the method calls
