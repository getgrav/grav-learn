---
title: Forms
taxonomy:
    category: docs
---

The Forms plugin for Grav is a Form Construction Kit available for you to use in your own pages.

## Create a simple form

At the moment there’s not yet an easy-to-use interface for the Forms plugin, although that is in the plans.
You need to write your own page frontmatter code to show a form.

It all starts in a page header:

```yaml
title: A page with a form
form:
    name: my-nice-form
    action: /form
    method: post
    fields: [{ name: name, label: Name, placeholder: 'Enter your name', autofocus: 'on', autocomplete: 'on', type: text, validate: { required: true } }, { name: email, label: Email, placeholder: 'Enter your email address', type: text, validate: { rule: email, required: true } }]
    buttons: [{ type: submit, value: Submit }, { type: reset, value: Reset }]
```

This is enough to show a form in the page, below the page content.

It’s as simple form with a name and email field, with two buttons, one to submit the form and one to reset the fields.

What happens when you press the `Submit` button? Right now, nothing. You need to specify how the form will be processed. How? By adding a `process` field to the page yaml frontmatter:

```
    process: [{ email: { from: '{{ config.plugins.email.from }}', to: ['{{ config.plugins.email.from }}', '{{ form.value.email }}'], subject: '[Feedback] {{ form.value.name|e }}', body: '{% include ''forms/data.html.twig'' %}' } }, { save: { fileprefix: feedback-, dateformat: Ymd-His-u, extension: txt, body: '{% include ''forms/data.txt.twig'' %}' } }, { message: 'Thank you from your feedback!' }, { display: thankyou }]
```

What does this do is simple: it executes the passed actions in serie.

1. An email is sent to the email entered, with the subject `[Feedback] [name entered]`. The body of the email is defined in the forms/data.html.twig file of the theme in use.

2. A file is created in `user/data` to store the form input data. The template is defined in forms/data.txt.twig of the theme in use.

3. The `thankyou` subpage is shown, along with the passed message.

## More custom stuff

The forms plugin offers this ability of sending emails, saving files, setting status messages and it’s really handy.
Sometimes however you need total control. That’s for example what the Login plugin does.

It defines the login.md page frontmatter:

```yaml
title: Login
template: form

form:
    name: login
    action:
    method: post

    fields:
        - name: username
          type: text
          placeholder: Username
          autofocus: true

        - name: password
          type: password
          placeholder: Password
```

The Forms plugin correctly generates and shows the form. Notice there’s no `action` nor `process` defined.

The form `buttons` are missing too, since they’re manually added in `templates/login.html.twig`. That’s where the form `action` and `task` is defined too.

In this case, `task` is `login.login`, and `action` is set to the page url.

When a user presses 'Login' in the form, Grav calls the `onTask.login.login` event.

`user/plugins/login/login.php` hooks up to `onTask.login.login` to its classes/controller.php file, and that's where the authentication happens.
