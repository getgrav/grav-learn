---
title: Advanced Blueprint Features
page-toc:
  active: true
taxonomy:
    category: docs
---
# Advanced Blueprint Features

There are advanced features in the blueprints which allow you to extend them and to have dynamic fields.

## Defining Validation Rules

If you need the same validation rules multiple times, you can create your own custom rule for it.

[codesh=yaml line-numbers="true"]
rules:
  slug:
    pattern: "[a-z][a-z0-9_\-]+"
    min: 2
    max: 80
form:
  fields:
    folder:
      type: text
      label: Folder Name
      validate:
        rule: slug
[/codesh]

Above example creates rule `slug`, which is then used in the folder field of the form.

## Extending Base Type (extends@)

You can extend existing blueprint, which allows you to add new fields as well as modify existing ones from the base blueprint.

[codesh=yaml line-numbers="true"]
extends@: default
[/codesh]

In the extended format you can specify a lookup context for your base file:

[codesh=yaml line-numbers="true"]
extends@:
  type: default
  context: blueprints://pages
[/codesh]

You can also extend the blueprint itself, if there are multiple versions of the same blueprint.

[codesh=yaml line-numbers="true"]
extends@: parent@
[/codesh]

There is no limit on how many blueprints you can extend. Fields defined in the first blueprint will be replaced by any later blueprints in the list.

[codesh=yaml line-numbers="true"]
extends@:
  - parent@
  - type: default
    context: blueprints://pages
[/codesh]

### Understanding the type- and context-properties

