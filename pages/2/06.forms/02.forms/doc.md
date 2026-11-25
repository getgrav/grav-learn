---
title: Frontend Forms
taxonomy:
    category: docs
---
# Frontend Forms

The **Form** plugin gives you the ability to create virtually any type of frontend form. It is essentially a form construction kit, available for you to use in your own pages. Before going any further, don't forget to install the [**Form** plugin](https://github.com/getgrav/grav-plugin-form) with `bin/gpm install form` if it's not installed yet.

To get an understanding of how the **Form** plugin works, let's start by going over how to create a simple form.

> [!TIP]
> With **Form 2.0** release, it is now required to pass the **name of the form** as a hidden field.  If you are using the form-plugin-provided `forms.html.twig`, this is handled automatically, however, if you have overridden the default `forms.html.twig` in your theme or plugin, you should manually add `{% include "forms/fields/formname/formname.html.twig" %}` in your form-rendering Twig file.

## Create a simple single form

To add a form to a page of your site, create a page, and set its Page File to "Form". You can do it via the Admin Panel, or via filesystem directly by naming the page `form.md`.

So, for example, `user/pages/03.your-form/form.md`.

The contents of this page will be:

[codesh=yaml line-numbers="true"]
---
title: A Page with an Example Form
form:
    name: contact-form
    fields:
        name:
          label: Name
          placeholder: Enter your name
          autofocus: on
          autocomplete: on
          type: text
          validate:
            required: true

        email:
          label: Email
          placeholder: Enter your email address
          type: email
          validate:
            required: true

    buttons:
        submit:
          type: submit
          value: Submit
        reset:
          type: reset
          value: Reset

    process:
        email:
          from: "{{ config.plugins.email.from }}"
          to:
            - "{{ config.plugins.email.to }}"
            - "{{ form.value.email }}"
          subject: "[Feedback] {{ form.value.name|e }}"
          body: "{% include 'forms/data.html.twig' %}"
        save:
          fileprefix: feedback-
          dateformat: Ymd-His-u
          extension: txt
          body: "{% include 'forms/data.save.txt.twig' %}"
        message: Thank you for your feedback!
        display: thankyou

---

# My Form

Regular **markdown** content goes here...
[/codesh]

> [!NOTE]
> This is the content of the `form.md` file as it looks on disk. To do the same from the admin, open the page and use the **Page File** editor under its Advanced tab, which edits the frontmatter and content together.

This is enough to show a form in the page, below the page's content. It is a simple form with a name, email field, two buttons: one to submit the form and one to reset the fields. For more information on the available fields that are provided by the Form plugin, [check out the next section](fields-available).

