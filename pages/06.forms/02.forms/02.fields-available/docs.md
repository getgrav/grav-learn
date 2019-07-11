---
title: 'Reference: Form Field Index'
page-toc:
  active: true
taxonomy:
    category: docs
---

## Common Field Attributes

Every field accepts a list of attributes you can use. Each field could share these common attributes, but particular fields might ignore them. The best way to check which attributes are allowed on a field is to check the field description in this page and see which attributes are mentioned.

This list provides a common ground so there's no need to repeat the description of a common field.

[div class="table table-keycol"]
| Attribute           | Description                                                                                                                                                                                                    |
| :-----              | :-----                                                                                                                                                                                                         |
| `autocomplete`      | Accepts `on` or `off`                                                                                                                                                                                          |
| `autofocus`         | if enabled, autofocus on that field                                                                                                                                                                            |
| `classes`           | accepts a string with one or more CSS classes to add                                                                                                                                                           |
| `default`           | sets the field default value                                                                                                                                                                                   |
| `disabled`          | sets the field disabled state                                                                                                                                                                                  |
| `help`              | Adds a tooltip to the field                                                                                                                                                                                    |
| `id`                | sets the field id. Also sets the `for` attribute on the label                                                                                                                                                  |
| `label`             | sets the field label                                                                                                                                                                                           |
| `display_label`     | Accepts `true` or `false`                                                                                                                                                                                           |
| `name`              | sets the field name                                                                                                                                                                                            |
| `novalidate`        | sets the field novalidate state                                                                                                                                                                                |
| `outerclasses`      | Classes added to the div that includes the label and the field                                                                                                                                                 |
| `placeholder`       | sets the field placeholder value                                                                                                                                                                               |
| `readonly`          | sets the field readonly state                                                                                                                                                                                  |
| `size`              | sets the field size, which in turn adds a class to its container. Valid values are `large`, `x-small`, `medium`, `long`, `small`. You can ofcourse add more in the template you see, when used in the frontend |
| `style`             | sets the field style                                                                                                                                                                                           |
| `title`             | sets the field title value                                                                                                                                                                                     |
| `type`              | sets the field type                                                                                                                                                                                            |
| `validate.required` | if set to a positive value, sets the field as required.                                                                                                                                                        |
| `validate.pattern`  | sets a validation pattern                                                                                                                                                                                      |
| `validate.message`  | sets the message shown if the validation fails                                                                                                                                                                 |
[/div]

!!! NOTE: You can set positive values in multiple ways: `'on'`, `true`, `1`. Other values are interpreted as negative.

---

## Available Fields

### Captcha Field

The `captcha` field type is used to add a Google reCAPTCHA element to your form. Unlike other elements, it can only be used once in a form.

! You should configure your Google reCAPTCHA configurations in the [reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin?target=_blank)

As of version 3.0, the field supports 3 variations of reCAPTCHA.  The overall configuration of reCAPTCHA is best set in your global form configuration file (typically `user/config/plugins/form.yaml`).  The default options are:

[prism classes="language-yaml line-numbers"]
recaptcha:
  version: 2-checkbox
  theme: light
  site_key:
  secret_key:
[/prism]

These options should be set based on the following:

[div class="table table-keycol"]
| Key | Values |
|-----|--------|
| version | Defaults to `2-checkbox`, but can also be `2-invisible` or `3` |
| theme | Defaults to `light`, but can also be `dark` (currently only works for version `2-x` versions) |
| site_key | Your Google Site Key  |
| secret_key | Your Google Secret Key |
[/div]

!! Please ensure the domain of the site is listed in Google's reCAPTCHA configuration

