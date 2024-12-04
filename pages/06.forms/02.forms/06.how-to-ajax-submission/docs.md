---
title: 'How to: Ajax Submission'
taxonomy:
    category: docs
---

## Submitting forms via XHR/Ajax

The default mechanism for form processing relies on standard HTML style form submission that causes the contents of an HTML form to be sent to the server via either `POST` or `GET` (default is `POST`). After the form has been [validated](../fields-available), and [processed](../reference-form-actions), results are sent back to the form (or to a [redirected page](../reference-form-actions#redirect)) where messages are displayed and the form can be edited for re-submission if required.

This involves a page reload, and that is sometimes undesirable.  This is where a form submitted via JavaScript using Ajax or XHR is the preferred option.  Luckily, Grav's form capabilities are up to the task.

## Automatic Approach (Form plugin >= `v7.3.0`)

With the release of Form plugin version `7.3.0` the ability to submit forms with XHR to process the form in-place and not require an entire page reload is now available with a quick setup option.

To enable this simply add this option to your Form blueprint:

```yaml
xhr_submit: true
```

You are not required to provide `action:`, `template:`, or even `id:`.  The plugin will just 'work' even with multiple ajax forms on a single page. This uses a new `form-xhr.html.twig` template that the plugin provides as well as including some vanilla JS code to make the request.

!! This approach submits the whole form via an XHR request and replaces the entire form HTML from the response. This is intended to be a simple approach, you can still create your own more advanced solutions if required.

!!! The Javacript code used for the XHR request is located in `form/layouts/xhr.html.twig`. If you require, you can copy this to your theme's `templates` folder (maintaining the path structure) and modify as needed.

## Manual Approach (required for Form plugin < `v7.3.0`)

### Creating the form

You can create any standard form you like, so for this example, we'll keep the form as simple as possible to focus on the Ajax handling parts. First, we'll create a form in a page called: `forms/ajax-test/` and create a form page called `form.md`:

[prism classes="language-yaml line-numbers"]
---
title: Ajax Test-Form
form:
    name: ajax-test-form
    action: '/forms/ajax-test'
    template: form-messages
    refresh_prevention: true

    fields:
        name:
            label: Your Name
            type: text

    buttons:
        submit:
            type: submit
            value: Submit

    process:
        message: 'Thank you for your submission!'
---
[/prism]

As you can see this is a very basic form that simply asks for your name and provides a submit button.  The only thing that stands out is the `template: form-messages` part.  As outlined in the [Frontend Forms](../../forms) section, you can provide a custom Twig template with which to display the result of the form processing.  This is a great way for us to process the form, and then simply return the messages via Ajax and inject them into the page.  There is already a `form-messages.html.twig` template provided with the forms plugin that does just this.

!! NOTE: We use a hard-coded `action: '/forms/ajax-test'` so the ajax has a consistent URL rather than letting the form set the action to the current page route. This resolves an issue with the Ajax request not handling redirects properly. This can otherwise cause issues on the 'home' page. It doesn't have to be the current form page, it just needs to be a consistent, reachable route.

![](simple-form.png?classes=shadow)

### The page content

In this same page, we need to put a little HTML and JavaScript:

[ui-tabs]

[ui-tab title="Vanilla JS"]
[prism classes="language-twig line-numbers"]
<div id="form-result"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#ajax-test-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const result = document.querySelector('#form-result');
        const action = form.getAttribute('action');
        const method = form.getAttribute('method');
        
        fetch(action, {
            method: method,
            body: new FormData(form)
        })
        .then(function(response) {
            if (response.ok) {
                return response.text();
            } else {
                return response.json();
            }
        })
        .then(function(output) {
            if (result) {
                result.innerHTML = output;
            }
        })
        .catch(function(error) {
            if (result) {
                result.innerHTML = 'Error: ' + error;
            }
                
            throw new Error(error);
        });
    });
});
</script>
[/prism]
[/ui-tab]

[ui-tab title="jQuery"]
[prism classes="language-twig line-numbers"]
<div id="form-result"></div>

<script>
$(document).ready(function(){

    var form = $('#ajax-test-form');
    form.submit(function(e) {
        // prevent form submission
        e.preventDefault();

        // submit the form via Ajax
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            dataType: 'html',
            data: form.serialize(),
            success: function(result) {
                // Inject the result in the HTML
                $('#form-result').html(result);
            }
        });
    });
});
</script>
[/prism]
[/ui-tab]

[/ui-tabs]

First we define a div placeholder with the ID `#form-result` to use as a location to inject the form results.

We are using JQuery syntax here for simplicity but obviously, you can use whatever JavaScript you like as long as it performs a similar function.  We first stop the default submit action of the form and make an Ajax call to the form's action with the form's data serialized.  The result of this call is then set back on that div we created earlier.

![](submitted-form.png?classes=shadow)
