---
title: Actions and Notifications
taxonomy:
    category: docs
description: What happens when a Forms Pro form is sent. Covers the Actions tab, every action, email notifications with merge tags, routing mail to a recipient the visitor picks, and sending a notification only when a condition is met.
---

# Actions and Notifications

An action is one step that runs when a visitor sends a valid form: store the entry, send an email, show a message, redirect. The **Actions** tab is where you choose them and set their order. This page covers the tab, every action, and the **Notifications** action in depth, since it is the one most forms need.

Forms Pro does not have its own action system for the stock steps. The Actions tab writes the form's `process:` list, and the Form plugin runs it, so everything on the Form plugin's [form actions reference](../../../forms/forms/reference-form-actions) applies as well. Forms Pro adds three actions of its own: **Store Submission**, **Notifications** and **Webhook**.

## The Actions tab

Open a form and click **Actions**. A form with no actions shows an empty page that tells you nothing runs when it is submitted, and that entries are stored only if a **Store Submission** action is present.

Click **Add action** to open a list of actions in groups: **Response**, **Notifications**, **Data**, **Validation** and **Integrations**. An action you cannot add right now is greyed out, with the reason as a tooltip: **Already in the pipeline** for an action that can appear once, or **Conflicts with the Display Page action** for Redirect and Display Page, which cannot be used together.

Each action is a card. It shows the action's name, a one-line description, and its options. The arrows on a card move it earlier or later, and the bin removes it (after a confirmation if it has settings). Cards run from top to bottom on every successful submission, and that order is what is saved.

Two groups of action keep their place whatever you do. Validation actions (the captchas, see [Spam protection](../spam-protection)) are always first, tagged **runs first**, so a bot is stopped before anything is stored or sent. Redirect and Display Page are always last, tagged **runs last**, because they end the request. The arrows move an action only among others of its own kind, so you cannot put a Redirect before a Store Submission.

If an action has a required option you have not filled in, its card is outlined in red and the tab shows how many are missing. **Save** stays disabled until they are filled in.

An action with a type the builder does not know, for example one from a plugin you have since disabled, is kept as it is and shown with a raw editor, so editing the form never loses it.

