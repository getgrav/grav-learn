---
title: Forms
taxonomy:
    category: docs
---

The Forms plugin for Grav is a Form Construction Kit available for you to use in your own pages.

## The form page

To add a form to a page, name the page file as `form.md`

## Create a simple form

Every page in the site can host a form. The form is defined in the page YAML frontmatter.
At the moment there isn't an easy-to-use interface for the Forms plugin, although that is in the plans for the future.

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
          type: text
          validate:
            rule: email
            required: true

    buttons:
        - type: submit
          value: Submit
        - type: reset
          value: Reset
```

This is enough to show a form in the page, below the page content. It’s as simple form with a name and email field, with two buttons, one to submit the form and one to reset the fields.

What happens when you press the `Submit` button? Right now, nothing. You need to specify how the form will be processed. How? By adding a `process` field to the page yaml frontmatter:

```
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
    - message: Thank you from your feedback!
    - display: thankyou
```

What does this do is simple: it executes the passed actions in serie.

1. An email is sent to the email entered, with the subject `[Feedback] [name entered]`. The body of the email is defined in the forms/data.html.twig file of the theme in use.

2. A file is created in `user/data` to store the form input data. The template is defined in forms/data.txt.twig of the theme in use.

3. The `thankyou` subpage is shown, along with the passed message. The `thankyou` page must be a subpage of the page containing the form.

## Which fields you can use

The Forms plugin comes with

- **Captcha**: a captcha antispam field, using reCAPTCHA
- **Checkbox**: a simple checkbox
- **Checkboxes**: a serie of checkboxes
- **Date**: a date selection field
- **Datetime**: a date and time selection field
- **Display**: a text or instructions field (not an input field)
- **Email**: an email field, with validation
- **Hidden**: an hidden field
- **Password**: a password field
- **Radio**: a radio input type
- **Select**: a select field
- **Spacer**: used to add a title, text or an horizontal line to the form
- **Text**: a simple text field
- **Textarea**: a textarea

## Fields parameters

Every field accepts a list of parameters you can use to customize their appearance.
They are:

- **label**: sets the field label
- **validate.required**: if set to a positive value, sets the field as required.
- **validate.pattern**: sets a validation pattern
- **validate.message**: sets the message shown if the validation fails
- **type**: sets the field type
- **default**: sets the field default value
- **size**: sets the field size, which in turn adds a class to its container. Valid values are `large`, `x-small`, `medium`, `long`, `small`. You can of course add more in the template you use
- **name**: sets the field name
- **classes**: accepts a string with one of more CSS classes to add
- **id**: sets the field id
- **style**: sets the field style
- **title**: sets the field title value
- **disabled**: sets the field disabled state
- **placeholder**: sets the field placeholder value
- **autofocus**: if enabled, autofocus on that field
- **novalidate**: sets the field novalidate state
- **readonly**: sets the field readonly state
- **autocomplete**: Accepts `on` or `off`

Some fields allow specific parameters. Listed here:

- **date** and **datetime**: set `validate.min` and `validate.max` to set a min & max value
- **spacer** allows the use of `underline` to add an `<hr>` tag, `text` to add a text value and uses `title` as an `h3` tag.
- **select** allows `multiple` to allow accepting multiple values
- **select** and **checkboxes** use the `options` field to set the available options.
- **display** accepts `content` to set the content to show. Set `markdown` to true to parse the markdown in `content`.
- **captcha** accepts `recatpcha_site_key` and `recaptcha_not_validated`.

Examples:

```yaml
my_field:
    type: checkboxes
    label: A couple of checkboxes
    default: [option1: true, option2: true]
    options:
        option1: Option 1
        option2: Option 2
```

```yaml
test:
    type: display
    size: large
    label: Instructions
    markdown: true
    content: "This is a test of **bold** and _italic_ in a text/display field\n\nanother paragraph...."
