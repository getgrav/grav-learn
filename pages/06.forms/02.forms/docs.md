---
title: Frontend Forms
taxonomy:
    category: docs
---

The **Forms** plugin gives you the ability to create virtually any type of frontend form. It is essentially a form construction kit, available for you to use in your own pages.

To get an understanding of how the **Forms** plugin works, let's start by going over how to create a simple form.

## Create a simple form

To add a form to a page of your site, create a page, and set its Page File to "Form". You can do it via the Admin Panel, or via filesystem directly by naming the page `form.md`.

So, for example, `user/pages/03.your-form/form.md`.

The contents of this page will be:

```yaml
---
title: A page with a form
form:
    name: my-nice-form
    fields:
        - name: name
          label: Name
          placeholder: Enter your name
          autofocus: on
          autocomplete: on
          type: text
          validate:
            required: true

        - name: email
          label: Email
          placeholder: Enter your email address
          type: email
          validate:
            required: true

    buttons:
        - type: submit
          value: Submit
        - type: reset
          value: Reset
          
    process:
        - email:
            from: "{{ config.plugins.email.from }}"
            to:
              - "{{ config.plugins.email.from }}"
              - "{{ form.value.email }}"
            subject: "[Feedback] {{ form.value.name|e }}"
            body: "{% include 'forms/data.html.twig' %}"
        - save:
            fileprefix: feedback-
            dateformat: Ymd-His-u
            extension: txt
            body: "{% include 'forms/data.txt.twig' %}"
        - message: Thank you for your feedback!
        - display: thankyou

---

# My Form
```

!!! This is the content of the `form.md` file, when viewed via filesystem. To do this via Admin Plugin, open the page in Expert Mode, copy the part between the triple dashes `---`, and paste it the Frontmatter field.

This is enough to show a form in the page, below the page's content. It is a simple form with a name, email field, two buttons: one to submit the form and one to reset the fields.

What happens when you press the `Submit` button?  It executes the `process` actions in series.

1. An email is sent to the email entered, with the subject `[Feedback] [name entered]`. The body of the email is defined in the `forms/data.html.twig` file of the theme in use.

!!! Make sure you configured the `Email from` and `Email to` email addresses in the **Email** plugin with your email address

2. A file is created in `user/data` to store the form input data. The template is defined in `forms/data.txt.twig` of the theme in use.

3. The `thankyou` subpage is shown, along with the passed message. The `thankyou` page must be a subpage of the page containing the form.