> [!NOTE]
> A form in [calculator mode](../calculations#calculator-mode) runs no actions, and the Actions tab warns you with a button to its setting.

### Order matters

Each action works with the data as it is when its turn comes. This matters in two places, and the builder looks after both:

- **Timestamp** and **User IP** add a value to the submitted data, so they always run before the actions that use it. They sit directly under any challenge action and above **Store Submission**, **Notifications**, **Webhook** and the rest, which is how the stored entry and the emails get a timestamp and an IP address.
- **Reset Form** clears the form's values at once, so it always runs after the actions that use them. It sits below everything except **Redirect** and **Display Page**, which stay last. Reset can never leave an entry or an email blank.

The cards snap into this order when you add or move an action, and the arrows move a card only among the actions of its own group. If you edit the YAML by hand and write them in another order, the builder puts them right when it opens the form and marks it unsaved. Saving a definition that has them out of place, through the builder or the API, is refused with a message that names the action to move. A form file edited on disk with no save through the builder runs in the order it is written.

The `process:` list in the form's YAML is written in the same order as the cards, for example:

```yaml
process:
  - timestamp:
      label: Sent at
      format: 'Y-m-d H:i'
  - submission: true
  - notify:
      - to: you@example.com
        subject: 'New message from {{ form.value.name }}'
  - message: Thanks, we will be in touch.
```

## Response actions

These decide what the visitor sees after sending.

| Action | What it does | Options |
|---|---|---|
| **Message** (`message`) | Shows a confirmation message above the form. Merge tags work in it. | **Message Text**. A new Message action starts with `Thank you for your submission!` |
| **Redirect** (`redirect`) | Sends the visitor to another page. A message set by a Message action is shown on that page. | **Redirect URL**, such as `/thank-you` or `https://example.com/thanks`. Merge tags work. |
| **Display Page** (`display`) | Shows another page's content in place of the form, keeping the address in the browser. | **Page Route**. An absolute route (`/thank-you`) or a route under the form's page (`thankyou`). |
| **Reset Form** (`reset`) | Empties the form's fields after a successful send, so the visitor can send another. | On or off. |

With only a Message action, the visitor stays on the page, sees the message, and keeps their answers in the form. Add **Reset Form** to empty it.

Redirect and Display Page replace each other, and only one of them can be used. Redirect sends the browser to the new address. Display Page keeps the form's address in the browser and shows the other page's content instead of the form. A page you use only for this is best given `visible: false` in its frontmatter, to keep it out of menus.

The Message text is processed with Twig. `{{ form.value.name }}` fills in what the visitor typed:

```yaml
process:
  - submission: true
  - message: 'Thanks, {{ form.value.name }}!'
  - redirect: /thank-you
```

> [!NOTE]
> A Redirect URL that merges in something the visitor typed is only followed if the result stays on your site. If a visitor types `https://example.org/x` into a field used as `redirect: '{{ form.value.next }}'`, the redirect is blocked and they are returned to the form page. A Redirect URL that you wrote as an external address works as you wrote it.

## Data actions

These record or keep information about the submission.

| Action | What it does | Options |
|---|---|---|
| **Store Submission** (`submission`) | Saves the answers as an entry in Admin Next. A new form starts with it. Without it no entries are kept. See [Entries](../entries). | On or off. |
| **Timestamp** (`timestamp`) | Adds the date and time of the submission to the data, as a field named `timestamp`. | **Field Label** (default `Timestamp`), **Date Format** (a PHP date format, default `Y-m-d H:i:s`). |
| **User IP** (`ip`) | Adds the visitor's IP address to the data, as a field named `ip`. | **Field Label** (default `User IP`). |
| **Process Uploads** (`upload`) | Moves uploaded files from their temporary place to each file field's **Destination**. Needed for files to be kept. See [Entries](../entries#files). | On or off. |
| **Save to File** (`save`) | Writes the submission to a file under `user/data`. | See below. |
| **Remember Fields** (`remember`) | Stores the chosen fields in a cookie, to fill them in on the visitor's next visit. | **Fields to Remember**. |

Timestamp and User IP each add one named field, so adding either twice does not give two values. Their values go into the submitted data, so they show in the entry, in the notifications and in a **Save to File**. An IP address is personal data. The option's help says so, and you should disclose it in your privacy policy. There is also a plugin setting to store the IP address on every entry (see [Configuration](../configuration)).

**Remember Fields** sets a cookie named `forms-<form name>-<field>` for 60 days, and the field is filled in from it when the visitor opens the page again. It works only in the same browser.

### Save to File

**Save to File** writes plain files, which is useful for a backup or for another program to pick up. Entries are stored separately by **Store Submission**, so you only need it for files.

| Key | Label | Meaning |
|---|---|---|
| `operation` | **Operation** | `create` (default) writes a new file for each submission. `add` appends to one file, which needs a `filename`. |
| `filename` | **Filename** | A fixed name. Leave it empty with `create` to build the name from the prefix and the date. |
| `folder` | **Folder** | A folder under `user/data`. Default: the form's name. |
| `fileprefix` | **Filename Prefix** | Put in front of the generated name. |
| `dateformat` | **Date Format** | A PHP date format for the generated name. Default `Ymd-His-u`. |
| `extension` | **Extension** | File extension. Default `txt`. |
| `body` | **Body Template** | Twig for the file's text. Empty writes every field as `Label: value` lines. |

This writes one file per submission to `user/data/<form name>/` and also keeps a running log of names and addresses:

```yaml
process:
  - save:
      fileprefix: contact-
      extension: txt
  - save:
      filename: contact-log.txt
      operation: add
      body: "{{ form.value.name }} <{{ form.value.email }}>\n"
```

Grav's stock web server rules refuse requests for `.txt`, `.yaml` and `.json` files under `user/data`. Pick another extension, or loosen those rules, and anyone who guesses a file's name could download it. Check a file's address in a browser before you rely on this for private answers (see [Installation](../installation)).

## Notifications

The **Notifications** action sends email through the Email plugin. One action holds as many notifications as you like, and each is sent separately, with its own recipients and its own conditions. Use it for "tell the team" and "thank the visitor" emails, and when different answers should go to different people.

Open **Actions**, **Add action**, **Notifications**, then **Add notification**. Each notification is a card with a switch to turn it on or off, a title (its subject), and a bin to remove it.

| Key | Label | Meaning |
|---|---|---|
| `to` | **To** | One address, or several separated by commas. Merge tags work. Required. |
| `subject` | **Subject** | Required. Merge tags work. |
| `body` | **Body** | The message. Leave it empty to send a table of every answer. Merge tags work. |
| `from` | **From** | Under **Sender & routing**. Leave it empty to use the Email plugin's default sender. |
| `reply_to` | **Reply-To** | Under **Sender & routing**. Use `{{ form.value.email }}` so that replying goes to the visitor. |
| `cc` | **CC** | Under **Sender & routing**. |
| `bcc` | **BCC** | Under **Sender & routing**. |
| `html` | **Send as HTML** | On by default. See below. |
| `attach_files` | **Attach uploaded files** | Off by default. Attaches the files uploaded in this submission. |
| `enabled` | **Enabled** | On by default. An off notification is kept but not sent. |

A notification with no **To** or no **Subject** is not sent. The card shows **needs To & Subject** until both are filled in.

A failed notification is logged and does not stop the other actions, so a mail server problem never costs you the entry or the visitor's confirmation.

### Merge tags

Merge tags are Twig expressions in double braces. The braces button beside each box lists the ones for your form: one for each answer field, the email address behind each Recipients field, the form name, the page title and the page URL. You can type any of these:

| Tag | Gives |
|---|---|
| `{{ form.value.name }}` | The answer in the field named `name`. A field with several parts or choices gives readable text, such as `Ada Lovelace` or `Alpha, Beta`. |
| `{{ form.value.name.first }}` | One part of a composite answer. |
| `{{ data.name }}` and `{{ field.name }}` | The same as `form.value.name`. |
| `{{ all_fields }}` | A table of every answer with its label, in form order. In a plain-text message it is `Label: value` lines. |
| `{{ recipients.department }}` | The address or addresses behind a Recipients field named `department`. See [Route mail to a recipient the visitor picks](#route-mail-to-a-recipient-the-visitor-picks). |
| `{{ form.name }}` and `{{ form.title }}` | The form's name and title. |
| `{{ page.title }}`, `{{ page.url }}` and `{{ uri.url }}` | The page the form was sent from, and its address. |
| `{{ site.title }}` | A value from the site's configuration. Other `site.*` values work the same way. |
| `{{ timestamp }}` | When the form was sent, as `2026-11-14 04:03:22`. |

Twig filters work, so `{{ form.value.name.first|upper }}` or `{{ form.value.note|default('none') }}` are fine. A name that does not exist gives an empty string. Only plain values are available: objects, functions and the rest of Grav are not, because merge tags are processed in a locked-down Twig. Answers from the visitor are inserted as text, never run as Twig, so a visitor cannot put code in a message by typing `{{ ... }}` into a field.

This notification, tested on a form with a name, an email address, a topic and a message, uses most of them:

```yaml
process:
  - submission: true
  - notify:
      - to: team@example.com
        subject: '[{{ site.title }}] New message from {{ form.value.name.first }}'
        reply_to: '{{ form.value.email }}'
        body: |
          {{ form.value.name.first }} wrote about {{ form.value.topic }}.

          {{ all_fields }}
  - message: Thanks, we will get back to you soon.
```

### HTML and plain text

With **Send as HTML** on (the default), the body is HTML and `{{ all_fields }}` is a styled table. A rich text answer keeps its formatting, sanitized. With it off, the body is built as plain text: `{{ all_fields }}` becomes `Label: value` lines and rich text becomes plain text.

> [!NOTE]
> **Send as HTML** also sets the message's content type. With it on the message is sent as `text/html`, and with it off as `text/plain`, whatever the Email plugin's own **Content Type** setting says, so the line breaks of a plain-text body arrive as written.

### Attach uploaded files

Turn on **Attach uploaded files** to send the files a visitor uploaded with the email. The files must be kept by a **Process Uploads** action. Attachments keep the names they were uploaded with. See [Entries](../entries#files) for where the files live.

## Route mail to a recipient the visitor picks

A **Recipients** field lets a visitor choose who their message goes to, such as Sales or Support, without any address reaching their browser. Add one under **Pro Fields** (see [Field reference](../field-reference#recipients)), list your choices with the address behind each, and use `{{ recipients.<field name> }}` in a notification's **To**, **CC** or **BCC**:

```yaml
fields:
  department:
    type: pro-recipients
    label: Send to
    display: select
    placeholder: Choose a department
    validate:
      required: true
    recipients:
      sales:
        label: Sales
        email: sales@example.com
      support:
        label: Support
        email: 'support@example.com, lead@example.com'
  email:
    type: email
    label: Your email
    validate:
      required: true
  message:
    type: textarea
    label: Message
process:
  - submission: true
  - notify:
      - to: '{{ recipients.department }}'
        subject: 'Message for {{ form.value.department }}'
        reply_to: '{{ form.value.email }}'
  - message: Message sent.
```

A visitor who picks **Support** causes the email to go to both support addresses. The visitor's choice only selects a key, `support` here. The address is looked up on the server from the form's own definition, so a visitor who edits the page to post an address of their own gets nothing sent to it. 

The address of one choice can itself hold several addresses, as `support` does above: write them in one `email` value, separated by commas. By default the field lets a visitor choose one entry. With `multiple: true` the visitor can choose several, and the email goes to the addresses of every choice they ticked, each address once. `{{ recipients.department }}` then holds all of them, and `{{ form.value.department }}` prints the labels of the chosen entries, joined with commas. See [Recipients](../field-reference#recipients) for the other ways to show the choices.

## Send only when a condition is met

A notification can carry `conditions`, so it is sent only for some answers. This is not shown as a form in the builder, because it is the one part of a notification you write in the YAML. The builder keeps it, and lists it under the card as **Also configured in YAML (kept as-is): conditions**.

```yaml
process:
  - submission: true
  - notify:
      - to: sales@example.com
        subject: 'Large order {{ form.value.amount }}'
        conditions:
          logic: all
          rules:
            - field: amount
              operator: greater_than
              value: 1000
      - to: team@example.com
        subject: 'Sales or large'
        conditions:
          logic: any
          rules:
            - field: topic
              operator: is
              value: sales
            - field: amount
              operator: greater_than
              value: 1000
```

`logic` is `all` (every rule must be met, the default) or `any` (one is enough). Each rule names a `field`, an `operator` and a `value`:

| Operator | Is met when |
|---|---|
| `is` | The answer equals the value, ignoring upper and lower case. |
| `is_not` | The answer does not equal the value. |
| `contains` | The answer holds the value, ignoring case. |
| `not_contains` | The answer does not hold the value. |
| `starts_with` | The answer begins with the value. |
| `ends_with` | The answer ends with the value. |
| `greater_than` | The answer, as a number, is larger than the value. |
| `less_than` | The answer, as a number, is smaller than the value. |
| `is_empty` | The answer is empty. |
| `is_not_empty` | The answer is not empty. |

An answer with several choices (checkboxes) is joined with commas first, so `contains` is the way to test for one of them. A rule with an operator that is not in the table is never met. A notification with a `conditions` block but no `rules` is always sent.

These operator names are not the same as the ones on the Logic tab. The Logic tab's rules decide whether a field is shown (see [Conditional logic](../conditional-logic)). A notification's `conditions` decide whether it is sent, and read the submitted answers.

## Send Email

**Send Email** (`email`) is the Form plugin's own email action, in the **Notifications** group. It sends one email. It has no conditions, no recipient routing and no HTML switch, and it cannot hold several emails. Use it when you only need a simple autoresponse:

```yaml
process:
  - email:
      to: '{{ form.value.email }}'
      subject: 'We got your message, {{ form.value.name }}'
      body: 'Thanks {{ form.value.name }}, we will reply soon.'
```

Its options are **To**, **From**, **Reply-To**, **Subject**, **Body**, **CC**, **BCC**, **Content Type** and **Attach Uploaded Files From**. An empty **Body** sends the Form plugin's full submission table. For anything with conditions or routing, use **Notifications** instead.

## Webhook and the other actions

**Webhook** posts the submission to another service. It has its own page, [Webhooks](../webhooks). The captcha actions (**reCAPTCHA Validation**, **Turnstile Validation**, **Cap Validation** and **Basic Captcha Validation**) are covered in [Spam protection](../spam-protection). **Call Function** runs a PHP function on every submission and is hidden unless you turn on **Expose Call Action** in the plugin's settings (see [Configuration](../configuration)). Only use it with code you trust.

## Related

- [Entries](../entries)
- [Webhooks](../webhooks)
- [Spam protection](../spam-protection)
- [Form actions reference (Form plugin)](../../../forms/forms/reference-form-actions)