In the examples above, `type` is referencing a file and `context` a path. The `context`-property uses [Streams](https://learn.getgrav.org/advanced/multisite-setup#streams), which means that it resolves to a physical location.

`context: blueprints://` by default will yield `/user/plugins/admin/blueprints`, Admin's blueprints-folder. `type: default` will yield `default.yaml`, when looking up files. Because these two properties are used together, they yield a full path that Grav can understand: `/user/plugins/admin/blueprints/default.yaml`.

Whenever you see the `://`-syntax in these docs, you can be pretty sure it's referring to a stream. And when using `context`, this stream must resolve to an existing folder to work.

## Embedding Form (import@)

Sometimes you may want to share some fields or sub-forms between multiple forms.

Let's create `blueprints://partials/gallery.yaml` which we want to embed to our form:

[codesh=yaml line-numbers="true"]
form:
  fields:
    gallery.images:
      type: list
      label: Images
      fields:
        .src:
          type: text
          label: Image
[/codesh]

Our form then has a section where we would like to embed the gallery images:

[codesh=yaml line-numbers="true"]
form:
  fields:
    images:
        type: section
        title: Images
        underline: true
        import@:
          type: partials/gallery
          context: blueprints://
[/codesh]

While YAML does not allow using the same `import@` key multiple times, you can still import multiple blueprints by appending a unique number after `@`, e.g. `import@1`, `import@2` and so on. The number has no other meaning than preventing YAML parser from erroring out:

[codesh=yaml line-numbers="true"]
form:
  fields:
    images:
        type: section
        title: Images
        underline: true
        import@1:
          type: partials/gallery
          context: blueprints://
        import@2:
          type: partials/another-gallery
          context: blueprints://
[/codesh]

By default, blueprints:// resolves to `/user/plugins/admin/blueprints/` therefore please note that if you are working in the context of a theme, you would need to adjust the context of your import statement :

[codesh=yaml line-numbers="true"]
form:
  fields:
    images:
        type: section
        title: Images
        underline: true
        import@:
          type: partials/gallery
          context: theme://blueprints
[/codesh]

## Removing Fields / Properties (unset-*@)

If you want to remove a field, you can add `unset@: true` inside of it.
If you want to remove a property of field, you just append property name, eg: `unset-options@` removes all options.

## Replacing Fields / Properties (replace-*@)

By default blueprints use deep merging of its properties. Sometimes instead of merging the content of the field, you want to start from a clean table.
If you want to replace the whole field, your new field needs to start with `replace@`:

[codesh=yaml line-numbers="true"]
author.name:
  replace@: true
  type: text
  label: Author name
[/codesh]


As the result `author.name` will have only two properties: `type` and `label` regardless of what the form had before.
You can do the same for individual properties:

[codesh=yaml line-numbers="true"]
summary.enabled:
  replace-options@: true
  options:
    0: Yeah
    1: Nope
    2: Do not care
[/codesh]

Note: `replace-*@` is alias for `unset-*@`.

## Using Configuration (config-*@)

There are times when you might want to get default value from Grav configuration. For example you may want to have author field to default to author of the site:

[codesh=yaml line-numbers="true"]
form:
  fields:
    author:
      type: text
      label: Author
      config-default@: site.author.name
[/codesh]

If your site author name is `John Doe`, the form is equivalent to:

[codesh=yaml line-numbers="true"]
form:
  fields:
    author:
      type: text
      label: Author
      default: "John Doe"
[/codesh]

You can use `config-*@` for any field; for example if you want to change the field `type`, you can just have `config-type@: site.forms.author.type` to allow you to change the input field type from your configuration.

## Using Function Calls (data-*@)

You can make function calls with parameters from your blueprints to dynamically fetch a value for any property in your field. You can do this by using `data-*@:` notation as the key, where `*` is the field name you want to fill with the result of the function call.

As an example we are editing a page and we want to have a field that allows us to change its parent or in another words move page into another location. For that we need default value that points to the current location as well as a list of options which consists of all possible locations. For that we need a way to ask Grav

[codesh=yaml line-numbers="true"]
form:
  fields:
    route:
      type: select
      label: Parent
      classes: fancy
      data-default@: '\Grav\Plugin\Admin::route'
      data-options@: '\Grav\Common\Page\Pages::parentsRawRoutes'
      options:
        '/': '- Root -'
[/codesh]

If you were editing team member page, resulting form would look something like this:

[codesh=yaml line-numbers="true"]
form:
  fields:
    route:
      type: select
      label: Parent
      classes: fancy
      default: /team
      options:
        '/': '- Root -'
        '/home': 'Home'
        '/team': 'Team'
        '/team/ceo': '  Meet Our CEO'
        ...
[/codesh]

While `data-default@:` and `data-options@:` are likely the most used dynamic field properties, you are not limited to those. There are no limits on which properties you can fetch, including `type`, `label`, `validation` and even `fields` under the current field.

Additionally you can pass parameters to the function call just by using array where the first value is the function name and parameters follow:

[codesh=yaml line-numbers="true"]
  data-default@: ['\Grav\Theme\ImaginaryClass::getMyDefault', 'default', false]
[/codesh]

### Registering Custom Data Providers (Grav 2.0)

> [!IMPORTANT]
> Since Grav 2.0.11, `Class::method` callables used in `data-*@` directives are validated against an allowlist of approved data providers. Grav core's own providers (such as `\Grav\Common\Page\Pages::pageTypes` and `\Grav\Common\Utils::timezones`) are pre-approved, but a custom provider in your own plugin or theme must be registered before Grav will call it. This matters most in Admin 2.0, which resolves dynamic options through the [Resolve Data API endpoint](/20/api/endpoints/blueprints): an unregistered callable is refused with the error `Callable '...' is not an approved data provider.`

To register your provider, call `Blueprint::addAllowedDynamicCallable()` once during startup. In a theme, `onThemeInitialized` is the natural place:

[codesh=php line-numbers="true"]
<?php
namespace Grav\Theme;

use Grav\Common\Data\Blueprint;
use Grav\Common\Theme;

class MyTheme extends Theme
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0],
        ];
    }

    public function onThemeInitialized(): void
    {
        Blueprint::addAllowedDynamicCallable('Grav\Theme\MyTheme\Utils::getIcons');
    }
}
[/codesh]

In a plugin, do the same from your `onPluginsInitialized` handler. Once registered, the callable works everywhere a `data-*@` directive can reference it: in blueprints resolved server-side, and through the Admin 2.0 select fields that fetch their options over the API.

The allowlist only applies to callables named from untrusted sources, such as a form defined in page frontmatter or a callable passed to the API as a query parameter. Blueprint files that ship with a plugin or theme are trusted for server-side rendering on the frontend, but registering your provider is still required for the Admin to resolve it, so you should always register custom providers.

## Changing field ordering

When you extend a blueprint or import a file, by default the new fields are added to the end of the list. Sometimes this is not what you want to do, you may want to add item as the first or after some existing field.

If you want to create a field, you can state its ordering using the `ordering@` property. This field can contain either a field name or an integer (-1 = first item).

