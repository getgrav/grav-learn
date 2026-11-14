---
title: Field Reference
taxonomy:
    category: docs
description: Every field in the Forms Pro palette - the keys all input fields share, the Form plugin's fields in brief, each Pro field in detail with the YAML it stores, and layout and system fields.
---

# Field Reference

The palette offers 49 field types: 38 from the Form plugin and 11 Pro fields that Forms Pro adds. This page lists them with the YAML key behind each setting, so you can build in the builder or write the file by hand. Property names in bold are the labels you see in the property panel.

A field in the YAML is a map under `fields:`, keyed by its **Field Name**:

```yaml
fields:
  email:
    type: email
    label: Email
    validate:
      required: true
```

## Keys every input field shares

Most input fields take these keys. The builder shows them in the **General**, **Validation** and **Advanced** sections.

| Key | Label | What it does |
|---|---|---|
| `label` | **Label** | The text shown above the field. It also names the answer in entries and emails. |
| `help` | **Help Text** | A hint shown with the field |
| `display_label` | **Show Label** | Set to `false` to hide the label. It defaults to `true`. |
| `validate.required` | **Required** | The visitor must fill the field in |
| `validate.message` | **Validation Message** | Shown when the field fails validation |
| `classes` | **Input Classes** | CSS classes on the input |
| `outerclasses` | **Wrapper Classes** | CSS classes on the element around the field |
| `labelclasses` | **Label Classes** | CSS classes on the label |
| `id` | **Element ID** | The input's `id` |
| `size` | **Field Size** | `large`, `x-small`, `medium`, `long` or `small` |
| `disabled`, `readonly`, `autofocus` | **Disabled**, **Read Only**, **Autofocus** | The matching HTML attributes |
| `autocomplete` | **Autocomplete** | `on` or `off` |
| `conditions` | **Conditional Visibility** | Rules that show or hide the field ([Conditional logic](../conditional-logic)) |

Layout fields take the class and ID keys and `conditions`, but no label or validation.

## Fields from the Form plugin

These work as the [Form plugin documents them](/2/forms/forms/fields-available). The table lists the keys the builder offers. Anything else the Form plugin supports can still be written by hand.

### Basic

| Type | Palette name | Keys |
|---|---|---|
| `text` | **Text** | `placeholder`, `default`, `prepend`, `append`, `minlength`, `maxlength`, `validate.pattern` |
| `textarea` | **Textarea** | `placeholder`, `default`, `rows`, `cols`, `minlength`, `maxlength` |
| `email` | **Email** | The same as `text`. The format is checked. |
| `url` | **URL** | The same as `text`. The format is checked. |
| `tel` | **Phone** | The same as `text`. For a phone number with a country selector, use the Pro `pro-phone` field. |
| `password` | **Password** | The same as `text`. The value is masked and not stored by default. |
| `number` | **Number** | `placeholder`, `default`, `validate.min`, `validate.max`, `validate.step` |

> [!TIP]
> A Number field only accepts whole numbers in the browser until you set a step. For prices and other decimals, set `validate.step` to `0.01` (or `any`). The limits go under `validate`: `min`, `max` and `step` written at the top level of the field are ignored.

```yaml
price:
  type: number
  label: Price
  validate:
    min: 0
    step: 0.01
```

### Choice

| Type | Palette name | Keys |
|---|---|---|
| `select` | **Dropdown** | `options` (a map of value to label), `placeholder`, `default`, `multiple` |
| `select_optgroup` | **Grouped Dropdown** | `options` as a list of groups, `default` |
| `radio` | **Radio Buttons** | `options`, `default` |
| `checkbox` | **Checkbox** | `default` (set to `1` to start checked) |
| `checkboxes` | **Checkboxes** | `options`, `use` (`values` or `keys`, what is stored) |
| `switch` | **Switch** | `options`, `default`, `highlight` |
| `toggle` | **Toggle** | `options`, `default`, `highlight` |

```yaml
topic:
  type: select
  label: Topic
  placeholder: Choose one
  options:
    sales: Sales
    support: Support
```

The stored answer is the option key (`sales`), and entries and emails show its label (`Sales`). A **Dropdown** with **Allow Multiple** switched on (`multiple: true`) stores a list. Logic rules compare against the keys. A grouped dropdown writes its options as a list of groups:

