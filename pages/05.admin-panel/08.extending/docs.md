---
title: Extending
media_order: 'myPage.jpg,myPage-customField.jpg'
taxonomy:
    category:
        - docs
process:
    markdown: true
    twig: false
---

This page provides guides for how to extend the Administration Panel, as well as best practices when doing so.

### Understanding Admin Themes

Just like when you are extending or modifying a regular Grav Theme, you will be overriding templates to change the structure and appearance of the Admin Plugin. This means that the templates your plugin declares to be used instead of the default ones should mirror the structure of the Admin Theme exactly. For example, if we wanted to change the avatar in the left-side navigation, we would change `nav-user-avatar.html.twig`.

In the Admin plugin, the path to templates is: `user/plugins/admin/themes/grav/templates`, hereafter referred to as *ADMIN_TEMPLATES*. The file we are looking for is `ADMIN_TEMPLATES/partials/nav-user-avatar.html.twig`, which contains `<img src="https://www.gravatar.com/avatar/{{ admin.user.email|md5 }}?s=47" />`.

In your plugin, the path to templates should be: `user/plugins/myadminplugin/admin/themes/grav/templates`, hereafter referred to as *PLUGIN_TEMPLATES*. The corresponding file should then be `PLUGIN_TEMPLATES/partials/nav-user-avatar.html.twig`, which would contain something like `<img src="{{ myadminplugin_avatar_image_path }}" />`.

Thus we are overriding the path to the template, but non-destructively. We target only the relevant template, in a way that does not override any unnecessary templates or hinder other admin themes from registering their alternate templates for the same use. To do this, we register the path in our plugin like this:

[prism classes="language-twig line-numbers"]
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
[/prism]

It is important to remember that the theme used in the Admin plugin is sensitive to the templates available. As a general rule, you should only modify templates with *low impact*, that is, make changes that will not break the interface for any user who installs your plugin. In this sense it is better to override `nav-user-avatar.html.twig` than `nav.html.twig`, as the latter contains much more functionality but uses `{% include 'partials/nav-user-details.html.twig' %}` to include the former.

### Adding a custom field

To create a custom field, we will add it to `PLUGIN_TEMPLATES/forms/fields/myfield`. In the *myfield*-folder we need a Twig-template which declares how the field will operate. The easiest way to add a field is to find a similar field in `ADMIN_TEMPLATES/forms/fields` and copy that, to see how they are structured. For example, to add a HTML range-slider we create `PLUGIN_TEMPLATES/forms/fields/range/range.html.twig`. In this file, we add:

[prism classes="language-twig line-numbers"]
{% extends "forms/field.html.twig" %}

{% block input_attributes %}
    type="range"
    {% if field.validate.min %}min="{{ field.validate.min }}"{% endif %}
    {% if field.validate.max %}max="{{ field.validate.max }}"{% endif %}
    {% if field.validate.step %}step="{{ field.validate.step }}"{% endif %}
    {{ parent() }}
{% endblock %}
[/prism]

This adds a field-type called "range", with the type *range*, that allows the user to select a value by [sliding a button](http://www.html5tutorial.info/html5-range.php). To use the new field in a blueprint, we would simply add this in [*blueprints.yaml*](/plugins/plugin-tutorial#required-items-to-function):

[prism classes="language-yaml line-numbers"]
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
[/prism]

Which gives us a slider with a default value of 100, where accepted values are between 0 and 100, and each value increments by 10 as we slide it.

We could extend this further by using the `prepend` or `append` blocks available, by for example adding a visual indicator of the selected value. We change `range.html.twig` to contain this:

[prism classes="language-twig line-numbers"]
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
[/prism]

Thus we append an `<output>`-tag which will hold the selected value, and add to it and the field itself simple styling to align them properly. We also add an `oninput`-attribute to the field, so that changing values automatically updates the `<output>`-tag with the value. This requires that each field using the range-slider has an unique `id`-property, like the `id: radius` we declared above, which should be something like `id: myadminplugin_radius` to avoid conflicts.

### Creating custom page templates

As mentioned in [Theme Basics](themes/theme-basics#content-pages-twig-templates), there is a direct relationship between **pages** in Grav and the **Twig template files** provided in a theme/ plugin.
To create a custom page template, you will need a blueprint file to define the fields for the Admin plugin and a template file for rendering the content.

#### Adding a custom page template to a theme/ plugin
In the root of the theme/ plugin folder, create a folder named `templates`.  Inside this folder, create a new mypage.html.twig file.  This will be the Twig template for the new page template "mypage".

Example mypage.html.twig:

[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% block content %}
    {{ page.header.newTextField }}
    {{ page.content}}
{% endblock %}
[/prism]

There is more information about Twig theming in the [Twig Primer](/themes/twig-primer) section.

Themes automatically find template files within the theme's `templates` folder.  If the template is being added via a plugin, you'll need to add the template via the event `onTwigTemplatePaths`:

[prism classes="language-twig line-numbers"]
    public function onPluginsInitialized()
    {
        // If in an Admin page.
        if ($this->isAdmin()) {
            return;
        }
        // If not in an Admin page.
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 1],
        ]);
    }

    /**
     * Add templates directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

[/prism]


#### Adding a custom page blueprint to a theme/ plugin

In order for the Admin plugin to provide a new `mypage` page option, create a folder named `blueprints` in the root of the theme/ plugin. Inside this folder, create a new mypage.yaml file.  This is where you will define custom fields for the Admin plugin to display when creating a new page.  Available form fields can be found in the [Forms](/forms) chapter.

The example blueprint `mypage.yaml` below extends the default page template, and then adds header.newTextField under the content tab.:

[prism classes="language-yaml line-numbers"]
title: My Page Blueprint
'@extends':
    type: default
    context: blueprints://pages

form:
  fields:
    tabs:
      type: tabs
      active: 1
      fields:
        content:
          type: tab
          fields:
             header.newTextField:
              type: text
              label: 'New Text Field'

[/prism]

Similarly to the `templates` folder, a theme will automatically add any blueprint yaml files found within the `blueprints` folder.  If the blueprint is being added via a plugin, you'll need to add the blueprint via the event `onGetPageTemplates`:

[prism classes="language-twig line-numbers"]
    public function onPluginsInitialized()
    {
        // If in an Admin page.
        if ($this->isAdmin()) {
            $this->enable([
                'onGetPageBlueprints' => ['onGetPageBlueprints', 0],
                'onGetPageTemplates' => ['onGetPageTemplates', 0],
            ]);
            return;
        }

    /**
     * Add blueprint directory.
     */
    public function onGetPageBlueprints(Event $event)
    {
        $types = $event->types;
        $types->scanBlueprints('plugin://' . $this->name . '/blueprints');
    } 
     
    /**
     * Add templates directory.
     */ 
    public function onGetPageTemplates(Event $event)
    {
        $types = $event->types;
        $types->scanTemplates('plugin://' . $this->name . '/templates');
    }

[/prism]

#### Creating a new page

After defining the blueprint and template files, create a new page within the admin panel by clicking on **Add** and then selecting "Mypage":
![myPage.jpg](myPage.jpg)

The Admin edit form now displays the new custom field "New Text Field":
![myPage-customField.jpg](myPage-customField.jpg)
