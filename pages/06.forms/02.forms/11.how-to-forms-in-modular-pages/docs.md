---
title: How to: Forms in modular pages
taxonomy:
    category: docs
---

## Using forms in modular pages

Forms in modular pages are a bit different than regular forms.
To add a form inside a modular page, follow those steps:

In your theme, add a `templates/modular/form.html.twig` file copying `templates/forms/form.html.twig`

An example of its content could be:

```
{% block content %}
    {{ content }}
    {% include "forms/form.html.twig" %}
{% endblock %}
```

Of course you can personalize it, as long as you include the Form twig.

If your theme does not provide a `templates/forms/form.html.twig` file, it's not setup to use forms, but no fear - just copy the form-related files from Antimatter, the default Grav theme:

- `templates/forms/*`
- `templates/form.html.twig`
- `templates/formdata.html.twig`

Now, create a modular folder with page type `form.md`

For example: `01.your-modular-page/_contact/form.md`

The `form.md` page will not contain any form definition. It’s just an indication that this is the part that should output the form.

Add the form header to the main modular page, `modular.md`

The modular.md page should contain the whole form definition, with fields etc, as if it was a “full-page” form.md file header. With its own page path as the `form.action` field.

For example:

```
---
content:
    items: '@self.modular'

form:
    action: /your-modular-page
    name: my-nice-form
    fields:
        -
            name: name
            label: Name
            placeholder: 'Enter your name'
            autofocus: 'on'
            autocomplete: 'on'
            type: text
            default: test

    buttons:
        -
            type: submit
            value: Submit

    process:
        -
            message: 'Thank you for your feedback!'
---

```

In the form header, make sure you add the `action` parameter, with the modular page route

Like present in the example above.
This step is needed because if you don't explicitly add `form.action`, the code usually looks for the page route, but being the form in a modular subpage, not an actual page, the path is wrong and breaks the form submit.

So if the modular page is e.g. `site.com/my-page`, just put `form: action: /my-page` in `modular.md`
If the modular page is the homepage, just put `form: action: /`

#### A live example

The Deliver skeleton has a modular form page ready to see while reading this tutorial:

[Live page](http://demo.getgrav.org/deliver-skeleton/contact)

[Page markdown file](https://github.com/getgrav/grav-skeleton-deliver-site/blob/develop/pages/07.contact/modular_alt.md)

#### Troubleshooting forms in modular pages

The best way to troubleshoot a form is to first get back to the roots, and add your customizations one-by-one to see what might be going wrong.

- First, I suggest creating a "regular form", making sure it works, then try putting that into a modular form.
- Second, try making the form work on an Antimatter-based skeleton, which provides all the files you already need.
