---
title: Reference: Available Form Fields
taxonomy:
    category: docs
---

## Available Form Fields for Use in the Admin

Plugins and themes can take advantage of these built-in form fields in their **blueprints.yaml** file. These fields are all supported directly within Grav, and can be implemented very easily.

Here's a list of the available form fields:

### Common Form Fields

- **Captcha**: an anti-spam Captcha field, using reCAPTCHA
- **Checkbox**: a simple check box
- **Checkboxes**: a series of check boxes
- **Date**: a date selection field
- **Datetime**: a date and time selection field
- **Display**: a simple field for text or instructions (not an input field)
- **Email**: an email field, with validation
- **File**: a file upload field, with validation
- **Hidden**: a hidden field
- **Password**: a password field
- **Radio**: a radio input type
- **Select**: a select field
- **Spacer**: used to add a title, text or an horizontal line to the form
- **Text**: a simple text field
- **Textarea**: a text area

### Special Form Fields Available Exclusively in the Admin

- **Array**: a special field used for example in the **page metadata** allowing the user to add multiple key-value rows.
- **Ignore**: used to remove unused fields when extending from another blueprint
- **Columns**: used to break the form in multiple columns
- **Column**: used to show a single column (used with the `Columns` field)
- **Dateformat**: a special select that renders the current date/time in the passed formats
- **Display**: simply shows a text value, with no input field
- **File**: in Admin, **File** is specialized to be used in plugin and theme configurations (blueprints). Handles uploading a file to a location and deleting it, and removing it from the theme / plugin configuration
- **Frontmatter**: show the page frontmatter in a raw format
- **List**: similar to `Array`, shows a list of items, but without a key
- **Markdown**: show a markdown editor
- **PageMediaSelect**: shows a select with all the page media. Used in Pages blueprints to let the user choose a media file to be assigned to a field.
- **Pages**: shows a list of the site pages
- **Section**: used to divide a setting page into sections; each section comes with a title
- **Selectize**: a hybrid of a text box and a select box. Mostly useful for tagging and other element picking fields.
- **Tabs**: divides the settings in a list of tabs
- **Tab**: used by the `Tabs` field to render a tab
- **Taxonomy**: a special select preconfigured to select one or more taxonomies
- **Toggle**: a on/off kind of input, with configurable labels
