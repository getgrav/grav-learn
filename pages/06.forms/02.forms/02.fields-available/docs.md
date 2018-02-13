---
title: Reference: Form Field Index
taxonomy:
    category: docs
---

## Which fields you can use

The Forms plugin provides the following fields, which you can use to build your forms.

| Field                                   | Description                                                 |
| :-----                                  | :-----                                                      |
| **[Captcha](#the-captcha-field)**       | A captcha antispam field, using reCAPTCHA                   |
| **[Checkbox](#the-checkbox-field)**     | A simple checkbox                                           |
| **[Checkboxes](#the-checkboxes-field)** | A series of checkboxes                                      |
| **[Conditional](#the-conditional-field)** | A conditional field that will display or hide fields based on a condition                                        |
| **[Date](#the-date-field)**             | A date selection field                                      |
| **[Display](#the-display-field)**       | A text or instructions field (not an input field)           |
| **[Email](#the-email-field)**           | An email field, with validation                             |
| **[File](#the-file-field)**             | A file field for uploading                                  |
| **[Hidden](#the-hidden-field)**         | An hidden field                                             |
| **[Honeypot](#the-honeypot-field)**     | A hidden field which returns an error when filled           |
| **[Password](#the-password-field)**     | A password field                                            |
| **[Radio](#the-radio-field)**           | A radio input type                                          |
| **[Range](#the-range-field)**           | A range input type                                          |
| **[Select](#the-select-field)**         | A select field                                              |
| **[Select OptGroup](#the-select-optgroup-field)**         | A grouping of options used within a select field                                              |
| **[Spacer](#the-spacer-field)**         | Used to add a title, text or a horizontal line to the form |
| **[Text](#the-text-field)**             | A simple text field                                         |
| **[Textarea](#the-textarea-field)**     | A textarea                                                  |

### Common Fields Attributes

Every field accepts a list of attributes you can use. Each field could share these common attributes, but particular fields might ignore them. The best way to check which attributes are allowed on a field is to check the field description in this page and see which attributes are mentioned.

This list provides a common ground so there's no need to repeat the description of a common field.

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

### Positive values

You can set positive values in multiple ways: `'on'`, `true`, `1`.
Other values are interpreted as negative.

---

### The Captcha Field

The `captcha` field type is used to add a Google reCAPTCHA element to your form. Unlike other elements, it can be used once in the form.

Also, the `name` attribute of the captcha field must be `g-recaptcha-response`. The reason is that Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`.

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

| Attribute                 | Description                                     |
| :-----                    | :-----                                          |
| `recaptcha_site_key`      | The Google reCAPTCHA Site Key                   |
| `recaptcha_not_validated` | The message to show if the captcha is not valid |

| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate.required](#common-fields-attributes) |

##### Server-side Captcha validation

The above code will validate the Captcha in the frontend and prevent form submission if not correct. To also validate the captcha server-side, add the captcha process action to your forms:

```
    process:
        - captcha:
            recatpcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
```

[See the Contact Form example](/forms/forms/example-form) to see it in action.

---

### The Checkbox Field

![Checkbox Field](checkbox_field.gif)

The `checkbox` field type is used to add a single checkbox to your form.

Example:

```yaml
agree_to_terms:
  type: checkbox
  label: "Agree to the terms and conditions"
  validate:
      required: true
```

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

---

### The Checkboxes Field

![Checkboxes Field](checkboxes_field.gif)

The `checkboxes` field type is used to add a group of checkboxes to your form.

Examples:

```yaml
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
```

```yaml
my_field:
    type: checkboxes
    label: A couple of checkboxes
    default:
        option1: true
        option2: true
    options:
        option1: Option 1
        option2: Option 2
```


| Attribute | Description                                                                                                                                    |
| :-----    | :-----                                                                                                                                         |
| `use`     | When set to `keys`, the checkbox will store the value of the element key when the form is submitted. Otherwise, it will use the element value. |
| `options` | An array of key-value options that will be allowed.                                                                                            |


| Common Attributes Allowed                 |
:----- |
| [autofocus](#common-fields-attributes)           |
| [classes](#common-fields-attributes)             |
| [default](#common-fields-attributes)             |
| [disabled](#common-fields-attributes)            |
| [help](#common-fields-attributes)                |
| [id](#common-fields-attributes)                  |
| [label](#common-fields-attributes)               |
| [name](#common-fields-attributes)                |
| [outerclasses](#common-fields-attributes)        |
| [size](#common-fields-attributes)                |
| [style](#common-fields-attributes)               |
| [validate.required](#common-fields-attributes)   |
| [validate.pattern](#common-fields-attributes)    |
| [validate.message](#common-fields-attributes)    |


---
### The Conditional Field


The `conditional` field type is used to conditionally display some other fields base on a condition.

Examples:

If your conditional already returns a `true` or `false` then you can simply use this simplified format:

```yaml
header.field_condition:
  type: conditional
  condition: config.plugins.yourplugin.enabled
  fields: # The field(s) below will be displayed only if the plugin named yourplugin is enabled
    header.mytextfield:
    type: text
    label: A text field
```

However, if you require more complex conditions, you can perform some logic that returns `'true'` or `'false'` as strings, and the field will understand that too.

```yaml
header.field_condition:
  type: conditional
  condition: "config.plugins.yourplugin.enabled ? 'true' : 'false'"
  fields: # The field(s) below will be displayed only if the plugin named yourplugin is enabled
    header.mytextfield:
    type: text
    label: A text field
```

| Attribute | Description                                                                                                                                    |
| :-----    | :-----                                                                                                                                         |
| `condition`     | The condition evaluated by twig. Any variable accessible by twig can be evaluated |



| Common Attributes Allowed                 |
:----- |
| [disabled](#common-fields-attributes)            |
| [id](#common-fields-attributes)                  |
| [label](#common-fields-attributes)               |
| [name](#common-fields-attributes)                |

---

### The Date Field

![Date Field](date_field.gif)

The `date` field type is used to add an HTML5 `date` input field.

Example:

```yaml
-
  type: date
  label: Enter a date
  validate.min: "2014-01-01"
  validate.max: "2018-12-31"
```

| Attribute      | Description                                                                                                                                                                                        |
| :-----         | :-----                                                                                                                                                                                             |
| `validate.min` | Sets the `min` attribute of the field (see [http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes](http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes)) |
| `validate.max` | Sets the `max` attribute of the field (see [http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes](http://html5doctor.com/the-woes-of-date-input/#feature-min-max-attributes)) |

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

### The Display Field

![Display Field](display_field.jpg)

The `display` field type is used to show some text or instructions inside the form. Can accept markdown content

Example:


```yaml
test:
    type: display
    size: large
    label: Instructions
    markdown: true
    content: "This is a test of **bold** and _italic_ in a text/display field\n\nanother paragraph...."
```

| Attribute  | Description                                                         |
| :-----     | :-----                                                              |
| `markdown` | boolean value that enables markdown processing on the content field |
| `content`  | the textual content to show                                         |

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

---

### The Email Field

![Email Field](email_field.gif)

The `email` field type is used to present a text input field that accepts an email, using the [email HTML5 input](http://html5doctor.com/html5-forms-input-types/#input-email).

Example:
```yaml
header.email:
  type: email
  autofocus: true
  label: Email
````

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

### The File Field

With the `file` field type, you can let users upload files through the form. The field by default allows **one file** only, of type **image** and will get uploaded to the **current** page where the form has been declared.

``` yaml
# Default settings
my_files:
  type: file
  multiple: false
  destination: '@self'
  accept:
    - image/*
```

| Attribute     | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| :-----        | :-----                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| `multiple`    | Can be `true` or `false`, when set to **true**, multiple files can be selected at the same time                                                                                                                                                                                                                                                                                                                                                                                          |
| `destination` | Can be either **@self**, **@page:/route** or **local/rel/path/**. <br>Set to **@self**, the files will be uploaded where the form has been declared (current .md). <br>Using **@page:/route** will upload to the specified route of a page, if exists (e.g., **@page:/blog/a-blog-post**). <br>Set to **'local/rel/path'**: Can be any path relative to the Grav instance. For instance, `user/data/files`. If the path doesn't exist, it will get created, so make sure it is writable. |
| `accept`      | Takes an array of MIME types that are allowed. For instance to allow only gifs and mp4 files: `accept: ['image/gif', 'video/mp4']`                                                                                                                                                                                                                                                                                                                                                       |

!!! The File field in the admin is a bit different, allowing also to delete a file uploaded to a form, because the use-case in admin is to upload and then associate a file to a field.

| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate.required](#common-fields-attributes) |

By default, in Admin the `file` field will overwrite an uploaded file that has the same name of a newer one, contained in the same folder you want to upload it, unless you set `avoid_overwriting` to `true` in the field definition.

---

### The Hidden Field

The `hidden` field type is used to add a hidden element to a form.

Example:
```yaml
header.some_field:
  type: hidden
  default: my-value
````

| Attribute | Description                                                                                                                     |
| :-----    | :-----                                                                                                                          |
| `name`    | The field name. If missing, the field name is got from the field definition element (in the example above: `header.some_field`) |

| Common Attributes Allowed            |
| :-----                               |
| [default](#common-fields-attributes) |

---

### The Honeypot Field

The `honeypot` field type creates a hidden field that, when filled out, will return with an error. This is a useful way to prevent bots from filling out and submitting a form.

Example:

```yaml
fields:
    - name: honeypot
      type: honeypot
```

This is a simple text field which does not appear on the front end. Bots, which detect fields in the code and fill them out automatically, will likely fill the field out. The error prevents that form from being properly submitted. The error comes back next to the form element, rather than on the top in a message block.

A honeypot field is a popular alternative to captcha fields.

---

### The Password Field

The `password` field type is used to present a password text input field.

Example:
```yaml
password:
  type: password
  label: Password
````

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

### The Radio Field

![Radio Field](radio_field.gif)

The `radio` field type is used to present a set of radio fields

Example:
```yaml
my_choice:
  type: radio
  label: Choice
  default: markdown
  options:
      markdown: Markdown
      twig: Twig
````

| Attribute | Description                                         |
| :-----    | :-----                                              |
| `options` | An array of key-value options that will be allowed. |

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

---

### The Range Field

![Range Field](range_field.gif)

The `range` field is used to present a [range input field](http://html5doctor.com/html5-forms-input-types/#input-range).

Example:
```yaml
header.choose_a_number_in_range:
  type: range
  label: Choose a number
  validate:
    min: 1
    max: 10
````

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

### The Select Field

![Select Field](select_field.gif)

The `select` field type is used to present a select field.

Example:
```yaml
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
````

| Attribute  | Description                                         |
| :-----     | :-----                                              |
| `options`  | An array of key-value options that will be allowed. |
| `multiple` | Allow the form to accept multiple values.           |

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

---

### The Select Optgroup Field

![Select Optgroup Field](select_optgroup_field.gif)

The `select_optgroup` field type is used to present a select field with groupings.

Example:
```yaml
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
````

| Attribute  | Description                                         |
| :-----     | :-----                                              |
| `options`  | An array of key-value options that will be allowed. |
| `multiple` | Allow the form to accept multiple values.           |

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

---

### The Spacer Field

The `spacer` field type is used to add some text, a headline or a hr tag

Example:


```yaml
test:
    type: spacer
    title: A title
    text: Some text
    underline: true
```

| Attribute   | Description                                            |
| :-----      | :-----                                                 |
| `title`     | add a h3 title to the form                             |
| `text`      | Add some text. If title is set, add it after the title |
| `underline` | boolean, add a `<hr>` tag if positive                  |

---

### The Text Field

![Text Field](text_field.gif)

The `text` field is used to present a text input field.

Example:
```yaml
header.title:
  type: text
  autofocus: true
  label: PLUGIN_ADMIN.TITLE
````

| Attribute | Description                                       |
| :-----    | :-----                                            |
| `prepend` | prepend some text or HTML to the front of a field |
| `append`  | append some text or HTML to the end of a field  |

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

### The Textarea Field

![Textarea Field](textarea_field.gif)

The `textarea` field is used to present a textarea input field.

Example:
```yaml
header.content:
  type: textarea
  autofocus: true
  label: PLUGIN_ADMIN.CONTENT
````

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

