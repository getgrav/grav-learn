---
title: Reference: Available Form Fields
taxonomy:
    category: docs
---

## Available form fields for use in the admin

Plugins and themes can take advantage of the built-in form fields, or build their own.

Here's a list of the available form fields:

### Common form fields

- **Captcha**: a captcha antispam field, using reCAPTCHA
- **Checkbox**: a simple checkbox
- **Checkboxes**: a serie of checkboxes
- **Date**: a date selection field
- **Datetime**: a date and time selection field
- **Display**: a text or instructions field (not an input field)
- **Email**: an email field, with validation
- **File**: a file upload field, with validation
- **Hidden**: an hidden field
- **Password**: a password field
- **Radio**: a radio input type
- **Select**: a select field
- **Spacer**: used to add a title, text or an horizontal line to the form
- **Text**: a simple text field
- **Textarea**: a textarea

### Special form fields available only in admin

- **Array**: a special field used for example in the Page Metadata. Allows the user to add multiple key-value rows.
- **Ignore**: used to remove unused fields when extending from another blueprint
- **Columns**: used to break the form in multiple columns
- **Column**: used to show a single column (used with the `Columns` field)
- **Dateformat**: a special select that renders the current datetime in the passed formats
- **Display**: simply shows a text value, with no input field
- **File**: in Admin, File is specialized to be used in Plugin and Theme configurations (Blueprints). Handles uploading a file to a location and deleting it, and removing it from the theme / plugin configuration
- **Frontmatter**: show the page frontmatter in a raw format
- **List**: similar to `Array`, shows a list of items, but without a key
- **Markdown**: show a markdown editor
- **PageMediaSelect**: shows a select with all the page media. Used in Pages blueprints to let the user choose a media file to be assigned to a field.
- **Pages**: shows a list of the site pages
- **Section**: used to divide a setting page into sections; each section comes with a title
- **Selectize**: a hybrid of a textbox and a select box. Mostly useful for tagging and other element picking fields.
- **Tabs**: divides the settings in a list of tabs
- **Tab**: used by the `Tabs` field to render a tab
- **Taxonomy**: a special select preconfigured to select one or more taxonomies
- **Toggle**: a on/off kind of input, with configurable labels
