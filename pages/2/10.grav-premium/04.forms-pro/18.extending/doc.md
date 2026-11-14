---
title: Extending Forms Pro
taxonomy:
    category: docs
description: Add your own field or action to Forms Pro from another Grav plugin. Covers the YAML manifest that puts it in the builder, the PHP class that runs an action, a field's Twig template, and the events for registering by code.
---

# Extending Forms Pro

Another plugin can add fields and actions to Forms Pro. Each has two parts: a YAML **manifest**, which puts it in the builder with its options, and **runtime code**, which makes it work on the page and when the form is sent. This page builds a small example of each. It is for plugin authors.

The example plugin below is called `docs-ext`. It adds an action named `docs-stamp` and a field named `docs-badge`. Both were run on a live Forms Pro site: the field and the action show in the builder, the field draws on the page, and the action's value lands in the entry. The code-registration example was run too: the new action was in the catalog, the changed label showed and the removed field was gone.

```
user/plugins/docs-ext/
├── blueprints.yaml
├── docs-ext.yaml
├── docs-ext.php
├── classes/StampAction.php
├── forms-pro/
│   ├── actions/docs-stamp.yaml
│   └── fields/docs-badge.yaml
└── templates/forms/fields/docs-badge/docs-badge.html.twig
```

## Manifests

Forms Pro looks for YAML files in `forms-pro/fields/` and `forms-pro/actions/` inside every enabled plugin. Nothing needs registering: while your plugin is enabled, what is in those folders appears in the builder. Disable the plugin and its fields and actions disappear. The catalog is cached, so run `bin/grav clear` after a change if it does not show up.

### An action

`forms-pro/actions/docs-stamp.yaml`:

```yaml
version: 1
context: frontend
kind: action
type: docs-stamp

meta:
  label: Stamp
  description: Adds a reference such as N-3 to the submitted data
  icon: zap
  group: data
  provider: docs-ext

behavior:
  multiple: false
  position: normal
  valueShape: map

properties:
  general:
    field:
      type: text
      label: Field name
      default: stamp
      path: field
    prefix:
      type: text
      label: Prefix
      path: prefix

stub:
  yaml:
    field: stamp
    prefix: N
```

| Key | Meaning |
|---|---|
| `type` | The action's name in `process:`. It is the YAML key a form uses. |
| `meta.label`, `meta.description` | What the **Add action** list shows. |
| `meta.icon` | An icon name. The built-in manifests show the names in use. |
| `meta.group` | Which group in the list: `response`, `notifications`, `data`, `validation`, `integrations` or `advanced`. |
| `meta.provider` | The plugin that owns it. For a manifest found in a plugin's folder, it is set to that plugin whatever you write. If that plugin is disabled, the entry is dropped. |
| `behavior.multiple` | Whether a form may have the action more than once. |
| `behavior.position` | `validation` runs first. `early` runs next, before the other actions (like Timestamp and User IP, which add a value the others use). `normal` runs where the visitor puts it. `late` runs after the normal ones (like Reset, which clears what they used). `terminal` runs last (like Redirect). |
| `behavior.valueShape` | What the action's value is in YAML: `bool`, `scalar`, `map` or `list`. |
| `behavior.conflictsWith` | A list of action types it cannot be used with. |
| `properties` | The option form shown on the action's card, in sections `general`, `options` and `advanced`. |
| `stub.yaml` | The value a new action starts with. |

Each property is a small description of one input, with a `type` (`text`, `textarea`, `number`, `toggle`, `select`, `color` and a few more), a `label`, a `default`, and a `path`, which is where in the action's value the input writes. A `select` takes an `options` map. Text properties accept `mergeTags: true` to offer the merge-tag menu. The built-in actions in `user/plugins/forms-pro/catalog/frontend/actions/` are complete examples of every kind.

Labels and descriptions can be plain English, as above, or a language key such as `DOCS_EXT.STAMP.LABEL`, which Forms Pro looks up in the language of whoever is using the builder.

### A field

`forms-pro/fields/docs-badge.yaml`:

```yaml
version: 1
context: frontend
kind: field
type: docs-badge

meta:
  label: Badge Number
  description: A short badge or ticket number
  icon: hash
  group: basic
  provider: docs-ext

palette:
  visible: true

properties:
  use: ['@common/identity', '@common/appearance', '@common/validation-basic']
  general:
    prefix:
      type: text
      label: Prefix
      path: prefix

stub:
  nameTemplate: badge_{n}
  yaml:
    label: Badge
    prefix: 'ID-'
```

`properties.use` pulls in the shared option sets the built-in fields use: `@common/identity` (label, field name, help text), `@common/appearance`, `@common/validation-basic` (required and a message), `@common/state` and `@common/conditions` (the show and hide rules). `palette.visible: true` puts the field in the palette. `stub.nameTemplate` makes the default field name, `badge_1`, `badge_2` and so on, and `stub.yaml` is what the field starts with. `meta.group` is one of `basic`, `choice`, `datetime`, `upload`, `layout`, `pro`, `security`, `advanced` or `system`.