```yaml
region:
  type: select_optgroup
  label: Region
  options:
    - Europe:
        uk: United Kingdom
        de: Germany
    - Americas:
        us: United States
        ca: Canada
```

### Date and time

| Type | Palette name | Keys |
|---|---|---|
| `date` | **Date** | `default`, `validate.min`, `validate.max` (`YYYY-MM-DD`) |
| `datetime` | **Date & Time** | `default`, `validate.min`, `validate.max` (`YYYY-MM-DDTHH:MM`) |
| `time` | **Time** | `default` (`HH:MM`) |
| `month` | **Month** | `default` (`YYYY-MM`) |
| `week` | **Week** | `default` (`YYYY-Www`, such as `2026-W27`) |

These use the browser's own pickers. For a calendar with a chosen format and limits, see the Date Picker and Time Picker below.

### Uploads

| Type | Palette name | Keys |
|---|---|---|
| `file` | **File Upload** | `multiple`, `accept`, `filesize`, `limit`, `destination`, `random_name`, `avoid_overwriting` |
| `filepond` | **FilePond Upload** | The same, plus `filepond.resize_width`, `filepond.resize_height` and `filepond.resize_quality` |
| `avatar` | **Avatar** | The same as `file`, plus `img_classes` |

```yaml
attachment:
  type: file
  label: Attachment
  destination: 'user-data://uploads'
  random_name: true
  avoid_overwriting: true
  filesize: 2
  accept:
    - 'image/*'
    - application/pdf
```

