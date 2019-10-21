---
title: 'Reference: Form Options'
page-toc:
  active: true
taxonomy:
    category: docs
---


### Name

There are no required options for forms.  However as outlined in the [Frontend Forms](../../forms) overview, it is highly recommend to at least have a form name:

[prism classes="language-yaml line-numbers"]
form:
    name: my-form
[/prism]

This **must be unique** for your Grav site. This is because the form's name serves as a unique identifier for this form through the system.  A form can be referenced by this name from any other page.

### Method

This option allows you to control if the form should be submitted via `POST` or `GET`.  The default is `POST`.  Also note, if you have a `file` field in your form, the method will also get `enctype="multipart/form-data"` appended:

[prism classes="language-yaml line-numbers"]
form:
    method: GET
[/prism]


### Action

The action by default is going to be the route as the current page.  This makes sense most of the time because the form needs to be processed by the same page that houses the form.  There are times when you want to override the action however to either specify a different file extension (`.json` perhaps) or even target a specific page anchor:

[prism classes="language-yaml line-numbers"]
form:
    action: /contact-us#contact-form
[/prism]

You can even process the form on another page if that page is where you want to handle the results.  This can also be used as a technique to alter the template of the response from the one used in the original form:

[prism classes="language-yaml line-numbers"]
form:
    action: /contact-us/ajax-process
[/prism]

Where you have a page file called `form-messages.html.twig` that returns just the message data.  Alternatively you can use the approach below...

### Template

Usually the page's Twig template that displays the form is perfectly capable of handling any success/failure messages or in-line validation responses.  However sometimes it's useful to send the form response back using a different Twig template.  A good example of this is when you want to process your form via Ajax.  You probably only want the HTML for the success/failure messages to be returned by the template, so these can be injected back into the page by JavaScript:

[prism classes="language-yaml line-numbers"]
form:
    template: form-messages
[/prism]

### ID

The ability to set a form-level CSS `id` field. If not provided the form's name is used.

[prism classes="language-yaml line-numbers"]
form:
    id: my-form-id
[/prism]

### Classes

You can also set explicit classes on the form.  There are no default values here.

[prism classes="language-yaml line-numbers"]
form:
    classes: 'form-style form-surround'
[/prism]

### Inline Errors

Setting Inline Errors in the form's markdown file or definition enables the display of in-line errors, an important troubleshooting tool.

[prism classes="language-yaml line-numbers"]
form:
    inline_errors: true
[/prism]

### Client-side Validation

Turning client-side validation off will enable you to see in-line errors and detailed server-side validation that go beyond the HTML5 client-side validation. You can disable client-side validation through form.yaml or in the form definition.

[prism classes="language-yaml line-numbers"]
form:
    client_side_validation: false
[/prism]

### Keep Alive

You can ensure your forms do fail to submit when your session expires, by enabling the `keep_alive` option on the form.  By enabling this, an AJAX request will be made to Grav before your session expires to keep it 'fresh':

[prism classes="language-yaml line-numbers"]
form:    
    keep_alive: true
[/prism]

### Fieldsets

You can set up `<fieldset></fieldset>` tags for the fields in your form using the `fieldset:` designation in the form.

[prism classes="language-yaml line-numbers"]
form:
    name: Example Form
    fields:
        example:
            type: fieldset
            id: my-fieldset
            legend: 'Test Fieldset'
            fields:
                first_field: { type: text, label: 'First Field' }
                second_field: { type: text, label: 'Second Field' }
[/prism]

The above form outputs as follows:

[prism classes="language-html line-numbers"]
<form action="/grav/example/forms" class="" id="my-example-form" method="post" name="Example Form">
  <fieldset id="my-fieldset">
    <legend>Test Fieldset</legend>
    <div class="form-group">
      <div class="form-label-wrapper">
        <label class="form-label">First Field</label>
      </div>
      <div class="form-data" data-grav-default="null" data-grav-disabled="true" data-grav-field="text">
        <div class="form-input-wrapper">
          <input class="form-input" name="data[first_field]" type="text" value="">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-wrapper">
        <label class="form-label">Second Field</label>
      </div>
      <div class="form-data" data-grav-default="null" data-grav-disabled="true" data-grav-field="text">
        <div class="form-input-wrapper">
          <input class="form-input" name="data[second_field]" type="text" value="">
        </div>
      </div>
    </div>
  </fieldset>
</form>
[/prism]

In the above example, the fields appear within the `my-fieldset` fieldset. You'll also notice that the `<legend></legend>` tags are supported through the `legend:` option.
