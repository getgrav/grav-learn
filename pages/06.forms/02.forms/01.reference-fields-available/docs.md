---
title: Reference: Available Form Fields
taxonomy:
    category: docs
---

## Which fields you can use

The Forms plugin provides the following fields, which you can use to build your forms.

| Field           | Description                      |
|:----------------------------------------- |
| **[Captcha](#the-captcha-field)**     |  A captcha antispam field, using reCAPTCHA |
| **[Checkbox](#the-checkbox-field)**    |  A simple checkbox |
| **Checkboxes**  |  A serie of checkboxes |
| **Date**        |  A date selection field |
| **Datetime**    |  A date and time selection field |
| **Display**     |  A text or instructions field (not an input field) |
| **Email**       |  An email field, with validation |
| **[File](#the-file-field)**        |  A file field for uploading |
| **Hidden**      |  An hidden field |
| **Password**    |  A password field |
| **Radio**       |  A radio input type |
| **Select**      |  A select field |
| **Spacer**      |  Used to add a title, text or an horizontal line to the form |
| **[Text](#the-text-field)** | A simple text field |
| **Textarea**    |  A textarea |

### Common Fields attributes

Every field accepts a list of attributes you can use. Each field could share these common attributes, but particular fields might ignore them. The best way to check which attributes are allowed on a field is to check the field description in this page, and see which attributes are mentioned.

This list provides a common ground so there's no need to repeat the description of a common field.

| Attribute           | Description         |
|:----------------------------------------- |
| `autocomplete`      | Accepts `on` or `off` |
| `autofocus`         | if enabled, autofocus on that field |
| `classes`           | accepts a string with one of more CSS classes to add |
| `default`           | sets the field default value |
| `disabled`          | sets the field disabled state |
| `help`              | Adds a tooltip to the field |
| `id`                | sets the field id. Also sets the `for` attribute on the label |
| `label`             | sets the field label |
| `name`              | sets the field name |
| `novalidate`        | sets the field novalidate state |
| `outerclasses`      | Classes added to the div that includes the label and the field |
| `placeholder`       | sets the field placeholder value |
| `readonly`          | sets the field readonly state |
| `size`              | sets the field size, which in turn adds a class to its container. Valid values are `large`, `x-small`, `medium`, `long`, `small`. You can of course add more in the template yo see, when used in the frontend |
| `style`             | sets the field style |
| `title`             | sets the field title value |
| `type`              | sets the field type |
| `validate.required`  | if set to a positive value, sets the field as required. |
| `validate.pattern`  | sets a validation pattern |
| `validate.message`  | sets the message shown if the validation fails |

Some fields allow specific parameters. Listed here:

- **date** and **datetime**: set `validate.min` and `validate.max` to set a min & max value
- **spacer** allows the use of `underline` to add an `<hr>` tag, `text` to add a text value and uses `title` as an `h3` tag.
- **select** allows `multiple` to allow accepting multiple values
- **select** and **checkboxes** use the `options` field to set the available options.
- **display** accepts `content` to set the content to show. Set `markdown` to true to parse the markdown in `content`.
- **captcha** accepts `recaptcha_site_key` and `recaptcha_not_validated`.
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

### The Captcha Field

The `captcha` field is used to add a Google Recaptcha element to your form. Unlike other elements, it can be used once in the form.

Also, the `name` attribute of the catpcha field must be `g-recaptcha-response`.

Example:

```yaml
-
  name: g-recaptcha-response
  label: Captcha
  type: captcha
  recaptcha_site_key: j3jeoi3jeroi23jrio234jro32nrkj43njrn32rn3
  recaptcha_not_validated: 'Captcha not valid!'
  validate:
    required: true
```

| Special Field Attributes Available        |   |
|:----------------------------------------- |:- |
| `recaptcha_site_key`           | The Google Recaptcha Site Key |
| `recaptcha_not_validated`      | The message to show if the captcha is not valid |

| Common Attributes Allowed                 |
|:----------------------------------------- |
| [help](#fields-parameters)                |
| [label](#fields-parameters)               |
| [name](#fields-parameters)               |
| [outerclasses](#fields-parameters)        |
| [validate.required](#fields-parameters)        |


### The Checkbox Field

The `checkbox` field is used to add a single checkbox to your form.

Example:

```yaml
-
  name: agree_to_terms
  type: checkbox
  label: "Agree to the terms and conditions"
  validate:
      required: true
```

| Common Attributes Allowed                 |
|:----------------------------------------- |
| [autofocus](#fields-parameters)           |*
| [classes](#fields-parameters)             |*
| [disabled](#fields-parameters)            |*
| [id](#fields-parameters)                  |*
| [label](#fields-parameters)               |
| [name](#fields-parameters)                |*
| [novalidate](#fields-parameters)          |*
| [outerclasses](#fields-parameters)        |*
| [size](#fields-parameters)                |*
| [style](#fields-parameters)               |*
| [validate.required](#fields-parameters)   |*
| [validate.pattern](#fields-parameters)    |*
| [validate.message](#fields-parameters)    |*

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

| Attribute  | Description                              |
|:----------------------------------------- |
| `multiple`           |   Can be `true` or `false`, when set to **true**, multiple files can be selected at the same time |
| `destination`             | Can be either **@self**, **@page:/route** or **local/rel/path/**. <<br>Set to **@self**, the files will be uploaded where the form has been declared (current .md). <br>Using **@page:/route** will upload to the specified route of a page, if exists (e.g., **@page:/blog/a-blog-post**). <br>Set to **'local/rel/path'**: Can be any path relative to the Grav instance. For instance, `user/data/files`. If the path doesn't exist, it will get created so make sure it is writable. |
| `accept`             | Takes an array of MIME types that are allowed. For instance to allow only gifs and mp4 files: `accept: ['image/gif', 'video/mp4']` |

!!! The File field in the admin is a bit different, allowing also to delete a file uploaded to a form, because the use-case in admin is to upload and then associate a file to a field. In Admin, it works with Plugins and Themes blueprints. For Page Blueprints instead use the "pagemediaselect" field, which allows the user to choose a file uploaded to the page media.


### The Text Field

The `text` field is used to present a text input field.

Example:
```yaml
header.title:
  type: text
  autofocus: true
  label: PLUGIN_ADMIN.TITLE
````

| Common Attributes Allowed                 |
|:----------------------------------------- |
| [autofocus](#fields-parameters)           |
| [classes](#fields-parameters)             |
| [default](#fields-parameters)             |
| [disabled](#fields-parameters)            |
| [help](#fields-parameters)                |
| [id](#fields-parameters)                  |
| [label](#fields-parameters)               |
| [name](#fields-parameters)                |
| [novalidate](#fields-parameters)          |
| [outerclasses](#fields-parameters)        |
| [readonly](#fields-parameters)            |
| [size](#fields-parameters)                |
| [style](#fields-parameters)               |
| [title](#fields-parameters)               |
| [validate.required](#fields-parameters)   |
| [validate.pattern](#fields-parameters)    |
| [validate.message](#fields-parameters)    |

### A note on the Captcha Field

Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`. For this reason, name the Captcha
form fields as `g-recaptcha-response`, e.g.:

```yaml
-
    name: g-recaptcha-response
    label: Captcha
    type: captcha
    recaptcha_site_key: ij3eoij3oirj3oiejio3wjeioje
    recaptcha_not_validated: 'Captcha not valid!'
    validate:
        required: true
```

To also validate the captcha server-side, add the captcha process action.

```
    process:
        - captcha:
            recaptcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
```

In this way, the frontend validation will work out of the box.
