---
title: Example: Contact Form
taxonomy:
    category: docs
---

## Simple Contact Form

The **Grav Form Plugin** is the easiest way to have forms on your site. Let's see how to create a simple contact form.

!!! In the future we want Grav to be able to dynamically generate forms from the Admin Plugin

### A Live Example

The Sora Article skeleton has a form page ready to see while reading this tutorial:

[Live page](http://demo.getgrav.org/soraarticle-skeleton/contact)

[Page markdown file](https://raw.githubusercontent.com/getgrav/grav-skeleton-soraarticle-blog/develop/pages/03.contact/form.md)

### Setup the Page

You can put a form inside any page of your site. All you need to do is rename the page markdown file to `form.md`, or add a [template](../../../content/headers#template) header in the page frontmatter, to make it use the `form` template.

The form fields and processing instructions are defined in the YAML frontmatter of the page, so just open the page markdown file with your favorite editor, and put the following code in it:

```
---
title: Contact Form

form:
    name: contact

    fields:
        - name: name
          label: Name
          placeholder: Enter your name
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
          recaptcha_site_key: ENTER_YOUR_CAPTCHA_SITE_KEY
          recaptcha_not_validated: 'Captcha not valid!'
          validate:
            required: true

    buttons:
        - type: submit
          value: Submit
        - type: reset
          value: Reset

    process:
        - captcha:
            recaptcha_secret: ENTER_YOUR_CAPTCHA_SECRET_KEY
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
---

# Contact form

Some sample page content
```

!!! Make sure you configured the "Email from" and "Email to" email addresses in the Email plugin with your email address

Make sure you add your own `recaptcha_site_key` reCAPTCHA parameter ([see the reCAPTCHA V2 docs](https://developers.google.com/recaptcha/intro)). If you don't need captcha at all, just remove it from the form fields, and remove the captcha process action too.

Now inside the page folder create a subfolder named `thankyou/`, create a new file named `formdata.md`. And paste the following code into the file:

```
---
title: Email sent
cache_enable: false
process:
    twig: true
---

## Email sent!
```

That's it!

!!! Modular pages are a bit different. In this case, also see [using forms in modular pages](https://learn.getgrav.org/forms/forms/how-to-forms-in-modular-pages)

When users submit the form, the plugin will send an email to you (as set in the `form` setting of the Grav Email Plugin), and will save the entered data in the data/ folder.

! For full details on setting up and configuring email, please read the [Email plugin documentation](https://github.com/getgrav/grav-plugin-email/blob/develop/README.md)

You can activate the **Grav Data Manager** plugin to see that data in the **Admin Plugin**.
