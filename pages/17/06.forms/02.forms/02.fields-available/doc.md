---
title: 'Reference: Form Field Index'
page-toc:
  active: true
taxonomy:
    category: docs
---
# Reference: Form Field Index

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
| `labelclasses`      | accepts a string with one or more CSS classes to add                                                                                                                                                            |
| `sublabel`             | sets the field sublabel                                                                                                                                                                                           |
| `sublabelclasses`      | accepts a string with one or more CSS classes to add                                                                                                                                                            |
| `name`              | sets the field name                                                                                                                                                                                            |
| `novalidate`        | sets the field novalidate state                                                                                                                                                                                |
| `outerclasses`      | Classes added to the div that includes the label and the field                                                                                                                                                 |
| `wrapper_classes`      | Classes added to the wrapper that includes the description and the field                                                                                                                                                 |
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

To add custom attributes, you can use:
```
attributes:
  key: value
```

To add custom data-* values, you can use:
```
datasets:
  key: value
```

The above shown `attributes` and `datasets` definitions lead to the following field definition:
```
<input name="data[name]" value="" type="text" class="form-input " key="value" data-key="value">
```

> [!NOTE]
> NOTE: You can set positive values in multiple ways: `'on'`, `true`, `1`. Other values are interpreted as negative.

---

## Available Fields

### Array Field

The `array` field type allows you to create a list of key-value pairs that can be dynamically added, removed, or reordered. Each row in the array can either be a simple input or a textarea, depending on the configuration.

Examples:

A simple array of key-value pairs:

[codesh=yaml line-numbers="true"]
my_array:
  type: array
  label: My Array Field
  placeholder_key: Key
  placeholder_value: Value
  value_type: text # Can also be 'textarea' for multi-line input
[/codesh]

In `value_only` mode, the array only accepts values without keys:

[codesh=yaml line-numbers="true"]
my_array_values:
  type: array
  label: Values Only
  value_only: true
  placeholder_value: Enter a value
[/codesh]

