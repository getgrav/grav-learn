---
title: Admin Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav Admin modifications.

1. [Add a custom YAML file](#add-a-custom-yaml-file)


### Add a custom YAML file

#### Problem:

You want to provide a site-wide group of user-editable company fields akin to `system.yaml` or `site.yaml`, but in its own dedicated file.

#### Solution:

As outlined in the [Basics / Configuration](/basics/grav-configuration#other-configuration-settings-and-files) section, the first step is to provide your new YAML data file, for example: `user/config/details.yaml`:

```
name: 'ABC Company Limited'
address: '8732 North Cumbria Street, Golden, CO, 80401'
email:
  general: 'hello@abc-company.com'
  support: 'support@abc-company.com'
  sales: 'sales@abc-company.com'
phone:
  default: '555-123-1111'
```

Now you need to provide the appropriate blueprint file to define the form.  The blueprint can be provided by a plugin, but the simplest approach is to simply put the blueprint in a file: `user/blueprints/config/details.yaml`

If you wanted to provide the blueprint via a plugin, you would first need to add this code to your plugin right after the class definition:

```
class MyPlugin extends Plugin
{
    public $features = [
        'blueprints' => 1000,
    ];
    protected $version;
    ...
```

Then add this code to your `onPluginsInitialized()` method:

```
if ($this->isAdmin()) {
    // Store this version and prefer newer method
    if (method_exists($this, 'getBlueprint')) {
        $this->version = $this->getBlueprint()->version;
    } else {
        $this->version = $this->grav['plugins']->get('admin')->blueprints()->version;
    }
}
```

Then create a file called `user/plugins/myplugin/blueprints/config/details.yaml`

The actual blueprint file should contain a form definition that matches the configuration data:

```
title: Company Details
form:
    validation: loose
    fields:

        content:
            type: section
            title: 'Details'
            underline: true
        name:
            type: text
            label: 'Company Name'
            size: medium
            placeholder: 'ACME Corp'

        address:
            type: textarea
            label: 'Address'
            placeholder: '555 Somestreet,\r\nNewville, TX, 77777'
            size: medium

        email:
            type: array
            label: 'Email Addresses'
            placeholder_key: Key
            placeholder_value: Email Address

        phone:
            type: array
            label: 'Phone Numbers'
            placeholder_key: Key
            placeholder_value: Phone Number
```

The use of the `array` field type will let you add arbitrary email and phone fields as you need them.
