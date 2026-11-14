---
title: Troubleshooting
taxonomy:
    category: docs
description: Fixes for the problems people meet with Forms Pro. A form that does not appear, entries or emails that do not arrive, uploads that fail, calculations that stay blank, webhooks that do not fire, and where to look in the log.
---

# Troubleshooting

Start with the log. Forms Pro writes what it could not do to Grav's log, at `logs/grav.log` in your site folder, and most of the entries below name a line to look for. When a page misbehaves, view its HTML source too, because the shortcode and Twig methods leave a comment there when a form cannot be drawn.

## A form shows nothing on the page

Look at the page, then its source:

| What you see | Cause and fix |
|---|---|
| The shortcode itself, such as `[forms-pro name="contact"]`, written out as text | The Shortcode Core plugin is not installed or not enabled. Install it. |
| An HTML comment, `<!-- forms-pro: form 'contact' not found -->` | No form has that name. The name is the form's file name in `user/data/forms-pro/forms/`, and it is not the title. Check the spelling. |
| An HTML comment, `<!-- forms-pro: no form name specified -->` | The shortcode has no `name`. |
| An HTML comment that says the Form plugin is turned off | Enable the Form plugin. Forms Pro depends on it. |
| Nothing at all, and the page uses `forms_pro:` in its header | The page's template does not draw forms. Name the file `form.md`, or use the shortcode or Twig function instead. |
| Nothing at all, and the form is embedded with the shortcode | **Enable Shortcode** may be off in the plugin's settings. Turn it on. |
| The page shows the form's old version after you saved | Clear the cache with `bin/grav clear`. Saving in Admin2 does this for you. A change made to the YAML file by hand does not. |

See [Embedding](../embedding) for the three methods.

## Entries and emails

### Entries do not appear