What happens when you press the `Submit` button?  It executes the `process` actions in series. To find out about other actions, [check out the available options](reference-form-actions) or [create your own](reference-form-actions#custom-actions).

1. An email is sent to the email entered, with the subject `[Feedback] [name entered]`. The body of the email is defined in the `forms/data.html.twig` file of the theme in use.

2. A file is created in `user/data` to store the form input data. The template is defined in `forms/data.save.txt.twig`, which the Form plugin provides and the theme in use can override. It writes the submitted values as literal text, so a value such as `Tom & Jerry` is stored exactly as it was entered.

3. The `thankyou` subpage is shown, along with the passed message. The `thankyou` page must be a subpage of the page containing the form.

> [!NOTE]
> Make sure you configured the **Email** plugin to ensure it has the correct configuration in order to send email successfully.

## Multiple Forms

With the release of **Form Plugin v2.0**, you are now able to define multiple forms in a single page.  The syntax is similar but each form is differentiated by the name of the form, in this case `contact-form` and `newsletter-form`:

[codesh=yaml line-numbers="true"]
forms:
    contact-form:
        fields:
            ...
        buttons:
            ...
        process:
            ...

    newsletter-form:
        fields:
            ...
        buttons:
            ...
        process:
            ...
[/codesh]

You can even use this format for single forms, by just providing one form under `forms:`:

[codesh=yaml line-numbers="true"]
forms:
    contact-form:
        fields:
            ...
        buttons:
            ...
        process:
            ...
[/codesh]

## Displaying Forms from Twig

The easiest way to include a form is to simply include a Twig file in the template that renders the page where the form is defined.  For example:

[codesh=twig line-numbers="true"]
{% include "forms/form.html.twig" %}
[/codesh]

This will use the Twig template provided by the Form plugin itself.  In turn, it will render the form as you have defined in the page, and handle displaying a success message, or errors, when the form is submitted.

There is however a more powerful method of displaying forms that can take advantage of the new multi-forms support.  With this method you actually pass a `form:` parameter to the Twig template specifying the form you wish to display:

[codesh=twig line-numbers="true"]
{% include "forms/form.html.twig" with { form: forms('contact-form') } %}
[/codesh]

Using this method, you can choose a specific name of a form to display.  You can even provide the name of a form defined in other pages.  As long as all your form names are unique throughout your site, Grav will find and render the correct form!

You can even display multiple forms in one page:

[codesh=twig line-numbers="true"]
# Contact Form
{% include "forms/form.html.twig" with { form: forms('contact-form') } %}

# Newsletter Signup
{% include "forms/form.html.twig" with { form: forms('newsletter-form') } %}
[/codesh]

An alternative way to display a form is to reference the page route rather than the form name using an array, for example:

[codesh=twig line-numbers="true"]
# Contact Form
{% include "forms/form.html.twig" with { form: forms( {route:'/forms/contact'} ) } %}
[/codesh]

This will find the first form from the page with route `/forms/contact`

## Displaying Forms in Page Content

The simplest way to put a form in page content is the `[form]` shortcode. It needs Form plugin `9.2.7` or later and the [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) plugin.

### The `[form]` shortcode

Put it on a line of its own wherever the form should appear. With no attributes it shows the page's own form, the one defined in its frontmatter:

[codesh=markdown line-numbers="true"]
---
title: Contact
form:
    name: contact-form
    fields:
        email:
            type: email
            label: Email
    buttons:
        submit:
            type: submit
            value: Send
    process:
        message: 'Thanks!'
---

Questions? Drop us a line.

[form /]
[/codesh]

To show a particular form, name it, or point at the page it is defined on:

[codesh=markdown]
[form name="contact-form" /]

[form]contact-form[/form]

[form route="/newsletter-signup" /]

[form route="/forms" name="newsletter" class="signup wide" /]
[/codesh]

| Attribute | Meaning |
| :-------- | :------ |
| `name` | The form's `name`. `form` works too, and so does putting the name between opening and closing tags. The page's own forms are searched first, then the forms on every page the visitor can open. Without a name or a route, the page's first form is shown. |
| `route` | The route of the page the form is defined on, such as `/newsletter-signup`. Add `name` as well when that page has more than one form. |
| `class` | Extra CSS classes. The form is wrapped in a `<div>` with these classes. |

A few things to know:

* **Caching stays on, and Twig stays off.** The shortcode only leaves a placeholder in the page's cached content, and the live form is added in its place on every request. Each visitor gets their own security token, and file uploads, captchas and `xhr_submit` work the same as a form in a theme template.
* **Submissions work as usual.** The form's `process:` actions run as they would on the page that defines it, and a form shown from another page is processed with that page's settings.
* **A form that can't be found shows nothing.** That includes a misspelled name, and a form on a page the visitor isn't allowed to open, such as one behind a login.
* **Keep it on its own line.** A form can't sit inside a paragraph, so a shortcode mixed into a line of text leaves invalid HTML around the form.
* **Watch the page template.** A page using the `form` template (`form.md`) already draws its form below the content, so adding `[form /]` to it shows the form twice. Use `default.md` with the shortcode, or the `form` template without it.
* **Several on one page are fine**, including the same form more than once.

### Using Twig in page content

You can also include a form with Twig, passing the form's name or route:

> [!CAUTION]
>  **Twig processing** should be enabled and **page cache** should be disabled to ensure the form is dynamically processed on the page and not statically cached and form handling can occur. In Grav 2, Twig in page content is also limited by the `security.twig_content` settings, so the `[form]` shortcode above is usually the better choice.

[codesh=twig line-numbers="true"]
---
title: Page with Forms
process:
  twig: true
cache_enable: false
---

# Contact Form
{% include "forms/form.html.twig" with {form: forms('contact-form')} %}

# Newsletter Signup
{% include "forms/form.html.twig" with {form: forms( {route: '/newsletter-signup'} ) } %}
[/codesh]

## Form Nonces and Caching

Every form the plugin renders includes a hidden `form-nonce` field. This is a security token (a CSRF nonce) that Grav checks on submission. If the nonce is missing or no longer valid, the submission is rejected with a **`403 Forbidden`** response rather than being processed.

The nonce is time-based and valid for roughly a 12-hour window. This is normally invisible, but it can cause submissions to fail with a `403` in two common situations:

* The page containing the form was **served from a cache** (Grav's page cache, or a CDN/proxy in front of the site) with a nonce that has since expired.
* A visitor **left the page open** for longer than the nonce lifetime before submitting.

Both cases produce the same symptom: the form worked a moment ago, but a submission from a stale page returns a `403`.

To avoid this on cached or long-lived pages, enable the **`refresh_nonce`** option in the Form plugin configuration (`user/config/plugins/form.yaml`):

[codesh=yaml line-numbers="true"]
enabled: true
refresh_nonce: true
[/codesh]

With `refresh_nonce` enabled, the plugin loads a small JavaScript helper that periodically fetches a fresh nonce in the background (before the current one expires) and updates the form field. This keeps forms on aggressively cached or long-open pages submittable without the visitor needing to reload.

> [!NOTE]
> The refresh interval is derived from your `system.session.timeout` (capped to the ~12h nonce lifetime), so there is no separate interval to configure.

## Modular Forms

With previous versions of the Form plugin, to get a form to display in a modular sub-page of your overall **modular** page, you had to define the form in the **top-level modular page**.  This way the form would be processed and available to display in the modular sub-page.

In **Form v2.0**, you can now define the form directly in the modular sub-page just like any other form.  However, if not found, the form plugin will look in the 'current page', i.e. the top-level modular page for a form, so it's fully backwards compatible with the 1.0 way of doing things.

You can also configure your Modular sub-page's Twig template to use a form from another page, like the examples above.

> [!WARNING]
> When using a form defined in a modular sub-page you should set the **action:** to the parent modular page and configure your form with a **redirect:** or **display:** action, as this modular sub-page is not a suitable page to load on form submission because it is **not routable**, and therefore not reachable by a browser.  

Here's an example that exists at `form/modular/_form/form.md`:

[codesh=yaml line-numbers="true"]
---
title: Modular Form

form:
  action: '/form/modular'
  inline_errors: true
  fields:
    person.name:
      type: text
      label: Name
      validate:
        required: true
        
  buttons:
    submit:
      type: submit
      value: Submit
      
  process:
    message: "Thank you from your submission <b>{{ form.value('person.name') }}</b>!"
    reset: true
    display: '/form/modular'  
---

## Modular Form
[/codesh]

