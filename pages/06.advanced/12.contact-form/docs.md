---
title: Add a Contact Form
taxonomy:
    category: docs
---

The **Grav Form Plugin** is the easiest way to have forms on your site. Let's see how to create a simple contact form.

## Choose a page

A form can be hosted by any page. Just rename the form file to `form.md`, or add a [Template Override](../../content/headers#template) in the page header.
The form is defined in the YAML frontmatter of the page, so just open a Grav Page with your favorite editor.

>>>>>> In the future we want Grav to be able to dynamically thegenerate forms from the Admin Plugin

```
title: Contact Form

form:
    name: contact

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

        - name: message
          label: Message
          placeholder: Enter your message
          type: textarea
          validate:
            required: true

        - name: g-recaptcha-response
          label: Captcha
          type: captcha
          recatpcha_site_key: aeio43kdk3idko3k4ikd4
          recaptcha_not_validated: 'Captcha not valid!'
          validate:
            required: true

    buttons:
        - type: submit
          value: Submit
        - type: reset
          value: Reset

    process:
        - email:
            subject: "[Site Contact Form] {{ form.value.name|e }}"
            body: "{% include 'forms/data.html.twig' %}"
        - save:
            fileprefix: contact-
            dateformat: Ymd-His-u
            extension: txt
            body: "{% include 'forms/data.txt.twig' %}"
        - message: Thank you for getting in touch!
        - display: thankyou
```

Make sure you add your own `recatpcha_site_key` reCAPTCHA parameter ([see the reCAPTCHA docs](https://developers.google.com/recaptcha/docs/start)).

Now create a subpage under the `thankyou/` subfolder, and name it `formdata.md`. Users submitting the form will be redirected on that page.

The `formdata` page template is provided in Antimatter and other themes. If your theme does not provide it, you'll see an error. You can just copy it from Antimatter and things should work fine.

That's it!

When users submit the form, the plugin will send an email to you (as set in the `from` setting of the Grav Email Plugin), and will save the entered data in the data/ folder.

You can activate the **Grav Data Manager** plugin to see that data in the **Admin Plugin**.