`accept` lists MIME types, `filesize` is in megabytes, and `limit` is the most files allowed when `multiple` is on. A new File Upload field starts with `destination: 'user-data://uploads'` and both name options on. The form needs the **Process Uploads** action (`upload: true`) to move the files from where they wait to the destination (see [Actions and notifications](../actions-and-notifications#data-actions)). [Entries](../entries#files) covers how uploads show up in an entry.

> [!WARNING]
> Write the destination with `user-data://`, not `user://data/...`. On Grav 2 a destination under `user://data` fails with a read-only stream error when the form is sent.

> [!WARNING]
> A required File Upload field is checked twice: in a [multi-step form](../multi-step-forms), **Next** waits until a file has finished uploading, and the server refuses a form that arrives without one. This needs Form plugin 9.2.1 or newer, which Forms Pro requires.

### Layout and other fields

| Type | Palette name | Keys |
|---|---|---|
| `columns`, `column` | **Columns** | One to six `column` children |
| `fieldset` | **Fieldset** | `legend` |
| `tabs`, `tab` | **Tabs** | `active` on the group, `title` on each tab |
| `section` | **Section** | `title`, `text`, `underline` |
| `spacer` | **Spacer** | `title`, `text`, `underline` |
| `display` | **Display Text** | `label`, `content`, `markdown` |
| `conditional` | **Conditional Group** | `condition`, a server-side Twig expression |
| `array` | **Array** | `value_only`, `placeholder_key`, `placeholder_value`, `value_type` |
| `color` | **Color** | `default` |
| `range` | **Range Slider** | `default`, `validate.min`, `validate.max`, `validate.step` |
| `signature` | **Signature** | `width`, `height`, `pen_color`, `background_color` |
| `hidden` | **Hidden** | `default` is the fixed value that is submitted |
| `ignore` | **Ignore** | Renders nothing, and its value is dropped on submit |
| `uniqueid` | **Unique ID** | A hidden per-form identifier |
| `honeypot` | **Honeypot** | A hidden bot trap. See [Spam protection](../spam-protection). |
| `captcha` | **CAPTCHA** | A spam challenge. See [Spam protection](../spam-protection). |

A **Conditional Group** is not the same as the visibility rules on the Logic tab. Its `condition` is a Twig expression evaluated on the server when the form is rendered, such as `config.site.title == 'Demo'`, and it shows or hides the whole group for everyone. Rules on the Logic tab react to what the visitor types.

A **Signature** field stores a PNG as a data URL, and the server refuses anything else or anything over 512 KB. It stores an image, so it is shown as a picture in entries.

## Pro fields

The eleven Pro fields are marked with a sparkle in the palette. Each one below shows the YAML and what it stores.

### Name field

`pro-name` is a name in parts. Switch the parts on and off under **Options**.

```yaml
full_name:
  type: pro-name
  label: Name
  subfields:
    prefix: true
    first: true
    middle: false
    last: true
    suffix: false
  placeholder_first: First
  placeholder_last: Last
  validate:
    required: true
```

| Key | Label | Default |
|---|---|---|
| `subfields.prefix` | **Show Prefix (Mr/Mrs/etc)** | off |
| `subfields.first` | **Show First Name** | on |
| `subfields.middle` | **Show Middle Name** | off |
| `subfields.last` | **Show Last Name** | on |
| `subfields.suffix` | **Show Suffix (Jr/Sr/etc)** | off |
| `placeholder_first`, `placeholder_middle`, `placeholder_last`, `placeholder_suffix` | The matching placeholders | none |

The prefix menu offers Mr., Mrs., Ms. and Dr., and the server refuses any other value. **Required** asks for the first and last name, for the parts that are shown. The answer is stored as a map, and entries and emails show it as `Dr Grace Hopper`:

```yaml
full_name:
  prefix: Dr
  first: Grace
  last: Hopper
```

In a merge tag, reach one part with `{{ form.value.full_name.first }}`. In the `subfields` map, first and last name show unless you set them to `false`, and the prefix, middle name and suffix show only when set to `true`. The builder always writes the map out in full.

### Address

`pro-address` collects an address in parts.

```yaml
home:
  type: pro-address
  label: Address
  layout: inline
  subfields:
    street: true
    street2: true
    city: true
    state: true
    zip: true
    country: false
  placeholder_street: 123 Main St
```

| Key | Label | Default |
|---|---|---|
| `subfields.street` | **Show Street Address** | on |
| `subfields.street2` | **Show Address Line 2** | off |
| `subfields.city` | **Show City** | on |
| `subfields.state` | **Show State/Province** | on |
| `subfields.zip` | **Show Postal Code** | on |
| `subfields.country` | **Show Country** | off |
| `placeholder_street`, `placeholder_street2`, `placeholder_city`, `placeholder_state`, `placeholder_zip` | The matching placeholders | none |
| `layout` | **Layout** | `stacked`, one part per row. `inline` puts city, state and postal code on one row. |

**Required** asks for the street and the city, for the parts that are shown. The answer is stored as a map with the keys `street`, `street2`, `city`, `state`, `zip` and `country`. Country is a text box, not a list.

### Phone

`pro-phone` is a phone number with an optional country selector.

```yaml
mobile:
  type: pro-phone
  label: Mobile
  show_country_code: true
  default_country: GB
  placeholder: '07700 900123'
```

| Key | Label | Default |
|---|---|---|
| `placeholder` | **Placeholder** | none |
| `show_country_code` | **Show Country Code** | off |
| `default_country` | **Default Country** | `US`. The choices are `US`, `CA`, `GB`, `AU`, `DE` and `FR`. |
| `pattern` | **Validation Pattern (Regex)** | none |

With the country selector the answer is a map:

```yaml
mobile:
  country: US
  number: '555 010 4477'
```

The number must hold at least seven digits, unless you set a `pattern`, in which case it must match the pattern. The pattern is written without delimiters, such as `^\+?[0-9 ]{7,15}$`. Entries and emails show the dial code in front, as `+1 555 010 4477`.

Without the country selector the answer is the number as plain text, `'555 010 4477'`. Either way it shows as readable text in emails, `{{ all_fields }}`, the entry view and the CSV export.

### Rating

`pro-rating` is a row of stars, hearts, thumbs or circles.

```yaml
satisfaction:
  type: pro-rating
  label: How did we do?
  max: 5
  icon: heart
  allow_half: true
  show_value: true
```

| Key | Label | Default |
|---|---|---|
| `max` | **Maximum Rating** | `5`, from 1 to 10 |
| `icon` | **Icon Style** | `star`. Also `heart`, `thumbs-up` and `circle`. |
| `allow_half` | **Allow Half Ratings** | off |
| `show_value` | **Show Numeric Value** | on |
| `validate.min` | **Minimum Required Rating** | none. The server refuses a rating below it with `Rating must be at least 3.` |

The answer is a number from 0 to the maximum. A rating that was never set is `0`. An optional rating left unset passes whatever the minimum is, and a required one is refused until the visitor picks at least one star. The minimum applies to any rating the visitor gives.

### Slider

`pro-slider` is a range slider that shows its value.

```yaml
budget:
  type: pro-slider
  label: Budget
  min: 0
  max: 5000
  step: 250
  default: 1000
  prefix: '$'
```

| Key | Label | Default |
|---|---|---|
| `min`, `max`, `step` | **Minimum Value**, **Maximum Value**, **Step Increment** | `0`, `100`, `1` |
| `default` | **Default Value** | the minimum |
| `prefix`, `suffix` | **Value Prefix**, **Value Suffix** | none |
| `show_value` | **Show Current Value** | on |
| `show_labels` | **Show Min/Max Labels** | on |

The server refuses a value outside the minimum and maximum.

### Rich Text

`pro-richtext` is a small formatted-text editor that runs from the plugin's own files, with no outside editor library.

```yaml
notes:
  type: pro-richtext
  label: Notes
  toolbar: standard
  min_height: 120px
```

| Key | Label | Default |
|---|---|---|
| `toolbar` | **Toolbar Style** | `standard`. `basic` has bold, italic, underline and lists. `standard` adds headings, links and quotes. `full` has every option. |
| `min_height` | **Minimum Height** | `150px` |
| `max_height` | **Maximum Height** | none |
| `placeholder` | **Placeholder** | none |

The answer is HTML, and the server cleans it before anything uses it. Only `p`, `br`, `strong`, `em`, `b`, `i`, `u`, `s`, `ul`, `ol`, `li`, `a`, `h1` to `h6`, `blockquote`, `code`, `pre` and `span` survive. Every attribute is removed except `href` on a link, and a link only keeps its address when it starts with `http:`, `https:`, `mailto:`, `tel:`, `/` or `#`. Scripts, styles and frames are removed with their content. In emails and entries the cleaned HTML is shown formatted, and in a plain-text email it becomes text.

### Date Picker

`pro-datepicker` is a calendar date picker.

```yaml
visit_date:
  type: pro-datepicker
  label: Visit date
  format: Y-m-d
  min_date: today
  max_date: '2027-12-31'
  disable_weekends: true
```

| Key | Label | Default |
|---|---|---|
| `format` | **Date Format** | `Y-m-d`. Also `m/d/Y`, `d/m/Y`, `F j, Y`, `M j, Y` and `j F Y`. |
| `min_date`, `max_date` | **Minimum Date**, **Maximum Date** | none. A date as `YYYY-MM-DD`, or `today`. |
| `disable_weekends` | **Disable Weekends** | off |
| `enable_time` | **Include Time Selection** | off |
| `time_24hr` | **Use 24-Hour Format** | off. Applies when time selection is on. |
| `inline` | **Show Inline Calendar** | off |
| `placeholder` | **Placeholder** | `Select date...` |

> [!IMPORTANT]
> Forms Pro does not include a calendar library. The calendar, the format, the weekend rule and the inline mode use Flatpickr, which has to be loaded on the page by your theme or another plugin. When it is not there, the field falls back to the browser's own date input (or date and time input, with time selection on), which ignores the format, **Disable Weekends** and **Show Inline Calendar**. The server checks the limits either way and accepts the browser's `YYYY-MM-DD` form as well as the chosen format.

The server refuses a date the calendar does not have, and a date before `min_date` or after `max_date`. The answer is stored as typed, in the chosen format.

### Time Picker

`pro-timepicker` is a time picker.

```yaml
visit_time:
  type: pro-timepicker
  label: Visit time
  time_24hr: true
  minute_increment: 15
  min_time: '09:00'
  max_time: '17:00'
```

| Key | Label | Default |
|---|---|---|
| `time_24hr` | **Use 24-Hour Format** | off, so times read `2:30 PM` |
| `minute_increment` | **Minute Increment** | `5`. Also `1`, `10`, `15`, `30` and `60`. |
| `min_time`, `max_time` | **Minimum Time**, **Maximum Time** | none. `HH:MM`. |
| `placeholder` | **Placeholder** | `2:30 PM`, or `14:30` with 24-hour times |

Like the Date Picker, it uses Flatpickr when the page loads it and the browser's time input when not. In the browser input the minute step, the limits and the 12-hour format do not apply. The server accepts `HH:MM`, `HH:MM:SS` and, for 12-hour fields, `h:mm AM`, and refuses anything else. It does not check `min_time` and `max_time`.

### Calculation

`pro-calculation` is a read-only value worked out from a formula. It is covered in [Calculations](../calculations) and the [Formula reference](../formula-reference).

```yaml
total:
  type: pro-calculation
  label: Total
  formula: 'quantity * price'
  prefix: '$'
```

### Recipients

`pro-recipients` lets the visitor choose who receives the email, without any address reaching the browser. How to use the choice in an email is covered in [Actions and notifications](../actions-and-notifications#route-mail-to-a-recipient-the-visitor-picks).

```yaml
department:
  type: pro-recipients
  label: Send to
  display: select
  recipients:
    sales:
      label: Sales
      email: sales@example.com
    support:
      label: Support
      email: support@example.com
```

| Key | Label | Meaning |
|---|---|---|
| `recipients` | **Recipients** | The choices, as a map. Each key is what the form stores for that choice (`sales`). Each choice has a `label`, shown to the visitor, and an `email`, which can hold several addresses separated by commas. |
| `display` | none | How the choices look: `select` (a dropdown, the default), `radio` (radio buttons) or `checkbox` (checkboxes, which need `multiple: true`). Set in YAML. |
| `multiple` | none | Off by default. With `true` the visitor can choose several entries, as a multiple-choice dropdown or, with `display: checkbox`, as checkboxes. Set in YAML. |
| `placeholder` | **Placeholder** | The empty first item of the dropdown. Only for `select` without `multiple`. |

The answer stored with the entry is the choice's key, or a list of keys with `multiple: true`. A visitor can only send one of the keys, and any other value is refused. Use short keys without spaces, because they are what shows in `{{ form.value.department }}`. Entries, emails and the CSV export show the labels of the chosen entries, joined with commas.

The builder has a **Recipients** list editor in the property panel for adding choices, labels and addresses.

With several choices, the notification goes to the addresses of every chosen entry. The addresses still come only from the form's definition on the server, never from what the visitor posts.

### Repeater

`pro-repeater` lets visitors add the same group of fields as many times as they need, such as the lines of an order or the people on a booking.

```yaml
attendees:
  type: pro-repeater
  label: Attendees
  min: 1
  max: 5
  add_label: Add attendee
  item_label: Attendee
  sortable: true
  fields:
    attendee_name:
      type: text
      label: Name
      validate:
        required: true
    attendee_email:
      type: email
      label: Email
```

| Key | Label | Default |
|---|---|---|
| `min` | **Minimum Rows** | `0`. The form always shows at least one row. |
| `max` | **Maximum Rows** | `0`, which means no limit |
| `add_label` | **Add Button Text** | `Add Item` |
| `item_label` | **Item Label** | `Item`, numbered per row as `Item 1`, `Item 2` |
| `sortable` | **Allow Reordering** | on |

Drag the fields that repeat into the Repeater on the canvas. They can be any fields except another Repeater, Columns, Tabs or steps. The answer is a list of maps, one per row, keyed by the fields' names:

```yaml
attendees:
  -
    attendee_name: Grace
    attendee_email: grace@example.test
  -
    attendee_name: Ada
    attendee_email: ''
```

The server checks every row against the fields it holds: **Required** fields must be filled, choices must be one of the options, numbers must be numbers and within their limits, and Pro fields get their usual checks. A problem is reported with its row (`Attendees, row 2: Name is required`). A row with a key the Repeater has no field for is refused. Entries show a Repeater as a table, and emails as a readable list.

A Calculation inside a Repeater is worked out for each row. See [Calculations](../calculations#calculations-in-a-repeater).

### Steps

`pro-steps` and `pro-step` split a form into pages. They are not in the palette: the builder adds them when you choose **Convert to multi-step**. See [Multi-step forms](../multi-step-forms).

## Related

- [The builder](../the-builder)
- [Conditional logic](../conditional-logic)
- [Calculations](../calculations)
- [Extending](../extending) for adding your own fields
