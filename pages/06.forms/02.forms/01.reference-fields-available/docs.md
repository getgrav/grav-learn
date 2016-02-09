---
title: Reference: Form Fields Available
taxonomy:
    category: docs
---

## Which fields you can use

The Forms plugin comes with

- **Captcha**: a captcha antispam field, using reCAPTCHA
- **Checkbox**: a simple checkbox
- **Checkboxes**: a serie of checkboxes
- **Date**: a date selection field
- **Datetime**: a date and time selection field
- **Display**: a text or instructions field (not an input field)
- **Email**: an email field, with validation
- **File**: a file field for uploading
- **Hidden**: an hidden field
- **Password**: a password field
- **Radio**: a radio input type
- **Select**: a select field
- **Spacer**: used to add a title, text or an horizontal line to the form
- **Text**: a simple text field
- **Textarea**: a textarea

### Fields parameters

Every field accepts a list of parameters you can use to customize their appearance.
They are:

- **label**: sets the field label
- **validate.required**: if set to a positive value, sets the field as required.
- **validate.pattern**: sets a validation pattern
- **validate.message**: sets the message shown if the validation fails
- **type**: sets the field type
- **default**: sets the field default value
- **size**: sets the field size, which in turn adds a class to its container. Valid values are `large`, `x-small`, `medium`, `long`, `small`. You can of course add more in the template you use
- **name**: sets the field name
- **classes**: accepts a string with one of more CSS classes to add
- **id**: sets the field id
- **style**: sets the field style
- **title**: sets the field title value
- **disabled**: sets the field disabled state
- **placeholder**: sets the field placeholder value
- **autofocus**: if enabled, autofocus on that field
- **novalidate**: sets the field novalidate state
- **readonly**: sets the field readonly state
- **autocomplete**: Accepts `on` or `off`

Some fields allow specific parameters. Listed here:

- **date** and **datetime**: set `validate.min` and `validate.max` to set a min & max value
- **spacer** allows the use of `underline` to add an `<hr>` tag, `text` to add a text value and uses `title` as an `h3` tag.
- **select** allows `multiple` to allow accepting multiple values
- **select** and **checkboxes** use the `options` field to set the available options.
- **display** accepts `content` to set the content to show. Set `markdown` to true to parse the markdown in `content`.
- **captcha** accepts `recatpcha_site_key` and `recaptcha_not_validated`.
- **file** accepts a `files` object with `destination`, `multiple` and `accept` properties

Examples:

```yaml
my_field:
    type: checkboxes
    label: A couple of checkboxes
    default: [option1: true, option2: true]
    options:
        option1: Option 1
        option2: Option 2
```

```yaml
test:
    type: display
    size: large
    label: Instructions
    markdown: true
    content: "This is a test of **bold** and _italic_ in a text/display field\n\nanother paragraph...."
```

You can set positive values in multiple ways: `'on'`, `'true'`, `1`.
Other values are interpreted as negative.

### The File Field

With the `file` field you can let users to upload files through the form. The field by default allows **one file** only, of type **image** and will get uploaded in the **current** page where the form has been declared.

``` yaml
# Default settings
- my_files:
      type: file
      multiple: false
      destination: '@self'
      accept:
        - image/*
```

* `multiple`:  Can be `true` or `false`, when set to **true**, multiple files can be selected at the same time
* `destination`: Can be either **@self**, **@page:/route** or **local/rel/path/**
    * **'@self'**: When set to **@self**, the files will be uploaded where the form has been declared (current .md)
    * **'@page:/route'**: **@page:/route** will upload to the specified route of a page, if exists (e.g., **@page:/blog/a-blog-post**)
    * **'local/rel/path'**: Can be any path relative to the Grav instance. For instance, `user/data/files`. If the path doesn't exist, it will get created so make sure it is writable.
* `accept`: Takes an array of MIME types that are allowed. For instance to allow only gifs and mp4 files: `accept: ['image/gif', 'video/mp4']`

!!! The File field in the admin is a bit different, allowing also to delete a file uploaded to a form, because the use-case in admin is to upload and then associate a file to a field. In Admin, it works with Plugins and Themes blueprints. For Page Blueprints instead use the "pagemediaselect" field, which allows the user to choose a file uploaded to the page media.


### A note on the Captcha Field

Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`. For this reason, name the Captcha
form fields as `g-recaptcha-response`, e.g.:

```yaml
-
    name: g-recaptcha-response
    label: Captcha
    type: captcha
    recatpcha_site_key: ij3eoij3oirj3oiejio3wjeioje
    recaptcha_not_validated: 'Captcha not valid!'
    validate:
        required: true
```

To also validate the captcha server-side, add the captcha process action.

```
    process:
        - captcha:
            recatpcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
```

In this way, the frontend validation will work out of the box.