- The form needs a **Store Submission** action. Without it nothing is stored (see [Actions and notifications](../actions-and-notifications#data-actions)).
- Order is looked after for **Reset Form**, **Timestamp** and **User IP**: the builder keeps Timestamp and User IP above Store Submission and Reset below it. A form file edited by hand and never saved through the builder runs in the order it is written, so open it in the builder and save it (see [Order matters](../actions-and-notifications#order-matters)).
- A challenge that fails (**Basic CAPTCHA**, Turnstile, reCAPTCHA or Cap) or a filled honeypot stops the submission before anything is stored.
- The list does not update on its own. Click the circular arrow to reload it.

### Emails do not arrive

1. Check that the Email plugin is set up to send mail. A mail catcher such as Mailpit is handy while you build.
2. Open the notification. It needs a **To** and a **Subject**. Without both it is not sent, and the log has `Forms Pro: notification 'notification_0' failed: Notification requires "to" and "subject" fields`.
3. If the notification has `conditions` in the YAML, it is sent only when they are met. A condition that names a field that does not exist reads it as empty (see [Send only when a condition is met](../actions-and-notifications#send-only-when-a-condition-is-met)).
4. With a Recipients field, `{{ recipients.<field> }}` is empty when the visitor chose nothing, so the notification has no **To**.
5. Check that **Enabled** is on for the notification.
6. Search `logs/grav.log` for `Forms Pro: Email send failed`. It carries the mail transport's own message, such as a refused login.

A notification failing never stops the visitor's confirmation or the entry. That is why a mail problem only shows in the log.

## Uploads

- **The form fails with a read-only stream error when sent.** On Grav 2, a destination written as `user://data/...` is read-only. Write the field's destination as `user-data://uploads` (see [Field reference](../field-reference#uploads)).
- **The form will not send, and the browser says the file is required.** This needs Form plugin 9.2.1 or newer. Older versions put the browser's own required check on the hidden file input, which stays empty because the file uploads in the background. Update the Form plugin.
- **The entry has no file, or the file is not downloadable.** The form needs the **Process Uploads** action, which moves the file to its destination. See [Entries](../entries#files).
- **Files are public.** Images, PDFs and other media in `user/data` are served by the stock web server rules to anyone who knows the address. See [Installation](../installation#where-things-are-stored).

## Calculations

A calculation that stays blank, or shows the wrong number:

- The formula names a field that does not exist, or that has the wrong name. Names are exact, and they are case-sensitive.
- A field name with a hyphen, such as `unit-price`, cannot be used in a formula, because the hyphen is read as a minus. Rename it `unit_price`.
- A field the formula reads holds text that is not a number, such as `abc` or `12 kg`.
- The formula divides by zero. Guard it: `IF(qty == 0, 0, total / qty)`.
- **Blank Until Filled** keeps a calculator blank until every field the formula reads has a value (see [Calculations](../calculations#blank-until-filled)).
- Two calculations read each other. The formula editor warns, saving is refused, and on a live form both stay blank.
- A Number field refuses `19.99`. Browsers accept whole numbers only until the field has a step. Set `validate.step: 0.01`, or `any`.
- The values shown in the browser and in the entry differ. The entry has the server's own result, and the server works every calculation out again from what was posted.

The formula editor's **Try it** box shows what a formula gives for values you type. The full rules are in the [Formula reference](../formula-reference).

## Conditional logic

- A field you hid is missing from the entry. That is intended: a hidden field's answer is stripped and its **Required** is relaxed on the server (see [Conditional logic](../conditional-logic#what-hidden-means)).
- A condition on a notification does nothing. Notification `conditions` read submitted answers and use their own operator names (`is`, `contains`, `greater_than` and so on), and are written in the YAML.

## Webhooks

- Nothing arrives, and the log says `webhook '...' refused: ... is a private or reserved address`. The address points at your own network. Use a public address, or turn on **Allow Webhooks to Private Addresses** (see [Webhooks](../webhooks#which-addresses-are-allowed)).
- The log says `did not resolve`. The host name does not resolve from the server.
- The log says `answered HTTP 3xx`. Redirects are never followed. Use the address the redirect leads to.
- A slow or failing receiver slows the visitor's request, up to the timeout. Put the webhook below **Store Submission**, and keep its **Timeout** short.

## Saving a form

- **Save fails with a message about an action that ends the submission.** Redirect and Display Page must be last in the Actions list. Move them to the end.
- **Save fails because a form changed elsewhere.** Someone saved it, or you saved it in another tab, since you opened it. Reload and make your change again.
- **The `call` action is refused.** It is off unless **Expose Call Action** is on in the plugin's settings.
- **A required option is missing.** The Actions tab shows how many, and the cards in red. **Save** stays off until they are filled in.
- **A logic rule is incomplete.** A rule needs a field and a value, or use **is empty**. Finish or remove it.

## Admin2

- **Forms Pro is not in the sidebar.** The account needs `api.access` and a Forms Pro permission (see [Permissions](../permissions)).
- **The builder is read-only.** The account has `forms.read` but not `forms.write`.
- **Entries are not there, but forms are.** The account lacks `submissions.read`.
- **Deleting a form is refused.** It needs `submissions.write` too, because its entries go with it.

## Spam protection

- **A challenge is on the form, but bots still get through.** The challenge needs both halves: the field and the matching validation action. The Settings tab warns when the action is missing, with **Add the check** to fix it (see [Spam protection](../spam-protection)).
- **reCAPTCHA or Turnstile never passes.** The site and secret keys are set in the Form plugin's settings, and a key pair for another domain fails.
- **Visitors find the Basic CAPTCHA too hard.** Change its type and size in the Form plugin's `basic_captcha` settings (`characters`, `math`, `dotcount` or `position`).

## Still stuck

Report a problem at [the premium issues tracker](https://github.com/getgrav/grav-premium-issues/issues?q=label:forms-pro) and say your Grav, Forms Pro, Form and Email versions, what you did, and the lines in `logs/grav.log` from that moment.

## Related

- [Installation](../installation)
- [Actions and notifications](../actions-and-notifications)
- [Embedding](../embedding)
