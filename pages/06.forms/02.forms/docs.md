---
title: Frontend Forms
taxonomy:
    category: docs
---

The **Forms** plugin gives you the ability to create virtually any type of frontend form. It is essentially a form construction kit, available for you to use in your own pages.

To get an understanding of how the **Forms** plugin works, let's start by going over how to create a simple form.

## Create a simple form

Every page in a Grav site can host a form. Adding a form to a page is very simple.

To add a form to a page, name the page file as you would any page. In our example, we use the name `form.md` for simplicity. The form is defined in the page's YAML frontmatter.

At the moment, there isn't an easy-to-use interface for the **Forms** plugin, although that is in the plans for the future.

Here's an example of a form:

```yaml
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
```

This is enough to show a form in the page, below the page's content. It is a simple form with a name, email field, two buttons: one to submit the form and one to reset the fields.

What happens when you press the `Submit` button? Right now, nothing. You need to specify how the form will be processed. You can do this by adding a `process` field to the page's YAML frontmatter:

```yaml
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
```

!!! Make sure you configured the `Email from` and `Email to` email addresses in the **Email** plugin with your email address

What this does is simple: It executes the passed actions in series.

1. An email is sent to the email entered, with the subject `[Feedback] [name entered]`. The body of the email is defined in the `forms/data.html.twig` file of the theme in use.

2. A file is created in `user/data` to store the form input data. The template is defined in `forms/data.txt.twig` of the theme in use.

3. The `thankyou` subpage is shown, along with the passed message. The `thankyou` page must be a subpage of the page containing the form.