Here is an example:

[codesh=yaml line-numbers="true"]
form:
  fields:
    route:
      ordering@: -1
      type: select
      label: Parent
      classes: fancy
      default: /team
      options:
        '/': '- Root -'
        '/home': 'Home'
        '/team': 'Team'
        '/team/ceo': '  Meet Our CEO'
        ...
[/codesh]

Doing this ensures that the route field will be the first field to appear in the form. This makes it easy to import and/or extend an existing field and place your additional fields where you would like them to go.

Here is another example:

[codesh=yaml line-numbers="true"]
form:
  fields:
    author:
      ordering@: header.title
      type: text
      label: Author
      default: "John Doe"
[/codesh]

In the example above, we used the name of another field to set the ordering. In this example, we have set it up so that the `author` field appears after the `title` field in the form.

> [!CAUTION]
> When ordering fields in a page blueprint, you still need to reference the field names prefixed with `header.`, eg: `header.title` for the ordering to work.

## Creating new form field type

If you create a special form field type, which needs a special handling in blueprints, there is a plugin function that you can use.

[codesh=php line-numbers="true"]
    /**
     * Get list of form field types specified in this plugin. Only special types needs to be listed.
     *
     * @return array
     */
    public function getFormFieldTypes()
    {
        return [
            'display' => [
                'input@' => false
            ],
            'spacer' => [
                'input@' => false
            ]
        ];
    }
[/codesh]

You do not need to register this function as it's not really an event, but gets fired when plugin object gets constructed.
The purpose of this function is to give extra instructions how to handle the field, for example above code makes display and spacer types to be virtual, meaning that they won't exist in real data.

You can add any `key: value` pairs including dynamic properties like `data-options@` which will automatically get appended to the fields.

## Override or extend a plugin's blueprint

There are cases were you'd want to add a change a plugin's provided blueprint; to add, move, or delete the options there. This isn't straightforward: A plugin's blueprint contains more than just a `form`-property, and isn't implicitly declared as extendable. However, when building plugins it is worthwile to faciliate this for your [user's blueprints](/17/basics/folder-structure#user-blueprints).

- Firstly, the plugin must declare that it supports blueprints by adding a public-property in it's PHP-file: `public $features = ['blueprints' => 10];`
- Secondly, the plugin must `import@` it's form-fields from a file, for example:

[codesh=yaml line-numbers="true"]
form:
  validation: strict
  fields:
    tabs:
      type: tabs
      active: 1
      fields:
        import@:
          type: options
          context: blueprints://plugins/yourpluginname
[/codesh]

This imports `user/plugins/yourpluginname/blueprints/plugins/yourpluginname/options.yaml`.

- Thirdly, this file must declare default form-parts:

[codesh=yaml line-numbers="true"]
form:
  options:
    type: tab
    title: PLUGIN_ADMIN.OPTIONS
    fields:
      enabled:
        type: toggle
        label: PLUGIN_ADMIN.PLUGIN_STATUS
        default: 1
        options:
          1: PLUGIN_ADMIN.ENABLED
          0: PLUGIN_ADMIN.DISABLED
        validate:
          type: bool
[/codesh]

> [!CAUTION]
> The `context` and `type` should be in this form to avoid potential file- and naming-conflicts, and remain easily identifiable, and thus also use the seemingly superfluously long path above.

The user can then add their changes in `user/blueprints/plugins/yourpluginname/options.yaml`:

[codesh=yaml line-numbers="true"]
form:
  options:
    fields:
      category:
        type: selectize
        label: Category
        validate:
          type: commalist
[/codesh]

And this will be picked up in plugin's configuration-page.

## onBlueprintCreated or accessing blueprint data

Because of blueprints consist of fields with dots, getting nested field from blueprint uses `/` notation instead of `.` notation.

[codesh=php]
$tabs = $blueprint->get('form/fields/tabs');
[/codesh]

This makes it possible to access special data fields, like:

[codesh=php]
$name = $blueprint->get('form/fields/content.name');
$name = $blueprint->get('form/fields/content/fields/.name');
[/codesh]

For backwards compatibility, you can specify divider in the last (3rd) parameter of `set()` and `get()`

[codesh=php]
$tabs = $blueprint->get('form/fields/tabs', null, '/');
[/codesh]