A field can also start from another one with `extends: <type>`, which copies the other field's description, so you only write what differs.

## Making the field work on the page

A manifest only describes the field in the builder. The page needs a Twig template that draws it, and Grav's Form plugin needs to know the type exists. In the plugin:

```php
<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\DocsExt\StampAction;
use RocketTheme\Toolbox\Event\Event;

class DocsExtPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onFormsProRegisterActions' => ['onFormsProRegisterActions', 0],
        ];
    }

    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            return;
        }
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ]);
    }

    public function onTwigTemplatePaths(): void
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    // Tell the Form plugin that the type exists and takes input
    public function getFormFieldTypes(): array
    {
        return ['docs-badge' => ['input@' => true]];
    }

    public function onFormsProRegisterActions(Event $event): void
    {
        require_once __DIR__ . '/classes/StampAction.php';
        $event['registry']->register(new StampAction($this->grav));
    }
}
```

The template is `templates/forms/fields/docs-badge/docs-badge.html.twig`. It extends the Form plugin's field wrapper, which draws the label, help and errors, and fills in the input block:

```twig
{% extends "forms/field.html.twig" %}

{% block input %}
<div class="docs-badge">
    <span class="docs-badge-prefix">{{ field.prefix }}</span>
    <input type="text" name="{{ (scope ~ field.name)|fieldName }}" value="{{ value|e }}" class="form-input"{% if required %} required="required"{% endif %}>
</div>
{% endblock %}
```

Use the `fieldName` filter for the input's `name`, so values post as `data[...]` and nested fields work. A field that posts a list or a map (several inputs under one name) also needs `'array' => true` in `getFormFieldTypes()`, or the Form plugin flattens the answer to an empty string. Look at the built-in `pro-name` and `pro-repeater` for that.

## Making the action work on submit

`classes/StampAction.php` extends Forms Pro's `AbstractAction`:

```php
<?php

namespace Grav\Plugin\DocsExt;

use Grav\Plugin\Form\Form;
use Grav\Plugin\FormsPro\Actions\AbstractAction;

class StampAction extends AbstractAction
{
    protected string $type = 'docs-stamp';
    protected string $label = 'Stamp';

    public function execute(Form $form, array $params, array $data): bool
    {
        $field = (string) ($params['field'] ?? 'stamp');
        $prefix = (string) ($params['prefix'] ?? 'N');
        $form->setData($field, $prefix . '-' . count($data));

        return true;
    }
}
```

`execute()` is called when the action's turn comes. `$params` is the action's value from the form's YAML (the `field` and `prefix` of the example), and `$data` is a copy of the submitted answers at that moment. To add a value, call `$form->setData()`, as the built-in Timestamp action does. A later action, such as **Store Submission**, sees it. A form using the action:

```yaml
process:
  - docs-stamp:
      field: stamp
      prefix: Q
  - submission: true
  - message: Thanks.
```

For a form with two answers, the entry gets `stamp: Q-2`. The action sits above **Store Submission** here, which is why the entry has it.

The action is registered with the `onFormsProRegisterActions` event, in the plugin class above, with `$event['registry']->register(...)`. The `true` or `false` that `execute()` returns only stops the later actions when the action asks for it. An action that extends `AbstractAction` can override `stopsOnFailure(array $params): bool` and return `true`: then a `false` from `execute()` ends the submission with an error message for the visitor, the way a Webhook with **Continue on Failure** off does. Actions that already ran stay done. By default `stopsOnFailure()` returns `false`, so a `false` is only a note that the action failed and the rest of the actions still run.

## Registering by code

For a field or action that depends on a setting, add it from PHP instead of from a file, with the `onFormsProCatalog` event:

```php
public function onFormsProCatalog(Event $event): void
{
    $catalog = $event['catalog'];

    $catalog->addAction([
        'type' => 'docs-stamp',
        'meta' => ['label' => 'Stamp', 'group' => 'data', 'provider' => 'docs-ext'],
        'behavior' => ['multiple' => false, 'position' => 'normal', 'valueShape' => 'map'],
        'properties' => [],
        'stub' => ['yaml' => []],
    ]);

    // Change an existing entry (a deep merge of what you pass)
    $catalog->extend('pro-rating', ['meta' => ['label' => 'Score']]);

    // Hide a built-in field everywhere
    $catalog->remove('pro-slider');
}
```

The registry has `addField()`, `addAction()`, `extend($type, $partial)`, `remove($type)`, `hasField($type)` and `hasAction($type)`. Entries you add use the same structure as a manifest. The event runs after the manifests are loaded, so it can change what they added.

## Checks

After adding a manifest, clear the cache and confirm the entry is in the catalog. As a super user, with a token for the API:

```bash
curl -s -H "X-API-Token: $TOKEN" https://example.com/api/v1/forms-pro/catalog/actions
```

The response lists every action in the catalog, with yours when the plugin is enabled. See the [REST API](../rest-api).

## Related

- [Field reference](../field-reference)
- [Actions and notifications](../actions-and-notifications)
- [REST API](../rest-api)