In the form definition, the `name` attribute of the captcha field must be `g-recaptcha-response`. The reason is that Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`.

Example:

[prism classes="language-yaml line-numbers"]
g-recaptcha-response:
  type: captcha
  label: Captcha  

[/prism]

You can also provide a custom failure `recaptcha_not_validated` message, but if you don't the default one is provided by the Form plugin.  If you want to set a form-specific `recaptcha_site_key` rather than setting it globally in the form configuration, you can set that also.

[prism classes="language-yaml line-numbers"]
g-recaptcha-response:
  type: captcha
  label: Captcha 
  recaptcha_site_key: ENTER_YOUR_CAPTCHA_PUBLIC_KEY 
  recaptcha_not_validated: 'Captcha not valid!'
[/prism]

[div class="table table-keycol"]
| Attribute                 | Description                                     |
| :-----                    | :-----                                          |
| `recaptcha_site_key`      | The Google reCAPTCHA Site Key (optional)                   |
| `recaptcha_not_validated` | The message to show if the captcha is not valid |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate.required](#common-fields-attributes) |
[/div]


##### Server-side Captcha validation

The above code will validate the Captcha in the frontend and prevent form submission if not correct. To also validate the captcha server-side, add the captcha process action to your forms:

[prism classes="language-yaml line-numbers"]
  process:
    captcha: true
[/prism]

You can also provide an optional success `message`, but if you don't no specific message will be displayed on success.  If you want to set a form-specific `recaptcha_secret` rather than setting it globally in the form configuration, you can set that also.

[prism classes="language-yaml line-numbers"]
  process:
    captcha:
      recaptcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
      message: 'Successfully passed reCAPTCHA!'
[/prism]

[See the Contact Form example](/forms/forms/example-form) to see it in action.

---

### Checkbox Field

![Checkbox Field](checkbox_field.gif)

The `checkbox` field type is used to add a single checkbox to your form.

Example:

[prism classes="language-yaml line-numbers"]
agree_to_terms:
  type: checkbox
  label: "Agree to the terms and conditions"
  validate:
      required: true
[/prism]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Checkboxes Field

![Checkboxes Field](checkboxes_field.gif)

The `checkboxes` field type is used to add a group of checkboxes to your form.

Examples:

[prism classes="language-yaml line-numbers"]
pages.process:
    type: checkboxes
    label: PLUGIN_ADMIN.PROCESS
    help: PLUGIN_ADMIN.PROCESS_HELP
    default:
        markdown: true
        twig: true
    options:
        markdown: Markdown
        twig: Twig
    use: keys
[/prism]

[prism classes="language-yaml line-numbers"]
my_field:
    type: checkboxes
    label: A couple of checkboxes
    default:
        option1: true
        option2: true
    options:
        option1: Option 1
        option2: Option 2
[/prism]


[div class="table table-keycol"]
| Attribute | Description                                                                                                                                    |
| :-----    | :-----                                                                                                                                         |
| `use`     | When set to `keys`, the checkbox will store the value of the element key when the form is submitted. Otherwise, it will use the element value. |
| `options` | An array of key-value options that will be allowed.                                                                                            |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---
### Conditional Field


The `conditional` field type is used to conditionally display some other fields base on a condition.

Examples:

If your conditional already returns a `true` or `false` then you can simply use this simplified format:

[prism classes="language-yaml line-numbers"]
header.field_condition:
  type: conditional
  condition: config.plugins.yourplugin.enabled
  fields: # The field(s) below will be displayed only if the plugin named yourplugin is enabled
    header.mytextfield:
    type: text
    label: A text field
[/prism]

However, if you require more complex conditions, you can perform some logic that returns `'true'` or `'false'` as strings, and the field will understand that too.

[prism classes="language-yaml line-numbers"]
header.field_condition:
  type: conditional
  condition: "config.plugins.yourplugin.enabled ? 'true' : 'false'"
  fields: # The field(s) below will be displayed only if the plugin named yourplugin is enabled
    header.mytextfield:
    type: text
    label: A text field
[/prism]

[div class="table table-keycol"]
| Attribute   | Description                                                                       |
| :-----      | :-----                                                                            |
| `condition` | The condition evaluated by twig. Any variable accessible by twig can be evaluated |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [disabled](#common-fields-attributes) |
| [id](#common-fields-attributes)       |
| [label](#common-fields-attributes)    |
| [name](#common-fields-attributes)     |
[/div]

---

### Date Field

![Date Field](date_field.gif)

The `date` field type is used to add an HTML5 `date` input field.

Example:

[prism classes="language-yaml line-numbers"]
-
  type: date
  label: Enter a date
  validate.min: "2014-01-01"
  validate.max: "2018-12-31"
[/prism]

[div class="table table-keycol"]
| Attribute      | Description                                                                                                                                                                                        |
| :-----         | :-----                                                                                                                                                                                             |
| `validate.min` | Sets the `min` attribute of the field (see [http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes](http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes)) |
| `validate.max` | Sets the `max` attribute of the field (see [http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes](http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes)) |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Display Field

![Display Field](display_field.jpg)

The `display` field type is used to show some text or instructions inside the form. Can accept markdown content

Example:


[prism classes="language-yaml line-numbers"]
test:
    type: display
    size: large
    label: Instructions
    markdown: true
    content: "This is a test of **bold** and _italic_ in a text/display field\n\nanother paragraph...."
[/prism]

[div class="table table-keycol"]
| Attribute  | Description                                                         |
| :-----     | :-----                                                              |
| `markdown` | boolean value that enables markdown processing on the content field |
| `content`  | the textual content to show                                         |
[/div]

[div class="table"]
| Common Attributes Allowed                 |
| :-----                                    |
| [help](#common-fields-attributes)         |
| [id](#common-fields-attributes)        |
| [label](#common-fields-attributes)        |
| [name](#common-fields-attributes)         |
| [id](#common-fields-attributes)           |
| [outerclasses](#common-fields-attributes) |
| [size](#common-fields-attributes)         |
| [style](#common-fields-attributes)        |
[/div]

---

### Email Field

![Email Field](email_field.gif)

The `email` field type is used to present a text input field that accepts an email, using the [email HTML5 input](http://html5doctor.com/html5-forms-input-types/#input-email).

Example:
[prism classes="language-yaml line-numbers"]
header.email:
  type: email
  autofocus: true
  label: Email
[/prism]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### File Field

With the `file` field type, you can let users upload files through the form. The field by default allows **one file** only, of type **image** and will get uploaded to the **current** page where the form has been declared.

[prism classes="language-yaml line-numbers"]
# Default settings
my_files:
  type: file
  multiple: false
  destination: '@self'
  accept:
    - image/*
[/prism]

[div class="table table-keycol"]
| Attribute     | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| :-----        | :-----                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| `multiple`    | Can be `true` or `false`, when set to **true**, multiple files can be selected at the same time                                                                                                                                                                                                                                                                                                                                                                                          |
| `destination` | Can be either **@self**, **@page:/route** or **local/rel/path/**. <br>Set to **@self**, the files will be uploaded where the form has been declared (current .md). <br>Using **@page:/route** will upload to the specified route of a page, if exists (e.g., **@page:/blog/a-blog-post**). <br>Set to **'local/rel/path'**: Can be any path relative to the Grav instance. For instance, `user/data/files`. If the path doesn't exist, it will get created, so make sure it is writable. |
| `accept`      | Takes an array of MIME types that are allowed. For instance to allow only gifs and mp4 files: `accept: ['image/gif', 'video/mp4']`                                                                                                                                                                                                                                                                                                                                                       |

[/div]

!!! The File field in the admin is a bit different, allowing also to delete a file uploaded to a form, because the use-case in admin is to upload and then associate a file to a field.

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate.required](#common-fields-attributes) |
[/div]

By default, in Admin the `file` field will overwrite an uploaded file that has the same name of a newer one, contained in the same folder you want to upload it, unless you set `avoid_overwriting` to `true` in the field definition.

---

### Hidden Field

The `hidden` field type is used to add a hidden element to a form.

Example:
[prism classes="language-yaml line-numbers"]
header.some_field:
  type: hidden
  default: my-value
[/prism]

[div class="table table-keycol"]
| Attribute | Description                                                                                                                     |
| :-----    | :-----                                                                                                                          |
| `name`    | The field name. If missing, the field name is got from the field definition element (in the example above: `header.some_field`) |
[/div]

[div class="table"]
| Common Attributes Allowed            |
| :-----                               |
| [default](#common-fields-attributes) |
[/div]

---

### Honeypot Field

The `honeypot` field type creates a hidden field that, when filled out, will return with an error. This is a useful way to prevent bots from filling out and submitting a form.

Example:

[prism classes="language-yaml line-numbers"]
fields:
    honeypot:
      type: honeypot
[/prism]

This is a simple text field which does not appear on the front end. Bots, which detect fields in the code and fill them out automatically, will likely fill the field out. The error prevents that form from being properly submitted. The error comes back next to the form element, rather than on the top in a message block.

A honeypot field is a popular alternative to captcha fields.

---

### Ignore Field

The `ignore` field type can be used to remove unused fields when extending from another blueprint

Example:

[prism classes="language-yaml line-numbers"]
header.process:
  type: ignore
content:
  type: ignore
[/prism]

---

### Password Field

The `password` field type is used to present a password text input field.

Example:
[prism classes="language-yaml line-numbers"]
password:
  type: password
  label: Password
[/prism]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Radio Field

![Radio Field](radio_field.gif)

The `radio` field type is used to present a set of radio fields

Example:
[prism classes="language-yaml line-numbers"]
my_choice:
  type: radio
  label: Choice
  default: markdown
  options:
      markdown: Markdown
      twig: Twig
[/prism]

[div class="table table-keycol"]
| Attribute | Description                                         |
| :-----    | :-----                                              |
| `options` | An array of key-value options that will be allowed. |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Range Field

![Range Field](range_field.gif)

The `range` field is used to present a [range input field](http://html5doctor.com/html5-forms-input-types/#input-range).

Example:
[prism classes="language-yaml line-numbers"]
header.choose_a_number_in_range:
  type: range
  label: Choose a number
  validate:
    min: 1
    max: 10
[/prism]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Select Field

![Select Field](select_field.gif)

The `select` field type is used to present a select field.

Example:
[prism classes="language-yaml line-numbers"]
pages.order.by:
    type: select
    size: long
    classes: fancy
    label: PLUGIN_ADMIN.DEFAULT_ORDERING
    help: PLUGIN_ADMIN.DEFAULT_ORDERING_HELP
    options:
        default: PLUGIN_ADMIN.DEFAULT_ORDERING_DEFAULT
        folder: PLUGIN_ADMIN.DEFAULT_ORDERING_FOLDER
        title: PLUGIN_ADMIN.DEFAULT_ORDERING_TITLE
        date: PLUGIN_ADMIN.DEFAULT_ORDERING_DATE
[/prism]

[div class="table table-keycol"]
| Attribute  | Description                                         |
| :-----     | :-----                                              |
| `options`  | An array of key-value options that will be allowed. |
| `multiple` | Allow the form to accept multiple values.           |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Select Optgroup Field

![Select Optgroup Field](select_optgroup_field.gif)

The `select_optgroup` field type is used to present a select field with groupings.

Example:
[prism classes="language-yaml line-numbers"]
header.newField:
    type: select_optgroup
    label: Test Optgroup Select Field
    options:
      - OptGroup1:
        - Option1
        - Option2
      - OptGroup2:
        - Option3
        - Option4
[/prism]

[div class="table table-keycol"]
| Attribute  | Description                                         |
| :-----     | :-----                                              |
| `options`  | An array of key-value options that will be allowed. |
| `multiple` | Allow the form to accept multiple values.           |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Spacer Field

The `spacer` field type is used to add some text, a headline or a hr tag

Example:


[prism classes="language-yaml line-numbers"]
test:
    type: spacer
    title: A title
    text: Some text
    underline: true
[/prism]

[div class="table table-keycol"]
| Attribute   | Description                                            |
| :-----      | :-----                                                 |
| `title`     | add a h3 title to the form                             |
| `text`      | Add some text. If title is set, add it after the title |
| `underline` | boolean, add a `<hr>` tag if positive                  |
[/div]

---

### Tabs / Tab Fields

![Tabs](tabs_field_bp.gif)

The `tabs` and `tab` field types are used to divide the contained form fields in tabs.

Example:

[prism classes="language-yaml line-numbers"]
tabs:
  type: tabs
  active: 1

  fields:
    content:
      type: tab
      title: PLUGIN_ADMIN.CONTENT

      fields:

        # .... other subfields

    options:
      type: tab
      title: PLUGIN_ADMIN.OPTIONS

      fields:

        # .... other subfields
[/prism]


[div class="table table-keycol"]
| Attribute | Description           |
| :-----    | :-----                |
| `active`  | The active tab number |
[/div]

---

### Text Field

![Text Field](text_field.gif)

The `text` field is used to present a text input field.

Example:

[prism classes="language-yaml line-numbers"]
header.title:
  type: text
  autofocus: true
  label: PLUGIN_ADMIN.TITLE
[/prism]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `prepend` | prepend some text or HTML to the front of a field |
| `append`  | append some text or HTML to the end of a field  |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Textarea Field

![Textarea Field](textarea_field.gif)

The `textarea` field is used to present a textarea input field.

Example:
[prism classes="language-yaml line-numbers"]
header.content:
  type: textarea
  autofocus: true
  label: PLUGIN_ADMIN.CONTENT
[/prism]

[div class="table table-keycol"]
| Attribute | Description                                                     |
| :-----    | :-----                                                          |
| `rows`    | Add a rows attribute with the value associated with this property |
| `cols`    | Add a cols attribute with the value associated with this property |

| Common Attributes Allowed                      |
| :-----                                         |
| [autofocus](#common-fields-attributes)         |
| [classes](#common-fields-attributes)           |
| [default](#common-fields-attributes)           |
| [disabled](#common-fields-attributes)          |
| [help](#common-fields-attributes)              |
| [id](#common-fields-attributes)                |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [novalidate](#common-fields-attributes)        |
| [outerclasses](#common-fields-attributes)      |
| [readonly](#common-fields-attributes)          |
| [size](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [title](#common-fields-attributes)             |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |

---

### Toggle Field

![Toggle Field](toggle_field_bp.gif)

The `toggle` field type is an on/off kind of input, with configurable labels.

Example:

[prism classes="language-yaml line-numbers"]
summary.enabled:
    type: toggle
    label: PLUGIN_ADMIN.ENABLED
    highlight: 1
    help: PLUGIN_ADMIN.ENABLED_HELP
    options:
        1: PLUGIN_ADMIN.YES
        0: PLUGIN_ADMIN.NO
    validate:
        type: bool
[/prism]


[div class="table table-keycol"]
| Attribute   | Description                                                  |
| :-----      | :-----                                                       |
| `highlight` | The key of the option to highlight (set green when selected) |
| `options`   | The list of key-value options                              |

| Common Attributes Allowed                      |
| :-----                                         |
| [default](#common-fields-attributes)           |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [style](#common-fields-attributes)             |
| [toggleable](#common-fields-attributes)        |
| [validate.required](#common-fields-attributes) |
| [validate.type](#common-fields-attributes)     |
| [disabled](#common-fields-attributes)          |

## Currently Undocumented Fields


[div class="table table-keycol"]
| Field                                             | Description                                                               |
| :-----                                            | :-----                                                                    |
| **Array**                                         |                                                                           |
| **Avatar**                                        |                                                                           |
| **Color**                                         |                                                                           |
| **Columns**                                       |                                                                           |
| **Column**                                        |                                                                           |
| **Datetime**                                      |                                                                           |
| **Fieldset**                                      |                                                                           |
| **Formname**                                      |                                                                           |
| **Key**                                           |                                                                           |
| **Month**                                         |                                                                           |
| **Number**                                        |                                                                           |
| **Signature**                                     |                                                                           |
| **Switch**                                        |                                                                           |
| **Tel**                                           |                                                                           |
| **Time**                                          |                                                                           |
| **Unique Id**                                     |                                                                           |
| **Url**                                           |                                                                           |
| **Value**                                         |                                                                           |
| **Week**                                          |                                                                           |
[/div]