```

You can set positive values in multiple ways: `'on'`, `'true'`, `1`.
Other values are interpreted as negative.

### A note on Captcha

Google reCAPTCHA stores the Captcha confirmation code in a field named `g-recaptcha-response`. For this reason, name the Captcha
form fields as `g-recaptcha-response`, e.g.:

```yaml
-
    name: g-recaptcha-response
    label: Captcha
    type: captcha
    recatpcha_site_key: ij3eoij3oirj3oiejio3wjeioje
    recaptcha_not_validated: 'Captcha not valid!'
    validate:
        required: true
```

In this way, the validation will work out of the box.

## Form actions

We saw some example form actions in the simple form example above. Let's detail the actions you can use.

### Email

Sends an email with the specified options.

Example:

```yaml
process:
    - email:
        from: "{{ config.plugins.email.from }}"
        to: "{{ config.plugins.email.to }}"
        subject: "Contact by {{ form.value.name|e }}"
        body: "{% include 'forms/data.html.twig' %}"
```

Sends an email from the email address specified in the Email plugin configuration, sends it to that same email address (it's a contact form, we send it to ourselves).
Unless you want to use other values, you could freely omit from and to, as they are already configured by default to use these values.
The email has the set subject and body.
In this case, the body is generated by the forms/data.html.twig file, which is found in the active template (Antimatter and the other main themes have it, but it's not guarantee that every theme includes it).

Antimatter sets it to

```twig
{% for field in form.fields %}
    <div><strong>{{ field.label }}</strong>: {{ string(form.value(field.name)|e) }}</div>
{% endfor %}
```

In short, it just loops the values and prints them in the email body.

### Redirect

Redirects the user to another page. The action is immediate, so if you use this, you probably need to put it at the bottom of the actions list.

### Message

Sets a message to be shown in the next page. Works if you set a `display` action too, which redirects the user to another page.

```
process:
    - message: Thank you from your feedback!
    - display: thankyou
```

### Display

After submitting the form the user can be redirected to another page. That page will be a subpage of the form, so for example if your form lives in /form, you can redirect users to /form/thankyou with the following code:

```
process:
    - display: thankyou
```

You can use any page type you want, as a destination page. If you want, Antimatter and compatible themes have a `formdata.html.twig` Twig template that's perfect for this.

The Antimatter theme looks like this

```
{% extends 'partials/base.html.twig' %}

{% block content %}

    {{ content }}

    <div class="alert">{{ form.message }}</div>
    <p>Here is the summary of what you wrote to us:</p>

    {% include "forms/data.html.twig" %}

{% endblock %}
```

If the `thankyou/formdata.md` page is

```
---
title: Email sent
cache_enable: false
process:
    twig: true
---

## Email sent!
```

The output will be a page with the "Email sent!" title, followed by a confirmation message and the form data entered in the previous page."

### Save

Saves the form data to a file. The file is saved to the `user/data` folder, in a subfolder named as the `form.name` parameter. For example:

```yaml
process:
    - save:
        fileprefix: feedback-
        dateformat: Ymd-His-u
        extension: txt
        body: "{% include 'forms/data.txt.twig' %}"
```

The body is taken from the theme's `templates/forms/data.html.twig` file, provided by Antimatter and updated themes.

## More custom stuff

The forms plugin offers this ability of sending emails, saving files, setting status messages and it’s really handy.
Sometimes however you need total control. That’s for example what the Login plugin does.

It defines the login.md page frontmatter:

```yaml
title: Login
template: form

form:
    name: login

    fields:
        - name: username
          type: text
          placeholder: Username
          autofocus: true

        - name: password
          type: password
          placeholder: Password
```

The Forms plugin correctly generates and shows the form. Notice there’s no `process` defined.

The form `buttons` are missing too, since they’re manually added in `templates/login.html.twig`. That’s where the form `action` and `task` is defined too.

In this case, `task` is `login.login`, and `action` is set to the page url.

When a user presses 'Login' in the form, Grav calls the `onTask.login.login` event.

`user/plugins/login/login.php` hooks up to `onTask.login.login` to its classes/controller.php file, and that's where the authentication happens.
