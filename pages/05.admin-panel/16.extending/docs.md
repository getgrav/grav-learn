---
title: Extending
taxonomy:
    category: docs
process:
    twig: false
---

This page provides guides for how to extend the Administration Panel, as well as best practices when doing so.

### Understanding Admin Themes

Just like when you are extending or modifying a regular Grav Theme, you will be overriding templates to change the structure and appearance of the Admin Plugin. This means that the templates your plugin declares to be used instead of the default ones should mirror the structure of the Admin Theme exactly. For example, if we wanted to change the avatar in the left-side navigation, we would change `nav-user-avatar.html.twig`.

In the Admin plugin the path to templates is: `user/plugins/admin/themes/grav/templates`, hereafter referred to as *ADMIN_TEMPLATES*. The file we are looking for is `ADMIN_TEMPLATES/partials/nav-user-avatar.html.twig`, which contains `<img src="https://www.gravatar.com/avatar/{{ admin.user.email|md5 }}?s=47" />`.

In your plugin the path to templates should be: `user/plugins/myadminplugin/admin/themes/grav/templates`, hereafter referred to as *PLUGIN_TEMPLATES*. The corresponding file should then be `PLUGIN_TEMPLATES/partials/nav-user-avatar.html.twig`, which would contain something like `<img src="{{ myadminplugin_avatar_image_path }}" />`.

Thus we are overriding the path to the template, but non-destructively. We target only the relevant template, in a way that does not override any unnecessary templates or hinder other admin themes from registering their alternate templates for the same use. To do this, we register the path in our plugin like this:

```
public static function getSubscribedEvents()
{
    return [
        'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0]
    ];
}

public function onAdminTwigTemplatePaths($event)
{
    $event['paths'] = [__DIR__ . '/admin/themes/grav/templates'];
}
```

It is important to remember that the theme used in the Admin plugin is sensitive to the templates available. As a general rule, you should only modify templates with *low impact*, that is, make changes that will not break the interface for any user who installs your plugin. In this sense it is better to override `nav-user-avatar.html.twig` than `nav.html.twig`, as the latter contains much more functionality but uses `{% include 'partials/nav-user-details.html.twig' %}` to include the former.

### Adding a custom field

To create a custom field, we will add it to `PLUGIN_TEMPLATES/forms/fields/myfield`. In the *myfield*-folder we need a Twig-template which declares how the field will operate. The easiest way to add a field is to find a similar field in `ADMIN_TEMPLATES/forms/fields` and copy that, to see how they are structured. For example, to add a HTML range-slider we create `PLUGIN_TEMPLATES/forms/fields/range/range.html.twig`. In this file, we add:

```
{% extends "forms/field.html.twig" %}

{% block input_attributes %}
    type="range"
    {% if field.validate.min %}min="{{ field.validate.min }}"{% endif %}
    {% if field.validate.max %}max="{{ field.validate.max }}"{% endif %}
    {% if field.validate.step %}step="{{ field.validate.step }}"{% endif %}
    {{ parent() }}
{% endblock %}
```

This adds a field-type called "range", with the type *range*, that allows the user to select a value by [sliding a button](http://www.html5tutorial.info/html5-range.php). To use the new field in a blueprint, we would simply add this in [*blueprints.yaml*](/plugins/plugin-tutorial#required-items-to-function):

```
form:
  fields:
    radius:
      type: range
      label: Radius
      id: radius
      default: 100
      validate:
        min: 0
        max: 100
        step: 10
```

Which gives us a slider with a default value of 100, where accepted values are between 0 and 100, and each value increments by 10 as we slide it.

We could extend this further by using the `prepend` or `append` blocks available, by for example adding a visual indicator of the selected value. We change `range.html.twig` to contain this:

```
{% extends "forms/field.html.twig" %}

{% block input_attributes %}
    type="range"
    style="display: inline-block;vertical-align: middle;"
    {% if field.id is defined %}
        oninput="{{ field.id|e }}_output.value = {{ field.id|e }}.value"
    {% endif %}
    {% if field.validate.min %}min="{{ field.validate.min }}"{% endif %}
    {% if field.validate.max %}max="{{ field.validate.max }}"{% endif %}
    {% if field.validate.step %}step="{{ field.validate.step }}"{% endif %}
    {{ parent() }}
{% endblock %}
{% block append %}
  {% if field.id is defined %}
    <output
        name="{{ (scope ~ field.name)|fieldName }}"
        id="{{ field.id|e }}_output"
        style="display: inline-block;vertical-align: baseline;padding: 0 0.5em 5px 0.5em;"
    >
    {{ value|join(', ')|e('html_attr') }}
    </output>
  {% endif %}
{% endblock append %}
```

Thus we append an `<output>`-tag which will hold the selected value, and add to it and the field itself simple styling to align them properly. We also add an `oninput`-attribute to the field, so that changing values automatically updates the `<output>`-tag with the value. This requires that each field using the range-slider has an unique `id`-property, like the `id: radius` we declared above, which should be something like `id: myadminplugin_radius` to avoid conflicts.