[div class="table table-keycol"]
| Attribute            | Description                                                                                  |
| :------------------  | :-------------------------------------------------------------------------------------------|
| `placeholder_key`    | Placeholder text for the key input field.                                                   |
| `placeholder_value`  | Placeholder text for the value input field.                                                 |
| `value_type`         | Determines input type for values (`text` or `textarea`).                                     |
| `value_only`         | If `true`, only value inputs are displayed without keys.                                     |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [disabled](#common-fields-attributes) |
| [readonly](#common-fields-attributes) |
| [name](#common-fields-attributes)     |
| [label](#common-fields-attributes)    |
| [classes](#common-fields-attributes)  |
| [size](#common-fields-attributes)     |
[/div]

---

### Avatar Field

The `avatar` field type displays a read-only avatar image. It is a display-only field: it renders an image but submits nothing.

This field ignores its own name and value. It always reads two fixed values from the form itself: it displays the first image found in the form's `avatar` value, and if that is empty it falls back to a [Gravatar](https://gravatar.com) generated from the form's `email` value. Because of that, it is only useful on a form that already has `avatar` and/or `email` fields, such as a user profile form.

Examples:

[codesh=yaml line-numbers="true"]
avatar_preview:
  type: avatar
  classes: "avatar-label"
  img_classes: "avatar-img"
[/codesh]

> [!NOTE]
> Naming the field something else (for example `user_avatar`) does not change what is displayed. The image still comes from the form's `avatar` and `email` values.

[div class="table table-keycol"]
| Attribute   | Description                                          |
| :-----      | :-----                                               |
| `classes`   | CSS classes applied to the label wrapping the image |
| `img_classes` | CSS classes applied directly to the avatar image  |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [classes](#common-fields-attributes)  |
[/div]

---

### Basic-Captcha Field

Added in Forms `7.0.0` as an local alternative to the Google ReCaptcha field.  This field is particularly handy when dealing with SPAM in contact forms when you don't want to deal with the hassle or perhaps GPDR restrictions that come with Google's offering. It uses **OCR-resistant** fonts to deter attacks, and can be configured with codes to be copied, or simple math questions.

![Basic-Captcha](basic-captcha_field.gif)

The `basic-captcha` field type is fully configurable both globally and per-field. Global configuration is set in your form configuration file (typically `user/config/plugins/form.yaml`), while field-level configuration allows you to customize individual captcha fields in your forms.

#### Global Configuration

The default global options are:

[codesh=yaml line-numbers="true"]
basic_captcha:
  type: characters            # options: [characters | math | dotcount | position]
  debug: false                # enable debug logging
  image:
    width: 135                # default image width (for math/dotcount/position types)
    height: 40                # default image height (for math/dotcount/position types)
    bg: '#ffffff'             # default background color
  chars:
    length: 6                 # number of chars to output
    font: zxx-xed.ttf         # options: [zxx-xed.ttf | zxx-sans.ttf | zxx-camo.ttf | zxx-noise.ttf]
    size: 24                  # font size in px
    box_width: 200            # image width for character captchas (overrides image.width)
    box_height: 70            # image height for character captchas (overrides image.height)
    start_x: 10               # start position in x direction in px
    start_y: 40               # start position in y direction in px
    bg: '#ffffff'             # background color for character captchas
    text: '#000000'           # text color (hex format)
  math:
    min: 1                    # smallest digit
    max: 12                   # largest digit
    operators: ['+','-','*']  # operators that can be used in math
[/codesh]

#### Field-Level Configuration

As of Forms `7.1.0`, you can override the global configuration on a per-field basis. This allows different forms to have different captcha styles, fonts, colors, and types.

> [!WARNING]
> **Important**: Use `captcha_type` (not `type`) for the captcha type in field-level configuration to avoid conflict with the required `type: basic-captcha` field type declaration.

**Simple Example:**

[codesh=yaml line-numbers="true"]
basic-captcha:
    type: basic-captcha
    placeholder: enter the characters
    label: Are you human?
[/codesh]

**Advanced Example with Field-Level Configuration:**

[codesh=yaml line-numbers="true"]
basic-captcha:
    type: basic-captcha
    placeholder: enter the characters
    label: Are you human?
    # Field-level configuration overrides global defaults
    captcha_type: characters        # use 'captcha_type' not 'type'
    chars:
        font: zxx-sans.ttf          # cleaner font
        size: 32                    # larger text
        length: 6                   # 6 characters
        box_width: 200              # wider image
        box_height: 70              # taller image
        bg: '#f0f8ff'               # light blue background
        text: '#0066cc'             # dark blue text
        start_x: 20                 # custom X position
        start_y: 50                 # custom Y position
[/codesh]

**Math Captcha Example:**

[codesh=yaml line-numbers="true"]
basic-captcha:
    type: basic-captcha
    placeholder: enter the answer
    label: Solve this math problem
    captcha_type: math              # math problem instead of characters
    math:
        min: 1                      # use small numbers
        max: 10
        operators: ['+','-']        # only addition and subtraction
[/codesh]

#### Available Captcha Types

When using field-level configuration, set the captcha type with `captcha_type`:

- **`characters`** - Random character string (default)
- **`math`** - Simple math problem (e.g., "3 + 5 = ?")
- **`dotcount`** - Count dots of a specific color
- **`position`** - Identify position of a symbol

#### Available Fonts

The Basic-Captcha field includes four OCR-resistant fonts:

- **`zxx-xed.ttf`** - Default, balanced readability and security
- **`zxx-sans.ttf`** - Clean sans-serif, easier to read
- **`zxx-camo.ttf`** - Camouflage style, more challenging
- **`zxx-noise.ttf`** - Noisy style, highest security

#### Configuration Options Reference

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `captcha_type` | string | `characters` | Type of captcha: `characters`, `math`, `dotcount`, or `position` |
| `chars.font` | string | `zxx-xed.ttf` | Font file for character captchas |
| `chars.size` | int | `24` | Font size in pixels |
| `chars.length` | int | `6` | Number of characters to generate |
| `chars.box_width` | int | `200` | Image width for character captchas |
| `chars.box_height` | int | `70` | Image height for character captchas |
| `chars.bg` | string | `#ffffff` | Background color (hex) for character captchas |
| `chars.text` | string | `#000000` | Text color (hex) |
| `chars.start_x` | int | `10` | Starting X position for text |
| `chars.start_y` | int | `40` | Starting Y position for text |
| `math.min` | int | `1` | Minimum number in math problems |
| `math.max` | int | `12` | Maximum number in math problems |
| `math.operators` | array | `['+','-','*']` | Available operators |
| `image.width` | int | `135` | Default image width (non-character types) |
| `image.height` | int | `40` | Default image height (non-character types) |
| `image.bg` | string | `#ffffff` | Default background color |

#### Form Processing

This also requires a matching `process:` element to ensure the form is validated properly.

> [!WARNING]
> This must be the first entry in the `process:` section of the form to ensure the form is not processed if captcha validation fails.

Example:

[codesh=yaml line-numbers="true"]
process:
    basic-captcha: true
[/codesh]

To customize the message shown when validation fails, set `captcha_not_validated` on the field itself (if omitted, the Form plugin provides a default):

[codesh=yaml line-numbers="true"]
fields:
    basic-captcha:
        type: basic-captcha
        label: Are you human?
        captcha_not_validated: Humanity verification failed, please try again...
[/codesh]

### Turnstile Captcha Field (Cloudflare)

As of Form `v7.1.0`, Grav adds support for the new Cloudflare Turnstile field.  This field is a new way to prevent SPAM in forms, and is a great alternative to the Google ReCaptcha field and **GPDR** restrictions that come with Google's offering. This field is particularly handy when dealing with SPAM in contact forms.  [Learn more about Turnstile](https://blog.cloudflare.com/turnstile-private-captcha-alternative/?target=_blank).

##### Advantages over Google ReCaptcha

1. GDPR compliant and user-privacy focused
2. Extremely fast challenge verification
3. Very simple to implement both in Cloudflare and Grav, no complex UIs or parameters to configure
4. No fancy workarounds for asynchronous form submissions (ajax), it just works!
4. Exceptional user experience compared to ReCaptcha, no more counting cars, traffic lights, or other nonsense
5. Built on top of machine learning, it will get better over-time and adapt to new attack vectors
6. Exhaustive analytics on the effectiveness of the challenge, [see screenshot](https://blog.cloudflare.com/content/images/2022/09/image1-64.png?target=_blank)


##### Integration
Before integrating Grav Forms with Turnstile, you must first [create a new Turnstile site](https://dash.cloudflare.com/?to=/:account/turnstile?target=_blank), you can also follow the [official "get started" tutorial](https://developers.cloudflare.com/turnstile/get-started/?target=_blank).
Here you can also choose the type of widget you want to use, it can be either `managed`, `non-interactive` or `invisible`. It is important to note that you can only change the type of widget from Cloudflare, you won't be able to configure this via Grav. However, if not happy with one choice, you will be able to change it later if you need to. [Learn more about the different widget types](https://developers.cloudflare.com/turnstile/reference/widget-types/?target=_blank).

> [!WARNING]
> Make sure you add any Domain you might need to use the Turnstile field on, this might include your local environment.

Once you have created a site, you will be given a `site_key` and `site_secret` that you will need to configure in your form configuration file (typically `user/config/plugins/form.yaml`). You can ignore the script tag suggested, as Grav takes care of it for you.

The default options are:

[codesh=yaml line-numbers="true"]
turnstile:
  theme: light
  site_key: <Your Turnstile Site Key>
  secret_key: <Your Turnstile Secret Key>
[/codesh]

Finally, you will also requires a matching `process:` element to ensure the form is validated properly.

> [!WARNING]
> This must be the first entry in the `process:` section of the form to ensure the form is not processed if captcha validation fails.

##### Example
A typical example for a contact form would look like the following.

[codesh=yaml line-numbers="true" highlight="19-21,27"]
form:
  name: contact
  fields:
    name:
      label: Name
      type: text
      validate:
        required: true
    email:
      label: Email
      type: email
      validate:
        required: true
    message:
      label: Message
      type: textarea
      validate:
        required: true
    captcha:
        type: turnstile
        theme: light
  buttons:
    submit:
      type: submit
      value: Submit
  process:
    turnstile: true
    email:
      subject: "[Acme] {{ form.value.name|e }}"
      reply_to: "{{ form.value.name|e }} <{{ form.value.email }}>"
    message: Thanks for contacting us!
    reset: true
    display: '/'
[/codesh]


### Google Captcha Field (ReCaptcha)

The `captcha` field type is used to add a Google reCAPTCHA element to your form. Unlike other elements, it can only be used once in a form.

> [!WARNING]
> You should configure your Google reCAPTCHA configurations in the [reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin?target=_blank)

As of version `3.0`, the field supports 3 variations of reCAPTCHA.  The overall configuration of reCAPTCHA is best set in your global form configuration file (typically `user/config/plugins/form.yaml`).  The default options are:

[codesh=yaml line-numbers="true"]
recaptcha:
  version: 2-checkbox
  theme: light
  site_key:
  secret_key:
[/codesh]

These options should be set based on the following:

[div class="table table-keycol"]
| Key | Values |
|-----|--------|
| version | Defaults to `2-checkbox`, but can also be `2-invisible` or `3` |
| theme | Defaults to `light`, but can also be `dark` (currently only works for version `2-x` versions) |
| site_key | Your Google Site Key  |
| secret_key | Your Google Secret Key |
[/div]

> [!CAUTION]
> Please ensure the domain of the site is listed in Google's reCAPTCHA configuration

In the form definition, the `name` attribute of the captcha field must be `g-recaptcha-response`. The reason is that Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`.

Example:

[codesh=yaml line-numbers="true"]
g-recaptcha-response:
  type: captcha
  label: Captcha

[/codesh]

You can also provide a custom failure `captcha_not_validated` message, but if you don't the default one is provided by the Form plugin.  If you want to set a form-specific `recaptcha_site_key` rather than setting it globally in the form configuration, you can set that also.

[codesh=yaml line-numbers="true"]
g-recaptcha-response:
  type: captcha
  label: Captcha
  recaptcha_site_key: ENTER_YOUR_CAPTCHA_PUBLIC_KEY
  captcha_not_validated: 'Captcha not valid!'
[/codesh]

[div class="table table-keycol"]
| Attribute                | Description                                     |
| :-----                   | :-----                                          |
| `recaptcha_site_key`     | The Google reCAPTCHA Site Key (optional)                   |
| `captcha_not_validated`  | The message to show if the captcha is not valid |
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

This also requires a matching `process:` element to ensure the form is validated properly.

> [!WARNING]
> This must be the first entry in the `process:` section of the form to ensure the form is not processed if ReCaptcha validation fails.

Example:

[codesh=yaml line-numbers="true"]
process:
    captcha: true
[/codesh]

##### Server-side Captcha validation

The above code will validate the Captcha in the frontend and prevent form submission if not correct. To also validate the captcha server-side, add the captcha process action to your forms:

[codesh=yaml line-numbers="true"]
  process:
    captcha: true
[/codesh]

You can also provide an optional success `message`, but if you don't no specific message will be displayed on success.  If you want to set a form-specific `recaptcha_secret` rather than setting it globally in the form configuration, you can set that also.

[codesh=yaml line-numbers="true"]
  process:
    captcha:
      recaptcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
      message: 'Successfully passed reCAPTCHA!'
[/codesh]

[See the Contact Form example](/17/forms/forms/example-form) to see it in action.

---

### Checkbox Field

![Checkbox Field](checkbox_field.gif)

The `checkbox` field type is used to add a single checkbox to your form.

Example:

[codesh=yaml line-numbers="true"]
agree_to_terms:
  type: checkbox
  label: "Agree to the terms and conditions"
  validate:
      required: true
[/codesh]

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

[codesh=yaml line-numbers="true"]
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
[/codesh]

[codesh=yaml line-numbers="true"]
my_field:
    type: checkboxes
    label: A couple of checkboxes with help for each option and option1 disabled
    default:
        - option1
        - option2
    options:
        option1: Option 1
        option2: Option 2
    help_options:
        option1: Help for Option 1
        option2: Help for Option 2
    disabled_options:
        - option1
[/codesh]


[div class="table table-keycol"]
| Attribute | Description                                                                                                                                    |
| :-----    | :-----                                                                                                                                         |
| `use`     | When set to `keys`, the checkbox will store the value of the element key when the form is submitted. Otherwise, it will use the element value. |
| `options` | An array of key-value options that will be allowed.                                                                                            |
| `help_options` | An array of key-value with help for each option defined in `options`.                                                                     |
| `disabled_options` | A list of options that will be displayed disabled.                                                                                             |
| `markdown` | When `true`, the option labels are processed as markdown and may contain HTML. Otherwise they are escaped and rendered as text.                 |
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

> [!CAUTION]
> NOTE: The checkboxes field does not support the `remember` process action.

---

### Color Field

The `color` field type allows the user to select a color using a color picker. It is rendered as an HTML `input` of type `color`.

Examples:

[codesh=yaml line-numbers="true"]
background_color:
  type: color
  label: Background Color
  default: "#ffffff"
  classes: "color-picker"
[/codesh]

[div class="table table-keycol"]
| Attribute   | Description                  |
| :-----      | :-----                       |
| `default`   | Sets the default color value |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [autocomplete](#common-fields-attributes) |
| [autofocus](#common-fields-attributes)    |
| [classes](#common-fields-attributes)      |
| [default](#common-fields-attributes)      |
| [disabled](#common-fields-attributes)     |
| [help](#common-fields-attributes)         |
| [id](#common-fields-attributes)           |
| [label](#common-fields-attributes)        |
| [display_label](#common-fields-attributes)|
| [labelclasses](#common-fields-attributes) |
| [sublabel](#common-fields-attributes)     |
| [sublabelclasses](#common-fields-attributes)|
| [name](#common-fields-attributes)         |
| [novalidate](#common-fields-attributes)   |
| [outerclasses](#common-fields-attributes) |
| [wrapper_classes](#common-fields-attributes)|
| [placeholder](#common-fields-attributes)  |
| [readonly](#common-fields-attributes)     |
| [size](#common-fields-attributes)         |
| [style](#common-fields-attributes)        |
| [title](#common-fields-attributes)        |
| [type](#common-fields-attributes)         |
| [validate.required](#common-fields-attributes) |
| [validate.pattern](#common-fields-attributes)  |
| [validate.message](#common-fields-attributes)  |
[/div]

---

### Columns Field

The `columns` field type is used to group multiple fields into a multi-column layout.  
Each `columns` field contains one or more `column` fields, which determine how content is arranged horizontally.

This field does **not** render inputs of its own. It simply organizes sub-fields into a structured, responsive layout.

Examples:

[codesh=yaml line-numbers="true"]
my_columns:
  type: columns
  fields:
    column1:
      type: column
      fields:
        header.title:
          type: text
          label: Title

    column2:
      type: column
      fields:
        header.subtitle:
          type: text
          label: Subtitle
[/codesh]

[div class="table table-keycol"]
| Attribute   | Description                          |
| :-----      | :----------------------------------- |
| `fields`    | Defines the list of column fields     |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [classes](#common-fields-attributes)  |
| [name](#common-fields-attributes)     |
[/div]

---

### Column Field

The `column` field type represents a single column inside a `columns` field.  
It wraps a set of fields inside a `<div class="form-column">` container, allowing them to be displayed side by side.

This field does not accept input itself; it only groups and structures other fields.

Examples:

[codesh=yaml line-numbers="true"]
my_column:
  type: column
  classes: "one-half"
  fields:
    header.description:
      type: textarea
      label: Description
[/codesh]

[div class="table table-keycol"]
| Attribute   | Description                        |
| :-----      | :-------------------------------- |
| `fields`    | Defines the fields inside the column |
| `classes`   | CSS classes applied to the column wrapper |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :-----                                |
| [classes](#common-fields-attributes)  |
| [name](#common-fields-attributes)     |
[/div]

---

### Conditional Field

The `conditional` field type is used to conditionally display some other fields base on a condition.

Examples:

If your conditional already returns a `true` or `false` then you can simply use this simplified format:

[codesh=yaml line-numbers="true"]
my_conditional:
  type: conditional
  condition: config.plugins.yourplugin.enabled
  fields: # The field(s) below will be displayed only if the plugin named yourplugin is enabled
    header.mytextfield:
      type: text
      label: A text field
[/codesh]

However, if you require more complex conditions, you can perform some logic that returns `'true'` or `'false'` as strings, and the field will understand that too.

[codesh=yaml line-numbers="true"]
my_conditional:
  type: conditional
  condition: "config.site.something == 'custom'"
  fields: # The field(s) below will be displayed only if the `site` configuration option `something` equals `custom`
    header.mytextfield:
        type: text
        label: A text field
[/codesh]

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

[codesh=yaml line-numbers="true"]
-
  type: date
  label: Enter a date
  validate.min: "2014-01-01"
  validate.max: "2018-12-31"
[/codesh]

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


[codesh=yaml line-numbers="true"]
test:
    type: display
    size: large
    label: Instructions
    markdown: true
    content: "This is a test of **bold** and _italic_ in a text/display field\n\nanother paragraph...."
[/codesh]

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

> [!CAUTION]
> Emails are case-insensitive by design. Ensure that your application logic handles upper-, lower- or mixed case emails properly.

Example:
[codesh=yaml line-numbers="true"]
header.email:
  type: email
  autofocus: true
  label: Email
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `minlength` | minimum text length |
| `maxlength`  | maximum text length  |
| `validate.min` | same as minlength |
| `validate.max`  | same as maxlength  |
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

### Fieldset Field

The `fieldset` field type allows you to group multiple fields inside an HTML `<fieldset>` element.  
It can optionally display a `<legend>` as the title of the field group.

This field does not store a value by itself — it simply organizes other fields visually and semantically.

Example:

[codesh=yaml line-numbers="true"]
user_info:
  type: fieldset
  id: user-info
  legend: User Information
  classes: "group-box"
  fields:
    name:
      type: text
      label: Name

    email:
      type: email
      label: Email Address
[/codesh]

[div class="table table-keycol"]
| Attribute   | Description                                      |
| :---------- | :----------------------------------------------- |
| `legend`    | The title displayed above the grouped fields     |
| `fields`    | The list of fields contained inside the fieldset |
| `id`        | Sets the `<fieldset>` element ID                 |
| `classes`   | Adds CSS classes to the `<fieldset>`             |
[/div]

[div class="table"]
| Common Attributes Allowed             |
| :------------------------------------ |
| [id](#common-fields-attributes)       |
| [classes](#common-fields-attributes)  |
| [name](#common-fields-attributes)     |
| *(Most other common field attributes are not applicable)* |
[/div]

---

### File Field

With the `file` field type, you can let users upload files through the form. The field by default allows **one file** only, of type **image** and will get uploaded to the **current** page where the form has been declared.

[codesh=yaml line-numbers="true"]
# Default settings
my_files:
  type: file
  multiple: false
  destination: 'self@'
  accept:
    - image/*
[/codesh]

[div class="table table-keycol"]
| Attribute     | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| :-----        | :-----                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| `multiple`    | Can be `true` or `false`, when set to **true**, multiple files can be selected at the same time                                                                                                                                                                                                                                                                                                                                                                                          |
| `destination` | Can be either **@self**, **@page:/route**, **local/rel/path/**, or a PHP stream.<br> Set to **@self**, the files will be uploaded where the form has been declared (current .md). <br>Using **@page:/route** will upload to the specified route of a page, if exists (e.g., **@page:/blog/a-blog-post**).<br> Set to **'local/rel/path'**: Can be any path relative to the Grav instance. For instance, `user/images/uploads`. If the path doesn't exist, it will get created, so make sure it is writable.<br> You can also set the value to any valid PHP stream recognized by Grav like `user-data://my-form` or `theme://media/uploads`. |
| `accept`      | Takes an array of MIME types that are allowed. For instance to allow only gifs and mp4 files: `accept: ['image/gif', 'video/mp4']`                                                                                                                                                                                                                                                                                                                                                       |
[/div]

> [!NOTE]
> The File field in the admin is a bit different, allowing also to delete a file uploaded to a form, because the use-case in admin is to upload and then associate a file to a field.

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
[/div]

By default, in Admin the `file` field will overwrite an uploaded file that has the same name of a newer one, contained in the same folder you want to upload it, unless you set `avoid_overwriting` to `true` in the field definition.

---

### FilePond Field

Added in Forms `7.0.0`, the `filepond` field type is a modern alternative to the File field, powered by the [FilePond JavaScript library](https://pqina.nl/filepond/). It provides a superior user experience with drag-and-drop uploads, image previews, built-in image editing (crop, resize, rotate), and smooth animations.

**When to use FilePond:**
- Image-heavy forms requiring preview and editing capabilities
- Modern user interfaces with drag-and-drop functionality
- Forms requiring client-side image optimization before upload
- Projects prioritizing user experience over legacy browser support

**When to use File field (Dropzone):**
- General file uploads (non-image files)
- Simpler implementation without image editing needs
- Legacy browser compatibility requirements

#### Basic Usage

[codesh=yaml line-numbers="true"]
my_images:
    type: filepond
    label: Upload Images
    destination: user/media/uploads
    multiple: true
    limit: 5
    filesize: 10
    accept:
        - image/*
[/codesh]

#### Configuration Options

[div class="table table-keycol"]
| Attribute | Description |
| :-------- | :---------- |
| `multiple` | Boolean. When `true`, allows multiple files to be selected simultaneously (default: `false`) |
| `limit` | Integer. Maximum number of files allowed per field (default: `10`) |
| `destination` | Upload destination. Options:<br>• `@self` - Upload to current page<br>• `@page:/route` - Upload to specific page route<br>• `user/path/to/folder` - Relative path from Grav root<br>• PHP streams like `user-data://uploads` |
| `filesize` | Integer. Maximum file size in MB. `0` = unlimited, subject to server limits (default: `0`) |
| `accept` | Array of MIME types/extensions allowed. Examples:<br>• `['image/*']` - All images<br>• `['image/jpeg', 'image/png']` - Specific types<br>• `['application/pdf']` - PDFs |
| `avoid_overwriting` | Boolean. When `true`, adds date prefix to prevent file overwrite (default: `false`) |
| `random_name` | Boolean. When `true`, generates random filename on upload (default: `false`) |
| `validate.required` | Boolean. Makes the field required (default: `false`) |
[/div]

#### Image Transform & Resize Options

FilePond includes powerful image processing capabilities through the `filepond` configuration key:

[codesh=yaml line-numbers="true"]
my_images:
    type: filepond
    label: Upload and Edit Images
    destination: user/media/uploads
    multiple: true
    filesize: 10
    accept:
        - image/jpeg
        - image/png
        - image/webp
    filepond:
        # Output Format
        allowImageTransform: true
        imageTransformOutputMimeType: 'image/jpeg'
        imageTransformOutputQuality: 85
        imageTransformOutputStripImageHead: true

        # Resize Settings
        allowImageResize: true
        imageResizeTargetWidth: 1024
        imageResizeTargetHeight: 768
        imageResizeMode: 'contain'
        imageResizeUpscale: false

        # Crop Settings
        allowImageCrop: true
        imageCropAspectRatio: '16:9'

        # Preview Settings
        allowImagePreview: true
        imagePreviewHeight: 256

        # UI Customization
        stylePanelLayout: 'compact'
        labelIdle: '<span class="filepond--label-action">Browse</span> or drop images'
[/codesh]

#### FilePond-Specific Options Reference

[div class="table table-keycol"]
| Option | Type | Default | Description |
| :----- | :--- | :------ | :---------- |
| **Image Transform** | | | |
| `allowImageTransform` | boolean | `true` | Enable image transformation before upload |
| `imageTransformOutputMimeType` | string | `image/jpeg` | Output format: `image/jpeg`, `image/png`, `image/webp` |
| `imageTransformOutputQuality` | int | `90` | Output quality 0-100 (JPEG/WebP only) |
| `imageTransformOutputStripImageHead` | boolean | `true` | Remove EXIF metadata from images |
| **Image Resize** | | | |
| `allowImageResize` | boolean | `true` | Enable automatic image resizing |
| `imageResizeTargetWidth` | int | `null` | Target width in pixels (null = no resize) |
| `imageResizeTargetHeight` | int | `null` | Target height in pixels (null = no resize) |
| `imageResizeMode` | string | `cover` | Resize mode: `cover` (crop to fit), `contain` (fit within), `force` (exact size) |
| `imageResizeUpscale` | boolean | `false` | Allow upscaling smaller images to target size |
| **Image Crop** | | | |
| `allowImageCrop` | boolean | `true` | Enable crop tool in preview |
| `imageCropAspectRatio` | string | `null` | Aspect ratio like `16:9`, `4:3`, `1:1`, or `null` for free crop |
| **Preview** | | | |
| `allowImagePreview` | boolean | `true` | Show image preview with editing tools |
| `imagePreviewHeight` | int | `256` | Preview panel height in pixels |
| **UI & Style** | | | |
| `stylePanelLayout` | string | `compact` | Panel layout style |
| `styleLoadIndicatorPosition` | string | `center bottom` | Loading indicator position |
| `styleProgressIndicatorPosition` | string | `center bottom` | Progress bar position |
| `styleButtonRemoveItemPosition` | string | `right` | Remove button position |
| **Labels** | | | |
| `labelIdle` | string | `Browse or drop files` | Main drop zone label (supports HTML) |
| `labelFileTypeNotAllowed` | string | `Invalid file type` | Error message for wrong file type |
| `labelFileSizeNotAllowed` | string | `File is too large` | Error message for oversized files |
[/div]

#### Complete Form Example

[codesh=yaml line-numbers="true"]
---
title: 'Photo Upload Form'
form:
    id: photo-upload
    xhr_submit: true
    fields:
        photos:
            type: filepond
            label: Upload Your Photos
            help: Upload up to 5 photos. They will be automatically resized to 1920x1080.
            destination: user/media/galleries
            multiple: true
            limit: 5
            filesize: 15
            accept:
                - image/jpeg
                - image/png
                - image/webp
            validate:
                required: true
            filepond:
                # Optimize images for web
                imageTransformOutputMimeType: 'image/jpeg'
                imageTransformOutputQuality: 85
                imageTransformOutputStripImageHead: true

                # Resize to HD
                allowImageResize: true
                imageResizeTargetWidth: 1920
                imageResizeTargetHeight: 1080
                imageResizeMode: 'contain'

                # Force 16:9 crop
                allowImageCrop: true
                imageCropAspectRatio: '16:9'

                # Custom label
                labelIdle: '<span class="filepond--label-action">Click to browse</span> or drag photos here'

    buttons:
        submit:
            type: submit
            value: Upload Photos

    process:
        upload: true
        message: 'Thank you! Your photos have been uploaded successfully.'
        reset: true
---

# Photo Gallery Upload

Upload your photos and they will be automatically optimized and resized.
[/codesh]

#### Form Processing

The FilePond field requires the `upload` process action to save uploaded files:

[codesh=yaml line-numbers="true"]
process:
    upload: true
    message: 'Files uploaded successfully!'
[/codesh]

Files are processed via AJAX and saved to the specified `destination` folder. Image transformations (resize, crop, format conversion) happen in the browser before upload, reducing server load and upload time.

#### XHR Form Integration

FilePond works seamlessly with AJAX form submissions (`xhr_submit: true`). The field automatically:
- Prevents form submission while files are uploading
- Reinitializes after form updates
- Preserves uploaded files during validation errors
- Cleans up temporary files on successful submission

#### Features Summary

✅ **Modern drag-and-drop interface** - Smooth animations and visual feedback
✅ **Image preview** - See images before upload with zoom and pan
✅ **Built-in image editing** - Crop, resize, rotate images in the browser
✅ **Client-side optimization** - Reduce file size before upload
✅ **Format conversion** - Convert images to JPEG/PNG/WebP
✅ **Real-time validation** - File type and size validation with instant feedback
✅ **Progress indication** - Upload progress bars for each file
✅ **Multiple file support** - Upload several files with one field
✅ **Responsive design** - Works on desktop, tablet, and mobile devices
✅ **Accessibility** - Keyboard navigation and screen reader support

#### Comparison with File Field

[div class="table"]
| Feature | FilePond | File (Dropzone) |
| :------ | :------- | :-------------- |
| Image Preview | ✅ With zoom/pan | ✅ Thumbnail only |
| Image Editing | ✅ Crop, resize, rotate | ❌ None |
| Image Optimization | ✅ Client-side | ❌ Server-side only |
| Format Conversion | ✅ JPEG/PNG/WebP | ❌ None |
| Drag & Drop | ✅ Modern UI | ✅ Classic UI |
| File Type Validation | ✅ Real-time | ✅ On upload |
| Multiple Files | ✅ Yes | ✅ Yes |
| XHR Form Support | ✅ Automatic | ✅ Requires config |
| Best For | Images & UX | General files |
[/div]

[div class="table"]
| Common Attributes Allowed                      |
| :-----                                         |
| [help](#common-fields-attributes)              |
| [label](#common-fields-attributes)             |
| [name](#common-fields-attributes)              |
| [outerclasses](#common-fields-attributes)      |
| [validate](#common-fields-attributes)          |
[/div]

---

### Formname Field

The `formname` field type inserts a hidden input that stores the name of the current form.  
It is used internally by forms to keep track of which form was submitted, especially when multiple forms exist on the same page.

This field does not accept user input and does not allow customization beyond what the Twig explicitly supports.

> [!NOTE]
> The default form template already outputs this hidden input for you, so you rarely need to add a `formname` field by hand. It is only useful when you are building a custom form template that does not include it.

Example:

[codesh=yaml line-numbers="true"]
form_identifier:
  type: formname
[/codesh]

The generated HTML:

[codesh=html line-numbers="true"]
<input type="hidden" name="__form-name__" value="my-form-name" />
[/codesh]

[div class="table table-keycol"]
| Attribute | Description |
| :--------| :-----------|
| *(none)* | This field has **no configurable attributes** |
[/div]

[div class="table"]
| Common Attributes Allowed |
| :------------------------ |
| *(none — all common attributes are ignored)* |
[/div]

---

### Hidden Field

The `hidden` field type is used to add a hidden element to a form.

Example:
[codesh=yaml line-numbers="true"]
header.some_field:
  type: hidden
  default: my-value
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                                                                                                     |
| :-----    | :-----                                                                                                                          |
| `name`    | The field name. If missing, the field name is got from the field definition element (in the example above: `header.some_field`) |
| `evaluate` | To make use of variables like `page.title` for the value, you have to set this to `true` |
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

[codesh=yaml line-numbers="true"]
fields:
    honeypot:
      type: honeypot
[/codesh]

This is a simple text field which does not appear on the front end. Bots, which detect fields in the code and fill them out automatically, will likely fill the field out. The error prevents that form from being properly submitted. The error comes back next to the form element, rather than on the top in a message block.

A honeypot field is a popular alternative to captcha fields.

---

### Ignore Field

The `ignore` field type can be used to remove unused fields when extending from another blueprint

Example:

[codesh=yaml line-numbers="true"]
header.process:
  type: ignore
content:
  type: ignore
[/codesh]

---

### Key Field

The `key` field type provides a text input that also exposes an observable attribute (`data-key-observe`) used internally by JavaScript to watch for changes in the field's value.  
It works similarly to a standard text field but is designed specifically for use cases where the field's value must dynamically update other form elements.

If the value is an array, it will automatically be converted into a comma-separated string.

> [!IMPORTANT]
> The rendered input has no `name` attribute, so a `key` field never submits a value with the form. It exists purely to drive other fields through its `data-key-observe` attribute, and is mostly used for the key column of a list row.

Example:

[codesh=yaml line-numbers="true"]
my_key:
  type: key
  label: Identifier
  placeholder: Enter an internal key
[/codesh]

Generated HTML (simplified):

[codesh=html line-numbers="true"]
<input type="text"
       value="myvalue"
       data-key-observe="data[header][my_key]"
       placeholder="Enter an internal key" />
[/codesh]

[div class="table table-keycol"]
| Attribute | Description |
| :--------| :-----------|
| `placeholder` | Placeholder text shown when the field is empty |
| `autocomplete` | Accepts `on` or `off` |
| `autofocus` | Automatically focuses the field when the form loads |
| `classes` | Adds custom CSS classes to the input |
| `disabled` | Disables the field |
| `id` | Sets the HTML `id` attribute |
| `novalidate` | Disables native HTML validation |
| `readonly` | Makes the input read-only |
| `size` | Sets the input container size |
| `style` | Inline CSS styles |
| `tabindex` | Sets the tab order |
| `title` | Sets a tooltip or validation message |
| `validate.required` | Requires a value before submitting |
| `validate.pattern` | Regex validation pattern |
| `validate.message` | Message shown when validation fails |
[/div]

[div class="table"]
| Common Attributes Allowed |
| :------------------------ |
| autocomplete |
| autofocus |
| classes |
| disabled |
| help |
| id |
| label |
| display_label |
| labelclasses |
| sublabel |
| sublabelclasses |
| name |
| novalidate |
| outerclasses |
| wrapper_classes |
| placeholder |
| readonly |
| size |
| style |
| title |
| type |
| validate.required |
| validate.pattern |
| validate.message |
[/div]

---

### Month Field

The **month** field type allows users to select a **month and year**. It stores the value in `YYYY-MM` format. To display it as a readable date, you can append `-01` to create a full date (`YYYY-MM-DD`) and format it with Twig's `date` filter.

Examples:

[codesh=yaml line-numbers="true"]
header.billing_month:
type: month
label: Billing Month
placeholder: Select month
default: 2025-11
[/codesh]

Display in Twig:

[codesh=twig line-numbers="true"]
{% if page.header.billing_month %}
{% set month_value = page.header.billing_month ~ '-01' %} <p>{{ month_value|date("F Y") }}</p>
{% endif %}
[/codesh]

This will render `2025-11` as **November 2025** on the site.

[div class="table table-keycol"]

| Attribute   | Description                                       |
| :---------- | :------------------------------------------------ |
| type        | Defines the field type as `month`                 |
| label       | The label displayed above the field               |
| placeholder | Optional text displayed when no value is selected |
| default     | Optional default value in `YYYY-MM` format        |
[/div]

[div class="table"]

| Common Attributes Allowed             |
| :------------------------------------ |
| [disabled](#common-fields-attributes) |
| [id](#common-fields-attributes)       |
| [label](#common-fields-attributes)    |
| [name](#common-fields-attributes)     |
| [required](#common-fields-attributes) |
[/div]

---

### Number Field

The `number` field type is used to present a text input field that accepts numbers only, using the [number HTML5 input](http://html5doctor.com/html5-forms-input-types/#input-number).

Example:
[codesh=yaml line-numbers="true"]
header.count:
  type: number
  label: 'How Much?'
  validate:
    min: 10
    max: 360
    step: 10
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `validate.min` | minimum value |
| `validate.max`  | maximum value  |
| `validate.step`  | which increments to step up  |
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

### Password Field

The `password` field type is used to present a password text input field.

Example:
[codesh=yaml line-numbers="true"]
password:
  type: password
  label: Password
[/codesh]

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
[codesh=yaml line-numbers="true"]
my_choice:
  type: radio
  label: Choice
  default: markdown
  options:
      markdown: Markdown
      twig: Twig
[/codesh]

[div class="table table-keycol"]
| Attribute  | Description                                                                                                                       |
| :-----     | :-----                                                                                                                            |
| `options`  | An array of key-value options that will be allowed.                                                                               |
| `markdown` | When `true`, the option labels are processed as markdown and may contain HTML. Otherwise they are escaped and rendered as text. |
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
[codesh=yaml line-numbers="true"]
header.choose_a_number_in_range:
  type: range
  label: Choose a number
  validate:
    min: 1
    max: 10
[/codesh]

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

### Section Field

The `Section` field type is used to divide a setting page into sections.

Example:

[codesh=yaml line-numbers="true"]
content:
    type: section
    title: PLUGIN_ADMIN.DEFAULTS
    underline: true

    fields:

        #..... subfields
[/codesh]

[div class="table table-keycol"]
| Attribute     | Description                                                    |
| :-----        | :-----                                                         |
| `title`       | A heading title                                                |
| `text`        | A text to show beneath                                         |
| `security`    | An array of credentials a user needs to visualize this section |
| `title_level` | Set a custom headline tag. Default: `h3`                       |
[/div]

---

### Select Field

![Select Field](select_field.gif)

The `select` field type is used to present a select field.

Example 1:
[codesh=yaml line-numbers="true"]
pages.order.by:
    type: select
    size: long
    classes: fancy
    label: 'Default Ordering'
    help: 'Pages in a list will render using this order unless it is overridden'
    options:
        default: 'Default - based on folder name'
        folder: 'Folder - based on prefix-less folder name'
        title: 'Title - based on title field in header'
        date: 'Date - based on date field in header'
[/codesh]

Example 2 - Disabling Individual Options:
[codesh=yaml line-numbers="true"]
my_element:
    type: select
    size: long
    classes: fancy
    label: 'My Select Element'
    help: 'Use the disabled key:value to display but disable a particular option'
    options:
        option1:
          value: 'Option 1'
        option2:
          value: 'Option 2'
        option3:
          disabled: true
          value: 'Option 3'
[/codesh]

[div class="table table-keycol"]
| Attribute  | Description                                         |
| :-----     | :-----                                              |
| `options`  | An array of key-value options that will be allowed. The key will be submitted by the form. |
| `multiple` | Allow the form to accept multiple values.           |
[/div]

If you set `multiple` to true, you need to add
```
pages.order.by:
  validate:
    type: array
```
Otherwise the array of selected values will not be saved correctly.

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
[codesh=yaml line-numbers="true"]
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
[/codesh]

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


[codesh=yaml line-numbers="true"]
test:
    type: spacer
    title: A title
    title_type: h2
    text: Some text
    underline: true
[/codesh]

[div class="table table-keycol"]
| Attribute   | Description                                            |
| :-----      | :-----                                                 |
| `title`     | add a title to the form                             |
| `title_type`  | Define the HTML tag for the title (e.g., `h1`, `h2`, `h3`, etc.). Defaults to `h3` if not specified. |
| `text`      | Add some text. If title is set, add it after the title |
| `underline` | boolean, add a `<hr>` tag if positive                  |
[/div]

---

### Switch Field

The **switch** field type provides an ON/OFF toggle using the same logic as a checkbox.  
It is functionally identical to a checkbox but offers clearer semantics and a modern toggle-style UI.

#### Example

[codesh=yaml line-numbers="true"]
header.enable_feature:
  type: switch
  label: Enable Feature
  default: 1
  highlight: 1
  options:
    1: Enabled
    0: Disabled
[/codesh]

This creates an ON/OFF switch where:
- `1` = ON  
- `0` = OFF  

#### Specific Attributes

[div class="table table-keycol"]
| Attribute | Description |
| :----- | :----- |
| type | Defines the field type as `switch` |
| default | Initial value (`1` or `0`) |
| highlight | Pre-selected value highlighted in the admin UI |
| options | Text labels for ON/OFF values |
[/div]

#### Common Attributes Allowed

The Switch field supports **all the same common attributes as Checkbox**, including validation:

[div class="table"]
| Common Attributes Allowed |
| :----- |
| autofocus |
| classes |
| default |
| disabled |
| id |
| label |
| name |
| novalidate |
| outerclasses |
| size |
| style |
| validate.required |
| validate.pattern |
| validate.message |
[/div]

---

### Tabs / Tab Fields

![Tabs](tabs_field_bp.gif)

The `tabs` and `tab` field types are used to divide the contained form fields in tabs.

Example:

[codesh=yaml line-numbers="true"]
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
[/codesh]


[div class="table table-keycol"]
| Attribute | Description           |
| :-----    | :-----                |
| `active`  | The active tab number |
[/div]

---

### Tel Field

The `tel` field type is used to present a text input field that accepts a  number, using the [tel HTML5 input](http://html5doctor.com/html5-forms-input-types/#input-tel).

Example:
[codesh=yaml line-numbers="true"]
header.phone:
  type: tel
  label: 'Your Phone Number'
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `minlength` | minimum text length |
| `maxlength`  | maximum text length  |
| `validate.min` | same as minlength |
| `validate.max`  | same as maxlength  |
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

### Text Field

![Text Field](text_field.gif)

The `text` field is used to present a text input field.

Example:

[codesh=yaml line-numbers="true"]
header.title:
  type: text
  autofocus: true
  label: PLUGIN_ADMIN.TITLE
  minlength: 10
  maxlength: 255
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `prepend` | prepend some text or HTML to the front of a field |
| `append`  | append some text or HTML to the end of a field  |
| `minlength` | minimum text length |
| `maxlength`  | maximum text length  |
| `validate.min` | same as minlength |
| `validate.max`  | same as maxlength  |
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
[codesh=yaml line-numbers="true"]
header.content:
  type: textarea
  autofocus: true
  label: PLUGIN_ADMIN.CONTENT
  minlength: 10
  maxlength: 255
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                                     |
| :-----    | :-----                                                          |
| `rows`    | Add a rows attribute with the value associated with this property |
| `cols`    | Add a cols attribute with the value associated with this property |
| `minlength` | minimum text length |
| `maxlength`  | maximum text length  |
| `validate.min` | same as minlength |
| `validate.max`  | same as maxlength  |
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

### Time Field

The **time** field type allows users to select a time using the native HTML5 `<input type="time">` element.  
This field is ideal for events, scheduling, or any scenario requiring a `HH:MM` time format.

This template is used when the value is displayed in **list or summary views** (such as in the Admin panel), formatting the time as `3:45 PM` instead of `15:45`.

#### Example

[codesh=yaml line-numbers="true"]
header.event_time:
  type: time
  label: Event Time
  default: "14:30"
  placeholder: "HH:MM"
  help: "Select the event time"
  step: 60   # Minute interval (optional)
  validate:
    required: true
[/codesh]

#### Specific Attributes

[div class="table table-keycol"]
| Attribute | Description |
| :----- | :----- |
| type | Defines the field type as `time` |
| default | Initial value in `HH:MM` format |
| placeholder | Suggestive text shown when empty |
| step | Time interval in seconds (e.g. `60` = 1 minute) |
[/div]

#### Common Attributes Allowed

The Time field supports the same common attributes as the Checkbox field:

[div class="table"]
| Common Attributes Allowed |
| :----- |
| autofocus |
| classes |
| default |
| disabled |
| id |
| label |
| name |
| novalidate |
| outerclasses |
| size |
| style |
| validate.required |
| validate.pattern |
| validate.message |
[/div]

---

### Toggle Field

![Toggle Field](toggle_field_bp.gif)

The `toggle` field type is an on/off kind of input, with configurable labels.

Example:

[codesh=yaml line-numbers="true"]
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
[/codesh]


[div class="table table-keycol"]
| Attribute   | Description                                                                                                                       |
| :-----      | :-----                                                                                                                            |
| `highlight` | The key of the option to highlight (set green when selected)                                                                      |
| `options`   | The list of key-value options                                                                                                     |
| `markdown`  | When `true`, the option labels are processed as markdown and may contain HTML. Otherwise they are escaped and rendered as text. |
[/div]

[div class="table"]
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
[/div]

---

### Unique Id Field

The **uniqueid** field type generates a unique identifier for a form.  
It is rendered as a hidden input and is primarily used internally to differentiate form submissions.

> [!NOTE]
> The default form template already outputs this hidden input for you, so you rarely need to add a `uniqueid` field by hand. It is only useful when you are building a custom form template that does not include it.

#### Example

[codesh=yaml line-numbers="true"]
header.unique_form_id:
  type: uniqueid
[/codesh]

> [!NOTE]
> You generally do not need to set a label or default value for this field; it is automatically generated and hidden.

#### Specific Attributes

[div class="table table-keycol"]
| Attribute | Description |
| :----- | :----- |
| type | Defines the field type as `uniqueid` |
| name | The input field name (default is `__unique_form_id__`) |
| value | Automatically generated unique value |
[/div]

#### Common Attributes Allowed

Since this is a hidden/internal field, common attributes are minimal:

[div class="table"]
| Common Attributes Allowed |
| :----- |
| id |
| name |
| classes |
| disabled |
| outerclasses |
| style |
[/div]

---

### Url Field

The `url` field type is used to present a text input field that accepts an URL, using the [url HTML5 input](http://html5doctor.com/html5-forms-input-types/#input-url).

Example:
[codesh=yaml line-numbers="true"]
header.url:
  type: url
  label: 'Your Website Url'
[/codesh]

[div class="table table-keycol"]
| Attribute | Description                                       |
| :-----    | :-----                                            |
| `minlength` | minimum text length |
| `maxlength`  | maximum text length  |
| `validate.min` | same as minlength |
| `validate.max`  | same as maxlength  |
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

### Value Field

The **value** field type is used to display a non-editable value within a form.  
It does not render an input for the user to type; instead, it outputs a value according to optional formatting rules.

#### Example

[codesh=yaml line-numbers="true"]
header.display_name:
  type: value
  label: Display Name
  default: "Guest"
  filter: raw
[/codesh]

Optional example using `date`:

[codesh=yaml line-numbers="true"]
header.submission_date:
  type: value
  label: Submitted On
  default: "2025-11-25"
  filter: date
[/codesh]

#### Specific Attributes

[div class="table table-keycol"]
| Attribute | Description |
| :----- | :----- |
| type | Defines the field type as `value` |
| default | Default value to display if none is provided |
| options | Optional mapping of stored values to display labels |
| filter | Optional formatting filter: `'date'`, `'raw'`, or default plain text |
[/div]

#### Common Attributes Allowed

[div class="table"]
| Common Attributes Allowed |
| :----- |
| id |
| classes |
| label |
| name |
| style |
| outerclasses |
[/div]

---

### Week Field

The **week** field type allows users to select a week number within a specific year.  
It is rendered as an HTML `<input type="week">`, enabling browsers that support it to display a week picker.

#### Example

[codesh=yaml line-numbers="true"]
header.billing_week:
  type: week
  label: Billing Week
  placeholder: "Select week"
  default: "2025-W48"
[/codesh]

Human-readable output (showing the first day of the week):

[codesh=twig line-numbers="true"]
{% if page.header.billing_week %}
    {# Append '-1' to get the Monday of the week #}
    {% set week_start = page.header.billing_week ~ '-1' %}
    <p>Week starts on: {{ week_start|date("F j, Y") }}</p>
{% endif %}
[/codesh]

> Example: If `billing_week` is `2025-W48`, the output will be `Week starts on: November 24, 2025`.

#### Specific Attributes

[div class="table table-keycol"]
| Attribute | Description |
| :----- | :----- |
| type | Defines the field type as `week` |
| default | Optional default value in `YYYY-Www` format |
| placeholder | Optional text shown when the field is empty |
[/div]

#### Common Attributes Allowed

[div class="table"]
| Common Attributes Allowed |
| :----- |
| autofocus |
| classes |
| default |
| disabled |
| id |
| label |
| name |
| novalidate |
| outerclasses |
| size |
| style |
| validate.required |
| validate.pattern |
| validate.message |
[/div]

## Currently Undocumented Fields

[div class="table table-keycol"]
| Field                                             | Description                                                               |
| :-----                                            | :-----                                                                    |
| **Datetime**                                      |                                                                           |
| **Signature**                                     |                                                                           |
[/div]
