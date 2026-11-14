---
title: Getting Started
taxonomy:
    category: docs
description: Build a contact form, put it on a page, send a test message, read the entry and add an email notification.
---

# Getting Started

This page builds a small contact form from nothing: you create it, add four fields, put it on a page, send a test message and read it in Admin2. It ends with an email notification and a look at the YAML the builder wrote.

## Before you begin

Forms Pro is installed and your account has the Forms Pro permissions (see [Installation](../installation)). Notifications need the Email plugin configured to send mail.

## Create the form

1. Open **Forms Pro** in the Admin2 sidebar. The **Forms** section lists every form, newest first.
2. Click **New Form**, type a **Title** such as `Contact Us` and click **Create**.

The title becomes the form's name: `Contact Us` is saved as `contact-us`, and that name is what you use to embed it. The builder opens on the **Build** tab with a starter form:

- A **Honeypot** field, a hidden trap for bots. It shows on the canvas as a small `honeypot: honeypot` chip and never shows to visitors.
- A **Submit** button.
- Two actions, which you will see on the **Actions** tab: **Store Submission**, which saves each submission as an entry, and **Message**, which shows `Thank you! Your submission has been received.`

## Add the fields

The palette on the left lists every field, grouped into Basic, Choice, Date & Time, Uploads, Layout, Pro Fields and more. Click a field to add it above the buttons, or drag it to the exact spot. The search box at the top filters the palette.

1. Under **Pro Fields**, click **Name**. In the panel on the right, set **Label** to `Your name`, open **Validation** and switch on **Required**.
2. Under **Basic**, click **Email**. Switch on **Required** here too.
3. Under **Choice**, click **Dropdown**. Set **Label** to `Topic`, and set **Field Name** to `topic`. Open **Options** and edit the three options.
4. Under **Basic**, click **Textarea**. Set **Label** to `Message`, set **Field Name** to `message` and switch on **Required**.

The **Field Name** is the key the answer is stored under, and the name that merge tags and formulas use. A new field starts with a name taken from its type (`textarea`, `select`, `email`), so give the ones you will refer to a clear name. A name uses lowercase letters, numbers and underscores, and starts with a letter. The label is free text.

Click **Save** at the top right, or press `Cmd+S` (`Ctrl+S` on Windows and Linux). The **•** next to the form title means there are unsaved changes.

## Put the form on a page

Open the **Embed** tab. It shows three ways to place the form, each with a **Copy** button. The quickest is the shortcode. Paste it into the content of any page:

```markdown
[forms-pro name="contact-us" /]
```

Save the page and open it on your site. The form works as soon as it is on a page. [Embedding](../embedding) covers the Twig function and the page header, and the Shortcode Core plugin the shortcode needs.

## Send a test and read the entry

Fill in the form and send it. You see the confirmation message, and the form stays on the page with your answers in it. Add a **Reset Form** action, or switch to a **Redirect** action, if you want a clean form or a thank-you page after sending (see [Actions and notifications](../actions-and-notifications#response-actions)).

Back in Admin2, the **Forms Pro** item in the sidebar now shows a badge with the number of unread entries. Open the form and click its **Entries** tab. Your submission is listed with a **New** status. Click it to read every answer under its label. Opening an entry marks it **Read**. [Entries](../entries) covers searching, stars, notes and export.

## Send yourself an email

1. Open the **Actions** tab and click **Add action**.
2. Choose **Notifications**, then click **Add notification**.
3. Enter an address in **To** and a **Subject**. Both are required.
4. Leave **Body** empty to send every answer in a table, or write your own with merge tags such as `{{ form.value.name.first }}`.
5. Click **Save**, then send another test.

A subject like `New message from {{ form.value.name.first }}` fills in the visitor's first name. The braces button next to each box lists the tags you can insert. [Actions and notifications](../actions-and-notifications) covers merge tags, routing mail to a person the visitor picks, and sending only when a condition is met.

## What the builder wrote

Each form is one YAML file, here at `user/data/forms-pro/forms/contact-us.yaml`. This is what the builder saved for the form above:

```yaml
title: 'Contact Us'
type: forms-pro
fields:
  honeypot:
    type: honeypot
  name:
    type: pro-name
    label: 'Your name'
    subfields:
      first: true
      last: true
    validate:
      required: true
  email:
    type: email
    label: Email
    validate:
      required: true
  topic:
    type: select
    label: Topic
    options:
      option1: 'Option 1'
      option2: 'Option 2'
      option3: 'Option 3'
  message:
    type: textarea
    label: Message
    validate:
      required: true
buttons:
  -
    type: submit
    value: Submit
process:
  -
    submission: true
  -
    message: 'Thank you! Your submission has been received.'
name: contact-us
builder:
  schema: 1
  created: 1794628114
  updated: 1794628307
  fieldMeta:
    topic:
      _name_locked: true
    message:
      _name_locked: true
```

The `fields`, `buttons` and `process` keys are the ones the Form plugin reads, so everything in the [Form plugin's documentation](/2/forms/forms/fields-available) applies. The `builder` block holds timestamps and bookkeeping for the builder and is removed before the Form plugin sees the form. `type: forms-pro` is what hands the form to Forms Pro.

You can edit the file by hand and open the builder again. Keys the builder has no control for are kept as you wrote them. After a hand edit, run `bin/grav clear`.

## Words Forms Pro uses

| Word | Meaning |
|---|---|
| **Form** | One YAML file: its fields, buttons and actions |
| **Field** | One input or layout element on the form. Its **Field Name** is the key its answer is stored under. |
| **Action** | A step that runs when the form is sent, such as storing an entry or sending email. The steps in order are the form's **process**. |
| **Entry** | One stored submission, listed on the **Entries** tab |
| **Merge tag** | A `{{ ... }}` placeholder in an email or other action that is filled in from the submission |
| **Calculator** | A form that works out results as the visitor types and never submits |

## Related

- [The builder](../the-builder)
- [Field reference](../field-reference)
- [Actions and notifications](../actions-and-notifications)
- [Embedding](../embedding)
