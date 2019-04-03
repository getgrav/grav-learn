---
title: 'How to: Forms in modular pages'
taxonomy:
    category: docs
---

## Using forms in modular pages

If your theme does not provide a `templates/forms/form.html.twig` file, it's not set up to use forms, but no fear - just copy the form templates from Antimatter, the default Grav theme:

- `templates/form.html.twig`
- `templates/formdata.html.twig`

Now, create a modular folder with page type `form.md`

For example: `01.your-modular-page/_contact/form.md`

The `form.md` page will not contain any form definition. It’s just an indication that this is the part that should output the form.

Important: set

[prism classes="language-yaml line-numbers"]
---
cache_enable: false
---
[/prism]

in that page frontmatter header, because of how modular pages work, if you forget this the form will be cached, along with the nonce that is generated every 12 hours. So when reaching the 12 hours change, the form will stop working until the cache is refreshed. This step is not needed for standalone page forms.

Now add the form header to the main modular page, `modular.md`

The modular.md page should contain the whole form definition, with fields etc, as if it was a “full-page” form.md file header. With its own page path as the `form.action` field.

!!! In Form v2.0, you can now define the form directly in the modular sub-page just like any other form. However, if not found, the form plugin will look in the 'current page', i.e. the top-level modular page for a form, so it's fully backwards compatible with the 1.0 way of doing things. !!!

For example:

[prism classes="language-yaml line-numbers"]
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

[/prism]

In the form header, make sure you add the `action` parameter, with the modular page route

Like present in the example above.
This step is needed because if you don't explicitly add `form.action`, the code usually looks for the page route, but being the form in a modular subpage, not an actual page, the path is wrong and breaks the form submit.

So if the modular page is e.g. `site.com/my-page`, just put `form: action: /my-page` in `modular.md`.
Even if the modular page is the homepage, use the page route, e.g. `form: action: /home`

#### A live example

The Deliver skeleton has a modular form page ready to see while reading this tutorial:

[Live page](http://demo.getgrav.org/deliver-skeleton/contact)

[Page markdown file](https://github.com/getgrav/grav-skeleton-deliver-site/blob/develop/pages/07.contact/modular_alt.md)

#### Troubleshooting forms in modular pages

The best way to troubleshoot a form is to first get back to the roots, and add your customizations one-by-one to see what might be going wrong.

- I suggest creating a "regular form", making sure it works, then try putting that into a modular form.
- Try making the form work on an Antimatter-based skeleton, which provides all the files you already need.
- If the form fields do not appear, if you have installed the Assets plugin disable / uninstall it. There's a known issue with it breaking modular forms will be soon fixed.
